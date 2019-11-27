		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_subscriptions where subId=".$converter->decode($_REQUEST['id']));
		$objsel = $dbfunction->getFetchArray();
		$action = $converter->encode("cancelSubscription");
		
		?>
		
		
		<form class="form-horizontal bootstrap-validator-form" method="post" >
		<fieldset>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Subscription#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['subId'];?>
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-lg-4 control-label">السبب:</label>
			<div class="col-lg-4">
			<textarea class="form-control" name="cancelReason" required > <?php echo $objsel['cancelReason'];?></textarea>
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