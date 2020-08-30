<?php 
include("config/error.php");
include("includes/head.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['ussserid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}
//echo $_SESSION['profileid']; 
?>

<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	.numwraper img {
		width: 100%;
		height: 100%;
	}
	
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
</style>
<style type="text/css">
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
   width:300px;
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
 </style>
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");  	?>
			<!-- End Navigation -->
			
		
			<hr />
			
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php");?>
				 <?php 
					  $ussserid=(isset($_REQUEST['ussserid']))? $_REQUEST['ussserid'] :$_SESSION['profileid'];
					  
					  $getuser=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$ussserid'"));
					  ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">BINARY  STRUCTURE</h4>
							<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px #FF6600 solid; ">
			
			<tr>
			<td align="center" valign="bottom" style=" border:1px #FF6600 solid;"><img src="images/no-blue.jpg" width="64" height="77" /><br />			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="forgotlink tooltipp" ><span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> 
			      <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNameFromId($ussserid); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNameFromId($ussserid); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $ussserid; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b> <?php echo $getuser['user_sponsername']; ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php if($getuser['user_placementid']!="") { echo $getuser['user_placementid']; }  else { echo "0"; } ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b><?php echo "0"; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b><?php echo "0"; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
				  </div>
					  </span>
				
					<?php

					  
					  echo GetUserNameFromId($ussserid) ;?>
					 </a></a> <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span></td>
                    </tr>
                    
                   
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					  <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse; ">
                        <tr>
                          <td width="30%" align="right" valign="top"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L1</span></div></td>
                          <td width="32%">&nbsp;</td>
                          <td width="30%" align="left" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R1</span></div></td>
                        </tr>
                        <tr>
                          <td height="25" align="right" valign="middle">
						  <div style="width:70px;" align="center">
						  <?php if(GetUserIDPosFromId($ussserid,"L")=='0')
						  { 
						    echo GetUserNamePosFromId($ussserid,"L") ;
							}
							else {
							
							?>
						  <a href="binary.php?ussserid=<?php echo GetUserIDPosFromId($ussserid,"L");?>" class="forgotlink tooltipp">
						  <?php
						 
                          echo GetUserNamePosFromId($ussserid,"L") ;
						  $leftid=GetUserIDPosFromId($ussserid,"L");
		  $getuserleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$leftid'"));
						  
						   ?><span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId($ussserid,"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId($ussserid,"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId($ussserid,"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b> <?php echo $getuserleft['user_sponsername']; ?> </b></div>
					    <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>						  </a>	
						  <?php } ?>
						  </div>						  </td>
                          <td>&nbsp;</td>
                          <td align="left" valign="middle">
						   <div style="width:70px;" align="center">
						   <?php if(GetUserIDPosFromId($ussserid,"R")=='0')
						  { 
						    echo GetUserNamePosFromId($ussserid,"R") ;
							}
							else { ?>
						   <a href="binary_tree.php?userid=<?php  echo GetUserIDPosFromId($ussserid,"R") ;?>" class="forgotlink tooltipp">
						  <?php
						 
                          echo GetUserNamePosFromId($ussserid,"R") ;
						  
						    $rightid=GetUserIDPosFromId($ussserid,"R");
		  $getuserright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rightid'"));
						  
						  ?><span style="font-size:12px; margin-left:-150px; margin-top:15px; "><!--<img class="callout" src="images/callout.gif" />-->  <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId($ussserid,"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId($ussserid,"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId($ussserid,"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserright['user_sponsername']; ?> </b></div>
					   <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>						  </a>	
						  <?php } ?>
						  </div>						  </td>
                        </tr>
                      </table>
					  <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>					  </td>
                    </tr>
                    
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					  
					  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td width="25%" align="right" valign="top"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L2</span></div></td>
                          
                          <td width="16%" align="right" style="padding-left:10px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L3</span></div></td>
						   <td width="18%">&nbsp;</td>
                          <td width="15%" align="left" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R2</span></div></td>
					
                          <td width="15%" align="right" style="padding-right:20px;"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R3</span></div></td>
						  <td width="20%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right" valign="top"><table width="97%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td width="25%" align="right"> 
							   <div style="width:60px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"L") ;
							}
							else { ?>
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L") ;?>" class="forgotlink tooltipp">
							  <?php 
							  echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"L")  ;
							    $lleftid=GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L");
		  $getuserlleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lleftid'")); 
							  ?>	
							 
							   <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>							    </a>	 
							   <?php } ?>						 
							  </div>							  </td>
                              <td width="20%" align="right">
							   <div style="width:60px;" align="center">
							      <?php if(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"R") ;
							}
							else { ?>
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R") ;?>" class="forgotlink tooltipp">
							  <?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"R") ;
							  
							    $lrightid=GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R");
		  $getuserlright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrightid'")); 
							  ?>
							  
							  
							   <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>							    </a>
							  	
							  <?php } ?>	
							  </div>							  </td>
                              <td width="30%" align="right">
							   <div style="width:60px;" align="center">
							<?php if(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"L") ;
							}
							else { ?>
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L") ;?>" class="forgotlink tooltipp">
							  <?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"L") ;
							   $rleftid=GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R");
		  $getuserrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rleftid'")); 
							  ?>
							  <span style="font-size:12px; margin-left:-150px; margin-top:20px;">
							  <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					     <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							    </a>
							  	
							  <?php } ?>	
							  </div>						      </td>
                              <td width="25%" align="left" style="padding-left:100px">
							  
							   <div style="width:40px;" align="center">
							       <?php if(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"R") ;
							}
							else { ?>
							   
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"R") ;
							$rrightid=GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R");
		                     $getuserrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrightid'"));
							   
							   ?>
							   <span style="font-size:12px; margin-left:-220px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId($ussserid,"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							    </a>
							   
							   <?php } ?>
							   </div>						      </td>
                            </tr>
                          </table> </td>
                          </tr>
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 2</span></td>
                    </tr>
                   
                    <tr>
                      <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
                          <td width="20%" align="right" style="padding-right:5px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L4</span></div></td>
                          <td width="9%" align="right"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L5</span></div></td>
                          <td width="9%" align="right"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L6</span></div></td>
                          <td width="9%" align="right" style="padding-left:15px;"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L7</span></div></td>
						  
						  
                          <td width="14%" align="right"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R4</span></div></td>
                          <td width="11%" align="left" style="padding-left:30px;"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R5</span></div></td>
                          <td width="10%"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R6</span></div></td>
                          <td width="18%"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>R7</span></div></td>
                        </tr>
                        <tr>
                          <td colspan="8"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td width="17%" align="right">
							   <div style="width:70px;" align="center">
							   
							      <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L") ;
							
							
							}
							else { ?>
							   
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L") ;?>" class="forgotlink tooltipp"><?php
							  echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L") ;
							  
							  $llleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L");
		                     $getuserllleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$llleftid'"));
							  
							  ?>
							  <span style="font-size:12px; "><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
			          <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserllleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserllleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							    </a>
							  <?php } ?>
							  </div>							  </td>
                              <td width="10%" align="right">
							  
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R") ;
				
							}
							else { ?>
							   
							   <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R") ;?>" class="forgotlink tooltipp"><?php
							   
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R") ;
							   
							   	$llrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R");
		                     $getuserllright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$llrightid'"));
							   
							   ?>
							    <span style="font-size:12px; "><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserllright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserllright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>
							   <?php }?>
							   </div>						      </td>
                              <td width="10%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L") ;
							}
							else { ?>
							   <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"L") ;?>" class="forgotlink tooltipp">
							   <?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L") ;
							   
							   $lrleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L");
							  
		                     $getuserlrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrleftid'"));
							   ?>
							    <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>	
							   <?php } ?>
							   </div>						      </td>
                              <td width="11%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;
							}
							else { ?>
							  <a href="binary.php?userid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($userid,"L"),"R"),"R") ;
							   
							   $lrrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"R");
		                     $getuserlrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$lrrightid'"));
							   
							   ?>
							    <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> 
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"L"),"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserlrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserlrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>	
							   <?php } ?>
							   </div>						      </td>
                              <td width="13%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L") ;
							}
							else { ?>
							 <a href="binary.php?ussserid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L") ;
							   
							   $rlleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L");
		                     $getuserrlleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rlleftid'"));
							   
							   
							   ?>
							   
							    <span style="font-size:12px; margin-left:-200px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrlleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrlleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>
							   <?php } ?>
							   </div>						      </td>
                              <td width="12%" align="right">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R") ;
							}
							else { ?>
							  <a href="binary.php?ussserid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R") ;
							     
							 $rlrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R");
		                     $getuserrlright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rlrightid'"));
							   
							   
							   ?>
							   <span style="font-size:12px; margin-left:-200px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"L"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrlright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrlright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>
							   <?php } ?>
							   </div>						      </td>
                              <td width="8%" align="right">
							   <div style="width:70px;" align="center">
							   
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L") ;
							}
							else { ?>
							 <a href="binary.php?ussserid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L") ;?>" class="forgotlink tooltipp"><?php
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L");
							   
							    $rrleftid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L");
		                     $getuserrrleft=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrleftid'"));
							   
							   ?>
							    <span style="font-size:12px; margin-left:-220px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"L");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					   <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrrleft['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrrleft['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>
							   <?php } ?>
							   </div>						      </td>
                              <td width="19%" align="left" style="padding-left:30px;">
							   <div style="width:70px;" align="center">
							    <?php if(GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R")=='0')
						  { 
						    echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R") ;
							}
							else { ?>
							   <a href="binary.php?ussserid=<?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R") ;?>" class="forgotlink tooltipp"><?php
							   
							   echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R") ;
							   
							    $rrrightid=GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R");
								
		                     $getuserrrright=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$rrrightid'"));
							   
							   ?>
							    <span style="font-size:12px; margin-left:-280px; margin-top:20px;">
							   <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R"); ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo GetUserNamePosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R"); ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo GetUserIDPosFromId(GetUserIDPosFromId(GetUserIDPosFromId($ussserid,"R"),"R"),"R");?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					    <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $getuserrrright['user_sponsername']; ?></b></div>
					  <div style="float:left; width:150px;" align="left"> Placement Id : <b><?php echo $getuserrrright['user_placementid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  </div>
					  </span>							   </a>	
							    <?php } ?>
							    </div>						      </td>
                            </tr>
                          </table></td>
                          </tr>
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 3</span></td>
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