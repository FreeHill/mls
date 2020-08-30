<?php include("config/error.php");
include("includes/head.php");
?>

<script>
function purpro(val)
{
if(val==1)
{
document.getElementById('purc').style.display="none";

}
if(val==2)
{
document.getElementById('purc').style.display="block";

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
			
            <div class="row">
                <div class="span12 page-title-container">
                    <img src="img/service-header.jpg" />
                     <div class="inner-page-title fixed">
                        <h3>Product Detail</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
				<?php include("includes/leftmenu.php"); ?>
				<?php
					$proid=$_REQUEST['pid'];
					$products=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$proid'"));
				?>

                <div class="span9">
					
                    <div class="row">
                    	<?php
						if(isset($_REQUEST['cancel']))
						{
							?><div style="color:#F00; margin:20px 230px; font-weight:bold;">Your Transcation has been Cancelled</div> <?php
						}
						
						
						if(isset($_REQUEST['err']))
						{
							?><div style="color:#F00; margin:20px 170px; font-weight:bold;">Your Request does not processed please try again..!</div> <?php
						}
						
						?>
                        <div class="span9">
							<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -5px; margin-bottom: 7px;">
								Buy the product
							</h4>
						
                            <h3>
								<?php echo ucfirst($products['pro_name']); ?>
								<span style="float:right; padding:0 10px;">
									Rs. <?=$products['pro_cost']?>/-
								</span>
							</h3>
                        </div>
                    </div>
                    <br />
					<div class="span8" style="width:680px;">
                    <div class="row" style="border:1px #CCC solid;">
							<!---------------------Description------------------------->
							<div class="span6" style="width:400px; padding: 10px 0;">
								<table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td>
											Product Cost 
										</td>
										<td>:</td>
										<td>
											Rs <?=$products['pro_cost']?> /-
										</td>
									</tr>
									<tr>
										<td>
											Stock in hand
										</td>
										<td>:</td>
										<td>
											<?=$products['pro_stock']?> Nums
										</td>
									</tr>
                                    <tr>
										<td>
											Purchase Bonus
										</td>
										<td>:</td>
										<td>
											Rs <?=$products['pro_bonus']?> /-
										</td>
									</tr>
                                    <tr>
										<td>
											Indirect Purchase Bonus
										</td>
										<td>:</td>
										<td>
											Rs <?=$products['pro_indirect_bonus']?> /-
										</td>
									</tr>
									
								</table>
							</div>
							<!---------------------Image------------------------->
							<div class="span2" style="width: 185px; padding: 10px;">
								<img src="uploads/products/logo/original/<?php echo $products['pro_logo']; ?>" width="200" height="130" />
							   <!-- <img alt="" src="img/service_detail.jpg" />-->
							</div>
                    </div>
					</div>
                    <hr />
                    <div class="row">
					<!---------------------Long Description------------------------->
                        <div class="span9">
                            <p>
                                <?php echo $products['pro_desc']; ?>
                            </p>
                        </div>
                    </div>
					
					  <form action="product_buynow.php" method="post">	
					<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px;">
						
						<div style="padding:10px; text-align:left; padding-left:20px; font-weight:bold; color:#660000;">
						Purchase bonus amount you cannot withdraw, This amount using only for product purchasing !!!
						</div>
						
						
						
							<div style="padding:10px; text-align:left; padding-left:20px;">
							<?php  
					$memvaak=mysql_fetch_array(mysql_query("select * from mlm_register where user_id='$_SESSION[userid]'"));
							?>
							
						Your have Product Purchase Bonus Amount <span style="padding-left:70px; padding-right:20px;">: </span>Rs. <?php echo $memvaak['totalpurchase_bonus'];  ?> /-
							</div>
							
							<?php 
							if( $memvaak['totalpurchase_bonus']>=$products['pro_cost']) {
							
							$asd=$memvaak['totalpurchase_bonus']-$products['pro_cost'];
							?>
							
							<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>">
							<input type="hidden" name="balamt" value="<?php echo $asd; ?>">
							
							<input type="hidden" name="type" value="Product Bonus">
							
							<input type="hidden" name="status" value="1">
							
							<div style="padding:10px; text-align:left; padding-left:20px;">
						You can use this amount to product Purchase <span style="padding-left:60px; padding-right:20px;">: </span> <input type="radio" name="pur" value="1" checked="checked" onClick="return purpro(1);"> No&nbsp;&nbsp; <input type="radio" name="pur" value="2" onClick="return purpro(2);"> Yes&nbsp;&nbsp;
							</div>
							
							<div style="padding:10px; padding-left:200px; display:none"  id="purc">
								<?php if($products['pro_stock']>0) { ?>
                            	<input type="submit" name="buynow" value="BUY NOW"  style="background-color: #4A7002;
border-radius: 5px;
border: 1px solid #74B807;
display: inline-block;
cursor: pointer;
color: #FFF;
font-size: 14px;
font-weight: bold;
padding: 4px 10px;
text-decoration: none;">
								<?php } ?>
								&nbsp;&nbsp;
								<a href="product_buynow.php?cancel" class="greenbtn">Cancel</a>
							</div>
							<?php } ?>
							
							</div></div>
							<hr>
					</form>
                    <form action="product_buynow.php" method="post">
					
					<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px;">
							<div style="padding:10px; padding-left:200px;">
						<input type="radio" name="propay" value="1" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/paypal.jpeg" style="width:100px; height:80px;">
							</div>
							<div style="padding:10px; padding-left:200px;">
						<input type="radio" name="propay" value="2" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/icici.jpeg"  style="width:100px; height:60px;">
							</div>
							<input type="hidden" name="status" value="0">
                      <input type="hidden" name="type" value="Paypal">
						<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>">
						<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px;">
							<div style="padding:10px; padding-left:200px;">
								<?php if($products['pro_stock']>0) { ?>
                            	<input type="submit" name="pay" value="PAY NOW"  style="background-color: #4A7002;
border-radius: 5px;
border: 1px solid #74B807;
display: inline-block;
cursor: pointer;
color: #FFF;
font-size: 14px;
font-weight: bold;
padding: 4px 10px;
text-decoration: none;">
								<?php } ?>
								&nbsp;&nbsp;
								<a href="product_buynow.php?cancel" class="greenbtn">Cancel</a>
							</div>
                        </div>
                    </div> 
					
					 </div>
					<hr />
                    </div>
					<hr />
					
					</form>
                </div>

            </div>
           <?php 
			
			include("includes/footer.php");
			
			?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>