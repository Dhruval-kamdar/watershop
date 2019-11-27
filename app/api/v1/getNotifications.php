<?php
	require_once("include/config.php");
	require_once("include/init.php");
	//include_once("sendMail.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';	
		
	if($_REQUEST['limit'])
	{
		$limit = ' LIMIT '.$_REQUEST['limit'];
		if(is_numeric($_REQUEST['lowerId']))
		$where .= ' n.notId < '.$_REQUEST['lowerId']. ' AND ';
	}
	else
		$limit = ' LIMIT 0,20';
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$cust = $data->select("tbl_customers" , "enableNotification",array("custId"=>$custId));
	
	$postdata_user['badge']='0';
	$data->update( "tbl_customers" , $postdata_user , array("custId"=>$custId) );
	
	/*$sql1 = $conn->get_record_set("SELECT n.notId,n.notText,n.createdTimestamp,t.notTypeTitle,t.notTypeIcon FROM `tbl_notification` n
	INNER JOIN `tbl_notification_history` h ON n.notId=h.notId INNER JOIN `tbl_notification_types` t ON n.notTypeId=t.notTypeId  WHERE $where h.custId='".$custId."' ORDER BY h.id DESC $limit");*/
	$sql1 = $conn->get_record_set("SELECT n.notId,n.notText,n.createdTimestamp FROM `tbl_notification` n INNER JOIN `tbl_notification_history` h ON n.notId=h.notId INNER JOIN `tbl_notification_types` t ON n.notTypeId=t.notTypeId  WHERE $where h.custId='".$custId."' ORDER BY h.id DESC $limit");
	$rows1 = $conn->records_to_array($sql1);
	if(!empty($rows1))
	{
		
		foreach($rows1 as $row1)
		{
			/*if (!filter_var($row1['notTypeIcon'], FILTER_VALIDATE_URL) === false)
			$row1['notTypeIcon']         = $row1['notTypeIcon'];
			else
			$row1['notTypeIcon']         = ($row1['notTypeIcon']!='')?NOTIFICATION_ICON.$row1['notTypeIcon']:"";*/
			$row1['address']=""; // For now static
			$d[] = $row1;
		}
		$postdata['readTime'] = time();
		$data->update("tbl_notification_history" , $postdata,array("custId"=>$custId));
		$jsonArray['Success']='1';
		$jsonArray['Message']="Successful"; 
		$jsonArray['enableNotification']=$cust[0]['enableNotification'];
		$jsonArray['detail']=$d;
	}	
	else
	{
		$jsonArray['Success']='2';
		$jsonArray['Message']="لاتوجد بيانات.";
		$jsonArray['enableNotification']=$cust[0]['enableNotification'];
	}

	$d='';
	show_output($jsonArray);
