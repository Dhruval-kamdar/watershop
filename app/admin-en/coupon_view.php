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
			<label class="col-lg-3 control-label-text">Coupon ID:</label>
			<div class="col-lg-6">
			<?php echo $objsel['couponId'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Coupon Code:</label>
			<div class="col-lg-6">
			<?php echo $objsel['couponCode'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Start Time:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['startTime'],true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Expiry Time:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['expiryTime'],true);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Discount:</label>
			<div class="col-lg-6">
			<?php echo $objsel['discountValue']. ' (' .$objsel['discountType'].')';?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Multi Use:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isMultiUse']!= 1)?'Yes':'No'; ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">Status:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'Deactive':'Active'; ?>
			</div>
		</div>
		</fieldset>
		</form>	