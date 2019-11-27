<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_POST['user_id']!='')
$user_id = $_POST['user_id'];
else
$err="Required parameter - user_id";

if($_POST['coupon_code']!='')
$coupon_code = trim($_POST['coupon_code']);
else
$err="Required parameter - coupon_code";

if(is_numeric($_POST['order_amt']))
$order_amt = trim($_POST['order_amt']);
else
$err="Required parameter - order_amt";

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

$jsonArray['delivery_fee'] =  $order_amt;
$jsonArray['sub_total'] =  '0'; // invoice item(s) value
$jsonArray['discount'] =  '0';
$jsonArray['grand_total'] =  strval($jsonArray['delivery_fee'] - $jsonArray['discount']);

$sql = $conn->get_record_set("SELECT *	FROM `tbl_coupons` WHERE coupon_code='".$coupon_code."' AND is_deleted='0'");
$row = $conn->records_to_array($sql);	
extract($row[0]);
if(!empty($row[0]))
{
	
	$sql1 = $conn->get_record_set("SELECT *	FROM `tbl_coupons_history` WHERE coupon_code='".$coupon_code."' AND user_id='".$user_id."'");
	$row1 = $conn->records_to_array($sql1);	
	if($is_active=='0')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='Invalid coupon code.';
	}	
	elseif($start_time > date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='Invalid coupon code.';
	}
	elseif($expiry_time < date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='This coupon code has been expired.';
	}
	elseif($min_order_amt > $order_amt)
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='Minimum order amount must be '.$min_order_amt.'.';
	}
	elseif($is_multi_use=='0' && !empty($row1))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']='You already used this coupon code.';
	}
	else
	{
		if($discount_type=='flat')
		$jsonArray['discount'] =  $discount_value;
		else
		$jsonArray['discount'] =  strval(($jsonArray['delivery_fee'] * $discount_value)/100);
		$jsonArray['grand_total'] =  strval($jsonArray['delivery_fee'] - $jsonArray['discount']);
		
		$jsonArray['Success']='1';
		if($discount_type=='flat')
		$jsonArray['Message']='Coupon Applied '.CURRENCY_SIGN. round($discount_value) .' off';
		else
		$jsonArray['Message']='Coupon Applied '. round($discount_value) .'% off';	
		$jsonArray['discount_value']=$discount_value; // NO LONGER USED
		$jsonArray['discount_type']=$discount_type; // flat/percent // NO LONGER USED
	}	
}
else
{
	$jsonArray['Success']='0';
	$jsonArray['Message']='Invalid coupon code.';
}
show_output($jsonArray);
?>