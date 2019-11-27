<?php
	require_once('include/config.php');
	require_once('include/init.php');

	$obj=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	


	if($_REQUEST['smsVerificationCode']!='')
		$smsVerificationCode = $_REQUEST['smsVerificationCode'];
	else
		$err='Required parameter - smsVerificationCode';
	
	if($_REQUEST['custId']!='')
		$custId = $_REQUEST['custId'];
	else
		$err='Required parameter - custId';
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray);
	}	
	mysqli_query($dbConn,"SET NAMES 'utf8'"); 	
	$activation_code_converted = ($smsVerificationCode);
	//$sql = mysqli_query($dbConn,"Select u.secret_que,u.secret_ans from tbl_users u inner join tbl_devices d on u.user_id=d.user_id where u.forgot_pass_code='".$forgot_pass_code."'");

	$sql = mysqli_query($dbConn,"Select u.* from tbl_customers u where u.smsVerificationCode='".$activation_code_converted ."' AND custId='$custId'");

	if(mysqli_num_rows($sql) >0)
	{
		$row =mysqli_fetch_assoc($sql);
		$sql1 = mysqli_query($dbConn,"Select u.* from tbl_customers u where custId!='$custId' and phone='".$row['tempPhone']."'
		and isDeleted='0' and smsVerified='1'");
		if(mysqli_num_rows($sql1)==0)
		{
			$postdata['phone'] = $row['tempPhone'];
			$postdata['tempPhone'] = '0';
			$postdata['smsVerificationCode'] = '0';
			//$postdata['smsVerificationDate'] = date("Y-m-d H:i:s");
			$postdata['smsVerified'] = '1';
			$data->update( "tbl_customers" , $postdata , array("custId"=>$custId ));
			$sql1 = mysqli_query($dbConn,"Select u.* from tbl_customers u where u.custId ='".$row['custId']."'");
			$row1 =mysqli_fetch_assoc($sql1);
			$jsonArray['Success']='1';
			$jsonArray['Message']="تم التحقق من رقم هاتفك المحمول.";
			 
			$row1['password']='';
			if (!filter_var($row1['profilePic'], FILTER_VALIDATE_URL) === false)
			$row1['profilePic'] = $row1['profilePic'];
			else
			$row1['profilePic'] = ($row1['profilePic']!='')?PROFILE_IMAGE_200.$row1['profilePic']:"";
			$jsonArray['detail']= $row1;
		}
		else
		{  
			$jsonArray['Success']='0';
			$jsonArray['Message']="رقم الهاتف المحمول هذا موجود بالفعل.";	
		}
	}
	else
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']="كلمة مرور غير صحيحة لمرة واحدة.";	
	}
	show_output($jsonArray);	
?>