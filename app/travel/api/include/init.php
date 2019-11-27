<?php
require_once('include/database.php');
require_once('include/manipulate.php');
require_once('include/table_vars.php');
require_once('include/thumb.php');
header('content-type:application/json');
$conn=new Database;
$data = new DataManipulator;

function show_output($str){
	$str['currency_sign'] = CURRENCY_SIGN;
	$str['stripe_currency'] = STRIPE_CURRENCY;
	$str['stripe_secret_key'] = STRIPE_SECRET_KEY;
	$str['stripe_publish_key'] = STRIPE_PUBLISH_KEY;
	$outputjson['Data'] = $str;
	echo json_encode($outputjson);
	exit;
}

/** Authorize Application **/
$_SERVER['HTTP_X_REQUESTED_WITH'];
if( !isset($_SERVER['HTTP_APP_KEY']) || $_SERVER['HTTP_APP_KEY'] != APP_KEY){
	$data1['Error'] = 'Unauthorized Access';
	show_output($data1);
}
if($_SERVER['HTTP_DEVICE_ID']!='')
$device_id = $_SERVER['HTTP_DEVICE_ID'];
else
$device_id = "simulator";/// temp solution
//$err='Required parameter in header - device_id';

if($_SERVER['HTTP_DEVICE_TYPE']=='iphone' || $_SERVER['HTTP_DEVICE_TYPE']=='android')
$device_type = $_SERVER['HTTP_DEVICE_TYPE'];
else
$err='Required parameter in header - device_type';

if($_SERVER['HTTP_DEVICE_TOKEN']!='')
$device_token = $_SERVER['HTTP_DEVICE_TOKEN'];

if($_SERVER['HTTP_APP_VERSION']!='')
$app_version = $_SERVER['HTTP_APP_VERSION'];

if($_SERVER['HTTP_API_VERSION']!='')
$api_version = $_SERVER['HTTP_API_VERSION'];

if($_SERVER['HTTP_LANGUAGE']!='')
$language = $_SERVER['HTTP_LANGUAGE'];

if($api_version != '2' && $device_type == 'android')
{
	$jsonArray['Success']='-1';
	if($language == 'en')
		$jsonArray['Message']="Please update new version of app from PlayStore";	
	elseif($language == 'ar')
		$jsonArray['Message']="نرجو التحديث للنسخة الجديدة من المتجر";
	//show_output($jsonArray);
}

if(isset($_POST['user_id']) && $_POST['user_id']!="")
//if(false)
{
	$user_id = $_POST['user_id'];
	$sql = mysqli_query($dbConn,"SELECT * FROM tbl_users WHERE user_id='$user_id'");
	$chk = mysqli_fetch_array($sql);
	if($chk['language'] != $language)
	{
		mysqli_query($dbConn,"UPDATE tbl_users SET language='".$language."' WHERE user_id='$user_id'");
	}
	if($chk['is_deleted']=='1')
	{
		$jsonArray['Success']='-1';
		if($language == 'en')
			$jsonArray['Message']="Your account is removed";	
		elseif($language == 'ar')
			$jsonArray['Message']="تتم إزالة حسابك";
		show_output($jsonArray);
	}
	else if($chk['is_active']=='0')
	{
		$jsonArray['Success']='-1';
		if($language == 'en')
			$jsonArray['Message']="Your account is deactivated. Please try after some times.";	
		elseif($language == 'ar')
			$jsonArray['Message']="حسابك تم تعطيله. الرجاء الاتصال بمشرف";	
		show_output($jsonArray);
	}
	else if($chk['is_verified']=='1')
	{
		/*if($chk['type']=='2' && $chk['is_approved']=='0')
		{
			$jsonArray['Success']='-1';
			if($language == 'en')
				$jsonArray['Message']="Your account is not approved. Please contact admin.";	
			elseif($language == 'ar')
				$jsonArray['Message']="لم تتم الموافقة على حسابك. الرجاء الاتصال بمشرف أو المحاولة مرة أخرى في وقت لاحق";
			show_output($jsonArray);
		}
		else*/ if($chk['device_token']=='')
		{
			mysqli_query($dbConn,"UPADTE tbl_users SET device_id='".$device_id."',device_token='".$device_token."',device_type='".$device_type."' WHERE user_id='$user_id'");
		}
		/*else if($chk['device_token']!=$device_token)
		{
			$jsonArray['Success']='-1';
			$jsonArray['Message']="You have signed in on some other device and now automatically signed out from this device";	
			show_output($jsonArray);
		}*/
		else if($chk['device_id']!=$device_id)
		{
			$jsonArray['Success']='-1';
			if($language == 'en')
				$jsonArray['Message']="You have signed in on some other device and now automatically signed out from this device";	
			elseif($language == 'ar')
				$jsonArray['Message']="تم دخولك من جهاز اخر، سوف يتم تسجيل الخروج تلقائيا عند الدخول من هذا الجهاز";
			//show_output($jsonArray);
			mysqli_query($dbConn,"UPADTE tbl_users SET device_id='".$device_id."',device_token='".$device_token."',device_type='".$device_type."' WHERE user_id='$user_id'");
		}
	}
}