<?php
	include("../include/config.inc.php");
	include("session.php");

	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "not_cust_list";
	$pageurl    = "not_cust_list.php";
	if($_GET['nid']!="")
	{
		$_SESSION['nid']=$_GET['nid'];
		unset($_SESSION['cid']);
	}
	else
	{
		$_SESSION['cid']=$_GET['cid'];
		unset($_SESSION['nid']);
	}
	if($converter->decode($_POST['action'])=="redeemPoints")
	{
		extract($_POST);
		$points = $purchasePoints-$redeemPoints;
		$points = ($points >=0)?$points:0;
		$updatedata = array("purchasePoints" => $points);
		$dbfunction->UpdateQuery("tbl_customers",$updatedata , "custId='" . $converter->decode($_POST['id']) . "'");
		$geturldriver = "?suc=" . $converter->encode("6");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
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
        <title><?php  echo "عرض العملاء - ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		
		<!--<script type="text/javascript" language="javascript" src="http://192.185.48.215/~lakadia7/projects/demo/matien/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="http://192.185.48.215/~lakadia7/projects/demo/matien/js/jquery.dataTables.js"></script>-->
        <?php include("js-css-head.php"); ?>
        <?php include("meta-settings.php"); ?>
	</head>
    <body onLoad="document.getElementById('st').focus();">
        <div class="container-fluid fluid menu-left">
            <?php include("header.php"); ?>
            <!-- Sidebar menu & content wrapper -->
            <div id="wrapper">     
                <!-- Sidebar Menu -->
                <?php include("leftside.php"); ?>
                <!-- // Sidebar Menu END -->
                <!-- Content -->
			
			
			
			<!-- BEGIN PAGE CONTENT -->
			<div class="page-content">
				<div class="container-fluid">
					<!-- Begin page heading -->
					<h1 class="page-heading">عرض الإشعارات <small></small></h1>
					
					<!--<span class="pull-right" ><a href="add_cust.php" class="btn btn-icon btn-primary glyphicons" title="إضافة عميل"><i class="icon-plus-sign"></i>إضافة عميل</a></span>-->
					<!-- End page heading -->
				
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="not_master_list.php">إشعار</a></li>
						<li class="active">عرض</li>
						
					</ol>
					
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "زبون", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "زبون", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "زبون", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "زبون", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "زبون", $lang["updatemodulemessage"]).'"); </script>';
								}
								elseif ($success == 6)
                                {
									
									echo '<script> getMessage("success","النقاط استردت بنجاح"); </script>';
								}
							}
						?>
						
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
					
						<table class="table table-striped table-hover display" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									<!--<th><span class="uniformjs"><input type="checkbox" id="selectall" value="0" name="selectall"  /></span> </th>-->
									
									<th>عميل</th>
									<th>اسم الزبون</th>
								
									<th>إشعار</th>
									
									<th>وقت الإرسال</th>
									<th>وقت القراءة</th>
								</tr>
							</thead>
							
						</table>
						
						<!--<button id="btnMultiDelete" class="btn btn-xs btn-danger" >حذف</button>
						<a class="notDialog" href="#notModel" data-toggle="modal" style="text-decoration:underline">
						<button id="btnMultiNot" class="btn btn-xs btn-success" >إرسال الإخطار</button>
						</a>-->
						</div>
					</div>
					<!-- END DATA TABLE -->
				</div><!-- /.container-fluid -->
				
				
				
				<!-- BEGIN FOOTER -->
				<?php include_once("footer.php"); ?>
				<!-- END FOOTER -->
				
				
			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
		
		<!-- Modal -->
		<div class="modal fade" id="viewModel" tabindex="-1" role="dialog" aria-labelledby="viewModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="viewModel">معلومات العميل</h3>
			  </div>
			  <div class="panel-body" id="txtHint"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal End -->
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="pointsModel" tabindex="-1" role="dialog" aria-labelledby="pointsModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="pointsModel">استبدال النقاط</h3>
			  </div>
			  <div class="panel-body" id="divRedeemPoints"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal End -->
		
		
		<!-- إشعار Modal -->
		<div class="modal fade" id="notModel" tabindex="-1" role="dialog" aria-labelledby="notModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="notModel">إشعار</h3>
			  </div>
			  <div class="panel-body" id="divNotification"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- إشعار Modal End-->
		
		<script>
		var gridUrl = "not_cust_grid.php";
		var viewUrl = "not_cust_view.php";
		var actionUrl = "not_cust_action.php";
		var targetsCols = [0,1,2,3,4];
		var orderCols = [[0,"desc"]];
		//var nid = "<?php echo $_GET['nid'];?>";
		//var cid = "<?php echo $_GET['cid'];?>";
	
			$(document).ready(function() {
			
				$(document).on("click", ".pointsDialog", function () {
					var id = $(this).data('id');
					 var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("divRedeemPoints").innerHTML = xmlhttp.responseText;
					}
					};
					
					xmlhttp.open("GET", "cust_redeem_points.php?id=" + id, true);
					xmlhttp.send();
				});	
				
				<!-- إشعار Modal End-->
				$(document).on("click", ".notDialog", function () {
					
					var id = $(this).data('id');
					 var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("divNotification").innerHTML = xmlhttp.responseText;
					}
					};
					
					xmlhttp.open("GET", "cust_not_dialog.php", true);
					xmlhttp.send();
					
				});
					<!-- إشعار Modal End-->
					
					
				$(document).on("click", "#btnSend", function () {
					
					var notTypeId = $("#notTypeId").val().trim();
					var notText = $("#notText").val().trim();
					if(notTypeId=="")
					{
						$("#notTypeId").css('border-color', 'red');
						return false;
					}
					if(notText=="")
					{
						$("#notText").css('border-color', 'red');
						$("#notTypeId").css('border-color', '');
						return false;
					}	
					
				if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
						
									var ids = [];
									$('.deleteRow').each(function(){
										if($(this).is(':checked')) { 
											ids.push($(this).val());
										}
									});
									var ids_string = ids.toString();  // array to string conversion 
									$.ajax({
										type: "POST",
										url: "cust_not_send.php",
										data: {data_ids:ids_string,notTypeId:notTypeId,notText:notText,"action":"notification"},
										success: function(result) {
											dataTable.draw(false); // redrawing datatable
											$('#selectall').attr('checked', false); // Unchecks it
											getMessage("success","تم إرسال الإشعار بنجاح");
										},
										async:false
									});
								
						}
						else
						{
							//bootbox.alert("Please check at least one checkbox");	
							bootbox.alert("يرجى التحقق من مربع اختيار واحد على الأقل");		
							return false;
						}
				
				});
				
				$(document).on("click", "#btnSave", function () {
					var purchase = $("#purchasePoints").val();
					var redeem = $("#redeemPoints").val();
					var diff = redeem-purchase;
					if(diff > 0 || isNaN(redeem))
					{
						//bootbox.alert("Maximum redeem points: "+purchase);
						bootbox.alert("الحد الأقصى لاستبدال النقاط: "+purchase);
						$("#redeemPoints").css('border-color', 'red');
						return false;
					}
					});
				} );
		</script>
		<?php include("js-css-footer.php");?>