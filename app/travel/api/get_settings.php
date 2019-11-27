<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_POST['user_id']!='')
		$user_id = $_POST['user_id']; 
	//else
		//$err = $lang["REQ_PARA"] .'user_id';
	
	if(is_numeric($_POST['order_amt']))
	$order_amt = trim($_POST['order_amt']);
	else
	$order_amt = '0';	
	//$err="Required parameter - order_amt";
	$trip_price = $order_amt;
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$items = $data->select( "tbl_settings" , "item_value",array("item_key"=>"tax_percent")); 
	$d['tax_percent']=$items[0]['item_value'];
	//$d['trip_price'] =  $trip_price;
	$d['tax_price'] =  strval(($trip_price * $d['tax_percent'])/100 );
	$d['sub_total'] =  strval($trip_price + $d['tax_price']);
	$d['discount'] =  '0';
	$d['grand_total'] =  strval($d['sub_total'] - $d['discount']);

	$jsonArray['Success']='1';
	$jsonArray['Message']="Successful";
	$jsonArray['Details']=$d;
	show_output($jsonArray);
