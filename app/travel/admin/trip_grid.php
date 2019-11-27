<?php
include_once("../include/config.inc.php");
include_once("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();

if($_SESSION['filter_trip_type']!='')
$where = " trip_type='". $_SESSION['filter_trip_type']. "' AND ";
else
$where = "";

$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	1 =>'trip_type',
	2 =>'trip_name',
	3 =>'trip_price',
);

// getting total number records without any search
$sql = "SELECT trip_id ";
$sql.=" FROM tbl_trips p WHERE $where p.is_deleted='0'";
$query=mysqli_query($dbConn,$sql) or die("trip_grid.php: get products");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT p.* ";
$sql.=" FROM tbl_trips p WHERE $where p.is_deleted='0'";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( trip_type LIKE '".$requestData['search']['value']."%' ";  
    $sql.=" OR trip_name LIKE '".$requestData['search']['value']."%' ";		
	$sql.=" OR trip_country LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($dbConn,$sql) or die("trip_grid.php: get products");
$totalFiltered = mysqli_num_rows($query);

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($dbConn,$sql) or die("trip_grid.php: get products");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$encodedId = $converter->encode($row["trip_id"]);
	$currStatus = ($row['is_active']=="1")?"Active":"Deactive";
	$editurl = "add_trip.php" . $urltoadd . ($urltoadd != "" ? "&trip_id=" . $encodedId : "?trip_id=" . $encodedId);
	
	$query1 = mysqli_query($dbConn,"select country_name from tbl_countries where trip_country='".$row["trip_country"]."'");
	$row1 =mysqli_fetch_array($query1);
	$nestedData=array(); 
	
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$encodedId."'  />" ;
	$nestedData[] = "<span style='margin-left:10px;'>".ucfirst($row["trip_type"])."</span>"; 
	$nestedData[] = "<span style='margin-left:10px;'>".$row["trip_name"]."</span>"; 
	$nestedData[] = "<span style='margin-left:10px;'>".$row["trip_price"]."</span>";
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >Active</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >Deactive</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a>
	<a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>
	<a data-id="'.$encodedId.'" class="btnDelete btn btn-xs btn-danger" >Delete</a>';
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
