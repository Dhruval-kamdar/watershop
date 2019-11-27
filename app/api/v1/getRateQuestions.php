<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['custId']!='')
$custId = $_REQUEST['custId'];
else
$err="Required parameter - custId";

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

$q1 = $data->select( "tbl_rating_questions" , "que", array("keyVal"=>"que1"));
$q2 = $data->select( "tbl_rating_questions" , "que", array("keyVal"=>"que2"));
$q3 = $data->select( "tbl_rating_questions" , "que", array("keyVal"=>"que3"));
$q4 = $data->select( "tbl_rating_questions" , "que", array("keyVal"=>"que4"));
$q5 = $data->select( "tbl_rating_questions" , "que", array("keyVal"=>"que5"));
$d['que1'] = $q1[0]['que'];
$d['que2'] = $q2[0]['que'];
$d['que3'] = $q3[0]['que'];
$d['que4'] = $q4[0]['que'];
$d['que5'] = $q5[0]['que'];
$sql = $conn->get_record_set("SELECT * FROM `tbl_rate_services` WHERE custId='".$custId."'");
$row = $conn->records_to_array($sql);	
if(!empty($row))
{
	$d['que1Rating'] = $row[0]['que1Rating'];
	$d['que2Rating'] = $row[0]['que2Rating'];
	$d['que3Rating'] = $row[0]['que3Rating'];
	$d['que4Rating'] = $row[0]['que4Rating'];
	$d['que5Rating'] = $row[0]['que5Rating'];
	$d['comment'] = $row[0]['comment'];
	$isRated="1";
}
else
{
	$d['que1Rating'] = '';
	$d['que2Rating'] = '';
	$d['que3Rating'] = '';
	$d['que4Rating'] = '';
	$d['que5Rating'] = '';
	$d['comment'] = '';
	$isRated="0";
}
	
$jsonArray['Success']='1';
$jsonArray['Message']='Success';
$jsonArray['isRated']=$isRated;
$jsonArray['detail']=$d;
show_output($jsonArray);
?>