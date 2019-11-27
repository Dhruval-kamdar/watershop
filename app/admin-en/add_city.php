<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_city"; 
	$pageurl    	 = "add_city.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	
	if (isset($_GET["cityId"]) && $_GET["cityId"] != "")
    {
		//$_SESSION["city_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["cityId"];
		$dbfunction->SelectQuery("tbl_cities", "tbl_cities.*",$dbfunction->db_safe("tbl_cities.cityId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$cityId = stripslashes(trim($objsel["cityId"]));
		$cityCode = stripslashes(trim($objsel["cityCode"]));
		$cityName = stripslashes(trim($objsel["cityName"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$cityCode =  $myfilter->process(trim($_POST["cityCode"]));
		$cityName =  $myfilter->process(trim($_POST["cityName"]));
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_cities", "tbl_cities.cityId","cityName ='$cityName' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["cityId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "City Already Exist";
		}
		elseif ($action =="edit" && $objsel["cityId"]!="" && $objsel["cityId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "City Already Exist";
		}
		elseif ($cityCode == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter City Code";
		}
		elseif ($cityName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select City Name";
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
				
				$dbfunction->InsertQuery("tbl_cities", array("cityCode"=>$cityCode,"cityName" => $cityName,"isActive"=>$isActive,"createdTimestamp"=>time()));
				$urltoredirect = "city_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("cityCode"=>$cityCode,"cityName" => $cityName,"isActive"=>$isActive,"createdTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_cities", $updatearray, "cityId='" .$id . "'");
				$urltoredirect = "city_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<title><?php
			if ($id)
			{
				echo "Edit City :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add City :: Admin :: ".SITE_NAME;
			}
		?></title>
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> City <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="city_list.php" class="btn btn-icon btn-primary glyphicons" title="View Cities"><i class="icon-plus-sign"></i>View Cities</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="city_list.php">City</a></li>
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
						<form  id="addCity" class="form-horizontal" enctype="multipart/form-data" name="addCity"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">City Code:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="cityCode" value="<?php echo (isset($cityCode) ? $cityCode : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">City Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="cityName" value="<?php echo (isset($cityName) ? $cityName : ""); ?>" required />
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
											if ($_GET["cityId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'city_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($cityId) ? $cityId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["cityId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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