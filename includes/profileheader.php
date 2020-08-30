	<?php 
			$user_subexpiry=mysql_fetch_array(mysql_query("select user_subexpiry from mlm_register where user_id='$_SESSION[userid]'"));
			if($user_subexpiry['user_subexpiry'] < date("Y-m-d")){
			$msg="Your Subscription expired!!";
			}
			$user_profileid=$userdetail['user_profileid'];
			
			?>
			
			
			<!-- Profile info -->
			<marquee class="marquee"  scrollamount="7" onMouseOut="javascript:this.start()" onMouseOver="javascript:this.stop()"><span style="color:#006600;"><?php echo $msg;?></span></marquee>

<div class="row">
                <div class="span profile-info">
					<div class="row">
						<div class="span2">
							<img src="<?=$profileimages?>" width="128" height="128" />
						</div>
						<div class="span9" style="width: 757px;">
							<blockquote style="height: 155px; margin: 0;">
								<h4 style="border:1px #CCC solid; padding:7px; margin-bottom:3px; height:20px;">
									<span style="float:left; display:block;">
										<?php echo $userdetail['user_fname']; ?>
									</span>
									<span style="float:right; display:block;">
										<?php echo $userdetail['user_date']; ?>
									</span>
								</h4>
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="20%">
											<strong>Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_fname']; ?>
										</td>
										<td width="20%">
											<strong>Email id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_email']; ?>
										</td>
									</tr>
									<tr>
										<td width="20%">
											<strong>Profile Id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_profileid']; ?>
										</td>
										<td width="20%">
											<strong>Sponsor Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
										<?php echo $userdetail['user_sponsername']; ?>
										</td>
									</tr>
									
									<tr>
									<td width="20%">
											<strong>Membership Type</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php
							$memtpe=mysql_fetch_array(mysql_query("select * from  mlm_membership where id='$userdetail[user_membership]'"));
											
											 echo $memtpe['membership_name']; ?>
										</td>
										<td width="20%">
											<strong>Referral Count</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
										<?php
										if($memtpe['refer_type']=='1') {
										
										 echo $memtpe['refferal_count']; ?> Members
                                         <?php } else { echo "Unlimited"; ?>
                                         
                                         <?php } ?>
                                         
										</td>
									
									</tr>
										<tr>
									<td width="20%">
											<strong>You Referred </strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php
							
											
											 echo directrefferalcount($userdetail['user_profileid']); ?> Member(s)
										</td>
										<!--td colspan="3">
										
										<a href="register_four.php?id=<?php // echo $_SESSION['profileid']; ?>&upg" class="btn btn-primary"> Upgrade Your Membership</a>
										
										</td-->
									
									</tr>
									
								</table>
                                <?php 
								/*$last_pur=mysql_fetch_array(mysql_query("select * from mlm_purchase where pay_userid=$userdetail[user_profileid] and pay_date=''"));
								   	 $entry=$mem_up['entrydate'];
									 $exp=$mem_up['expiredate'];
									 $startTimeStamp = strtotime($entry);
									 $endTimeStamp = strtotime($exp);
									 $timeDiff = abs($endTimeStamp - $startTimeStamp);
									 $numberDays = $timeDiff/86400;  // 86400 seconds in one day*/

								?>
                                
								
								
                            </blockquote>
						</div>
					</div>
                    <br />
                    <hr style="border: 1px solid #f5f5f5;" />
                    <div class="row" style="margin-top:10px;">
                    <blockquote>
                    <div style="text-align:center;">
									<ul style="list-style:none; margin: 0; width:100%;">
										<li style="margin:0 10px; display:block;">
											<label  class="cb-enable selected">
												<span>Direct Bonus Amount  </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:70px;">Rs <?php echo DirectRefAmount($user_profileid); ?></span>
											</label>
										</li>
										<li>
											<span style="float:left; margin:0 5px;">&nbsp;</span>
										</li>
									
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>In-Direct Bonus Amount </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:65px;">Rs <?php echo InDirectRefAmount($user_profileid); ?></span>
											</label>
										</li>
										
										<li>
											<span style="float:left; margin:0 5px;">&nbsp;</span>
										</li>
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Out Side Bonus Amount</span>
											</label>
											<label class="cb-disable">
												<span style="min-width:70px;">Rs <?php echo OutSideBonus($user_profileid); ?></span>
											</label>
										</li>
										
											
										</ul>

 
<ul style="list-style:none; margin: 0px 0px; width:100%;">

										<li style="margin:0 10px; display:block;">
											<label  class="cb-enable selected">
												<span>Total Paid Amount  </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:70px;">Rs <?php echo TotalPaid($user_profileid); ?></span>
											</label>
										</li>
										<li>
											<span style="float:left; margin:0 5px;">&nbsp;</span>
										</li>
									
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Total Unpaid Amount </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:65px;">Rs <?php echo $tunpaid=TotalUnPaid($user_profileid); ?></span>
												
												<input type="hidden" name="tavail_bal" id="tavail_bal" value="<?php echo $tunpaid; ?>"/>
											</label>
										</li>
										
										<li>
											<span style="float:left; margin:0 5px;">&nbsp;</span>
										</li>
										
											
										</ul>

										</div>
										</blockquote>
										</div>
										
									
										
                    
                </div>
            </div>