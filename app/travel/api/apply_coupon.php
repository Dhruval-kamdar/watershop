<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_POST['user_id']!='')
$user_id = $_POST['user_id'];
else
$err = $lang["REQ_PARA"] . "user_id";

if($_POST['coupon_code']!='')
$coupon_code = trim($_POST['coupon_code']);
else
$err = $lang["REQ_PARA"] . "coupon_code";

if(is_numeric($_POST['order_amt']))
$order_amt = trim($_POST['order_amt']);
else
$err = $lang["REQ_PARA"] . "order_amt";
$trip_price = $order_amt;

$items = $data->select( "tbl_settings" , "item_value",array("item_key"=>"tax_percent")); 
$d['tax_percent']=$items[0]['item_value']; // NOT USED
//$d['trip_price'] =  $trip_price;
$d['tax_price'] =  round_val(($trip_price * $d['tax_percent'])/100 );
$d['sub_total'] =  round_val($trip_price + $d['tax_price']);
$d['discount'] =  '0';
$d['grand_total'] =  round_val($d['sub_total'] - $d['discount']);

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

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
		$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
	}	
	elseif($start_time > date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
	}
	elseif($expiry_time < date('Y-m-d H:i:s'))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["COUPON_CODE_EXPIRED"];
	}
	elseif($min_order_amt > $order_amt)
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["MINIMUM_ORDER_AMOUNT_MUST_BE"].$min_order_amt;
	}
	elseif($is_multi_use=='0' && !empty($row1))
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["ALREADY_USED_COUPON"];
	}
	else
	{
		if($discount_type=='flat')
		$d['discount'] =  $discount_value;
		else
		$d['discount'] =  round_val(($d['sub_total'] * $discount_value)/100);
		$d['grand_total'] =  round_val($d['sub_total'] - $d['discount']);
		
		$jsonArray['Success']='1';
		if($discount_type=='flat')
		$jsonArray['Message']= $lang["COUPON_APPLIED"].CURRENCY_SIGN. round($discount_value) .$lang["COUPON_DISCOUNT_OFF"];
		else
		$jsonArray['Message']= $lang["COUPON_APPLIED"]. round($discount_value) .'%'.$lang["COUPON_DISCOUNT_OFF"];	
		$jsonArray['discount_value']=$discount_value;
		$jsonArray['discount_type']=$discount_type; // flat/percent
	}	
}
else
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
}
$jsonArray['Details']=$d;
show_output($jsonArray);
?>