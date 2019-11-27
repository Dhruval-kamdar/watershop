<?php
	error_reporting(0);
	@session_start();
	ob_start();
	date_default_timezone_set('Asia/Riyadh');
	define("BASE_URL","http://watershopapp.com/app/");
	define('SITE_PATH','http://watershopapp.com/app/admin/');
    define('SITE_NAME','WaterShop');
	//define('SITE_TITLE','WaterShop');
	define("CURRENCY", ' SR');
	define('ADMIN_EMAIL','info@watershop.com');
	define('FROM_EMAIL','info@watershop.com');
	
	define("DBSERVER", "localhost");
	define("DBNAME", "qataf123_watershop");
	define("DBUSERNAME", "qataf123_watersh");
	define("DBPASSWORD", "wtrshop#007");
	
	$dbConn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
	//mysqli_query($dbConn,"SET NAMES 'utf8'");
	define("DATABASE_SERVER", "localhost");
	define("DATABASE_NAME", "qataf123_watershop");
	define("DATABASE_USER", "qataf123_watersh");
	define("DATABASE_PASSWORD", "wtrshop#007");
	
	
	include("settings.php");
    /***CONFIGURE ONLY IF YOU USE Push Notifications***/
	//define('PATH_CERTIFICATES','../certificates/'); //Relative path to the folder for the push notifications's certificate
	//define('CERTIFICATE_NAME','apns-dist.pem');	//Name of the push notifications's certificate
	//define('CERTIFICATE_NAME','apns-dev.pem');	//Name of the push notifications's certificate
	//define('PASSPHRASE', ''); 	//The pass with which you create the push notifications's certificate
	//define('PUSH_URL', 'ssl://gateway.push.apple.com:2195'); 	//URL for debug and test. When you ditribute the app, you muste delete ".sandbox" and the result is 'ssl://gateway.sandbox.push.apple.com:2195'
	/***************************************************/
	define('ANDROID_API_KEY',"AAAAtgUwQCk:APA91bELqHlFfyM_rL9wiN5JnmygBE920tW5V-9AzXEFqstYCSM3ULpmyB44sOAKbUNTJKCflpHkgRwjy7hdGl_RbPnJi6FmTatsOhLSNrWOzJhZdroXMf7bPiYcukRlftD6sfDtb1ap");
	function __autoload($class_name)
    {
		include dirname(__FILE__) . "/" . $class_name . '.php';
	}
	include("language/english.php");
	$dbObj = new dbfunctions();
	$myprocess = new inputfilter();
	
	function getLatLong($address)
	{
		//$address = $address.",".$subarea.",".$Surname.",".$region;
		$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
		$coordinates = json_decode($coordinates);
		
		$lat1= $coordinates->results[0]->geometry->location->lat;
		$long1= $coordinates->results[0]->geometry->location->lng;
		
		return array($lat1,$long1);
	}
	
	function datFormat($date, $format = false)
	{
		if($date!="" && $date!="0000-00-00" && $date!="0000-00-00 00:00:00")
		{
			$date = date_create($date);
			if ($format == true)
			{
				return date_format($date, "d/m/Y h:i A");
			}
			else
			{
				return date_format($date, "d/m/Y");
			}
		}
		return ;
	}
	function datDefault($date, $format = false)
	{
		if($date!="" && $date!="0000-00-00" && $date!="0000-00-00 00:00:00")
		{
			list($d,$m,$y) = explode("/",$date);
			return $y.'-'.$m.'-'.$d;
		}
		return ;
	}
 ?>