<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
$data_ids1 = $_REQUEST['data_ids1'];
$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
$data_id_array1 = explode(",", $data_ids1); 
if($_REQUEST['action']=='active')
{
	$field = 'isActive=1';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_delivery_times SET $field ";
			$sql.=" WHERE timeId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("deliverytime_action.php: delete citys");
		}
	}
}
elseif($_REQUEST['action']=='deactive')
{
	$field = 'isActive=0';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_delivery_times SET $field ";
			$sql.=" WHERE timeId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("deliverytime_action.php: delete citys");
		}
	}
}
else
{
	$field = 'isDeleted=1';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_delivery_times SET $field ";
			$sql.=" WHERE timeId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("deliverytime_action.php: delete citys");
		}
	}
}
	
?>