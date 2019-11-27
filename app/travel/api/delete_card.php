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
	$d=array();	

	if($_POST['user_id']!='')
		$user_id = $_POST['user_id'];
	else
		$err = $lang["REQ_PARA"].$lang["USER_ID"];

	if($_POST['card_id']!='')
		$card_id = $_POST['card_id'];
	else
		$err = $lang["REQ_PARA"]."card_id";
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}

	$sql1 = $conn->get_record_set("SELECT * FROM tbl_payment_cards WHERE card_id=".$card_id." AND user_id=".$user_id." AND is_deleted='0'");
	$rows1 = $conn->records_to_array($sql1);
	if(!empty($rows1) && !empty($card_id))
	{	
		$postdata['is_deleted'] = '1';
		$data->update("tbl_payment_cards" , $postdata,array("card_id"=>$card_id));
		$jsonArray['Success'] = '1';
		$jsonArray['Message'] = $lang["DELETED_SUCCESSFULLY"];
		$sql1 = $conn->get_record_set("SELECT * FROM tbl_payment_cards WHERE user_id=".$user_id." AND is_deleted='0'");
		$rows1 = $conn->records_to_array($sql1);
		if(!empty($rows1))
		{	
			foreach($rows1 as $row1)
			{
				$d[] = $row1;
			}
		}	
		$jsonArray['Details']=$d;
	}
	else
	{
		$jsonArray['Success'] = '0';
		$jsonArray['Message'] = $lang["NO_RECORD"];
	}	
	show_output($jsonArray);
