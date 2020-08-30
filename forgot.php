<?php include("config/error.php");
include("includes/head.php");

if((isset($_SESSION['profileid'])) && (isset($_SESSION['userid'])))
{
header("location:profile.php");

echo "<script>window.location='profile.php'</script>";

}


if(isset($_REQUEST['forgot']))
{

$profileid=$_REQUEST['profileid'];

$lsql="select * from mlm_register where user_email='$profileid' and user_status='0'";

$lcount=mysql_num_rows(mysql_query($lsql));
if($lcount=='1')
{
$lfetch=mysql_fetch_array(mysql_query($lsql));
$password=$lfetch['user_password'];
$prof_id=$lfetch['user_profileid'];
$prof_email=$lfetch['user_email'];
$subject="Login Details";

$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #D64B14; width:550px;'>
		<tr bgcolor='#D64B14' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login Details for ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Profile ID : $prof_id</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $password</td>
						</tr>
					
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#D64B14;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>"; 

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$prof_email.'>' . "\r\n";

$to=$prof_email;


mail($to,$subject,$msg,$headers);


header("location:forgot.php?succ");
}
else
{
header("location:forgot.php?err");

}

}


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
			<div>
			<span style="padding-left:350px;">
         <?php 
						if(isset($_REQUEST['err']))
						{ ?>
						<span style="color:#FF0000;">Account Doesn't Exists, Please enter valid E-mail / Profile id.</span>
						
						<?php }
						
						 ?>
						 <?php
						 if(isset($_REQUEST['succ']))
						{ ?>
						<span style="color:#00CC00;">Password sent to your E-mail, Please check it.</span>
						
						<?php }
						
						 ?>
						 </span></div>
            <div class="logform">
            <div class="span5" style="width:280px;">
                    <h2 class="widget-title"><span>Forgot Password </span><span></span></h2>
					
                    <p>If you need any help please contact us via <a href="contact.php">ticket system</a> in your dashboard.</p>
					
                        <form class="signin-form" action="" method="post">
						
						
						
						
						
                          <input class="input-block-level" type="text" placeholder="Enter your E-mail" name="profileid" id="inputEmail" required/>
                          <!--<input class="input-block-level" placeholder="Enter your password" type="password" name="password" id="inputPassword" required/>-->
							
                          <!--<label class="checkbox"><input type="checkbox" /> Remember me</label>-->
                          <input type="submit" class="btn btn-primary" name="forgot" id="forgot" value="Submit" />
                        </form>
						
					</div></div>
           
            <div class="row" style="height:340px;">
              
&nbsp;
                

            </div>
           <?php 
			
			include("includes/footer.php");
			
			?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>