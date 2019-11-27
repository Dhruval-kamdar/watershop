<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	// STAGE - 2
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	// STAGE - 2	
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	//$cust = $data->select( "tbl_customers" , "remainBalance,districtId",array("custId"=>$custId));// STAGE - 2
	$val = $data->select( "tbl_settings" , "value",array("type"=>"vat_percentage")); // NEW for Watershop
	//$dis = $data->select( "tbl_settings" , "*",array("type"=>"unsubscribers_discount"));// STAGE - 2	
	$del = $data->select( "tbl_settings" , "value",array("type"=>"delivery_fee_per_sr"));	
	//$del1 = $data->select( "tbl_districts" , "deliveryFee",array("districtId"=>$cust[0]['districtId']));	
	
	$jsonArray['Success']='1';
	$jsonArray['Message']="Successful";
	$jsonArray['vat_percentage']=$val[0]['value']; // NEW for Watershop
	//$jsonArray['discount']=$dis[0]['value']; // STAGE - 2
	//$jsonArray['discount_type']=$dis[0]['description']; // STAGE - 2
	//$jsonArray['remainBalance']=$cust[0]['remainBalance'];// STAGE - 2
	//if($cust[0]['districtId']!="")	
	//$jsonArray['delivery_fee_per_sr']=$del1[0]['deliveryFee'];
	//else
	//$jsonArray['delivery_fee_per_sr']=$del[0]['value']; // OLD
	show_output($jsonArray);
