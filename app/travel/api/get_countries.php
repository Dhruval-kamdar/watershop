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
	
	if($_POST['continent_id'] >0)
		$where = "continent_id ='".$_POST['continent_id']."' AND ";
	else
		$err = $lang["REQ_PARA"] .'continent_id';
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$sql1 = $conn->get_record_set("SELECT country_id, country_name FROM `tbl_countries` WHERE $where is_active='1' AND is_deleted='0'");
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
