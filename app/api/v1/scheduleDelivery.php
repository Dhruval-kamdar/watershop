<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	$d = array();
	$total_purchase =0;
	
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';	

	/*if($_REQUEST['orderId']!='')
		$where = " AND orderId=".$_REQUEST['orderId'];*/
	
	
	// START PAGING
	//$limit =  'LIMIT 1';
	/*$totalRecord=10;
	if($_REQUEST['page']=='0' || $_REQUEST['page']=='')
	{
		$start = 0;
		$limit = ' LIMIT '.$start.','.$totalRecord;
	}	
	else
	{
		$start = ($_REQUEST['page'] * $totalRecord);
		$limit = ' LIMIT '.$start.','.$totalRecord;
	}	*/
	// END PAGING
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
		$sql = $conn->get_record_set("SELECT 
		orderId, invoiceNo, productDetails, grandTotal, orderStatus, orderTimestamp, deliveryTimestamp, subTotal, vat, discount, grandTotal, o.purchasePoints, address FROM `tbl_orders` o INNER JOIN tbl_customers c ON o.custId=c.custId WHERE o.custId='".$custId."' AND orderStatus<6 $where ORDER BY orderId DESC");
		$rows = $conn->records_to_array($sql);
	
		$sql1 = $conn->get_record_set("SELECT 
		orderId, invoiceNo, productDetails, grandTotal, orderStatus, orderTimestamp, deliveryTimestamp, subTotal, vat, discount, grandTotal, o.purchasePoints, address FROM `tbl_orders` o INNER JOIN tbl_customers c ON o.custId=c.custId WHERE o.custId='".$custId."' AND orderStatus<6 $where ORDER BY orderId DESC $limit");
		$rows1 = $conn->records_to_array($sql1);
		if(!empty($rows1))
		{
			foreach($rows1 as $row1)
			{
				$products = json_decode($row1['productDetails']);
				for($i=0;$i<count($products);$i++)
				{
					$prd['prdId'] = $products[$i]->prdId;
					$prd['prdQty'] = $products[$i]->prdQty;
					$prd['qtyUnit'] = $products[$i]->qtyUnit;
					$prd['prdUnitPrice'] = $products[$i]->prdUnitPrice;
					$prd['prdTotalPrice'] = $products[$i]->prdTotalPrice;
					$prd['prdName'] = $products[$i]->prdName;
					if (!filter_var($products[$i]->prdImage, FILTER_VALIDATE_URL) === false)
					$prd['prdImage'] = $products[$i]->prdImage;
					else
					$prd['prdImage'] = ($products[$i]->prdImage!='')?PRD_IMAGE.$products[$i]->prdImage:"";
					$d1[] = $prd;
				}
				$row1['productDetails'] = $d1;
				$d1 = array();
				$sts = $data->select("tbl_order_status","orderStatus",array("orderStatusId"=>$row1['orderStatus']));
				//$row1['deliveryStatus'] = ($row1['deliveryStatus']=='0')?'Not Deliver':'Delivered';
				//$row1['paymentStatus'] = ($row1['paymentStatus']=='0')?'Pending':'Done';
				$row1['orderStatus'] = $sts[0]['orderStatus'];
				$row1['orderStatusText'] = " كان طلبك ".strtoupper($sts[0]['orderStatus']);
				//$row1['isPastOrder'] = $row1['deliveryStatus']; //1 -Past AND 0 - Scheduled
				$total_purchase += $row1['grandTotal'];
				$d[]=$row1;
				
			}
			$jsonArray['Success']='1';
			$jsonArray['Message']='Order deatils';
		}
		else
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']='لم يتم العثور على طلب.';
		}
	$jsonArray['total_record']=count($rows);
	$jsonArray['currency_sign']=CURRENCY_SIGN;
	$jsonArray['total_purchase']=$total_purchase;
	$jsonArray['detail']=$d;
	
	$d='';
	show_output($jsonArray);
