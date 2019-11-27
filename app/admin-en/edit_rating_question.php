<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "edit_rating_question"; 
	$pageurl    	 = "edit_rating_question.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	$cancelurl = "";
	
	if (isset($_GET["queId"]) && $_GET["queId"] != "")
    {
		$id = $_GET["queId"];
		$dbfunction->SelectQuery("tbl_rating_questions", "tbl_rating_questions.*",$dbfunction->db_safe("tbl_rating_questions.queId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$queId = stripslashes(trim($objsel["queId"]));
		$que = stripslashes(trim($objsel["que"]));
		$keyVal = stripslashes(trim($objsel["keyVal"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$que =  $myfilter->process(trim($_POST["que"]));
		$keyVal =  $myfilter->process(trim($_POST["keyVal"]));
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$action 	= $myfilter->process($_POST["action"]);
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_rating_questions", "tbl_rating_questions.queId","(que ='$que') AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_rating_questions", "tbl_rating_questions.queId","(que ='$que') AND queId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["queId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Question Already Exist";
		}
		
		elseif ($que == "")
        {
			$error1 = "1";
			$errormessage1 = "Question Already Exist";
		}
		/*elseif ($keyVal == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter address";
		}
		elseif ($extraNotes == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter notes";
		}
		elseif ($extraNotes == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select type";
		}
		elseif ($companyEmail == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter companyEmail"; 
		}
		elseif ($companyWebsite == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter website";
		}*/
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
				$dbfunction->InsertQuery("tbl_rating_questions", array("que"=>$que,"keyVal" =>$keyVal,"created"=>date('Y-m-d H:i:s')));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$urltoredirect = "rating_question_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				
				
				$updatearray =array("que"=>$que,"keyVal" =>$keyVal,"modified"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_rating_questions", $updatearray, "queId='" .$id . "'");
				$urltoredirect = "rating_question_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Question :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Question :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Question <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="rating_question_list.php" class="btn btn-icon btn-primary glyphicons" title="View Question"><i class="icon-plus-sign"></i>View Question</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="rating_question_list.php">Question</a></li>
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
									<label class="col-lg-3 control-label">Question:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="que" required ><?php echo (isset($que) ? $que : ""); ?></textarea>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<input type="hidden" class="form-control" name="keyVal" value="<?php echo (isset($keyVal) ? $keyVal : ""); ?>" required />
								
								<input type="hidden" value="1" class="checkboxvalue" name="isActive" id="isActive" />&nbsp;
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["queId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'rating_question_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($queId) ? $queId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["queId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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