<?php
	require_once("include/config.php");
	require_once("include/init.php");

	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';	

	//if($_REQUEST['invoiceNo']!='')
	//	$where = " AND invoiceNo=".$_REQUEST['invoiceNo'];
		
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	
		$sql1 = $conn->get_record_set("SELECT * FROM `tbl_orders` WHERE custId='".$custId."' AND YEAR(FROM_UNIXTIME(orderTimestamp)) = YEAR(CURDATE()) $where ORDER BY orderId DESC");
		$rows1 = $conn->records_to_array($sql1);
		foreach($rows1 as $row1)
		{
			$row2['orderId'] = $row1['orderId'];
			$row2['invoiceNo'] = $row1['invoiceNo'];
			$row2['grandTotal'] = $row1['grandTotal'];
			$row2['purchasePoints'] = $row1['purchasePoints'];
			$row2['orderStatus'] = $row1['orderStatus'];
			$row2['orderTimestamp'] = $row1['orderTimestamp'];
			$row2['deliveryTimestamp'] = $row1['deliveryTimestamp'];
			$row2['paymentTimestamp'] = $row1['paymentTimestamp'];
			$d[] = $row2;
		}
		
	
	$jsonArray['Success']='1';
	$jsonArray['Message']="My Points";
	$jsonArray['detail']=$d;
	$d='';
	show_output($jsonArray);
