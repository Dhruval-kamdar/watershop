<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();
$d="";

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

$sql = $conn->get_record_set("SELECT  
		orderId, invoiceNo, productDetails, grandTotal, orderStatus, orderTimestamp, deliveryTimestamp, subTotal, vat, discount, grandTotal, o.purchasePoints, address FROM `tbl_orders` o INNER JOIN tbl_customers c ON o.custId=c.custId WHERE o.custId='".$custId."' AND deliveryStatus='1'");
$rows = $conn->records_to_array($sql);	
if(!empty($rows))
{
	$pending='0';
	foreach($rows as $row)
	{
		$sql1 = $conn->get_record_set("SELECT * FROM `tbl_rate_services` WHERE orderId='".$row['orderId']."'");
		$rows1 = $conn->records_to_array($sql1);
		if(empty($rows1))
		{
			$pending='1';
			$d=$row;
			break;
		}			
	}
}
else
{
	$pending='0';
}
	
$jsonArray['Success']='1';
$jsonArray['Message']='Success';
$jsonArray['pending']=$pending;
$jsonArray['detail']=$d;
show_output($jsonArray);
?>