<?php
	include("../include/config.inc.php");
	include("session.php");

	$generalFunction = new generalfunction();
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
	$pagename   = "admin_list";
	$pageurl    = "admin_list.php";
	
	if($converter->decode($_POST['action'])=="updatePrvl")  
	{
		$AdminId = $converter->decode($_POST['id']);
		$postdata['AdminPrivilege'] = json_encode($_POST['AdminPrivilege']);
		$dbfunction->UpdateQuery("tbl_admin", $postdata, "AdminId='" . $AdminId. "'");
		$dbfunction->SimpleSelectQuery("SELECT * FROM tbl_admin WHERE AdminId='".$AdminId."'");
			$selectQuery = $dbfunction->getFetchArray();
		/*$dbfunction->InsertQuery("tbl_log_activities", array(
					"admin_id" => $_SESSION[SESSION_NAME."userid"],
					"user_id" => $AdminId,
					"plateform" => 'WEB',
					"module_name" => "Admin",
					"message"=> $_SESSION['bst_displayname']." has updated privileges for the admin user named as ".$selectQuery['AdminName'],
					"message_ar"=> $_SESSION['bst_displayname']." has updated privileges for the admin user named as ".$selectQuery['AdminName'],
					"description"=> serialize($postdata['AdminPrivilege']),
					"description_old"=> serialize($selectQuery),
					"ip_address"=> $_SERVER['SERVER_ADDR'],
					"created"=>date('Y-m-d H:i:s')));*/
		$urltoredirect = "admin_list.php?suc=" . $converter->encode("6");
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
        <title><?php  echo "View Admin(s) :: Admin :: ".SITE_NAME; ?></title>
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
					<h1 class="page-heading">عرض المشرفين <small></small></h1>
					
					<span class="pull-right" ><a href="add_admin.php" class="btn btn-icon btn-primary glyphicons" title="Add Admin"><i class="icon-plus-sign"></i>إضافة مشرف</a></span>
					<!-- End page heading -->
					
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="admin_list.php">مشرف</a></li>
						<li class="active">عرض</li>
						
					</ol>
					
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
					
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Admin", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Admin", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Admin", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Admin", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Admin", $lang["updatemodulemessage"]).'"); </script>';
								}
								elseif ($success == 6)
                                {
									
									echo '<script> getMessage("success","Privileges updated successfully"); </script>';
								}
							}
						?>
						
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
					
						<table class="table table-striped table-hover display" id="dt-list" >
							<thead class="the-box dark full">
								<tr>
									<th><span class="uniformjs"><input type="checkbox" id="selectall" value="0" name="selectall"  /></span> </th>
									<!--<th>District</th>-->
									<th>البريد الإلكتروني</th>
									<th>الإسم</th>
									<th>الصلاحيات</th>
									<th>تاريخ التسجيل</th>
									<th>الحالة</th>
									<th>الإجراء</th>
								</tr>
							</thead>
							
						</table>
						
						<!--<button id="btnMultiDelete" class="btn btn-xs btn-danger" >Delete</button>-->
						
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
				<h3 class="modal-title" id="viewModel">معلومات المسؤول</h3>
			  </div>
			  <div class="panel-body" id="txtHint"> 
			  
			  </div>
			  <div class="modal-footer">
			  <!--<button data-bb-handler="success" type="button" class="btn btn-purple">Save</button>-->
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">إغلاق</button>
			  </div>
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal End -->
		
		
		
		<!-- Notification Modal -->
		<div class="modal fade" id="demoModel" tabindex="-1" role="dialog" aria-labelledby="demoModel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="demoModel">صلاحيات المسؤول</h3>
			  </div>
			  <div class="panel-body" id="modelBody"> 
			  
			  </div>
			  <!--<div class="modal-footer">
			  <button data-bb-handler="danger" data-dismiss="modal" type="button" class="btn btn-black">Close</button>
			  </div>-->
			  
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Notification Modal End-->
		
		<script>
		var demoUrl = "admin_privilege.php";
		var gridUrl = "admin_grid.php";
		var viewUrl = "admin_view.php";
		var actionUrl = "admin_action.php";
		var targetsCols = [0,4,5,6];
		var orderCols = [[4,"desc"]];
		var widthCols = [ null,null,null,null,null,null,{ "width": "19%"}];
		</script>
		<?php include("js-css-footer.php");?>