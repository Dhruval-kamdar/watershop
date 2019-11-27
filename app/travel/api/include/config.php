<?php
date_default_timezone_set('Asia/Riyadh');
error_reporting(0);
define("BASE_URL_API", "http://watershopapp.com/app/travel/api/");
define("BASE_URL", "http://watershopapp.com/app/travel/");
define("PHOTO_URL", BASE_URL."uploads/");
define("NOTIFICATION_ICON", PHOTO_URL."icons/");
/** DATABASE CONFIGURATION **/
/*define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "travel_app");*/

define("DB_HOST", "localhost");
define("DB_USER", "qataf123_travel");
define("DB_PASS", "Travel#531!@!");
define("DB_NAME", "qataf123_travel_app");
$dbConn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connection failed: " . mysqli_connect_error());
mysqli_query($dbConn,"SET NAMES 'utf8'"); 		

define("APP_TITLE","Travel App");
define("CONTACT_EMAIL","info@travelapp.com");
define("FROM_EMAIL","info@travelapp.com");
define("ADMIN_EMAIL","anas.kadival@gmail.com");
define("CURRENCY_SIGN","$");
define("STRIPE_CURRENCY","usd");
define("STRIPE_SECRET_KEY","sk_test_OmHns3GqAL2D0ERZcy481lpY00jD1V80yB");  // Keyur Account
define("STRIPE_PUBLISH_KEY","pk_test_qAatcJFi3oeP1pX2Lq5JjLfh00wzReJyMb"); // Keyur Account
define("APP_KEY", "travel531!@!");

define("SMTP_HOST","smtp.gmail.com");
define("SMTP_PORT","465");  
define("SMTP_UNAME","travelapp531@gmail.com");
define("SMTP_PASS","travel@531");

$_SERVER['HTTP_X_REQUESTED_WITH'];
$dev = isset($_SERVER['HTTP_DEVELOPMENT'])?$_SERVER['HTTP_DEVELOPMENT']:true;

//define("ANDROID_API_KEY","AAAA8fQdnyk:APA91bHuxCHh7ZvfU2dNEG3q-1hfPLC8UPgxxG_oYPY3sx2W5Sf7Mux493hhPpD1NAe_IM1Q_MeIzDUiq1M3jHdBhbcVaBXc2BzSUCYBR21fAWWASxM6isD5IyWtMJaKiGk4GmthagF6");
//define("ANDROID_API_KEY","AIzaSyD0gxxmMX4triXwUbTE5XyoxSusvUhHI7w");
define('PASSPHRASE', ''); 
define('PATH_CERTIFICATES','../certificates/'); //Relative path to the folder for the push notifications's certificate
if(false)
{	
	define('CERTIFICATE_NAME','apns-dev.pem');	//Name of the push notifications's certificate
	define('PUSH_URL','ssl://gateway.sandbox.push.apple.com:2195');	//Name of the push notifications's certificate
}
else
{
	define('CERTIFICATE_NAME','apns-dist.pem');	//Name of the push notifications's certificate
	define('PUSH_URL','ssl://gateway.push.apple.com:2195');	//Name of the push notifications's certificate
}	 
 
set_time_limit(300);
ini_set('max_execution_time',300);

