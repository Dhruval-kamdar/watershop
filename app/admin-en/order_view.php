		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction1 = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_orders where invoiceNo='".$converter->decode($_GET['id'])."'");
		$objsel = $dbfunction->getFetchArray();
		?>
		
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['invoiceNo'];?>
			</div>
		</div>
		
		
		<?php
		$dbfunction->SimpleSelectQuery("select * from tbl_customers where custId='".$objsel["custId"]."'");
		$objsel1 = $dbfunction->getFetchArray();
		?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Customer:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['fullName'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order Time:</label>
			<div class="col-lg-6">
			<?php echo date("d/m/Y H:i",$objsel['orderTimestamp']);?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Delivery Time:</label>
			<div class="col-lg-6">
			<?php echo (strpos($objsel['deliveryTimestamp'], ' ') !== false)?$objsel['deliveryTimestamp']:date('d/m/Y h:i a',$objsel['deliveryTimestamp']);?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order Type:</label>
			<div class="col-lg-6">
			<?php echo $objsel['orderType'];?>
			</div>
		</div>
		<?php if($objsel['orderType']=="charity") { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Charity Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['charityName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Recipient Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['recipientName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Charity Phone:</label>
			<div class="col-lg-6">
			<?php echo $objsel['charityPhone'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Charity Street:</label>
			<div class="col-lg-6">
			<?php echo $objsel['charityStreet'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Charity City:</label>
			<div class="col-lg-6">
			<?php echo $objsel['charityCity'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Charity Neighbor:</label>
			<div class="col-lg-6">
			<?php echo $objsel['charityNeighbor'];?>
			</div>
		</div>
		<?php } ?>
		<!--<div class="form-group">
			<label class="col-lg-4 control-label-text">Pick Time:</label>
			<div class="col-lg-6">
			<?php echo $objsel['pickupTime'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order Type & Time:</label>
			<div class="col-lg-6">
			<?php switch($objsel['orderType'])
					{
						case 0: $order_type="Regular "; break;
						case 1: $order_type="Subscription "; break;
					}
				echo $order_type." (".$objsel['orderTime'].")";
			?>
			</div>
		</div>-->
		
		<?php if($objsel['orderNotes']!="") { ?>
		<!--<div class="form-group">
			<label class="col-lg-4 control-label-text">Order Notes:</label>
			<div class="col-lg-6">
			<?php echo $objsel['orderNotes'];?>
			</div>
		</div>-->
		<?php } ?>
	
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Order Status:</label>
			<div class="col-lg-6">
			<?php 
			$dbfunction1->SimpleSelectQuery("SELECT * FROM `tbl_order_status` WHERE orderStatusId='".$objsel["orderStatus"]."'");
			$objsel1 = $dbfunction1->getFetchArray();
			echo $objsel1['orderStatus']; ?> 
			</div>
		</div>
		<?php if($objsel["orderStatus"]=='6') { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Cancel Reason:</label>
			<div class="col-lg-6">
			<?php echo (trim($objsel['cancelReason'])!="")?$objsel['cancelReason']:"N/A"; ?> 
			</div>
		</div>
		<?php } ?> 
		
		<?php
		//$dbfunction->SimpleSelectQuery("select * from tbl_drivers where driverId='".$objsel["driverId"]."'");
		//$objsel1 = $dbfunction->getFetchArray();
		?>
		<!--<div class="form-group">
			<label class="col-lg-4 control-label-text">Assigned Driver:</label>
			<div class="col-lg-6">
			<?php echo $objsel1['driverName'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Delivery Order:</label>
			<div class="col-lg-6">
			<?php echo $objsel['deliverySequence'];?>
			</div>
		</div>-->
		
		<?php if($objsel['custNotes']!="") { ?>
		<!--<div class="form-group">
			<label class="col-lg-4 control-label-text">Notes(Driver):</label>
			<div class="col-lg-6">
			<?php echo $objsel['custNotes'];?>
			</div>
		</div>-->
		<?php } ?>
		
		<!--<div class="form-group">
			<label class="col-lg-4 control-label-text">Rating:</label>
			<div class="col-lg-6">
			<?php
			for($i=1;$i <= 10;$i++) 
			{
				$j = round($objsel['custRate']);
				if($i <= $j)
					echo "<img src='../assets/img/star.png'>";
				else
					echo "<img src='../assets/img/star_grey.png'>";
			} ?>
			</div>
		</div>-->
		
		</fieldset>
		
	<table style="width: 100%;">
	<tr><td> <div class="center"><h4>Product Details</h4></div></td></tr>
	</table>
	
	
	<table width="100%" border="1" cellspacing="0" cellpadding="5" class="table_add" >
	 
	 <tr >
	 <th>No</th>
	 <th>Name</th>
	 <th>Unit Price</th>
	 <th>Qty</th>
	 <th>Total</th>
	 </tr>
	
	<?php
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
		<td><?php echo $prd[$i]->prdUnitPrice.CURRENCY." per ".$prd[$i]->qtyUnit; ?></td>
		<td><?php echo $prd[$i]->prdQty; ?></td>
		<td><?php echo $prd[$i]->prdTotalPrice.CURRENCY; ?></td>
		
	 </tr>
		<?php } } ?> 
	<tr>
		<td colspan="4" align="right">Subtotal:</td>
		<td><?php echo $objsel['subTotal'].CURRENCY;?></td>
	</tr>
	<tr>
		<td colspan="4" align="right">VAT:</td>
		<td><?php echo $objsel['vat'].CURRENCY;?></td>
	</tr> 
	<tr>
		<td colspan="4" align="right">Discount:</td>
		<td><?php echo $objsel['discount'].CURRENCY;?></td>
	</tr> 
	<!--<tr>
		<td colspan="4" align="right">Delivery Fee:</td>
		<td><?php echo $objsel['deliveryFee'].CURRENCY;?></td>
	</tr>-->
	<tr>
		<td colspan="4" align="right">Remain Balance:</td>
		<td><?php echo $objsel['remainBalance'].CURRENCY;?></td>
	</tr>
	<tr>
		<td colspan="4" align="right">Total Amount:</td>
		<td><?php echo $objsel['grandTotal'].CURRENCY;?></td>
	</tr>  
	</table> 
		
	</form>	