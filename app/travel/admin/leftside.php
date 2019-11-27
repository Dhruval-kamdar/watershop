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
	
	if($pagename == "trip_list" || $pagename == "add_trip")
    {
		$tripCls = " active selected";
		$tripCls1 = " visible";
	}
	else
    {
		$tripCls = "";
		$tripCls1 = "";
	}
	
	if($pagename == "order_list")
    {
		$orderCls = " active selected";
		$orderCls1 = " visible";
	}
	else
    {
		$orderCls = "";
		$orderCls1 = "";
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
	
	if($pagename == "content_list" || $pagename == "add_content")
    {
		$contentCls = " active selected";
		$contentCls1 = " visible";
	}
	else
    {
		$contentCls = "";
		$contentCls1 = "";
	}
	
	if($pagename == "content_list" || $pagename == "add_content" )
    {
		$contentCls = " active selected";
		$contentCls1 = " visible";
	}
	else
    {
		$contentCls = "";
		$contentCls1 = "";
	}
	
	if($pagename == "coupon_list" || $pagename == "add_coupon"  || $pagename == "country_list" || $pagename == "add_country"  
	|| $pagename == "departure_list" || $pagename == "add_departure" || $pagename == "arrival_list" || $pagename == "add_arrival"
	|| $pagename == "general_settings" 
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
					
					<li class="<?php echo $tripCls;?>">
						<a href="#fakelink">
							<i class="fa fa-users icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Trip
							</a>
						<ul class="submenu <?php echo $tripCls1; ?>">
							<li <?php echo (($pagename == "trip_list") ? ' class="selected"' : ""); ?>><a href="trip_list.php" title="Trip list">Trip list</a></li>
							<li <?php echo (($pagename == "add_trip") ? ' class="selected"' : ""); ?>><a href="add_trip.php" title="Add Trip">Add Trip</a></li>
							
						</ul>
					</li>
					
					<li class="<?php echo $orderCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-usd icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Booking
						</a>
						<ul class="submenu <?php echo $orderCls1; ?>">
							<li <?php echo (($pagename == "order_list") ? ' class="selected"' : ""); ?>><a href="order_list.php" title="Booking list"> Booking list</a></li>
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
					
					<li class="<?php echo $contentCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Contents
							</a>
						<ul class="submenu <?php echo $contentCls1; ?>">
							<li <?php echo (($pagename == "content_list" || $pagename == "add_content") ? ' class="selected"' : ""); ?>><a href="content_list.php" title="Contents">Content list</a></li>
						</ul>
					</li>

					<li class="<?php echo $masterCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Masters
							</a>
						<ul class="submenu <?php echo $masterCls1; ?>">
							<li <?php echo (($pagename == "country_list" || $pagename == "add_country") ? ' class="selected"' : ""); ?>><a href="country_list.php" title="Country Management">Country</a></li>
							<li <?php echo (($pagename == "departure_list" || $pagename == "add_departure") ? ' class="selected"' : ""); ?>><a href="departure_list.php" title="Departure Management">Departure</a></li>
							<li <?php echo (($pagename == "arrival_list" || $pagename == "add_arrival") ? ' class="selected"' : ""); ?>><a href="arrival_list.php" title="Arrival Management">Arrival</a></li>
							<li <?php echo (($pagename == "coupon_list" || $pagename == "add_coupon") ? ' class="selected"' : ""); ?>><a href="coupon_list.php" title="Coupon Management">Coupon</a></li>
							<li <?php echo (($pagename == "general_settings" || $pagename == "general_settings") ? ' class="selected"' : ""); ?>><a href="general_settings.php" title="Settings">Settings</a></li>
						</ul>
					</li>
					
				</ul>
			</div><!-- /.sidebar-left -->