		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_customers where custId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">هوية شخصية:</label>
			<div class="col-lg-6">
			<?php echo $objsel['custId'];?>
			</div>
		</div>
		<!--<div class="form-group">
			<label class="col-lg-3 control-label-text">اسم المستخدم:</label>
			<div class="col-lg-6">
			<?php echo $objsel['username'];?>
			</div>
		</div>-->
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الاسم الكامل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['fullName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">العنوان:</label>
			<div class="col-lg-6">
			<?php echo $objsel['address'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">البريد الإلكتروني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['email'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">رقم التواصل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['phone'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">النقاط:</label>
			<div class="col-lg-6">
			<?php echo $objsel['purchasePoints'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الرصيد:</label>
			<div class="col-lg-6">
			<?php echo $objsel['remainBalance'];?>
			</div>
		</div>
		<?php
		/*$dbfunction1 = new dbfunctions();
		$dbfunction1->SimpleSelectQuery("select avg(custRate) as avgRating from tbl_orders where custRate>0 and custId='".$objsel['custId']."'");
		$objsel1 = $dbfunction1->getFetchArray();*/
		?>
		<!--<div class="form-group">
			<label class="col-lg-3 control-label-text">Rating:</label>
			<div class="col-lg-6">
			<?php
			for($i=1;$i <= 10;$i++)
			{
				$j = round($objsel1['avgRating']);
				if($i <= $j)
					echo "<img src='../assets/img/star.png'>";
				else
					echo "<img src='../assets/img/star_grey.png'>";
			} ?>
			</div>
		</div>-->
		
		<div class="form-group">
			<label class="col-lg-3 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'غير نشط':'نشط'; ?>
			</div>
		</div>
		</fieldset>
		</form>	