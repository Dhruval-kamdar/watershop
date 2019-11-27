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
	$jsonArray = array();
	
	if($_POST['user_id']!='')
		$user_id = $_POST['user_id'];
	else
		$err = $lang["REQ_PARA"].$lang["USER_ID"];
	
	if($_POST['old_password']!='')
		$old_password = md5($_POST['old_password']);
	else
		$err = $lang["REQ_PARA"].$lang["OLD_PASSWORD"];
	
	
	if($_POST['new_password']!='')
		$postdata1['password'] = md5(mysqli_real_escape_string($dbConn,$_POST['new_password']));
	else
		$err = $lang["REQ_PARA"].$lang["NEW_PASSWORD"];
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	$sql = $conn->get_record_set("SELECT * FROM `tbl_users` WHERE user_id='$user_id' AND password='$old_password'  AND is_active='1' AND is_deleted='0'");
	$rows = $conn->records_to_array($sql);
	if(!empty($rows))
	{
		if($old_password == $rows[0]['password'])
			$veryfied= '1';
		else
			$veryfied= '0';
		
		if($veryfied=='1')
		{
			$data->update( "tbl_users" , $postdata1,array("user_id"=>$user_id));
			
			$jsonArray['Success']='1';
			$jsonArray['Message']=$lang["PASS_UPDATE_SUC"];
		}
		else
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']=$lang["PASS_OLD_INCORRECT"];
		}
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["PASS_OLD_INCORRECT"];
	}
			
	show_output($jsonArray);
?>