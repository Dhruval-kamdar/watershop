		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction1 = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_rate_services where rateId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<?php
		$dbfunction->SimpleSelectQuery("select * from tbl_customers where custId=".$objsel['custId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">زبون:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['fullName'];?>
			</div>
		</div>
		<?php
		$dbfunction->SimpleSelectQuery("select * from tbl_orders where orderId=".$objsel['orderId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">الطلبات#:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['invoiceNo'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">السؤال الأول:</label>
			<div class="col-lg-6">
			<?php echo $objsel['que1Rating'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">السؤال الثاني:</label>
			<div class="col-lg-6">
			<?php echo $objsel['que2Rating'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">السؤال الثالث:</label>
			<div class="col-lg-6">
			<?php echo $objsel['que3Rating'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">السؤال الرابع:</label>
			<div class="col-lg-6">
			<?php echo $objsel['que4Rating'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">السؤال الخامس:</label>
			<div class="col-lg-6">
			<?php echo $objsel['que5Rating'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">التعليق:</label>
			<div class="col-lg-6">
			<?php echo $objsel['comment'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">أنشئت في:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['created']);?>
			</div>
		</div>
		</fieldset>
		</form>	