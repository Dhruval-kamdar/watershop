<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error()); 
$requestData= $_REQUEST;
$columns = array( 
	1=> 'startTime',
	2 => 'endTime'
);
$sql = "SELECT timeId ";
$sql.=" FROM tbl_delivery_times WHERE isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("deliverytime_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
$sql = "SELECT * ";
$sql.=" FROM tbl_delivery_times WHERE isDeleted='0'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( endTime LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR startTime LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("deliverytime_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("deliverytime_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";	
	$encodedId = $converter->encode($row["timeId"]);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$editurl = "add_deliverytime.php" . $urltoadd . ($urltoadd != "" ? "&timeId=" . $encodedId : "?timeId=" . $encodedId);
	$nestedData=array(); 
	$isChecked = (($row['deliveryFee']=='0')?'checked':'');
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$row["timeId"]."'  />" ;
	$nestedData[] = "<span style='margin-left:10px;'>".$row["startTime"]."-".$row["endTime"]."</span>";
	$nestedData[] = "<span style='margin-left:10px;'>".date("d/m/Y",$row["createdTimestamp"])."</span>";
	 
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$row["timeId"]."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$row["timeId"]."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";
	/*$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">عرض</a>';*/
	$nestedData[] = '<a href="'.$editurl.'" title="تصحيح" ><button class="btn btn-xs btn-success">تعديل</button></a>
	<a data-id="'.$row["timeId"].'" class="btnDelete btn btn-xs btn-danger" >حذف</a>';
	$data[] = $nestedData;
	$i++;
}
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
