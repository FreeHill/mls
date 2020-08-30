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
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">BINARY PAYOUT</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="10%">
											<strong>SNO</strong>
										</td>
										<td width="30%" style="text-align:left;">
											<strong>BONUS TYPE</strong>
										</td>	
										<td width="10%">
											<strong>CV</strong>
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
									
									$pur=mysql_query("select * from mlm_payoutcalc where pay_user='$_SESSION[profileid]' order by pay_id desc LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_payoutcalc where pay_user='$_SESSION[profileid]' order by pay_id desc"));
									$i=1;
									$cpur=mysql_num_rows($pur);
									while($rpur=mysql_fetch_array($pur)) 
									{
									$proname=mysql_fetch_array(mysql_query("select * from mlm_payoutcalc where pay_user='$_SESSION[profileid]'"));
									
									$puramt="";
									$purbonus=mysql_query("select * from mlm_payoutcalc where bonus_type='0' and pay_user='$_SESSION[profileid]'" );
									
									while($rp=mysql_fetch_array($purbonus))
									{
									$puramt=$puramt+$rp['pay_cv'];
									}
									
									$refamt="";
									$refbonus=mysql_query("select * from mlm_payoutcalc where bonus_type='1' and pay_user='$_SESSION[profileid]'" );
									
									while($drp=mysql_fetch_array($refbonus))
									{
									$refamt=$refamt+$drp['pay_cv'];
									}
									
									$teamamt="";
									
									$tbbonus=mysql_query("select * from mlm_payoutcalc where bonus_type='2' and pay_user='$_SESSION[profileid]'" );
									
									while($tb=mysql_fetch_array($tbbonus))
									{
									$teamamt=$teamamt+$tb['pay_cv'];
									}
									
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $rpur['pay_reason'];?>
										</td>
										
										<td>
											<?php echo $rpur['pay_cv'];?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rpur['pay_date']));?>
										</td>
										<td>
											<?php  if($rpur['pay_calc_status']=='0') { echo "Pending"; } elseif($rpur['pay_calc_status']=='1') { echo "Calculated"; } else { } ?>
										</td>
									</tr>
									<?php $i++;} ?> 
									
									<tr>
									<td colspan="5" align="center"> 
									<div style="text-align:center;">
									<ul style="list-style:none; margin: 0; width:100%;">
										<li style="margin:0 10px; display:block;">
											<label  class="cb-enable selected">
												<span> Purchase Bonus </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $puramt; ?></span>
											</label>
										</li>
										<li>
											<span style="float:left; margin:0 10px;">&nbsp;</span>
										</li>
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Referral Bonus</span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $refamt; ?></span>
											</label>
										</li>
										
										<li>
											<span style="float:left; margin:0 10px;">&nbsp;</span>
										</li>
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Team Bonus</span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $teamamt; ?></span>
											</label>
										</li>
										
									</ul>
								</div>
								</td></tr>
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