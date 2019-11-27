<?php
	function rand_string($typeString, $intLength = 6) 
	{

		if($typeString==1){ $validCharacters = "abcdefghijklmnopqrstuxyvwz0123456789ABCDEFGHIJKLMNOPQRSTUXYVWZ";}
		if($typeString==2){ $validCharacters = "1234567890";}
		if($typeString==3){ $validCharacters = "abcdefghijklmnopqrstuxyvwz";}
		if($typeString==4){ $validCharacters = "ABCDEFGHIJKLMNOPQRSTUXYVWZ";}

		$validCharNumber = strlen($validCharacters);
		$result = "";
		for ($i = 0; $i < $intLength; $i++) {
			$index = mt_rand(0, $validCharNumber - 1);
			$result .= $validCharacters[$index];
		}
		return $result;
	}
	require_once("include/config.php");
	require_once("include/init.php");
	include_once("include/notification.php");
	include_once("../smtpmail/mail.php");
	
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
		$postdata['user_id'] = $_POST['user_id']; 
	else
		$err = $lang["REQ_PARA"] .'user_id';

	if($_POST['trip_id']!='')
		$postdata['trip_id'] = $_POST['trip_id']; 
	else
		$err = $lang["REQ_PARA"] .'trip_id';
	
	if($_POST['booking_date']!='')
		$postdata['booking_date'] = $_POST['booking_date'];
	else
		$err = $lang["REQ_PARA"] .'booking_date';
	
	$totalPerson = count(json_decode($_POST['guest_details'],true));
	if($totalPerson>0)
		$postdata['guest_details'] = $_POST['guest_details'];
	else
		$err = $lang["REQ_PARA"] .'guest_details';
	
	if($_POST['continent_id']!='')
		$postdata['continent_id'] = $_POST['continent_id'];
	else
		$err = $lang["REQ_PARA"] .'continent_id';
	
	if($_POST['country_id']!='')
		$postdata['country_id'] = $_POST['country_id'];
	else
		$err = $lang["REQ_PARA"] .'country_id';
	
	if($_POST['email_id']!='')
		$postdata['email_id'] = $_POST['email_id'];
	else
		$err = $lang["REQ_PARA"] .'email_id';
	
	if($_POST['phone']!='')
		$postdata['phone'] = $_POST['phone'];  
	else
		$err = $lang["REQ_PARA"] .'phone';
	
	if($_POST['arrival_id']!='')
		$postdata['arrival_id'] = $_POST['arrival_id'];
	else
		$err = $lang["REQ_PARA"] .'arrival_id';
	
	if($_POST['departure_id']!='')
		$postdata['departure_id'] = $_POST['departure_id'];
	else
		$err = $lang["REQ_PARA"] .'departure_id';
	
	if($_POST['message']!='')
		$postdata['message'] = mysqli_real_escape_string($dbConn,$_POST['message']);
	//else
	//	$err = $lang["REQ_PARA"] .'message';
	
	if($_POST['card_id']!='')
		$postdata['card_id'] = $_POST['card_id'];
	else
		$err = $lang["REQ_PARA"] .'card_id';
	
	if($_POST['transaction_id']!='')
		$postdata['transaction_id'] = $_POST['transaction_id'];
	
	if($_POST['payment_details']!='')
		$postdata['payment_details'] = $_POST['payment_details'];
	//else
		//$err = $lang["REQ_PARA"] .'payment_details';
	
	if($_POST['coupon_code']!='')
		$postdata['coupon_code'] = $_POST['coupon_code'];
	
	if($_POST['trip_price']!='')
		$postdata['trip_price'] = $_POST['trip_price'];
	else
		$err = $lang["REQ_PARA"] .'trip_price';
	
	if($_POST['tax_price']!='')
		$postdata['tax_price'] = $_POST['tax_price'];
	else
		$postdata['tax_price'] = '0';
	
	//if($_POST['sub_total']!='')
	//	$postdata['sub_total'] = $_POST['sub_total'];
	//else
		$postdata['sub_total'] = round_val($postdata['trip_price'] + $postdata['tax_price']);
	
	if(is_numeric($_POST['discount'])) 
		$postdata['discount'] = $_POST['discount'];
	else
		$postdata['discount'] = 0;
	
	//if($_POST['grand_total']!='')
	//	$postdata['grand_total'] = $_POST['grand_total'];
	//else
		$postdata['grand_total'] = round_val($postdata['sub_total'] - $postdata['discount']);
	
	//$postdata['order_status'] = 'Received';
	$custPoint = $data->select("tbl_settings","item_value",array("item_key"=>'customer_point'));
	$postdata['earning_points'] = ($postdata['grand_total'] / $custPoint[0]['item_value']);	 
	$postdata['created_on'] = date('Y-m-d H:i:s');
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$trip = $data->select( "tbl_trips" , "*", array("trip_id"=>$postdata['trip_id']));
	$postdata['trip_name'] = $trip[0]['trip_name'];
	$tripPrice = $trip[0]['trip_price'];
	if($totalPerson >0)
	{
		$trip_price1 = round_val($tripPrice * $totalPerson);
		if($postdata['trip_price']!=$trip_price1)
		{
			$jsonArray['Success']='0';
			if($language == 'ar')
			$jsonArray['Message']=' يجب أن يكون سعر الرحلة '.$trip_price1.' ('.$tripPrice .' X '. $totalPerson.')';
			else
			$jsonArray['Message']='Trip price must be '.$trip_price1.' ('.$tripPrice .' X '. $totalPerson.')';
			show_output($jsonArray);
		}
		
		$items = $data->select( "tbl_settings" , "item_value",array("item_key"=>"tax_percent")); 
		$taxPercent = $items[0]['item_value'];
		$tax_price1 =  round_val(($postdata['trip_price'] * $taxPercent)/100);
		if($postdata['tax_price']!=$tax_price1)
		{
			$jsonArray['Success']='0';
			if($language == 'ar')
			$jsonArray['Message']=' يجب أن يكون سعر الضريبة '.$tax_price1;
			else
			$jsonArray['Message']='Tax price must be '.$tax_price1;
			show_output($jsonArray);
		}

		if($_POST['sub_total']!=$postdata['sub_total'])
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']=$lang["INCORRECT_SUB_TOTAL"];
			//$jsonArray['Message']='Sub total must be '.$postdata['sub_total'];
			show_output($jsonArray);
		}
		
		if($_POST['grand_total']!=$postdata['grand_total'])
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']=$lang["INCORRECT_GRAND_TOTAL"];
			//$jsonArray['Message']='Grand total must be '.$postdata['grand_total'];
			show_output($jsonArray);
		}
	}
	
	$country = $data->select( "tbl_countries" , "*", array("country_id"=>$postdata['country_id']));
	$postdata['country_name'] = $country[0]['country_name'];
	
	$arrival = $data->select( "tbl_arrival_locations" , "*", array("arrival_id"=>$postdata['arrival_id']));
	$postdata['arrival_location'] = $arrival[0]['arrival_location'];
	
	$departure = $data->select( "tbl_departure_locations" , "*", array("departure_id"=>$postdata['departure_id']));
	$postdata['departure_location'] = $departure[0]['departure_location'];
	
	// START COUPON CODE LOGIC
	if($postdata['coupon_code']!='')
	{	
		$sql = $conn->get_record_set("SELECT * FROM `tbl_coupons` WHERE coupon_code='".$postdata['coupon_code']."' AND is_deleted='0'");
		$row = $conn->records_to_array($sql);	
		extract($row[0]);
		if(!empty($row[0]))
		{
			if($discount_type=='percent')
			{
				$discount = round(($postdata['sub_total']*$discount_value)/100,2);
			}
			else
			{
				$discount = $discount_value;
			}		
			$sql1 = $conn->get_record_set("SELECT *	FROM `tbl_coupons_history` WHERE coupon_code='".$postdata['coupon_code']."' AND user_id='".$postdata['user_id']."'");
			$row1 = $conn->records_to_array($sql1);	
			if($is_active=='0')
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
				show_output($jsonArray);
			}	
			elseif($start_time > date('Y-m-d H:i:s'))
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
				show_output($jsonArray);
			}
			elseif($expiry_time < date('Y-m-d H:i:s'))
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["COUPON_CODE_EXPIRED"];
				show_output($jsonArray);
			}
			elseif($min_order_amt > $postdata['sub_total'])
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["MINIMUM_ORDER_AMOUNT_MUST_BE"].$min_order_amt;
				show_output($jsonArray);
			}
			elseif($is_multi_use=='0' && !empty($row1))
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["ALREADY_USED_COUPON"];
				show_output($jsonArray);
			}
			elseif($discount!=$postdata['discount'])
			{
				$jsonArray['Success']='0';
				$jsonArray['Message']=$lang["INCORRECT_DISCOUNT_AMOUNT"];
				show_output($jsonArray);
			}
		}
		else
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']=$lang["INVALIDE_COUPON_CODE"];
			show_output($jsonArray);
		}
	}	
	// END COUPON CODE LOGIC

	$sql = $conn->get_record_set("SELECT user_id,full_name FROM tbl_users WHERE is_active='1' AND user_id='".$postdata['user_id']."'");
	$rows = $conn->records_to_array($sql);
	if(!empty($rows))
	{

			$postdata['user_name'] = $rows[0]['full_name'];
			
			while(true)
			{
				$postdata["invoice_no"] =  rand_string(2,6);
				$sql = mysqli_query($dbConn,"select * from tbl_bookings where `invoice_no`='".$postdata['invoice_no']."'");
				if(mysqli_num_rows($sql)==0)
				break;
			}
			
			$order_id = $data->insert( "tbl_bookings" , $postdata );
			$to = $postdata['email_id'];
			$subject="Your Booking confirmation number #".$postdata['invoice_no'];
			$message ='Dear '.$rows[0]['full_name'].',<br/><br/>
			<span style="text-align:justify;">
			We received your booking order. we will start process on it soon.<br/ >
			We will contact you soon.<br/ ><br/ >
			
			If you have any query or trouble on logging feel free to contact us.<br/ ><br/ >		
			
			Thank you,<br/ >'.APP_TITLE.'</span>' ;
			send_mail($to,$subject,$message,$attach);	
			send_mail(ADMIN_EMAIL,$subject,$message,$attach);	
			
			$usr = $data->select("tbl_users", "*" ,array("user_id"=>$postdata['user_id']));
			$postusr['total_points'] = ($usr[0]['total_points']+$postdata['earning_points']);
			$data->update("tbl_users" ,$postusr, array("user_id"=>$postdata['user_id']));	

			$currtime = date('Y-m-d H:i:s');
			$text = "New order placed. Order #".$postdata["invoice_no"];	
			$text_ar = " تم ارسال طلبك. طلبك #".$postdata["invoice_no"];
			$postdata_noti['not_text'] = $text;
			$postdata_noti['not_text_ar'] = $text_ar;
			$postdata_noti['not_type_id'] = '15';
			$postdata_noti['invoice_no'] = $postdata["invoice_no"];
			$postdata_noti['created_on'] = $currtime;
			$lastid = $data->insert( "tbl_notification" , $postdata_noti );	
		
			$postdata_noti_his['not_id'] = $lastid;
			$postdata_noti_his['user_id'] = $postdata['user_id'];
			$postdata_noti_his['send_time'] = $currtime;
			$postdata_noti_his['created_on'] = $currtime;
			$autoId = $data->insert( "tbl_notification_history" , $postdata_noti_his );	
			
			$jsonArray['Success']='1';
			$jsonArray['Message']=$lang["BOOKING_SUCCESSFUL"];
			$sql = $conn->get_record_set("SELECT * FROM `tbl_bookings` WHERE `order_id` = '".$order_id."'");
			$row = $conn->records_to_array($sql);
			$jsonArray['Details']= $row[0]; 
	}
	else
	{
		$jsonArray['Success']= '0';
		$jsonArray['Message']= $lang["NOT_FOUND"];
	}
	
	show_output($jsonArray);
