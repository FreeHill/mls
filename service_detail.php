<?php include("config/error.php");
include("includes/head.php");
?>
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
                  <?php include("includes/leftmenu.php"); 
							$proid=$_REQUEST['pid'];
							$products=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$proid'"));

						?>
                <div class="span9">

                    <div class="row">
                        <div class="span9">
							<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -5px; margin-bottom: 7px;">
								<?php echo ucfirst($products['pro_name']); ?>
								<span style="">
									( Rs. <?=$products['pro_cost']?>/- )
								</span>
							</h4>
						
                           
                        </div>
                    </div>
                    
					<div class="span8" style="width:680px;">
                    <div class="row" style="border:1px #CCC solid;">
                   <!-- <h3>
								<?php echo ucfirst($products['pro_name']); ?>
								<span style="">
									( Rs. <?=$products['pro_cost']?>/- )
								</span>
							</h3>
                            <hr>--> <br>
							<!---------------------Description------------------------->
							<div class="span3" style="text-align:justify;">
                             <h4>Product Details</h4>
							<p>
									<?php echo $products['pro_desc']; ?>
							 </p>
							   
							</div>
							<!---------------------Image------------------------->
							<div class="span3" style="width:430px;">
                              
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1" data-toggle="tab">Product Image</a></li>
                                    <li><a href="#2" data-toggle="tab">Product Video</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="1">
                                        <div align="center">
                                           <img src="uploads/products/logo/original/<?php echo $products['pro_logo']; ?>" width="270"  />
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="2">
									<?php
										 require 'youtube.inc.php';
										 $youtube = new youtube;
										
										 $youtube->get(1,$products['pro_url']);
										 echo $youtube->embed_html(); 
									?> 
                                    </div>
                                </div>
                            </div>
                            
                           
                        
                    </div>
                     <div class="span8" style="text-align:justify;">
                     <div style="color:#933;">
                               <b>Purchase Bonus : Rs <?php echo $products['pro_bonus']; ?> /-
                               <br>
                              Indirect Purchase Bonus : Rs <?php echo $products['pro_indirect_bonus']; ?> /- </b>
                               
                               </div>
                            <p>
                                <?php echo $products['pro_longdesc']; ?>
                            </p>
                        </div>
					</div>
                   
                    <div class="row">
					<!---------------------Long Description------------------------->
                       <!-- <div class="span9">
                            <p>
                                <?php echo $products['pro_longdesc']; ?>
                            </p>
                        </div>-->
                        
                         <div class="span8">
                            <p>
								<h4>Features of <?php echo ucfirst($products['pro_name']); ?> </h4>
                                  <hr />
                               	<?php echo $products['pro_features']; ?>
                            </p>

                        </div>
                    </div>
					
                    
                    
                    
					<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px; width:97%;">
							<div style="padding: 10px; text-align:center;">
							<?php
							//echo $_SESSION['profileid']; exit;
							if(isset($_SESSION['profileid'])) { 
							 ?>
							
                            	<a href="product_buy.php?pid=<?=$_REQUEST['pid']?>" class="greenbtn">BUY NOW</a>
								<?php  } else { ?>
				<a href="product_buynow.php?pid=<?=$_REQUEST['pid']?>" class="greenbtn">Login to Buy this product</a>
								<?php  } ?>
								
							</div>
                        </div>
                    </div>
					<hr />
                    <div class="row">
                       <!-- <div class="span8">
                            <p>
								<h4>Features of <?php echo ucfirst($products['pro_name']); ?> </h4>
                               	<?php echo $products['pro_features']; ?>
                            </p>

                        </div>-->
						<!---------------------Tab Menu------------------------->
                        <!--<div class="span6">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1" data-toggle="tab">Why us?</a></li>
                                    <li><a href="#2" data-toggle="tab">Related Product</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="1">
                                        <p>
                                            Nam eu tortor eget nunc blandit rutrum. Praesent hendrerit ante sed nulla molestie gravida. Vestibulum ante ipsum primis in faucibus orci luctus.
                                        </p>
                                    </div>

                                    <div class="tab-pane" id="2">
                                        <ul class="thumbnails related_products" style="overflow:-moz-hidden-unscrollable;">
										<?php
											$nam=$products['pro_name']; 
											$related=mysql_query("select * from mlm_products where pro_name like '%$nam%' and pro_id !='$proid' order by rand() limit 2");
									
									
											while($search=mysql_fetch_array($related))
											{
										?>	
                                            <li class="span3">
                                                <div class="service-box" style="height:200px; width:180px;">
                                                    <div class="caption">
                                                        <a href="service_detail.html"><h4><?php echo ucfirst($search['pro_name']); ?> </h4></a>
                                                        <p>
															
															<?php 
																echo substr($search['pro_desc'],0,70); 
																if(strlen($search['pro_desc'])>70)
																{
																	echo "......";
																}
															
															?>
                                                            
                                                        </p>
                                                    </div>
                                                    <a href="service_detail.php?pid=<?php echo $search['pro_id']; ?>"><img src="uploads/products/logo/thumb/<?php echo $search['pro_logo']; ?>" style="width:100px; height:80px; padding:2px 40px;"/></a>

                                                </div>
                                            </li>   
											<?php
												}
											?>    
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>-->
                    </div>
				    </div>
                   </div>           



            </div>
           <?php include("includes/footer.php"); ?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>