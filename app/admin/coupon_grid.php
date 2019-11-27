<?php 
include("../include/config.inc.php");
include("session.php");
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) ;
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	1 =>'couponId' ,
	2 =>'couponCode',
	3 =>'startTime',
	4 =>'expiryTime',
	5 =>'discountValue',
);
$sql = "SELECT c.couponId ";
$sql.=" FROM tbl_coupons c WHERE 1=1 AND (c.isDeleted='0')";
$query=mysqli_query($conn, $sql) or die("coupon_grid.php: get employees1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 


$sql = "SELECT c.*";
$sql.=" FROM tbl_coupons c WHERE 1=1 AND (c.isDeleted='0')";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( couponId LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR couponCode LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR startTime LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR expiryTime LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR discountValue LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("coupon_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("coupon_grid.php: get employees3");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["couponId"]);
	$editurl = "add_coupon.php" . $urltoadd . ($urltoadd != "" ? "&couponId=" . $encodedId : "?couponId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$nestedData=array(); 
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$encodedId."'  />" ;
	$nestedData[] = '<span style="margin-left:10px">'.$row["couponId"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["couponCode"].'</span>';
	$nestedData[] = '<span style="margin-left:05px">'.datFormat($row["startTime"]).'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.datFormat($row["expiryTime"]).'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["discountValue"].' ('.$row['discountType'].')</span>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">عرض</a>
	<a href="'.$editurl.'" title="تصحيح" ><button class="btn btn-xs btn-success">تعديل</button></a>
	<a data-id="'.$encodedId.'" class="btnDelete btn btn-xs btn-danger" >حذف</a>';	
	$data[] = $nestedData;
	$i++;
}
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data  
			);

echo json_encode($json_data);  // send data as json format

?>
