<?php
//include_once('config.inc.php');
//include_once('include/init.php'); 
define("ANDROID_API_KEY","AAAA8fQdnyk:APA91bHuxCHh7ZvfU2dNEG3q-1hfPLC8UPgxxG_oYPY3sx2W5Sf7Mux493hhPpD1NAe_IM1Q_MeIzDUiq1M3jHdBhbcVaBXc2BzSUCYBR21fAWWASxM6isD5IyWtMJaKiGk4GmthagF6");
//define("ANDROID_API_KEY","AIzaSyD0gxxmMX4triXwUbTE5XyoxSusvUhHI7w");
define("APP_TITLE","Travel");

function sendToIphone($deviceToken,$message,$type,$badge,$enableNotification=1)
{	
	$final_message = $message;
	$passphrase = '';
	$ctx = stream_context_create();
	
	stream_context_set_option($ctx, 'ssl', 'local_cert', '../include/apns-cert-travel.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', '');
	$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	if (!$fp){
		//exit("Failed to connect: $err $errstr" . PHP_EOL);
	}
   // var_dump($fp); 
	//$type = ($data['type']!='')?$data['type']:'0';
		$sound = 'default';
		if($data['image']) // image notification
		{	
			$body['aps'] = array(
			'alert' => stripslashes($final_message),
			'title' => APP_TITLE,
			'type'=> $type,
			'sound' => $sound,
			"mutable-content"=> 1,
	                "category"=> "rich-apns",
			"image-url"=> $data['image'],
			'badge' => intval($badge)
			);
			$body['att'] = array('id' => $data['image']);	
		}
		else
		{
			$body['aps'] = array(
			'alert' => stripslashes($final_message),
			'title' => APP_TITLE,
			'type'=> $type,
			'sound' => $sound,
			"mutable-content"=> 1,
	        "category"=> "rich-apns",
			"image-url"=> "",
			'badge' => intval($badge)
			);
			$body['att'] = array('id' => "");	
		}	
	$payload = json_encode($body);
			
	$msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack('n', strlen($payload)) . $payload;
	$result = fwrite($fp, $msg, strlen($msg));
	fclose($fp);
	if(!$result)
	return "0";
	else
	return $result;
}

/*function sendToIphone($deviceToken,$message,$type,$badge,$enableNotification=1)
{
	$badge = intval("1");
	$passphrase = '';
	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev-cert-ws.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', PASSPHRASE);
	$fp = stream_socket_client(PUSH_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
							
	$body['aps'] = array(
		'alert' => $message,
		'sound' => 'default',
		'badge'=>$badge,
		'type'=>$type
		);
		
	$payload = json_encode($body);
	//foreach($device_tokens as $token)
	{
		$msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack('n', strlen($payload)) . $payload;
		//$msg = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '', $token)) . pack('n', strlen($payload)) . $payload;
		$result = fwrite($fp, $msg, strlen($msg));
	}
	//return $result;
	if(!$result)
	return "0";
	else
	return "1";
}*/

function sendToAndroid($deviceToken,$message,$type,$badge,$enableNotification=1)
{
	$apiKey= ANDROID_API_KEY ;		
	$registrationIDs = array($deviceToken);	
	// Message to be sent
	//$message = "Push notification testing by hemal";
	// Set POST variables
	$url = 'https://android.googleapis.com/gcm/send';
	$fields = array(
		'registration_ids'  => $registrationIDs,
		'data'              => array("title" => APP_TITLE, "message" => $message,"type" => $type),
	);
	$headers = array( 
	'Authorization: key=' . $apiKey,
	'Content-Type: application/json'
	);
	// Open connection
	$ch = curl_init();
	// Set the url, number of POST vars, POST data
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);	
	// Close connection
	curl_close($ch);	
	$data = json_decode($result);
	return $data->success;
}
?>