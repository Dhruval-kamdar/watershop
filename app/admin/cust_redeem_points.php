		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_customers where custId=".$converter->decode($_REQUEST['id']));
		$objsel = $dbfunction->getFetchArray();
		$action = $converter->encode("redeemPoints");
		
		?>
		
		
		<form class="form-horizontal bootstrap-validator-form" method="post">
		<fieldset>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">عميل:</label>
			<div class="col-lg-6">
			<?php echo $objsel['custId'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">النقاط:</label>
			<div class="col-lg-6">
			<?php echo $objsel['purchasePoints'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label">إعادة الشراء:</label>
			<div class="col-lg-4">
			<input type="text" class="form-control" name="redeemPoints" id="redeemPoints" value="<?php echo $objsel['purchasePoints'];?>" required > 
			</div>
		</div>
		
		<input type="hidden" name="id" value="<?=$_REQUEST["id"]?>">
		<input type="hidden" name="action" value="<?=$action?>">
		<input type="hidden" name="purchasePoints" id="purchasePoints" value="<?=$objsel['purchasePoints']?>">
		<div class="form-group">
			<label class="col-lg-4 control-label"></label>
			<div class="col-lg-4">
			<button tabindex="19" title="تحديث" class="btn btn-primary" value="submit" id="btnSave" name="save" type="submit" data-bv-field="save1" >تحديث</button>
			</div>
		</div>
		</fieldset>
		</form>	