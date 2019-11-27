<?php
	include("../include/config.inc.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename = "sitesettings";
	$pageurl = "sitesettings.php";
	$converter = new encryption();
	$dbfunction = new dbfunctions();
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		$myfilter = new inputfilter();
		
		$FromEmail = $myfilter->process($_POST["FromEmail"]);
		$LoginEmail = $myfilter->process($_POST["LoginEmail"]);
		$CcEmail = $myfilter->process($_POST["CcEmail"]);
		$BccEmail = $myfilter->process($_POST["BccEmail"]);
		$GoogleAnalytics = $_POST["GoogleAnalytics"];
		$GeneralMeta     = $_POST["GeneralMeta"];
		if ($FromEmail == "" || $LoginEmail == "")
        {
			$error = 1;
			if ($LoginEmail == "")
            {
				$errormessage = "Please enter Admin E-mail Address ";
			}
			if ($FromEmail == "")
            {
				$errormessage = "Please enter From E-mail Address ";
			}
			
			//        if ($sitename == "")
			//            {
			//            $errormessage = "Please enter From E-mail Address ";
			//            }
		}
		else
        {
			$dbfunction->UpdateQuery("sitesettings", array("LoginEmail" => $LoginEmail, "FromEmail" => $FromEmail, "CcEmail" => $CcEmail, "GoogleAnalytics" => $GoogleAnalytics,"GeneralMeta"=>$GeneralMeta), "SiteSettingsId='1'");
			$dbfunction->UpdateQuery("tbl_admin", array("AdminEmail" => $LoginEmail), "AdminId='1'");
			$generalFunction->redirect($pageurl . "?suc=" . $converter->encode("1"));
		}
	}
	
	$dbfunction->SelectQuery("sitesettings", "LoginEmail, FromEmail, CcEmail, GoogleAnalytics,GeneralMeta", $dbfunction->db_safe("SiteSettingsId='%1'", 1));
	$objsetting = $dbfunction->getFetchArray();
	$FromEmail = stripslashes($objsetting["FromEmail"]);
	$LoginEmail = stripslashes($objsetting["LoginEmail"]);
	$CcEmail = stripslashes($objsetting["CcEmail"]);
	$GoogleAnalytics = $objsetting["GoogleAnalytics"];
	$GeneralMeta = $objsetting["GeneralMeta"];
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?php  echo "Site Settings :: Admin :: ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
        <?php include("js-css-head.php"); ?>
        <?php include("meta-settings.php"); ?>
	<script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script></head>
    <body>
        <div class="container-fluid fluid menu-left">
            <?php include("header.php"); ?>
            <!-- Sidebar menu & content wrapper -->
            <div id="wrapper">     
                <!-- Sidebar Menu -->
                <?php include("leftside.php"); ?>
                <!-- // Sidebar Menu END -->
                <!-- Content -->
                <div id="content">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumb">
						
                        <li><a href="dashboard.php" class="glyphicons" title="Dashboard"><i class="icon-home"></i>Dashboard</a></li>
                        <li class="divider"></li>
                        <li>Website Settings</li>
					</ul>
                    <!-- // Breadcrumb END -->
                    <h3 class="heading-mosaic">Website Settings</h3>
                    <div class="innerLR">
                        <?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								$success = $converter->decode($_GET["suc"]);
								if ($success == 1)
                                {
									echo $generalFunction->getSuccessMessage(str_replace("{modulename}", "Settings", $lang["updatemodulemessage"]));
								}
								elseif ($success == 2)
                                {
									echo $generalFunction->getSuccessMessage(str_replace("{modulename}", "General Settings", $lang["updatemodulemessage"]));
								}
							}
						?>
                        <div class="widget">
                            <div class="widget-head">
                                <h4 class="heading">Settings</h4>
								
							</div>
                            <?php
								if ($error == 1)
                                {
								?><div class="errormessage"><?php echo $errormessage; ?>  </div><?php } ?>
								<div class="widget-body">
									<!-- grid meta -->
									<form  class="form-horizontal" name="emailsetting" class="emailsetting" id="emailsetting" action="<?php echo $pageurl; ?>" method="post">
										<div class="row-fluid">
											<div class="span8 top15">
												<div class="control-group">
													<label class="control-label" for="fromemailadd">From E-mail Address&nbsp;:&nbsp;</label>
													<div class="controls"><input class="span6" id="FromEmail" name="FromEmail" type="text" value="<?php echo (isset($FromEmail) ? $FromEmail : ""); ?>" maxlength="320" /><span class="errorstar">&nbsp;*</span><font style="color:#000"> (Will be used to send E-mails from system)</font></div>
												</div>
												<div class="control-group">
													<label class="control-label" for="adminemailadd">Admin E-mail Address&nbsp;:&nbsp;</label>
													<div class="controls"><input class="span6" id="LoginEmail" name="LoginEmail" type="text" value="<?php echo (isset($LoginEmail) ? $LoginEmail : ""); ?>" maxlength="320" /><span class="errorstar">&nbsp;*</span><font style="color:#000"> (Will be used to send all E-mails to admin)</font></div>
												</div>
												<div class="control-group">
													<label class="control-label" for="CcEmail">Cc E-mail Address&nbsp;:&nbsp;</label>
													<div class="controls"><input class="span6" id="CcEmail" name="CcEmail" type="text" value="<?php echo (isset($CcEmail) ? $CcEmail : ""); ?>" maxlength="320" /></div>
												</div>
											<div class="control-group">
												<label class="control-label" for="GoogleAnalytics	">Google Analytics&nbsp;:&nbsp;</label>
												<div class="controls"><textarea class="span6" id="GoogleAnalytics" name="GoogleAnalytics" rows="5" ><?php echo (isset($GoogleAnalytics	) ? $GoogleAnalytics	 : ""); ?></textarea></div>
											</div>
												
											<div class="control-group">
												<label class="control-label" for="GeneralMeta">General Meta&nbsp;:&nbsp;</label>
												<div class="controls"><textarea class="span6" id="GeneralMeta" name="GeneralMeta" rows="5" ><?php echo (isset($GeneralMeta	) ? $GeneralMeta	 : ""); ?></textarea></div>
											</div>
											
											</div>
										</div>
										<!-- Form actions -->
										<div class="form-actions">
											<span class="span2"><button type="submit" value="submit" name="save" id="save" class="btn btn-block btn-primary" title="Update">Update</button></span>
										</div>
									</form>
									<!-- // Table END -->
								</div>
						</div>
                        <!--<div class="widget">
                            <div class="widget-head">
							<h4 class="heading">General Settings</h4>
                            </div>
                            <div class="widget-body">
						<!-- grid meta -->
						<!--<form  class="form-horizontal" name="generalsetting" id="generalsetting" action="<?php //  echo $pageurl; ?>" method="post">
							<div class="row-fluid">
							<div class="span8 top15">
							<div class="control-group">
							<label class="control-label" for="googleanalytics">Goolge Analytics Code&nbsp;:&nbsp;</label>
							<div class="controls"><textarea class="span6" id="googleanalytics" name="googleanalytics" maxlength="500"><?php // echo (isset($googleanalytics) ? $googleanalytics : ""); ?></textarea></div>
							</div>
							</div>
							</div>
						<!-- Form actions -->
						<!--<div class="form-actions">
							<span class="span2"><button type="submit" value="submit" name="save1" id="save1" class="btn btn-block btn-primary" title="Update">Update</button></span>
							</div>
							</form>
						<!-- // Table END -->
						<!--</div>
						</div>-->
						
					</div>	
				</div>
                <!-- // Content END --> 
			</div>
            <div class="clearfix"></div>
            <!-- // Sidebar menu & content wrapper END -->
			
            <?php include("footer.php"); ?>
		</div>
        <?php include("js-css-footer.php"); ?>
        <script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/form_validator.js"></script>
        <script src="js/sitesettings.js"></script>
        <?php
			if (isset($_GET["suc"]) && $_GET["suc"] != "")
            {
				echo '<script language="javascript">HideSuccessMessage();</script>';
			}
		?>
	</body>
</html>