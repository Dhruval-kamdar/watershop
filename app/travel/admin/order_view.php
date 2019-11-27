		<?php
		include("../include/config.inc.php");
		include("session.php");
		$converter  = new encryption();
		$dbfunction = new dbfunctions();
		$dbfunction1 = new dbfunctions();
		$dbfunction->SimpleSelectQuery("select * from tbl_bookings where invoice_no='".$converter->decode($_GET['id'])."'");
		$objsel = $dbfunction->getFetchArray();
		?>
		
		<form class="form-horizontal bootstrap-validator-form">
		<fieldset>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Booking#:</label>
			<div class="col-lg-6">
			<?php echo $objsel['invoice_no'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Registered Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['user_name'];?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Trip Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_name'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Trip Date:</label>
			<div class="col-lg-6">
			<?php echo (strpos($objsel['booking_date'], ' ') !== false)?$objsel['booking_date']:date('d/m/Y',strtotime($objsel['booking_date']));?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Country Name:</label>
			<div class="col-lg-6">
			<?php echo $objsel['country_name'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Email-id:</label>
			<div class="col-lg-6">
			<?php echo $objsel['email_id'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Phone Number:</label>
			<div class="col-lg-6">
			<?php echo ucfirst($objsel['phone']);?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Arrival Location:</label>
			<div class="col-lg-6">
			<?php echo $objsel['arrival_location'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Departure Location:</label>
			<div class="col-lg-6">
			<?php echo $objsel['departure_location'];?>
			</div>
		</div>
		
		<?php if($objsel['message']!='') { ?>
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Message:</label>
			<div class="col-lg-6">
			<?php echo $objsel['message'];?>
			</div>
		</div>
		<?php } ?>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Trip Price:</label>
			<div class="col-lg-6">
			<?php echo $objsel['trip_price'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Tax:</label>
			<div class="col-lg-6">
			<?php echo $objsel['tax_price'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Sub Total:</label>
			<div class="col-lg-6">
			<?php echo $objsel['sub_total'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Discount:</label>
			<div class="col-lg-6">
			<?php echo $objsel['discount'];?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-lg-4 control-label-text">Grand Total:</label>
			<div class="col-lg-6">
			<?php echo $objsel['grand_total'];?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-4 control-label-text">Booking Time:</label>
			<div class="col-lg-6">
			<?php echo datFormat($objsel['created_on']);?>
			</div>
		</div>
	</fieldset> 
	
	<table style="width: 100%;">
	<tr><td> <div class="center"><h4>Guest Details</h4></div></td></tr>
	</table>
	
	
	<table width="100%" border="1" cellspacing="0" cellpadding="5" class="table_add" >
	 
	 <tr >
	 <th>No</th>
	 <th>First Name</th>
	 <th>Last Name</th>
	 <th>Birth Date</th>
	 <th>Passport Number</th>
	 </tr>
	
	<?php
	$prd = json_decode($objsel['guest_details']);
	for($i=0;$i<count($prd);$i++)
	{
		
	?> 
	
	 <tr>
		<td><?php echo $i+1; ?></td> 
		<td><?php echo $prd[$i]->honorific.' '.$prd[$i]->first_name; ?></td>
		<td><?php echo $prd[$i]->last_name; ?></td>
		<td><?php echo datFormat($prd[$i]->birth_date); ?></td>
		<td><?php echo $prd[$i]->passport_number; ?></td>
		
	 </tr>
		<?php  } ?>   
	</table>
		
	</form>	