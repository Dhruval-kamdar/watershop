﻿<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_operator"; 
	$pageurl    	 = "add_operator.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	function dateFormat($date, $format = false)
    {
		$date = date_create($date);
		if ($format == true)
        {
			return date_format($date, "y/m/d H:i:s");
		}
		else
        {
			return date_format($date, "d/m/Y");
		}
	}
	
	$cancelurl = "";
	
	
	if (isset($_GET["operatorId"]) && $_GET["operatorId"] != "")
    {
		$_SESSION["operator_paging"] = '"draw" : false,	"bProcessing": true,"bServerSide": true,"bStateSave": true,' ;
		$id = $_GET["operatorId"];
		$dbfunction->SelectQuery("tbl_operators", "tbl_operators.*",$dbfunction->db_safe("tbl_operators.operatorId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$operatorId = stripslashes(trim($objsel["operatorId"]));
		$email = stripslashes(trim($objsel["email"]));
		$operatorName = stripslashes(trim($objsel["operatorName"]));
		$username = stripslashes(trim($objsel["username"]));
		$password = stripslashes(trim(base64_decode($objsel["password"])));
		$timezone = stripslashes(trim($objsel["timezone"]));
		$phone = stripslashes(trim($objsel["phone"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$email =  $myfilter->process(trim($_POST["email"]));
		$operatorName =  $myfilter->process(trim($_POST["operatorName"]));
		$username =  $myfilter->process(trim($_POST["username"]));
		$password =  $myfilter->process(trim($_POST["password"])); 
		$timezone =  $myfilter->process(trim($_POST["timezone"]));
		$phone =  $myfilter->process(trim($_POST["phone"]));
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$action 	= $myfilter->process($_POST["action"]);
		
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_operators", "operatorId","(email ='$email' OR username='$username') AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_operators", "operatorId","(email ='$email' OR username='$username') AND operatorId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["operatorId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "البريد الإلكتروني or اسم المستخدم already exist";
		}
		elseif ($email == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter البريد الإلكتروني";
		}
		elseif ($operatorName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter First name";
		}
		elseif ($username == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter username";
		}
		elseif ($password == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter كلمة المرور";
		}
	
		
		elseif ($phone == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select رقم التواصل Number";
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
				
				$encode_password=base64_encode($password);
				$dbfunction->InsertQuery("tbl_operators", array("operatorName"=>$operatorName,"username" => $username,"password" =>$encode_password,"email" => $email,"timezone" => $timezone,"phone"=>$phone,"isActive"=>$isActive,"createdTimestamp"=>time()));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$urltoredirect = "operator_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				
				$encode_password=base64_encode($password);
				$updatearray =array("operatorName"=>$operatorName,"username" => $username,"password" => $encode_password,"email" => $email,"timezone" => $timezone,"phone"=>$phone,"isActive"=>$isActive,"modifiedTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_operators", $updatearray, "operatorId='" .$id . "'");
				$urltoredirect = "operator_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "تعديل Inventory Manager - ".SITE_NAME;
			}
			else
			{
				echo "Add Inventory Manager - ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> Inventory Manager <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="operator_list.php" class="btn btn-icon btn-primary glyphicons" title="View Inventory Manager"><i class="icon-plus-sign"></i>View Inventory Manager</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="operator_list.php">Inventory Manager</a></li>
						<li class="active"><?php echo $id==""?"إضافة":"تصحيح";?></li>
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
									<label class="col-lg-3 control-label">Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="operatorName" value="<?php echo (isset($operatorName) ? $operatorName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								 
								
								<div class="form-group">
									<label class="col-lg-3 control-label">البريد الإلكتروني:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="email" value="<?php echo (isset($email) ? $email : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">رقم التواصل:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="phone" value="<?php echo (isset($phone) ? $phone : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>

								
								<div class="form-group">
									<label class="col-lg-3 control-label">اسم المستخدم:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="username" value="<?php echo (isset($username) ? $username : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">كلمة المرور:</label>
									<div class="col-lg-5">
										<input type="password" class="form-control" name="password" value="<?php echo (isset($password) ? $password : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">أعد إدخال كلمة السر:</label>
									<div class="col-lg-5">
										<input type="password" class="form-control" name="confirmPassword" value="<?php echo (isset($password) ? $password : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
											
			
								<div class="form-group">
									<label class="col-lg-3 control-label">الحالة:</label>
									<div class="col-lg-5">
										<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isActive" id="isActive"<?php echo (((isset($isActive) && $isActive == "1") || $isActive == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>	
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["operatorId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'operator_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($operatorId) ? $operatorId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["operatorId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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