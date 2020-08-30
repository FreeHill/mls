<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:login.php");

echo "<script>window.location='login.php'</script>";

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
                <?php include("includes/mailmenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Mail Statistics</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="24%" height="22">
											<strong>RECEIVED MAILS</strong></td>
                                        <td width="17%">:</td>
                                        <td width="59%" style="text-align:left;">
										<?php
										$revmail=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype='2' and outbox_tostatus='0') "));
										?>
										<a href="inbox.php"><?php echo $revmail; ?></a>  </td>
                                  </tr>
                                        <tr>
										<td width="24%">
											<strong>SENT MAILS</strong>	</td>
                                        <td>:</td>
                                        <td style="text-align:left;">
                                        <?php 
										$sentmail=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0')"));
										?>
										<a href="outbox.php"><?php echo $sentmail; ?></a>
                                        </td>
                                        </tr>
										<tr>
                                        <td width="24%">
											<strong>FORWARD MAILS</strong>	</td>
                                        <td>:</td>
                                        <td style="text-align:left;">
                                        <?php 
										$fwddmail=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_fwdstatus='1'")); ?>
										<a href="forward.php"><?php echo $fwddmail; ?></a>
                                        </td>
                                        </tr>
                                        <tr>
										<td width="24%">
											<strong>READ MAILS</strong>	</td>
                                        <td>:</td>
                                        <td style="text-align:left;"><?php
												$fwddmail=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_readstatus='1'")); ?>
										
										<a href="read.php"><?php echo $fwddmail; ?></a>
										
										</td>
                                        </tr>
                                        <tr>
										<td width="24%">
											<strong>UNREAD MAILS</strong></td>
										<td>:</td>
                                        <td style="text-align:left;">
                                        <?php 
												$fwddmail=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_userid='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_fromstatus='0') and outbox_readstatus='0'")); ?>
										
									<a href="unread.php"><?php echo $fwddmail;
										?></a>
                                        </td>
									</tr>
									
									
									
									</table>
								    
							</div>
							 <div>
            
                      
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