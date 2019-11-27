<?php
require_once('include/config.php');
//require_once('include/init.php');
$sms_text = "Account verification code ";
$postdata['phone'] = '551279431' ; 
$msgId = send_sms($postdata['phone'],$sms_text);
print_r($msgId);
exit;

if($_REQUEST['current_latlng']!='')
	$current_latlng = $_REQUEST['current_latlng'];
else
	$err = $lang["REQ_PARA"] .'current_latlng';

$language = ($language!='')?$language:'ar';

if($_REQUEST['search_txt']!='') {

 $search_txt= urlencode($_REQUEST['search_txt']);
 if(strlen($search_txt) != mb_strlen($search_txt, 'utf-8'))
 { 
    $lang = '&language=ar';
 }
 else {
    $lang = '&language=en';
 }
}

/*if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	*/

// &opennow=true

if($search_txt!='')
$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$search_txt."&location=".$current_latlng. $lang ."&radius=10000&key=".GOOGLE_API_KEY;
else
$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=supermarket&location=".$current_latlng. $lang ."&radius=10000&key=".GOOGLE_API_KEY;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
$res = json_decode($result);
if($res->status == 'ZERO_RESULTS' && $search_txt!='')
{
	$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?type=supermarket&name=".$search_txt."&location=".$current_latlng. $lang ."&radius=10000&key=".GOOGLE_API_KEY;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$result = curl_exec($ch);
}
echo $result;
?>