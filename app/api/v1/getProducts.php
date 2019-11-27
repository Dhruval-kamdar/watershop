<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	$row2 = array();	
	$disTabs = array();
	$d1= array();
	if($_REQUEST['custId']!='')
	$custId = $_REQUEST['custId'];
	else
	$err="Required parameter - custId"; 

	if($_REQUEST['searchTxt']!='')
	{	
		$txt = mysql_real_escape_string($_REQUEST['searchTxt']);
	  	$where = " (p.prdName LIKE '".$txt."%' OR cm.companyName LIKE '".$txt."%') AND ";
	}
	//$cust = $data->select( "tbl_customers" , "cityId",array("custId"=>$custId));	
	//$where .= " cm.cityId='".$cust[0]['cityId']."' AND "; // list those companies products which are belogs to cust city
	
	if(is_numeric($_REQUEST['priceFilter']))
	{	
		$priceFilter = $_REQUEST['priceFilter'];
	}
	if($_REQUEST['sortBy']=='companyName')
	$orderBy = " ORDER BY cm.companyName";
	elseif($_REQUEST['sortBy']=='prdName')
	$orderBy = " ORDER BY p.prdName";
	elseif($_REQUEST['sortBy']=='prdType')
	$orderBy = " ORDER BY pt.prdType";
	//elseif($_REQUEST['sortBy']=='cityName')
	//$orderBy = " ORDER BY ct.cityName";
	else	
	$orderBy = " ORDER BY p.prdName";	
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
		/*$sql1 = $conn->get_record_set("SELECT p.prdId,p.prdName,p.prdImage,p.qtyUnits FROM `tbl_products` p LEFT JOIN `tbl_product_types` pt ON p.prdTypeId=pt.prdTypeId LEFT JOIN `tbl_companies` cm ON p.companyId=cm.companyId LEFT JOIN `tbl_cities` ct ON cm.cityId=ct.cityId WHERE $where p.isActive='1' AND p.isDeleted='0' AND pt.isActive='1' AND pt.isDeleted='0' AND cm.isActive='1' AND cm.isDeleted='0' AND ct.isActive='1' AND ct.isDeleted='0' $orderBy");*/
		$sql1 = $conn->get_record_set("SELECT p.prdId,p.prdName,p.prdImage,p.qtyUnits FROM `tbl_products` p LEFT JOIN `tbl_product_types` pt ON p.prdTypeId=pt.prdTypeId LEFT JOIN `tbl_companies` cm ON p.companyId=cm.companyId WHERE $where p.isActive='1' AND p.isDeleted='0' AND pt.isActive='1' AND pt.isDeleted='0' AND cm.isActive='1' AND cm.isDeleted='0' $orderBy");
		$rows1 = $conn->records_to_array($sql1);
		foreach($rows1 as $row1)
		{
			$q1 = array();
			$qtyUnits = json_decode($row1['qtyUnits']);
			foreach($qtyUnits as $qty)
			{
				if($qty->prdUnitPrice > 0)
				{
					$d["qtyUnitId"] = $qty->qtyUnitId;
					$d["qtyUnit"] = $qty->qtyUnit;
					$d["prdUnitPrice"] = $qty->prdUnitPrice;
					$q1[]=$d;
				}
			}
			$row1['qtyUnits'] =  json_encode($q1);

			if (!filter_var($row1['prdImage'], FILTER_VALIDATE_URL) === false)
			$row1['prdImage'] = $row1['prdImage'];
			else
			$row1['prdImage'] = ($row1['prdImage']!='')?PRD_IMAGE.$row1['prdImage']:"";
			$fav = $data->select( "tbl_favorites", "*" , array("prdId"=>$row1['prdId'],"custId"=>$custId));
			//$row1['isFavorite'] = (!empty($fav[0]))?"1":"0";
			$row1['isFavorite'] = "0";
			$Show = false;
			$units = json_decode($row1['qtyUnits']);
			foreach($units as $u)
			{
				if($minPrice=='') $minPrice = $u->prdUnitPrice;
				if($maxPrice=='') $maxPrice = $u->prdUnitPrice;
				$minPrice = ($u->prdUnitPrice!='' && $u->prdUnitPrice <$minPrice)?$u->prdUnitPrice:$minPrice;
				$maxPrice = ($u->prdUnitPrice!='' && $u->prdUnitPrice >$maxPrice)?$u->prdUnitPrice:$maxPrice;
				if($u->prdUnitPrice!='' && $u->prdUnitPrice<=$priceFilter)
				$Show = true;	
			}
			if($priceFilter!='' && $Show)
			$d1[] = $row1;
			elseif($priceFilter=='')
			$d1[] = $row1;
		}
		$d=array();
	
	
	$jsonArray['Success']='1';
	$jsonArray['Message']="List of product(s)";
	$jsonArray['currency_sign']=CURRENCY_SIGN;
	$jsonArray['minPrice']=floor($minPrice);
	$jsonArray['maxPrice']=ceil($maxPrice);
    $jsonArray['detail']=$d1;
	$d='';
	show_output($jsonArray);
