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
			$sql = "UPDATE tbl_districts SET $field ";
			$sql.=" WHERE districtId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("district_action.php: delete districts");
		}
	}
}
elseif($_REQUEST['action']=='deactive')
{
	$field = 'isActive=0';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_districts SET $field ";
			$sql.=" WHERE districtId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("district_action.php: delete districts");
		}
	}
}
elseif($_REQUEST['action']=='free_delivery')
{	
	$field = 'deliveryFee="0"';
	$sql = mysqli_query($conn, "SELECT * FROM tbl_settings WHERE type='delivery_fee_per_sr'");
	$row = mysqli_fetch_assoc($sql);
	if(trim($data_ids1)!="")
	{
		mysqli_query($conn, "UPDATE tbl_districts SET deliveryFee='".$row['value']."'
		WHERE districtId IN (".$data_ids1.")");
	}
	if(trim($data_ids)!="")
	{
		mysqli_query($conn, "UPDATE tbl_districts SET $field WHERE districtId IN (".$data_ids.")");
	}
	
}
else
{
	$field = 'isDeleted=1';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_districts SET $field ";
			$sql.=" WHERE districtId = '".($id)."'";
			$query=mysqli_query($conn, $sql) or die("district_action.php: delete districts");
		}
	}
}
	
?>