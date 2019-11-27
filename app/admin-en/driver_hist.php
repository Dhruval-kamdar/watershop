<?php
	include("../include/config.inc.php");
	include("../include/thumb.php");
	include("session.php");
	$pagename   = "driver_hist";
	$pageurl    = "driver_hist.php";
	$generalFunction = new generalfunction();
	$converter  	 = new encryption();
	$dbfunction 	 = new dbfunctions();

	if(isset($_GET["id"]))
	$_SESSION["driverId"] = $converter->decode($_GET["id"]);
	$loggedId = $_SESSION["driverId"];
	/*if($_REQUEST["action"] != "")
	{
		$dbfunction6 = new dbfunctions();
		$dbfunction6->SimpleSelectQuery("select max(`dateTime`) AS max_values,min(`dateTime`) AS min_values from tbl_drivers_log");
		$objsel6 = $dbfunction6->getFetchArray();
		$day=date('Y-m-d',$_SESSION['date_value']);
		if($_REQUEST["action"]=='pre')
		{
			if($day > date('Y-m-d',strtotime($objsel6['min_values'])))
			{
				$dateString=date('Ymd',$_SESSION['date_value']);
				$Day = strtotime("-1 day",$_SESSION['date_value']);
				$cur1= date("Y-m-d", $Day); 
				$_SESSION['date_value']=strtotime($cur1);
			}
			else
			{
				$_SESSION['date_value']=strtotime($objsel6['min_values']);
			}
		}
		
		if($_REQUEST["action"]=='next')
		{
			if($day < date('Y-m-d',strtotime($objsel6['max_values'])))
			{
				$dateString=date('Ymd',$_SESSION['date_value']);
				$Day = strtotime("+1 day",$_SESSION['date_value']);
				$cur1= date("Y-m-d", $Day); 
				
				$_SESSION['date_value']=strtotime($cur1);
			}
			else
			{
				$_SESSION['date_value']=strtotime($objsel6['max_values']);
			}			
		}

	}*/
	
	if($_GET["dt"] != "")
	{
		$current = date("Y-m-d",$_GET["dt"]);
	}
	else
	{
		$current = date("Y-m-d");
	}
	$dbfunction1 = new dbfunctions();
	$dbfunction1->SimpleSelectQuery("select dateTime from tbl_drivers_log where driverId='$loggedId' and date(dateTime) < '".$current."' order by dateTime desc limit 1");
	$prv = $dbfunction1->getFetchArray();
	if(!empty($prv["dateTime"]))
	$previous = strtotime($prv["dateTime"]);
	$dbfunction2 = new dbfunctions();
	$dbfunction2->SimpleSelectQuery("select dateTime from tbl_drivers_log where driverId='$loggedId' and date(dateTime) > '".$current."' order by dateTime limit 1");
	$nxt = $dbfunction2->getFetchArray();
	if(!empty($nxt["dateTime"]))
	$next = strtotime($nxt["dateTime"]);
	$dbfunction-> SimpleSelectQuery("select * from `tbl_drivers_log` where driverId='$loggedId' and dateTime like '".$current."%' order by dateTime desc");
	
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
	<head><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" type="image/x-con" href="images/favicon.ico" />
		<title><?php
			
				echo "Driver History :: Admin :: ".SITE_NAME;
			
		?></title>
		
		<script>
		function getHistory(val)
		{ 
			var dt = new Date(val).getTime() / 1000;
			window.location = "driver_hist.php?dt="+dt;
		}
		</script>
		
		<?php include("js-css-head.php"); ?>
		<?php include("meta-settings.php"); ?>
	<script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script><script language=javascript>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </script></head>
	<body class="tooltips">
	
		<div class="wrapper page-content">
			<?php include("header.php"); ?>
			<!-- Sidebar menu & content wrapper -->
			    
				<!-- Sidebar Menu -->
				<?php include("leftside.php"); ?>
				<!-- // Sidebar Menu END -->
			<div id="page-content"> 
				<!-- Content -->
				<div id="content" class="container-fluid">
					<h1 class="page-heading">Driver History <small></small></h1>
					<!-- End page heading -->
					<!--<span class="pull-right" ><a href="product_list.php" class="btn btn-icon btn-primary glyphicons" title="View Historys"><i class="icon-plus-sign"></i>View Historys</a></span>-->
					<!-- Begin breadcrumb -->
					<ol class="breadcrumb default square rsaquo sm">
						<li><a href="dashboard.php"><i class="fa fa-home"></i></a></li>
						<li><a href="driver_list.php">Driver</a></li>
						<li class="active">History</li>
						
					</ol>
					<!-- End breadcrumb -->
					<div style="text-align:center">
							<?php
							/*$dbfunction1 = new dbfunctions();
							$dbfunction1->SimpleSelectQuery("select max(`dateTime`) AS max_values, min(`dateTime`) AS min_values from tbl_drivers_log where driverId='$loggedId'");
							$objsel1 = $dbfunction1->getFetchArray();
							$day=date('Y-m-d',$_SESSION['date_value']);
							if($day <= date("Y-m-d",strtotime($objsel1['min_values'])))
							{
								$style_arrow_left="style='display:none'";
							}
							if($day >= date("Y-m-d",strtotime($objsel1['max_values'])))
							{
								$style_arrow_right="style='display:none'";
							}*/
							if(empty($previous))
							$style_arrow_left="style='display:none'";
							if(empty($next))
							$style_arrow_right="style='display:none'";
							?>
                                
										<a href="driver_hist.php?dt=<?php echo $previous;?>" title="Previous" <?=$style_arrow_left?>>Prev</a>
										<span ><input type="date" class="form-control" id="datepicker11" value="<?php echo $current; ?>" style="width:auto;display:inherit"  onchange="getHistory(this.value)" ></span>
										
										<a href="driver_hist.php?dt=<?php echo $next;?>" title="Next" <?=$style_arrow_right?>>Next</a>
					</div>
					<?php
							if (isset($error) && $error == "1")
							{
								echo $generalFunction->getErrorMessage($errormessage);
							}
							
							if (isset($error1) && $error1 == "1")
							{
								echo $generalFunction->getErrorMessage($errormessage1);
							}
						?>
						
					<div class="the-box">
						<form  id="addUser" class="form-horizontal" enctype="multipart/form-data" name="addUser"  method="post">
							<fieldset>
							<?php
								if($dbfunction->getNumRows()>0) {
								while($res = $dbfunction->getFetchArray()) {  ?>
                                <div class="form-group">
									<div class="col-lg-3 control-label"><?php echo $res['dateTime']; ?></div>
									<div class="col-lg-5 ">
										 <?php echo $res['description']; ?>
									</div>
									
								</div>
								<?php } } else { ?>
								<div class="center">	
								  No History Found 
								</div> 
								<?php } ?>
							</fieldset>
						</form>
							<!-- // Table END -->
					</div><!-- /.the-box -->
				</div>
			</div>
				<!-- // Content END --> 
			
			<div class="clearfix"></div>
			<!-- // Sidebar menu & content wrapper END -->
			
			<?php include("footer.php"); ?>
		
		</div><!-- /.wrapper -->
		<?php include("js-css-footer.php"); ?>
	</body>
</html>																																	