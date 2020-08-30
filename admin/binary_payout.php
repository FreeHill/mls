<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu14='class="active"';

if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=mysql_query("update mlm_register set user_status ='1' where user_id ='$id'");

if($act)
{

header("location:user.php?actsucc");

echo "<script>window.location='user.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=mysql_query("update mlm_register set user_status ='0' where user_id ='$id'");

if($act)
{

header("location:user.php?inactsucc");

echo "<script>window.location='user.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=mysql_query("delete from mlm_register where user_id ='$id'");

if($det)
{

header("location:user.php?del");

echo "<script>window.location='user.php?del';</script>";

}

}


 ?>
 
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
						<li class="active">Binary Payout</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							<?php 
						   
						   if(isset($_REQUEST['success']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									User Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   <?php 
						   
						   if(isset($_REQUEST['suss']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Stock Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
							
							 <?php 
						   
						   if(isset($_REQUEST['upsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									User Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['del']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-trash red"></i>
								<strong class="red">
									User Deleted Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['inactsucc']))
						   {
						  ?> 
						  
						<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									User Unblocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
						      <?php 
						   
						   if(isset($_REQUEST['actsucc']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-error">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-off red"></i>
								<strong class="red">
									User blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   

							<div class="row-fluid">
								
								<div class="table-header">
							Binary Payout [<?php echo date("d-m-Y",strtotime($_REQUEST['detail'])); ?>]
								
								</div>
 
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="24" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="52">Sl.No</th>
											<th width="111">User Image</th>
										<th width="111">User Name</th>
										<th width="111">Profile id</th>
										 <th width="113"> Purchase bonus(CV)</th>
	                                	 <th width="113"> Referral bonus(CV)</th>
										  <th width="113"> Team bonus(CV)</th>
											<th width="134" class="hidden-480">Action</th>
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$payy=mysql_query("select * from mlm_payoutcalc where pay_date='$_REQUEST[detail]' AND bonus_type IN (0, 1, 2) group by pay_user order by pay_id desc");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from mlm_payoutcalc where pay_date='$_REQUEST[detail]' group by pay_user"));
									
									while($row_payy=mysql_fetch_array($payy))
									{
									
									$reg=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$row_payy[pay_user]'"));
									
									$puramt="";
									$purbonus=mysql_query("select * from mlm_payoutcalc where pay_date='$_REQUEST[detail]' and bonus_type='0' and pay_user='$reg[user_profileid]'" );
									
									while($rp=mysql_fetch_array($purbonus))
									{
									$puramt=$puramt+$rp['pay_cv'];
									}
									
									$refamt="";
									$refbonus=mysql_query("select * from mlm_payoutcalc where pay_date='$_REQUEST[detail]' and bonus_type='1' and pay_user='$reg[user_profileid]'" );
									
									while($drp=mysql_fetch_array($refbonus))
									{
									$refamt=$refamt+$drp['pay_cv'];
									}
									
									$teamamt="";
									
									$tbbonus=mysql_query("select * from mlm_payoutcalc where pay_date='$_REQUEST[detail]' and bonus_type='2' and pay_user='$reg[user_profileid]'" );
									
									while($tb=mysql_fetch_array($tbbonus))
									{
									$teamamt=$teamamt+$tb['pay_cv'];
									}
									
									
									?>
									
										<tr>
									
											<td class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											
											<?php
											
		if(file_exists("../uploads/profile_image/mid/".$reg['user_image']) && $reg['user_image']!='')
								{
									
									$profileproof_image="../uploads/profile_image/mid/".$reg['user_image'];
								}
								else
								{
									
									$profileproof_image="images/nouser.png";
								}
							
											
											 ?>
											
											
											<td>
											
											<img src="<?php echo $profileproof_image; ?>" width="50" height="50"/>
											</td>
											
											<td><?php echo $reg['user_fname']; ?></td>
											
											<td><?php echo $row_payy['pay_user']; ?></td>
											
											 <td><?php if($puramt!=""){ echo $puramt; } else { echo "0"; } ?></td>
											 
											  <td><?php if($refamt!=""){ echo $refamt; } else { echo "0"; }?></td>
											  
											   <td><?php if($teamamt!=""){ echo $teamamt; } else { echo "0"; } ?></td>
											  
											
                                             
											 <td>
											  <a href="binary_details.php?piddd=<?php echo $row_payy['pay_user'];?>&date=<?php echo $_REQUEST['detail']; ?>" >
													<img src="images/view_icon.gif" style="vertical-align:top; margin-top:2px;"/>view
													
													</a></td>
											 
											 
											 
											<!--<td class="td-actions" align="center">
											 
											     
											
												<div class="hidden-phone visible-desktop action-buttons">
												<span>	
													<a href="view_detail.php?detail=<?php //echo $row_usrr['user_id'];?>" >
													<img src="images/view_icon.gif" style="vertical-align:top; margin-top:2px;"/>
													
													</a></span>
													<?php  //if($row_usrr['user_status']=='1') { ?>
													
													<a class="red" href="user.php?inact=<?php //echo $row_usrr['user_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php // } if($row_usrr['user_status']=='0') { ?>
												
												<a class="green" href="user.php?act=<?php //echo $row_usrr['user_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php //} ?>
												  
                                         
												<a class="blue" href="user_edit.php?edit=<?php //echo $row_usrr['user_id'];?>">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												 

													<a class="grey" href="user.php?delete=<?php //echo $row_usrr['user_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a> 
													
													
												  </div>
												 
												</td>-->
											
										
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
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
			      null, null,null, null, null,null, null,
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
