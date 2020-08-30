<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu7='class="active"';

if(isset($_REQUEST['submit']))
{
   
	//echo "testting";
	$name = mysql_real_escape_string($_REQUEST['accname']);
	$number = mysql_real_escape_string($_REQUEST['accnumber']); 
	$bank = mysql_real_escape_string($_REQUEST['bankname']);
	$branch = mysql_real_escape_string($_REQUEST['branch']); 
	$ifsci_code = mysql_real_escape_string($_REQUEST['ifsci']);
	$img=$_FILES['logo']['name'];
	if(($name == "")||($ifsci_code == "")||($number == "")||($bank == "")||($branch == ""))
	{
		header("Location:oflinepayment.php?error");
		exit;
	}
	
	
	if($img == "")
	{
		header("Location:oflinepayment.php?error");
		exit;
	} 
	else 
	{
	
	$img_size = filesize($_FILES['logo']['tmp_name']);
	//echo $img_size;exit;
			if($img_size > 2097152) //1048576 = 1MB
			{
				header("Location:oflinepayment.php?largeimage");
				exit;
			}
			else
			{
				$split_name = explode(".",$img);
		
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			 include("includes/resize-class.php");
			
			$cate_img_small = "news".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/banklogo/";
			move_uploaded_file($_FILES['logo']['tmp_name'],"../uploads/banklogo/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("../uploads/banklogo/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150,80, 'exact');

			$resizeObj -> saveImage($image_path.$cate_img_small, 100);
			
		}
		else
		{
			header("Location:oflinepayment.php?not-a-image");
			exit;
		}
	}
}
	
	
 $insert = mysql_query("INSERT INTO mlm_bankdetails (account_name,account_number,bank_name,bank_logo,branch_name,ifsci) VALUES ('$name','$number','$bank','$cate_img_small','$branch','$ifsci_code')");
	if($insert)
	 { 
	// echo "testing;"; exit;
	 header("Location:oflinepayment.php?succ"); 
	 ?>
	<script>
	window.location="oflinepayment.php?succ";
	</script>	
	<?php
	
	}
}



if(isset($_REQUEST['update']))
{

	$name = mysql_real_escape_string($_REQUEST['accname']);
	$number = mysql_real_escape_string($_REQUEST['accnumber']); 
	$bank = mysql_real_escape_string($_REQUEST['bankname']);
	$branch = mysql_real_escape_string($_REQUEST['branch']); 
	$ifsci_code = mysql_real_escape_string($_REQUEST['ifsci']);
	$img=$_FILES['logo']['name'];
	$idd = mysql_real_escape_string($_REQUEST['id']);
	if(($name == "")||($ifsci_code == "")||($number == "")||($bank == "")||($branch == ""))
		{
			header("Location:oflinepayment.php?error");
			exit;
		}	
	
	if($img != "")
	{
			
	$img_size = filesize($_FILES['logo']['tmp_name']);
	//echo $img_size;exit;
			if($img_size > 2097152) //1048576 = 1MB
			{
				header("Location:oflinepayment.php?largeimage");
				exit;
			}
			else
			{
				$split_name = explode(".",$img);
		
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			 include("includes/resize-class.php");
			
			$cate_img_small = "news".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/banklogo/";
			move_uploaded_file($_FILES['logo']['tmp_name'],"../uploads/banklogo/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("../uploads/banklogo/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150,80, 'exact');

			$resizeObj -> saveImage($image_path.$cate_img_small, 100);
			$image=$cate_img_small;
		}
		else
		{
			header("Location:oflinepayment.php?not-a-image");
			exit;
		}
	} }
	else
	{
		$image=$_REQUEST[''];
	}

	$update = mysql_query("UPDATE mlm_bankdetails SET account_name='$name',account_number='$number',bank_name='$bank',branch_name='$branch',ifsci='$ifsci_code' WHERE id='$idd'");
	if($update) {
	
		header("Location:oflinepayment.php?editsuccess");
		
		?>
	<script>
	window.location="oflinepayment.php?editsuccess";
	</script>	
	<?php
	}
 }
