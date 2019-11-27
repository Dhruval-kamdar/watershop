		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_drivers where driverId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['driverName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">اسم المستخدم:</label>
			<div class="col-lg-6">
			<?php echo $objsel['username'];?>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">البريد الإلكتروني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['email'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">رقم التواصل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['phone'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'غير نشط':'نشط'; ?>
			</div>
		</div>
		</fieldset>
		</form>	