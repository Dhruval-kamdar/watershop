<?php 
	require_once('include/config.php');
	require_once('include/init.php');

	global $outputjson;
	$conn=new Database;
	$data = new DataManipulator;
	$d = array(); 

	if($_REQUEST['notId']!='')
		$notId = $_REQUEST['notId'];
	else
		$err='Required parameter - notId';
			
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
		
	$conn->operation_query("update `tbl_notification_history` set readTime='".time()."' where notId in (".$notId.")");
	$jsonArray['Success']='1';
	$jsonArray['Message']="Read Successfully";			
	
	
	show_output($jsonArray);

?>