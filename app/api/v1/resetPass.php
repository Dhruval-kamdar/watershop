<?php
require_once("include/config.php");
$dbConn=mysqli_connect( DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die ( "Database connection cannot be found" ) ;
$show_form = FALSE;

if(isset($_POST['reset_pass'])) {
if(isset($_POST['new_pass']) && isset($_POST['confirm_new_pass'])) {

		$password = ($_POST['new_pass']);
		$confirm_password = ($_POST['confirm_new_pass']);
		$custId = ($_POST['custId']);
		$token = ($_POST['token']);
		
		if(!$show_form) {
			$regex = "/^[0-9a-zA-Z\.\-!@#$%]{6,}$/";
		    if(!preg_match($regex,$password)){
		       echo "<p style='text-align:center'>Your pass is invalid: choose a password with at the least 6 character.</p>";
		       $show_form = TRUE;
		    }
			else
			{
				  echo "<p style='text-align:center'>Your pass valid</p>";
			}
		}
	   
	    if(!$show_form) {
	   		if($password != $confirm_password){
		       echo "<p style='text-align:center'>The 2 password are inequal.</p>";
		       $show_form = TRUE;
		    } 
	   	}
	  
	   	if(!$show_form) {
	   		//Set new password
	   		$password = base64_encode($password);
	   		$query = "UPDATE tbl_customers SET password='$password',passResetToken='' WHERE custId = $custId";
	   		if(mysqli_query($dbConn,$query)) {
	   			//mysqli_query($dbConn,"DELETE FROM tbl_customers WHERE custId=$custId AND token = '$token'");
	   			echo "<p style='text-align:center'>Password reseted! Thank you!</p>";
	   		} else {
	   			echo "<p style='text-align:center'>There was an error: Try again please.</p>";
	   			$show_form = TRUE;
	   		}
	   		
	   	} else {
	   		echo "<br/><br/>";
	   	}
	} else {
		echo "You have to set both the fields!";
	}
	   	}else $show_form = TRUE;
?>

<html>
<head><script type='text/javascript'>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script>
<title><?php echo APP_TITLE; ?></title>
<body>
<center style="color:#fff">

<?php

if($show_form) {
	$token = ($_GET['t']);
	
	//Get custId
	$query = "SELECT custId FROM tbl_customers WHERE passResetToken = '$token'";
	$result = mysqli_query($dbConn,$query);
	$row = mysqli_fetch_assoc($result);
	extract($row);
	
	if($custId == "") {
		echo "<p style='text-align:center'>Invalid token.</p>";
		return;
	}
?>

<!DOCTYPE html>
<html>

<head><script type='text/javascript'>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script>

  <meta charset="UTF-8">

  <title><?=$app;?> - Reset Password</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

<script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script type='text/javascript'>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           </script></head>

<body>

 <span href="#" id="toggle-login" ><!--<img src="<?php echo BASE_URL .'images/app-logo.png'; ?>" style="padding-top:35px;" />--></span>

<div id="login">
  <div id="triangle"></div>
  <h1>Reset Password</h1>
  <form method="POST" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" name="reset_pass">
    <input type="password" name="new_pass" id="new_pass" placeholder="Password"/>
    <input type="password" name="confirm_new_pass" id="confirm_new_pass" placeholder="Confirm Password" />
	<input type="hidden" value="<?php echo $custId; ?>" name="custId"/>
	<input type="hidden" value="<?php echo $token; ?>" name="token"/>
	<input type="submit" value="Reset" name="reset_pass"/>
  </form>
</div>
<?php } ?>
  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="js/index.js"></script>

</body>

</html>