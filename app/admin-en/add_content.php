<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_content"; 
	$pageurl    	 = "add_content.php?key=".$_REQUEST["key"];
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	
	$cancelurl = "";
	
	
	//if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "")
	if (isset($_REQUEST["key"]) && $_REQUEST["key"] != "")	
    {
		
		//$id = $_GET["id"];
		//$dbfunction->SelectQuery("tbl_content", "tbl_content.*",$dbfunction->db_safe("id ='%1'", $converter->decode($id),'0'));
		$key = $_GET["key"];
		$dbfunction->SelectQuery("tbl_content", "tbl_content.*",$dbfunction->db_safe("field_key ='%1'", $converter->decode($key),'0'));
		$objsel = $dbfunction->getFetchArray();
		$id = stripslashes(trim($objsel["id"]));
		$field_title = stripslashes(trim($objsel["field_title"]));
		$field_value = stripslashes(trim($objsel["field_value"]));
		//$field_value_ar = stripslashes(trim($objsel["field_value_ar"]));
		$field_key = stripslashes(trim($objsel["field_key"]));
		$created = stripslashes(trim($objsel["created"]));
		$modified = stripslashes(trim($objsel["modified"]));
		$is_active = stripslashes($objsel["is_active"]);
		
	}
		
	if (isset($_POST["save"]) && $_POST["save"] != "") 
    {
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$id =  $myfilter->process(trim($_POST["id"]));
		$field_title =  (mysql_real_escape_string(trim($_POST["field_title"])));
		$field_value =  (mysql_real_escape_string(trim($_POST["field_value"])));
		//$field_value_ar =  (mysql_real_escape_string($_POST["field_value_ar"]));
		$field_key =  $myfilter->process(trim($_POST["field_key"]));
		$created =  $myfilter->process(trim($_POST["created"]));
		$modified =  $myfilter->process(trim($_POST["modified"]));
		$is_active = (isset($_POST["is_active"])?$_POST["is_active"]:"1");
		$action 	= $myfilter->process($_POST["action"]);
		
		if ($field_title == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Enter Title";
		}
		
		if ($field_value == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Enter Content";
		}
		
		
	
		/*elseif ($password == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Enter Password";
		}*/
		
		
		
		else
        {
			$urladd = "?key=".$converter->encode($field_key);
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
			function ProcessedImage($que_pic,$fieldname)
			{
				global $generalFunction;
				if ($que_pic != "")
				{
					if ($generalFunction->validAttachment($que_pic))
					{
						ini_set('max_execution_time', '999999');
						$orgfile_name = $que_pic;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$que_pic = $new_filename . time() . "." . $ext1;
					    if($fieldname == "que_pic"){
						$original = "../uploads/quiz/" . $que_pic;
						$path = "../uploads/quiz/";
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
							createthumb($original, $path.'320/'.$que_pic,300,300);
							//createthumb($original, $path.'80/'.$que_pic,80,80);
							//unlink($original);
						}
					}
				}
				else
				{
					$que_pic = $_POST['hdn_image'];
				}
				return $que_pic;
			}
			
			//$profileimage = $_FILES['que_pic']['name'];
			//$hdn_image = $_POST['hdn_image'];
			//$que_pic = ProcessedImage($profileimage,"que_pic");
			
			if($action == "add")
            {
				
				
				$dbfunction->InsertQuery("tbl_content",
				array(
				"field_title" => $field_title,
				"field_value" => $field_value,
				//"field_value_ar" => $field_value_ar,
				"is_active"=>$is_active,
				"created"=>date('Y-m-d H:i:s')));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$urltoredirect = "content_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				$updatearray =
				array(
				"field_title" => $field_title,
				"field_value" => $field_value,
				//"field_value_ar" => $field_value_ar,
				"is_active"=>$is_active,
				"modified"=>date('Y-m-d H:i:s')
				);
				
				$dbfunction->UpdateQuery("tbl_content", $updatearray, "id='" .$id . "'");
				$urltoredirect = "add_content.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Content :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Content :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"":"";?> Terms And Conditions <small></small></h1>
					<!-- End page heading -->
					<!--<span class="pull-right" ><a href="content_list.php" class="btn btn-icon btn-primary glyphicons" title="View Terms And Conditions"><i class="icon-plus-sign"></i>View Terms And Conditions</a></span>-->
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="add_content.php">Terms And Conditions</a></li>
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
						 }

							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Content", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Content", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Content", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Content", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Content", $lang["updatemodulemessage"]).'"); </script>';
								}
								
							}
						?>
						 
					<div class="the-box">
						<form  id="addForm1" class="form-horizontal" enctype="multipart/form-data" name="addForm"  action="<?php echo $pageurl; ?>" method="post">
							<fieldset>
								
								<div class="form-group">
									<label class="col-lg-1 control-label">Title:</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="field_title" value="<?php echo (isset($field_title) ? $field_title : ""); ?>" required />
									</div>
									
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								
								<div class="form-group">
									<label class="col-lg-1 control-label">Detail:</label>
									<div class="col-lg-10">
										<textarea  name="field_value" id="field_value" class="summernote-lg"><?=$field_value?></textarea>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>		
							
									<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-10 col-lg-offset-3">
									<?php
											if ($_GET["id"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'add_content.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="field_key" id="field_key" value="<?php echo (isset($field_key) ? $field_key : ""); ?>" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($id) ? $id : ""); ?>" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($id) ? $id : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["key"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
									
									
						</form>
								<!-- // Table END -->
					</div><!-- /.the-box -->
					</div>
			</div>
				<!-- // Terms And Conditions END --> 
			
			<div class="clearfix"></div>
			<!-- // Sidebar menu & content wrapper END -->
			
			<?php include("footer.php"); ?>
		
		</div><!-- /.wrapper -->
		<?php include("js-css-footer.php"); ?>
		
	</body>
	<script>
		var addForm1 = function() {
			var field_value = $('textarea[name="field_value"]').html($('#field_value').code());
		}
	</script>
</html>																																	