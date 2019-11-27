<?php 
include("../include/config.inc.php"); 
//include("session.php");
$converter  = new encryption();
$setCounter = 0;
$startdate = $_REQUEST['startDate'];
$enddate = $_REQUEST['endDate'];
$setCounter = 0;

//Jos which are auto cancelled and new clone is created in DB withref_job_id
$autocanjobs_where =" date_format(`created`,'%Y-%m-%d') BETWEEN '$startdate' AND '$enddate'
 AND orderType='".$_REQUEST['orderType']."'";

$where = '';
$setExcelName = "ORDERS_FROM_".date('d-M-Y',strtotime($startdate))."_TO_".date('d-M-Y',strtotime($enddate))."_ON_".date("d-M-Y h:i A");
mysqli_query($dbConn,"SET NAMES 'utf8'"); 
$setSql = "SELECT
invoiceNo, custId, created, deliveryTimestamp, orderStatus, paymentType, subTotal, vat, discount, grandTotal, couponCode  
 FROM tbl_orders WHERE $autocanjobs_where $where";
$setRec = mysqli_query($dbConn,$setSql);

if($_REQUEST['opt']=='CHECK')
{
	$setCounter = mysqli_num_rows($setRec);
	if($setCounter > 0)
	{
		if($setCounter > 7000)
		{
			echo 'false1';
		}
		else
		{
			echo 'true';
		}
	}
	else
	{
		echo 'false';
	}
}
else
{	
	$setCounter = mysqli_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) {
		//$setMainHeader .= mysqli_fetch_field($setRec, $i)."\t";
	}
	$setMainHeader .= "InvoiceNo\t CustId\t CreatedTime\t DeliveryTime\t OrderStatus\t PaymentOption\t SubTotal\t VAT\t Discount\t GrandTotal\t CouponCode";

	while($rec = mysqli_fetch_row($setRec))  {
	  $rowLine = '';
	  foreach($rec as $value)       {
		if(!isset($value) || $value == "")  {
		  $value = "\t";
		}   else  {
	//It escape all the special charactor, quotes from the data.
		  $value = strip_tags(str_replace('"', '""', $value));
		  $value = '"' . $value . '"' . "\t";
		}
		$rowLine .= $value;
	  }
	  $setData .= trim($rowLine)."\n";
	}
	  $setData = str_replace("\r", "", $setData);

	if ($setData == "") {
	  $setData = "\nno matching records found\n";
	}

	$setCounter = mysqli_num_fields($setRec);



	//This Header is used to make data download instead of display the data
	header("Content-type: application/octet-stream");

	header("Content-Disposition: attachment; filename=".$setExcelName.".xls");

	header("Pragma: no-cache");
	header("Expires: 0");

	//It will print all the Table row as Excel file row with selected column name as header.
	echo ($setMainHeader)."\n".$setData."\n";
}
?>