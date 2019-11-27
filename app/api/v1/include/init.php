<?php
require_once('include/database.php');
require_once ('include/manipulate.php');
require_once ('include/table_vars.php');
require_once ('include/thumb.php');
header('content-type:application/json');
$conn=new Database;
$data = new DataManipulator;

function show_output($str){
	$outputjson['data'] = $str;
	echo json_encode($outputjson);
	exit;
}

/** Authorize Application **/
$_SERVER['HTTP_X_REQUESTED_WITH'];
if (!isset($file_name))
{
	if( !isset($_SERVER['HTTP_APPKEY']) || $_SERVER['HTTP_APPKEY'] != APP_KEY){
		$data1['Error'] = 'Unauthorized Access';
		show_output($data1);
	}
}
$custId = ($_SERVER['HTTP_CUSTID'] >0)?$_SERVER['HTTP_CUSTID']:$_REQUEST['custId'];
$deviceId = $_SERVER['HTTP_DEVICEID'];
$deviceToken = $_SERVER['HTTP_DEVICETOKEN'];
$deviceType = $_SERVER['HTTP_DEVICETYPE'];
$timezone = $_SERVER['HTTP_TIMEZONE'];
$_REQUEST['deviceId'] =$deviceId;
//$_REQUEST['deviceToken'] =$deviceToken;
//$_REQUEST['deviceType'] =$deviceType;
$_REQUEST['timezone'] =$timezone;
if($custId!="" && $deviceToken!="")
{
	
	$sql = mysql_query("SELECT * FROM tbl_customers WHERE custId='".$custId."'");
	$chk = mysql_fetch_array($sql);
	if($chk['isDeleted']=='1')
	{
		$jsonArray['Success']='-1';
		$jsonArray['Message']="Your account is removed";	
		show_output($jsonArray);
	}
	else if($chk['isActive']=='0')
	{
		$jsonArray['Success']='-1';
		$jsonArray['Message']="Your account is deactivated. Please try after some times.";	
		show_output($jsonArray);
	}
	else if($chk['deviceToken']=='')
	{
		mysql_query("UPADTE tbl_customers SET deviceType='".$deviceType."', deviceToken='".$deviceToken."' WHERE custId='".$custId."'");
	}
	else if($chk['deviceToken']!=$deviceToken)
	{
		$jsonArray['Success']='-1';
		$jsonArray['Message']="You have signed in on some other device and now automatically signed out from this device";	
		show_output($jsonArray);
	}
	mysql_query("UPADTE tbl_customers SET deviceType='".$deviceType."', deviceToken='".$deviceToken."' WHERE custId='".$custId."'");
}

    function send_mail($to,$subject,$message,$attachment)
	{
		$url = BASE_URL."api/v1/smtpmail/smtpgmail.php";
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
	function time_elapsed($ptime)
	{
			$etime = time() - $ptime;

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
/*function getAddress($lat, $lon){
	$url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false";
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result = curl_exec($ch);
	curl_close($ch);
	$arr = json_decode($result, true);
	
	if($arr['status']=='OK')
	//return $arr['results'][1]['formatted_address'];
	return $arr['results'][0]['formatted_address'];
	else 
	return '0';
	
  }*/