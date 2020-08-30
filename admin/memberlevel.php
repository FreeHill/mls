<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu6='class="active"';


$sunfloweruser=mysql_fetch_array(mysql_query("SELECT user_fname FROM mlm_register WHERE user_profileid='$_REQUEST[piddd]'"));

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
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li>
							<a href="user.php">User Management</a>

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
						<li>
							TREE STRUCTURE

							<span class="divider">
								<i class="icon-angle-right"></i>
							</span>
						</li>
					
					</ul><!--.breadcrumb-->

				</div>
				
				<div class="page-content">
					<!--/.page-header-->
					
						<h2>
					  &nbsp;TREE STRUCTURE
 						</h2>
					<!--/.page-header-->
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							
							<div class="row-fluid">
								
								
								<?php  $ussserid=(isset($_REQUEST['ussserid']))? $_REQUEST['ussserid'] :$_SESSION['profileid']; ?>
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">TREE STRUCTURE</h4>
								<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px #FF6600 solid; ">
			
			<tr><?php $img=Getprofileimageadmin($ussserid); ?>
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
					  <div style="float:left; width:300px;" align="left"> Name : <b><?php echo $fetch['user_fname'].$fetch['user_secondname']." ".$fetch['user_lname']; ?> </b></div>
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
					    
                        	<?php $image=Getprofileimageadmin($fetch_ussserid['user_profileid']);?>
                          <td width="10%" align="center" valign="top"><div class="numwraper"><img src="<?php echo $image; ?>" class="level_circle" /></div><br />
               
						  <a href="memberlevel.php?ussserid=<?php echo $fetch_ussserid['user_profileid'];?>" class="forgotlink tooltipp">
						  <?php
						 
                         echo $fetch_ussserid['user_fname'];
						   ?>
						    <span style="font-size:12px; margin-left:-330px; margin-top:20px;">
							 <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch_ussserid['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div align="left" style="width:300px; line-height:30px;"> Name : <b><?php echo $fetch_ussserid['user_fname'].$fetch_ussserid['user_secondname']." ".$fetch_ussserid['user_lname']; ?> </b></div>
                       <div style="float:left;line-height:30px; width:170px;" align="left"> Sponsor Name : <b><?php echo $fetch_ussserid['user_sponsername']; ?> </b></div>
					  <div style="float:left; width:130px;line-height:30px;" align="left"> Profile Id : <b><?php echo $fetch_ussserid['user_profileid']; ?></b></div>
                      <div style="float:left; width:170px;line-height:30px;" align="left"> Membership: <b><?php echo Getmembetshipfromprofileid($fetch_ussserid['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					   <div>
					  <div style="float:left; width:170px;" align="left"> Refferal Limit : <b><?php echo Getmembetshipcount($fetch_ussserid['user_profileid']); ?> </b></div>
					  <div style="float:left; width:130px;" align="left"> Reffered Count: <b><?php echo directrefferalcount($fetch_ussserid['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					
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

								<!--<div class="modal-footer">
									<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
										<i class="icon-remove"></i>
										Close
									</button>

									<div class="pagination pull-right no-margin">
										<ul>
											<li class="prev disabled">
												<a href="#">
													<i class="icon-double-angle-left"></i>
												</a>
											</li>

											<li class="active">
												<a href="#">1</a>
											</li>

											<li>
												<a href="#">2</a>
											</li>

											<li>
												<a href="#">3</a>
											</li>

											<li class="next">
												<a href="#">
													<i class="icon-double-angle-right"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>-->
							</div><!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-class="default" value="#438EB9" />#438EB9
									<option data-class="skin-1" value="#222A2D" />#222A2D
									<option data-class="skin-2" value="#C6487E" />#C6487E
									<option data-class="skin-3" value="#D0D0D0" />#D0D0D0
								</select>
							</div>
							<span>&nbsp; Choose Skin</span>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
							<label class="lbl" for="ace-settings-header"> Fixed Header</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
						</div>

						<div>
							<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
						</div>
					</div>
				</div><!--/#ace-settings-container-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null,null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
		
		

 
	</body>
</html>
