<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_arrival"; 
	$pageurl    	 = "add_arrival.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	if (isset($_GET["arrival_id"]) && $_GET["arrival_id"] != "")
    {
		$_SESSION["arrival_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["arrival_id"];
		$dbfunction->SelectQuery("tbl_arrival_locations", "tbl_arrival_locations.*",$dbfunction->db_safe("tbl_arrival_locations.arrival_id ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$arrival_id = stripslashes(trim($objsel["arrival_id"]));
		$arrival_location = stripslashes(trim($objsel["arrival_location"]));
		$address = stripslashes(trim($objsel["address"]));
		$country_id = stripslashes(trim($objsel["country_id"]));
		$is_active = stripslashes($objsel["is_active"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$arrival_location =  $myfilter->process(trim($_POST["arrival_location"]));
		$address =  $myfilter->process(trim($_POST["address"]));
		$country_id =  $myfilter->process(trim($_POST["country_id"]));
		$is_active = $myfilter->process($_POST["is_active"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_arrival_locations", "tbl_arrival_locations.arrival_id","address ='$address' AND is_deleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["arrival_id"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Arrival Already Exist";
		}
		elseif ($action =="edit" && $objsel["arrival_id"]!="" && $objsel["arrival_id"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Arrival Already Exist";
		}
		elseif ($arrival_location == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Arrival Location";
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
				
				$dbfunction->InsertQuery("tbl_arrival_locations", array("arrival_location"=>$arrival_location,"address" => $address,"country_id"=>$country_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s')));
				$urltoredirect = "arrival_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("arrival_location"=>$arrival_location,"address" => $address,"country_id"=>$country_id,"is_active"=>$is_active,"created_on"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_arrival_locations", $updatearray, "arrival_id='" .$id . "'");
				$urltoredirect = "arrival_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Arrival :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Arrival :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Arrival <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="arrival_list.php" class="btn btn-icon btn-primary glyphicons" title="View Arrivals"><i class="icon-plus-sign"></i>View Arrivals</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="arrival_list.php">Arrival</a></li>
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
						<form  id="addArrival" class="form-horizontal" enctype="multipart/form-data" name="addArrival"  action="<?php echo $pageurl; ?>" method="post">
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
									<label class="col-lg-3 control-label">Arrival Location:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="arrival_location" value="<?php echo (isset($arrival_location) ? $arrival_location : ""); ?>" required />
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
											if ($_GET["arrival_id"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'arrival_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($arrival_id) ? $arrival_id : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["arrival_id"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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