$noti_array = array("add_job_en"=>"You have a new request from ##UNAME##",
						"add_job_ar"=>"##UNAME## لديك طلب جديد من ",
						"process_en"=>"##UNAME## processed your job request",
						"process_ar"=>"##UNAME## قام بتنفيذ الطلب",
						"confirm_en"=>"##UNAME## confirmed your job request",
						"confirm_ar"=>"قام بتأكيد الطلب ##UNAME##",
						"update_cost_en"=>"##UNAME## request to change final cost as ##FINALCOST## for ###REQUESTID##",
						"update_cost_ar"=>"طلب لتغيير التكلفة النهائية ##UNAME##",
						"complete_en"=>"##UNAME## completed job",
						"complete_ar"=>"قام بإكمال الطلب ##UNAME##",
						"feedback_en"=>"##UNAME## sent feedback on job",
						"feedback_ar"=>"ارسل تقييم ##UNAME##",
						"cancel_en"=>"##UNAME## cancelled job",
						"cancel_ar"=>"قام بإلغاء الطلب ##UNAME##",
						"autocancel_job_sp_en"=>"No other service provider available, Do you want to continue with same service provider?",
						"autocancel_job_sp_ar"=>"لايوجد مقدم خدمة اخر متوفر، هل تريد الاستمرار مع مقدم الخدمة الحالي",
						"autocancel_job_sps_en"	=>"Do you want to change the service provider for your job?",		
						"autocancel_job_sps_ar"	=>"هل تريد تغيير مقدم الخدمة لطلبك؟",
						"admin_cancelled_you_en"	=>"Admin cancelled your job ###REQUESTID##",		
						"admin_cancelled_you_ar"	=>"ألغى المشرف مهمتك ##REQUESTID###",	
						"admin_forwarded_you_en"	=>"Admin forwarded job to you",		
						"admin_forwarded_you_ar"	=>"المشرف تمت إعادة توجيه المهمة إليك",
						"admin_forwarded_en"	=>"Admin forwarded job to ##UNAME##",	
						"admin_forwarded_ar"	=>"##UNAME## تمت إعادة توجيه مهمة المشرف إلى",
						"tech_exp_en"=>"Your account is expired shortly",
						"tech_exp_ar"=>"الفترة المجانية قاربت على الانتهاء",
						"recharge_approved_en"=>"Your recharge request approved and balance is updated",
						"recharge_approved_ar"=>"تمت الموافقة على طلب إعادة شحن رصيدك",
						"recharge_rejected_en"=>"Your recharge request rejected",
						"recharge_rejected_ar"=>"تم رفض طلب إعادة الشحن",
						"add_balance_en"=>"New balance is deposited in your account",
						"add_balance_ar"=>"يتم إيداع رصيد جديد في حسابك",
						"deduct_balance_en"=>"Balance is deducted from your account",
						"deduct_balance_ar"=>"يتم خصم الرصيد من حسابك"
);
function dateFormat($date,$dt=false)
{
	if($dt)
	return date("d/m/Y h:i a",strtotime($date));
	else
	return date("d/m/Y",strtotime($date));
}
function round_val($value,$round=2)
{
	return strval(round($value,$round));
}
function send_mail($to,$subject,$message,$attachment)
{
		$url = BASE_URL."api/smtpmail/smtpgmail.php";
		$data = array("to"=>$to,"subject"=>$subject,"message"=>$message,"attachment"=>$attachment);
		$timeout=3600;
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
		$content = curl_exec( $ch );
		return $content;
}
function send_sms($phone_number,$message_data)
{
	return $result = sms_smscountry($phone_number,$message_data);
}
function resend_sms($phone_number,$message_data)
{
	return $result = sms_smscountry($phone_number,$message_data);
}
function send_sms_admin($phone_number,$message_data)
{
	return $result = sms_twilio($phone_number,$message_data);
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
	curl_setopt($ch, CURLOPT_REQUEST, true);    
	curl_setopt($ch, CURLOPT_USERPWD,$user);    
	curl_setopt($ch, CURLOPT_REQUESTFIELDS, $data);    
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
	curl_setopt( $ch, CURLOPT_REQUEST, true);
	curl_setopt( $ch, CURLOPT_REQUESTFIELDS, $data);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
	$content = curl_exec( $ch );
}
function sms_twilio($phone_number,$message_data)
{
	$phone_number_updated = ((strlen($phone_number)>10)? $phone_number : "+966".$phone_number);
	/*$sid = "AC389057fc2c00745ab00da613368ef439";
	$token = "f568547ad873f983a8d41af88bc820d7";*/
	//$sid = "AC67c3e26b39543564d423699e92e57602";
	//$token = "dd21d5146ec9d5d2ecec56a135b690d4";
	
	$uri = 'https://api.twilio.com/2010-04-01/Accounts/' . $sid . '/SMS/Messages.json';
    $auth = $sid . ':' . $token;
 
    // post string (phone number format= +15554443333 ), case matters
    $fields = 
        '&To=' .  urlencode($phone_number_updated) . 
        '&From=' . urlencode('+14064122280') . 
        '&Body=' . urlencode($message_data);
 
    $res = curl_init();
    curl_setopt( $res, CURLOPT_URL, $uri );
    curl_setopt( $res, CURLOPT_REQUEST, 3 ); // number of fields
    curl_setopt( $res, CURLOPT_REQUESTFIELDS, $fields );
    curl_setopt( $res, CURLOPT_USERPWD, $auth ); // authenticate
    curl_setopt( $res, CURLOPT_RETURNTRANSFER, true ); // don't echo
    $result = curl_exec( $res );
    return $result;
}

