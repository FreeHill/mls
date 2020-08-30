<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}


$menu3='class="active"';

if(isset($_REQUEST['submit']))
{
   
	//echo "testting";
	$event_title = mysql_real_escape_string($_REQUEST['title']);
	$event_description = mysql_real_escape_string($_REQUEST['desc']); 
	//$feature_image = $_REQUEST['feature_image'];
	$event_date=date("Y-m-d",strtotime($_REQUEST['date']));
	$event_image=mysql_real_escape_string($_FILES['eimage']['name']);
    //echo $feature_image; exit;
	if($event_image == "")
	{
		header("Location:events.php?error");
		exit;
	} 
	else 
	{
	
	$img_size = filesize($_FILES['eimage']['tmp_name']);
	//echo $img_size;exit;
			if($img_size > 2097152) //1048576 = 1MB
			{
				header("Location:events.php?largeimage");
				exit;
			}
			else
			{
				$split_name = explode(".",$event_image);
		
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			 include("includes/resize-class.php");
			//echo "image ok "; exit;
			//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
			$cate_img_small = "event".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/events/thumb/";
			
			$image_pathlarge = "../uploads/events/large/";
			
			$image_path_thumb = "../uploads/events/mid/";
			
			move_uploaded_file($_FILES['eimage']['tmp_name'],"../uploads/events/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("../uploads/events/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150, 150, 'exact');

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
			header("Location:events.php?not-a-image");
			exit;
		}
	}
	
	if($event_title == "")
	{
		header("Location:events.php?error");
		exit;
	}
	
	//echo "INSERT INTO site_event (event_title,event_description,event_image,event_date) VALUES ('$event_title','$event_description','$cate_img_small',NOW())"; exit;
	
 $insert = mysql_query("INSERT INTO mlm_events (event_title,event_desc,event_image,event_date,event_addate) VALUES ('$event_title','$event_description','$cate_img_small','$event_date',NOW())");
	
	//echo "INSERT INTO skill_features (feature_title,feature_description,feature_image,feature_date) VALUES ('$feature_title','$feature_description','$cate_img_small',NOW())"; exit;
	if($insert)
	 { 
	// echo "testing;"; exit;
	 header("Location:events.php?success"); 
	 ?>
	<script>
	window.location="events.php?success";
	</script>	
	<?php
	
	}
}
}


if(isset($_REQUEST['update']))
{

	$event_id = mysql_real_escape_string($_REQUEST['id']);
	$event_title = mysql_real_escape_string($_REQUEST['title']);
	$event_description = mysql_real_escape_string($_REQUEST['desc']);
	$event_image=mysql_real_escape_string($_FILES['eimage']['name']);
	//echo $feature_image; //
//	echo "testing"; exit;
if($event_title == "")
	{
		header("Location:events.php?error");
		exit;
	}
	
	if($event_description == "")
	{
		header("Location:events.php?error");
		exit;
	}
	
	if($event_image == "") 
	{
		if($_REQUEST['imagehide'] == "") 
		{
			header("Location:events.php?not-a-image");
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
			
			unlink("../uploads/events/original/".$_REQUEST['imagehide']);
			unlink("../uploads/events/thumb/".$_REQUEST['imagehide']);
			unlink("../uploads/events/large/".$_REQUEST['imagehide']);
			unlink("../uploads/events/mid/".$_REQUEST['imagehide']);
			
		}
		
		$img_size = filesize($_FILES['eimage']['tmp_name']);
		//echo $img_size;exit;
		if($img_size > 1048576) //1048576 = 1MB
		{
			header("Location:events.php?largeimage");
			exit;
		}
		else
		{
			$split_name = explode(".",$event_image);
			//echo $split_name[1]; exit;
			if(($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') ||($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG'))
			{
			
			 include("includes/resize-class.php");
			//echo "image ok "; exit;
			//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
			$cate_img_small = "event".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "../uploads/events/thumb/";
			$image_pathlarge = "../uploads/events/large/";
			$image_path_thumb = "../uploads/events/mid/";
			
			move_uploaded_file($_FILES['eimage']['tmp_name'],"../uploads/events/original/".$event_image);
			
			//small image
			$resizeObj = new resize("../uploads/events/original/".$event_image);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150, 150, 'exact');

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
				header("Location:events.php?not-a-image");
				exit;
			}
		}
	}

	
	$update = mysql_query("UPDATE mlm_events SET event_title='$event_title',event_desc='$event_description',event_image='$cate_img_small' WHERE event_id=$event_id");
	if($update) {
	
	
		header("Location:events.php?editsuccess");
		
		?>
	<script>
	window.location="events.php?editsuccess";
	</script>	
	<?php
	}
}

