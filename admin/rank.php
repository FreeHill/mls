<?php

include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu13='class="active"';

if(isset($_REQUEST['submit']))
{
$name=$_REQUEST['name'];
$pair=$_REQUEST['pair'];
$cv=$_REQUEST['cv'];
$acl=$_REQUEST['acl'];
//echo "insert into mlm_country(`country_name`) values('$country')"; exit;

$cou=mysql_query("insert into mlm_rank(`rank_name`,`rank_pair`,`rank_cv`, rank_active_compression) values('$name','$pair','$cv', '$acl')");

if($cou)
{

header("location:rank.php?succ");

echo "<script>window.location='rank.php?succ';</script>";

}

}

if(isset($_REQUEST['update']))
{

$id=$_REQUEST['id'];

$name=$_REQUEST['name'];
$pair=$_REQUEST['pair'];
$cv=$_REQUEST['cv'];
$acl=$_REQUEST['acl'];

$cou=mysql_query("update mlm_rank set rank_name='$name',rank_pair='$pair',`rank_cv`='$cv', rank_active_compression='$acl' where rank_id='$id'");

if($cou)
{

header("location:rank.php?upsucc");

echo "<script>window.location='rank.php?upsucc';</script>";

}

}

if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=mysql_query("update mlm_rank set rank_status='1' where rank_id='$id'");

if($act)
{

header("location:rank.php?actsucc");

echo "<script>window.location='rank.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=mysql_query("update mlm_rank set rank_status='0' where rank_id='$id'");

if($act)
{

header("location:rank.php?inactsucc");

echo "<script>window.location='rank.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=mysql_query("delete from mlm_rank where rank_id='$id'");

if($det)
{

header("location:rank.php?del");

echo "<script>window.location='rank.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "delete from mlm_rank where rank_id='$del_id'";
$result = mysql_query($sql);

}

if($result){?> <script>
window.location="rank.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "update mlm_rank set rank_status='0' where rank_id='$act_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="rank.php?inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

//echo "update mlm_news set news_status='1' where news_id='$inact_id'"; exit;

$sql = "update mlm_rank set rank_status='1' where rank_id='$inact_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="rank.php?actsucc";
</script> <?php
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
			height:55%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	
		<script>
	function muldel()
	{
	//alert("df");
	var chks = document.getElementsByName('chkval[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }
    if (hasChecked == false) {
        alert("Please select at least one.");
        return false;
    }
    return true;
	
	}
	
	</script>
	
	<script>
	
	function rank_validate()
	{
	
	if(document.getElementById('name').value=="")
	{
	alert("Please Enter the rank name");
	document.getElementById('name').focus();
	return false;
	
	}
	
		if(document.getElementById('pair').value=="")
	{
	alert("Please Enter the pair count");
	document.getElementById('pair').focus();
	return false;
	
	}
	
	if(document.getElementById('cv').value=="")
	{
	alert("Please Enter the CV amount");
	document.getElementById('cv').focus();
	return false;
	
	}
	
	if(document.getElementById('acl').value=="")
	{
		alert("Please Enter the Active compresion level");
		document.getElementById('acl').focus();
		return false;
	}
	}
	
	
	</script>
	
		<script>
	
	function rank_validate1()
	{
	
   if(document.getElementById('namee').value=="")
	{
	alert("Please Enter the rank name");
	document.getElementById('namee').focus();
	return false;
	
	}
	
		if(document.getElementById('pairr').value=="")
	{
	alert("Please Enter the pair count");
	document.getElementById('pairr').focus();
	return false;
	
	}
	
	if(document.getElementById('cvv').value=="")
	{
	alert("Please Enter the CV amount");
	document.getElementById('cvv').focus();
	return false;
	
	}
	
	if(document.getElementById('acll').value=="")
	{
	alert("Please Enter the Active compresion level");
	document.getElementById('acll').focus();
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
						<li class="active">Rank</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<!--/row--> 
							
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
									Rank Added Successfully !!!
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
									Rank Updated Successfully !!!
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
									Rank Deleted Successfully !!!
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
									Rank Unblocked Successfully !!!
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
									Rank blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                            <form action="" method="post">

							<div class="row-fluid">
								
								<div class="table-header">
								Rank Management
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop();" style="color:#FFFFFF;">+ ADD Rank</a></span>
								
								</div>

								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
									<thead>
										<tr>
											<th width="23" class="center">
												<label>
													<input type="checkbox" />
													<span class="lbl"></span>
												</label>
										  </th>
											<th width="33">SNo</th>
											
												<th width="113">Rank Name</th>
											<th width="107">Pair</th>
										<th width="107">CV</th>
										<th width="235">Active Compression</th>
											<th class="hidden-480">Status</th>
                                           
											
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$rank=mysql_query("select * from mlm_rank order by rank_id asc");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from mlm_rank"));
									
									while($row_rank=mysql_fetch_array($rank))
									{
									?>
									
										<tr>
									
											<td class="center">
												<label>
					<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_rank['rank_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td>
										<?php echo $row_rank['rank_name']; ?>
											</td>
										<td>
										<span class="label label-info arrowed-in-right arrowed"><?php echo $row_rank['rank_pair']; ?></span>
										  </td>
											<td>
										<span class="label label-info arrowed-in-right arrowed"><?php echo $row_rank['rank_cv']; ?></span>
											</td>
											
											<td>
										<span class="label label-info arrowed-in-right arrowed"><?php echo $row_rank['rank_active_compression']; ?></span>
											</td>

											<td width="99" align="center" class="td-actions">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_rank['rank_status']=='1') { ?>
													
													<a class="red" href="rank.php?inact=<?php echo $row_rank['rank_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_rank['rank_status']=='0') { ?>
												
												<a class="green" href="rank.php?act=<?php echo $row_rank['rank_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                          
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_rank['rank_id']; ?>','<?php echo $row_rank['rank_name']; ?>','<?php echo $row_rank['rank_pair']; ?>','<?php echo $row_rank['rank_cv']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												

													<a class="grey" href="rank.php?delete=<?php echo $row_rank['rank_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
											  </div>
										  </td>
											
									
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
							
								
								 	<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left" title="click to deactivate"/>
							
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
			      null, null,null, null,null,
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
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return rank_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add Rank</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Rank Name <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><input type="text" name="name" id="name" /></td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td> Pairs <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="pair" id="pair" />
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td> CV Amount <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="cv" id="cv" />
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td> Active compresion level <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="acl" id="acl" />
								</td>
								</tr>
								
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop();">
									
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
									<form name="myfor" id="myfor" action="" method="post" onSubmit="return rank_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Rank</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Rank Name <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><input type="text" name="name" id="namee" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Pairs <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="anss" />-->
								<input type="text" name="pair" id="pairr" />
								
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>CV Amount <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="anss" />-->
								<input type="text" name="cv" id="cvv" />
								
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Active compresion level <span style="color:#FF0000;">*</span> </td>
								<td> : </td>
								<td><!--<input type="text" name="ans" id="anss" />-->
								<input type="text" name="acl" id="acll" />
								
								</td>
								</tr>
								
								<input type="hidden" name="id" id="rankid" />
								
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
	function showpop1(val,name,pair,cv)
	{
	//alert(name);
	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('rankid').value=val;
	document.getElementById('namee').value=name;
	document.getElementById('pairr').value=pair;
	document.getElementById('cvv').value=cv;
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
