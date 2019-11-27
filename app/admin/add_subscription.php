<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   	 = "add_subscription"; 
	$pageurl    	 = "add_subscription.php";
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
	
	if (isset($_GET["subId"]) && $_GET["subId"] != "")
    {
		$_SESSION["product_paging"] = '"draw" : false,	"bProcessing": true,"bServerSide": true,"bStateSave": true,' ;
		$id = $_GET["subId"];
		$dbfunction->SelectQuery("tbl_subscriptions", "tbl_subscriptions.*",$dbfunction->db_safe("tbl_subscriptions.subId ='%1'", $converter->decode($id),'0'));
		$objsel = $dbfunction->getFetchArray();
		$subId = stripslashes(trim($objsel["subId"]));
		$subTypeId = stripslashes(trim($objsel["subTypeId"]));
		$deliveryDay = stripslashes(trim($objsel["deliveryDay"]));
		$deliverySession = stripslashes(trim($objsel["deliverySession"]));
		$productDetails = json_decode(trim($objsel["productDetails"]),true);
		$prdصورة = stripslashes(trim($objsel["prdصورة"]));
		$prdQty = stripslashes(trim($objsel["prdQty"]));
		//$prdUnitPrice = stripslashes(trim($objsel["prdUnitPrice"]));
		$isActive = stripslashes($objsel["isActive"]);
		//$action = stripslashes($objsel["action"]);
		
	}
	//print_r($productDetails);exit;
	if (isset($_POST["save"]) && $_POST["save"] != "")
    {
		$myfilter   = new inputfilter();
		$id = $myfilter->process($_POST["id"]);
		$subTypeId_update =  $myfilter->process(trim($_POST["subTypeId"]));
		$deliveryDay_update =  $myfilter->process(trim($_POST["deliveryDay"]));
		$deliverySession_update =  $myfilter->process(trim($_POST["deliverySession"]));
		//$prdQty =  $myfilter->process(trim($_POST["prdQty"]));
		//$qtyUnitId =  $myfilter->process(trim($_POST["qtyUnitId"]));
		//$prdUnitPrice =  $myfilter->process(trim($_POST["prdUnitPrice"]));
		for($i=0;$i < count($_POST["prdId"]);$i++)
		{
			if($_POST["prdQty"][$i] != '0')
			{
				$d["prdId"] = $_POST["prdId"][$i];
				$d["prdQty"] = $_POST["prdQty"][$i];
				$d["qtyUnit"] = $_POST["qtyUnits"][$i];
				$d["prdName"] = $_POST["prdName"][$i];
				$d["prdصورة"] = $_POST["prdصورة"][$i];
				$d1[]=$d;
			}
		}
		$productDetails_update =  $myfilter->process(json_encode($d1));
			
		if($deliveryDay_update != $deliveryDay)
			$update_data = '1';
		else
			$update_data = '0';
		
		$nextDelivery_update = date("Y-m-d",strtotime('next '.$deliveryDay_update));
	
		if($deliverySession_update=='Morning')
			$deliveryTime_update ='9-11';
		elseif($deliverySession_update=='Afternoon')
			$deliveryTime_update ='11-1';
		else
			$deliveryTime_update ='1-3';
		//$isActive = $myfilter->process($_POST["isActive"]);
		$action 	= $myfilter->process($_POST["action"]);
		/*$dbfunction->SelectQuery("tbl_subscriptions", "tbl_subscriptions.subId","prdName ='$prdName' AND isDeleted='0'");
		$objsel = $dbfunction->getFetchArray();
		//print_r($action);exit;
		if ($action =="add" && $objsel["subId"]!="")
        {
			$error1 = "1";
			$errormessage1 = "Subscription already exist";
		}
		elseif ($action =="edit" && $objsel["subId"]!="" && $objsel["subId"]!=$id)
        {
			$error1 = "1";
			$errormessage1 = "Subscription already exist";
		}
		else*/if ($subTypeId_update == "")
        {
			$error1 = "1";
			$errormessage1 = "Please select Subscription Type";
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
			/*function Processedصورة($prdصورة,$fieldname)
			{
				global $generalFunction;
				if ($prdصورة != "")
				{
					if ($generalFunction->validAttachment($prdصورة))
					{
						ini_set('max_execution_time', '999999');
						$orgfile_name = $prdصورة;
						$image = $_FILES[$fieldname]['size'];
						$ext1 = $generalFunction->getExtention($orgfile_name);
						$file_name = $generalFunction->getFileName($orgfile_name);
						$new_filename = $generalFunction->validFileName($file_name);
						$tmp_file = $_FILES[$fieldname]['tmp_name'];
						$prdصورة = $new_filename . time() . "." . $ext1;
					    if($fieldname == "prdصورة"){
						$original = "../uploads/products/" . $prdصورة;
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
							createthumb($original, $path.'320/'.$prdصورة,300,300);
							//createthumb($original, $path.'80/'.$prdصورة,80,80);
						}
					}
				}
				else
				{
					$prdصورة = $_POST['hdn_image'];
				}
				return $prdصورة;
			}
			
			$profileimage = $_FILES['prdصورة']['name'];
			$hdn_image = $_POST['hdn_image'];
			$prdصورة = Processedصورة($profileimage,"prdصورة");*/
			
			
			if($action == "add")
            {
				$dbfunction->InsertQuery("tbl_subscriptions", array("prdName"=>$prdName,"prdDescr"=>$prdDescr,"prdصورة"=>$prdصورة,"subTypeId" => $subTypeId,"prdQty" => $prdQty,"productDetails" =>$productDetails,"isActive"=>'1',"createdTimestamp"=>time()));
				// $lastInsertId = $dbfunction->getLastInsertedId();
				// $dbfunction->InsertQuery("tbl_user_garage", array("id" => $lastInsertId, "OfferDesc" => $OfferDesc,"Offerصورة"=>$SiteLogo2,"IsActivate" => $Status));
				$urltoredirect = "subscriptions.php?suc=" . $converter->encode("4");
				$generalFunction->redirect($urltoredirect);
			}
			else
            {
				if($update_data == '1')
					$updatearray =array("subTypeId" => $subTypeId_update,"deliveryDay"=>$deliveryDay_update,"deliverySession"=>$deliverySession_update,"productDetails" =>$productDetails_update,"deliveryTime"=>$deliveryTime_update,"nextDelivery"=>$nextDelivery_update,"modifiedTimestamp"=>time());
				else
					$updatearray =array("subTypeId" => $subTypeId_update,"deliveryDay"=>$deliveryDay_update,"deliverySession"=>$deliverySession_update,"productDetails" =>$productDetails_update,"deliveryTime"=>$deliveryTime_update,"modifiedTimestamp"=>time());
				
				$dbfunction->UpdateQuery("tbl_subscriptions", $updatearray, "subId='" .$id . "'");
				$urltoredirect = "subscriptions.php" . ($urladd != "" ? $urladd . "&suc=" . $converter->encode("5") : "?suc=" . $converter->encode("5"));
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
				echo "تعديل Subscription - ".SITE_NAME;
			}
			else
			{
				echo "Add Subscription - ".SITE_NAME;
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
					<h1 class="page-heading"><?php echo $id==""?"إضافة":"تصحيح";?> Subscription <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="subscriptions.php" class="btn btn-icon btn-primary glyphicons" title="View Subscriptions"><i class="icon-plus-sign"></i>View Subscriptions</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="subscriptions.php">Subscription</a></li>
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
						<form  id="addSubscription" class="form-horizontal" enctype="multipart/form-data" name="addSubscription"  action="<?php echo $pageurl; ?>" method="post">
								<fieldset>
                                <div class="form-group">
									<label class="col-lg-3 control-label">Subscription Type:</label>
									<div class="col-lg-5">
									<?php
									$dbfunction1  = new dbfunctions();
									$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_subscription_types WHERE isActive='1' AND isDeleted='0'");
									while ($objsel1 = $dbfunction1->getFetchArray())
										{
											if($subTypeId==trim($objsel1["subTypeId"]))
											$isChecked ='checked';
											else
											$isChecked ='';
									?>
										<div class="radio">
											<label>
												<input type="radio" value="<?=$objsel1["subTypeId"]?>" class="i-grey" name="subTypeId" <?=$isChecked?> ><?=$objsel1["subType"]?>
											</label>
										</div>
									<?php }?>
										
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Delivery Day:</label>
									<div class="col-lg-5">
										<select class="form-control" name="deliveryDay" required>
											<option value='Sunday' <?=($deliveryDay==trim("Sunday"))?'selected':''?>>Sunday</option>
											<option value='Monday' <?=($deliveryDay==trim("Monday"))?'selected':''?>>Monday</option>
											<option value='Tuesday' <?=($deliveryDay==trim("Tuesday"))?'selected':''?>>Tuesday</option>
											<option value='Wednesday' <?=($deliveryDay==trim("Wednesday"))?'selected':''?>>Wednesday</option>
											<option value='Thursday' <?=($deliveryDay==trim("Thursday"))?'selected':''?>>Thursday</option>
											<option value='Friday' <?=($deliveryDay==trim("Friday"))?'selected':''?>>Friday</option>
											<option value='Saturday' <?=($deliveryDay==trim("Saturday"))?'selected':''?>>Saturday</option>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Delivery Session:</label>
									<div class="col-lg-5">
										<select class="form-control" name="deliverySession" required>
											<option value='Morning' <?=($deliverySession==trim("Morning"))?'selected':''?>>Morning</option>
											<option value='Afternoon' <?=($deliverySession==trim("Afternoon"))?'selected':''?>>Afternoon</option>
											<option value='Night' <?=($deliverySession==trim("Night"))?'selected':''?>>Night</option>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								<div class="form-group">
								<label class="col-lg-3 control-label">Products:</label>
									<div class="col-lg-5">
										<select data-placeholder="Choose a Products..." class="form-control chosen-select" tabindex="4" id="choose_product">
											<option value="Empty">Choose a Products...</option>
											<?php
										$dbfunction1  = new dbfunctions();
										$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_products WHERE isActive='1' AND isDeleted='0'");
										while ($objsel1 = $dbfunction1->getFetchArray())
											{
										?>
											<option value="<?=$objsel1['prdId'];?>"><?=$objsel1['prdName'];?></option>
										<?php }?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">List of Products:</label>
									<div class="col-lg-8">
										<label class="col-lg-2 control-label">صورة </label>
										<label class="col-lg-2 control-label">Name </label>
										<label class="col-lg-2 control-label">Type </label>
										<label class="col-lg-2 control-label">الكمية </label>
									</div>
								</div>
								<div class="form-group" id="more_product">
								<?php
								
									$i=0;
									while (!empty($productDetails[$i]))
                                    {
									?>
								
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-8">
										<label class="col-lg-2 control-label"><img src ="../uploads/products/320/<?=$productDetails[$i]['prdصورة']?>" height="50px" width ="50px"/></label>
										<label class="col-lg-2 control-label"><?=$productDetails[$i]['prdName']?></label>
										
										<label class="col-lg-2 control-label">
											<select name="qtyUnits[]"  class="form-control" required>
										<?php
										$dbfunction1  = new dbfunctions();
										$dbfunction1->SimpleSelectQuery("SELECT qtyUnits FROM tbl_products WHERE isActive='1' AND isDeleted='0' AND prdId='".$productDetails[$i]['prdId']."'");
										while ($objsel1 = $dbfunction1->getFetchArray())
											{
												$qtyUnits = json_decode(trim($objsel1["qtyUnits"]),true);
												$j=0;
												while (!empty($qtyUnits[$j]))
												{
													if($qtyUnits[$j]['prdUnitPrice']!='')
													{
										?>
												<option value="<?=$qtyUnits[$j]['qtyUnit']?>" <?=($productDetails[$i]['qtyUnit']==$qtyUnits[$j]['qtyUnit'])?'selected':''?> ><?=$qtyUnits[$j]['qtyUnit']?></option>
										<?php
													}
													$j++;
												}
											}
										?>
										</select>
										</label>
										<label class="col-lg-2 control-label">
											<select name="prdQty[]"  class="form-control" required>
												<option value="0" <?=($productDetails[$i]['prdQty']=='0')?'selected':''?>>0</option>
												<option value="1" <?=($productDetails[$i]['prdQty']=='1')?'selected':''?>>1</option>
												<option value="2" <?=($productDetails[$i]['prdQty']=='2')?'selected':''?>>2</option>
												<option value="3" <?=($productDetails[$i]['prdQty']=='3')?'selected':''?>>3</option>
												<option value="4" <?=($productDetails[$i]['prdQty']=='4')?'selected':''?>>4</option>
												<option value="5" <?=($productDetails[$i]['prdQty']=='5')?'selected':''?>>5</option>
												<option value="6" <?=($productDetails[$i]['prdQty']=='6')?'selected':''?>>6</option>
												<option value="7" <?=($productDetails[$i]['prdQty']=='7')?'selected':''?>>7</option>
												<option value="8" <?=($productDetails[$i]['prdQty']=='8')?'selected':''?>>8</option>
												<option value="9" <?=($productDetails[$i]['prdQty']=='9')?'selected':''?>>9</option>
											</select>
										</label>
										<input type="hidden" class="prdIdss" id="prdId" name="prdId[]" value="<?php echo $productDetails[$i]['prdId']; ?>" />
										<input type="hidden" name="prdصورة[]" value="<?php echo $productDetails[$i]['prdصورة']; ?>" />
										<input type="hidden" name="prdName[]" value="<?php echo $productDetails[$i]['prdName']; ?>" />
									</div>
								
								<?php $i++; } ?>
								</div>
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<?php
											if ($_GET["subId"] != "")
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
									<span class="span2"><button type="button" onClick="javascript: window.location.href = 'subscriptions.php<?php echo $cancelurl; ?>'" class="btn btn-primary" title="إلغاء">إلغاء</button></span>
								</div>
								</div>
								
							</fieldset>
									<input type="hidden" name="save" id="save" value="submit" />
									<input type="hidden" name="id" id="id" value="<?php echo (isset($subId) ? $subId : ""); ?>" />
									<input type="hidden" name="action" id="action" value="<?php echo ((isset($_GET["subId"]) || $action == "edit") ? "edit" : "add"); ?>" />
									
						</form>
								<!-- // Table END -->
					</div><!-- /.the-box -->
				</div>
			</div>
				<!-- // Content END --> 
			<script type="text/javascript">
				$('#choose_product').on('change', function() {
						var newPrdId  = this.value;
						var inArray = false;
						var inputs = document.getElementsByClassName("prdIdss"),
						prdArr = [];
						 
					  for(var i=0, len=inputs.length; i<len; i++){
						if(inputs[i].type === "hidden"){
						  prdArr.push(inputs[i].value);
						}
					  }
					  //console.log("array "+prdArr);
					  //console.log("new "+newPrdId);
					for(var i=0;i<prdArr.length;i++){
						if(prdArr[i] == newPrdId){
							inArray = true;
						}
					}
					if(inArray)
					{
						alert('Product already in subcription');
					}
					else
					{
						$.ajax({
						   type: "POST",
						   url: "add_subscr_product.php",
						   data: {prdIds:newPrdId},
						   cache: false,
							success: function(result)
							{
								//alert(result);
								 $("#more_product").append(result)
							}
						   
						 });
					}
					  //alert( this.value );
					  //[1, 2, 3].includes(2); 
				})
			</script>
			<div class="clearfix"></div>
			<!-- // Sidebar menu & content wrapper END -->
			
			<?php include("footer.php"); ?>
		
		</div><!-- /.wrapper -->
		<?php include("js-css-footer.php"); ?>
	</body>
</html>																																	