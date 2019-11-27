<?php
	include("../include/config.inc.php");
	include('../include/sendNotification.php');
	include("session.php");
	
	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "charity_order_list";
	$pageurl    = "charity_order_list.php";
	$currtime = time();
	
	if($converter->decode($_REQUEST['action'])=="manageOrder")
	{
		$updatedata = array("driverId" => $_POST['driverId'],"deliverySequence"=>$_POST["deliverySequence"],"orderStatus"=>"3");
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='" . $converter->decode($_POST['id']) . "'");
		$geturldriver = "?suc=" . $converter->encode("5");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
	}
	if($converter->decode($_REQUEST['action'])=="status")
	{
		$id = $converter->decode($_REQUEST['id']);
		$code = $converter->decode($_REQUEST['code']);
		if($code=='6')
		$updatedata = array("orderStatus"=>$code,"deliveryStatus"=>"1");
		else
		$updatedata = array("orderStatus"=>$code,"deliveryStatus"=>"0");	
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='$id'");
		
		$dbfunction-> SimpleSelectQuery("select c.* from `tbl_customers` c inner join tbl_orders o on c.custId=o.custId where o.invoiceNo='$id'");
		$result = $dbfunction->getFetchArray();
		$deviceToken = $result['deviceToken'];
		$custId = $result['custId'];
		$badge = $result['badge'];
		//$text = "Your order #".$id." has been confirmed. We will inform you before delivery.";
		if($code=='2')
		$text = "تم تأكيد طلبك رقم ".$id;
		elseif($code=='3')
		$text = "تم إعداد طلبك ".$id; 
		elseif($code=='4')
		$text = "طلبك على الطريق ".$id; 
		elseif($code=='5')
		$text = "طلبك من الباب ".$id; 
		elseif($code=='6')
		$text = "تم تسليم طلبك ".$id; 
		if($result['deviceType']=='iphone')
		$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
		$result=sendToAndroid($deviceToken,$text,$type,$badge);	
		
		$postdata_noti['notText'] = $text;
		$postdata_noti['notTypeId'] = '15';
		$postdata_noti['createdTimestamp'] = $currtime;
		if($code=='2' || $code=='6')
		{
		$autoId = $dbfunction->InsertQuery( "tbl_notification" , $postdata_noti );	
		$lastid = $dbfunction->getLastInsertedId();	
		$postdata_noti_his['notId'] = $lastid;
		$postdata_noti_his['custId'] = $custId;
		$postdata_noti_his['sendTime'] = $currtime;
		$postdata_noti_his['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification_history" , $postdata_noti_his );	
		$lastid = $dbfunction->getLastInsertedId();	
		}
		$geturldriver = "?suc=" . $converter->encode("5");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
	}
	if($converter->decode($_REQUEST['action'])=="cancelOrder")
	{
		$id = $converter->decode($_REQUEST['id']);
		$updatedata = array("orderStatus"=>"7","cancelReason"=>$_POST['cancelReason']);
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='$id'");
		$dbfunction-> SimpleSelectQuery("select c.*,o.remainBalance from `tbl_customers` c inner join tbl_orders o on c.custId=o.custId where o.invoiceNo='$id'");
		$result = $dbfunction->getFetchArray();
		mysql_query("update tbl_customers set remainBalance=remainBalance+".$result["remainBalance"]." where custId='".$result['custId']."'");
		$deviceToken = $result['deviceToken'];
		$badge = $result['badge'];
		$custId = $result['custId'];
		$text = $_POST['cancelReason']." :سبب .".$id." تم إلغاء طلبك رقم";
		//$text = "Your order #".$id." is cancelled. Reason: ".$_POST['cancelReason'];
		
		if($result['deviceType']=='iphone')
		$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
		$result=sendToAndroid($deviceToken,$text,$type,$badge);	
		
		$postdata_noti['notText'] = $text;
		$postdata_noti['notTypeId'] = '15';
		$postdata_noti['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification" , $postdata_noti );	
		$lastid = $dbfunction->getLastInsertedId();	
		
		$postdata_noti_his['notId'] = $lastid;
		$postdata_noti_his['custId'] = $custId;
		$postdata_noti_his['sendTime'] = $currtime;
		$postdata_noti_his['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification_history" , $postdata_noti_his );	
		
		$geturldriver = "?suc=" . $converter->encode("5");
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
        <title><?php  echo "عرض الطلبات - ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<script>
		var gridUrl = "charity_order_grid.php";
		var viewUrl = "order_view.php";
		var actionUrl = "order_action.php";
		var manageUrl = "order_manage.php";
		var cancelUrl = "order_cancel.php";
		var viewUrlCust = "cust_view.php";
		</script>
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
					<h1 class="page-heading">عرض الطلبات <small></small></h1>
					
					<!--<span class="pull-right" ><a href="add_cust.php" class="btn btn-icon btn-primary glyphicons" title="أضف طلب"><i class="icon-plus-sign"></i>أضف طلب</a></span>-->
					<!-- End page heading -->
				
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="charity_order_list.php">الطلبات</a></li>
						<li class="active">عرض</li>
						
					</ol>
					<div class="has-feedback">
						<form action="order_export.php?orderType=charity" method="post">
									<input type="hidden" name="opt" value="EXPORT" >
									<div class="col-lg-3" style="width : 27%"></div>
									<div class="col-lg-3" style="width: 16%;">
										<input class="form-control" id="startDate" name="startDate" value="" required=""  type="date" style="padding: 0px 12px;width: 160px;"><i style="display: none;" class="form-control-feedback" data-bv-field="name"></i>
									</div>
									<div class="col-lg-1" style="padding-top: 5px;width: 35px;padding-left: 12px;">
									<label>To</label>
									</div>
									<div class="col-lg-3" style="padding-left: 3px;width: 16%;">
										<input class="form-control" id="endDate" name="endDate" value="" required="" type="date" style="padding: 0px 12px;width: 160px;"><i style="display: none;" class="form-control-feedback" data-bv-field="name"></i>
									</div>
									<div class="col-lg-2" style="width: 16%;padding-left: 0px;padding-top: 2px;">
									<button type="button" name="exportdata1" id="exportdata1" value="exportdata1" class="btn btn-primary" title="Export Data" tabindex="19" style="height: 31px;padding: 4px 14px;">تصدير</button>
									<button type="submit" name="exportdata" id="exportdata" value="exportdata" class="btn btn-primary" title="Export Data" tabindex="19" style="display:none">تصدير</button>
									</div>
						</form>
					</div>
					<br/><br/>
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "الطلبات", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "الطلبات", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "الطلبات", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "الطلبات", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "الطلبات", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
						
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
					
						<table class="table table-striped table-hover" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									
									<th>الطلبات#</th>
									<th>عميل</th>
									<th>عدد الطلبات</th>
									<th>المجموع</th>
									<th>وقت الطلب</th>
									<th>وقت التوصيل</th>
									<!--<th>نوع الطلب والوقت</th>
									<th>تعيين سائق</th>-->
									<th>حالة الطلب</th>
									<th>اجراء</th>
								</tr>
							</thead>
							
						</table>
						
						
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
		
		<!-- CUSTOMER INFO Modal -->
		<div class="modal fade" id="viewModelCust" tabindex="-1" role="dialog" aria-labelledby="viewModelCust" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="viewModelCust">معلومات العميل</h3>
			  </div>
			  <div class="panel-body" id="txtHintCust"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- CUSTOMER INFO Modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="viewModel" tabindex="-1" role="dialog" aria-labelledby="viewModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="viewModel">تفاصيل الطلب</h3>
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
		
		<?php //include_once("order_manage.php"); ?>
		<!-- Modal -->
		<div class="modal fade" id="manageModel" tabindex="-1" role="dialog" aria-labelledby="manageModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="manageModel">ادارة الاوامر</h3>
			  </div>
			 <div class="panel-body" id="txtManage">  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal -->
		<div class="modal fade" id="cancelModel" tabindex="-1" role="dialog" aria-labelledby="cancelModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="cancelModel">الغاء الطلب</h3>
			  </div>
			 <div class="panel-body" id="divCancelOrder">  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">حفظ</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">قريب</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
		<script>
			//var targetsCols = [2,5,6,7,8,9];
			var targetsCols = [2,5,6,7];
			var orderCols = [[4,"desc"]];
			var buttonValue = ['excel', 'pdf'];	
			var orderType = "<?=($_GET['orderType'] !='')?$_GET['orderType']:'';?>";
			$(document).ready(function() {
			$(document).on("click", "#exportdata1", function () {
					
					var startDate = $("#startDate").val().trim();
					var endDate = $("#endDate").val().trim();
					var opt = "CHECK";
					if(startDate == '')
					{
						$("#startDate").css("border-color","red");
						return false;
					}
					else if(endDate == '')
					{
						$("#startDate").css("border-color","#ddd");
						$("#endDate").css("border-color", "red");
						return false;
					}
					else if(endDate < startDate)
					{
						$("#endDate").css("border-color", "red");
						getMessage("cancelled","To date must be greater than from date");
					}
					else
					{
						$("#startDate").css("border-color","#ddd");
						$("#endDate").css("border-color", "#ddd");
					 // array to string conversion 
						$.ajax({
							type: "POST",
							url: "order_export.php",
							data: {startDate:startDate,endDate:endDate,orderType:"charity",opt:opt},
							
							success: function(result) {
								//console.log(result);
								/*if(result == '					true')
								{
									$('#exportdata').click();
								}*/
								if(result == 'true')
								{
									$('#exportdata').click();
								}
								else if(result == 'false')
								{
									getMessage("cancelled","No record found for selected range of date");
								}
								else if(result == 'false1')
								{
									getMessage("cancelled","Try with less date interval to export");
								}
								else
								{
									getMessage("cancelled","No record found for selected range of date");
								}
							}
						});
					}
				});
		});
		</script>
		<?php include("js-css-footer.php");?>