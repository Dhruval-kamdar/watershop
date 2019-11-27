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
	0 =>'prdName'
	//1 => 'prdType',
	//2=> 'prdQty',
	//3 =>'prdUnitPrice'
	
);

// getting total number records without any search
$sql = "SELECT prdId ";
$sql.=" FROM tbl_products WHERE isDeleted='0'";
$query=mysqli_query($conn, $sql) or die("products_grid.php: get products");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM tbl_products WHERE isDeleted='0'";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( prdName LIKE '".$requestData['search']['value']."%' ";    
	//$sql.=" OR prdQty LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR prdUnitPrice LIKE '".$requestData['search']['value']."%' )";
	
}
$query=mysqli_query($conn, $sql) or die("products_grid.php: get products");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($conn, $sql) or die("products_grid.php: get products");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$message = "Are you sure to delete record ?";
	$currStatus = ($row['isActive']=="1")?"Active":"Deactive";
	$editurl = "add_product.php" . $urltoadd . ($urltoadd != "" ? "&prdId=" . $converter->encode($row["prdId"]) : "?prdId=" . $converter->encode($row["prdId"]));
	$encodedId = $converter->encode($row["prdId"]);
	$qtyUnits = json_decode($row["qtyUnits"]);
	$query1 = mysqli_query($conn,"select prdType from tbl_product_types where prdTypeId='".$row["prdTypeId"]."'");
	$row1 =mysqli_fetch_array($query1);
	$query2 = mysqli_query($conn,"select qtyUnit from tbl_qty_units where qtyUnitId='".$row['qtyUnitId']."'");
	$row2 =mysqli_fetch_array($query2);
	$nestedData=array(); 
	
	//$nestedData[] = "&nbsp;&nbsp;&nbsp;<input type='checkbox'  class='deleteRow center' value='".$converter->encode($row["prdId"])."'  />" ;
	$nestedData[] = '<input type="text" name="prdName" id="prdName_'.$encodedId.'" value="'.$row["prdName"].'" required>';
											$nestedData1[] = '
					
											<select  name="prdTypeId" id="prdTypeId_'.$encodedId.'" required >';
											$type_query = mysqli_query($conn,"SELECT * FROM tbl_product_types WHERE isActive='1' AND isDeleted='0' AND prdType!='' ORDER BY prdType");
												while ($type = mysqli_fetch_assoc($type_query))
                                                    {
														if($row["prdTypeId"]==trim($type["prdTypeId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												
													$nestedData1[] .= '<option value="'.$type["prdTypeId"].'" '.$isSelected.'  >'.$type["prdType"].'</option>';
													}
													$nestedData1[] .='</select>';
												$nestedData[] = $nestedData1;
												$nestedData1="";
												$nestedData1[] = '
					
												<select  name="companyId" id="companyId_'.$encodedId.'" required >';
												$cmp_query = mysqli_query($conn,"SELECT * FROM tbl_companies WHERE isActive='1' AND isDeleted='0' AND companyName!='' ORDER BY companyName");
												while ($cmp = mysqli_fetch_assoc($cmp_query))
                                                    {
														if($row["companyId"]==trim($cmp["companyId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												
													$nestedData1[] .= '<option value="'.$cmp["companyId"].'" '.$isSelected.'  >'.$cmp["companyName"].'</option>';
													}
													$nestedData1[] .='</select>';
													
												$nestedData[] = $nestedData1;	
												$nestedData1="";
												$i=0;
												$units_query = mysqli_query($conn,"SELECT * FROM tbl_qty_units WHERE isActive='1' AND isDeleted='0'  ORDER BY `order`");
												while ($unit = mysqli_fetch_assoc($units_query))
                                                    {
														if($qtyUnits[$i]->qtyUnitId==$unit["qtyUnitId"])
														$prdUnitPrice = $qtyUnits[$i]->prdUnitPrice;
														else
														$prdUnitPrice = "";	
												
													$nestedData1 .= '<label class="col-lg-2 control-label">'.$unit["qtyUnit"].'</label>
													<input type="text" name="prdUnitPrice[]" id="prdUnitPrice_'.$encodedId.'" value="'.$prdUnitPrice.'" class="Price_'.$encodedId.'" />
													<input type="hidden" name="qtyUnitId[]" id="qtyUnitId_'.$encodedId.'" value="'. $unit["qtyUnitId"].'" class="UnitId_'.$encodedId.'" />
													<input type="hidden" name="qtyUnit[]" id="qtyUnit_'.$encodedId.'" value="'.$unit["qtyUnit"].'" class="Unit_'.$encodedId.'" /><br>';
													$i++;
													}
													
													$nestedData[] ='<div style="width:130%">'. $nestedData1. '</div>';
													$nestedData1="";
	
	$nestedData[] = '<a class="ViewDialog btn btn-xs btn-success" data-id="'.$converter->encode($row["prdId"]).'" href="#viewModel" data-toggle="modal">عرض</a>
	<a onclick=Updates("'.$encodedId.'","update") title="تعديل" ><button class="btn btn-xs btn-success">تعديل</button></a>';
			
	
	
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
