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
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Basic Details</h4>
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="20%">
											<strong>First Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_fname']; ?>
										</td>
										<td width="20%">
											<strong>Second Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
										<?php echo $userdetail['user_secondname']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Last Name</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_lname']; ?>
										</td>
										<td>
											<strong>Email id</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_email']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Sponsor Name</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_sponsername']; ?>
										</td>
										<td>
											<strong>Sponsor id</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_sponserid']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Placement Id</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_placementid']; ?>
										</td>
										<td>
											<strong>Position</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php 
											if($userdetail['user_placement']=='L') { 
											echo "Left";  }
											elseif($userdetail['user_placement']=='R') { 
											echo "Right";  }
											else { echo "Not Mentioned";}
											?>
										</td>
									</tr>
									<tr>
								<td colspan="6">	<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: 20px; margin-bottom: 7px;">Personal Details</h4></td></tr>
									
									<tr>
										<td>
											<strong>Pancard Number</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_pancard']; ?>
										</td>
										<td>
											<strong>D.O.B</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo date("d-m-Y",strtotime($userdetail['user_dob'])); ?>
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>Phone</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_phone']; ?>
										</td>
										<td>
											<strong>Name as per Bank </strong>
										</td>
										<td align="center">:</td>
										<td>
										<?php echo $userdetail['user_accholdername']; ?>
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>IFSC code </strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_ifsccode']; ?>
										</td>
										<td>
											<strong>Bank Account No </strong>
										</td>
										<td align="center">:</td>
										<td>
										<?php echo $userdetail['user_accno']; ?>
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>Bank Name</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_bankname']; ?>
										</td>
										<td>
											<strong>Branch </strong>
										</td>
										<td align="center">:</td>
										<td>
										<?php echo $userdetail['user_branch']; ?>
										</td>
									</tr>
									
									<tr>
										<td>
											<strong>Communication Address</strong>
										</td>
										<td align="center">:</td>
										<td>
							<?php echo $userdetail['user_commaddr1']; ?>,<?php echo $userdetail['user_commaddr2']; ?><br>
							<?php echo getcity($userdetail['user_city']); ?>,<?php echo getstate($userdetail['user_state']); ?><br>
							<?php echo getcountry($userdetail['user_country']); ?>,<?php echo $userdetail['user_postalcode']; ?><br>
										</td>
										<td>
											<strong>Permanent Address</strong>
										</td>
										<td align="center">:</td>
										<td>
							<?php echo $userdetail['user_paddr1']; ?>,<?php echo $userdetail['user_paddr2']; ?><br>
							<?php echo getcity($userdetail['user_pcity']); ?>,<?php echo getstate($userdetail['user_pstate']); ?><br>
							<?php echo getcountry($userdetail['user_pcountry']); ?>,<?php echo $userdetail['user_ppostalcode']; ?><br>
										</td>
									</tr>
									<tr>
								<td colspan="6">	<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: 20px; margin-bottom: 7px;">Nominee Details</h4></td></tr>
									
									<tr>
										<td>
											<strong>Nominee Name</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_nomineename']; ?>
										</td>
										<td>
											<strong>Email id</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_nemail']; ?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Id cardtype</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_identifycardtype']; ?> 	
										</td>
										<td>
											<strong>Id Number</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_idnumber']; ?> 	
										</td>
									</tr>
									<tr>
										<td>
											<strong>Address</strong>
										</td>
										<td align="center">:</td>
										<td>
							<?php echo $userdetail['user_naddr1']; ?>,<?php echo $userdetail['user_naddr2']; ?><br>
						<?php echo getcity($userdetail['user_ncity']); ?>,<?php echo getstate($userdetail['user_nstate']); ?><br>
						<?php echo getcountry($userdetail['user_ncountry']); ?>,<?php echo $userdetail['user_npostalcode']; ?><br>
										</td>
										<td>
											<strong>Phone Number</strong>
										</td>
										<td align="center">:</td>
										<td>
											<?php echo $userdetail['user_nphone']; ?> 
										</td>
									</tr>
									
								</table>
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