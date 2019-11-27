<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	1 => 'arrival_location',
	2 => 'address'
);
$sql = "SELECT arrival_id ";
$sql.=" FROM tbl_arrival_locations WHERE is_deleted='0'";
$query=mysqli_query($dbConn, $sql) or die("arrival_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_arrival_locations WHERE is_deleted='0'";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( address LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR arrival_location LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($dbConn, $sql) or die("arrival_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
$query=mysqli_query($dbConn, $sql) or die("arrival_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";	
	$encodedId = $converter->encode($row["arrival_id"]);
	$currStatus = ($row['is_active']=="1")?"Active":"Deactive";
	$editurl = "add_arrival.php" . $urltoadd . ($urltoadd != "" ? "&arrival_id=" . $encodedId : "?arrival_id=" . $encodedId);
	$query1 = mysqli_query($dbConn,"select country_name from tbl_countries where country_id='".$row["country_id"]."'");
	$row1 =mysqli_fetch_array($query1);
	$nestedData=array(); 
	$isChecked = (($row['deliveryFee']=='0')?'checked':'');
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$row["arrival_id"]."'  />" ;
	$nestedData[] = "<span style='margin-left:10px;'>".$row["arrival_location"]."</span>";
	$nestedData[] = "<span style='margin-left:10px;'>".$row["address"]."</span>";
	$nestedData[] = '<span style="margin-left:10px">'.$row1["country_name"].'</span>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$row["arrival_id"]."','active') >Active</a></li>
												<li><a onclick=updateStatus('".$row["arrival_id"]."','deactive') >Deactive</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a>
	<a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>
	<a data-id="'.$row["arrival_id"].'" class="btnDelete btn btn-xs btn-danger" >Delete</a>';
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
