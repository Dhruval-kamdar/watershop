<?php
include("../include/config.inc.php");
include("session.php");
//unset($_SESSION["cust_page"]);
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	//1 =>'districtCode',
	0 =>'custId' ,
	1 =>'fullName',
	//3=> 'email',
	//5 =>'phone',
	//6 =>'purchasePoints'
);
if($_SESSION['nid']!="")
{
	$nid = $converter->decode($_SESSION['nid']);
	$where = " AND notId='".$nid."'";
}
else
{
	$cid = $converter->decode($_SESSION['cid']);
	$where = " AND h.custId='".$cid."'";
}
// getting total number records without any search
$sql = "SELECT autoId ";
$sql.=" FROM tbl_customers c INNER JOIN tbl_notification_history h ON c.custId=h.custId WHERE isDeleted='0' $where";
$query=mysqli_query($conn, $sql) or die("not_cust_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT c.*,h.sendTime,h.readTime,h.notId ";
$sql.=" FROM tbl_customers c 
INNER JOIN tbl_notification_history h ON c.custId=h.custId
WHERE c.isDeleted='0' $where";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( custId LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" OR custId LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR fullName LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR phone LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR purchasePoints LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("not_cust_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("not_cust_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["custId"]);
	$editurl = "add_cust.php" . $urltoadd . ($urltoadd != "" ? "&custId=" . $encodedId : "?custId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";

	$query1=mysqli_query($conn, "select * from tbl_notification where notId='".$row["notId"]."'") ;
	$row1 = mysqli_fetch_assoc($query1);
	
	$nestedData=array(); 
	//$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["custId"])."'  />" ;
	
	$nestedData[] = $row["custId"];
	$nestedData[] = $row["fullName"];
	$nestedData[] = $row1["notText"];
	$nestedData[] = ($row["sendTime"]!="")?date("d/m/Y H:i",$row["sendTime"]):"Pending";
	$nestedData[] = ($row["readTime"]!="")?date("d/m/Y H:i",$row["readTime"]):"Unread";
	
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
