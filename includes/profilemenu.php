<?php
	$currentpagename=getPageName();
?>
				<div class="span3">
					<h4 class="navbar-inner" style="color:#fff; line-height:40px; background-color: #0B7251;">Left menu</h4>
					<div class="service-box2">
						<ul class="proleftmenu">
							<li <?php if($currentpagename=="fullprofile.php") { echo 'class="current"'; } ?>>
								<a href="fullprofile.php" class="leftmenua">
									Profile
								</a>
							</li>
							
							<li <?php if($currentpagename=="photo.php") { echo 'class="current"'; } ?>>
								<a href="photo.php" class="leftmenua">
									Upload profile Image
								</a>
							</li>
							
							
							<li <?php if($currentpagename=="editprofile.php") { echo 'class="current"'; } ?>>
								<a href="editprofile.php" class="leftmenua">
									Edit profile
								</a>
							</li>
							<li <?php if($currentpagename=="changepassprofile.php") { echo 'class="current"'; } ?>>
								<a href="changepassprofile.php" class="leftmenua">
									Change Password
								</a>
							</li>
							<!--<li <?php //if($currentpagename=="binary.php") { echo 'class="current"'; } ?>>
								<a href="binary.php" class="leftmenua">
									Binary Genealogy
								</a>
							</li>-->
							<li <?php if($currentpagename=="sunflower.php") { echo 'class="current"'; } ?>>
								<a href="sunflower.php" class="leftmenua">
									 Genealogy
								</a>
							</li>
							
						<!--	<li <?php //if($currentpagename=="payout_binary.php") { echo 'class="current"'; } ?>>
								<a href="payout_binary.php" class="leftmenua">
									Binary Payout Calculation
								</a>
							</li>-->
							<li <?php if($currentpagename=="payout_sunflower.php") { echo 'class="current"'; } ?>>
								<a href="payout_sunflower.php" class="leftmenua">
									Payout Calculation
								</a>
							</li>
							
							<li <?php if($currentpagename=="send_withdraw.php") { echo 'class="current"'; } ?>>
								<a href="send_withdraw.php" class="leftmenua">
									Send Withdrawal Request
								</a>
							</li>
							
								<li <?php  if($currentpagename=="cancel_withdraw.php") { echo 'class="current"'; } ?>>
								<a href="cancel_withdraw.php" class="leftmenua">
									Cancel Withdrawal Request
								</a>
							</li>
							
							<li <?php if($currentpagename=="mail.php") { echo 'class="current"'; } ?>>
								<a href="mail.php" class="leftmenua">
									Mailing System
								</a>
							</li>
							<li <?php if($currentpagename=="paysubscription.php") { echo 'class="current"'; } ?>>
								<a href="paysubscription.php" class="leftmenua">
									Pay Subscription
								</a>
							</li>
							<li <?php if($currentpagename=="reward.php") { echo 'class="current"'; } ?>>
								<a href="reward.php" class="leftmenua">
									Reward
								</a>
							</li>
						
							
							
						</ul>
					</div>
                </div>