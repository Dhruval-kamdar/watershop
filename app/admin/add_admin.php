<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_admin"; 
	$pageurl    	 = "add_admin.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	
	
	$cancelurl = "";

	if (isset($_GET["AdminId"]) && $_GET["AdminId"] != "")
    {
		$_SESSION["admin_paging"] = '"draw" : false,	"bProcessing": true,"bServerSide": true,"bStateSave": true,' ;
		$id = $_GET["AdminId"];
		$dbfunction->SelectQuery("tbl_admin", "tbl_admin.*",$dbfunction->db_safe("tbl_admin.AdminId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$AdminId = stripslashes(trim($objsel["AdminId"]));
		$AdminEmail = stripslashes(trim($objsel["AdminEmail"]));
		$AdminName = stripslashes(trim($objsel["AdminName"]));
		$profilepic = stripslashes(trim($objsel["profilepic"]));
		$AdminPassword = stripslashes(trim($converter->decode($objsel["AdminPassword"])));
		$AdminRole = stripslashes(trim($objsel["AdminRole"]));
		$AdminPrivilege = stripslashes(trim($objsel["AdminPrivilege"]));
		$RoleId =  $objsel["RoleId"];
		$isActive = stripslashes($objsel["isActive"]);
		
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$AdminEmail =  $myfilter->process(trim($_POST["AdminEmail"]));
		$AdminName =  $myfilter->process(trim($_POST["AdminName"]));
		$AdminPassword =  $myfilter->process(trim($_POST["password"]));
		$AdminRole =  $myfilter->process(trim($_POST["AdminRole"]));
		$AdminPrivilege =  $myfilter->process(trim($_POST["AdminPrivilege"]));
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$RoleId =  trim($_POST["RoleId"]);
		$action 	= $myfilter->process($_POST["action"]);
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_admin", "tbl_admin.AdminId","(AdminEmail ='$AdminEmail') AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_admin", "tbl_admin.AdminId","(AdminEmail ='$AdminEmail') AND AdminId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["AdminId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "AdminEmail Already Exist";
		}
		elseif ($AdminName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter AdminName"; 
		}
		elseif ($AdminEmail == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter AdminEmail";
		}
		elseif ($AdminRole == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select AdminRole";
		}
		elseif ($AdminPassword == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Password";
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
			function ProcessedImage($profilepic,$fieldname)
			{
				global $generalFunction;
				if ($profilepic != "")
				{
					if ($generalFunction->validAttachment($profilepic))
					{
						ini_set('max_execution_time', '999999');
						$orgfile_name = $profilepic;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$profilepic = $new_filename . time() . "." . $ext1;
					    if($fieldname == "profilepic"){
						$original = "../uploads/profile/" . $profilepic;
						$path = "../uploads/profile/";
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
							createthumb($original, $path.'150x150/'.$profilepic,300,300);
							//createthumb($original, $path.'80/'.$profilepic,80,80);
						}
					}
				}
				else
				{
					$profilepic = $_POST['hdn_image'];
				}
				return $profilepic;
			}
			
			$profileimage = $_FILES['profilepic']['AdminName'];
			$hdn_image = $_POST['hdn_image'];
			$profilepic = ProcessedImage($profileimage,"profilepic");
			
			$query = mysqli_query($dbConn,"SELECT * FROM tbl_admin_roles WHERE roleId='$RoleId'");
			$row =mysqli_fetch_array($query);
			$AdminRole = $row['roleKey'];
			// echo $AdminRole;
			// print_r($loopVariables);exit;
			// foreach($MODULES as $mdl) {
			// foreach($MODULESSUPERVISOR as $mdl) {
			// foreach($MODULESCUSTOMERSERVICES as $mdl) {
			// foreach($MODULESACCOUNTANT as $mdl) {

			foreach($PRIVILEGE as $prvl) 
			{ 
				$pr[] = $prvl;
			}
			
			foreach($loopVariables as $mdl) {
				foreach($pr as $p) {
					$AdminPrivilege[] = $p."_".str_replace(" ","_",$mdl);
				}
			}
			//$Privileges = json_encode($AdminPrivilege);

			if($action == "add")
            {
				
				$encode_password=$converter->encode($AdminPassword);
				$dbfunction->InsertQuery("tbl_admin", array("AdminName" => $AdminName,"AdminPassword" =>$encode_password,"AdminEmail" => $AdminEmail,"AdminRole" => $AdminRole,"isActive"=>$isActive,"RoleId" => $RoleId,"AdminPrivilege" => $Privileges,"created"=>date('Y-m-d H:i:s')));
				$lastAddActivityId = $dbfunction->getLastInsertedId();
				/*$dbfunction->InsertActivityQuery("tbl_log_activities", array(
					"admin_id" => $_SESSION[SESSION_NAME."userid"],
					"user_id" => $lastAddActivityId,
					"plateform" => 'WEB',
					"module_name" => "Admin",
					"message"=> $_SESSION['bst_displayname']. "has added a new admin named as $AdminName",
					"message_ar" => "قام ".$_SESSION['bst_displayname']. " بإضافة مستخدم مسؤول جديد يسمى $AdminName",
					"description"=> serialize($_POST),
					"location"=> '',"latitude"=> '',"longitude"=> '',
					"ip_address"=> $_SERVER['SERVER_ADDR'],
					"created"=>date('Y-m-d H:i:s')));*/

				$urltoredirect = "admin_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
          
				$encode_password=$converter->encode($AdminPassword);
				$updatearray =array("AdminName" => $AdminName,"AdminPassword" =>$encode_password,"AdminEmail" => $AdminEmail,"AdminRole" => $AdminRole,"isActive"=>$isActive,"RoleId" => $RoleId,"AdminPrivilege" => $Privileges,"modified"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_admin", $updatearray, "AdminId='" .$id . "'");
				/*$dbfunction->InsertActivityQuery("tbl_log_activities", array(
					"admin_id" => $_SESSION[SESSION_NAME."userid"],
					"user_id" => $id,
					"plateform" => 'WEB',
					"module_name" => "Admin",
					"message"=> $_SESSION['bst_displayname']. "has edited for the admin user named as $AdminName",
					"message_ar" =>  "لقد قام ".$_SESSION['bst_displayname']." بتحرير المستخدم الإداري المسمى بـ $AdminName",
					"description"=> serialize($updatearray),
					"description_old"=> serialize($objsel),
					"location"=> '',"latitude"=> '',"longitude"=> '',
					"ip_address"=> $_SERVER['SERVER_ADDR'],
					"created"=>date('Y-m-d H:i:s')));*/
				
				$urltoredirect = "admin_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
				$generalFunction->redirect($urltoredirect);
				
			}
		}
	}
	$query = mysqli_query($dbConn,"SELECT * FROM tbl_admin_roles WHERE isActive=1");
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
				echo "Edit Admin :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Admin :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> الصلاحيات <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="admin_list.php" class="btn btn-icon btn-primary glyphicons" title="View Admin"><i class="icon-plus-sign"></i>عرض المشرفين</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="admin_list.php">الصلاحيات</a></li>
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
									<label class="col-lg-3 control-label">الإسم:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="AdminName" value="<?php echo (isset($AdminName) ? $AdminName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">البريد الإلكتروني:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="AdminEmail" value="<?php echo (isset($AdminEmail) ? $AdminEmail : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<input type="hidden" name="AdminRole" value="admin" />
								<!--<div class="form-group">
									<label class="col-lg-3 control-label">Role:</label>
									<div class="col-lg-5">
									<select class="form-control" name="AdminRole" required>	
									<option value="" >-- Select one --</option>
									<option value="super_admin" <?=($AdminRole=="super_admin")?"selected":""?>>Super Admin</option>
									<option value="admin" <?=($AdminRole=="admin")?"selected":""?>>Admin</option>
									</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>-->
								
								<div class="form-group">
									<label class="col-lg-3 control-label">كلمة المرور:</label>
									<div class="col-lg-5">
										<input type="password" class="form-control" name="password" value="<?php echo (isset($AdminPassword) ? $AdminPassword : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">إعادة كتابة كلمة المرور:</label>
									<div class="col-lg-5">
										<input type="password" class="form-control" name="confirmPassword" value="<?php echo (isset($AdminPassword) ? $AdminPassword : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">الأدوار:</label>
									<div class="col-lg-5">
										<select class="form-control roleId" name="RoleId" id="RoleId" required>
											<option value="">-- اختر الدور --</option>
											<?php  
												while( $row =mysqli_fetch_array($query) ) {
												?>
												<option <?= $row['roleId'] == $RoleId ? ' selected="selected"' : '';?> value="<?php echo $row['roleId']; ?>"><?php echo $row['roleNameAr']; ?></option>	
												<?php
												}
											?>
										</select>
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
											if ($_GET["AdminId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'admin_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($AdminId) ? $AdminId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["AdminId"]) || $action == "edit") ? "edit" : "add"); ?>" />
								
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