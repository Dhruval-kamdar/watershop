<?php
require_once("include/config.php");
require_once("include/init.php");

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';
		
		//$deviceuid = $_REQUEST['deviceuid'];
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
		
			$record = $conn->get_record_set("select * from tbl_customers where custId='$custId'");
			$rows = $conn->records_to_array($record);
			if(!empty($rows))
			{
				
				$postdata['deviceToken']='0';
				$data->update( "tbl_customers" , $postdata , array("custId"=>$custId) );
				$jsonArray['Success']='1';
				$jsonArray['Message']="You are sucessfully logout.";
			}
			else
			{
				
				$jsonArray['Success']='2';
				$jsonArray['Message']="No such user found";
			}
	
			
show_output($jsonArray);