if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=mysql_query("update mlm_bankdetails set status='1' where id='$id'");

if($act)
{

header("location:oflinepayment.php?actsucc");

echo "<script>window.location='oflinepayment.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=mysql_query("update mlm_bankdetails set status='0' where id='$id'");

if($act)
{

header("location:oflinepayment.php?inactsucc");

echo "<script>window.location='oflinepayment.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=mysql_query("delete from mlm_bankdetails where id='$id'");

if($det)
{

header("location:oflinepayment.php?del");

echo "<script>window.location='oflinepayment.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "delete from mlm_bankdetails where id='$del_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="oflinepayment.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "update mlm_bankdetails set status='0' where id='$act_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="oflinepayment.php?inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

//echo "update mlm_bankdetails set news_status='1' where news_id='$inact_id'"; exit;

$sql = "update mlm_bankdetails set status='1' where id='$inact_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="oflinepayment.php?actsucc";
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
			top: 15%;
			left: 22%;
			width: 55%;
			height:85%;
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
	
	function news_validate()
	{
	
	if(document.getElementById('accname').value=="")
	{
	alert("Please Enter Account Name");
	document.getElementById('accname').focus();
	return false;
	
	}
	
	if(document.getElementById('accnumber').value=="")
	{
	alert("Please Enter the Account Number");
	document.getElementById('accnumber').focus();
	return false;
	
	}
	if(document.getElementById('bankname').value=="")
	{
	alert("Please Enter the Bank Name");
	document.getElementById('bankname').focus();
	return false;
	
	}
	if(document.getElementById('branch').value=="")
	{
	alert("Please Enter the Branch");
	document.getElementById('branch').focus();
	return false;
	
	}
	if(document.getElementById('ifsci').value=="")
	{
	alert("Please Enter the IFSCI Code");
	document.getElementById('ifsci').focus();
	return false;
	
	}
	
	
	
	
	}
	
	
	</script>
	
		<script>
	
	function news_validate1()
	{
	
	if(document.getElementById('ed_accname').value=="")
	{
	alert("Please Enter Account Name");
	document.getElementById('ed_accname').focus();
	return false;
	
	}
	
	if(document.getElementById('ed_accnum').value=="")
	{
	alert("Please Enter the Account Number");
	document.getElementById('ed_accnum').focus();
	return false;
	
	}
	if(document.getElementById('ed_bank').value=="")
	{
	alert("Please Enter the Bank Name");
	document.getElementById('ed_bank').focus();
	return false;
	
	}
	if(document.getElementById('ed_branch').value=="")
	{
	alert("Please Enter the Branch");
	document.getElementById('ed_branch').focus();
	return false;
	
	}
	if(document.getElementById('ed_ifsci').value=="")
	{
	alert("Please Enter the IFSCI Code");
	document.getElementById('ed_ifsci').focus();
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
						<li class="active">Account Details </li>
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
						   
						   if(isset($_REQUEST['succ']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Account Details Added Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
							
							 <?php 
						   
						   if(isset($_REQUEST['editsuccess']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									Account Details Updated Successfully !!!
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
									Account Details Deleted Successfully !!!
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
									Account Details Unblocked Successfully !!!
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
									Account Details blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Account Details 
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop();" style="color:#FFFFFF;">+ ADD Account Details </a></span>
								
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
											<th width="37">Sl.No</th>
											
											<th width="98">A/C Name</th>
											
												<th width="100">A/C Number</th>
											
										
											<th width="51">Bank Name</th>
                                            <th width="51">Branch</th>
											<th width="51">IFSCI</th>
											
											<th width="51">Action</th>
										</tr>
									</thead>
									<tbody>
									
									<?php 
									
									$news=mysql_query("select * from mlm_bankdetails order by id desc");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from mlm_bankdetails"));
									
									while($row_news=mysql_fetch_array($news))
									{
									?>
									
										<tr>
									
											<td class="center">
												<label>
													<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_news['id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $row_news['account_name']; ?></td>
											
											<td>
											
											<?php echo $row_news['account_number']; ?>
											
											</td>
										<td>
											<?php echo $row_news['bank_name']; ?>
											</td>
											<td>
												<?php echo $row_news['branch_name']; ?>
											</td>
                                            <td>
												<?php echo $row_news['ifsci']; ?>
											</td>
											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_news['status']=='1') { ?>
													
													<a class="red" href="oflinepayment.php?inact=<?php echo $row_news['id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_news['status']=='0') { ?>
												
												<a class="green" href="oflinepayment.php?act=<?php echo $row_news['id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                                </div>
										 
												<div class="hidden-phone visible-desktop action-buttons">
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_news['id']; ?>','<?php echo $row_news['account_name']; ?>','<?php echo $row_news['account_number']; ?>','<?php echo $row_news['bank_name']; ?>','<?php echo $row_news['branch_name']; ?>','<?php echo $row_news['ifsci']; ?>','<?php echo $row_news['bank_logo']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												  </div>
												
												<div class="hidden-phone visible-desktop action-buttons">
												

													<a class="grey" href="oflinepayment.php?delete=<?php echo $row_news['id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
														<i class="icon-trash bigger-130" title="click to delete"></i>
													</a>
												  </div>
												</td>
											
										
											
										</tr>

									<?php $i++; }?>
												
								  </tbody>
							  </table>
						  </div>
								</div>

								<div class="modal-footer">
								
								<input type="submit" name="mul_delete" id="mul_delete" value="Delete" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left" title="click to delete" />
								
								<input type="submit" name="mul_active" id="mul_active" value="Active" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="click to activate"/>
								
								<input type="submit" name="mul_inactive" id="mul_inactive" value="Inactive" onclick="return muldel();" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-grey pull-left" title="click to deactivate"/>
							
								</div>
								</form>
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
			      null, null,null, null, null,
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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return news_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add Account Details</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Account Name<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="accname" id="accname" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Account Number<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="accnumber" id="accnumber" />
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Bank Name <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="bankname" id="bankname" />
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Brach <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="branch" id="branch" />
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>IFSCI<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="ifsci" id="ifsci" />
								</td>
								</tr>
                                <tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Bank Logo<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="logo">
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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return news_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Account Details</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								
								<tr>
								<td>Account Name<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="accname" id="ed_accname" /></td>
								</tr>
								<input type="hidden" name="exist_img" id="exist_img">
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Account Number<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="accnumber" id="ed_accnum" />
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Bank Name</td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="bankname" id="ed_bank" />
								</td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Branch<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="branch" id="ed_branch" />
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>IFSCI<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="ifsci" id="ed_ifsci" />
								</td>
								</tr>
								<input type="hidden" name="id" id="ed_idd" />
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Exist Logo</td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<!--<input type="file" name="logo">-->
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Bank Logo<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="logo">
								</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td colspan="3">
								<div class="form-actions" style="margin:0px;">
				<input type="submit" name="update" value="UPDATE" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onclick="hidepop1();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade1" class="black_overlay" >&nbsp;</div>
						
						
						
									

	<script type="text/javascript">
	function showpop1(idd,acnam,acnum,bnk,brch,code,img)
	{
		
		document.getElementById('light1').style.display='block';
		document.getElementById('fade1').style.display='block'; 
		document.getElementById('ed_idd').value=idd;
		document.getElementById('ed_accname').value=acnam;
		document.getElementById('ed_accnum').value=acnum;
		document.getElementById('ed_bank').value=bnk;
		document.getElementById('ed_branch').value=brch;
		document.getElementById('ed_ifsci').value=code;
		document.getElementById('exist_img').value=img;
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
