<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_deliverytime"; 
	$pageurl    	 = "add_deliverytime.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	
	if (isset($_GET["timeId"]) && $_GET["timeId"] != "")
    {
		//$_SESSION["deliverytime_paging"] = '"draw" : false,"stateSave": true,' ;
		$id = $_GET["timeId"];
		$dbfunction->SelectQuery("tbl_delivery_times", "tbl_delivery_times.*",$dbfunction->db_safe("tbl_delivery_times.timeId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$timeId = stripslashes(trim($objsel["timeId"]));
		$startTime = stripslashes(trim($objsel["startTime"]));
		$endTime = stripslashes(trim($objsel["endTime"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$startTime =  $myfilter->process(trim($_POST["startTime"]));
		$endTime =  $myfilter->process(trim($_POST["endTime"]));
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_delivery_times", "tbl_delivery_times.timeId","(startTime ='$startTime' OR endTime ='$endTime') AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["timeId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Delivery time already exist";
		}
		elseif ($action =="edit" && $objsel["timeId"]!="" && $objsel["timeId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Delivery time already exist";
		}
		elseif ($startTime == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter start time";
		}
		elseif ($endTime == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter end time";
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
				
				$dbfunction->InsertQuery("tbl_delivery_times", array("startTime"=>$startTime,"endTime" => $endTime,"isActive"=>$isActive,"createdTimestamp"=>time()));
				$urltoredirect = "deliverytime_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				$updatearray =array("startTime"=>$startTime,"endTime" => $endTime,"isActive"=>$isActive,"createdTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_delivery_times", $updatearray, "timeId='" .$id . "'");
				$urltoredirect = "deliverytime_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "تحرير الوقت :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "إضافة وقت :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> فسحة زمنية <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="deliverytime_list.php" class="btn btn-icon btn-primary glyphicons" title="عرض فتحات الوقت"><i class="icon-plus-sign"></i>عرض فتحات الوقت</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="deliverytime_list.php">فسحة زمنية</a></li>
						<li class="active"><?php echo $id==""?"إضافة":"تصحيح";?></li>
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
						<form  id="addForm" class="form-horizontal" enctype="multipart/form-data" name="addForm"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">وقت البدء:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="startTime" value="<?php echo (isset($startTime) ? $startTime : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">وقت النهاية:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="endTime" value="<?php echo (isset($endTime) ? $endTime : ""); ?>" required />
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
											if ($_GET["timeId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'deliverytime_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
							</fieldset>
							<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($timeId) ? $timeId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["timeId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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