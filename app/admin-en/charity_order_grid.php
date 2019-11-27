<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'invoiceNo', 
	1 =>'custId',
	3 =>'grandTotal',
	4 =>'orderTimestamp',
	5 =>'pickupTime',
	6 =>'orderStatus'
);
$sql = "SELECT * ";
$sql.=" FROM tbl_orders  WHERE orderType='charity' ";
$query=mysqli_query($conn, $sql) or die("order_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_orders WHERE orderType='charity' ";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( invoiceNo LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR pickupTime LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR grandTotal LIKE '".$requestData['search']['value']."%' )";
	
}
$query=mysqli_query($conn, $sql) or die("order_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("order_grid.php: get employees");
$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	if($row["orderStatus"] == '6')
	{
		$style = 'background-color: Green;color: white';//for completed
	}
	else if($row["orderStatus"] == '7' || $row["orderStatus"] == '8')
	{
		$style = 'background-color: red;color: white';//for Cancle
	}
	else if($row["orderStatus"] == '2')
	{
		$style = 'background-color: orange;color: black';//for Approve
	}
	else
	{
		$style = 'background-color: none';//for Others
	}
	
	$query1 = mysqli_query($conn,"select driverName from tbl_drivers where driverId='".$row["driverId"]."'");
	$row1 =mysqli_fetch_array($query1);
	if(!empty($row1))
	$nestedData1 = $row1["driverName"].' ('.$row["deliverySequence"].') <a class="manageDialog" data-id="'.$converter->encode($row["invoiceNo"]).'" href="#manageModel" data-toggle="modal"><img src="../assets/img/pencil-icon.gif"></a>';
	else
	$nestedData1 = '<a class="manageDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["invoiceNo"]).'" href="#manageModel" data-toggle="modal">Assign</a>';	
	$query1 = mysqli_query($conn,"select orderStatus from tbl_order_status where orderStatusId='".$row["orderStatus"]."'");
	$row1 =mysqli_fetch_array($query1);
	$encodedId = $converter->encode($row["invoiceNo"]);
	$encodedStatus = $converter->encode("status");
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$editurl = "add_order.php" . $urltoadd . ($urltoadd != "" ? "&invoiceNo=" . $encodedId : "?invoiceNo=" . $encodedId);
	$cancelOrder = '&nbsp;|&nbsp;<a class="cancelDialog" data-id="'.$encodedId.'" href="#cancelModel" data-toggle="modal" style="text-decoration:underline">Cancel</a>';
	if($row["orderStatus"]=='1')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("2").'" style="text-decoration:underline" >Approve</a>'.$cancelOrder;
	else if($row["orderStatus"]=='2')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("3").'" style="text-decoration:underline" >Prepare</a>'.$cancelOrder;	
	else if($row["orderStatus"]=='3')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("4").'" style="text-decoration:underline" >On the way</a>'.$cancelOrder;	
	else if($row["orderStatus"]=='4')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("5").'" style="text-decoration:underline" >By the door</a>'.$cancelOrder;	
	else if($row["orderStatus"]=='5')
	$statusAction =	'<br><a  href="order_list.php?id='.$encodedId.'&action='.$encodedStatus.'&code='.$converter->encode("6").'" style="text-decoration:underline" >Complete</a>'.$cancelOrder;		
	else
	$statusAction ='';
	
	$query1 = mysqli_query($conn,"select count(*) as 'total_orders' from tbl_orders where orderId <= '".$row['orderId']."' and custId = '".$row['custId']."'");
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
	$nestedData[] = '<span style="'.$style.'">'.$row["invoiceNo"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["custId"].'</span>';
	$nestedData[] =	'<span style="margin-left:20px">'.$total.'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["grandTotal"].'</span>';
	$nestedData[] = date("d/m/Y H:i",$row['orderTimestamp']);
	$nestedData[] = (strpos($row['deliveryTimestamp'], ' ') !== false)?$row['deliveryTimestamp']:date('d/m/Y h:i a',$row['deliveryTimestamp']);
	//$nestedData[] = $order_type."</br>".$row['orderTime'];
	//$nestedData[] = $nestedData1;
	$nestedData[] = '<span style="margin-left:0">'.$row1['orderStatus'].$statusAction.'</span>';
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
