<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if($_REQUEST['action']=='active')
{
	$field = 'isActive=1';
}
elseif($_REQUEST['action']=='deactive')
{
	$field = 'isActive=0';
}
else
{
	$field = 'isDeleted=1';
}
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_notification_types SET $field ";
			$sql.=" WHERE notTypeId = '".$converter->decode($id)."'";
			$query=mysqli_query($conn, $sql) or die("not_type_action.php: delete employees");
		}
	}
?>