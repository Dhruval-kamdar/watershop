<?php
	require_once("include/config.php");
	require_once("include/init.php");
	
	if($language == 'en')
		require_once('lang/en.php');
	elseif($language == 'ar')
		require_once('lang/ar.php');
	else
		require_once('lang/en.php');
	
	$conn=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	$row2 = array();	
	$disTabs = array();
	$d1= array();
	if($_POST['user_id']!='')
	$user_id = $_POST['user_id'];
	else
	$err="Required parameter - user_id";

	/*if($_POST['trip_type']!='')
	$trip_type = $_POST['trip_type'];
	else
	$err="Required parameter - trip_type";*/

	if($_POST['search_txt']!='')
	{	
		$txt = mysqli_real_escape_string($dbConn, $_POST['search_txt']);
	  	$where = " (t.trip_name LIKE '".$txt."%') AND ";
	}
	
	if(is_numeric($_POST['trip_price']))
	{	
		$trip_price = $_POST['trip_price'];
		$where .= " t.trip_price <=".$trip_price;
	}
	
	if($_POST['trip_continent']!='')
	{	
		$trip_continent = $_POST['trip_continent'];
		$where .= " t.trip_continent ='".$trip_continent."' AND ";
	}
	
	if($_POST['trip_country']!='')
	{	
		$trip_country = $_POST['trip_country'];
		$where .= " t.trip_country ='".$trip_country."' AND ";
	}
	
	if($_POST['trip_city']!='')
	{	
		$trip_city = $_POST['trip_city'];
		$where .= " t.trip_city ='".$trip_city."' AND ";
	}
	
	if(is_numeric($_POST['trip_rating']))
	{	
		$trip_rating = $_POST['trip_rating'];
		$where .= " t.trip_rating >='".$trip_rating."' AND ";
	}
	
	$orderBy = " ORDER BY t.trip_name";	
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray); 
	}
	
	
		//$sql1 = $conn->get_record_set("SELECT t.* FROM `tbl_trips` t WHERE $where t.trip_type='$trip_type' AND t.is_active='1' AND t.is_deleted='0' $orderBy");
		$sql1 = $conn->get_record_set("SELECT t.* FROM `tbl_trips` t INNER JOIN `tbl_favorite_trips` f ON t.trip_id=f.trip_id WHERE 
		$where f.user_id='".$user_id."' AND t.is_active='1' AND t.is_deleted='0' $orderBy");
		$rows1 = $conn->records_to_array($sql1);
		foreach($rows1 as $row1)
		{
			if (!filter_var($row1['trip_photo'], FILTER_VALIDATE_URL) === false)
			$row1['trip_photo'] = $row1['trip_photo'];
			else
			$row1['trip_photo'] = ($row1['trip_photo']!='')?PHOTO_URL."trip/150x150/".$row1['trip_photo']:"";
			$fav = $data->select( "tbl_favorite_trips", "*" , array("trip_id"=>$row1['trip_id'],"user_id"=>$user_id,"is_deleted"=>"0"));
			$row1['is_favorite'] = (!empty($fav[0]))?"1":"0";			
			$d1[] = $row1;
		}
		$d=array();
	
	
	$jsonArray['Success']='1';
	$jsonArray['Message']=$lang["SUCCESSFUL"];
    $jsonArray['Details']=$d1;
	$d='';
	show_output($jsonArray);
