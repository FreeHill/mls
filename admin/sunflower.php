<?php 
include("config/error.php");

include("includes/head.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}




?>
<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	/*.numwraper img {
		width: 100%;
		height: 100%;
	}*/
	
	.numwraper span {
		position: absolute;
		right: 34%;
		top: 31%;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-weight:bold;
		font-size: 12px;
		background-color: #FFF;
		padding: 0px 2px 0px 2px;
		display: block;
	}

 a.tooltipp 
 {
 outline:none;
 opacity: 1;
  } 
 a.tooltipp strong 
 {
 line-height:30px;
 } 
 a.tooltipp:hover 
 {
 text-decoration:none;
 } 
 a.tooltipp span 
 {
  z-index:10;display:none; 
  padding:14px 20px;
   margin-top:-30px; 
   margin-left:10px; 
   width:280px;
    line-height:16px;
	 } 
	 a.tooltipp:hover span
	 { 
	 display:inline;
	  position:absolute; 
	 color:#111;
	  border:1px solid #DCA;
	   background:#fffAF0;} 
	   .callout {
	   z-index:20;
	   position:absolute;
	   top:30px;
	   border:0;
	   left:-12px;
	   } 
	   /*CSS3 extras*/
	    a.tooltipp span { 
		border-radius:4px;
		 -moz-border-radius: 4px;
		  -webkit-border-radius: 4px; 
		  -moz-box-shadow: 5px 5px 8px #CCC;
		   -webkit-box-shadow: 5px 5px 8px #CCC;
		    box-shadow: 5px 5px 8px #CCC;
			 }
			 
	.circle {
  display: block;
  width:60px;
  height:60px;
  margin: 1em auto;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  -webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 4px solid #eee;
  box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);  
}
	.level_circle{
  display: block;
  width:45px;
  height:45px;
  margin: 1em auto;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  -webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 4px solid #eee;
  box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);  
}
 </style>
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
							<?php  $ussserid=(isset($_REQUEST['ussserid']))? $_REQUEST['ussserid'] :$_SESSION['profileid']; ?>
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">TREE STRUCTURE</h4>
								<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px #FF6600 solid; ">
			
			<tr><?php $img=Getprofileimage($ussserid); ?>
			<td align="center" valign="bottom" style=" border:1px #FF6600 solid;"><img src="<?php echo $img; ?>" class="circle"  />		 			<a href="#" class="forgotlink tooltipp" style="margin-left:50px;">
			<?php
			
	       $select=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");
		$u_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid' "));
		if($u_num > 0)
		{
		while($fetch=mysql_fetch_array($select))
		{
					  
					  echo $fetch['user_fname'];
					  
					  ?>
					  <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch['user_fname'].$fetch['user_secondname']." ".$fetch['user_lname']; ?> </b></div>
                      <div style="clear:both;">&nbsp;</div>
                      </div>
                       <div>
					  <div style="width:300px;" align="left"> Sponsor Name : <b><?php echo $fetch['user_sponsername']; ?> </b></div>
					  <div style="clear:both;">&nbsp;</div>
                      </div>
                      <div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch['user_profileid']; ?></b></div>
                      <div style="float:left; width:150px;" align="left"> Membership : <b><?php echo Getmembetshipfromprofileid($fetch['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
                     
					   <div>
					 <div style="float:left; width:170px;" align="left"> Refferal Limit : <b><?php echo Getmembetshipcount($fetch['user_profileid']); ?> </b></div>
					  <div style="float:left; width:130px;" align="left"> Reffered Count: <b><?php echo directrefferalcount($fetch['user_profileid']); ?></b></div>
                       
					  </div>
					  
					 <!-- <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>-->
					  
					  
					  </div>
					  </span>
					  
					  
					  </a>
					  <?php } }?>
					  	<span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span></td>
                    </tr>
                    
                   
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					 
					 <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse; ">
                     <tr>  
					 <?php 
	 function SunGetUserNamePosFromId($ussserid)
	{
		//echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid'"; 
		$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id desc");
		$ussserid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id desc"));
		if($ussserid_num > 0)
		{
		while($fetch_ussserid=mysql_fetch_array($select_ussserid))
		{ ?>
					    
                        	<?php $image=Getprofileimage($fetch_ussserid['user_profileid']);?>
                          <td width="10%" align="center" valign="top"><div class="numwraper"><img src="<?php echo $image; ?>" class="level_circle" /></div><br />
               
						  <a href="sunflower.php?ussserid=<?php echo $fetch_ussserid['user_profileid'];?>" class="forgotlink tooltipp">
						  <?php
						 
                         echo $fetch_ussserid['user_fname'];
						   ?>
						    <span style="font-size:12px; margin-left:-330px; margin-top:20px;">
							 <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch_ussserid['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div align="left" style="width:300px; line-height:30px;"> Name : <b><?php echo $fetch_ussserid['user_fname'].$fetch_ussserid['user_secondname']." ".$fetch_ussserid['user_lname']; ?> </b></div>
                       <div style="float:left;line-height:30px;" align="left"> Sponsor Name : <b><?php echo $fetch_ussserid['user_sponsername']; ?> </b></div>
					  <div style="float:left; width:150px;line-height:30px;" align="left"> Profile Id : <b><?php echo $fetch_ussserid['user_profileid']; ?></b></div>
                      <div style="float:left; width:150px;line-height:30px;" align="left"> Membership: <b><?php echo Getmembetshipfromprofileid($fetch_ussserid['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	 
					   <div>
					  <div style="float:left; width:170px;" align="left"> Refferal Limit : <b><?php echo Getmembetshipcount($fetch_ussserid['user_profileid']); ?> </b></div>
					  <div style="float:left; width:130px;" align="left"> Reffered Count: <b><?php echo directrefferalcount($fetch_ussserid['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					 <!-- <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>-->
					  
					  
					  </div>
					  </span>
						   
						  </a>	
						 
						 
						  </td>
                          
                       <?php }} }  sunGetUserNamePosFromId($ussserid); ?> 
					   
					   </tr>
                      </table> 
					  
				
					  <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
					  
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