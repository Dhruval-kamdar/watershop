<?php
require_once("include/config.php");
require_once("include/init.php");

$conn=new Database;
$data = new DataManipulator;
$jsonArray = array();


if($_REQUEST['newpass']!='')
$newpass=base64_encode($_REQUEST['newpass']);
else
$err="Required parameter - newpass";

if($_REQUEST['oldpass']!='')
$oldpass=base64_encode($_REQUEST['oldpass']);
else
$err="Required parameter - oldpass";

if($_REQUEST['custId']!='')
$custId = $_REQUEST['custId'];
else
$err="Required parameter - custId";

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

$checkuser = mysql_query("Select * from tbl_customers where custId='$custId' AND password='$oldpass'");
$result1 = mysql_num_rows($checkuser);
if($result1 > '0')
	{
			$updatepassword = mysql_query("UPDATE `tbl_customers` SET password='$newpass' WHERE `custId`=$custId") OR die(mysql_error());
			if($updatepassword == '1'){
			$jsonArray['Success']='1';
			$jsonArray['Message']="تم تغيير كلمة السر";
			$d['custId'] = $custId;
			$jsonArray['details']=$d;
			}
			else
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']="Mysql Error";
				show_output($jsonArray);
			}
	}
	else
	{
			$jsonArray['Success']='0';
			$jsonArray['Message']="كلمة السر القديمة غير صحيحة.";
	}


show_output($jsonArray);
?>