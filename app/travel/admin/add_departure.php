<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_departure"; 
	$pageurl    	 = "add_departure.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	if (isset($_GET["departure_id"]) && $_GET["departure_id"] != "")
    {
		$_SESSION["departure_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["departure_id"];
		$dbfunction->SelectQuery("tbl_departure_locations", "tbl_departure_locations.*",$dbfunction->db_safe("tbl_departure_locations.departure_id ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$departure_id = stripslashes(trim($objsel["departure_id"]));
		$departure_location = stripslashes(trim($objsel["departure_location"]));
		$address = stripslashes(trim($objsel["address"]));
		$country_id = stripslashes(trim($objsel["country_id"]));
		$is_active = stripslashes($objsel["is_active"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$departure_location =  $myfilter->process(trim($_POST["departure_location"]));
		$address =  $myfilter->process(trim($_POST["address"]));
		$country_id =  $myfilter->process(trim($_POST["country_id"]));
		$is_active = $myfilter->process($_POST["is_active"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_departure_locations", "tbl_departure_locations.departure_id","address ='$address' AND is_deleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["departure_id"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Departure Already Exist";
		}
		elseif ($action =="edit" && $objsel["departure_id"]!="" && $objsel["departure_id"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Departure Already Exist";
		}
		elseif ($departure_location == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Departure Location";
		}
		elseif ($address == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select Full Address";
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
				
				$dbfunction->InsertQuery("tbl_departure_locations", array("departure_location"=>$departure_location,"address" => $address,"country_id"=>$country_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s')));
				$urltoredirect = "departure_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("departure_location"=>$departure_location,"address" => $address,"country_id"=>$country_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_departure_locations", $updatearray, "departure_id='" .$id . "'");
				$urltoredirect = "departure_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Departure :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Departure :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Departure <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="departure_list.php" class="btn btn-icon btn-primary glyphicons" title="View Departures"><i class="icon-plus-sign"></i>View Departures</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="departure_list.php">Departure</a></li>
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
						<form  id="addDeparture" class="form-horizontal" enctype="multipart/form-data" name="addDeparture"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-lg-3 control-label">Country:</label>
									<div class="col-lg-5">
										<select class="form-control" name="country_id" required>
											<option value="">-- Select One --</option>
											<?php
												$dbfunction1 	 = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_countries WHERE is_active='1' AND is_deleted='0' ORDER BY country_name");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($country_id==trim($objsel1["country_id"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["country_id"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["country_name"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Departure Location:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="departure_location" value="<?php echo (isset($departure_location) ? $departure_location : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Full Address:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="address" value="<?php echo (isset($address) ? $address : ""); ?>" required />
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
											if ($_GET["departure_id"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'departure_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($departure_id) ? $departure_id : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["departure_id"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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