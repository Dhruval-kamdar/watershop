		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		
		$action = $converter->encode("add_money");
		
		?>
		
		
		<form class="form-horizontal bootstrap-validator-form" method="post">
		<fieldset>
		
		<div class="form-group">
			<label class="col-lg-4 control-label">Amount:</label>
			<div class="col-lg-4">
				<input type="number" name="amountText" id="amountText" required />
			<!--<textarea name="notText" id="notText" rows=4 cols=41 required ></textarea> -->
			</div>
		</div>
		
		
		<input type="hidden" name="action" value="<?=$action?>">
		
		<div class="form-group">
			<label class="col-lg-4 control-label"></label>
			<div class="col-lg-4">
			<button tabindex="19" title="Update" class="btn btn-primary" id="btnAddAmountSend" name="Update" data-bv-field="save1" >Update</button>
			</div>
		</div>
		</fieldset>
		</form>	