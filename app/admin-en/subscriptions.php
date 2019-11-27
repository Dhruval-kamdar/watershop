<?php
	include("../include/config.inc.php");
	include('../include/sendNotification.php');
	include("session.php");
	
	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "subscriptions";
	$pageurl    = "subscriptions.php";
	$currtime = time();
	
	if($converter->decode($_REQUEST['action'])=="approveSubscription")
	{
		$id = $converter->decode($_REQUEST['id']);
		$updatedata = array("status"=>"1");
		
		$dbfunction->UpdateQuery("tbl_subscriptions",$updatedata , "subId='$id'");
		
		$dbfunction-> SimpleSelectQuery("select c.* from `tbl_customers` c inner join tbl_subscriptions o on c.custId=o.custId where o.subId='$id'");
		$result = $dbfunction->getFetchArray();
		$deviceToken = $result['deviceToken'];
		$badge = $result['badge'];
		$custId = $result['custId'];
		//$text = "Your subscription #".$id." is approved. We will inform you before 24 hours on delivery.";
		//$text = ".مقبول .ونحن سوف أبلغكم قبل 24 ساعة على  تسليم ".$id." اشتراكك ";
		$text1 = "اشتراكك رقم ".$id." مقبول.  سوف نذكركم كل مرة قبل توصيل الطلب بـ #HOURS# ساعه";
		$text = str_replace("#HOURS#","٢٤",$text1);
		
		$type = 'subscription';
		
		if($result['deviceType']=='iphone')
			$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
			$result=sendToAndroid($deviceToken,$text,$type,$badge);	
			
		$postdata_noti['notText'] = $text;
		$postdata_noti['notTypeId'] = '14';
		$postdata_noti['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification" , $postdata_noti );	
		$lastid = $dbfunction->getLastInsertedId();	
		
		$postdata_noti_his['notId'] = $lastid;
		$postdata_noti_his['custId'] = $custId;
		$postdata_noti_his['sendTime'] = $currtime;
		$postdata_noti_his['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification_history" , $postdata_noti_his );	
		$lastid = $dbfunction->getLastInsertedId();	
		
		$geturldriver = "?suc=" . $converter->encode("5");
		$urltoredirect = $pageurl . $geturldriver;
		$generalFunction->redirect($urltoredirect);
	}
	if($converter->decode($_REQUEST['action'])=="cancelSubscription")
	{
		$id = $converter->decode($_REQUEST['id']);
		$updatedata = array("status"=>"2","cancelReason"=>$_POST['cancelReason']);
		
		$dbfunction->UpdateQuery("tbl_subscriptions",$updatedata , "subId='$id'");
		
		$dbfunction-> SimpleSelectQuery("select c.* from `tbl_customers` c inner join tbl_subscriptions o on c.custId=o.custId where o.subId='$id'");
		$result = $dbfunction->getFetchArray();
		$deviceToken = $result['deviceToken'];
		$badge = $result['badge'];
		$custId = $result['custId'];
		$text = $_POST['cancelReason']." :.تم إلغاء .سبب ".$id." اشتراكك";
		//$text = "Your subscription #".$id." is cancelled. Reason: ".$_POST['cancelReason'];
		
		$type = 'subscription';
		
		if($result['deviceType']=='iphone')
		$result=sendToIphone($deviceToken,$text,$type,$badge);
		else
		$result=sendToAndroid($deviceToken,$text,$type,$badge);	
		
		$postdata_noti['notText'] = $text;
		$postdata_noti['notTypeId'] = '14';
		$postdata_noti['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification" , $postdata_noti );	
		$lastid = $dbfunction->getLastInsertedId();	
		
		$postdata_noti_his['notId'] = $lastid;
		$postdata_noti_his['custId'] = $custId;
		$postdata_noti_his['sendTime'] = $currtime;
		$postdata_noti_his['createdTimestamp'] = $currtime;
		$autoId = $dbfunction->InsertQuery( "tbl_notification_history" , $postdata_noti_his );	
		$lastid = $dbfunction->getLastInsertedId();	
		
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
    <head><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?php  echo "View Subscription(s) :: Admin :: ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<script>
		var gridUrl = "subscription_grid.php";
		var viewUrl = "subscription_view.php";
		var actionUrl = "subscription_action.php";
		//var manageUrl = "subscription_manage.php";
		var cancelUrl = "subscription_cancel.php";
		</script>
        <?php include("js-css-head.php"); ?>
        <?php include("meta-settings.php"); ?>
	<script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script></head>
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
					<h1 class="page-heading">View Subscription(s) <small></small></h1>
					
					<!--<span class="pull-right" ><a href="add_cust.php" class="btn btn-icon btn-primary glyphicons" title="Add Subscription"><i class="icon-plus-sign"></i>Add Subscription</a></span>-->
					<!-- End page heading -->
				
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="subscriptions.php">Subscription</a></li>
						<li class="active">View</li>
						
					</ol>
					
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Subscription", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Subscription", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Subscription", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Subscription", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Subscription", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
						
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
					
						<table class="table table-striped table-hover" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									
									<th>Subscription#</th>
									<th>Customer</th>
									<th>Type</th>
									<th>Delivery Day&Time</th>
									<th>Next Delivery</th>
						
									<th>Status</th>
									<th>Action</th>
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
		
		
		<!-- Modal -->
		<div class="modal fade" id="viewModel" tabindex="-1" role="dialog" aria-labelledby="viewModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="viewModel">Subscription Details</h3>
			  </div>
			  <div class="panel-body" id="txtHint"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">Save</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">Close</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal End -->
		
		
		<!-- Modal -->
		<div class="modal fade" id="cancelModel" tabindex="-1" role="dialog" aria-labelledby="cancelModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="cancelModel">Cancel Subscription</h3>
			  </div>
			 <div class="panel-body" id="divCancelOrder">  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">Save</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">Close</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
		<script>
			var targetsCols = [0,1,2,3,4,5,6];
			var orderCols = [[0,"desc"]];	
			var buttonValue = ['excel', 'pdf'];
		</script>
		<?php include("js-css-footer.php");?>