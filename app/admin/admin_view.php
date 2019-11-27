		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_admin where AdminId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">البريد الإلكتروني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['AdminEmail'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الإسم:</label>
			<div class="col-lg-6">
			<?php echo $objsel['AdminName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الصلاحيات:</label>
			<div class="col-lg-6">
			<?php echo ucfirst(str_replace("_"," ",$objsel["AdminRole"]));?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-3 control-label-text">تاريخ التسجيل:</label>
			<div class="col-lg-6">
			<?=date('Y-m-d H:i',strtotime($objsel['created']));?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'Deactive':'Active'; ?>
			</div>
		</div>
		</fieldset>
		</form>	