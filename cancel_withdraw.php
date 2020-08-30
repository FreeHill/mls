<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");


if(isset($_REQUEST['delete']))
{
$delete=$_REQUEST['delete'];

$del=mysql_query("delete from mlm_withdrawrequsets where req_id='$delete'");

if($del)
{
header("location:cancel_withdraw.php?delsucc");
echo "<script>window.location='cancel_withdraw.php?delsucc';</script>";
}

}

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />
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
			position: fixed;
			top: 15%;
			left: 22%;
			width: 55%;
			height:65%;
			padding: 16px;
			border: 10px solid #DB4E11;
			border-radius:10px;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
	<script type="text/javascript">
	function showpop(uid,pid,cv,name,email)
	{
	
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block'; 
	
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	document.getElementById('usid').value=uid;
	
	
	}
	
	</script>
	
	<script type="text/javascript">
	function hidepop()
	{
	
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'; 
	}
	
	</script>

<script>
function checkamt(vallasd)
{
//alert(vallasd);

if(vallasd !=  "")
{
if((document.getElementById('minwith').value > vallasd) && (document.getElementById('minwith').value != vallasd))
{
alert("please enter the valid amount for transaction");
document.getElementById('amount').focus();
document.getElementById('amount').value="";
}

}
if((document.getElementById('balamt').value=="") || (document.getElementById('balamt').value==""))
{
alert("Your balance amount is zero, so you cannot send request");
return false;

}
}

</script>
<script>
function with_validate()
{
if((document.getElementById('balamt').value=="") || (document.getElementById('balamt').value==""))
{
alert("Your balance amount is zero, so you cannot send request");
return false;

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
					
					<?php 
					if(isset($_REQUEST['cansucc'])) {
					
					?>
					<div align="center" style="color:#006600;">Your withdrawal request has been cancelled successfully !!!</div>
					
					<?php } ?>
					
						<?php 
					if(isset($_REQUEST['delsucc'])) {
					
					?>
					<div align="center" style="color:#FF0000;">Request deleted Successfully !!!</div>
					
					<?php } ?>
					
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">CANCEL WITHDRAWAL REQUEST LIST </span></h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="6%">
											<strong>SNO</strong>										</td>
										<td width="17%" style="text-align:left;">
											<strong>SUBJECT</strong>										</td>
										<td width="25%">
											<strong>MESSAGE</strong>										</td>
										<td width="10%">
											<strong>AMOUNT</strong>										</td>
										<td width="13%">
											<strong>DATE</strong>										</td>
										<td width="14%">
											<strong>STATUS</strong>										</td>
										<td width="15%">
											<strong>ACTION</strong>
										</td>
									</tr>
									
									<?php
										$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
									
									$reqq=mysql_query("select * from mlm_withdrawrequsets where req_status='1' and req_userid='$_SESSION[userid]' LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_withdrawrequsets where req_status='1' and req_userid='$_SESSION[userid]'"));
									
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="6" align="center"> No Requsets Found</td>
										</tr>
									
									<? }
									
									$i=1;
									$creqq=mysql_num_rows($reqq);
									while($rreqq=mysql_fetch_array($reqq)) 
									{
									
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $rreqq['req_subject'];?>
										</td>
										<td>
											<?php echo $rreqq['req_message'];?>
										</td>
										<td>
											<?php echo $rreqq['req_cvamount'];?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rreqq['req_date']));?>
										</td>
										<td>
													<?php if($rreqq['req_rpstatus']=='0') { ?>
											 <span class="red" >
											 Pending
											 </span>
												
												  <?php } else {?>
											 <span class="green" >
											 Replied
											 </span>
												  
												  <?php } ?>
										</td>
										<td>
										<span>
										
							<a href="cancel_withdraw.php?delete=<?php echo $rreqq['req_id']; ?>" class="btn btn-primary" onClick="if(confirm('Are you sure to cancel this record')) { return true; } else { return false; }">DELETE</a>
										</span></td>
									</tr>
									<?php $i++;} ?>		
										<tr>
									<td colspan="5" align="center">
									</td></tr>
									
									</table>
								    
							</div>
							 <div>
            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                      
                    </div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
			
			    <div id="light"  class="white_content">
									<form name="myfor" id="myfor" action="" method="post" enctype="multipart/form-data" onSubmit="return with_validate();">
								
								<table>
								<tr>
								<td colspan="3" style="border-bottom:1px #CCCCCC solid; color:#006699; font-weight:bold; font-size:14px;">SEND REQUEST RESPONSE</td>
								</tr>
								
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Your Balance Request <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><?php
								$acc=$userdetail['accumulated_bv'];
								$cvvalld=$gen_cvvalue;
								$ball=$acc*$cvvalld;
								 echo $ball; ?></td>
								<input type="hidden" name="balamt" id="balamt" value="<?php echo $ball; ?>"/>
								</tr>
								<input type="hidden" name="minwith" id="minwith" value="<?php echo $gen_minwithdraw; ?>"/>
								<input type="hidden" name="name" id="name" value="<?php echo $profilename; ?>"/>
								<input type="hidden" name="email" id="email" value="<?php echo $userdetail['user_email']; ?>"/>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Amount <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="amount" id="amount" required="true" onBlur="checkamt(this.value);" style="height:25px;"/> <br><span style="color:#999999;">Minimum withdrawal amount Rs. <?php echo $gen_minwithdraw; ?></span>
								
								</td>
								</tr>
								
						<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Subject <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<input type="text" name="subject" id="subject" required="true" style="height:25px;"/>
								</td>
								</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
								<td>Message <span style="color:#FF0000;">*</span></td>
								<td> : &nbsp;&nbsp;</td>
								<td><!--<input type="text" name="ans" id="ans" />-->
								<textarea name="message" id="message" required="true"></textarea>
								</td>
								</tr>
								<tr>
								<td colspan="3">
								<div class="form-actions">
				<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;"> &nbsp; &nbsp; &nbsp;<input type="button" name="close" value="CLOSE" class="btn" style="font-weight:bold;" onClick="hidepop();">
									
								</div>
								</td>
								</tr>
								
								</table>
								
									</form>				
									</div>
									<div id="fade" class="black_overlay" >&nbsp;</div>
			
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>
