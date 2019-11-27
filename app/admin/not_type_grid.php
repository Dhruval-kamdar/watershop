<?php
include_once("../include/config.inc.php");
include_once("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	1 =>'notTypeTitle',
	2=> 'notTypeApp',
);

// getting total number records without any search
$sql = "SELECT notTypeId ";
$sql.=" FROM tbl_notification_types WHERE isDeleted='0' AND isVisible='1'";
$query=mysql_query($sql) or die("not_type_grid.php: get products");
$totalData = mysql_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM tbl_notification_types WHERE 1=1 AND (isDeleted='0' AND isVisible='1')";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( notTypeTitle LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR notTypeApp LIKE '".$requestData['search']['value']."%' )";
	//$sql.=" OR prdUnitPrice LIKE '".$requestData['search']['value']."%' )";
	
}
$query=mysql_query($sql) or die("not_type_grid.php: get products");
$totalFiltered = mysql_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysql_query($sql) or die("not_type_grid.php: get products");

$data = array();
$i=1+$requestData['start'];
while( $row=mysql_fetch_array($query) ) {  // preparing an array
	
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$editurl = "add_not_type.php" . $urltoadd . ($urltoadd != "" ? "&notTypeId=" . $converter->encode($row["notTypeId"]) : "?notTypeId=" . $converter->encode($row["notTypeId"]));
	$encodedId = $converter->encode($row["notTypeId"]);
	$nestedData=array(); 
	
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["notTypeId"])."'  />" ;
	$nestedData[] = $row["notTypeTitle"];  
	$nestedData[] = $row["notTypeApp"];
	$nestedData[] = '<img src="../uploads/icons/'.$row['notTypeIcon'].'" width=30 height=30>';
	
	
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >نشط</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >غير نشط</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["notTypeId"]).'" href="#viewModel" data-toggle="modal"><i class="icon-trash icon-white"></i>عرض</a>
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
