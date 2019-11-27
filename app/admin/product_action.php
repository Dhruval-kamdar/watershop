<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if($_REQUEST['action']=='active')
{
	$field = 'isActive=1';
}
elseif($_REQUEST['action']=='deactive')
{
	$field = 'isActive=0';
}
elseif($_REQUEST['action']=='update')
{
	$myfilter   = new inputfilter();
	foreach($_REQUEST["qtyUnitId"] as $key=>$val)
	{
			$d["qtyUnitId"] = $_REQUEST["qtyUnitId"][$key];
			$d["qtyUnit"] = ($_REQUEST["qtyUnit"][$key]);
			$d["prdUnitPrice"] = $_REQUEST["prdUnitPrice"][$key];
			$d1[]=$d;
	}
	$qtyUnits =  addslashes(json_encode($d1));  
	$field = "prdName='".$_REQUEST["prdName"]."'";
	$field .= ",companyId='".$_REQUEST["companyId"]."'";
	$field .= ",prdTypeId='".$_REQUEST["prdTypeId"]."'";
	$field .= ",qtyUnits='$qtyUnits'";
}
else
{
	$field = 'isDeleted=1';
}

	if(!empty($data_id_array)) {
		foreach($data_id_array as $id) {
			$sql = "UPDATE tbl_products SET $field ";
			$sql.=" WHERE prdId = '".$converter->decode($id)."'";
			$query=mysqli_query($conn, $sql) or die("product_action.php: delete employees");
		}
	}
?>