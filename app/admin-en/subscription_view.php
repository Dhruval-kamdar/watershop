		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction1 = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select s.*,t.subType from tbl_subscriptions s inner join tbl_subscription_types t
		on s.subTypeId=t.subTypeId where subId=".$converter->decode($_GET['id']));
		$objsel = $dbfunction->getFetchArray();
		?>
		
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Subscription#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['subId'];?>
			</div>
		</div>
		
		
		<?php
		$dbfunction->SimpleSelectQuery("select * from tbl_customers where custId=".$objsel['custId']);
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Subscribed Customer:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['fullName'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Subscription Type:</label>
			<div class="col-lg-6">
			<?php echo $objsel['subType'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Delivery Day&Time:</label>
			<div class="col-lg-6">
			<?php echo $objsel['deliveryDay']." - ".$objsel['deliverySession'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Next Delivery:</label>
			<div class="col-lg-6">
			<?php echo $objsel['nextDelivery'];?>
			</div>
		</div>
		
	
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Status:</label>
			<div class="col-lg-6">
			<?php echo ($objsel['status']=='0')?"Pending":(($objsel['status']=='1')?"Active":"Rejected"); ?> 
			</div>
		</div>
		<?php if($objsel["status"]=='2') { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Cancel Reason:</label>
			<div class="col-lg-6">
			<?php echo (trim($objsel['cancelReason'])!="")?$objsel['cancelReason']:"N/A"; ?> 
			</div>
		</div>
		<?php } ?> 
		
		
		
		</fieldset>
		
	<table style="width: 100%;">
	<tr><td> <div class="center"><h4>Product Details</h4></div></td></tr>
	</table>
	
	
	<table width="100%" border="1" cellspacing="0" cellpadding="5" class="table_add" >
	 
	 <tr >
	 <th>No</th>
	 <th>Name</th>
	 <th>Qty</th>
	
	 </tr>
	
	<?php
	//$product = explode(",",$objsel['products']);
	$prd = json_decode($objsel['productDetails']);
	for($i=0;$i<count($prd);$i++)
	{
		if(is_numeric($prd[$i]->prdId))
		{
		$dbfunction->SimpleSelectQuery("select prdName from tbl_products where prdId=".$prd[$i]->prdId);
		$objsel1 = $dbfunction->getFetchArray();
	?> 
	
	 <tr>
		<td><?php echo $i+1; ?></td>
		<td><?php echo $prd[$i]->prdName; ?></td>
		<td><?php echo $prd[$i]->prdQty." - ".$prd[$i]->qtyUnit; ?></td>
		
	 </tr>
		<?php } } ?> 
	
	</table> 
		
	</form>	