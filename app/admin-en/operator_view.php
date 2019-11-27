		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_operators where operatorId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['operatorName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Username:</label>
			<div class="col-lg-6">
			<?php echo $objsel['username'];?>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">EmailID:</label>
			<div class="col-lg-6">
			<?php echo $objsel['email'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Phone:</label>
			<div class="col-lg-6">
			<?php echo $objsel['phone'];?>
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