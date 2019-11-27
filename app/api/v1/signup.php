<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_REQUEST['districtId']!='')
		$postdata['districtId'] = $_REQUEST['districtId'];
	//else
		//$err='Required parameter - districtId';
	
	if($_REQUEST['cityId']!='')
	$postdata['cityId'] = $_REQUEST['cityId'];
	if($_REQUEST['street']!='')
	$postdata['street'] = $_REQUEST['street'];
	if($_REQUEST['building']!='')
	$postdata['building'] = $_REQUEST['building'];
	if($_REQUEST['houseNo']!='')
	$postdata['houseNo'] = $_REQUEST['houseNo']; //optional	
	if($_REQUEST['latitude']!='')
	$postdata['latitude'] = $_REQUEST['latitude'];
	if($_REQUEST['longitude']!='')
	$postdata['longitude'] = $_REQUEST['longitude'];
	
	if($_REQUEST['password']!='')
		$postdata['password'] = base64_encode($_REQUEST['password']);
	else
		$err='Required parameter - password';
	
	if($_REQUEST['username']!='')
		$postdata['username'] = $_REQUEST['username'];
	//else
		//$err='Required parameter - username';
	
	if($_REQUEST['phone']!='')
	{
	$postdata['phone'] = $_REQUEST['phone'];
	$postdata['tempPhone'] = $_REQUEST['phone'];
	}
	else
		$err='Required parameter - phone';
	
	if($_REQUEST['email']!='')
		$postdata['email'] = $_REQUEST['email'];
	else
		$err='Required parameter - email';
	
	if($_REQUEST['fullName']!='')
		$postdata['fullName'] = $_REQUEST['fullName'];
	else
		$postdata['fullName'] = $_REQUEST['firstName'].' '.$_REQUEST['surName']; // temporary
		//$err='Required parameter - fullName';
	
	if(!empty($_FILES['profilePic']['name']))
	{
		$path= '../../uploads/profile/';
		$userf = $_FILES['profilePic']['tmp_name'];
		$str = explode(".",$_FILES['profilePic']['name']);
		$l=count($str);
		$img =  time()."_profilepic.".$str[$l-1];
		if(move_uploaded_file($userf,$path.$img))
		{
			$postdata['profilePic'] =$img;
			createthumb($path . $img, $path.'200x200/'.$img,200,200);	
		}
	}
	 
	$dist = $data->select( "tbl_districts" , "districtCode,districtName",array("districtId"=>$postdata['districtId']) );
	$city = $data->select( "tbl_cities" , "cityCode,cityName",array("cityId"=>$postdata['cityId']) );	
	if($_REQUEST['address']!='')
	{
		$postdata['address'] = mysqli_real_escape_string($dbConn,$_REQUEST['address']);
	}	
	else
	{
		if($postdata['houseNo']!='')
		$postdata['address'] .= ' '.$_REQUEST['houseNo'];	
		if($postdata['building']!='')
		$postdata['address'] .= ' '.$_REQUEST['building'];	
		if($postdata['street']!='')
		$postdata['address'] .= ' '.$_REQUEST['street'];	
		if($postdata['districtId']!='')
		$postdata['address'] .= ', '.$dist[0]['districtName'];
		if($postdata['cityId']!='')
		$postdata['address'] .= ', '.$city[0]['cityName'];	
	}
	$postdata['deviceToken'] = $deviceToken;
	$postdata['deviceType'] = $deviceType;
	$postdata['created'] = date('Y-m-d H:i:s');
	$postdata['createdTimestamp'] = time();
			
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	
	//$sql = $conn->get_record_set("select * 	from tbl_customers where phone='%".substr($postdata['phone'], -9)."' and isDeleted='0'");
	$sql = $conn->get_record_set("select * 	from tbl_customers where phone='".$postdata['phone']."' and isDeleted='0'");
	$rows = $conn->records_to_array($sql);
	if(empty($rows))
	{
		$sql1 = $conn->get_record_set("select  *  from tbl_customers where email='".$postdata['email']."' and isDeleted='0'");
		$rows1 = $conn->records_to_array($sql1);
		if(empty($rows1))
		{
			// START SMS VERIFICATION CODE
			while(true)
			{
				$postdata['smsVerificationCode'] = rand(1000,9999);
				$sql = mysqli_query($dbConn,"select * from tbl_customers where `smsVerificationCode`='".$postdata['smsVerificationCode']."'");
				if(mysqli_num_rows($sql)==0)
				break;
			}
			//$postdata['smsVerificationCode'] = "1234"; // TEMPORARY
			$sms_text = "WaterShop Account Verification Code: ".$postdata['smsVerificationCode'];
			$msgId = send_sms($postdata['tempPhone'],$sms_text);
			// END SMS VERIFICATION CODE
			
			$autoId = $data->insert( "tbl_customers" , $postdata );	
			$custId = $city[0]['cityCode'].$dist[0]['districtCode'].$autoId;
			$data->update( "tbl_customers" , array("custId"=>$custId),array("autoId"=>$autoId) );	
			extract($postdata);

				$subject = "Welcome To WaterShop";
				$message = "<body dir = 'ltr'>";
				$message .= "Hello ". $fullName. ",<br/><br/>";
				$message .= "We are happy to download and register with us! <br/>
				We'd like to let you know: <br/><br/>
				1. You can easily monitor your purchasing behavior by looking at your purchase history <br/>
				2. All of our products are fresh and carefully selected as they go through the product quality inspection stages <br/>
				3. If you notice anything that is wrong, give us news and work to your satisfaction <br/>
				4. We work continuously to develop and provide the latest and best services for your convenience <br/>
				5. If you like our services or products, tell the one you love about us. <br/><br/>";
				$message .= "Thank you!,<br/>".APP_TITLE;
				$message .= "</body>";
				send_mail($email,$subject,$message,$attach);

			$jsonArray['Success']='1';
			$jsonArray['Message']="لقد أرسلنا لك رسالة نصية قصيرة تحتوي على رمز للرقم الوارد أعلاه.";
			
			$sql = $conn->get_record_set("select  *  from `tbl_customers` where autoId='".$autoId."'");
			$rows = $conn->records_to_array($sql);
		
			foreach($rows as $row)
			{
				$row['password'] = '';
				if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
				$row['profilePic'] = $row['profilePic'];
				else
				$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
				$jsonArray['detail'] = $row;
				$d='';
			}
		}
		else
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']="البريد الالكتروني موجود بالفعل.";
		}
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="رقم الجوال موجود بالفعل.";
	}		
	show_output($jsonArray);
