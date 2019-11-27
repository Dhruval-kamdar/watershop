<?php
	include("../include/config.inc.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename = "general_settings";
	$pageurl = "general_settings.php";
	$converter = new encryption();
	$dbfunction = new dbfunctions();
	//print_r($_POST);exit;
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_1'])), "item_key='tax_percent'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_2'])), "item_key='customer_point'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_3'])), "item_key='email_id'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_4'])), "item_key='phone_number'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_5'])), "item_key='facebook_link'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_6'])), "item_key='twitter_link'");
		$dbfunction->UpdateQuery("tbl_settings", array("item_value" => mysqli_real_escape_string($dbConn, $_POST['item_value_7'])), "item_key='instagram_link'");
		$generalFunction->redirect($pageurl . "?suc=" . $converter->encode("1"));
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<title><?php echo "General Settings :: Admin :: ".SITE_NAME;	?></title>
		<?php include("js-css-head.php"); ?>
		<?php include("meta-settings.php"); ?>
	</head>
	<body class="tooltips">
	
		<div class="wrapper page-content">
			<?php include("header.php"); ?>
			<!-- Sidebar menu & content wrapper -->
			    
				<!-- Sidebar Menu -->
				<?php include("leftside.php"); ?>
				<!-- // Sidebar Menu END -->
			<div id="page-content"> 
				<!-- Content -->
				<div id="content" class="container-fluid">
					<h1 class="page-heading">General Settings <small></small></h1>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						
						<li class="active">General Settings</a></li>
					</ol>
					<!-- End breadcrumb -->
					
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								$success = $converter->decode($_GET["suc"]);
								if ($success == 1)
                                {
									echo $generalFunction->getSuccessMessage("General Settings value updated.");
								}
							}
						?>
                        <?php
							if (isset($error) && $error == "1")
                            {
								echo $generalFunction->getErrorMessage("Please enter correct value.");
							}
						?>
						<?php
						$dbfunction->SelectQuery("tbl_settings", "item_value,item_key,item_id", "is_active='1' AND is_deleted='0'");
						while($objcheck = $dbfunction->getFetchArray())
						{
							if($objcheck['item_key'] == 'tax_percent')
								$item_value_1 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'customer_point')
								$item_value_2 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'email_id')
								$item_value_3 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'phone_number')
								$item_value_4 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'facebook_link')
								$item_value_5 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'twitter_link')
								$item_value_6 = $objcheck['item_value'];
							elseif($objcheck['item_key'] == 'instagram_link')
								$item_value_7 = $objcheck['item_value'];
							
						}
						?>
					<div class="the-box">
						<form  id="changepassword" class="form-horizontal" enctype="multipart/form-data" name="changepassword"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
								 <div class="form-group">
									<label class="col-lg-3 control-label">Tax Percentage</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_1" value="<?=$item_value_1?>" type="number" maxlength="16" required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Customer get 1 point per <?=CURRENCY_SIGN?></label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_2" value="<?=$item_value_2?>" type="number" maxlength="16" required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Email</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_3" value="<?=$item_value_3?>" type="text"  required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Phone</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_4" value="<?=$item_value_4?>" type="text"  required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Facebook</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_5" value="<?=$item_value_5?>" type="text"  required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Twitter</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_6" value="<?=$item_value_6?>" type="text"  required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Instagram</label>
									<div class="col-lg-5">
										<input class="form-control" id="" name="item_value_7" value="<?=$item_value_7?>" type="text"  required /> 
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
							
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									
									
									<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="Save" tabindex="19">Update</button>
								
								</div>
								</div>
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									
									
						</form>
								<!-- // Table END -->
					</div><!-- /.the-box -->
				</div>
			</div>
				<!-- // Content END --> 
			
			<div class="clearfix"></div>
			<!-- // Sidebar menu & content wrapper END -->
			
			<?php include("footer.php"); ?>
		
		</div><!-- /.wrapper -->
		<?php include("js-css-footer.php"); ?>
		
		
	</body>
</html>																																	