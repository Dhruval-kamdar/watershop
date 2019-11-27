<?php
include("../include/config.inc.php");
include('../include/sendNotification.php');
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if($_REQUEST['action']=='notification')
{
	$currtime = time();
	$notTypeId = $_REQUEST['notTypeId'];
	$notText = mysql_real_escape_string($_REQUEST['notText']);
	$sql = "INSERT INTO tbl_notification (notText,notTypeId,createdTimestamp) VALUES ('$notText','$notTypeId','$currtime')";
	$query=mysqli_query($conn, $sql) or die("cust_not_send.php: إشعار");
	$lastid =  mysqli_insert_id($conn); 
 
	$sql2 = "select * from tbl_notification_types where notTypeId='$notTypeId'";
	$query2=mysqli_query($conn, $sql2) or die("cust_not_send.php: إشعار");
	$row2 =mysqli_fetch_array($query2);
	$notTypeTitle = $row2['notTypeTitle'];
	
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			//$sql1 = "select * from tbl_customers where enableNotification='1' and custId='".$converter->decode($id)."'";
			$sql1 = "select * from tbl_customers where custId='".$converter->decode($id)."'";
			$query1=mysqli_query($conn, $sql1) or die("cust_not_send.php: إشعار");
			if(mysqli_num_rows($query1)>0)
			{
				$row1 =mysqli_fetch_array($query1);
				$enableNotification = $row1['enableNotification'];
				$deviceType = $row1['deviceType'];
				$badge = $row1['badge']+ 1;
				$message = $notTypeTitle."\n".$notText;
				//$type = '3';
				$type = '';
				if($deviceType == 'iphone' || $deviceType == 'ipad')
					$value = sendToIphone($row1['deviceToken'],$message,$type,$badge,$enableNotification);
				else if($deviceType == 'androidphone' || $deviceType == 'android')
					$value = sendToAndroid($row1['deviceToken'],$message,$type,$badge,$enableNotification);

				$sql = "INSERT INTO tbl_notification_history (notId,custId,sendTime,createdTimestamp) VALUES ('$lastid','".$converter->decode($id)."','$currtime','$currtime')";
				$query=mysqli_query($conn, $sql) or die("cust_not_send.php: إشعار");
			}
		}
	}
} 
	
?>