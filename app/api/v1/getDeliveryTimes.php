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
	
	$sql = $conn->get_record_set("SELECT startTime,endTime FROM tbl_delivery_times WHERE isActive='1' AND isDeleted='0'");
	$rows = $conn->records_to_array($sql);
		foreach($rows as $row)
		{
			$row1['deliveryTime'] = $row['startTime'].'-'.$row['endTime'];
			$d[] = $row1;
		}
		$jsonArray['Success']='1';
		$jsonArray['Message']="List of Times";
		$jsonArray['detail']=($d !='')?$d:array();
		$d='';
	show_output($jsonArray);
