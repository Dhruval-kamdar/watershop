<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	if($language == 'en')
		require_once('lang/en.php');
	elseif($language == 'ar')
		require_once('lang/ar.php');
	else
		require_once('lang/en.php');
	
	$conn=new Database;
	$data = new DataManipulator;
	$d = array();
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$sqlMin = $conn->get_record_set("SELECT MIN(trip_price) AS min_price FROM `tbl_trips` t WHERE is_active='1' AND is_deleted='0'");
	$min = $conn->records_to_array($sqlMin);
	$sqlMax = $conn->get_record_set("SELECT MAX(trip_price) AS max_price FROM `tbl_trips` t WHERE is_active='1' AND is_deleted='0'");
	$max = $conn->records_to_array($sqlMax);
	
	$jsonArray['MinPrice']=$min[0]['min_price'];
	$jsonArray['MaxPrice']=$max[0]['max_price'];
	
	$sql1 = $conn->get_record_set("SELECT continent_id, continent_name FROM `tbl_continents` WHERE is_active='1' AND is_deleted='0'");
	$rows1 = $conn->records_to_array($sql1);
	if(!empty($rows1))
	{	
		$jsonArray['Success']='1';
		$jsonArray['Message']=$lang["SUCCESSFUL"];
		foreach($rows1 as $row1)
		{
			$d[] = $row1;
		}
	}	
	else
	{
		$jsonArray['Success']='1';
		$jsonArray['Message']=$lang["NO_DATA_FOUND"];
	}
	$jsonArray['Details']=$d;
	show_output($jsonArray);
