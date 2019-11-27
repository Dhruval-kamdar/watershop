<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_REQUEST['username']!='')
		$username1 = $_REQUEST['username'];
	else
		$err='Required parameter - phone';
	
	if($_REQUEST['password']!='')
		$password1 = base64_encode($_REQUEST['password']);
	else
		$err='Required parameter - password';
	
	if($deviceType!='')
		$postdata['deviceType'] = $deviceType;
	elseif($_REQUEST['deviceType']!='')
		$postdata['deviceType'] = $_REQUEST['deviceType'];

	if($deviceToken!='')
		$postdata['deviceToken'] = $deviceToken;
	elseif($_REQUEST['deviceToken']!='')
		$postdata['deviceToken'] = $_REQUEST['deviceToken'];
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	$sql = $conn->get_record_set("select * from `tbl_customers` where (phone='".$username1."' or email='".$username1."') and isDeleted=0");
	$rows = $conn->records_to_array($sql);
	if(!empty($rows))
	{	
		extract($rows[0]);
		if($rows[0]['smsVerified']=='0')
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
			// END SMS VERIFICATION CODE
			$msgId = send_sms($tempPhone,$sms_text);
			$data->update( "tbl_customers" ,$postdata ,array("custId"=>$custId));

			$jsonArray['Success']='2';
			$jsonArray['Message']="يرجى التحقق من الرسائل القصيرة للتحقق.";	
			foreach($rows as $row)
			{
				$row['password'] = '';
				if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
				$row['profilePic'] = $row['profilePic'];
				else
				$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
				$jsonArray['detail']= $row;
			}
			$jsonArray['detail']= $row;
			show_output($jsonArray);
		}
		elseif($rows[0]['password']!=$password1)
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']="كلمة سر خاطئة";	
			show_output($jsonArray);
		}
		elseif($rows[0]['isActive']=='0')
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']="حسابك غير نشط. يرجى الاتصال بالدعم.";	
			show_output($jsonArray);
		}
		else
		{
			$jsonArray['Success']='1';
			$jsonArray['Message']="تسجيل الدخول ناجح";	
			if(!empty($postdata))
			$data->update( "tbl_customers" , $postdata,array("custId"=>$rows[0]['custId']));
			$sql = $conn->get_record_set("select * from `tbl_customers` where custId='".$rows[0]['custId']."'");
			$rows = $conn->records_to_array($sql);
			foreach($rows as $row)
			{
				$row['password'] = '';
				if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
				$row['profilePic'] = $row['profilePic'];
				else
				$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
				$jsonArray['detail']= $row;
			}
		}
		
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="خطأ في رقم الهاتف او البريد الالكتروني";
	}
			
	show_output($jsonArray);

