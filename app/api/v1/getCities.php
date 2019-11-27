<?php
	require_once("include/config.php");
	require_once("include/init.php");
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
			
		
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$sql = $conn->get_record_set("SELECT cityId,cityName FROM tbl_cities WHERE isActive='1' AND isDeleted='0'");
	$rows = $conn->records_to_array($sql);
		foreach($rows as $row)
		{
			$d[] = $row;
		}
		$jsonArray['Success']='1';
		$jsonArray['Message']="List of cities";
		$jsonArray['detail']=($d !='')?$d:array();
		$d='';
	show_output($jsonArray);
