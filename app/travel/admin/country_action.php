<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();

/* Database connection end */
$data_ids1 = $_REQUEST['data_ids1'];
$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
$data_id_array1 = explode(",", $data_ids1); 
if($_REQUEST['action']=='active')
{
	$field = 'is_active=1';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_countries SET $field ";
			$sql.=" WHERE country_id = '".($id)."'";
			$query=mysqli_query($dbConn, $sql) or die("country_action.php: delete districts");
		}
	}
}
elseif($_REQUEST['action']=='deactive')
{
	$field = 'is_active=0';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_countries SET $field ";
			$sql.=" WHERE country_id = '".($id)."'";
			$query=mysqli_query($dbConn, $sql) or die("country_action.php: delete districts");
		}
	}
}
else
{
	$field = 'is_deleted=1';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_countries SET $field ";
			$sql.=" WHERE country_id = '".($id)."'";
			$query=mysqli_query($dbConn, $sql) or die("country_action.php: delete districts");
		}
	}
}
	
?>