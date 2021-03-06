<?php
require_once("include/config.php");
require_once("include/init.php");
include_once("../include/sendNotification.php");

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

	if($_POST['captain_id']!='')
		$postdata['captain_id'] = $_POST['captain_id'];
	else
		$err = $lang["REQ_PARA"]."captain_id";

	if($_POST['order_id']!='')
		$order_id = $_POST['order_id'];
	else
		$err = $lang["REQ_PARA"]."order_id";
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray);
	}	
	
	$postdata['order_status'] = 'Delivered';
	//$postdata['accepted_on'] = date('Y-m-d H:i:s');
	$sql = $conn->get_record_set("SELECT o.* ,u.device_type, u.device_token,u.badge_count FROM `tbl_orders` o 
	INNER JOIN `tbl_users` u ON o.customer_id=u.user_id WHERE order_id='$order_id' AND captain_id='".$postdata['captain_id']."'");
	$rows = $conn->records_to_array($sql);
	if(!empty($rows))
	{

		if($rows[0]['order_status']=='Delivered')
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']="This order alrealy Mark As Delivered.";
			show_output($jsonArray);
		}
		elseif($rows[0]['invoice_photo']=='' || $rows[0]['sub_total']==0)
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']="Enter subtotal & upload invoice photo before Mark as Delivered.";
			show_output($jsonArray);
		}
			
		$data->update( "tbl_orders" , $postdata,array("order_id"=>$order_id,"captain_id"=>$postdata['captain_id']) );
		
			$currtime = date('Y-m-d H:i:s');
			$text = "Order has been Delivered. Order #".$rows[0]["invoice_no"];
			$postdata_noti['not_text'] = $text;
			$postdata_noti['not_type_id'] = '15';
			$postdata_noti['invoice_no'] = $rows[0]["invoice_no"];
			$postdata_noti['created_on'] = $currtime;
			$lastid = $data->insert( "tbl_notification" , $postdata_noti );	
		
			$postdata_noti_his['not_id'] = $lastid;
			$postdata_noti_his['user_id'] = $postdata['captain_id'];
			$postdata_noti_his['send_time'] = $currtime;
			$postdata_noti_his['created_on'] = $currtime;
			$autoId = $data->insert( "tbl_notification_history" , $postdata_noti_his );
			
				//===============================================
			$currtime = date('Y-m-d H:i:s');
			$text = "Your order has been Delivered. Please confirm delivery. Order #".$rows[0]["invoice_no"];
			$postdata_noti['not_text'] = $text;
			$postdata_noti['not_type_id'] = '15';
			$postdata_noti['invoice_no'] = $rows[0]["invoice_no"];
			$postdata_noti['created_on'] = $currtime;
			$lastid = $data->insert( "tbl_notification" , $postdata_noti );	
		
			$postdata_noti_his['not_id'] = $lastid;
			$postdata_noti_his['user_id'] = $rows[0]['customer_id'];
			$postdata_noti_his['send_time'] = $currtime;
			$postdata_noti_his['created_on'] = $currtime;
			$autoId = $data->insert( "tbl_notification_history" , $postdata_noti_his );
			
			$type ='deliver_order';
			$arr['order_id'] = $order_id;
			if($rows[0]['device_type']=='iphone')
			$result=sendToIphone($rows[0]['device_token'],$text,$type,$rows[0]['badge_count'],'1',$arr);
			else
			$result=sendToAndroid($rows[0]['device_token'],$text,$type,$rows[0]['badge_count'],'1',$arr);
			
			$usr = $data->select("tbl_users", "*" ,array("user_id"=>$rows[0]['customer_id']));
			$cpt = $data->select("tbl_users", "*" ,array("user_id"=>$rows[0]['captain_id']));
			if($rows[0]['payment_type']=='In System Transfer')
			{
				$postusr['wallet_balance'] = ($usr[0]['wallet_balance']-$rows[0]['grand_total']);
				$postcpt['wallet_balance'] = ($cpt[0]['wallet_balance']+$rows[0]['grand_total']);
			}
			$postusr['total_customer_points'] = ($usr[0]['total_customer_points']+$rows[0]['customer_points']);
			$data->update("tbl_users" ,$postusr, array("user_id"=>$rows[0]['customer_id']));	
			
			$postcpt['total_captain_points'] = ($cpt[0]['total_captain_points']+$rows[0]['earning_points']);
			$data->update("tbl_users" ,$postcpt, array("user_id"=>$rows[0]['captain_id']));
			
		$jsonArray['Success']='1';
		$jsonArray['Message']=$lang["SUCCESSFUL"];		
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="Something going to wrong.";
	}
	show_output($jsonArray); 
