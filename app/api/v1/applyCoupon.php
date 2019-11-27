<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['custId']!='')
$custId = $_REQUEST['custId'];
else
$err="Required parameter - custId";

if($_REQUEST['couponCode']!='')
$couponCode = trim($_REQUEST['couponCode']);
else
$err="Required parameter - couponCode";

if(is_numeric($_REQUEST['orderAmt']))
$orderAmt = trim($_REQUEST['orderAmt']);
else
$err="Required parameter - orderAmt";

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

$sql = $conn->get_record_set("SELECT *	FROM `tbl_coupons` WHERE couponCode='".$couponCode."' AND isDeleted='0'");
$row = $conn->records_to_array($sql);	
extract($row[0]);
if(!empty($row[0]))
{
	
	$sql1 = $conn->get_record_set("SELECT *	FROM `tbl_coupons_history` WHERE couponCode='".$couponCode."' AND custId='".$custId."'");
	$row1 = $conn->records_to_array($sql1);	
	if($isActive=='0')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='رقم قسيمه غير صالح.';
	}	
	elseif($startTime > date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='رقم قسيمه غير صالح.';
	}
	elseif($expiryTime < date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='لقد انتهت صلاحية شفرة القسيمة هذه.';
	}
	elseif($minOrderAmt > $orderAmt)
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=' يجب أن يكون الحد الأدنى لمبلغ الطلب '.$minOrderAmt.'.';
	}
	elseif($isMultiUse=='0' && !empty($row1))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='لقد استخدمت بالفعل شفرة الكوبون هذه.';
	}
	else
	{
		$jsonArray['Success']='1';
		$jsonArray['Message']='شكرا! تم تطبيق الكوبون بنجاح';
		$jsonArray['discountValue']=$discountValue;
		$jsonArray['discountType']=$discountType; // flat/percent
	}	
}
else
{
	$jsonArray['Success']='0';
	$jsonArray['Message']='رقم قسيمه غير صالح.';
}
show_output($jsonArray);
?>