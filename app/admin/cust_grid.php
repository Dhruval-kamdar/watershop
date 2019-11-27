<?php
include("../include/config.inc.php");
include("session.php");
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	1 =>'custId' ,
	2 =>'fullName',
	3 =>'phone',
	4 =>'createdTimestamp',
	5 =>'purchasePoints'
);

// getting total number records without any search
$sql = "SELECT c.autoId ";
$sql.=" FROM tbl_customers c WHERE c.isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("cust_grid.php: get employees1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 


$sql = "SELECT c.*";
$sql.=" FROM tbl_customers c WHERE c.isDeleted='0'";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( username LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" OR autoId LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR custId LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR fullName LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR phone LIKE '".$requestData['search']['value']."%' ";
	//$sql.=" OR createdTimestamp LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR purchasePoints LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("cust_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$query=mysqli_query($conn, $sql) or die("cust_grid.php: get employees3");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["custId"]);
	$editurl = "add_cust.php" . $urltoadd . ($urltoadd != "" ? "&custId=" . $encodedId : "?custId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	if($row["purchasePoints"]>0)
	$btnRedeem =' | <a class="pointsDialog" data-id="'.$encodedId.'" href="#pointsModel" data-toggle="modal" style="text-decoration:underline">إعادة الشراء</a>';
	else
	$btnRedeem ='';
	if($row["remainBalance"]>0)
	$reduceBalance =' | <a class="reduceMoneyDialog" data-id="'.$encodedId.'" href="#reduceMoneyModel" data-toggle="modal" style="text-decoration:underline">الخصم</a>';
	else
	$reduceBalance ='';
	//$query1=mysqli_query($conn, "select districtCode from tbl_districts where districtId='".$row["districtId"]."'") ;
	//$row1 = mysqli_fetch_assoc($query1);
	$notif = ($row["enableNotification"]=="1")?"تمكين<br/>":"معاق<br/>";
	$notif .= "<a href='not_cust_list.php?cid=".$encodedId."'>عرض الإشعارات</a>";
	$nestedData=array(); 
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$encodedId."'  />" ;
	$nestedData[] = '<span style="margin-left:10px"><a target="_blank" href="order_list.php?custId='.$encodedId.'">'.$row["custId"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["fullName"].'</span>';
	$nestedData[] = '<span style="margin-left:05px">'.$row["phone"].'</span>';
	$nestedData[] = '<span style="margin-left:05px">'.date("d/m/Y",$row["createdTimestamp"]).'</span>';
	//$nestedData[] = '<span style="margin-left:5px">'.$row["remainBalance"].$reduceBalance.'</span>';
	$nestedData[] = '<span style="margin-left:5px">'.$row["purchasePoints"].$btnRedeem.'</span>';
	$nestedData[] = $notif;
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
