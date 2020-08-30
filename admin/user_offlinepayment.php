<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu14='class="active"';

if(isset($_REQUEST['submit']))
{
	
	$mailid = mysql_real_escape_string($_REQUEST['email']);
	$member_type = mysql_real_escape_string($_REQUEST['member_type']); 
	$dd=date('d-m-Y');
	$payment = mysql_real_escape_string($_REQUEST['payment']);
	$transaction = mysql_real_escape_string($_REQUEST['transaction']);
   	if(($mailid == "")||($member_type == "")||($payment == "")||($transaction == ""))
	{
		header("Location:user_offlinepayment.php?error");
		exit;
	} 
	
 $insert = mysql_query("INSERT INTO  mlm_offlinepayment (email_id,membership_id,transaction_id,payment_id,requirest_date) VALUES ('$mailid','$member_type','$transaction','$payment','$dd')");
	
	if($insert)
	 { 
	 header("Location:user_offlinepayment.php?succ"); 
	 ?>
	<script>
	window.location="user_offlinepayment.php?succ";
	</script>	
	<?php
	
	}
}



if(isset($_REQUEST['update']))
{

	$news_id = mysql_real_escape_string($_REQUEST['id']);
	$news_title = mysql_real_escape_string($_REQUEST['title']);
	$news_description = mysql_real_escape_string($_REQUEST['desc']);
	$news_image=mysql_real_escape_string($_FILES['nimage']['name']);
	//echo $feature_image; //
//	echo "testing"; exit;
if($news_title == "")
	{
		header("Location:user_offlinepayment.php?error");
		exit;
	}
	
	if($news_description == "")
	{
		header("Location:user_offlinepayment.php?error");
		exit;
	}
	
	if($news_image == "") 
	{
		if($_REQUEST['imagehide'] == "") 
		{
			header("Location:user_offlinepayment.php?not-a-image");
			exit;
		} 
		else 
		{
			$cate_img_small = $_REQUEST['imagehide'];
		}
		
	}
	 else
    {
		
		//echo "test hid = ".$_REQUEST['imagehide'];
		
		if($_REQUEST['imagehide'] != "")
		 {
			
			unlink("../uploads/news/original/".$_REQUEST['imagehide']);
			unlink("../uploads/news/thumb/".$_REQUEST['imagehide']);
			unlink("../uploads/news/large/".$_REQUEST['imagehide']);
			unlink("../uploads/news/mid/".$_REQUEST['imagehide']);
			
		}
		
		$img_size = filesize($_FILES['nimage']['tmp_name']);
		//echo $img_size;exit;
		if($img_size > 1048576) //1048576 = 1MB
		{
			header("Location:user_offlinepayment.php?largeimage");
			exit;
		}
		else
		{
			$split_name = explode(".",$news_image);
			//echo $split_name[1]; exit;
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			
			 include("includes/resize-class.php");
			//echo "image ok "; exit;
			//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
			$cate_img_small = "news".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/news/thumb/";
			
			$image_pathlarge = "../uploads/news/large/";
			
			$image_path_thumb = "../uploads/news/mid/";
			
			move_uploaded_file($_FILES['nimage']['tmp_name'],"../uploads/news/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("../uploads/news/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150, 100, 'exact');

			$resizeObj -> saveImage($image_path.$cate_img_small, 100);
			
			$resizeObj -> resizeImage(700, 300, 'exact');
			
			$resizeObj -> saveImage($image_pathlarge.$cate_img_small, 100);
			//very small image
			//$resizeObj = new resize($_FILES['cate_image']['tmp_name']);
			
			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(60, 60, 'exact');

			$resizeObj -> saveImage($image_path_thumb.$cate_img_small, 100);
			
			//unlink("../uploads/".$feature_image);
			
			//echo $cate_img_very_small.", ".$cate_img_small; exit;
		}
			else
			{
				header("Location:user_offlinepayment.php?not-a-image");
				exit;
			}
		}
	}

	
	$update = mysql_query("UPDATE  mlm_offlinepayment SET news_title='$news_title',news_desc='$news_description',news_image='$cate_img_small' WHERE news_id=$news_id");
	if($update) {
	
	
		header("Location:user_offlinepayment.php?editsuccess");
		
		?>
	<script>
	window.location="user_offlinepayment.php?editsuccess";
	</script>	
	<?php
	}
}

