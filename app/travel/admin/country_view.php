		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_countries where country_id=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Country Code:</label>
			<div class="col-lg-6">
			<?php echo $objsel['country_iso'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Country Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['country_name'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Status:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['is_active']!= 1)?'Deactive':'Active'; ?>
			</div>
		</div>
		</fieldset>
		</form>	