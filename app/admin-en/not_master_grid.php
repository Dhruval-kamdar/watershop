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
	
	1=> 'notTypeTitle',
	2 => 'notText',
	3 =>'createdTimestamp'
	
);

// getting total number records without any search
$sql = "SELECT notId ";
$sql.=" FROM tbl_notification n INNER JOIN tbl_notification_types t ON n.notTypeId=t.notTypeId";
$query=mysqli_query($conn, $sql) or die("not_master_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT n.*,t.notTypeTitle ";
$sql.=" FROM tbl_notification n INNER JOIN tbl_notification_types t ON n.notTypeId=t.notTypeId WHERE 1=1 ";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( notText LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR notTypeTitle LIKE '".$requestData['search']['value']."%' )";
	//$sql.=" OR createdTimestamp LIKE '".$requestData['search']['value']."%' )";
	//$sql.=" OR phone LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("not_master_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("not_master_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";
	//$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$editurl = "add_not_master.php" . $urltoadd . ($urltoadd != "" ? "&notId=" . $converter->encode($row["notId"]) : "?notId=" . $converter->encode($row["notId"]));
	$encodedId = $converter->encode($row["notId"]);
	$nestedData=array(); 
	$sql1 = "SELECT count(*) As totalUsers FROM tbl_notification_history WHERE notId=".$row["notId"];
	$query1=mysqli_query($conn, $sql1) or die("not_master_grid.php: get employees");
	$row1=mysqli_fetch_array($query1);
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["notId"])."'  />" ;
	$nestedData[] = $row["notTypeTitle"];
	$nestedData[] = $row["notText"];
	$nestedData[] = date("d/m/Y H:i",$row["createdTimestamp"]);
	$nestedData[] = '<span style="margin-left:5px">'.$row1["totalUsers"]." | <a href='not_cust_list.php?nid=".$encodedId."'>Click Here</a></span>";
	
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
