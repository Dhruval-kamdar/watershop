<?php

	include("../include/config.inc.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "deliverytime_list";
	$pageurl    = "deliverytime_list.php";
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
        <title><?php  echo "View Delivery Times :: Admin :: ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<?php include("js-css-head.php"); ?>
        <?php include("meta-settings.php"); ?>
	</head>
    <!--<body onLoad="document.getElementById('st').focus();">-->
	<body>
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
					<h1 class="page-heading">View Delivery Times <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="add_deliverytime.php" class="btn btn-icon btn-primary glyphicons" title="Add Delivery Time"><i class="icon-plus-sign"></i>Add Delivery Time</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="deliverytime_list.php">Delivery Time</a></li>
						<li class="active">View</li>
					</ol>
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								
								$success = $converter->decode($_GET["suc"]);
								if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Delivery Time", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Delivery Time", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Delivery Time", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Delivery Time", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Delivery Time", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
						<table class="table table-striped table-hover" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									<th><span class="uniformjs"><input type="checkbox" id="selectall" value="0" name="selectall"  /></span> </th>
									<th>Time</th>
									<th>Created At</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
						<button id="btnMultiDelete" class="btn btn-xs btn-danger">Delete</button>
						</div>
					</div>
					
				</div>
				<!-- BEGIN FOOTER -->
				<?php include_once("footer.php"); ?>
				<!-- END FOOTER -->
			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
	</div>
	
	
	<!-- Modal -->
		<div class="modal fade" id="viewModel" tabindex="-1" role="dialog" aria-labelledby="viewModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="viewModel">Delivery Time Info</h3>
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
		<script>
		var gridUrl = "deliverytime_grid.php";
		var viewUrl = "deliverytime_view.php";
		var actionUrl = "deliverytime_action.php";
		var targetsCols = [0,-1];
		var orderCols = [[1,"desc"]];
		</script>
		<?php include("js-css-footer.php");?>