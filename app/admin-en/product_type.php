<?php
	include("../include/config.inc.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename = "product_type";
	$pageurl = "product_type.php";
	$converter = new encryption();
	$dbfunction = new dbfunctions();
	//print_r($_POST);exit;
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_1'])), "prdTypeId='1'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_2'])), "prdTypeId='2'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_3'])), "prdTypeId='3'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_4'])), "prdTypeId='4'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_5'])), "prdTypeId='5'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_6'])), "prdTypeId='6'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_7'])), "prdTypeId='7'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_8'])), "prdTypeId='8'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_9'])), "prdTypeId='9'");
		$dbfunction->UpdateQuery("tbl_product_types", array("prdType" => mysql_real_escape_string($_POST['id_10'])), "prdTypeId='10'");
		$generalFunction->redirect($pageurl . "?suc=" . $converter->encode("1"));
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
		<title><?php echo "Product Catagory :: Admin :: ".SITE_NAME;	?></title>
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
					<h1 class="page-heading">Product Catagory <small></small></h1>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						
						<li class="active">Product Catagory</a></li>
					</ol>
					<!-- End breadcrumb -->
					
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								$success = $converter->decode($_GET["suc"]);
								if ($success == 1)
                                {
									echo $generalFunction->getSuccessMessage("Product Type updated.");
								}
							}
						?>
                        <?php
							if (isset($error) && $error == "1")
                            {
								echo $generalFunction->getErrorMessage("Please enter correct Current Password.");
							}
						?>
						<?php
						$dbfunction->SelectQuery("tbl_product_types", "prdType,prdTypeId", "isActive='1' AND isDeleted='0'");
						while($objcheck = $dbfunction->getFetchArray())
						{
							if($objcheck['prdTypeId'] == '1')
								$id_1 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '2')
								$id_2 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '3')
								$id_3 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '4')
								$id_4 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '5')
								$id_5 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '6')
								$id_6 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '7')
								$id_7 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '8')
								$id_8 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '9')
								$id_9 = $objcheck['prdType'];
							elseif($objcheck['prdTypeId'] == '10')
								$id_10 = $objcheck['prdType'];		
						}
						?>
					<div class="the-box">
						<form  id="changepassword" class="form-horizontal" enctype="multipart/form-data" name="changepassword"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 1:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_1" value="<?=$id_1?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 2:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_2" value="<?=$id_2?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 3:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_3" value="<?=$id_3?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 4:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_4" value="<?=$id_4?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 5:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_5" value="<?=$id_5?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 6:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_6" value="<?=$id_6?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 7:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_7" value="<?=$id_7?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 8:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_8" value="<?=$id_8?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 9:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_9" value="<?=$id_9?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Product Cat 10:</label>
									<div class="col-lg-5">
										<input class="form-control" id="currentpassword" name="id_10" value="<?=$id_10?>" type="text" maxlength="16" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									
									
									<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="Save" tabindex="19">Update</button>
								
								</div>
								</div>
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									
									
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