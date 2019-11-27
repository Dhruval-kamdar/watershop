		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_coupons where couponId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">هوية شخصية#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['couponId'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">رمز الكوبون:</label>
			<div class="col-lg-6">
			<?php echo $objsel['couponCode'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">وقت البداية:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['startTime'],true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">وقت النهاية:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['expiryTime'],true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الخصم:</label>
			<div class="col-lg-6">
			<?php echo $objsel['discountValue']. ' (' .$objsel['discountType'].')';?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">متعدد الاستخدام:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isMultiUse']!= 1)?'Yes':'No'; ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'غير نشط':'نشط'; ?>
			</div>
		</div>
		</fieldset>
		</form>	