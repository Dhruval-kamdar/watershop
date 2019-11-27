<?php
error_reporting(0);
date_default_timezone_set('Asia/Riyadh');
define("BASE_URL_API", "http://watershopapp.com/app/api/v1/");
define("BASE_URL", "http://watershopapp.com/app/");
define("IMAGE_DIR", BASE_URL."uploads/");
$dayArr = array("1"=>"SUNDAY","2"=>"MONDAY","3"=>"TUESDAY","4"=>"WEDNESDAY","5"=>"THURSDAY","6"=>"FRIDAY","7"=>"SATURDAY");
/** DATABASE CONFIGURATION **/
define("DBSERVER", "localhost");
define("DBNAME", "qataf123_watershop");
define("DBUSERNAME", "qataf123_watersh");
define("DBPASSWORD", "wtrshop#007");

$dbConn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
mysqli_query($dbConn,"SET NAMES 'utf8'"); 

define("APP_TITLE","WaterShop");
define("FROM_EMAIL","info@watershop.com");
define("ADMIN_EMAIL","info@yes.sa");
define("PRD_IMAGE", IMAGE_DIR."products/");
define("PROFILE_IMAGE_200", IMAGE_DIR."profile/200x200/");
define("NOTIFICATION_ICON", IMAGE_DIR."icons/");
define("CURRENCY_SIGN","SR");
define("APP_KEY", "424eb6db248f19d0af9c08845433d4cb");

define("SMTP_HOST","mail.yes.sa");
define("SMTP_PORT","465");  
define("SMTP_UNAME","info.watershop@yes.sa");
define("SMTP_PASS","wtrshop#007");

/***CONFIGURE ONLY IF YOU USE Push Notifications***/
define('PATH_CERTIFICATES','../../certificates/'); //Relative path to the folder for the push notifications's certificate
define('CERTIFICATE_NAME','apns-dist.pem');	//Name of the push notifications's certificate
//define('CERTIFICATE_NAME','apns-dev.pem');	//Name of the push notifications's certificate
define('PASSPHRASE', ''); 	//The pass with which you create the push notifications's certificate
define('PUSH_URL', 'ssl://gateway.sandbox.push.apple.com:2195'); 	//URL for debug and test. When you ditribute the app, you muste delete ".sandbox" and the result is 'ssl://gateway.push.apple.com:2195'
/***************************************************/
define('ANDROID_API_KEY',"AAAAtgUwQCk:APA91bELqHlFfyM_rL9wiN5JnmygBE920tW5V-9AzXEFqstYCSM3ULpmyB44sOAKbUNTJKCflpHkgRwjy7hdGl_RbPnJi6FmTatsOhLSNrWOzJhZdroXMf7bPiYcukRlftD6sfDtb1ap");


function send_sms($phone_number,$message_data)
{
	return $result = sms_shamelsms($phone_number,$message_data);
}
function resend_sms($phone_number,$message_data)
{
	return $result = sms_shamelsms($phone_number,$message_data);
}
function sms_shamelsms($mobile,$message)
{
	$mobile = ((strpos($mobile,"0",0)===false)?$mobile:ltrim($mobile, '0'));
	$mobile = ((strlen($mobile)>=12)? $mobile : "966".$mobile);
	//$url = "http://www.shamelsms.net/api/httpSms.aspx?username=$username&password=$password&mobile=$mobile&message=$message&sender=$senderName&unicodetype=U";
	$url = 'http://www.shamelsms.net/api/httpSms.aspx?' . http_build_query(array(
	    'username' => 'watershop2018',
	    'password' => 'watershopapp',
	 	'mobile' => $mobile,
	 	'message' => $message,
	 	'sender' => 'watershop',
	 	'unicodetype' => 'U'
	));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$content = curl_exec($ch);
	return $content;

}
/*function sms_sinch($phone_number,$message_data)
{
	$key = "5f8db0a1-b399-426e-8e66-e4856fbd7582";     // Adhman live
	$secret = "647sZg6LeEe9dIRVE7daTQ=="; // Adhman live
	$phone_number_updated = ((strlen($phone_number)>10)? $phone_number : "00966".$phone_number);
	$user = "application\\" . $key . ":" . $secret;    
	$message = array("message"=>$message_data); 
	$data = json_encode($message);    
	$ch = curl_init('https://messagingapi.sinch.com/v1/sms/' . $phone_number_updated);    
	curl_setopt($ch, CURLOPT_POST, true);    
	curl_setopt($ch, CURLOPT_USERPWD,$user);    
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    

	$result = json_decode(curl_exec($ch)); 
	return $result->messageId;
}*/
/*
function sms_hisms($phone_number,$message_data)
{
	$phone_number = ((strpos($phone_number,"0",0)===false)?$phone_number:ltrim($phone_number, '0'));
	$phone_number_updated = ((strlen($phone_number)>10)? $phone_number : "966".$phone_number);
	$uname = "966555226446";
	$pass = "Sham@2017";
	$sender = "555226446";

	$uri = 'http://www.hisms.ws/api.php?send_sms&username='.$uname.'&password='.$pass.'&numbers='.$phone_number_updated.'&sender='.$sender.'&message=' . urlencode($message_data);
    $res = curl_init();
    curl_setopt( $res, CURLOPT_URL, $uri );
    curl_setopt( $res, CURLOPT_RETURNTRANSFER, false ); // don't echo
	$result = curl_exec( $res );
    return $result;
}*/
function sms_smscountry($phone_number,$message_data)
{
	$url = BASE_URL."api/include/smscountry.php";
	$data = array("phone_number"=>$phone_number,"message_data"=>$message_data);
	$timeout=3600;
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
	$content = curl_exec( $ch );
}