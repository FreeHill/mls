<?php 
include("config/error.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{

$pimage=mysql_real_escape_string($_FILES['pimage']['name']);
    //echo $feature_image; exit;
	if($pimage == "")
	{
		header("Location:photo.php?error");
		exit;
	} 
	else 
	{
	
	$img_size = filesize($_FILES['pimage']['tmp_name']);
	//echo $img_size;exit;
			if($img_size > 2097152) //1048576 = 1MB
			{
				header("Location:photo.php?largeimage");
				exit;
			}
			else
			{
				$split_name = explode(".",$pimage);
				$extension=strtolower($split_name[sizeof($split_name)-1]);
		
			if(($extension == 'jpg') || ($extension == 'jpeg') || ($extension == 'gif') || ($extension == 'png'))
			{
			 include("includes/resize-class.php");
			//echo "image ok "; exit;
			//$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
			$cate_img_small = "pro".date("dmY")."-".rand("100","999").".".$split_name[1];
			$image_path = "uploads/profile_image/thumb/";
			
			$image_path_thumb = "uploads/profile_image/mid/";
			
			move_uploaded_file($_FILES['pimage']['tmp_name'],"uploads/profile_image/original/".$cate_img_small);
			
			//small image
			$resizeObj = new resize("uploads/profile_image/original/".$cate_img_small);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
			$resizeObj -> resizeImage(150, 150, 'exact');

			$resizeObj -> saveImage($image_path.$cate_img_small, 100);
			

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
			header("Location:photo.php?not-a-image");
			exit;
		}
	}

$qry=mysql_query("update mlm_register set user_image='$cate_img_small' where user_id='$_SESSION[userid]'");

if($qry)
{
header("location:photo.php?succ");
echo "<script>window.location='photo.php?succ';</script>";
}

}
}

include("includes/head.php");

?>
<script language="javascript">
function changephoto()
{
	
	if(document.getElementById('pimage').value != "") // ----- check current password not null -----
	{
	
		var ss=document.getElementById('pimage').value;
		var index=ss.lastIndexOf(".");				
		var sstring=ss.substring(index+1);
		var ssivanew=sstring.toLowerCase();
		if(ssivanew!="jpg" && ssivanew!="png" && ssivanew!="jpeg" && ssivanew!="gif" && ssivanew!="JPG" && ssivanew!="PNG" && ssivanew!="JPEG" && ssivanew!="GIF")
		{
			  alert("Please upload .jpg , .png , .jpeg , .gif files only");
			  document.getElementById('pimage').value="";
			  document.getElementById('pimage').focus();
			  return false;
		 }
	}

}
</script>

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
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Upload photo</h4>
							<form action="" method="post" onClick="return changephoto();" enctype="multipart/form-data">
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php if(isset($_REQUEST['succ'])) { ?>
									<tr>
									<td colspan="3" align="center" style="color:#006633; font-weight:bold;">
									Photo uploaded Successfully !!!
									</td>
									
									</tr>
									<?php } ?>
									<tr>
										<td width="40%" align="right">
											<strong>Current Image</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
										<img src="<?=$profileimages?>" width="100" height="100" />
										</td>
									</tr>
									
									<tr>
										<td align="right">
											<strong>Upload Profile Image </strong>
										</td>
										<td align="center">:</td>
										<td>
											<input type="file" name="pimage" id="pimage" />
										</td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<button type="submit" name="submit" class="greenbtn">SAVE</button>
										</td>
									</tr>
								</table>
								</form>
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