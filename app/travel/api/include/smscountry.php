<?php
	$phone_number = ((strpos($_POST['phone_number'],"0",0)===false)?$_POST['phone_number']:ltrim($_POST['phone_number'], '0'));
	$phone_number_updated = ((strlen($phone_number)>10)? $phone_number : "966".$phone_number);
	//$uname = "adhmn.sa";
	//$pass = "adhmn0388";
	//$sender = "Delivery";
	$uri = 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?User='.$uname.'&passwd='.$pass.'&mobilenumber='.$phone_number_updated.'&message='. urlencode($_POST['message_data']).'&sid='.$sender.'&mtype=LNG&DR=Y';
	$res = curl_init();
    curl_setopt( $res, CURLOPT_URL, $uri );
    curl_setopt( $res, CURLOPT_RETURNTRANSFER, false ); // don't echo
	curl_exec( $res );
?>