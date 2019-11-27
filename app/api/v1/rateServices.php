<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['que1Rating']!='')
$postdata['que1Rating'] = $_REQUEST['que1Rating'];
else
$err="Required parameter - que1Rating";

if($_REQUEST['que2Rating']!='')
$postdata['que2Rating'] = $_REQUEST['que2Rating'];
else
$err="Required parameter - que2Rating";

if($_REQUEST['que3Rating']!='')
$postdata['que3Rating'] = $_REQUEST['que3Rating'];
else
$err="Required parameter - que3Rating";

if($_REQUEST['que4Rating']!='')
$postdata['que4Rating'] = $_REQUEST['que4Rating'];
else
$err="Required parameter - que4Rating";

if($_REQUEST['que5Rating']!='')
$postdata['que5Rating'] = $_REQUEST['que5Rating'];
else
$err="Required parameter - que5Rating";

if($_REQUEST['comment']!='')
$postdata['comment'] = $_REQUEST['comment'];
else
$err="Required parameter - comment";

if($_REQUEST['orderId']!='')
$postdata['orderId'] = $_REQUEST['orderId'];
//else
//$err="Required parameter - orderId";

if($_REQUEST['custId']!='')
$postdata['custId'] = $_REQUEST['custId'];
else
$err="Required parameter - custId";

$postdata['created'] = date('Y-m-d H:i:s');
if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	
	$sql = $conn->get_record_set("SELECT *	FROM `tbl_rate_services` WHERE orderId='".$postdata['orderId']."'");
	$row = $conn->records_to_array($sql);	
	if(empty($row))
	{
		$data->insert("tbl_rate_services" , $postdata);	
		$jsonArray['Success']='1';
		$jsonArray['Message']='Thank you for rate our services.';
	}
	else
	{
		$data->update("tbl_rate_services" , $postdata,array("custId"=>$postdata['custId']));	
		$jsonArray['Success']='1';
		$jsonArray['Message']='Thank you for rate our services.';
	}
	show_output($jsonArray);	
?>