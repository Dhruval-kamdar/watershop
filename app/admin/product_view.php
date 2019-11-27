		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_products where prdId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">اسم المنتج:</label>
			<div class="col-lg-6">
			<?php echo $objsel['prdName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">وصف المنتج:</label>
			<div class="col-lg-6">
			<?php echo $objsel['prdDescr'];?>
			</div>
		</div>
		<?php if($objsel['prdImage']!="") { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">صورة المنتج:</label>
			<div class="col-lg-6">
			<img  src="../uploads/products/320/<?php echo $objsel['prdImage'];?>" alt="صورة المعاينة" height="100" width="100" />
			</div>
		</div>
		<?php } ?>
		
		<?php
		$dbfunction->SimpleSelectQuery("select prdType from tbl_product_types where prdTypeId=".$objsel['prdTypeId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">فئة المنتج:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['prdType'];?>
			</div>
		</div>
		
		<?php
		$dbfunction->SimpleSelectQuery("select companyName from tbl_companies where companyId=".$objsel['companyId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الشركة المنتجة:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['companyName'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">سعر الوحدة:</label>
			<div class="col-lg-6">
			
			<?php
			$qtyUnits  = json_decode($objsel['qtyUnits']);
			$dbfunction1 = new dbfunctions();
			foreach($qtyUnits as $Unit)
            { 
				$dbfunction1->SimpleSelectQuery("SELECT qtyUnit FROM tbl_qty_units WHERE qtyUnitId=".$Unit->qtyUnitId);
				$objsel1 = $dbfunction1->getFetchArray();
				echo ($Unit->prdUnitPrice!="")?$Unit->prdUnitPrice." SR  per  ".$objsel1["qtyUnit"]."<br>":"";
				
			
			} ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الحالة:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['isActive']!= 1)?'غير نشط':'نشط'; ?>
			</div>
		</div>
		
		</fieldset>
		</form>	