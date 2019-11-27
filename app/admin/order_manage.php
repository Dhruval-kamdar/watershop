		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_orders where invoiceNo=".$converter->decode($_REQUEST['id']));
		$objsel = $dbfunction->getFetchArray();
		//print_r($_POST);exit;
		$action = $converter->encode("manageOrder");
		?>
		
		
		<form class="form-horizontal bootstrap-validator-form" method="post" >
		<fieldset>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الطلبات#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['invoiceNo'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label">تعيين سائق:</label>
			<div class="col-lg-4">
			<select class="form-control" name="driverId" required>
				<option value="">-- اختر واحدة --</option>
				<?php
				$dbfunction1  = new dbfunctions();
				$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_drivers WHERE isActive='1' AND isDeleted='0' ORDER BY driverName");
				while ($objsel1 = $dbfunction1->getFetchArray())
                {
					if($objsel["driverId"]==$objsel1["driverId"])
					$Selected ='selected';
					else
					$Selected ='';
				?>
											
				<option value="<?php echo $objsel1["driverId"];?>" <?=$Selected?> ><?php echo stripslashes(trim($objsel1["driverName"])); ?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label">تسلسل التسليم:</label>
			<div class="col-lg-4">
			<input type="text" class="form-control" name="deliverySequence"  value="<?php echo $objsel['deliverySequence'];?>">
			</div>
		</div>
		
		<input type="hidden" name="id" value="<?=$_REQUEST["id"]?>">
		<input type="hidden" name="action" value="<?=$action?>">
		<div class="form-group">
			<label class="col-lg-4 control-label"></label>
			<div class="col-lg-4">
			<button tabindex="19" title="تحديث" class="btn btn-primary" value="submit" id="save" name="save" type="submit" data-bv-field="save1">تحديث</button>
			</div>
		</div>
		</fieldset>
		</form>	