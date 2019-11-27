<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_coupon"; 
	$pageurl    	 = "add_coupon.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	$cancelurl = "";
	
	if (isset($_GET["couponId"]) && $_GET["couponId"] != "")
    {
		$id = $_GET["couponId"];
		$dbfunction->SelectQuery("tbl_coupons", "tbl_coupons.*",$dbfunction->db_safe("tbl_coupons.couponId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$couponId = stripslashes(trim($objsel["couponId"]));
		$couponCode = stripslashes(trim($objsel["couponCode"]));
		$couponDescr = stripslashes(trim($objsel["couponDescr"]));
		$discountValue = stripslashes(trim($objsel["discountValue"]));
		$discountType = stripslashes(trim($objsel["discountType"]));
		$minOrderAmt = stripslashes(trim($objsel["minOrderAmt"]));
		list($fromDate,$fromTime) = explode(" ",datFormat($objsel["startTime"],true));
		list($toDate,$toTime) = explode(" ",datFormat($objsel["expiryTime"],true));
		$isMultiUse = stripslashes(trim($objsel["isMultiUse"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$couponCode =  $myfilter->process(trim($_POST["couponCode"]));
		$couponDescr =  $myfilter->process(trim($_POST["couponDescr"]));
		$discountValue =  $myfilter->process(trim($_POST["discountValue"]));
		$discountType =  $myfilter->process(trim($_POST["discountType"]));
		$minOrderAmt =  $myfilter->process(trim($_POST["minOrderAmt"]));
		$startTime =  date('Y-m-d H:i:s',strtotime(datDefault($_POST["fromDate"]).' '.$_POST["fromTime"]));
		$expiryTime =  date('Y-m-d H:i:s',strtotime(datDefault($_POST["toDate"]).' '.$_POST["toTime"]));
		$isMultiUse =  $myfilter->process(trim($_POST["isMultiUse"]));
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$action 	= $myfilter->process($_POST["action"]);
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_coupons", "tbl_coupons.couponId","(couponCode ='$couponCode') AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_coupons", "tbl_coupons.couponId","(couponCode ='$couponCode') AND couponId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["couponId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Expiry Time or Discount Already Exist";
		}
		
		elseif ($couponCode == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter coupon code";
		}
		/*elseif ($couponDescr == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter coupon description";
		}*/
		elseif ($expiryTime == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select start time";
		}
		elseif ($expiryTime == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter expiry time";
		}
		elseif ($expiryTime == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select type";
		}
		elseif ($discountValue == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter discountValue"; 
		}
		elseif ($minOrderAmt == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter min. order AMT";
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
			$hdn_image = $_POST['hdn_image'];
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_coupons", array("couponCode"=>$couponCode,"couponDescr" =>$couponDescr,"startTime" => $startTime,"expiryTime" => $expiryTime,"discountType"=>$discountType,"discountValue" => $discountValue,"minOrderAmt" => $minOrderAmt,"isMultiUse"=>$isMultiUse,"isActive"=>$isActive,"created"=>date('Y-m-d H:i:s')));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$urltoredirect = "coupon_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				
				$updatearray =array("couponCode"=>$couponCode,"couponDescr" =>$couponDescr,"startTime" => $startTime,"expiryTime" => $expiryTime,"discountType"=>$discountType,"discountValue" => $discountValue,"minOrderAmt" => $minOrderAmt,"isMultiUse"=>$isMultiUse,"isActive"=>$isActive,"modified"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_coupons", $updatearray, "couponId='" .$id . "'");
				$urltoredirect = "coupon_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Coupon :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Coupon :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Coupon <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="coupon_list.php" class="btn btn-icon btn-primary glyphicons" title="View Coupon"><i class="icon-plus-sign"></i>View Coupon</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="coupon_list.php">Coupon</a></li>
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
									<label class="col-lg-3 control-label">Coupon Code:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="couponCode" value="<?php echo (isset($couponCode) ? $couponCode : ""); ?>" placeholder="e.g. ABC001" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Description:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="couponDescr"><?php echo (isset($couponDescr) ? $couponDescr : ""); ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Start Time:</label>
									<div class="col-lg-3">
										<input type="text" class="form-control datepicker" name="fromDate" value="<?php echo (isset($fromDate) ? $fromDate : ""); ?>" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required/>
									</div>
									<div class="col-lg-2">
										<input type="text" class="form-control timepicker" name="fromTime" value="<?php echo (isset($fromTime) ? $fromTime : ""); ?>" required/>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Expiry Time:</label>
									<div class="col-lg-3">
										<input type="text" class="form-control datepicker" name="toDate" value="<?php echo (isset($toDate) ? $toDate : ""); ?>" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required />
									</div>
									<div class="col-lg-2">
										<input type="text" class="form-control timepicker" name="toTime" value="<?php echo (isset($toTime) ? $toTime : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Discount:</label>
									<div class="col-lg-3">
										<input type="number" class="form-control" name="discountValue" value="<?php echo (isset($discountValue) ? $discountValue : ""); ?>" min="1" required />
									</div>
									<div class="col-lg-2">
										<select class="form-control" name="discountType">
										<option value="flat" <?=($discountType=='flat')?'selected':''?>>Flat</option>
										<option value="percent" <?=($discountType=='percent')?'selected':''?>>Percentage</option>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Min. Order AMT:</label>
									<div class="col-lg-5">
										<input type="number" class="form-control" name="minOrderAmt" value="<?php echo (isset($minOrderAmt) ? $minOrderAmt : ""); ?>" min="0" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Multiple Use:</label>
									<div class="col-lg-5">
										<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isMultiUse" id="isMultiUse"<?php echo (((isset($isMultiUse) && $isMultiUse == "1") || $isMultiUse == "") ? "checked" : ""); ?> />&nbsp;</label></div>
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
											if ($_GET["couponId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'coupon_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($couponId) ? $couponId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["couponId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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