<?php
include_once('config.inc.php');
//include_once('include/init.php'); 

function sendToIphone($deviceToken,$message,$type,$badge,$enableNotification=1)
{	
	$final_message = $message;
	$passphrase = '';
	$ctx = stream_context_create();
	
	stream_context_set_option($ctx, 'ssl', 'local_cert', '../include/apns-dev-cert-ws.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', '');
	$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

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
	/*$sql=mysql_query("SELECT * FROM user_master  WHERE fbId='".$facebookid."'");
	$row=mysql_fetch_assoc($sql);
	$userName = $row['firstName'].' '.$row['lastName'];
	$fbImage = $row['fbImage'];
	$quickbloxId = $row['quickbloxId'];
	
	$sql1=mysql_query("SELECT * FROM checkin_location  WHERE checkInLocId='".$locId."'");
	$row1=mysql_fetch_assoc($sql1);
	$checkInLocName = $row1['checkInLocName'];*/
	
	//$reg_id=$regid;
	$apiKey= ANDROID_API_KEY ;		
	$registrationIDs = array($deviceToken);
		
	// Message to be sent
	//$message = "Push notification testing by hemal";
		
	// Set POST variables
	$url = 'https://android.googleapis.com/gcm/send';
		
	$fields = array(
		'registration_ids'  => $registrationIDs,
		'data'              => array( "message" => $message,"type" => $type),
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
		
									// Execute post
	$result = curl_exec($ch);
		
	// Close connection
	curl_close($ch);	
	//return $result;
	$data = json_decode($result);
	return $data->success;
}
?>