<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_qty_unit"; 
	$pageurl    	 = "add_qty_unit.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	
	if (isset($_GET["qtyUnitId"]) && $_GET["qtyUnitId"] != "")
    {
		$_SESSION["qty_unit_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["qtyUnitId"];
		$dbfunction->SelectQuery("tbl_qty_units", "tbl_qty_units.*",$dbfunction->db_safe("tbl_qty_units.qtyUnitId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$qtyUnitId = stripslashes(trim($objsel["qtyUnitId"]));
		$qtyUnit = stripslashes(trim($objsel["qtyUnit"]));
		$order = stripslashes(trim($objsel["order"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$qtyUnit =  $myfilter->process(trim($_POST["qtyUnit"]));
		$order =  $myfilter->process(trim($_POST["order"]));
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_qty_units", "tbl_qty_units.qtyUnitId","order ='$qtyUnit' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["qtyUnitId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Qty Unit already exist";
		}
		elseif ($action =="edit" && $objsel["qtyUnitId"]!="" && $objsel["qtyUnitId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Qty Unit already exist";
		}
		elseif ($qtyUnit == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Qty Unit";
		}
		elseif ($order == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Order No.";
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
				
				$dbfunction->InsertQuery("tbl_qty_units", array("`qtyUnit`"=>$qtyUnit,"`order`" => $order,"`isActive`"=>$isActive,"`createdTimestamp`"=>time()));
				$urltoredirect = "qty_unit_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("`qtyUnit`"=>$qtyUnit,"`order`" => $order,"`isActive`"=>$isActive,"`modifiedTimestamp`"=>time());
				$dbfunction->UpdateQuery("tbl_qty_units", $updatearray, "qtyUnitId='" .$id . "'");
				$urltoredirect = "qty_unit_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "تعديل وحدة الكمية :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "أضف وحدة الكمية :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"أضف":"تعديل";?> وحدة الكمية <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="qty_unit_list.php" class="btn btn-icon btn-primary glyphicons" title="وحدات العرض"><i class="icon-plus-sign"></i>وحدات العرض</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="qty_unit_list.php">وحدة الكمية</a></li>
						<li class="active"><?php echo $id==""?"أضف":"تعديل";?></li>
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
						<form  id="addوحدة الكمية" class="form-horizontal" enctype="multipart/form-data" name="addوحدة الكمية"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">وحدة الكمية:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="qtyUnit" value="<?php echo (isset($qtyUnit) ? $qtyUnit : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">رقم الطلب:</label>
									<div class="col-lg-5">
										<input type="number" class="form-control" name="order" value="<?php echo (isset($order) ? $order : ""); ?>" required min="0" />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								

								
		
								<div class="form-group">
									<label class="col-lg-3 control-label">الحالة:</label>
									<div class="col-lg-5">
									<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isActive" id="isActive" <?php echo (((isset($isActive) && $isActive == "1") || $isActive == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>
								
								
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["qtyUnitId"] != "")
											{
											?>
											<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="تحديث" tabindex="19">تحديث</button>
											<?php
											}
											else
											{
											?>
											<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="حفظ" tabindex="19">حفظ</button>
										<?php } ?>
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'qty_unit_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($qtyUnitId) ? $qtyUnitId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["qtyUnitId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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