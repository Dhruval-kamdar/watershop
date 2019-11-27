<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_district"; 
	$pageurl    	 = "add_district.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	if (isset($_GET["districtId"]) && $_GET["districtId"] != "")
    {
		$_SESSION["district_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["districtId"];
		$dbfunction->SelectQuery("tbl_districts", "tbl_districts.*",$dbfunction->db_safe("tbl_districts.districtId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$districtId = stripslashes(trim($objsel["districtId"]));
		$districtCode = stripslashes(trim($objsel["districtCode"]));
		$districtName = stripslashes(trim($objsel["districtName"]));
		$cityId = stripslashes(trim($objsel["cityId"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$districtCode =  $myfilter->process(trim($_POST["districtCode"]));
		$districtName =  $myfilter->process(trim($_POST["districtName"]));
		$cityId =  $myfilter->process(trim($_POST["cityId"]));
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_districts", "tbl_districts.districtId","districtName ='$districtName' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["districtId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "District Already Exist";
		}
		elseif ($action =="edit" && $objsel["districtId"]!="" && $objsel["districtId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "District Already Exist";
		}
		elseif ($districtCode == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter District Code";
		}
		elseif ($districtName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select District Name";
		}
	
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
			if($action == "add")
            {
				
				$dbfunction->InsertQuery("tbl_districts", array("districtCode"=>$districtCode,"districtName" => $districtName,"cityId"=>$cityId,"isActive"=>$isActive,"createdTimestamp"=>time()));
				$urltoredirect = "district_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("districtCode"=>$districtCode,"districtName" => $districtName,"cityId"=>$cityId,"isActive"=>$isActive,"createdTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_districts", $updatearray, "districtId='" .$id . "'");
				$urltoredirect = "district_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit District :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add District :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> District <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="district_list.php" class="btn btn-icon btn-primary glyphicons" title="View Districts"><i class="icon-plus-sign"></i>View Districts</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="district_list.php">District</a></li>
						<li class="active"><?php echo $id==""?"Add":"Edit";?></li>
					</ol>
					<!-- End breadcrumb -->
					
					<?php
							if (isset($error) && $error == "1")
							{
								echo $generalFunction->getErrorMessage($errormessage);
							}
							
							if (isset($error1) && $error1 == "1")
							{
								echo $generalFunction->getErrorMessage($errormessage1);
							}
						?>
						
					<div class="the-box">
						<form  id="addDistrict" class="form-horizontal" enctype="multipart/form-data" name="addDistrict"  action="<?php echo $pageurl; ?>" method="post">
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
									<label class="col-lg-3 control-label">District Code:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="districtCode" value="<?php echo (isset($districtCode) ? $districtCode : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">District Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="districtName" value="<?php echo (isset($districtName) ? $districtName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								

								
		
								<div class="form-group">
									<label class="col-lg-3 control-label">Status:</label>
									<div class="col-lg-5">
									<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isActive" id="isActive" <?php echo (((isset($isActive) && $isActive == "1") || $isActive == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>
								
								
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["districtId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'district_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($districtId) ? $districtId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["districtId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
						</form>
							
					</div>
					</div>
			</div>
				
			
			<div class="clearfix"></div>
			
			<?php include("footer.php"); ?>
		
		</div><!-- /.wrapper -->
		<?php include("js-css-footer.php"); ?>
		
	</body>
</html>																																	