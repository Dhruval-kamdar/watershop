<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'subId', 
	1 => 'custId',
	3=> 'subType',
	4 =>'deliverySession',
	5=> 'deliveryDay',
	6 =>'nextDelivery'
	
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM tbl_subscriptions  WHERE 1=1 ";
$query=mysqli_query($conn, $sql) or die("subscription_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT s.*,t.subType ";
$sql.=" FROM tbl_subscriptions s INNER JOIN tbl_subscription_types t ON s.subTypeId=t.subTypeId WHERE 1=1 ";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( subId LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR custId LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR subType LIKE '".$requestData['search']['value']."%' )";
	//$sql.=" OR phone LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("subscription_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
//$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$sql.=" ORDER BY status ASC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("subscription_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	if($row["status"] == '0')
	{
		$style = 'background-color: orange;color: black';//for Pending
	}
	else if($row["status"] == '2')
	{
		$style = 'background-color: red;color: white';//for Cancle
	}
	else if($row["status"] == '1')
	{
		$style = 'background-color: green;color: black';//for Approve
	}
	else
	{
		$style = 'background-color: none';//for Others 
	}
	
	$encodedId = $converter->encode($row["subId"]);
	$editurl = "add_subscription.php" . $urltoadd . ($urltoadd != "" ? "&subId=" . $encodedId : "?subId=" . $encodedId);
	if($row["status"]=='0')
	$statusAction =	'<br><a  href="subscriptions.php?id='.$encodedId.'&action='.$converter->encode("approveSubscription").'" style="text-decoration:underline" >Approve</a>&nbsp;|&nbsp;<a class="cancelDialog" data-id="'.$converter->encode($row["subId"]).'" href="#cancelModel" data-toggle="modal" style="text-decoration:underline">Cancel</a>';
	
	//$statusAction ='';
	

	
	$nestedData=array(); 
	//$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["subId"])."'  />" ;
	$nestedData[] = '<span style="'.$style.'">'.$row["subId"].'</span>';
	$nestedData[] = $row["custId"];
	$nestedData[] =	$row["subType"];
	$nestedData[] = ucfirst($row["deliveryDay"])." - ".ucfirst($row["deliverySession"]);
	$nestedData[] = $row['nextDelivery'];
	
	$nestedData[] = ($row['status']=='0')?"Pending".$statusAction:($row['status']=='1'?"Active":"Rejected");
	
	if($row['status']=='1')
		$cancle = ' <a class="cancelDialog btn btn-xs btn-danger" data-id="'.$converter->encode($row["subId"]).'" href="#cancelModel" data-toggle="modal" >Cancel</a>';
	else
		$cancle = ' ';
		
	if($row['status']=='1')
		$edit = ' <a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>';
	else
		$edit = ' ';
	$nestedData[] = ' <a class="ViewDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["subId"]).'" href="#viewModel" data-toggle="modal"><i class="icon-trash icon-white"></i> View</a> '.$edit. $cancle;

	
	$data[] = $nestedData;
	$i++;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
