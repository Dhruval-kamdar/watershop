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
	if(is_numeric($_POST['user_id']))
	$user_id = $_POST['user_id'];
	//else
	//$err="Required parameter - user_id";

	if($_REQUEST['trip_type']!='')
	$trip_type = $_REQUEST['trip_type'];
	else
	$err="Required parameter - trip_type";

	if($_POST['search_txt']!='')
	{	
		$txt = mysqli_real_escape_string($dbConn, $_POST['search_txt']);
	  	$where = " t.trip_name LIKE '".$txt."%' AND ";
	}
	
	if($_POST['trip_price']!='' && $_POST['trip_price']!='0')
	{	
		$trip_price = $_POST['trip_price'];
		$where .= " t.trip_price <=".$trip_price . " AND ";
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
		$min = 0;
		$max = 0;
		$sql1 = $conn->get_record_set("SELECT * FROM `tbl_trips` t WHERE $where trip_type='$trip_type' AND is_active='1' AND is_deleted='0' $orderBy");
		$rows1 = $conn->records_to_array($sql1);
		if(!empty($rows1))
		{
			foreach($rows1 as $row1)
			{
				if (!filter_var($row1['trip_photo'], FILTER_VALIDATE_URL) === false)
				$row1['trip_photo'] = $row1['trip_photo'];
				else
				$row1['trip_photo'] = ($row1['trip_photo']!='')?PHOTO_URL."trip/150x150/".$row1['trip_photo']:"";

				if($user_id >0)
				{	
					$fav = $data->select( "tbl_favorite_trips", "*" , array("trip_id"=>$row1['trip_id'],"user_id"=>$user_id,"is_deleted"=>"0"));
					$row1['is_favorite'] = (!empty($fav[0]))?"1":"0";			
				}
				else
				{
					$row1['is_favorite'] = "0";
				}
				$d1[] = $row1;
				$min = ($row1['trip_price'] <$min || $min==0)?$row1['trip_price']:$min;
				$max = ($row1['trip_price'] >$max)?$row1['trip_price']:$max;
			}
			$jsonArray['Success']='1';
			$jsonArray['Message']=$lang["SUCCESSFUL"];
		}
		else
		{
			$jsonArray['Success']='0';
			$jsonArray['Message']=$lang["NO_DATA_FOUND"];
		}

	/*$sqlMin = $conn->get_record_set("SELECT MIN(trip_price) AS min_price FROM `tbl_trips` t WHERE is_active='1' AND is_deleted='0'");
	$min = $conn->records_to_array($sqlMin);
	$sqlMax = $conn->get_record_set("SELECT MAX(trip_price) AS max_price FROM `tbl_trips` t WHERE is_active='1' AND is_deleted='0'");
	$max = $conn->records_to_array($sqlMax);
	
	$jsonArray['MinPrice']=$min[0]['min_price'];
	$jsonArray['MaxPrice']=$max[0]['max_price'];*/
    $jsonArray['Details']=$d1;
	$d='';
	show_output($jsonArray);
