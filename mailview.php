<?php 
include("config/error.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['submit']))
{
$email=$_REQUEST['email'];
$user_type=$_REQUEST['type'];

$user_pid=$_REQUEST['pfid'];
$sub=$_REQUEST['subject'];
$msgg=$_REQUEST['messaggge'];

$fwdid=$_REQUEST['fwwdd'];

$toqry=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$user_pid'"));

$qry=mysql_query("insert into mlm_outbox set outbox_userid='$_SESSION[userid]',outbox_profileid='$_SESSION[profileid]', 	outbox_toupid='$toqry[user_id]',outbox_toprofileid='$user_pid',outbox_usertype='$user_type',outbox_fromemail='$email',outbox_toemail='$toqry[user_email]',outbox_subject='$sub',outbox_message='$msgg', outbox_date=NOW(),outbox_fwid='$fwdid',outbox_fwdstatus='1'");

if($qry)
{
header("location:forwardmail.php?succ");
echo "<script>window.location='forwardmail.php?succ';</script>";
}

}


include("includes/head.php");

if(isset($_REQUEST['usrviewed']))
{
mysql_query("update mlm_outbox set outbox_readstatus='1' where outbox_id='$_REQUEST[msgview]'");
}
$msgview=mysql_fetch_array(mysql_query("select * from mlm_outbox where outbox_id='$_REQUEST[msgview]'"));
?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft|,fullscreen,image,cleanup,help,code,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<script>
function typval(val)
{
if(val=="2")
{
document.getElementById('pval').style.display='block';
}
else
{
document.getElementById('pval').style.display='none';
}

}


</script>
<script>
function composseval()
{
if(document.getElementById('pfid').value!="")
{

if(document.getElementById('subject').value!="")
{

//alert(document.getElementById('message').value);
tinyMCE.triggerSave();
if(document.getElementById('messaggge').value=="")
{
alert("please enter the message");
document.getElementById('messaggge').focus();
return false;
}

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
                <?php include("includes/mailmenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
                           <h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;"> Mail View</h4>
									<table>
									<tr>
										<td align="right">
											<strong>Subject</strong>
										</td>
										<td align="center">:</td>
										<td>
								<?php echo $msgview['outbox_subject']; ?>
										</td>
									</tr>
									<tr>
										<td align="right">
											<strong>Message</strong>
										</td>
										<td align="center">:</td>
										<td>&nbsp;
								
										</td>
									</tr>
									
                                    <tr>
                                    <td colspan="3" style="text-indent:100px;"><?php echo $msgview['outbox_message']; ?></td>
                                    
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