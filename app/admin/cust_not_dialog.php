		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("SELECT * FROM tbl_notification_types where isActive='1' AND isDeleted='0' AND isVisible='1'");
		$action = $converter->encode("notification");
		?>
		<form class="form-horizontal bootstrap-validator-form" method="post">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الفئة:</label>
			<div class="col-lg-6">
			<select class="form-control" name="notTypeId" id="notTypeId" required>
											<option value="">-- اختر واحدة --</option>
											<?php
												
												while ($objsel = $dbfunction->getFetchArray())
                                                    {
	
												?>
												
												<option value="<?php echo $objsel["notTypeId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel["notTypeTitle"])); ?></option>
												<?php } ?>
			</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label">إشعار:</label>
			<div class="col-lg-4">
			<textarea name="notText" id="notText" rows=4 cols=41 required ></textarea> 
			</div>
		</div>
		<input type="hidden" name="action" value="<?=$action?>">
		
		<div class="form-group">
			<label class="col-lg-4 control-label"></label>
			<div class="col-lg-4">
			<button tabindex="19" title="Send" class="btn btn-primary" id="btnSend" name="send" data-bv-field="save1" >إرسال</button>
			</div>
		</div>
		</fieldset>
		</form>	