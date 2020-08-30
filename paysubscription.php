<?php 
include("config/error.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{

$new_pass=$_REQUEST['new_pass'];


$qry=mysql_query("update mlm_register set user_password='$new_pass' where user_id='$_SESSION[userid]'");

if($qry)
{
header("location:paysubscription.php?succ");
echo "<script>window.location='paysubscription.php?succ';</script>";
}

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
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Pay Subscription</h4>
									
							<form action="subscriptionpaypal.php" method="post">
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="40%" align="right">
											<strong>Subscription Expiry Date</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
											<?php echo  $userdetail['user_subexpiry']; ?>
										</td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<button type="submit" name="submit" class="greenbtn">Pay Subscription</button>
										</td>
									</tr>
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