<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu22='class="active"';

if(isset($_REQUEST['update']))
{

$rewid=$_REQUEST['rewid'];

$pos=$_REQUEST['position'];
$des=$_REQUEST['des'];
$worth=$_REQUEST['worth'];
$outbonus=$_REQUEST['outbonus'];
$sponsormin=$_REQUEST['sponmin'];
$sponsormax=$_REQUEST['sponmax'];

$cou=mysql_query("update mlm_reward set position='$pos',des='$des',worth='$worth',out_bonus='$outbonus',sponsor_req_min='$sponsormin',sponsor_req_max='$sponsormax' where id='$rewid'");

if($cou)
{

header("location:reward.php?upsucc");

echo "<script>window.location='reward.php?upsucc';</script>";

}

}

?>
	
	
 
 <style type="text/css">
		.black_overlay{
			display:none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 200%;
			background-color: black;			
			z-index:1001;
			-moz-opacity: 0.7;
			opacity:.570;
			filter: alpha(opacity=70);
		}
		.white_content {
		display:none;
			position: absolute;
			top: 20%;
			left: 25%;
			width: 50%;
			height:60%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">

	tinyMCE.init({

		// General options

		mode : "textareas",

		theme : "simple",

		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options

		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,",


		theme_advanced_toolbar_location : "top",

		theme_advanced_toolbar_align : "left",

		theme_advanced_statusbar_location : "bottom",

		theme_advanced_resizing : false,



		// Example content CSS (should be your site CSS)

		content_css : "css/content.css",



		// Drop lists for link/image/media/template dialogs

		template_external_list_url : "lists/template_list.js",

		external_link_list_url : "lists/link_list.js",

		external_image_list_url : "lists/image_list.js",

		media_external_list_url : "lists/media_list.js",



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>


		<script>
	
	function test_validate()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title').value=="")
	{
	alert("Please Enter the title");
	document.getElementById('title').focus();
	return false;
	
	}
	
		if(document.getElementById('comment').value=="")
	{
	alert("Please Enter the comment");
	document.getElementById('comment').focus();
	return false;
	
	}
	
	}
	
	
	</script>
	<script>
	function test_validate1()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title1').value=="")
	{
	alert("Please Enter the title");
	document.getElementById('title1').focus();
	return false;
	
	}
	
		if(document.getElementById('comment1').value=="")
	{
	alert("Please Enter the comment");
	document.getElementById('comment1').focus();
	return false;
	
	}
	
	}
	
	
	</script>
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
						<li class="active">Reward Management</li>
					</ul><!--.breadcrumb-->

					<!--#nav-search-->
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row-->
							   
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
									Reward Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						     <?php 
						   
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">

									 Added Successfully !!!
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
									Reward Deleted Successfully !!!
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
									Level Unblocked Successfully !!!
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
									Level blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                          <form action="" method="post">
						  
							<div class="row-fluid">
								
								<div class="table-header">
								Reward Management
								
								<!--<span style="float:right; padding-right:5px;"> <a href="#" onclick="showpop();" style="color:#FFFFFF;">+ Add </a></span>-->
								
								</div>

								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<!--<th width="24" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>-->
										<!--	<th width="37">Sl.No</th>-->
											
												<th width="20">S.No</th>
                                                <th width="15" >Position</th>
                                                <th width="15" >Description</th>
                                                 <th width="15" >worth</th>
                                                  <th width="15" >outside bonus</th>
                                                   <th width="15" >sponsor minimum</th>
                                                    <th width="15" >sponsor maximum</th>
                                                
                                                
                                                
                                                
                                                
										<!--	
										 <th width="90" >Title</th>
											 <th width="221" >Comments</th>
											 <th width="95" >Date</th>
											 <th width="80" >Ip</th>-->
											<th width="72" class="hidden-480">Status</th>
                                         
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$test=mysql_query("select * from mlm_reward ");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from mlm_reward"));
									
									while($row_test=mysql_fetch_array($test))
									{
									$idd=$row_test['test_user'];
									
								$user=mysql_fetch_array(mysql_query("select * from mlm_reward where id='$idd'"));
									
									?>
									
										<tr>
									
											<!--<td class="center">
												<label>
				<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php /*?><?php echo $row_test['test_id']; ?>"<?php */?>  />
													<span class="lbl"></span>
												</label>
											</td>-->

											<td>
												<?php echo $i; ?>
											</td>
											
										
                                       
											
											
											<td><?php echo $row_test['position']; ?></td>
                                            
												<td><?php echo $row_test['des']; ?></td>
                                                <td><?php echo $row_test['worth']; ?></td>
                                                <td><?php echo $row_test['out_bonus']; ?></td>
                                                <td><?php echo $row_test['sponsor_req_min']; ?></td>
                                                <td><?php echo $row_test['sponsor_req_max']; ?></td>
                                                
                                                
                                                
                                                
                                            
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_test['test_status']=='1') { ?>
													
													
												  
												  <?php } ?>
												  
                                              
												<a class="blue" href="#" onclick="showpop1(<?php echo $row_test['id']; ?>,'<?php echo $row_test['position']; ?>','<?php echo $row_test['des']; ?>',<?php echo $row_test['worth']; ?>,<?php echo $row_test['out_bonus']; ?>,<?php echo $row_test['sponsor_req_min']; ?>,<?php echo $row_test['sponsor_req_max'];?>,<?php echo $row_test['id']; ?>);">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												
													
											
							
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>
								
								<div class="modal-footer">
								
								<!--<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left" title="click to deactivate"/>-->
							
								</div>
								</form>

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

				<!--/#ace-settings-container-->
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
			      null, null,null, null, null,null,
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
		
     <div id="light"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return test_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">ADD Testimonial</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Level </td>
								<td> : </td>
								<td><input type="text" name="level" id="level" /></td>
								</tr>
								
									<tr>
								<td>Amount </td>
								<td> : </td>
								<td><input type="text" name="amount" id="amount" /></td>
								</tr>
								
								
								
								
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="add" value="Submit" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop()
	{
    // alert(name);
	 	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'; 
	
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop()
	{
	
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'; 
	}
	
	</script>
	
    <div id="light1"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return test_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Reward</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								
								
									<tr>
								<td>Position</td>
								<td> : </td>
								<td><input type="text" name="position" id="position" /></td>
								</tr>
								
                                <tr>
								<td>Description</td>
								<td> : </td>
								<td><textarea name="des" id="des"></textarea></td>
								</tr>
                                
                                <tr>
								<td>Worth</td>
								<td> : </td>
								<td><input type="text" name="worth" id="worth" /></td>
								</tr>
								
								
							
                                
                                
                                <tr>
								<td>Outside bonus</td>
								<td> : </td>
								<td><input type="text" name="outbonus" id="outbonus" /></td>
								</tr>
								
                                <tr>
								<td>Sponsor Required Minimum</td>
								<td> : </td>
								<td><input type="text" name="sponmin" id="sponmin" /></td>
								</tr>
                                
                                  <tr>
								<td>Sponsor Required Maximum</td>
								<td> : </td>
								<td><input type="text" name="sponmax" id="sponmax" /></td>
								</tr>
                                <input type="hidden" name="rewid" id="rewid" />
                                
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop1();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade1" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop1(rewid,position,des,worth,outbonus,sponmin,sponmax,id)
	{
     	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('position').value=position;
	document.getElementById('des').value=tinyMCE.activeEditor.setContent(des);
	document.getElementById('worth').value=worth;
	document.getElementById('outbonus').value=outbonus;
	document.getElementById('sponmin').value=sponmin;
	document.getElementById('sponmax').value=sponmax;
	document.getElementById('rewid').value=rewid;
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop1()
	{
	
	document.getElementById('light1').style.display='none';
	document.getElementById('fade1').style.display='none'; 
	}
	
	</script>
	
	</body>
</html>
