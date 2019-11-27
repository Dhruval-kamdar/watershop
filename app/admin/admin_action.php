<?php
include("../include/config.inc.php");
include("../smtpmail/mail.php");
include("../api-v2/include/sendNotification.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();


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
	$deleted = '1';
	$field = 'isDeleted=1'; 
}
$adminName = $_SESSION['bst_displayname'];
$module_name = 'Admin';
	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_admin SET $field ";
			$sql.=" WHERE AdminId = '".$converter->decode($id)."'";
			$query=mysqli_query($dbConn, $sql) or die("admin_action.php: delete employees");
			/*if($_REQUEST['action']=='active')
			{
				$message = $adminName ." has changed the current status as Active from Deactive for the admin user named as ".$selectQuery['AdminName'];
				$message_ar = $adminName ." تم تغيير الحالة الحالية على أنها نشطة من Deactive للمستخدم الإداري المسمى باسم ".$selectQuery['AdminName'];
			}
			elseif($_REQUEST['action']=='deactive')
			{
				$message = "$adminName has changed the current status as Deactive from Active for the admin user named as ".$selectQuery['AdminName'];
				$message_ar = "$adminName تم تغيير الحالة الحالية كـ Deactive من Active للمستخدم المسؤول المسمى كـ ".$selectQuery['AdminName'];
			}else{
				$message = "$adminName has deleted admin user named as ".$selectQuery['AdminName'];
				$message_ar = "قام $adminName بحذف المستخدم الإداري المسمى بـ ".$selectQuery['AdminName'];
			}	
			$dbfunction->InsertQuery("tbl_log_activities", array(
					"admin_id" => $_SESSION[SESSION_NAME."userid"],
					"user_id" => $converter->decode($id),
					"plateform" => 'WEB',
					"module_name" => $module_name,
					"message"=> $message,
					"ip_address"=> $_SERVER['SERVER_ADDR'],
					"message_ar"=> $message_ar,
					"description"=> serialize($data_ids),
					"description_old"=> serialize($selectQuery),
					"created"=>date('Y-m-d H:i:s')));*/
		}
	}
?>