function getaddress($latitude,$longitude,$fullAddress=false)
{
	$count = 1;
	$latlng = $latitude.",".$longitude;
	
	while($count<=3)
	{
		// if($count==1)
		// $baseetahAPIkey="";
	 //    elseif($count==2)
		$baseetahAPIkey="&key=AIzaSyB7iDviGfi9bvIYdJXTdedU9E1LEvIBxPY";
		// elseif($count==3)
		// $baseetahAPIkey="&key=AIzaSyCN53Bo22fnKQZUDRuR9h3Zbkx9KO0TVhY";
		// $count++;
		
//		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng='.$latlng.$baseetahAPIkey1;
		$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latlng.$baseetahAPIkey;
		//$coordinates = file_get_contents($url);
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	        $coordinates = curl_exec($ch);
	        curl_close($ch);
		$coordinates = json_decode($coordinates,true);
		if($coordinates["status"] == 'OK')
		{
			foreach($coordinates['results'] as $coordinate)
			{
				foreach($coordinate['address_components'] as $coordinater)
				{
					foreach($coordinater['types'] as $types)
					{
						if($types == "locality")
						{
							$city = $coordinater['long_name'];
						}
						
					}
					if($city=='')
					{
						foreach($coordinater['types'] as $types)
						{
							if($types == "administrative_area_level_2")
							{
								$city = $coordinater['long_name'];
							}
							
						}
					}
					if($city=='')
					{
						foreach($coordinater['types'] as $types)
						{
							if($types == "administrative_area_level_1")
							{
								$city = $coordinater['long_name'];
							}
							
						}
					}
					if($fullAddress)
					return $address = $coordinate['formatted_address'];
				}
			}
			return $city;
		}
		
	}
	return $city;
}

function getlatlong($address)
{
	$apiKey = "AIzaSyB7iDviGfi9bvIYdJXTdedU9E1LEvIBxPY";
	$url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=$apiKey";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	$responseJson = curl_exec($ch);
	curl_close($ch);

	$response = json_decode($responseJson);
	$returnArray = array();
	if ($response->status == 'OK') {
	    $returnArray['latitude'] = $response->results[0]->geometry->location->lat;
	    $returnArray['longitude'] = $response->results[0]->geometry->location->lng;
	} 
	else {
	    $returnArray['latitude'] = '';
	    $returnArray['longitude'] = '';
	}   
	return $returnArray;
}

function convert_en($string) {
	$arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
	$arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	return str_replace($arabic_eastern, $arabic_western, $string);
}

function getTime($ptime)
{
			$etime = time() - strtotime($ptime);

			if ($etime < 1)
			{
				return '0 sec';
			}

			$a = array( 365 * 24 * 60 * 60  =>  'yr',
						 30 * 24 * 60 * 60  =>  'mon',
							  24 * 60 * 60  =>  'day',
								   60 * 60  =>  'hr',
										60  =>  'min',
										 1  =>  'sec'
						);
			$a_plural = array( 'yr'   => 'yrs',
							   'mon'  => 'mons',
							   'day'    => 'days',
							   'hr'   => 'hrs',
							   'min' => 'mins',
							   'sec' => 'secs'
						);

			foreach ($a as $secs => $str)
			{
				$d = $etime / $secs;
				if ($d >= 1)
				{
					$r = round($d);
					return $r .' '. ($r > 1 ? $a_plural[$str] : $str).' ago';
				}
			}
}
?>