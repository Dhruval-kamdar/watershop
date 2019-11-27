<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_company"; 
	$pageurl    	 = "add_company.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	$cancelurl = "";
	
	if (isset($_GET["companyId"]) && $_GET["companyId"] != "")
    {
		$id = $_GET["companyId"];
		$dbfunction->SelectQuery("tbl_companies", "tbl_companies.*",$dbfunction->db_safe("tbl_companies.companyId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$companyId = stripslashes(trim($objsel["companyId"]));
		$cityId = stripslashes(trim($objsel["cityId"]));
		$companyName = stripslashes(trim($objsel["companyName"]));
		$companyAddress = stripslashes(trim($objsel["companyAddress"]));
		$companyEmail = stripslashes(trim($objsel["companyEmail"]));
		$companyPhone = stripslashes(trim($objsel["companyPhone"]));
		$companyWebsite = stripslashes(trim($objsel["companyWebsite"]));
		$contactPerson = stripslashes(trim($objsel["contactPerson"]));
		$extraNotes = stripslashes(trim($objsel["extraNotes"]));
		$cityId = stripslashes(trim($objsel["cityId"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$cityId =  $myfilter->process(trim($_POST["cityId"]));
		$companyName =  $myfilter->process(trim($_POST["companyName"]));
		$companyAddress =  $myfilter->process(trim($_POST["companyAddress"]));
		$companyEmail =  $myfilter->process(trim($_POST["companyEmail"]));
		$companyPhone =  $myfilter->process(trim($_POST["companyPhone"]));
		$companyWebsite =  $myfilter->process(trim($_POST["companyWebsite"]));
		$contactPerson =  $myfilter->process(trim($_POST["contactPerson"]));
		$extraNotes =  $myfilter->process(trim($_POST["extraNotes"]));
		$cityId =  $myfilter->process(trim($_POST["cityId"]));
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$action 	= $myfilter->process($_POST["action"]);
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_companies", "tbl_companies.companyId","companyName ='$companyName' AND cityId ='$cityId' AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_companies", "tbl_companies.companyId","companyName ='$companyName' AND cityId ='$cityId' AND companyId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["companyId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Company Name Already Exist";
		}
		
		elseif ($companyName == "")
        {
			$error1 = "1";
			$errormessage1 = "Company Name Already Exist";
		}
		/*elseif ($companyAddress == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter address";
		}
		elseif ($extraNotes == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter notes";
		}
		elseif ($extraNotes == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select type";
		}
		elseif ($companyEmail == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter companyEmail"; 
		}
		elseif ($companyWebsite == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter website";
		}*/
		else
        {
			$urladd = "";
			foreach ($_POST as $key => $value)
            {
				if (substr($key, 0, 4) == "ret_")
                {
					if ($value != "")
                    {
						if ($urladd == "")
                        {
							$urladd = "?" . str_replace("ret_", "", $key) . "=" . $value;
						}
						else
                        {
							$urladd .= "&" . str_replace("ret_", "", $key) . "=" . $value;
						}
					}
				}
			}
			$cancelurl = $urladd;
			$hdn_image = $_POST['hdn_image'];
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_companies", array("cityId"=>$cityId,"companyName"=>$companyName,"companyAddress" =>$companyAddress,"contactPerson" => $contactPerson,"extraNotes" => $extraNotes,"companyPhone"=>$companyPhone,"companyEmail" => $companyEmail,"companyWebsite" => $companyWebsite,"cityId"=>$cityId,"isActive"=>$isActive,"created"=>date('Y-m-d H:i:s')));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$urltoredirect = "company_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				
				$updatearray =array("cityId"=>$cityId,"companyName"=>$companyName,"companyAddress" =>$companyAddress,"contactPerson" => $contactPerson,"extraNotes" => $extraNotes,"companyPhone"=>$companyPhone,"companyEmail" => $companyEmail,"companyWebsite" => $companyWebsite,"cityId"=>$cityId,"isActive"=>$isActive,"modified"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_companies", $updatearray, "companyId='" .$id . "'");
				$urltoredirect = "company_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
				$generalFunction->redirect($urltoredirect);
			}
		}
	}
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
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<title><?php
			if ($id)
			{
				echo "Edit Company :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Company :: Admin :: ".SITE_NAME;
			}
		?></title>
		<?php include("js-css-head.php"); ?>
		<?php include("meta-settings.php"); ?>
	<script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script></head>
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Company <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="company_list.php" class="btn btn-icon btn-primary glyphicons" title="View Company"><i class="icon-plus-sign"></i>View Company</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="company_list.php">Company</a></li>
						<li class="active"><?php echo $id==""?"Add":"Edit";?></li>
					</ol>
					<!-- End breadcrumb -->
					<?php if($error!="" || $error1!=""){ 
							if (isset($error) && $error == "1")
							{
								
								echo $generalFunction->getErrorMessage($errormessage);
								
							}
							
							if (isset($error1) && $error1 == "1")
							{
								
								echo $generalFunction->getErrorMessage($errormessage1);
								
							}
						 } ?>	
					<div class="the-box">
						<form  id="addUser" class="form-horizontal" enctype="multipart/form-data" name="addUser"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-lg-3 control-label">City:</label>
									<div class="col-lg-5">
										<select class="form-control" name="cityId" required>
											<option value="">-- Select One --</option>
											<?php
												$dbfunction1 	 = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_cities WHERE isActive='1' AND isDeleted='0' ORDER BY cityName");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($cityId==trim($objsel1["cityId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["cityId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["cityName"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Company Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="companyName" value="<?php echo (isset($companyName) ? $companyName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Company Address:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="companyAddress"><?php echo (isset($companyAddress) ? $companyAddress : ""); ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Company Email:</label>
									<div class="col-lg-5">
										<input type="email" class="form-control" name="companyEmail" value="<?php echo (isset($companyEmail) ? $companyEmail : ""); ?>" />
									</div>
									
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Company Phone:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="companyPhone" value="<?php echo (isset($companyPhone) ? $companyPhone : ""); ?>"  />
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Company Website:</label>
									<div class="col-lg-5">
										<input type="website" class="form-control" name="companyWebsite" value="<?php echo (isset($companyWebsite) ? $companyWebsite : ""); ?>"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Contact Person:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="contactPerson" value="<?php echo (isset($contactPerson) ? $contactPerson : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Extra Notes:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="extraNotes"><?php echo (isset($extraNotes) ? $extraNotes : ""); ?></textarea>
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Status:</label>
									<div class="col-lg-5">
										<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isActive" id="isActive"<?php echo (((isset($isActive) && $isActive == "1") || $isActive == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>	
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["companyId"] != "")
											{
											?>
											<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="Update" tabindex="19">Update</button>
											<?php
											}
											else
											{
											?>
											<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="Save" tabindex="19">Save</button>
										<?php } ?>
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'company_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($companyId) ? $companyId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["companyId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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