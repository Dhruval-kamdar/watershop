<?php
require_once("include/config.php");
require_once("include/init.php");

if($_REQUEST['email']!="")
$email=$_REQUEST['email'];
else
$err="Required parameter - email";  

if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	
		$token = md5(rand(1, 10)); 

		$sql =$conn->get_record_set("SELECT * FROM `tbl_customers` WHERE `email`='".$email."' AND isDeleted='0'");
		$row = $conn->records_to_array($sql);
		if(!empty($row[0]))
		{	
			extract($row[0]);
			$data->update( "tbl_customers" , array("passResetToken"=>$token),array("custId"=>$custId));
			
				$token = $token;
				$profileImage = BASE_URL.'uploads/profiles/'.$photo;
				$name = $fullName;
				$email = $email;
				$data = "You have request the password's reset.\n\n";
				$data .= "<p>If you did not, ignore this message, otherwise click on the follow button:\n\n</p>";
				$data .= "<a href='".BASE_URL ."reset?t=" . $token ."' target='_blank'><input type='button' value='Reset' style='background:#3399cc;color:#fff;width:15%;height:30px;border:#3399cc;margin:18px 0px 15px;border-radius: 3px !important;'></a>\n\n";
				$data .= "<p >\n\n\n\nThank you!,\n\n</p><p >".APP_TITLE."</p>";

				$subject = "Reset Password Request";
				$message = '<html><body>';
				//$message .= '<div><img style="width: 100px;padding-left: 10;padding-top: 4px;" src="'.BASE_URL .'admin/images/Logo.jpg"/><div>';
				//$message .= '<div style="border-radius: 7px;"><div style="padding:10px;"><img style="float: left;padding-right: 10px;width:100px;height:108px;" src="'.$profileImage.'" /><div>';
				$message .= '<div><strong>Hi '.$name.',</strong><p style="margin-top:10px;">'.$data.' </p></div>';
				$message .= "<div></body></html>";
				send_mail($email,$subject,$message,$attach);
				$jsonArray['Success']='1';
				$jsonArray['Message']="تم ارسال تغيير كلمة المرور لبريدك الالكتروني";
		}
		else
		{
			$jsonArray['Success']='2';
			$jsonArray['Message']="البريد الإلكتروني غير موجود.";
		}


 show_output($jsonArray);

?>