if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=mysql_query("update  mlm_offlinepayment set status='1' where news_id='$id'");

if($act)
{

header("location:user_offlinepayment.php?actsucc");

echo "<script>window.location='user_offlinepayment.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=mysql_query("update  mlm_offlinepayment set status='0' where news_id='$id'");

if($act)
{

header("location:user_offlinepayment.php?inactsucc");

echo "<script>window.location='user_offlinepayment.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=mysql_query("delete from  mlm_offlinepayment where pay_id='$id'");

if($det)
{

header("location:user_offlinepayment.php?del");

echo "<script>window.location='user_offlinepayment.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "delete from  mlm_offlinepayment where news_id='$del_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="user_offlinepayment.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "update  mlm_offlinepayment set news_status='0' where news_id='$act_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="user_offlinepayment.php?inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

//echo "update  mlm_offlinepayment set news_status='1' where news_id='$inact_id'"; exit;

$sql = "update mlm_offlinepayment set news_status='1' where news_id='$inact_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="user_offlinepayment.php?actsucc";
</script> <?php
}
 }


if(isset($_REQUEST['senmail']))
{
	
	$idd=$_REQUEST['id'];
	$user=mysql_fetch_array(mysql_query("select * from mlm_offlinepayment where pay_id='$idd'"));
	$payid=$user['payment_id'];
	$to=$user['email_id'];
	$subject='Payment id for your offline transcation';
	
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #D64B14; width:560px;'>
		<tr bgcolor='#D64B14' height='25'>
			<td><a href='$website_url'><img src=".$logourl." border='0' width='200' height='60' /></a></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						
			<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear Sir / Madam, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Offline payment has been Processed successfully, You must be use the below payment id and Email address for  Registration in ".$website_name." site.</td>
						</tr>
							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email Id ID : $to</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Payment Id : $payid</td>
						</tr>
					
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
		
		<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><a href='$website_url'>$website_url</a>
				
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#D64B14;
color: #FFFFFF;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";  
ini_set("SMTP","mail.inetmassmail.com");
$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$website_admin.'>' . "\r\n";
 $st=mail($to,$subject,$msg,$headers);
if($st)
{
	
	$up=mysql_query("update mlm_offlinepayment set status='2' where pay_id='$idd'");
	echo "<script>window.location='user_offlinepayment.php?inactsucc';</script>";
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
			height:65%;
			padding: 16px;
			border: 10px solid #006699;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	#payment
{
	cursor:not-allowed;
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
	
	function news_validate()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title').value=="")
	{
	alert("Please Enter the News Title");
	document.getElementById('title').focus();
	return false;
	
	}
	
		if(document.getElementById('desc').value=="")
	{
	alert("Please Enter the News Content");
	document.getElementById('desc').focus();
	return false;
	
	}
	
	if(document.getElementById('nimage').value=="")
	{
		alert("Please enter the the News Image");
		document.getElementById('nimage').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('nimage').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('nimage').value="";
			  document.getElementById('nimage').focus();
			  return false;
		 }
	}
	
	
	}
	
	
	</script>
	
		<script>
	
	function news_validate1()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('titlee').value=="")
	{
	alert("Please Enter the News Title");
	document.getElementById('titlee').focus();
	return false;
	
	}
	
		if(document.getElementById('descc').value=="")
	{
	alert("Please Enter the News Content");
	document.getElementById('descc').focus();
	return false;
	
	}
	
	if(document.getElementById('imgg').value=="")
	{
	if(document.getElementById('nimagee').value=="")
	{
		alert("Please enter the the News Image");
		document.getElementById('nimagee').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('nimagee').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('nimagee').value="";
			  document.getElementById('nimagee').focus();
			  return false;
		 }
	}
	}
	
	}
	
	
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
						<li class="active">Offline Transaction </li>
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
									Transaction Added Successfully !!!
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
									Transaction Updated Successfully !!!
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
									Transaction Successfully !!!
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
									Mail Send Successfully !!!
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
									Transaction blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                           <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Offline Transaction  Management
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop();" style="color:#FFFFFF;">+ ADD New User	</a></span>
								
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
											<th width="50">Sl.No</th>
											<th width="98">Email Id</th>
											<th width="200">Membership Type</th>
                                            <th width="100">Transaction Id</th>
                                            <th width="100">Payment Id</th>
                                            <th width="71" >Status</th>
											<th width="71" >Mail</th>
											<th width="71" >Action</th>
                                           
										</tr>
									</thead>
									<tbody>
									
									<?php 
									
									$news=mysql_query("select * from  mlm_offlinepayment order by pay_id desc");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from  mlm_offlinepayment"));
									
									while($row_news=mysql_fetch_array($news))
									{
									?>
									
										<tr>
									
											<td class="center">
												<label>
													<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_news['pay_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><?php echo $row_news['email_id']; ?></td>
											
											<td>
											<?php echo member($row_news['membership_id']); ?>
											</td>
											<td>
											<?php echo $row_news['transaction_id']; ?>
											</td>
                                            <td>
											<?php echo $row_news['payment_id']; ?>
											</td>
											
											 <td>
											<span class="label label-info arrowed-in-right arrowed"><?php if($row_news['status']=='1') { echo "Used";  } else if($row_news['status']=='2') { echo "Waiting"; } else { echo "Not send"; } ?></span>
											</td>
											

											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_news['status']=='0') { ?>
													
													
													<a href="user_offlinepayment.php?senmail&id=<?php echo $row_news['pay_id']; ?> " class="badge badge-success " onclick="if(confirm('Are you sure Send Payment Id to this user')) { return true; } else { return false; }">Send</a>
													<?php }
												 if(($row_news['status']=='1') || ($row_news['status']=='2'))  { ?>
													
													 
													Sent
													<?php } ?>
												
                                                </div>
										</td>
                                        <td>
												<div class="hidden-phone visible-desktop action-buttons">
												<a class="blue" href="edit_offlineuser.php?idd=<?php echo $row_news['pay_id']; ?>" >
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												  </div>
												
												<div class="hidden-phone visible-desktop action-buttons">
												

													<a class="grey" href="user_offlinepayment.php?delete=<?php echo $row_news['pay_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
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
			      null, null,null, 
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
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add New User</td>
								</tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Email ID<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="email" id="email" /></td>
								</tr>
								
								<tr>
								<td>Membership Type<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><select name="member_type">
                                <option value="">--- Select ---</option>
                                <?php $member=mysql_query("select * from mlm_membership"); 
								while($plan=mysql_fetch_array($member))
								{
								?>
                                	<option value="<?php echo $plan['id']; ?>"><?php echo $plan['membership_name']; ?></option>
                                <?php
								}
								?>
                                </select>
								</td>
								</tr>
                               
								<tr>
								<td>Amount<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="amount" id="amount" />
								</td>
								</tr>
                                 <tr>
								<td>Transaction Id<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="transaction" id="transaction" />
								</td>
								</tr>
                                <tr>
								<td>Payment Id<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="payment" id="payment" value="<?php echo substr(number_format(time()*rand(),0,'',''),0,10); ?>" readonly />
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
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit User</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								
								<tr>
								<td>Email Id<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="email" id="emailid" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Membership Type<span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><select name="member">
                                <option value="">--- Select ---</option>
                                <?php $member=mysql_query("select * from mlm_membership"); 
								while($plan=mysql_fetch_array($member))
								{
								?>
                                	<option value="<?php echo $plan['id']; ?>"><?php echo $plan['membership_name']; ?></option>
                                <?php
								}
								?>
                                </select>
								</td>
								</tr>
								
								
								<input type="hidden" name="id" id="newsid" />
								<input type="hidden" name="imagehide" id="imgg" />
								
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
	function showpop1(pid,emid,mid)
	{
		//alert(name);
		document.getElementById('light1').style.display='block';
		document.getElementById('fade1').style.display='block'; 
		document.getElementById('newsid').value=pid;
		document.getElementById('emailid').value=emid;
		document.getElementById('member').value=mid;
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
