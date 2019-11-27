<?php

include_once("../include/sendNotification1.php");

	$result=sendToIphone($_REQUEST['device_token'],$_REQUEST['message'],$type,'1');
	print_r($result);exit;
	//show_output($jsonArray); 
