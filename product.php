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
			
			<!-- banar -->
			<div class="row">
                <div class="span12 page-title-container">
                    <img src="img/service-header.jpg" />
                     <div class="inner-page-title fixed">
                        <h2>Product</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
			<!-- banar end -->
			<hr />
			
			<div class="row">
                <?php include("includes/leftmenu.php"); ?>
                <div class="span9">

                    <div class="row" style="margin-left:-20px;"><h3 style="margin-top:10px; margin-left:30px;">Latest Product us</h3>
                        <div class="span9">
							<ul class="thumbnails">
								<!-- start categories -->
								<?php
								$product=mysql_query("select * from mlm_products");
								$i=1;
								while($result=mysql_fetch_array($product))
								{
								?>
								<li>
									<div class="service-box"> 
										<div class="caption">
											<a href="service_detail.php?pid=<?php echo $result['pro_id'];?>">
												<h4 class="price"><?php echo ucfirst($result['pro_name']);?></h4>
											</a>
											<div class="content">
												<?php 
												echo substr($result['pro_desc'],0,150); 
												if(strlen($result['pro_desc'])>150)
												{
												echo "...";
												}
												?>
												<div class="read" >
													<a href="service_detail.php?pid=<?php echo $result['pro_id'];?>" style="text-decoration:none;" >View More</a>
													<br>
												</div>
											</div>
										</div>
									<a href="service_detail.php?pid=<?php echo $result['pro_id'];?>" style="position:relative;">
										<img src="uploads/products/logo/thumb/<?php echo $result['pro_logo']; ?>" width="210" height="100" style="border:1px #CCC solid;" />
										<div class="corner">
											<span>
												Rs&nbsp;<?php echo $result['pro_cost']; ?>/-
											</span>
										</div>
									</a>
									</div>
								</li>  
								<?php 
								if($i%3=='0')
								{
								?>
								<div style="clear:both;"></div>
								<?php 	
								}
								?>
								<?php
								$i++;
								}
								?>		
							</ul>      
                        </div><!-- end categories -->
                    </div>


                </div>
				<br class="clear" />
            </div>
			
			<?php include("includes/footer.php"); ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>