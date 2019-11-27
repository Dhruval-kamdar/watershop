<?php
	$converter = new encryption();
	
	if ($pagename == "dashboard")
    {
		$dashboardclass = " dashboardactive";
	}
	else
    {
		$dashboardclass = "";
	}
	
	if($pagename == "cust_list" || $pagename == "add_cust" )
    {
		$vendorCls = " active selected";
		$vendorCls1 = " visible";
	}
	else
    {
		$vendorCls = "";
		$vendorCls1 = "";
	}
	
	if($pagename == "product_list" || $pagename == "add_product" || $pagename == "product_type" || $pagename == "qty_unit_list" || $pagename == "add_qty_unit" )
    {
		$productCls = " active selected";
		$productCls1 = " visible";
	}
	else
    {
		$productCls = "";
		$productCls1 = "";
	}
	
	if($pagename == "city_list" || $pagename == "add_city" || $pagename == "district_list" || $pagename == "add_district" )
    {
		$cityCls = " active selected";
		$cityCls1 = " visible";
	}
	else
    {
		$cityCls = "";
		$cityCls1 = "";
	}
	
	if($pagename == "deliverytime_list" || $pagename == "add_deliverytime" )
    {
		$deliveryCls = " active selected";
		$deliveryCls1 = " visible";
	}
	else
    {
		$deliveryCls = "";
		$deliveryCls1 = "";
	}
	if($pagename == "driver_list" || $pagename == "add_driver" || $pagename == "driver_hist" )
    {
		$driverCls = " active selected";
		$driverCls1 = " visible";
	}
	else
    {
		$driverCls = "";
		$driverCls1 = "";
	}
	if($pagename == "operator_list" || $pagename == "add_operator" )
    {
		$operatorCls = " active selected";
		$operatorCls1 = " visible";
	}
	else
    {
		$operatorCls = "";
		$operatorCls1 = "";
	}
	
	if($pagename == "order_list" || $pagename == "charity_order_list" || $pagename == "inventory_list" )
    {
		$orderCls = " active selected";
		$orderCls1 = " visible";
	}
	else
    {
		$orderCls = "";
		$orderCls1 = "";
	}
	if($pagename == "company_list" || $pagename == "add_company" ||  $pagename == "contact_companies")
    {
		$contactCls = " active selected";
		$contactCls1 = " visible";
	}
	else
    {
		$contactCls = "";
		$contactCls1 = "";
	}
	if($pagename == "not_master_list" || $pagename == "not_type_list" || $pagename == "add_not_type" || $pagename == "not_cust_list")
    {
		$notMasterCls = " active selected";
		$notMasterCls1 = " visible";
	}
	else
    {
		$notMasterCls = "";
		$notMasterCls1 = "";
	}
	if($pagename == "rating_question_list" || $pagename == "edit_rating_question" || $pagename == "rating_list" )
    {
		$ratingCls = " active selected";
		$ratingCls1 = " visible";
	}
	else
    {
		$ratingCls = "";
		$ratingCls1 = "";
	}
	if($pagename == "subscriptions" )
    {
		$subCls = " active selected";
		$subCls1 = " visible";
	}
	else
    {
		$subCls = "";
		$subCls1 = "";
	}
	if($pagename == "add_content")
    {
		$contentCls = " active selected";
		$contentCls1 = " visible";
	}
	else
    {
		$contentCls = "";
		$contentCls1 = "";
	}

	if($pagename == "coupon_list" || $pagename == "add_coupon"  || $pagename == "app_settings" 
	)
    {
		$masterCls = " active selected";
		$masterCls1 = " visible";
	}
	else
    {
		$masterCls = "";
		$masterCls1 = "";
	}
	
	if($pagename == "sitesettings" || $pagename == "changepassword" )
    {
		$settingclass = " active selected";
	}
	else
    {
		$settingclass = "";
	}
	
?>
<!-- Sidebar Menu -->

