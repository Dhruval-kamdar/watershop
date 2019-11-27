		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_admin where AdminId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		$Privilege = json_decode($objsel['AdminPrivilege']);
		$action = $converter->encode("updatePrvl");
		?>
		<script>
		/*$(document).ready(function() {
		
				$("#selectAllRow").on('click',function() { // bulk checked
					var status = this.checked;
					$(".selectRow").each( function() {
						$(this).prop("checked",status);
					});
				});
		});	*/
		</script>
								<form class="form-horizontal bootstrap-validator-form" method="post">
								<fieldset>
								<div class="form-group">
									<label class="col-lg-5 control-label"></label>
									<?php foreach($PRIV_AR as $prvl) 
									{ 
										$pr[] = $prvl;
									?>
									<div class="col-lg-1">
										<label class="control-label"><?=ucfirst($prvl)?></label>
									</div>
									<?php } ?>
								</div>
								
								<div class="form-group">
									<!--<label class="col-lg-5 control-label">Select All:</label>
									
									<div class="col-lg-4">
										<div class="checkbox col-lg-5"><label><input type="checkbox" class="checkboxvalue" id="selectAllRow" />&nbsp;</label></div>
									</div>-->
									<?php $c=0; foreach($MODULES as $mdl) {  ?>
									
									<label class="col-lg-5 control-label"><?=ucfirst($MOD_AR[$c])?>:</label>
									<?php  foreach($PRIVILEGE as $p) { ?>
									<div class="col-lg-1">
										<div class="checkbox col-lg-1"><label><input type="checkbox" class="selectRow checkboxvalue" name="AdminPrivilege[]" value="<?=$p."_".str_replace(" ","_",$mdl)?>" <?=in_array(($p."_".str_replace(" ","_",$mdl)),$Privilege)? "checked" : ""?> />&nbsp;</label></div>
									</div>
									
									<?php } $c++; } ?>
								</div>	
								<input type="hidden" name="id" value="<?=$_GET['id']?>">
								<input type="hidden" name="action" value="<?=$action?>">
								<!-- Form actions -->
								<div class="form-group">
								<div class="col-lg-10 col-lg-offset-5">
									
									<button type="submit" name="save1" id="save1" value="submit1" class="btn btn-primary" title="Save" tabindex="19">تحديث</button>
								
								</div>
								</div>
								</fieldset>
								</form>	