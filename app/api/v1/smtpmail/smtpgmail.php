<?php
include("../include/config.php"); // include the class name
include("classes/class.phpmailer.php"); // include the class name

			$mail	= new PHPMailer; // call the class 
			$mail->IsSMTP(); // enable SMTP
			$mail->CharSet = "UTF-8";
			//$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = SMTP_HOST;
			$mail->Port = SMTP_PORT; // 465 or 587
			$mail->IsHTML(true);
			$mail->Username = SMTP_UNAME;
			$mail->Password = SMTP_PASS;
			$mail->SetFrom(FROM_EMAIL,APP_TITLE);
			$mail->Subject =$_POST['subject'];
			if($_POST['attachment']!="")
			$mail->AddAttachment($_POST['attachment'],"Matien App.png"); 
			$mail->Body=$_POST['message'];
			$mail->AddAddress($_POST['to']);
			if(!$mail->Send())
			{
				$headers = "From: ".APP_TITLE." <".FROM_EMAIL."> \r\n";
				//$headers .= "Content-Type: multipart/mixed; boundary=\"1a2a3a\"";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($_POST['to'],$_POST['subject'],$_POST['message'],$headers);
			}
	
?>