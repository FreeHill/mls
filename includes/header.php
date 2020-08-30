<?php
if(isset($_SESSION['profileid']) && isset($_SESSION['userid']))
{
	$userdetail=mysql_fetch_array(mysql_query("select * from mlm_register where user_status='0' and user_id='$_SESSION[userid]'"));
	$profilename=$userdetail['user_fname'];
	if(file_exists("uploads/profile_image/thumb/".$userdetail['user_image']) && $userdetail['user_image']!='')
	{
		$profileimages="uploads/profile_image/thumb/".$userdetail['user_image'];
	}
	else
	{
		$profileimages="images/user_coat_red_01.png";
	}
} else {
	$profilename="Profile name";
	$profileimages="images/user_coat_red_01.png";
}
?>
			<div class="row top">
                <div class="span4 logo">
                    <a href="./">
                        <h1 class="logo-title">
							<img src="<?php echo $logourl; ?>" width="137" height="129">
						</h1>
                    </a>
                    <!--<span class="slogan">Bootstrap Company Profile Theme</span>-->
                </div>
                <div class="span8">
                    <div class="row">

                        <div class="span8 customer_service">
							<?php if((isset($_SESSION['profileid'])) && (isset($_SESSION['userid']))) { ?>
							<div class="headerrightprofile">
								<img src="<?=$profileimages?>" align="Profile" width="45" />
								<span id="inner">
									Welcome : <?=substr($profilename,0,15)?>
									<hr class="clear" />
									<a href="profile.php">My Profile</a> <span style="color:#DDD; font-weight:bold;">|</span> 
									<a href="logout.php">Log out</a>
								</span>
							</div>
							<?php } else { ?>
							<div class="headerrightlink">
								<ul>
									<li><a href="login.php">Log in </a></li>
									<li><a href="register.php">Register</a></li>
								</ul>
							</div>
							<?php } ?>
                        </div>
                    </div>

                </div>
            </div>