<!-- BEGIN SIDEBAR LEFT -->
			<div class="sidebar-left sidebar-nicescroller">
				<ul class="sidebar-menu">
					<li>
						<a href="dashboard.php">
							<i class="fa fa-dashboard icon-sidebar"></i>
							Dashboard
							<!--<span class="label label-success span-sidebar">UPDATED</span>-->
						</a>
					</li>
					
					<li class="<?php echo $vendorCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-users icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Customer
							</a>
						<ul class="submenu <?php echo $vendorCls1; ?>">
							<li <?php echo (($pagename == "cust_list") ? ' class="selected"' : ""); ?>><a href="cust_list.php" title="Customer list">Customer list</a></li>
							<li <?php echo (($pagename == "add_cust") ? ' class="selected"' : ""); ?>><a href="add_cust.php" title="Add Customer">Add Customer</a></li>
							
						</ul>
					</li>
					
					
					<li class="<?php echo $productCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-shopping-cart icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Product
							</a>
						<ul class="submenu <?php echo $productCls1; ?>">
							<li <?php echo (($pagename == "product_list") ? ' class="selected"' : ""); ?>><a href="product_list.php" title="Product list">Product list</a></li>
							<li <?php echo (($pagename == "add_product") ? ' class="selected"' : ""); ?>><a href="add_product.php" title="Add Product">Add Product</a></li>
							<li <?php echo (($pagename == "product_type") ? ' class="selected"' : ""); ?>><a href="product_type.php" title="Product Category">Product Category</a></li>
							<li <?php echo (($pagename == "qty_unit_list" || $pagename == "add_qty_unit") ? ' class="selected"' : ""); ?>><a href="qty_unit_list.php" title="Product Qty Unit">Product Qty Unit</a></li>
						</ul>
					</li>
					
					
					<li class="<?php echo $orderCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-usd icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Order
						</a>
						<ul class="submenu <?php echo $orderCls1; ?>">
							<li <?php echo (($pagename == "order_list") ? ' class="selected"' : ""); ?>><a href="order_list.php" title="Order list">Regular Orders</a></li>
							<li <?php echo (($pagename == "charity_order_list") ? ' class="selected"' : ""); ?>><a href="charity_order_list.php" title="Order list">Charity Orders</a></li>
							<li <?php echo (($pagename == "inventory_list") ? ' class="selected"' : ""); ?>><a href="inventory_list.php" title="Total Order Inventory">Order Inventory</a></li>
						</ul>
					</li>
					<li class="<?php echo $contactCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Company
						</a>
						<ul class="submenu <?php echo $contactCls1; ?>">
							<li <?php echo (($pagename == "company_list" || $pagename == "add_company") ? ' class="selected"' : ""); ?>><a href="company_list.php" title="Company Master">Company list</a></li>
							<li <?php echo (($pagename == "contact_companies") ? ' class="selected"' : ""); ?>><a href="contact_companies.php" title="Join Request">Company Request</a></li>
							
						</ul>
					</li>
					
					<li class="<?php echo $ratingCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Service Rating
						</a>
						<ul class="submenu <?php echo $ratingCls1; ?>">
							<li <?php echo (($pagename == "rating_question_list") ? ' class="selected"' : ""); ?>><a href="rating_question_list.php" title="Question list">Question list</a></li>
							<li <?php echo (($pagename == "rating_list") ? ' class="selected"' : ""); ?>><a href="rating_list.php" title="Rating list">Rating list</a></li>
						</ul>
					</li>
					<li class="<?php echo $notMasterCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Notification
						</a>
						<ul class="submenu <?php echo $notMasterCls1; ?>">
							<li <?php echo (($pagename == "not_type_list") ? ' class="selected"' : ""); ?>><a href="not_type_list.php" title="Notification Type">Type</a></li>
							<li <?php echo (($pagename == "add_not_type") ? ' class="selected"' : ""); ?>><a href="add_not_type.php" title="Add Notification Type">Add Type</a></li>
							<li <?php echo (($pagename == "not_master_list" || $pagename == "not_cust_list") ? ' class="selected"' : ""); ?>><a href="not_master_list.php" title="Notifications">Notifications</a></li>
							
						</ul>
					</li>
					<li class="<?php echo $cityCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							City
							</a>
						<ul class="submenu <?php echo $cityCls1; ?>">
							

							<li <?php echo (($pagename == "city_list" || $pagename == "add_city") ? ' class="selected"' : ""); ?>><a href="city_list.php" title="City list">City list</a></li>
							<li <?php echo (($pagename == "district_list" || $pagename == "add_district") ? ' class="selected"' : ""); ?>><a href="district_list.php" title="District list">District list</a></li>
							
						</ul>
					</li>
					<li class="<?php echo $deliveryCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Delivery Times
							</a>
						<ul class="submenu <?php echo $deliveryCls1; ?>">
							<li <?php echo (($pagename == "deliverytime_list") ? ' class="selected"' : ""); ?>><a href="deliverytime_list.php" title="Delivery Times">Delivery Times</a></li>
						</ul>
					</li>

					<li class="<?php echo $contentCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Terms
							</a>
						<ul class="submenu <?php echo $contentCls1; ?>">
							<li <?php echo (($pagename == "add_content" || $pagename == "add_content") ? ' class="selected"' : ""); ?>><a href="add_content.php?key=<?=$converter->encode("terms")?>" title="Terms & Conditions">Terms</a></li>
						</ul>
					</li>

					<li class="<?php echo $masterCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Masters
							</a>
						<ul class="submenu <?php echo $masterCls1; ?>">
							<li <?php echo (($pagename == "coupon_list" || $pagename == "add_coupon") ? ' class="selected"' : ""); ?>><a href="coupon_list.php" title="Coupon Management">Coupon Management</a></li>
							<li <?php echo (($pagename == "app_settings" || $pagename == "app_settings") ? ' class="selected"' : ""); ?>><a href="app_settings.php" title="Settings">Settings</a></li>
						</ul>
					</li>
					
				</ul>
			</div><!-- /.sidebar-left -->