<?php

	include_once("../include/config.inc.php");
	include_once("session.php");
	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "trip_list";
	$pageurl    = "trip_list.php";
	if($_REQUEST['filter_trip_type']!='')
	$_SESSION['filter_trip_type'] = $_REQUEST['filter_trip_type'];
	else
	unset($_SESSION['filter_trip_type']);
	$filter_trip_type = $_SESSION['filter_trip_type'];
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
        <title><?php  echo "View Trip(s) :: Admin :: ".SITE_NAME; ?></title>
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
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
					<h1 class="page-heading">View Trip(s) <small></small></h1>
					<!-- End page heading -->
					<span class="pull-right" ><a href="add_trip.php" class="btn btn-icon btn-primary glyphicons" title="Add Trip"><i class="icon-plus-sign"></i>Add Trip</a></span>
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="trip_list.php">Trip</a></li>
						<li class="active">View</li>
					</ol>
						<div style="text-align:center">
					<form  id="addForm1" class="form-horizontal" enctype="multipart/form-data" name="addForm" method="post">
						<select name="filter_trip_type" class="form-control" style="display: inline;width: auto;">
                        	<option value="">All</option>		
							<option value="island" <?=($filter_trip_type=='island')?'selected':''?>>Islands</option>
							<option value="safari" <?=($filter_trip_type=='safari')?'selected':''?>>World Safari</option>
							<option value="classic" <?=($filter_trip_type=='classic')?'selected':''?>>Classics</option>
							<option value="medical" <?=($filter_trip_type=='medical')?'selected':''?>>Madical</option>
						</select>	
						<button type="submit" name="search" style="height:34px"> Go!</button>
					</form>	
					</div>
					<br>
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Trip", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Trip", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Trip", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Trip", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Trip", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
					
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
						<table class="table table-striped table-hover" id="dt-list">
							<thead class="the-box dark full">
								<tr>
									<th><span class="uniformjs"><input type="checkbox" id="selectall" value="0" name="selectall"  /></span> </th>
									<th>Type</th>
									<th>Trip Name</th>
									<th>Price</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
						</table>
						<button id="btnMultiDelete" class="btn btn-xs btn-danger" >Delete</button>
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
				<h3 class="modal-title" id="viewModel">Trip Info</h3>
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
			var gridUrl = "trip_grid.php";
			var viewUrl = "trip_view.php";
			var actionUrl = "trip_action.php";
			var targetsCols = [0,4,5];
			var orderCols = [[1,"asc"]];
		</script>
		
		<?php include("js-css-footer.php");?>
		
	