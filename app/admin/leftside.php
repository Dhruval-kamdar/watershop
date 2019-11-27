<?php
	$converter = new encryption();
	$Role = $_SESSION[SESSION_NAME . "role"];
	$RedirectURL = SITE_PATH.'dashboard.php';
	if ($pagename == "dashboard")
    {
		$dashboardclass = "dashboardactive";
	}
	else
    {
		$dashboardclass = "";
	}
	
	if($pagename == "admin_list" || $pagename == "add_admin" )
    {
		$adminCls = " active selected";
		$adminCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);	
	}
	else
    {
		$adminCls = "";
		$adminCls1 = "";
	}
	
	if($pagename == "cust_list" || $pagename == "add_cust" )
    {
		$vendorCls = " active selected";
		$vendorCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$vendorCls = "";
		$vendorCls1 = "";
	}
	
	
	if($pagename == "productlist" ||  $pagename == "product_type" || $pagename == "qty_unit_list" || $pagename == "add_qty_unit" )
    {
		$productCls = " active selected";
		$productCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$productCls = "";
		$productCls1 = "";
	}
	
	if($pagename == "product_list" || $pagename == "add_product"  || $pagename == "productlist")
    {
		$productCls = " active selected";
		$productCls1 = " visible";
		if($Role!="super_admin" && $Role!="inventory_management" )
		header('Location: ' . $RedirectURL);
	}


	if($pagename == "city_list" || $pagename == "add_city" || $pagename == "district_list" || $pagename == "add_district" )
    {
		$cityCls = " active selected";
		$cityCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$operatorCls = "";
		$operatorCls1 = "";
	}
	
	if($pagename == "order_list" || $pagename == "charity_order_list"  || $pagename == "inventory_list" )
    {
		$orderCls = " active selected";
		$orderCls1 = " visible";
		if($Role!="super_admin" && $Role!="order_management" && $Role!="account_management" )
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$orderCls = "";
		$orderCls1 = "";
	}
	if($pagename == "company_list" || $pagename == "add_company" || $pagename == "contact_companies")
    {
		$contactCls = " active selected";
		$contactCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$contactCls = "";
		$contactCls1 = "";
	}
	if($pagename == "contactus_list")
    {
		$contactUsCls = " active selected";
		$contactUsCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$contactUsCls = "";
		$contactUsCls1 = "";
	}
	if($pagename == "not_master_list" || $pagename == "not_type_list" || $pagename == "add_not_type" || $pagename == "not_cust_list")
    {
		$notMasterCls = " active selected";
		$notMasterCls1 = " visible";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
	}
	else
    {
		$masterCls = "";
		$masterCls1 = "";
	}
	
	if($pagename == "sitesettings" || $pagename == "changepassword" )
    {
		$settingclass = " active selected";
		if($Role!="super_admin")
		header('Location: ' . $RedirectURL);
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
							الصفحة الرئيسية
							<!--<span class="label label-success span-sidebar">UPDATED</span>-->
						</a>
					</li>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $adminCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-users icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							الصلاحيات
							</a>
						<ul class="submenu <?php echo $adminCls1; ?>">
							<li <?php echo (($pagename == "admin_list") ? ' class="selected"' : ""); ?>><a href="admin_list.php" title="قائمة المستخدمين">قائمة المستخدمين</a></li>
							<li <?php echo (($pagename == "add_admin") ? ' class="selected"' : ""); ?>><a href="add_admin.php" title="اضافة مستخدم ">اضافة مستخدم </a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $vendorCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-users icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							زبون
							</a>
						<ul class="submenu <?php echo $vendorCls1; ?>">
							<li <?php echo (($pagename == "cust_list") ? ' class="selected"' : ""); ?>><a href="cust_list.php" title="قائمة العملاء">قائمة العملاء</a></li>
							<li <?php echo (($pagename == "add_cust") ? ' class="selected"' : ""); ?>><a href="add_cust.php" title="إضافة عميل">إضافة عميل</a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin" || $Role=="inventory_management") { ?>
					<li class="<?php echo $productCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-shopping-cart icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							المنتج
							</a>
						<ul class="submenu <?php echo $productCls1; ?>">
						
							<li <?php echo (($pagename == "product_list") ? ' class="selected"' : ""); ?>><a href="product_list.php" title="قائمة المنتجات">قائمة المنتجات</a></li>

							<li <?php echo (($pagename == "add_product") ? ' class="selected"' : ""); ?>><a href="add_product.php" title="إضافة منتج">إضافة منتج</a></li>
							
							<!--<li <?php echo (($pagename == "productlist") ? ' class="selected"' : ""); ?>><a href="productlist.php" title="قائمة المنتجات">فئة ال الأسعار</a></li>-->
							
							<?php if($Role=="super_admin") { ?>
							<li <?php echo (($pagename == "product_type") ? ' class="selected"' : ""); ?>><a href="product_type.php" title="فئة المنتج">فئة المنتج</a></li>

							<li <?php echo (($pagename == "qty_unit_list" || $pagename == "add_qty_unit") ? ' class="selected"' : ""); ?>><a href="qty_unit_list.php" title="وحدة الكمية">وحدة الكمية</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin" || $Role=="order_management" || $Role=="account_management") { ?>
					<li class="<?php echo $orderCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-usd icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							الطلبات
						</a>
						<ul class="submenu <?php echo $orderCls1; ?>">
							<li <?php echo (($pagename == "order_list") ? ' class="selected"' : ""); ?>><a href="order_list.php" title="قائمة الطلبات">قائمة الطلبات</a></li>
							<li <?php echo (($pagename == "charity_order_list") ? ' class="selected"' : ""); ?>><a href="charity_order_list.php" title="طلبات خيرية">طلبات خيرية</a></li>
							
							<?php if($Role=="super_admin") { ?>
							<li <?php echo (($pagename == "inventory_list") ? ' class="selected"' : ""); ?>><a href="inventory_list.php" title="Total مستودع الطلبات">مستودع الطلبات</a></li>
							<?php } ?>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $contactCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							الشركة
						</a>
						<ul class="submenu <?php echo $contactCls1; ?>">
							<li <?php echo (($pagename == "company_list" || $pagename == "add_company") ? ' class="selected"' : ""); ?>><a href="company_list.php" title="قائمة الشركة">قائمة الشركة</a></li>
							<li <?php echo (($pagename == "contact_companies") ? ' class="selected"' : ""); ?>><a href="contact_companies.php" title="طلب الانضمام">طلب انضمام الشركات</a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $contactUsCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							الشركة
						</a>
						<ul class="submenu <?php echo $contactUsCls1; ?>">
							<li <?php echo (($pagename == "contactus_list") ? ' class="selected"' : ""); ?>><a href="contactus_list.php" title="اتصل بنا">اتصل بنا</a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $ratingCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							تقييم الخدمة 
						</a>
						<ul class="submenu <?php echo $ratingCls1; ?>">
							<li <?php echo (($pagename == "rating_question_list") ? ' class="selected"' : ""); ?>><a href="rating_question_list.php" title="قائمة الأسئلة">قائمة الأسئلة</a></li>
							<li <?php echo (($pagename == "rating_list") ? ' class="selected"' : ""); ?>><a href="rating_list.php" title="التقييم">التقييم</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $notMasterCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							إشعار
						</a>
						<ul class="submenu <?php echo $notMasterCls1; ?>">
							<li <?php echo (($pagename == "not_type_list") ? ' class="selected"' : ""); ?>><a href="not_type_list.php" title="نوع إعلام">نوع إعلام</a></li>
							<li <?php echo (($pagename == "add_not_type") ? ' class="selected"' : ""); ?>><a href="add_not_type.php" title="إضافة نوع إعلام">إضافة نوع</a></li>
							<li <?php echo (($pagename == "not_master_list" || $pagename == "not_cust_list") ? ' class="selected"' : ""); ?>><a href="not_master_list.php" title="الإشعارات">الإشعارات</a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $cityCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							مدينة
							</a>
						<ul class="submenu <?php echo $cityCls1; ?>">
							<li <?php echo (($pagename == "city_list" || $pagename == "add_city") ? ' class="selected"' : ""); ?>><a href="city_list.php" title="قائمة المدينة">قائمة المدينة</a></li>
							<li <?php echo (($pagename == "district_list" || $pagename == "add_district") ? ' class="selected"' : ""); ?>><a href="district_list.php" title="قائمة المناطق">قائمة المناطق</a></li>
							
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $deliveryCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							موعد التسليم
							</a>
						<ul class="submenu <?php echo $deliveryCls1; ?>">
							<li <?php echo (($pagename == "deliverytime_list") ? ' class="selected"' : ""); ?>><a href="deliverytime_list.php" title="فتحات الوقت">فتحات الوقت</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $contentCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							الشروط و الأحكام
							</a>
						<ul class="submenu <?php echo $contentCls1; ?>">
							<li <?php echo (($pagename == "add_content" || $pagename == "add_content") ? ' class="selected"' : ""); ?>><a href="add_content.php?key=<?=$converter->encode("terms")?>" title="الشروط و الأحكام">الشروط و الأحكام</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($Role=="super_admin") { ?>
					<li class="<?php echo $masterCls; ?>">
						<a href="#fakelink">
							<i class="fa fa-file-text icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							لوحة التحكم الخاصة بالتقييم
							</a>
						<ul class="submenu <?php echo $masterCls1; ?>">
							<li <?php echo (($pagename == "coupon_list" || $pagename == "add_coupon") ? ' class="selected"' : ""); ?>><a href="coupon_list.php" title="الخصومات و الكوبونات">كوبونات</a></li>
							<li <?php echo (($pagename == "app_settings" || $pagename == "app_settings") ? ' class="selected"' : ""); ?>><a href="app_settings.php" title="الإعدادات">الإعدادات</a></li>
						</ul>
					</li>
					<?php } ?>
				</ul>
			</div><!-- /.sidebar-left -->