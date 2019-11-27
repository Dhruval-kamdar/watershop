<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();

if($_SESSION['user_id_orderlist']!="")
{
	$user_id = $converter->decode($_SESSION['user_id_orderlist']);
	$where = " AND user_id='".$user_id."'";
}
else
{
	$where = "";
}

$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'invoice_no', 
	1 =>'user_name',
	2 =>'trip_name',
	3 =>'trip_price',
	4 =>'grand_total',
	5 =>'booking_date',
	6 =>'created_on',
);
$sql = "SELECT * ";
$sql.=" FROM tbl_bookings WHERE 1=1 $where";
$query=mysqli_query($dbConn, $sql) or die("order_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_bookings WHERE 1=1 $where";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( invoice_no LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR user_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR trip_name LIKE '".$requestData['search']['value']."%' )";
	
}
$query=mysqli_query($dbConn, $sql) or die("order_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($dbConn, $sql) or die("order_grid.php: get employees3");
$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	if($row["order_status"] == '6')
	{
		$style = 'background-color: Green;color: white';//for completed
	}
	else if($row["order_status"] == '7' || $row["order_status"] == '8')
	{
		$style = 'background-color: red;color: white';//for Cancle
	}
	else if($row["order_status"] == '2')
	{
		$style = 'background-color: orange;color: black';//for Approve
	}
	else
	{
		$style = 'background-color: none';//for Others
	}
	$encodedId = $converter->encode($row["invoice_no"]);
	$encodedStatus = $converter->encode("status");
	$currStatus = ($row['is_active']=="1")?"Active":"Deactive";
	$editurl = "add_order.php" . $urltoadd . ($urltoadd != "" ? "&invoice_no=" . $encodedId : "?invoice_no=" . $encodedId);
	$cancelBooking = '&nbsp;|&nbsp;<a class="cancelDialog" data-id="'.$encodedId.'" href="#cancelModel" data-toggle="modal" style="text-decoration:underline">Cancel</a>';
	/*if($row["order_status"]=='1')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("2").'" style="text-decoration:underline" >Approve</a>'.$cancelBooking;
	else if($row["order_status"]=='2')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("3").'" style="text-decoration:underline" >Prepare</a>'.$cancelBooking;	
	else if($row["order_status"]=='3')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("4").'" style="text-decoration:underline" >On the way</a>'.$cancelBooking;	
	else if($row["order_status"]=='4')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("5").'" style="text-decoration:underline" >By the door</a>'.$cancelBooking;	
	else if($row["order_status"]=='5')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("6").'" style="text-decoration:underline" >Complete</a>'.$cancelBooking;		
	else
	$statusAction ='';*/
	
	$query1 = mysqli_query($dbConn,"select count(*) as 'total_orders' from tbl_bookings where orderId <= '".$row['orderId']."' and customer_id = '".$row['customer_id']."'");
	$row2 =mysqli_fetch_array($query1);
	if(!empty($row2))
		$total = $row2['total_orders'];
	
	//$order_type=($row['orderType'] == '1')?"Subscription ":"Regular ";
	switch($row['orderType'])
	{
		case "0": 
			$order_type = "Regular "; 
		break;
		case "1": 
			$order_type = "Subscription "; 
		break;
	}
	
	$nestedData=array(); 
	$nestedData[] = '<span style="'.$style.';margin-left:10px">'.$row["invoice_no"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["user_name"].'</span>';
	$nestedData[] =	'<span style="margin-left:20px">'.$row["trip_name"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["trip_price"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["grand_total"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.datFormat($row["booking_date"]).'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.datFormat($row["created_on"]).'</span>';
	//$nestedData[] = '<span style="margin-left:0">'.$row['order_status'].$statusAction.'</span>';
	$nestedData[] = '<span style="margin-left:10px"><a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a></span>';
	$data[] = $nestedData;
	$i++;
}
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data  
			);

echo json_encode($json_data);  

?>
