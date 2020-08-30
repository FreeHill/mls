<?php 
include("config/error.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}



include("includes/head.php");

?>
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
			<?php include("includes/profileheader.php");
			$rewid=MemberRewardId($user_profileid);
			$usr_reward=mysql_fetch_array(mysql_query("SELECT * FROM `mlm_reward` WHERE `id`='$rewid'"));
				
			?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Your Reward</h4>
									
							<form action="subscriptionpaypal.php" method="post">
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php if($usr_reward){?>
									<tr>
										<td width="40%" align="right">
											<strong>Reward Position</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
											<?php echo  $usr_reward['position']; ?>
										</td>
									</tr>
									<tr>
										<td width="40%" align="right">
											<strong>Reward Description</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
											<?php echo  $usr_reward['des']; ?>
										</td>
									</tr>
									<tr>
										<td width="40%" align="right">
											<strong>Worth</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
											<?php echo  "$ ". $usr_reward['worth']; ?>
										</td>
									</tr>
									<?php }
									else{ ?>
									<tr>
										<td width="50%" align="center">
											<strong>No Rewards!!</strong>
										</td>
									</tr>	
									<?php }
									?>
								</table>
								</form>
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