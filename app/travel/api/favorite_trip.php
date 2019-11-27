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

	if($_POST['trip_id']!='')
		$trip_id = $_POST['trip_id'];
	else
		$err = $lang["REQ_PARA"]."trip_id";
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}

	$sql = $conn->get_record_set("SELECT * FROM tbl_favorite_trips WHERE trip_id=".$trip_id." AND user_id=".$user_id);
	$rows = $conn->records_to_array($sql);
	if(!empty($rows) && !empty($trip_id))
	{	
		if($rows[0]['is_deleted']=='1')
		{
			$postdata['is_deleted'] = '0';	
			$jsonArray['Success'] = '1';
			$jsonArray['Message'] = $lang["FAVORITE_SUCCESSFULLY"];
			$jsonArray['is_favorite'] = '1';
		}
		else
		{
			$postdata['is_deleted'] = '1';	
			$jsonArray['Success'] = '1';
			$jsonArray['Message'] = $lang["UNFAVORITE_SUCCESSFULLY"];
			$jsonArray['is_favorite'] = '0';
		}
		$data->update("tbl_favorite_trips" , $postdata,array("trip_id"=>$trip_id, "user_id"=>$user_id));
	
	}
	else
	{
		$postdata['trip_id'] = $trip_id;	
		$postdata['user_id'] = $user_id;	
		$postdata['is_deleted'] = '0';	
		$data->insert("tbl_favorite_trips" , $postdata);
		$jsonArray['Success'] = '1';
		$jsonArray['Message'] = $lang["FAVORITE_SUCCESSFULLY"];
		$jsonArray['is_favorite'] = '1';
	}	
	show_output($jsonArray);
