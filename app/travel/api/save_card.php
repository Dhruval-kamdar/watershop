<?php
	require_once("include/config.php");
	require_once("include/init.php");
	include_once("include/notification.php");
	
	if($language == 'en')
		require_once('lang/en.php');
	elseif($language == 'ar')
		require_once('lang/ar.php');
	else
		require_once('lang/en.php');
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();

	if($_POST['user_id']!='')
		$postdata['user_id'] = $_POST['user_id'];
	else
		 $err = $lang["REQ_PARA"]."user_id";
	 
	if($_POST['card_holder']!='')
		$postdata['card_holder'] = $_POST['card_holder'];
	else
		 $err = $lang["REQ_PARA"].$lang["card_holder"];

	
	if($_POST['card_number']!='')
		$postdata['card_number'] = $_POST['card_number'];
	else
		 $err = $lang["REQ_PARA"]."card_number";
	 
	if($_POST['card_expiry']!='')
		$postdata['card_expiry'] = $_POST['card_expiry'];
	else
		 $err = $lang["REQ_PARA"]."card_expiry";
	 
	if($_POST['card_cvv']!='')
		$postdata['card_cvv'] = $_POST['card_cvv'];
	
	if($_POST['payment_token']!='')
		$postdata['payment_token'] = $_POST['payment_token'];
	else
		 $err = $lang["REQ_PARA"]."payment_token";
	 
	 if($_POST['payment_details']!='')
		$postdata['payment_details'] = $_POST['payment_details'];
	 
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
		$postdata['created_on'] = date('Y-m-d H:i:s');
		$card_id = $data->insert("tbl_payment_cards" , $postdata );

		$jsonArray['Success']='1';
		$jsonArray['Message']=$lang["CARD_SAVED_SUCCESSFULLY"];
		$jsonArray['card_id']= strval($card_id);
	show_output($jsonArray);
?>