		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_companies where companyId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<?php
		$dbfunction->SimpleSelectQuery("select cityName from tbl_cities where cityId=".$objsel['cityId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">مدينة:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['cityName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">هوية شخصية#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['companyId'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">اسم الشركة:</label>
			<div class="col-lg-6">
			<?php echo $objsel['companyName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">البريد الإكتروني :</label>
			<div class="col-lg-6">
			<?php echo $objsel['companyEmail'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">رقم التواصل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['companyPhone'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الموقع الإلكتروني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['companyWebsite'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">التواصل مع أحد أفراد الشركة:</label>
			<div class="col-lg-6">
			<?php echo $objsel['contactPerson'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">ملاحظات إضافية:</label>
			<div class="col-lg-6">
			<?php echo $objsel['extraNotes'];?>
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