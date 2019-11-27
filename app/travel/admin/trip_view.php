		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_trips p where trip_id=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Trip Type:</label>
			<div class="col-lg-6">
			<?php echo ucfirst($objsel['trip_type']);?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Trip Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_name'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Details:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_details'];?>
			</div>
		</div>
		<?php if($objsel['trip_photo']!="") { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Photo:</label>
			<div class="col-lg-6">
			<img  src="../uploads/trip/150x150/<?php echo $objsel['trip_photo'];?>" alt="Preview Image" height="300" width="300" />
			</div>
		</div>
		<?php } ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Address:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_address'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">City:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_city'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Country:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_country'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Price:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_price'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">No. of Person:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_person'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Avg. Rating:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_rating'];?>
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