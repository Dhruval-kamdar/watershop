<?php
	require_once("include/config.php");
	$postdata['smsVerificationCode'] = '3210';
			$sms_text = "WaterShop Account Verification Code: ".$postdata['smsVerificationCode'];
			// SMS VERIFICATION CODE
			$msgId = send_sms('966530816725',$sms_text);
			print_r($msgId);
	?>