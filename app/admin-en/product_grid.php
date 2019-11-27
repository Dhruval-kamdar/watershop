<?php
include_once("../include/config.inc.php");
include_once("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$requestData= $_REQUEST;
$columns = array( 
	1 =>'prdName',
	2 => 'prdTypeId',
	3 => 'companyId'
);

// getting total number records without any search
$sql = "SELECT prdId ";
$sql.=" FROM tbl_products WHERE isDeleted='0'";
$query=mysqli_query($conn,$sql) or die("product_grid.php: get products");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 
$sql = "SELECT * ";
$sql.=" FROM tbl_products WHERE isDeleted='0'";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( prdName LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR prdTypeId LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn,$sql) or die("product_grid.php: get products");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn,$sql) or die("product_grid.php: get products");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$editurl = "add_product.php" . $urltoadd . ($urltoadd != "" ? "&prdId=" . $converter->encode($row["prdId"]) : "?prdId=" . $converter->encode($row["prdId"]));
	$encodedId = $converter->encode($row["prdId"]);
	
	$query1 = mysqli_query($conn,"select prdType from tbl_product_types where prdTypeId='".$row["prdTypeId"]."'");
	$row1 =mysqli_fetch_array($query1);
	$query2 = mysqli_query($conn,"select companyName from tbl_companies where companyId='".$row['companyId']."'");
	$row2 =mysqli_fetch_array($query2);
	$nestedData=array(); 
	
	$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["prdId"])."'  />" ;
	$nestedData[] = '<span style="margin-left:5px">'.$row["prdName"].'</span>'; 
	$nestedData[] = '<span style="margin-left:10px">'.$row1["prdType"].'</span>';
	$nestedData[] = '<span style="margin-left:10px">'.$row2["companyName"].'</span>';
	$nestedData[] = "<div class='btn-group'>
											  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown'>
												<i class='fa1 fa-cog1'></i> $currStatus <span class='caret'></span>
											  </button>
											  <ul class='dropdown-menu primary' role='menu'>
												<li><a onclick=updateStatus('".$encodedId."','active') >Active</a></li>
												<li><a onclick=updateStatus('".$encodedId."','deactive') >Deactive</a></li>
											  </ul>
											</div>";
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["prdId"]).'" href="#viewModel" data-toggle="modal"><i class="icon-trash icon-white"></i> View</a>
	<a href="'.$editurl.'" title="Edit" ><button class="btn btn-xs btn-success">Edit</button></a>
	<a data-id="'.$encodedId.'" class="btnDelete btn btn-xs btn-danger" >Delete</a>';
	$data[] = $nestedData;
	$i++;
}
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ), 
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data  
			);
echo json_encode($json_data);  

?>
