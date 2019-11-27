<?php 
include("../include/config.inc.php");
include("session.php");
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) ;
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	1 =>'id' ,
	2 =>'name',
	3 =>'phone',
	4 =>'email',
	5 =>'created',
);
$sql = "SELECT c.id ";
$sql.=" FROM tbl_contact_companies c WHERE type='contactUs' AND isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("contactus_grid.php: get employees1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 


$sql = "SELECT c.*";
$sql.=" FROM tbl_contact_companies c WHERE type='contactUs' AND isDeleted='0'";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR phone LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR created LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("contactus_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("contactus_grid.php: get employees3");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["id"]);
	$editurl = "add_contactus.php" . $urltoadd . ($urltoadd != "" ? "&id=" . $encodedId : "?id=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$nestedData=array(); 
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$encodedId."'  />" ;
	$nestedData[] = '<span style="margin-left:10px">'.$row["id"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["name"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["phone"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row["email"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.datFormat($row["created"]).'</span>';
	/*$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";*/
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">عرض</a>
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
