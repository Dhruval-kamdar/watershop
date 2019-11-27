<?php
	include("../include/config.inc.php");
	include('../include/sendNotification.php');
	include("session.php");
	
	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "inventory_list";
	$pageurl    = "inventory_list.php";
	
	
	if($converter->decode($_REQUEST['action'])=="manageOrder")
	{
		$updatedata = array("driverId" => $_POST['driverId'],"deliverySequence"=>$_POST["deliverySequence"],"orderStatus"=>"3");
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='" . $converter->decode($_POST['id']) . "'");
		$geturldriver = "?suc=" . $converter->encode("5");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
	}
	if($converter->decode($_REQUEST['action'])=="approveOrder")
	{
		$id = $converter->decode($_REQUEST['id']);
		$updatedata = array("orderStatus"=>"2");
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='$id'");
		
		$dbfunction-> SimpleSelectQuery("select c.* from `tbl_customers` c inner join tbl_orders o on c.custId=o.custId where o.invoiceNo='$id'");
		$result = $dbfunction->getFetchArray();
		$deviceToken = $result['deviceToken'];
		$badge = $result['badge'];
		//$text = "Your order #".$id." has been confirmed. We will inform you before delivery.";
		$text = "سوف نبلغكم عندما يكون الطلب بطريقه لك .".$id." تم تأكيد طلبك رقم";
		if($result['deviceType']=='iphone')
		$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
		$result=sendToAndroid($deviceToken,$text,$type,$badge);	
		$geturldriver = "?suc=" . $converter->encode("5");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
	}
	if($converter->decode($_REQUEST['action'])=="cancelOrder")
	{
		$id = $converter->decode($_REQUEST['id']);
		$updatedata = array("orderStatus"=>"6","cancelReason"=>$_POST['cancelReason']);
		$dbfunction->UpdateQuery("tbl_orders",$updatedata , "invoiceNo='$id'");
		$dbfunction-> SimpleSelectQuery("select c.* from `tbl_customers` c inner join tbl_orders o on c.custId=o.custId where o.invoiceNo='$id'");
		$result = $dbfunction->getFetchArray();
		$deviceToken = $result['deviceToken'];
		$badge = $result['badge'];
		$text = $_POST['cancelReason']." :سبب .".$id." تم إلغاء طلبك رقم";
		//$text = "Your order #".$id." is cancelled. Reason: ".$_POST['cancelReason'];
		if($result['deviceType']=='iphone')
		$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
		$result=sendToAndroid($deviceToken,$text,$type,$badge);	
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
        <title><?php  echo "مستودع الطلبات - ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<script>
		var gridUrl = "inventory_grid.php";
		//var viewUrl = "order_view.php";
		//var actionUrl = "order_action.php";
		//var manageUrl = "order_manage.php";
		//var cancelUrl = "order_cancel.php";
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
					<h1 class="page-heading">مستودع الطلبات<small></small></h1>
					
					<!--<span class="pull-right" ><a href="add_cust.php" class="btn btn-icon btn-primary glyphicons" title="Add مستودع الطلبات"><i class="icon-plus-sign"></i>Add مستودع الطلبات</a></span>-->
					<!-- End page heading -->
				
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="inventory_list.php">مستودع الطلبات</a></li>
						<li class="active">عرض</li>
						
					</ol>
					
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "المخزون", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "المخزون", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "المخزون", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "المخزون", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "المخزون", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
						
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
					
						<table class="table table-striped table-hover" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									
									<th>المنتج</th>
									<th>الكمية</th>
									
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
		

		<script>
			
						var gridUrl = "inventory_grid.php";			var viewUrl = "inventory_view.php";			var actionUrl = "inventory_action.php";			var targetsCols = [0,1];			var orderCols = [];				var buttonValue = [ 'excel', 'pdf' ];
			/*var dataTable = $('#dt-list').DataTable({
					"draw" : false,
					"paginate":false,
					"bFilter": false,
					"processing": true,
					"dom": 'Bfrtip',
					"buttons":  [ 'excel', 'pdf' ],
					"serverSide": true,
					"stateSave": true,
					"stateDuration": 60*30,
					"columnDefs": [ {
						  "targets": 0,
						  "orderable": false,
						  "searchable": false
						   
						} ],
						'aoColumnDefs': [{
						'bSortable': false,
						'aTargets': targetsCols
					}]	,
					"iDisplayLength" : 25 ,
					"pageLength" : 25,
					"order": orderCols,
					"ajax":{
						url :gridUrl, // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".dt-list-error").html("");
							$("#dt-list").append('<tbody class="dt-list-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
							$("#dt-list_processing").css("display","none");
							
						}
					}
			} );*/
		</script>
		<?php include("js-css-footer.php");?>