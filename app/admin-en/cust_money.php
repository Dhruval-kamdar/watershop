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
if($_REQUEST['action']=='add_money')
{
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			
				//$sql = "INSERT INTO tbl_notification_history (notId,custId,createdTimestamp) VALUES ('$lastid','".$converter->decode($id)."','$currtime')";
				$sql = "UPDATE tbl_customers SET `remainBalance` = `remainBalance`+'".$_REQUEST['amountText']."' WHERE custId = '".$converter->decode($id)."'";
				$query=mysqli_query($conn, $sql) or die("cust_not_send.php: notification");

		}
	}
}
else if($_REQUEST['action']=='reduse_money')
{
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			
				//$sql = "INSERT INTO tbl_notification_history (notId,custId,createdTimestamp) VALUES ('$lastid','".$converter->decode($id)."','$currtime')";
				$sql = "UPDATE tbl_customers SET `remainBalance` = `remainBalance`-'".$_REQUEST['amountText']."' WHERE custId = '".$converter->decode($id)."'";
				$query=mysqli_query($conn, $sql) or die("cust_not_send.php: notification");

		}
	}
}
	
?>