if(isset($_REQUEST['act']))
{

$id=$_REQUEST['act'];

$act=mysql_query("update mlm_events set event_status='1' where event_id='$id'");

if($act)
{

header("location:events.php?actsucc");

echo "<script>window.location='events.php?actsucc';</script>";

}

}

if(isset($_REQUEST['inact']))
{

$id=$_REQUEST['inact'];

$act=mysql_query("update mlm_events set event_status='0' where event_id='$id'");

if($act)
{

header("location:events.php?inactsucc");

echo "<script>window.location='events.php?inactsucc';</script>";

}

}

if(isset($_REQUEST['delete']))
{

$id=$_REQUEST['delete'];

$det=mysql_query("delete from mlm_events where event_id='$id'");

if($det)
{

header("location:events.php?del");

echo "<script>window.location='events.php?del';</script>";

}

}

if(isset($_POST['mul_delete']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "delete from mlm_events where event_id='$del_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="events.php?del";
</script> <?php
}
 }

if(isset($_POST['mul_active']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$act_id = $checkbox[$i];

//echo "DELETE FROM mail WHERE S_no='$del_id'"; exit;

$sql = "update mlm_events set event_status='0' where event_id='$act_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="events.php?inactsucc";
</script> <?php
}
 }


if(isset($_POST['mul_inactive']))
{
    $checkbox = $_POST['chkval'];

for($i=0;$i<count($checkbox);$i++){

$inact_id = $checkbox[$i];

//echo "update mlm_news set news_status='1' where news_id='$inact_id'"; exit;

$sql = "update mlm_events set event_status='1' where event_id='$inact_id'";
$result = mysql_query($sql);
}

if($result){?> <script>
window.location="events.php?actsucc";
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
			top: 10%;
			left: 20%;
			width: 55%;
			height:80%;
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
	
	function event_validate()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('title').value=="")
	{
	alert("Please Enter the Events Title");
	document.getElementById('title').focus();
	return false;
	
	}
	
		if(document.getElementById('desc').value=="")
	{
	alert("Please Enter the Events Content");
	document.getElementById('desc').focus();
	return false;
	
	}
	
		if(document.getElementById('date').value=="")
	{
	alert("Please Choose the Events date");
	document.getElementById('date').focus();
	return false;
	
	}
	
	if(document.getElementById('eimage').value=="")
	{
		alert("Please enter the the Events Image");
		document.getElementById('eimage').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('eimage').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('eimage').value="";
			  document.getElementById('eimage').focus();
			  return false;
		 }
	}
	
	
	}
	
	
	</script>
	
		<script>
	
	function event_validate1()
	{
	tinyMCE.triggerSave();
	if(document.getElementById('titlee').value=="")
	{
	alert("Please Enter the Events Title");
	document.getElementById('titlee').focus();
	return false;
	
	}
	
		if(document.getElementById('descc').value=="")
	{
	alert("Please Enter the Events Content");
	document.getElementById('descc').focus();
	return false;
	
	}
	
		if(document.getElementById('datee').value=="")
	{
	alert("Please Choose the Events date");
	document.getElementById('datee').focus();
	return false;
	
	}
	
	
	if(document.getElementById('imgg').value=="")
	{
	if(document.getElementById('eimagee').value=="")
	{
		alert("Please enter the the Events Image");
		document.getElementById('eimagee').focus();
		return false;
	}
	else
	{
		var ss=document.getElementById('eimagee').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('eimagee').value="";
			  document.getElementById('eimagee').focus();
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
						<li class="active">Events </li>
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
									Events Added Successfully !!!
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
									Events Updated Successfully !!!
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
									Events Deleted Successfully !!!
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
									Events Unblocked Successfully !!!
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
									Events blocked Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
						   
                         <form action="" method="post">
							<div class="row-fluid">
								
								<div class="table-header">
								Events Management
								
								<span style="float:right; padding-right:5px;"><a href="#" onclick="showpop();" style="color:#FFFFFF;">+ ADD Events</a></span>
								
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
											
											<th width="98">Image</th>
											
												<th width="290">Events</th>
											
										
											<th width="51" class="hidden-480">Status</th>
                                            <th width="15" class="sorting_disabled" style="visibility:hidden"></th>
											<th width="15" class="sorting_disabled" style="visibility:hidden"></th>
											
									
										</tr>
									</thead>

									<tbody>
									
									<?php 
									
									$event=mysql_query("select * from mlm_events order by event_id desc");
									$i=1;
									$num=mysql_num_rows(mysql_query("select * from mlm_events"));
									
									while($row_event=mysql_fetch_array($event))
									{
									?>
									
										<tr>
									
											<td class="center">
												<label>
													<input type="checkbox" id="chkval[]" name="chkval[]" value="<?php echo $row_event['event_id']; ?>"  />
													<span class="lbl"></span>
												</label>
											</td>

											<td>
												<?php echo $i; ?>
											</td>
											<td><img src="../uploads/events/mid/<?php echo $row_event['event_image']; ?>" width="50" height="50" style="vertical-align:middle;"/></td>
											
											<td>
											<span style="font-weight:bold; color:#003366;"><?php echo $row_event['event_title']; ?></span><br />
											<span><?php echo $row_event['event_desc']; ?></span><br />
											<span style="color:#003366; float:right;"><?php echo date("d-m-Y",strtotime($row_event['event_date'])); ?></span>
											</td>
										

											<td class="td-actions" align="center">
												<div class="hidden-phone visible-desktop action-buttons">
													
													<?php if($row_event['event_status']=='1') { ?>
													
													<a class="red" href="events.php?inact=<?php echo $row_event['event_id'];?>" onclick="if(confirm('Are you sure to activate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to activate"></i>
													</a>
													
													<?php } if($row_event['event_status']=='0') { ?>
												
												<a class="green" href="events.php?act=<?php echo $row_event['event_id']; ?>" onclick="if(confirm('Are you sure to deactivate this record')) { return true; } else { return false; }">
														<i class="icon-certificate bigger-130" title="click to deactivate"></i>
												  </a>
												  
												  <?php } ?>
												  
                                                </div>
										  </td>
												
												<td>
												<div class="hidden-phone visible-desktop action-buttons">
												<a class="blue" href="#" onclick="showpop1('<?php echo $row_event['event_id']; ?>','<?php echo $row_event['event_title']; ?>','<?php echo $row_event['event_desc']; ?>','<?php echo $row_event['event_image']; ?>','<?php echo $row_event['event_date']; ?>');">
														<i class="icon-pencil bigger-130" title="click to edit"></i>
												  </a>
												  </div>
												</td>
												
												<td>
												<div class="hidden-phone visible-desktop action-buttons">
												

													<a class="grey" href="events.php?delete=<?php echo $row_event['event_id'];?>" onclick="if(confirm('Are you sure to delete this record')) { return true; } else { return false; }">
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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return event_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Add Events</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events  Title <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="title" id="title" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Content <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<textarea name="desc" id="desc" style="width:400px; height:200px;"></textarea>
								</td>
								</tr>
								

								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Date <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
				
				                  <input type="text" name="date" id="date" class="tcal"/>
				
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Image <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="eimage" id="eimage" /><br />
								<span>Upload jpg,jpeg,gif,png images only, maximum size 2MB</span>
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
						
						
						
	<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 
 		

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
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return event_validate1();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">Edit Events</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								
								<tr>
								<td>Events  Title <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><input type="text" name="title" id="titlee" /></td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Content <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<textarea name="desc" id="descc" style="width:400px; height:200px;"></textarea>
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Date <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="date" class="tcal" id="datee"/>
								</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Current Image </td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<img id="vimgg" />
								</td>
								</tr>
								
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Events Image <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="file" name="eimage" id="eimagee" /><br />
								<span>Upload jpg,jpeg,gif,png images only, maximum size 2MB</span>
								</td>
								</tr>
								
								<input type="hidden" name="id" id="eventid" />
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
	function showpop1(val,tit,des,nimg,dat)
	{
	//alert(name);
	document.getElementById('light1').style.display='block';
	document.getElementById('fade1').style.display='block'; 
	document.getElementById('eventid').value=val;
	document.getElementById('titlee').value=tit;
	document.getElementById('descc').value=tinyMCE.activeEditor.setContent(des);
	document.getElementById('imgg').value=nimg;
	document.getElementById('vimgg').src="../uploads/events/mid/"+nimg;
	document.getElementById('datee').value=dat;
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
