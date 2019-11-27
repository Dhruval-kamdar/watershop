<?php
include("../include/config.inc.php");
include("session.php");
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

$requestData= $_REQUEST;
$columns = array( 
	0 =>'orderId' ,
);

$sql = "SELECT autoId ";
$sql.=" FROM tbl_customers c INNER JOIN tbl_rate_services h ON c.custId=h.custId";
$query=mysqli_query($conn, $sql) or die("rating_grid.php: get employees1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT c.*,h.que1Rating,h.rateId,h.que2Rating,h.que3Rating,h.que4Rating,h.que5Rating,h.orderId ";
$sql.=" FROM tbl_customers c 
INNER JOIN tbl_rate_services h ON c.custId=h.custId";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( custId LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("rating_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($conn, $sql) or die("rating_grid.php: get employees3");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["rateId"]);
	$editurl = "add_cust.php" . $urltoadd . ($urltoadd != "" ? "&rateId=" . $encodedId : "?rateId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$query1 = mysqli_query($conn,"select invoiceNo from tbl_orders where orderId='".$row["orderId"]."'");
	$row1 =mysqli_fetch_array($query1);
	$nestedData=array(); 
	$nestedData[] = '<span style="margin-left:10px">'.$row1["invoiceNo"].'</span>';
	$nestedData[] = '<span style="margin-left:30px">'.$row["que1Rating"].'</span>';
	$nestedData[] = '<span style="margin-left:30px">'.$row["que2Rating"].'</span>';
	$nestedData[] = '<span style="margin-left:30px">'.$row["que3Rating"].'</span>';
	$nestedData[] = '<span style="margin-left:30px">'.$row["que4Rating"].'</span>';
	$nestedData[] = '<span style="margin-left:30px">'.$row["que5Rating"].'</span>';
	$nestedData[] = '<span style="margin-left:20px"><a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a></span>';
	$data[] = $nestedData;
	$i++;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data   
			);

echo json_encode($json_data);  // send data as json format

?>
