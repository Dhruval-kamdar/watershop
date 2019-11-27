<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$generalFunction = new generalfunction();
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();
	$dbfunction1 	 = new dbfunctions();
	$cityId = $_GET['id'];
	$districtId = $_GET['districtId'];
	$where = " AND cityId='".$cityId."'";
?>								
									<label class="col-lg-3 control-label"> مدينة :</label>
									<div class="col-lg-5">
										<select class="form-control" name="districtId" required>
											<option value="">-- اختر واحدة --</option>
											<?php
												$dbfunction1 	 = new dbfunctions();
												$dbfunction1->SimpleSelectQuery("SELECT * FROM tbl_districts WHERE isActive='1' AND isDeleted='0' $where ORDER BY districtName");
												while ($objsel1 = $dbfunction1->getFetchArray())
                                                    {
														if($districtId==trim($objsel1["districtId"]))
														$isSelected ='selected';
														else
														$isSelected ='';
												?>
												
												<option value="<?php echo $objsel1["districtId"];?>" <?=$isSelected?> ><?php echo stripslashes(trim($objsel1["districtName"])); ?></option>
												<?php } ?>
										</select>
									</div>
									<span class="errorstar">&nbsp;*</span>
								