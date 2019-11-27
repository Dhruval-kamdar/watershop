<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_product"; 
	$pageurl    	 = "add_product.php".(isset($_GET['prdId'])?"?prdId=".$_GET['prdId']:"");
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$cancelurl = "";

	//$Role = $_SESSION[SESSION_NAME . "role"];
	//if($_GET["prdId"] == "" && $Role!="super_admin")
	//header('Location: ' . SITE_PATH.'dashboard.php');	
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$prdName =  $myfilter->process(trim($_POST["prdName"]));
		$prdDescr =  $myfilter->process(trim($_POST["prdDescr"]));
		$prdTypeId =  $myfilter->process(trim($_POST["prdTypeId"]));
		$prdQty =  $myfilter->process(trim($_POST["prdQty"]));
		//$qtyUnitId =  $myfilter->process(trim($_POST["qtyUnitId"]));
		//$prdUnitPrice =  $myfilter->process(trim($_POST["prdUnitPrice"]));
		for($i=0;$i < count($_POST["qtyUnitId"]);$i++)
		{
			if($_POST["prdUnitPrice"][$i] > 0)
			{
				$price_count ++ ;
			}
			$d["qtyUnitId"] = $_POST["qtyUnitId"][$i];
			$d["qtyUnit"] = $_POST["qtyUnit"][$i];
			$d["prdUnitPrice"] = $_POST["prdUnitPrice"][$i];
			$d1[]=$d;
		}
		
		$qtyUnits =  $myfilter->process(json_encode($d1));
		$companyId = $myfilter->process($_POST["companyId"]);
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_products", "tbl_products.prdId","prdName ='$prdName' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["prdId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Product already exist";
		}
		elseif ($action =="edit" && $objsel["prdId"]!="" && $objsel["prdId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Product already exist";
		}
		elseif ($prdName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter name";
		}
		elseif ($prdTypeId == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select Product Type";
		}
		elseif ($price_count < 1)
        {
			$error1 = "1";
			$errormessage1 = "Please enter at least one quantity unit prices";
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
			function ProcessedImage($prdImage,$fieldname)
			{
				global $generalFunction;
				if ($prdImage != "")
				{
					if ($generalFunction->validAttachment($prdImage))
					{
						ini_set('max_execution_time', '999999');
						$orgfile_name = $prdImage;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$prdImage = time(). "_" . "." . $ext1;
					    if($fieldname == "prdImage"){
						$original = "../uploads/products/" . $prdImage;
						$path = "../uploads/products/";
						}
						$size = 112097152;
						if ($image > $size)
						{
							echo $Messages = "File Size should not be more than 2 mb";
							exit;
						}
						if (!move_uploaded_file($tmp_file, $original))
						{
							echo $Messages = "File not uploaded";
							exit;
						}
						else
						{
							createthumb($original, $path.'320/'.$prdImage,300,300);
							//createthumb($original, $path.'80/'.$prdImage,80,80);
						}
					}
				}
				else
				{
					$prdImage = $_POST['hdn_image'];
				}
				return $prdImage;
			}
			
			$profileimage = $_FILES['prdImage']['name'];
			$hdn_image = $_POST['hdn_image'];
			$prdImage = ProcessedImage($profileimage,"prdImage");
			
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_products", array("prdName"=>$prdName,"prdDescr"=>$prdDescr,"prdImage"=>$prdImage,"prdTypeId" => $prdTypeId,"qtyUnits" =>$qtyUnits,"companyId" => $companyId,"isActive"=>'1',"createdTimestamp"=>time()));
				$urltoredirect = "product_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				$updatearray =array("prdName"=>$prdName,"prdDescr"=>$prdDescr,"prdImage"=>$prdImage,"prdTypeId" => $prdTypeId,"qtyUnits" =>$qtyUnits,"companyId" => $companyId,"isActive"=>$isActive,"modifiedTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_products", $updatearray, "prdId='" .$id . "'");
				$urltoredirect = "product_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
				$generalFunction->redirect($urltoredirect);
			}
		}
	}
	
	if (isset($_GET["prdId"]) && $_GET["prdId"] != "")
    {
		$id = $_GET["prdId"];
		$dbfunction->SelectQuery("tbl_products", "tbl_products.*",$dbfunction->db_safe("tbl_products.prdId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$prdId = stripslashes(trim($objsel["prdId"]));
		$prdName = stripslashes(trim($objsel["prdName"]));
		$prdDescr = stripslashes(trim($objsel["prdDescr"]));
		$prdImage = stripslashes(trim($objsel["prdImage"]));
		$prdTypeId = stripslashes(trim($objsel["prdTypeId"]));
		$qtyUnits = json_decode(trim($objsel["qtyUnits"]));
		$companyId = stripslashes(trim($objsel["companyId"]));
		$prdQty = stripslashes(trim($objsel["prdQty"]));
		//$prdUnitPrice = stripslashes(trim($objsel["prdUnitPrice"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
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
				echo "تحرير المنتج - ".SITE_NAME;
			}
			else
			{
				echo "إضافة منتج - ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> المنتج <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="product_list.php" class="btn btn-icon btn-primary glyphicons" title="عرض المنتجات"><i class="icon-plus-sign"></i>عرض المنتجات</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="product_list.php">المنتج</a></li>
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
						<form  id="addProduct" class="form-horizontal" enctype="multipart/form-data" name="addProduct"  action="<?php echo $pageurl; ?>" method="post">
								<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">اسم المنتج:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="prdName" value="<?php echo (isset($prdName) ? $prdName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">وصف:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="prdDescr" maxlength="500" placeholder="Maximum 500 char" /><?php echo (isset($prdDescr) ? $prdDescr : ""); ?></textarea>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">فئة المنتج:</label>
									<div class="col-lg-5">
										<select class="form-control" name="prdTypeId" required>
											<option value="">-- اختر واحدة --</option>
											<?php
												$dbfunction1  = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT prdTypeId,prdType FROM tbl_product_types WHERE isActive='1' AND isDeleted='0' AND prdType!='' ORDER BY prdType");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($prdTypeId==trim($objsel1["prdTypeId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["prdTypeId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["prdType"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">الشركة المنتجة:</label>
									<div class="col-lg-5">
										<select class="form-control" name="companyId" required>
											<option value="">-- اختر واحدة --</option>
											<?php
												$dbfunction1  = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT companyId,companyName FROM tbl_companies WHERE isActive='1' AND isDeleted='0' ORDER BY companyName");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($companyId==trim($objsel1["companyId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["companyId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["companyName"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">الأسعار:</label>
									<div class="col-lg-5">
										<label class="col-lg-3 control-label">Unit </label>
									
										<label class="col-lg-2 control-label">Price </label>
									</div>
								</div>
								<?php
									$i=0;
									$dbfunction1 = new dbfunctions();
									$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_qty_units WHERE isActive='1' AND isDeleted='0' ORDER BY `order`");
									while ($objsel1 = $dbfunction1->getFetchArray())
                                    {
										if($qtyUnits[$i]->qtyUnitId == $objsel1["qtyUnitId"])
										$prdUnitPrice = $qtyUnits[$i]->prdUnitPrice;
										else
										$prdUnitPrice = "";	
									?>
								<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-5">
										
										<label class="col-lg-3 control-label"><?php echo $objsel1["qtyUnit"]; ?> </label>
									
										<label class="col-lg-2 control-label"><input type="text" name="prdUnitPrice[]" value="<?php echo $prdUnitPrice;?>" /></label>
										<input type="hidden" name="qtyUnitId[]" value="<?php echo $objsel1["qtyUnitId"]; ?>" />
										<input type="hidden" name="qtyUnit[]" value="<?php echo $objsel1["qtyUnit"]; ?>" />
									</div>
								</div>
								<?php $i++; } ?>
								
								<div class="form-group">
								<label class="col-lg-3 control-label" for="prdImage">صورة:</label>
							   
								   <div class="col-lg-5">
											<div class="checkbox">
											<input class="inputwidth" style="cursor:pointer;" id="prdImage" name="prdImage" type="file"  />
											</div>
								   </div>
								</div>
								<?php if ($prdImage != "")
								{
								?>
								<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-5">
												<input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $prdImage; ?>" />
												<img src="../uploads/products/320/<?php echo $prdImage; ?>" alt="صورة المعاينة" height="100px" width="100px" style="border-radius:5px" />
								
									</div>
									
								</div>		
								<?php
								}
								?>
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
											if ($_GET["prdId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'product_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($prdId) ? $prdId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["prdId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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