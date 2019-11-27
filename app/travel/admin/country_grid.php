<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	1 => 'country_iso',
	2 => 'country_name'
);
$sql = "SELECT country_id ";
$sql.=" FROM tbl_countries WHERE is_deleted='0'";
$query=mysqli_query($dbConn, $sql) or die("country_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_countries WHERE 1=1 AND (is_deleted='0')";
if( !empty($requestData['search']['value']) ) {
	$sql.=" AND ( country_name LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR country_iso LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($dbConn, $sql) or die("country_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	
$query=mysqli_query($dbConn, $sql) or die("country_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";	
	$encodedId = $converter->encode($row["country_id"]);
	$currStatus = ($row['is_active']=="1")?"Active":"Deactive";
	$editurl = "add_country.php" . $urltoadd . ($urltoadd != "" ? "&country_id=" . $encodedId : "?country_id=" . $encodedId);
	$query1 = mysqli_query($dbConn,"select continent_name from tbl_continents where continent_id='".$row["continent_id"]."'");
	$row1 =mysqli_fetch_array($query1);
	$nestedData=array(); 
	$isChecked = (($row['deliveryFee']=='0')?'checked':'');
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$row["country_id"]."'  />" ;
	$nestedData[] = "<span style='margin-left:25px;'>".$row["country_iso"]."</span>";
	$nestedData[] = "<span style='margin-left:20px;'>".$row["country_name"]."</span>";
	$nestedData[] = '<span style="margin-left:20px">'.$row1["continent_name"].'</span>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$row["country_id"]."','active') >Active</a></li>
												<li><a onclick=updateStatus('".$row["country_id"]."','deactive') >Deactive</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">View</a>
	<a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>
	<a data-id="'.$row["country_id"].'" class="btnDelete btn btn-xs btn-danger" >Delete</a>';
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
