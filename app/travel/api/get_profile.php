<?php
	require_once('include/config.php');
	require_once('include/init.php');
	require_once('include/thumb.php');
	
	if($language == 'en')
		require_once('lang/en.php');
	elseif($language == 'ar')
		require_once('lang/ar.php');
	else
		require_once('lang/en.php');

	$obj=new Database;
	$data = new DataManipulator;
	$jsonArray = array();
	
	if($_POST['user_id']!='')
		$user_id = $_POST['user_id'];
	else
		$err = $lang["REQ_PARA"].$lang["USER_ID"];
	
	if($err!='')
	{
		$jsonArray['Success']='0';
		$jsonArray['Message']=$err;
		show_output($jsonArray);
	}	
			$jsonArray['Success']='1';
			$jsonArray['Message']=$lang["SUCCESSFUL"];
			$sql = $conn->get_record_set("SELECT * FROM `tbl_users` WHERE user_id='$user_id' AND is_deleted ='0'");
			$rows = $conn->records_to_array($sql);
			foreach($rows as $row1)
			{
					$row1['password']='';
					if((PHOTO_URL ."profile/150x150/".$row1['profile_pic']) && $row1['profile_pic']!='')
					$row1['profile_pic_150'] = ($row1['profile_pic']!='')?PHOTO_URL ."profile/150x150/".$row1['profile_pic']:'';
					else
					$row1['profile_pic_150'] = '';
					$row1['profile_pic'] = ($row1['profile_pic']!='')?PHOTO_URL ."profile/".$row1['profile_pic']:'';
					$jsonArray['is_verified']= $row1['is_verified'];
					if($row1['full_name']=='')
					$jsonArray['completed_profile']= '0';
					else
					$jsonArray['completed_profile']= '1';

					$sql2 = $conn->get_record_set("SELECT * FROM `tbl_payment_cards` WHERE user_id='$user_id' AND is_active='1' AND is_deleted='0' ORDER BY card_id DESC LIMIT 1");
					$rows2 = $conn->records_to_array($sql2);
					if(!empty($rows2))
					{	
						//$jsonArray['Success']='1';
						//$jsonArray['Message']=$lang["SUCCESSFUL"];
						foreach($rows2 as $row2)
						{
							$row1['DefaultCard']=$row2;
						}
					}	
					$jsonArray['Details']= $row1;
					show_output($jsonArray);
			}			
			$jsonArray['Success'] = '0';
			$jsonArray['Message'] = $lang["INVALID_USER"];	
			show_output($jsonArray);
?>