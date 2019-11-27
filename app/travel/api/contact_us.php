<?php
	require_once('include/config.php');
	require_once('include/init.php');

	if($language == 'en')
		require_once('lang/en.php');
	elseif($language == 'ar')
		require_once('lang/ar.php');
	else
		require_once('lang/en.php');

	$obj=new Database;
	$data = new DataManipulator;
	$jsonArray = array();

	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray);
	}	

	$sql = $conn->get_record_set("SELECT * FROM `tbl_settings`");
	$rows1 = $conn->records_to_array($sql);
	foreach($rows1 as $row1)
	{
		$d[$row1['item_key']] = $row1['item_value'];
	}	
	/*$d['email_id'] = $row[0]['email_id'];
	$d['phone_number'] = $row[0]['phone_number'];
	$d['facebook_link'] = $row[0]['facebook_link'];
	$d['twitter_link'] = $row[0]['twitter_link'];
	$d['instagram_link'] = $row[0]['instagram_link'];*/
	$jsonArray['Success']='1';
	$jsonArray['Message']=$lang["SUCCESSFUL"];
	$jsonArray['Details']=$d;
	show_output($jsonArray);
?>