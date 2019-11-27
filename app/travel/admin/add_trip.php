<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_trip"; 
	$pageurl    	 = "add_trip.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	
	if (isset($_GET["trip_id"]) && $_GET["trip_id"] != "")
    {
		$_SESSION["trip_paging"] = '"draw" : false,	"bProcessing": true,"bServerSide": true,"bStateSave": true,' ;
		$id = $_GET["trip_id"];
		$dbfunction->SelectQuery("tbl_trips", "tbl_trips.*",$dbfunction->db_safe("tbl_trips.trip_id ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$trip_id = stripslashes(trim($objsel["trip_id"]));
		$trip_name = stripslashes(trim($objsel["trip_name"]));
		$trip_details = stripslashes(trim($objsel["trip_details"]));
		$trip_photo = stripslashes(trim($objsel["trip_photo"]));
		$trip_type = stripslashes(trim($objsel["trip_type"]));
		$trip_address = stripslashes(trim($objsel["trip_address"]));
		$trip_city = stripslashes(trim($objsel["trip_city"]));
		$trip_country = stripslashes(trim($objsel["trip_country"]));
		$trip_continent = stripslashes(trim($objsel["trip_continent"]));
		$trip_price = json_decode(trim($objsel["trip_price"]));
		$trip_person = stripslashes(trim($objsel["trip_person"]));
		$trip_rating = stripslashes(trim($objsel["trip_rating"]));
		$is_active = stripslashes($objsel["is_active"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$trip_name =  $myfilter->process(trim($_POST["trip_name"]));
		$trip_details =  $myfilter->process(trim($_POST["trip_details"]));
		$trip_type =  $myfilter->process(trim($_POST["trip_type"]));
		$trip_address =  $myfilter->process(trim($_POST["trip_address"]));
		$trip_city =  $myfilter->process(trim($_POST["trip_city"]));
		$trip_country =  $myfilter->process(trim($_POST["trip_country"]));
		$trip_continent =  $myfilter->process(trim($_POST["trip_continent"]));
		$trip_price =  $myfilter->process(trim($_POST["trip_price"]));
		$trip_person =  $myfilter->process(trim($_POST["trip_person"]));
		$trip_rating =  $myfilter->process(trim($_POST["trip_rating"]));
		$is_active = $myfilter->process($_POST["is_active"]);
		$action 	= $myfilter->process($_POST["action"]);
		$dbfunction->SelectQuery("tbl_trips", "tbl_trips.trip_id","trip_name ='$trip_name' AND is_deleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["trip_id"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Trip Already Exist";
		}
		elseif ($action =="edit" && $objsel["trip_id"]!="" && $objsel["trip_id"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Trip Already Exist";
		}
		elseif ($trip_name == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Enter Trip Name";
		}
		elseif ($trip_city == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Enter Trip City";
		}
		elseif ($trip_country == "")
        {
			$error1 = "1";
			$errormessage1 = "Please Select Trip Country";
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
			function ProcessedImage($trip_photo,$fieldname)
			{
				global $generalFunction;
				if ($trip_photo != "")
				{
					if ($generalFunction->validAttachment($trip_photo))
					{
						//ini_set('max_execution_time', '999999');
						$orgfile_name = $trip_photo;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$trip_photo = "trip_" . time() . "." . $ext1;
					    if($fieldname == "trip_photo"){
						$original = "../uploads/trip/" . $trip_photo;
						$path = "../uploads/trip/";
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
							createthumb($original, $path.'150x150/'.$trip_photo,400,400);
						}
					}
				}
				else
				{
					$trip_photo = $_POST['hdn_image'];
				}
				return $trip_photo;
			}
			
			$profileimage = $_FILES['trip_photo']['name'];
			$hdn_image = $_POST['hdn_image'];
			$trip_photo = ProcessedImage($profileimage,"trip_photo");
			
			$dbcountry 	 = new dbfunctions();
			$dbcountry->SimpleSelectQuery("SELECT * FROM tbl_countries WHERE country_name='$trip_country'");
			$cntry = $dbcountry->getFetchArray();
			$trip_country_id = $cntry['country_id']; 
			$trip_continent_id = $cntry['continent_id']; 
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_trips", array("trip_type"=>$trip_type,"trip_name"=>$trip_name,"trip_details"=>$trip_details,"trip_photo"=>$trip_photo,"trip_address" => $trip_address,"trip_city" => $trip_city,"trip_continent_id" => $trip_continent_id,"trip_continent" => $trip_continent,"trip_country_id" => $trip_country_id,"trip_country" => $trip_country,"trip_price" =>$trip_price,"trip_person" => $trip_person,"trip_rating" => $trip_rating,"is_active"=>'1',"created_on"=>date('Y-m-d H:i:s')));
				$urltoredirect = "trip_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				$updatearray =array("trip_type"=>$trip_type,"trip_name"=>$trip_name,"trip_details"=>$trip_details,"trip_photo"=>$trip_photo,"trip_address" => $trip_address,"trip_city" => $trip_city,"trip_continent_id" => $trip_continent_id,"trip_continent" => $trip_continent,"trip_country_id" => $trip_country_id,"trip_country" => $trip_country,"trip_price" =>$trip_price,"trip_person" => $trip_person,"trip_rating" => $trip_rating,"is_active"=>$is_active,"updated_on"=>date('Y-m-d H:i:s'));
				$dbfunction->UpdateQuery("tbl_trips", $updatearray, "trip_id='" .$id . "'");
				$urltoredirect = "trip_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "Edit Trip :: Admin :: ".SITE_NAME;
			}
			else
			{
				echo "Add Trip :: Admin :: ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"Add":"Edit";?> Trip <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="trip_list.php" class="btn btn-icon btn-primary glyphicons" title="View Trips"><i class="icon-plus-sign"></i>View Trips</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="trip_list.php">Trip</a></li>
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
						<form  id="addProduct" class="form-horizontal" enctype="multipart/form-data" name="addProduct"  action="<?php echo $pageurl; ?>" method="post">
								<fieldset>
								<div class="form-group">
									<label class="col-lg-3 control-label">Trip Type:</label>
									<div class="col-lg-5">
										<select class="form-control" name="trip_type" required>
											<option value="">-- Select One --</option>
											<option value="island" <?=($trip_type=='island')?'selected':''?>>Islands</option>
											<option value="safari" <?=($trip_type=='safari')?'selected':''?>>World Safari</option>
											<option value="classic" <?=($trip_type=='classic')?'selected':''?>>Classics</option>
											<option value="medical" <?=($trip_type=='medical')?'selected':''?>>Madical</option>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
                                <div class="form-group">
									<label class="col-lg-3 control-label">Trip Name:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="trip_name" value="<?php echo (isset($trip_name) ? $trip_name : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Trip Details:</label>
									<div class="col-lg-5">
										<textarea class="form-control" name="trip_details" rows="5"/> <?php echo (isset($trip_details) ? $trip_details : ""); ?> </textarea>
									</div>
								</div>
								
								<div class="form-group">
								<label class="col-lg-3 control-label" for="trip_photo">Photo:</label>
							   
								   <div class="col-lg-5">
											<div class="checkbox">
											<input class="inputwidth" style="cursor:pointer;" id="trip_photo" name="trip_photo" type="file"  />
											</div>
								   </div>
								</div>
								<?php if ($trip_photo != "")
								{
								?>
								<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-5">
												<input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $trip_photo; ?>" />
												<img src="../uploads/trip/150x150/<?php echo $trip_photo; ?>" alt="Preview Image" height="100px" width="100px" style="border-radius:5px" />
								
									</div>
									
								</div>		
								<?php
								}
								?>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Address:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="trip_address" value="<?php echo (isset($trip_address) ? $trip_address : ""); ?>"  />
									</div>
									
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">City:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="trip_city" value="<?php echo (isset($trip_city) ? $trip_city : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Country:</label>
									<div class="col-lg-5">
										<select class="form-control" name="trip_country" required>
											<option value="">-- Select One --</option>
											<?php
												$dbfunction1  = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_countries WHERE is_active='1' AND is_deleted='0' ORDER BY country_name");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($trip_country==trim($objsel1["country_name"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["country_name"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["country_name"])); ?></option>
												<?php } ?>
										</select>
									</div>
									
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Price:</label>
									<div class="col-lg-5">
										<input type="number" class="form-control" name="trip_price" value="<?php echo (isset($trip_price) ? $trip_price : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">No. of Person:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="trip_person" value="<?php echo (isset($trip_person) ? $trip_person : ""); ?>" placeholder="e.g: 2-4" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Avg. Rating:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="trip_rating" value="<?php echo (isset($trip_rating) ? $trip_rating : "5"); ?>" />
									</div>
									
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Status:</label>
									<div class="col-lg-5">
										<div class="checkbox"><label><input type="checkbox" value="1" class="checkboxvalue" name="is_active" id="is_active" <?php echo (((isset($is_active) && $is_active == "1") || $is_active == "") ? "checked" : ""); ?> />&nbsp;</label></div>
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["trip_id"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'trip_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="Cancel">Cancel</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($trip_id) ? $trip_id : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["trip_id"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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