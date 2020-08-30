<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			
			<hr />
			
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Payout Calculation</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="10%">
											<strong>SNO</strong>
										</td>
										<td width="30%" style="text-align:left;">
											<strong>BONUS TYPE</strong>
										</td>	
										<td width="10%">
											<strong>AMOUNT</strong>
										</td>
										<td width="20%">
											<strong>DATE</strong>
										</td>
										<td width="15%">
											<strong>STATUS</strong>
										</td>
									</tr>
									
									<?php
										$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
									
									$pur=mysql_query("select * from mlm_mem_amount where memid='$_SESSION[profileid]' LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_mem_amount where memid='$_SESSION[profileid]'"));
									$i=1;
									$cpur=mysql_num_rows($pur);
									while($rpur=mysql_fetch_array($pur)) 
									{
									
									
									
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
										<?php  
										if($rpur['is_direct']=='1'){
										echo "Direct Bonus";
										}
										else if($rpur['is_direct']=='2'){
										echo "In-Direct Bonus";
										}
										?>
										</td>
										
										<td>
											<?php echo $rpur['amount'];?>
										</td>
										<td>
											<?php echo $rpur['date'];?>
										</td>
										<td>
											<?php  if($rpur['is_paid']=='0') { echo "Pending"; } elseif($rpur['is_paid']=='1') { echo "Calculated"; } ?>
										</td>
									</tr>
									<?php $i++;} ?> 
									
									
									
									
									
								</table>
								      
							</div>
								 <div>
            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                      
                    </div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>