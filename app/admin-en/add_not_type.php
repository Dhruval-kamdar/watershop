<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_not_type"; 
	$pageurl    	 = "add_not_type.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	
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
	
	if ($_GET["st"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?st=" . $_GET["st"] : "&st=" . $_GET["st"]);
	}
	if ($_GET["page_no"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?page_no=" . $_GET["page_no"] : "&page_no=" . $_GET["page_no"]);
	}
	if ($_GET["sort"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?sort=" . $_GET["sort"] : "&sort=" . $_GET["sort"]);
	}
	if ($_GET["perpage"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?perpage=" . $_GET["perpage"] : "&perpage=" . $_GET["perpage"]);
	}
	if ($_GET["order"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?order=" . $_GET["order"] : "&order=" . $_GET["order"]);
	}
	if ($_GET["type"] != "")
    {
		$cancelurl .= ($cancelurl == "" ? "?type=" . $_GET["type"] : "&type=" . $_GET["type"]);
	}
	
	if (isset($_GET["notTypeId"]) && $_GET["notTypeId"] != "")
    {
		$_SESSION["nottype_paging"] = '"draw" : false,	"bProcessing": true,"bServerSide": true,"bStateSave": true,' ;
		$id = $_GET["notTypeId"];
		$dbfunction->SelectQuery("tbl_notification_types", "tbl_notification_types.*",$dbfunction->db_safe("tbl_notification_types.notTypeId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$notTypeId = stripslashes(trim($objsel["notTypeId"]));
		$notTypeTitle = stripslashes(trim($objsel["notTypeTitle"]));
		$notTypeIcon = stripslashes(trim($objsel["notTypeIcon"]));
		$notTypeApp = stripslashes(trim($objsel["notTypeApp"]));
		//$prdUnitPrice = stripslashes(trim($objsel["prdUnitPrice"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$notTypeTitle =  $myfilter->process(trim($_POST["notTypeTitle"]));
		$notTypeApp =  $myfilter->process(trim($_POST["notTypeApp"]));
		$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_notification_types", "tbl_notification_types.notTypeId","notTypeTitle ='$notTypeTitle' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["notTypeId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Type Already Exist";
		}
		elseif ($action =="edit" && $objsel["notTypeId"]!="" && $objsel["notTypeId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Type Already Exist";
		}
		elseif ($notTypeTitle == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Display Title";
		}
		elseif ($notTypeApp == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter Type Title";
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
			//$Sitelogo = $_FILES['teamid']['name'];
			//$Sitelogo2 = $_FILES['car_image']['name'];
			// $Sitelogo2 = $_FILES['OfferImage']['name'];
			// $Sitelogo3 = $_FILES['MovieImage3']['name'];
			//$hdn_image = $_POST['hdn_image'];
			function ProcessedImage($notTypeIcon,$fieldname)
			{
				global $generalFunction;
				if ($notTypeIcon != "")
				{
					if ($generalFunction->validAttachment($notTypeIcon))
					{
						ini_set('max_execution_time', '999999');
						$orgfile_name = $notTypeIcon;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$notTypeIcon = $new_filename . time() . "." . $ext1;
					    if($fieldname == "notTypeIcon"){
						$original = "../uploads/icons/" . $notTypeIcon;
						$path = "../uploads/icons/";
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
							createthumb($original, $path.'30/'.$notTypeIcon,30,30);
							//createthumb($original, $path.'80/'.$notTypeIcon,80,80);
						}
					}
				}
				else
				{
					$notTypeIcon = $_POST['hdn_image'];
				}
				return $notTypeIcon;
			}
			
			$profileimage = $_FILES['notTypeIcon']['name'];
			$hdn_image = $_POST['hdn_image'];
			$notTypeIcon = ProcessedImage($profileimage,"notTypeIcon");
			
			
			//$SiteLogo = ProcessedImage($Sitelogo,"teamid");
			//$car_image = ProcessedImage($Sitelogo2,"car_image");
			// $SiteLogo3 = ProcessedImage($Sitelogo3,"MovieImage3");
			
/*$GoogleAPI = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($AdvertiseDesc)."&sensor=false";
			$GoogleDatasInString = file_get_contents($GoogleAPI);
			$GoogleResult = json_decode($GoogleDatasInString,true);
			$Latitude = $GoogleResult['results'][0]['geometry']['location']['lat'];
			$Longitude = $GoogleResult['results'][0]['geometry']['location']['lng'];*/
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_notification_types", array("notTypeTitle"=>$notTypeTitle,"notTypeApp" => $notTypeApp,"notTypeIcon"=>$notTypeIcon,"isActive"=>'1',"createdTimestamp"=>time()));
				// $lastInsertId = $dbfunction->getLastInsertedId();
				// $dbfunction->InsertQuery("tbl_user_garage", array("id" => $lastInsertId, "OfferDesc" => $OfferDesc,"OfferImage"=>$SiteLogo2,"IsActivate" => $Status));
				$urltoredirect = "not_type_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				$updatearray =array("notTypeTitle"=>$notTypeTitle,"notTypeApp" => $notTypeApp,"notTypeIcon"=>$notTypeIcon,"isActive"=>$isActive,"modifiedTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_notification_types", $updatearray, "notTypeId='" .$id . "'");
				$urltoredirect = "not_type_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Type :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Type :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Notification Type <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="not_type_list.php" class="btn btn-icon btn-primary glyphicons" title="View Types"><i class="icon-plus-sign"></i>View Types</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="not_type_list.php">Notification Type</a></li>
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
						<form  id="addType" class="form-horizontal" enctype="multipart/form-data" name="addType"  action="<?php echo $pageurl; ?>" method="post">
								<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Display Title:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="notTypeTitle" value="<?php echo (isset($notTypeTitle) ? $notTypeTitle : ""); ?>" placeholder="Discount,Free delivery,Reduced,Issue etc" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Short Desc:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="notTypeApp" value="<?php echo (isset($notTypeApp) ? $notTypeApp : ""); ?>" placeholder="DISCOUNT,REDUCED,TECHNICAL ISSUE etc" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								
								
								
								<div class="form-group">
								<label class="col-lg-3 control-label" for="notTypeIcon">Icon:</label>
							   
								   <div class="col-lg-5">
											<div class="checkbox">
											<input class="inputwidth" style="cursor:pointer;" id="notTypeIcon" name="notTypeIcon" type="file"  />
											</div>
								   </div>
								</div>
								<?php if ($notTypeIcon != "")
								{
								?>
								<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-5">
												<input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $notTypeIcon; ?>" />
												<img src="../uploads/icons/<?php echo $notTypeIcon; ?>" alt="Preview Image" height="30px" width="30px" style="border-radius:5px" />
								
									</div>
									
								</div>		
								<?php
								}
								?>
								<div class="form-group">
									<label class="col-lg-3 control-label">Status:</label>
									<div class="col-lg-5">
										<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="isActive" id="isActive" <?php echo (((isset($isActive) && $isActive == "1") || $isActive == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["notTypeId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'not_type_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($notTypeId) ? $notTypeId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["notTypeId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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