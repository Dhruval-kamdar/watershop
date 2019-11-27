<?php
include("../include/config.inc.php");
include("session.php");
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	
	1 => 'driverName',
	2=> 'username',
	3=> 'email',
	4 =>'phone'
	
);

// getting total number records without any search
$sql = "SELECT driverId ";
$sql.=" FROM tbl_drivers WHERE isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("driver_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM tbl_drivers WHERE 1=1 AND (isDeleted='0')";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( driverName LIKE '".$requestData['search']['value']."%' ";  
	$sql.=" OR username LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR phone LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR driverId LIKE '".$requestData['search']['value']."%' ";
}
$query=mysqli_query($conn, $sql) or die("driver_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("driver_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$editurl = "add_driver.php" . $urltoadd . ($urltoadd != "" ? "&driverId=" . $converter->encode($row["driverId"]) : "?driverId=" . $converter->encode($row["driverId"]));
	$encodedId = $converter->encode($row["driverId"]);
	$nestedData=array(); 

	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["driverId"])."'  />" ;
	$nestedData[] = $row["driverName"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["phone"];
	$nestedData[] = '<a  href="driver_hist.php?id='.$encodedId.'" style="text-decoration:underline" >Click Here</a>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["driverId"]).'" href="#viewModel" data-toggle="modal"><i class="icon-trash icon-white"></i>عرض</a>
	<a href="'.$editurl.'" title="تصحيح" ><button class="btn btn-xs btn-success">تعديل</button></a>
	<a data-id="'.$encodedId.'" class="btnDelete btn btn-xs btn-danger" >حذف</a>';
				
	
	
	$data[] = $nestedData;
	$i++;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
