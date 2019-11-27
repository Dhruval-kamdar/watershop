<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$requestData= $_REQUEST;
$columns = array( 
	1=> 'districtCode',
	2 => 'districtName'
);
$sql = "SELECT districtId ";
$sql.=" FROM tbl_districts WHERE isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("district_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_districts WHERE 1=1 AND (isDeleted='0')";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( districtName LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR districtCode LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("district_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
$query=mysqli_query($conn, $sql) or die("district_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";	
	$encodedId = $converter->encode($row["districtId"]);
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$editurl = "add_district.php" . $urltoadd . ($urltoadd != "" ? "&districtId=" . $encodedId : "?districtId=" . $encodedId);
	$query1 = mysqli_query($conn,"select cityName from tbl_cities where cityId='".$row["cityId"]."'");
	$row1 =mysqli_fetch_array($query1);
	$nestedData=array(); 
	$isChecked = (($row['deliveryFee']=='0')?'checked':'');
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$row["districtId"]."'  />" ;
	$nestedData[] = "<span style='margin-left:25px;'>".$row["districtCode"]."</span>";
	$nestedData[] = "<span style='margin-left:20px;'>".$row["districtName"]."</span>";
	$nestedData[] = '<span style="margin-left:20px">'.$row1["cityName"].'</span>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$row["districtId"]."','active') >Active</a></li>
												<li><a onclick=updateStatus('".$row["districtId"]."','deactive') >Deactive</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a>
	<a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>
	<a data-id="'.$row["districtId"].'" class="btnDelete btn btn-xs btn-danger" >Delete</a>';
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
