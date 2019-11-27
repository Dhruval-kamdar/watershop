<?php
include("../include/config.inc.php");
include("session.php");
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column AdminName
	//1 =>'districtCode',
	1 =>'AdminEmail' ,
	2 =>'AdminName',
	3=> 'AdminRole',
	4=> 'created'
);
mysqli_query($dbConn,"SET NAMES 'utf8'");   
// getting total number records without any search
$sql = "SELECT AdminId ";
$sql.=" FROM tbl_admin WHERE isDeleted='0' AND AdminRole!='super_admin'";
$query=mysqli_query($dbConn, $sql) or die("admin_grid.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT * ";
$sql.=" FROM tbl_admin  WHERE isDeleted='0' AND AdminRole!='super_admin'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( AdminEmail LIKE '%".$requestData['search']['value']."%' ";	
	$sql.=" OR AdminName LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR AdminRole LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR created LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($dbConn, $sql) or die("admin_grid.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($dbConn, $sql) or die("admin_grid.php: get employees");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$encodedId = $converter->encode($row["AdminId"]);
	$editurl = "add_admin.php" . $urltoadd . ($urltoadd != "" ? "&AdminId=" . $encodedId : "?AdminId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	
	//if($_SESSION[SESSION_NAME . "role"]=="super_admin")
	$prvlButton = '<a class="demoDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#demoModel" data-toggle="modal">الصلاحيات</a>&nbsp;';
	
	//if($_SESSION[SESSION_NAME . 'edit_admin_prvl']=='1')
	$editButton = '<a href="'.$editurl.'" title="تحرير" ><button class="btn btn-xs btn-success">تحرير</button></a>&nbsp;';
	//else
	//$editButton = '';
	
	if($row['AdminRole']!="super_admin")
	$delButton = '<a data-id="'.$encodedId.'" class="btnDelete btn btn-xs btn-danger" >حذف</a>';
	else
	$delButton = '';
		
	$nestedData=array(); 
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$encodedId."'  />" ;
	$nestedData[] = $row["AdminEmail"];
	$nestedData[] = $row["AdminName"];
	$nestedData[] = ucfirst(str_replace("_"," ",$row["AdminRole"]));
	$nestedData[] = date("Y-m-d H:i",strtotime($row["created"]));
	//if($_SESSION[SESSION_NAME . 'status_admin_prvl']=='1')
	{
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";
	}
	// $nestedData[] = $prvlButton.'<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">عرض</a>&nbsp;'.$editButton.$delButton;
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$encodedId.'" href="#viewModel" data-toggle="modal">عرض</a>&nbsp;'.$editButton.$delButton;
	
	
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
