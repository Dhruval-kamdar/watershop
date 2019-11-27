<?php
include("../include/config.inc.php");
include("session.php");

$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
echo $prdId = $_REQUEST['prdIds'];
$qry = "SELECT * FROM  `tbl_products` WHERE prdId='".$prdId."'";
$row=mysqli_fetch_array(mysqli_query($conn, $qry));
?>
<label class="col-lg-3 control-label"></label>
<div class="col-lg-8">
	<label class="col-lg-2 control-label"><img src ="../uploads/products/320/<?=$row['prdImage']?>" height="50px" width ="50px"/></label>
	<label class="col-lg-2 control-label"><?=$row['prdName']?></label>
	
	<label class="col-lg-2 control-label">
		<select name="qtyUnits[]"  class="form-control" required>
	<?php
	$dbfunction1  = new dbfunctions();
	$dbfunction1->SimpleSelectQuery("SELECT qtyUnits FROM tbl_products WHERE isActive='1' AND isDeleted='0' AND prdId='".$prdId['prdId']."'");
	while ($objsel1 = $dbfunction1->getFetchArray())
		{
			$qtyUnits = json_decode(trim($objsel1["qtyUnits"]),true);
			$j=0;
			while (!empty($qtyUnits[$j]))
			{
				if($qtyUnits[$j]['prdUnitPrice']!='')
				{
	?>
			<option value="<?=$qtyUnits[$j]['qtyUnit']?>"><?=$qtyUnits[$j]['qtyUnit']?></option>
	<?php
				}
				$j++;
			}
		}
	?>
	</select>
	</label>
	<label class="col-lg-2 control-label">
		<select name="prdQty[]"  class="form-control" required>
			<option value="0" >0</option>
			<option value="1" selected >1</option>
			<option value="2" >2</option>
			<option value="3" >3</option>
			<option value="4" >4</option>
			<option value="5" >5</option>
			<option value="6" >6</option>
			<option value="7" >7</option>
			<option value="8" >8</option>
			<option value="9" >9</option>
		</select>
	</label>
	<input type="hidden" class="prdIdss" id="prdId" name="prdId[]" value="<?php echo $row['prdId']; ?>" />
	<input type="hidden" name="prdImage[]" value="<?php echo $row['prdImage']; ?>" />
	<input type="hidden" name="prdName[]" value="<?php echo $row['prdName']; ?>" />
</div>