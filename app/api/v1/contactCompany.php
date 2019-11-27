<?php
require_once('include/config.php');
require_once('include/init.php');

$obj=new Database;
$data = new DataManipulator;
$jsonArray = array();

if($_REQUEST['name']!='')
$postdata['name'] = $_REQUEST['name'];
else
$err="Required parameter - name";

if($_REQUEST['phone']!='')
$postdata['phone'] = $_REQUEST['phone'];
else
$err="Required parameter - phone";

if($_REQUEST['email']!='')
$postdata['email'] = $_REQUEST['email'];
else
$err="Required parameter - email";

if($_REQUEST['message']!='')
$postdata['message'] = $_REQUEST['message'];
else
$err="Required parameter - message";

if($_REQUEST['type']!='')
$postdata['type'] = $_REQUEST['type'];
else
$postdata['type'] = 'contactCompany';

$postdata['created'] = date('Y-m-d H:i:s');

			if(!empty($_FILES['photo']))
			{
				$path= '../../uploads/contact/';
				$userf = $_FILES['photo']['tmp_name'];
				$fname = $_FILES['photo']['name'];
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				$img =  time()."_photo.".$ext;
				if(move_uploaded_file($userf,$path.$img))
				{
					$postdata['photo'] =$img;
					//createthumb($path . $img, $path.'150x150/'.$img,100,100);		
				}
			}
			
			if(!empty($_FILES['video']))
			{
				$path= '../../uploads/contact/';
				$userf = $_FILES['video']['tmp_name'];
				$fname = $_FILES['video']['name'];
				$ext = pathinfo($fname, PATHINFO_EXTENSION);
				$img =  time()."_video.".$ext;
				if(move_uploaded_file($userf,$path.$img))
				{
					$postdata['video'] =$img;		
				}
			}
if($err!='')
{
	$jsonArray['Success']='0';
	$jsonArray['Message']=$err;
	show_output($jsonArray);
}	
	$to = ADMIN_EMAIL;	
	if($postdata['type']=='contactCompany')		
	$subject= 'COMPANY WANNA JOIN';
	else
	$subject= 'CONTACT US';	
	
	$message ='
	<b>Name: </b> '.$postdata['name'].'<br/ >
	<b>Phone: </b> '.$postdata['phone'].'<br/ >
	<b>Website: </b> '.$postdata['website'].'<br/ >
	<b>Message: </b> '.$postdata['message'].'<br/ ><br/ >';
	$message .='<b>Thanks</b>';
	send_mail($to,$subject,$message,$attach);	
		
	$job_id = $data->insert( "tbl_contact_companies" , $postdata );	
	$jsonArray['Success']='1';
	$jsonArray['Message']='نشكركم على تواصلكم معنا, سنقوم بالرد باقرب فرصة.';
	show_output($jsonArray);
		
?>