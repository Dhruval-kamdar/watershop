<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	
$d['address'] = '2345 Yellow St. San Fransisco';
$d['email'] = 'info@watershop.com';
$d['skype'] = 'watershop.info';
$d['phone'] = '+48 576-242-947';
$d['twitter'] = 'https://twitter.com';
$d['facebook'] = 'https://facebook.com';
$d['linkedin'] = 'https://linkedin.com';
$d['instagram'] = 'https://instagram.com';
$d['googleplus'] = 'https://plus.google.com';
$d['youtube'] = 'https://youtube.com';
$jsonArray['Success']='1';
$jsonArray['Message']='Success';
$jsonArray['detail']=$d;
show_output($jsonArray);
?>