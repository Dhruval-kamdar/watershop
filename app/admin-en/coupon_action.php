<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) ;

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
			$sql = "UPDATE tbl_coupons SET $field ";
			$sql.=" WHERE couponId = '".$converter->decode($id)."'";
			$query=mysqli_query($conn, $sql) or die("coupon_action.php: delete employees");
		}
	}
?>