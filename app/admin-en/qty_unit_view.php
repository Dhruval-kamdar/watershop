		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_qty_units where qtyUnitId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Qty Unit:</label>
			<div class="col-lg-6">
			<?php echo $objsel['qtyUnit'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order No.:</label>
			<div class="col-lg-6">
			<?php echo $objsel['order'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Status:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'Deactive':'Active'; ?>
			</div>
		</div>
		</fieldset>
		</form>	