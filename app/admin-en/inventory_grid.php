<?php
include("../include/config.inc.php");
include("session.php");

$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'orderStatus'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM tbl_orders  WHERE 1=1 AND orderStatus='2'";
$query=mysqli_query($conn, $sql) or die("get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM tbl_orders WHERE 1=1 AND orderStatus='2'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( productDetails LIKE '%".$requestData['search']['value']."%' )";    
	//$sql.=" OR pickupTime LIKE '".$requestData['search']['value']."%' ";
}

$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//$query=mysqli_query($conn, $sql) or die("get employees2");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array

	
	$json_decodes = json_decode($row["productDetails"]);
	foreach($json_decodes as $json_decode)
	{
		$prd_name=$json_decode->prdName;
		$prd_unit=$json_decode->qtyUnit;
		$prd_qty=$json_decode->prdQty;
		if (isset($prd[$prd_name][$prd_unit]))
		{
			$prd[$prd_name][$prd_unit] = $prd[$prd_name][$prd_unit] + $prd_qty;
		}
		else
		{
			$prd[$prd_name][$prd_unit] = $prd_qty;
		}
		
	}
	$i++;
	
}
$totalData=0;
$nestedData=array(); 

		foreach($prd as $key => $value)
		{
			if($key!=null)
			{
			$qtyUnit='';
			$qtyUnit ='<table>';
			foreach($value as $key1 => $value1)
			{
				$qtyUnit .='<tr>';
					$prdName = $key;
					$qtyUnit .='<td style="width:55px">'. $key1.'</td><td style="width:15px">  x  </td><td>'.$value1.'</td>';
				$qtyUnit .='</tr>';
			}
			$qtyUnit .='</table>';
			$totalData++;
			$nestedData[] = $prdName;
			$nestedData[] = $qtyUnit;
			$data[] = $nestedData;
			$nestedData='';
			}
		}
		

		$totalFiltered =  $totalData;
		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
