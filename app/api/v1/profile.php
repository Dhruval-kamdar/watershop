<?php
require_once("include/config.php");
require_once("include/init.php");

$conn=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['districtId']!='')
	$postdata['districtId'] = $_REQUEST['districtId'];

if($_REQUEST['cityId']!='')
	$postdata['cityId'] = $_REQUEST['cityId'];
		
if($_REQUEST['street']!='')
	$postdata['street'] = $_REQUEST['street'];
		
if($_REQUEST['building']!='')
	$postdata['building'] = $_REQUEST['building'];

if($_REQUEST['houseNo']!='')
	$postdata['houseNo'] = $_REQUEST['houseNo'];

if($_REQUEST['latitude']!='')
	$postdata['latitude'] = $_REQUEST['latitude'];

if($_REQUEST['longitude']!='')
	$postdata['longitude'] = $_REQUEST['longitude'];	
	
if($_REQUEST['username']!='')
        $postdata['username'] = $_REQUEST['username'];

if($_REQUEST['phone']!='')
	$postdata['phone'] = $_REQUEST['phone'];

if($_REQUEST['email']!='')
	$postdata['email'] = $_REQUEST['email'];

if($_REQUEST['fullName']!='')
	$postdata['fullName'] = $_REQUEST['fullName'];	

if($_REQUEST['custId']!='')
	$custId = $_REQUEST['custId'];
else
	$err = "Required paramater - custId";

	$dist = $data->select( "tbl_districts" , "districtCode,districtName",array("districtId"=>$postdata['districtId']) );	
	$city = $data->select( "tbl_cities" , "cityCode,cityName",array("cityId"=>$postdata['cityId']) );	
	
	if($_REQUEST['address']!='')
	{
		$postdata['address'] = mysqli_real_escape_string($dbConn,$_REQUEST['address']);
	}	
	else
	{
		if($postdata['houseNo']!='')
		$postdata['address'] .= ' '.$_REQUEST['houseNo'];	
		if($postdata['building']!='')
		$postdata['address'] .= ' '.$_REQUEST['building'];	
		if($postdata['street']!='')
		$postdata['address'] .= ' '.$_REQUEST['street'];	
		if($postdata['districtId']!='')
		$postdata['address'] .= ', '.$dist[0]['districtName'];
		if($postdata['cityId']!='')
		$postdata['address'] .= ', '.$city[0]['cityName'];	
	}
if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	

if(!empty($_FILES['profilePic']['name']))
{
	$path= '../../uploads/profile/';
	$userf = $_FILES['profilePic']['tmp_name'];
	$str = explode(".",$_FILES['profilePic']['name']);
	$l=count($str);
	$img =  time()."_profilepic.".$str[$l-1];
	if(move_uploaded_file($userf,$path.$img))
	{
		$postdata['profilePic'] =$img;
		createthumb($path . $img, $path.'200x200/'.$img,200,200);	
	}
}
	
if(!empty($postdata))
{
	$sql = $conn->get_record_set("select * from `tbl_customers` where custId='".$custId."'");
	$row = $conn->records_to_array($sql);
	
	if(!empty($row))
	{	
		if($postdata['username']!='' && $postdata['email']=='')
		{
			$sql = $conn->get_record_set("select * from tbl_customers where LOWER(username)='".strtolower($postdata['username'])."' and isDeleted='0' AND custId!='".$custId."'");
			$rows = $conn->records_to_array($sql);
			if(empty($rows))
			{
				//if($_REQUEST['action']=='update')
				$data->update("tbl_customers" , $postdata,array("custId"=>$custId));
				$jsonArray['Success']='1';
				$jsonArray['Message']="تم تحديث الملف الشخصي بنجاح";
				$record = $conn->get_record_set("select * from `tbl_customers` where custId='".$custId."'");
				$rows = $conn->records_to_array($record);
				foreach($rows as $row)
				{	
					$row['password']='';
					if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
					$row['profilePic'] = $row['profilePic'];
					else
					$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
					$jsonArray['detail'] = $row;			
				}
			}
			else
			{
			$jsonArray['Success']='2';
			$jsonArray['Message']="اسم المستخدم موجود بالفعل.";
			}
		}
		if($postdata['email']!='' && $postdata['username']=='')
		{
			$sql1 = $conn->get_record_set("select * from tbl_customers where email='".$postdata['email']."' and isDeleted='0' AND custId!='".$custId."'");
			$row1s = $conn->records_to_array($sql1);
			if(empty($row1s))
			{
				$data->update( "tbl_customers" , $postdata,array("custId"=>$custId));
				$jsonArray['Success']='1';
				$jsonArray['Message']="تم تحديث الملف الشخصي بنجاح";
				$record = $conn->get_record_set("select * from `tbl_customers` where custId='".$custId."'");
				$rows = $conn->records_to_array($record);
				foreach($rows as $row)
				{	
					$row['password']='';
					if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
					$row['profilePic'] = $row['profilePic'];
					else
					$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
					$jsonArray['detail'] = $row;			
				}
			}
			else
			{
				$jsonArray['Success']='2';
				$jsonArray['Message']="البريد الالكتروني موجود بالفعل.";
			}
		}
		if($postdata['email']=='' && $postdata['username']=='')
		{
			$data->update("tbl_customers" , $postdata,array("custId"=>$custId));
			$jsonArray['Success']='1';
			$jsonArray['Message']="تم تحديث الملف الشخصي بنجاح";	
			$record = $conn->get_record_set("select * from `tbl_customers` where custId='".$custId."'");
				$rows = $conn->records_to_array($record);
				foreach($rows as $row)
				{	
					$row['password']='';
					if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
					$row['profilePic'] = $row['profilePic'];
					else
					$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
					$jsonArray['detail'] = $row;			
				}
		}
		if($postdata['username']!='' && $postdata['email']!='')
		{
			$sql = $conn->get_record_set("select * from tbl_customers where username='".$postdata['username']."' and isDeleted='0' AND custId!='".$custId."'");
			$rows = $conn->records_to_array($sql);
			if(empty($rows))
			{
				$sql1 = $conn->get_record_set("select * from tbl_customers where email='".$postdata['email']."' and isDeleted='0' AND custId!='$custId'");
				$row1s = $conn->records_to_array($sql1);
				if(empty($row1s))
				{
				//if($_REQUEST['action']=='update')
					$data->update("tbl_customers" , $postdata,array("custId"=>$custId));
					$jsonArray['Success']='1';
					$jsonArray['Message']="تم تحديث الملف الشخصي بنجاح";
					$record = $conn->get_record_set("select * from `tbl_customers` where custId='".$custId."'");
					$rows = $conn->records_to_array($record);
					foreach($rows as $row)
					{	
						$row['password']='';
						if (!filter_var($row['profilePic'], FILTER_VALIDATE_URL) === false)
						$row['profilePic'] = $row['profilePic'];
						else
						$row['profilePic'] = ($row['profilePic']!='')?PROFILE_IMAGE_200.$row['profilePic']:"";
						$jsonArray['detail'] = $row;			
					}
				}
				else
				{
					$jsonArray['Success']='2';
					$jsonArray['Message']="البريد الالكتروني موجود بالفعل.";
				}
			}
			else
			{
			$jsonArray['Success']='2';
			$jsonArray['Message']="اسم المستخدم موجود بالفعل.";
			}
		}
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="المستخدم ليس موجود.";	
	}
}
else
{
	$jsonArray['Success']='0';
	$jsonArray['Message']="يرجى تعبئة البيانات المطلوبة.";	
}	

show_output($jsonArray);
?>