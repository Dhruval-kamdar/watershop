<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_country"; 
	$pageurl    	 = "add_country.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	if (isset($_GET["country_id"]) && $_GET["country_id"] != "")
    {
		$_SESSION["country_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["country_id"];
		$dbfunction->SelectQuery("tbl_countries", "tbl_countries.*",$dbfunction->db_safe("tbl_countries.country_id ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$country_id = stripslashes(trim($objsel["country_id"]));
		$country_iso = stripslashes(trim($objsel["country_iso"]));
		$country_name = stripslashes(trim($objsel["country_name"]));
		$continent_id = stripslashes(trim($objsel["continent_id"]));
		$is_active = stripslashes($objsel["is_active"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$country_iso =  $myfilter->process(trim($_POST["country_iso"]));
		$country_name =  $myfilter->process(trim($_POST["country_name"]));
		$continent_id =  $myfilter->process(trim($_POST["continent_id"]));
		$is_active = $myfilter->process($_POST["is_active"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_countries", "tbl_countries.country_id","country_name ='$country_name' AND is_deleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["country_id"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Country Already Exist";
		}
		elseif ($action =="edit" && $objsel["country_id"]!="" && $objsel["country_id"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Country Already Exist";
		}
		elseif ($country_iso == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Country Code";
		}
		elseif ($country_name == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select Country Name";
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
				
				$dbfunction->InsertQuery("tbl_countries", array("country_iso"=>$country_iso,"country_name" => $country_name,"continent_id"=>$continent_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s')));
				$urltoredirect = "country_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("country_iso"=>$country_iso,"country_name" => $country_name,"continent_id"=>$continent_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_countries", $updatearray, "country_id='" .$id . "'");
				$urltoredirect = "country_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Country :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Country :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Country <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="country_list.php" class="btn btn-icon btn-primary glyphicons" title="View Countrys"><i class="icon-plus-sign"></i>View Countrys</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="country_list.php">Country</a></li>
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
						<form  id="addCountry" class="form-horizontal" enctype="multipart/form-data" name="addCountry"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-lg-3 control-label">Continent:</label>
									<div class="col-lg-5">
										<select class="form-control" name="continent_id" required>
											<option value="">-- Select One --</option>
											<?php
												$dbfunction1 	 = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_continents WHERE is_active='1' AND is_deleted='0' ORDER BY continent_name");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($continent_id==trim($objsel1["continent_id"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["continent_id"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["continent_name"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Country Code:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="country_iso" value="<?php echo (isset($country_iso) ? $country_iso : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Country Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="country_name" value="<?php echo (isset($country_name) ? $country_name : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								

								
		
								<div class="form-group">
									<label class="col-lg-3 control-label">Status:</label>
									<div class="col-lg-5">
									<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="is_active" id="is_active" <?php echo (((isset($is_active) && $is_active == "1") || $is_active == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>
								
								
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["country_id"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'country_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($country_id) ? $country_id : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["country_id"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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