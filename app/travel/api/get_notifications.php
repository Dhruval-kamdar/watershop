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
		$err='Required parameter - user_id';	
		
	if($_POST['limit'])
	{
		$limit = ' LIMIT '.$_POST['limit'];
		if(is_numeric($_POST['lowerId']))
		$where .= ' n.not_id < '.$_POST['lowerId']. ' AND ';
	}
	else
		$limit = ' LIMIT 0,20';
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$cust = $data->select("tbl_users" , "notification_enabled",array("user_id"=>$user_id));
	
	$postdata_user['badge_count']='0';
	$data->update( "tbl_users" , $postdata_user , array("user_id"=>$user_id) );
	
	$sql1 = $conn->get_record_set("SELECT n.not_id,n.not_title,n.not_text,n.not_text_ar,n.created_on,t.not_type_icon FROM `tbl_notification` n INNER JOIN `tbl_notification_history` h ON n.not_id=h.not_id INNER JOIN `tbl_notification_types` t ON n.not_type_id=t.not_type_id  WHERE $where h.user_id='".$user_id."' ORDER BY h.id DESC $limit");
	$rows1 = $conn->records_to_array($sql1);
	if(!empty($rows1))
	{
		
		foreach($rows1 as $row1)
		{
			$row1['not_text'] =  ($language == 'ar' && $row1['not_text_ar']!='')?$row1['not_text_ar']:$row1['not_text'];
			if (!filter_var($row1['not_type_icon'], FILTER_VALIDATE_URL) === false)
			$row1['not_type_icon'] = $row1['not_type_icon'];
			else
			$row1['not_type_icon'] = ($row1['not_type_icon']!='')?NOTIFICATION_ICON.$row1['not_type_icon']:"";
					
			$row1['not_time']= getTime($row1['created_on']);
			$d[] = $row1;
		}
		$postdata['read_time'] = date('Y-m-d H:i:s');
		$data->update("tbl_notification_history" , $postdata,array("user_id"=>$user_id));
		$jsonArray['Success']='1';
		$jsonArray['Message']=$lang["SUCCESSFUL"];
		//$jsonArray['notification_enabled']=$cust[0]['notification_enabled'];
		$jsonArray['Details']=$d;
	}	
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$lang["NO_DATA_FOUND"];
		//$jsonArray['notification_enabled']=$cust[0]['notification_enabled'];
	}

	$d='';
	show_output($jsonArray);
