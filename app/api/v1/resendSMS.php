<?php
	require_once('include/config.php');
	require_once('include/init.php');
	$obj=new Database;
	$data = new DataManipulator;
	$jsonArray = array();

	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';
		
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray);
	}	
		
	$sql = mysqli_query($dbConn,"Select u.* from tbl_customers u where u.custId='".$custId."' AND isActive='1' AND isDeleted='0'");
	if(mysqli_num_rows($sql) >0)
	{
		$row =mysqli_fetch_assoc($sql);
		
		while(true)
		{
			$smsVerificationCode = rand(1000,9999);
			$sql = mysqli_query($dbConn,"select * from tbl_customers where `smsVerificationCode`='$smsVerificationCode'");
			if(mysqli_num_rows($sql)==0)
			break;
		}
		//$smsVerificationCode = "1234"; // TEMPORARY
		$sms_text = "WaterShop Account Verification Code: ".$smsVerificationCode;
		// SMS VERIFICATION CODE
		
		$res = resend_sms($row['tempPhone'],$sms_text);
		$sql = mysqli_query($dbConn,"UPDATE tbl_customers SET smsVerificationCode='$smsVerificationCode' WHERE custId = '".$custId."'");
		$email = $row['email'];
		$subject= APP_TITLE." - Verification";
		$message ="<b>Welcome to ".APP_TITLE."!</b>,<br/ ><br/ >";
		
		$message .= "<b style='font-size:25px'>".$smsVerificationCode."</b><br/ ><br/ >";
		$message .= "Thank you, <br>".APP_TITLE." Team<br />";
		//send_mail($email, $subject, $message, $headers);
		$jsonArray['Success']='1';
		$jsonArray['Message']="لقد أرسلنا لك رسالة نصية قصيرة تحتوي على رمز للرقم الوارد أعلاه.";	
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']= "دخول غير مرخص." ;	
	}
	show_output($jsonArray);	
?>