		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_contact_companies where id=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">هوية شخصية#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['id'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الصيت:</label>
			<div class="col-lg-6">
			<?php echo $objsel['name'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-3 control-label-text">رقم التواصل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['phone'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">البريد الإلكتروني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['email'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الرسالة:</label>
			<div class="col-lg-6">
			<?php echo $objsel['message'];?>
			</div>
		</div>
		<?php if($objsel['photo']!="") { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">صورة فوتوغرافية:</label>
			<div class="col-lg-6">
			<img  src="../uploads/contact/<?php echo $objsel['photo'];?>" alt="Preview Image" height="150" width="150" />
			</div>
		</div>
		<?php } ?>
		<?php if($objsel['video']!="") {
			$video = "../uploads/contact/".$objsel['video'];
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">فيديو:</label>
			<div class="col-lg-6">
				<video width="320" height="240" controls>
				  <source src="<?php echo $video; ?>" type="video/mp4">
				</video>
			</div>
		</div>
		<?php } ?>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">تستلم في:</label>
			<div class="col-lg-6">
			<?php echo $objsel['created'];?>
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