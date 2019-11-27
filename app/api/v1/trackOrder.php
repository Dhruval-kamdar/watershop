<?php
require_once("include/config.php");
require_once("include/init.php");

$conn=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['custId']!='')
$custId = $_REQUEST['custId'];
else
$err = "Required paramater - custId";

if($_REQUEST['orderId']!='')
$where = " orderId='".$_REQUEST['orderId']."' and ";

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

	$sql = $conn->get_record_set("select orderStatus,invoiceNo from tbl_orders where $where custId='".$custId."' order by orderId desc limit 1");
	$rows = $conn->records_to_array($sql);
	if(!empty($rows))
	{	
		foreach($rows as $row)
		{
			$ord['invoiceNo'] =$row['invoiceNo']; 
			$sql1 = $conn->get_record_set("select orderStatusId,orderStatus from tbl_order_status where isActive='1' and orderStatusId<=6");
			$rows1 = $conn->records_to_array($sql1);
			foreach($rows1 as $row1)
			{
				$row1['orderStatus'] = $row1['orderStatus'];
				if($row1['orderStatusId']<=$row['orderStatus'])
				{	
					$row1['orderStatusId'] = $row1['orderStatusId'];
					//$row1['orderStatusText'] = " طلبك هو ". strtoupper($row1['orderStatus']);
					if($row1['orderStatusId']=='1')
					$row1['orderStatusText'] = "طلبك قيد الانتظار";
					elseif($row1['orderStatusId']=='2')
					$row1['orderStatusText'] = "طلبك مقبول";
					elseif($row1['orderStatusId']=='3')
					$row1['orderStatusText'] = "جاري تحضير طلبك";
					elseif($row1['orderStatusId']=='4')
					$row1['orderStatusText'] = "بالطريق";
					elseif($row1['orderStatusId']=='5')
					$row1['orderStatusText'] = "طلبك عند الباب";
					elseif($row1['orderStatusId']=='6')
					$row1['orderStatusText'] = "طلبك مكتمل";
					else
					$row1['orderStatusText'] = " طلبك هو ". strtoupper($row1['orderStatus']);
					$row1['isActive'] = "1";
					//$row1['updatedTime'] = time();
				}
				else
				{
					$row1['orderStatusId'] = $row1['orderStatusId'];
					//$row1['orderStatusText'] = " طلبك هو ". strtoupper($row1['orderStatus']);
					if($row1['orderStatusId']=='1')
					$row1['orderStatusText'] = "طلبك قيد الانتظار";
					elseif($row1['orderStatusId']=='2')
					$row1['orderStatusText'] = "طلبك مقبول";
					elseif($row1['orderStatusId']=='3')
					$row1['orderStatusText'] = "جاري تحضير طلبك";
					elseif($row1['orderStatusId']=='4')
					$row1['orderStatusText'] = "بالطريق";
					elseif($row1['orderStatusId']=='5')
					$row1['orderStatusText'] = "طلبك عند الباب";
					elseif($row1['orderStatusId']=='6')
					$row1['orderStatusText'] = "طلبك مكتمل";
					else
					$row1['orderStatusText'] = " طلبك هو ". strtoupper($row1['orderStatus']);
					$row1['isActive'] = "0";
					//$row1['updatedTime'] = '';
				}	
				$d[] = $row1;
			}
			$ord['orderStatusDetails']=$d;
			//$d2[]=$ord;
			$d=array();
		}
		
		$jsonArray['Success']='1';
		$jsonArray['Message']= 'Success';
		$jsonArray['detail']=$ord;	
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="لم يتم العثور على طلب.";	
	}


show_output($jsonArray);
?>