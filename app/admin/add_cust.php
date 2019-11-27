<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_cust"; 
	$pageurl    	 = "add_cust.php";
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	$cancelurl = "";
	if (isset($_GET["custId"]) && $_GET["custId"] != "")
    {
		$id = $_GET["custId"];
		$dbfunction->SelectQuery("tbl_customers", "tbl_customers.*",$dbfunction->db_safe("tbl_customers.custId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$custId = stripslashes(trim($objsel["custId"]));
		$fullName = stripslashes(trim($objsel["fullName"]));
		$username = stripslashes(trim($objsel["username"]));
		$password = stripslashes(trim(base64_decode($objsel["password"])));
		$houseNo = stripslashes(trim($objsel["houseNo"]));
		$building = stripslashes(trim($objsel["building"]));
		$street = stripslashes(trim($objsel["street"]));
		$districtId = stripslashes(trim($objsel["districtId"]));
		$cityId = stripslashes(trim($objsel["cityId"]));
		$email = stripslashes(trim($objsel["email"]));
		$phone = stripslashes(trim($objsel["phone"]));
		//$note = stripslashes(trim($objsel["note"]));
		$remainBalance = stripslashes(trim($objsel["remainBalance"]));
		$isActive = stripslashes($objsel["isActive"]);
	}
	
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$fullName =  $myfilter->process(trim($_POST["fullName"]));
		$username =  $myfilter->process(trim($_POST["username"]));
		$password =  $myfilter->process(trim($_POST["password"]));
		$houseNo =  $myfilter->process(trim($_POST["houseNo"]));
		$building =  $myfilter->process(trim($_POST["building"]));
		$street =  $myfilter->process(trim($_POST["street"]));
		$districtId =  $myfilter->process(trim($_POST["districtId"]));
		$dbfunction->SelectQuery("tbl_districts", "tbl_districts.cityId","tbl_districts.districtId =".$districtId);
		$objsel = $dbfunction->getFetchArray();
		$cityId =  $myfilter->process(trim($objsel["cityId"]));
		$email =  $myfilter->process(trim($_POST["email"]));
		$phone =  $myfilter->process(trim($_POST["phone"]));
		$remainBalance =  $myfilter->process(is_numeric($_POST["remainBalance"])?$_POST["remainBalance"]:0);
		$isActive = (isset($_POST["isActive"])?$_POST["isActive"]:"0");
		$action 	= $myfilter->process($_POST["action"]);
		if ($action =="add" )
		$dbfunction->SelectQuery("tbl_customers", "tbl_customers.custId","(email ='$email' OR phone='$phone') AND isDeleted='0'");
		else
		$dbfunction->SelectQuery("tbl_customers", "tbl_customers.custId","(email ='$email' OR phone='$phone') AND custId!='$id' AND isDeleted='0'");		
		$objsel = $dbfunction->getFetchArray();
		
		if ($objsel["custId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Email or phone already exist";
		}
		
		elseif ($fullName == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter name";
		}
		elseif ($email == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter email";
		}
		elseif ($phone == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter phone number";
		}
	/*	elseif ($username == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter username"; 
		}*/
		elseif ($password == "")
        {
			$error1 = "1";
			$errormessage1 = "Please enter password";
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
			
				$dbfunction->SelectQuery("tbl_districts", "tbl_districts.*","tbl_districts.districtId =".$districtId);
				$objsel = $dbfunction->getFetchArray();
				$dbfunction1->SelectQuery("tbl_cities", "tbl_cities.*","tbl_cities.cityId =".$cityId);
				$objsel1 = $dbfunction1->getFetchArray();
				if($houseNo!='')
				$address .= ' '.$houseNo;	
				if($building!='')
				$address .= ' '.$building;	
				if($street!='')
				$address .= ' '.$street;	
				if($districtId!='')
				$address .= ', '.$objsel['districtName'];
				if($cityId!='')
				$address .= ', '.$objsel1['cityName'];
			if($action == "add")
            {
				$encode_password=base64_encode($password);
				$dbfunction->InsertQuery("tbl_customers", array("fullName" =>$fullName,"email" => $email,"cityId" =>$cityId,"districtId" => $districtId,"street" => $street,"building" => $building,"houseNo" => $houseNo,"address" => $address,"phone"=>$phone,"username" => $username,"password" => $encode_password,"remainBalance"=>$remainBalance,"isActive"=>$isActive,"smsVerified"=>'1',"created"=>date('Y-m-d H:i:s'),"createdTimestamp"=>time()));
				$lastInsertId = $dbfunction->getLastInsertedId();
				$dbfunction->SelectQuery("tbl_districts", "tbl_districts.*","tbl_districts.districtId =".$districtId);
				$objsel = $dbfunction->getFetchArray();
				$custId = $objsel1['cityCode'].$objsel['districtCode'].$lastInsertId;
				$dbfunction->UpdateQuery("tbl_customers", array("custId"=>$custId), "autoId='" .$lastInsertId . "'");
				$urltoredirect = "cust_list.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				$encode_password=base64_encode($password);
				$updatearray =array("fullName" =>$fullName,"email" => $email,"cityId" =>$cityId,"districtId" => $districtId,"street" => $street,"building" => $building,"houseNo" => $houseNo,"address" => $address,"phone"=>$phone,"username" => $username,"password" => $encode_password,"remainBalance"=>$remainBalance,"isActive"=>$isActive,"modified"=>date('Y-m-d H:i:s'),"modifiedTimestamp"=>time());
				$dbfunction->UpdateQuery("tbl_customers", $updatearray, "custId='" .$id . "'");
				$urltoredirect = "cust_list.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "تعديل زبون - ".SITE_NAME;
			}
			else
			{
				echo "إضافة عميل - ".SITE_NAME;
			}
		?></title>
		<?php include("js-css-head.php"); ?>
		<?php include("meta-settings.php"); ?>
	</head>
	<body class="tooltips" onload="getDists(<?php echo $cityId?>,<?php echo $districtId?>)">
	
	
		<div class="wrapper page-content">
			<?php include("header.php"); ?>
			<!-- Sidebar menu & content wrapper -->
			    
				<!-- Sidebar Menu -->
				<?php include("leftside.php"); ?>
				<!-- // Sidebar Menu END -->
			<div id="page-content"> 
				<!-- Content -->
				<div id="content" class="container-fluid">
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> زبون <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="cust_list.php" class="btn btn-icon btn-primary glyphicons" title="عرض العملاء"><i class="icon-plus-sign"></i>عرض العملاء</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="cust_list.php">زبون</a></li>
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
									<label class="col-lg-3 control-label">الاسم الكامل:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="fullName" value="<?php echo (isset($fullName) ? $fullName : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
							<div class="form-group">
									<label class="col-lg-3 control-label">:مدينة:</label>
									<div class="col-lg-5">
										<select class="form-control" name="cityId" onchange="getDists(this.value)" required>
											<option value="">-- اختر واحدة --</option>
											<?php
												$dbfunction1 	 = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_cities WHERE isActive='1' AND isDeleted='0' ORDER BY cityName");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($cityId==trim($objsel1["cityId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["cityId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["cityName"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group" id="divDists"> </div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">شارع:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="street" value="<?php echo (isset($street) ? $street : ""); ?>" required/>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">بناء:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="building" value="<?php echo (isset($building) ? $building : ""); ?>"  />
									</div>

								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">رقم المنزل:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="houseNo" value="<?php echo (isset($houseNo) ? $houseNo : ""); ?>" />
									</div>
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
										<input type="text" class="form-control" name="phone" value="<?php echo (isset($phone) ? $phone : ""); ?>" maxlength="10" required />
									</div> 
									<span class="errorstar">&nbsp;*</span>
								</div>

								
								<!--<div class="form-group">
									<label class="col-lg-3 control-label">اسم المستخدم:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="username" value="<?php echo (isset($username) ? $username : ""); ?>" required />
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>-->
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
									<label class="col-lg-3 control-label">الرصيد:</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" name="remainBalance" value="<?php echo (($remainBalance>0) ? $remainBalance : ""); ?>" placeholder="LIKE: 5 OR -5" />
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
											if ($_GET["custId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'cust_list.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($custId) ? $custId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["custId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
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
	<script>
	function getDists(id,district=false) {
    if (id.length == 0) { 
        document.getElementById("divDists").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divDists").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "get_districts.php?id=" + id + "&districtId="+district, true);
        xmlhttp.send();
    }
   }
   </script>
</html>																																	