		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_cities where cityId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">رمز المدينة:</label>
			<div class="col-lg-6">
			<?php echo $objsel['cityCode'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">اسم المدينة:</label>
			<div class="col-lg-6">
			<?php echo $objsel['cityName'];?>
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