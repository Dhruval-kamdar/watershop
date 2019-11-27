<?php
	include("../include/config.inc.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$pagename   = "productlist";
	$pageurl    = "productlist.php";
	$converter  = new encryption();
	$dbfunction = new dbfunctions();
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
        <title><?php  echo "View Product(s) :: Inventory Manager :: ".SITE_NAME; ?></title>
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
			<div class="page-content toggle1-old">
				
				
				<div class="container-fluid">
					<!-- Begin page heading -->
					<h1 class="page-heading">عرض المنتجات <small></small></h1>
					<!-- End page heading -->
					<!--<span class="pull-right" ><a href="add_product.php" class="btn btn-icon btn-primary glyphicons" title="إضافة منتج"><i class="icon-plus-sign"></i>إضافة منتج</a></span>-->
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="productlist.php">المنتج</a></li>
						<li class="active">عرض</li>
					</ol>
					<!-- End breadcrumb -->
					<?php
							if (isset($_GET["suc"]) && $_GET["suc"] != "")
                            {
								$success = $converter->decode($_GET["suc"]);
									if ($success == 1)
                                {
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Product", $lang["updatemessage-status"]).'"); </script>';
								}
								elseif ($success == 2)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Product", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 3)
                                {
									
									echo '<script> getMessage("error","'.str_replace("{modulename}", "Product", $lang["deletemodulemessage"]).'"); </script>';
								}
								elseif ($success == 4)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Product", $lang["addmodulemessage"]).'"); </script>';
								}
								elseif ($success == 5)
                                {
									
									echo '<script> getMessage("success","'.str_replace("{modulename}", "Product", $lang["updatemodulemessage"]).'"); </script>';
								}
							}
						?>
					
					<!-- BEGIN DATA TABLE -->
					<div class="the-box">
						<div class="table-responsive">
						<table class="table table-striped table-hover" id="dt-list">
							<thead class="the-box dark full">
								<tr>
									<!--<th><span class="uniformjs"><input type="checkbox" id="selectall" value="0" name="selectall"  /></span> </th>-->
									<th>اسم المنتج</th>
									<th>فئة المنتج</th>
									<th>الشركة المنتجة</th>
									<th>الأسعار</th>
									<th>اجراء</th>
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
				<h3 class="modal-title" id="viewModel">تفاصيل المنتج</h3>
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
		
		<script>
			var gridUrl = "products_grid.php";
			var viewUrl = "product_view.php";
			var actionUrl = "product_action.php";
			var targetsCols = [0,1,2,3,4];
			var orderCols = [[0,"asc"]];
			function Updates(ids,action)
				{
					bootbox.confirm("Do you want to continue?",function(r) {
					if(r==true)
					{ 
						var ids_string = ids.toString();  // array to string conversion 
						var prdName = document.getElementById("prdName_"+ids_string).value;
						var prdTypeId = document.getElementById("prdTypeId_"+ids_string).value;
						var companyId = document.getElementById("companyId_"+ids_string).value;
						var qtyUnitId = [];
						var qtyUnit = [];
						var prdUnitPrice = [];
						$("input.UnitId_"+ids).each(function (index)
						{
							var value = $(this).val();
							//Now how to i push it into the array properly?
							qtyUnitId.push(value);
						});
						$("input.Unit_"+ids).each(function (index)
						{
							var value = $(this).val();
							//Now how to i push it into the array properly?
							qtyUnit.push(value);
						});
						$("input.Price_"+ids).each(function (index)
						{
							var value = $(this).val();
							//Now how to i push it into the array properly?
							prdUnitPrice.push(value);
						});
						
						$.ajax({
							type: "POST",
							url: actionUrl,
							data: {
								action:action,
								data_ids:ids_string,
								prdName:prdName,
								prdTypeId:prdTypeId,
								companyId:companyId,
								qtyUnitId:qtyUnitId,
								qtyUnit:qtyUnit,
								prdUnitPrice:prdUnitPrice
								},
							success: function(result) {
								dataTable.draw(false); // redrawing datatable
								 getMessage("success","Product updated successfully");
							},
							async:false
						});
					}
					else
					{
						getMessage("cancelled","Cancelled");
					}
					});
				}
		
		</script>
		<?php if(isset($_SESSION['login_suc'])) { ?>
		<script> getMessage("loggedin","Login Successfully"); </script>
		<?php unset($_SESSION['login_suc']); } 
		
		include("js-css-footer.php");?>	
	
		
	