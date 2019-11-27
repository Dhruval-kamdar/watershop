		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_notification_types where notTypeId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">عنوان العرض:</label>
			<div class="col-lg-6">
			<?php echo $objsel['notTypeTitle'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">وصف قصير:</label>
			<div class="col-lg-6">
			<?php echo $objsel['notTypeApp'];?>
			</div>
		</div>
		<?php if($objsel['notTypeIcon']!="") { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">أيقونة:</label>
			<div class="col-lg-6">
			<img  src="../uploads/icons/<?php echo $objsel['notTypeIcon'];?>" alt="صورة المعاينة"  />
			</div>
		</div>
		<?php } ?>
		
		
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'غير نشط':'نشط'; ?>
			</div>
		</div>
		
		</fieldset>
		</form>	