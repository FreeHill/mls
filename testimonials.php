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
                    <img src="img/page-title.jpg" />
                     <div class="inner-page-title fixed">
                        <h2>Testimonials</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
			<!-- banar end -->
			<hr />
			<br />
			<div class="row">
			 <?php include("includes/leftmenu.php"); ?>

                <div class="span9">
				<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -5px; margin-bottom: 7px;">Testimonials List</h4>
				<?php
				$select=mysql_query("select * from mlm_testimonial");
				while($test=mysql_fetch_array($select))
				{
				?>
                    <div class="row">
                        <div class="span3" style="width:140px;">
							<?php
							$user=mysql_fetch_array(mysql_query("select user_id,user_fname,user_image from mlm_register where user_id='$test[test_user]'"));
							if($user['user_image'])
							{ ?>
								 <img src="uploads\profile_image\thumb\<?php echo $user['user_image']; ?>"/>
						   <?php }
						   else
						   {
							?>
								<img src="images/empty_images.jpg" style="width:140px; height:150px;">
                      		<?php } ?>
                        </div>
                        <div class="span7">
                            <blockquote style="height: 153px;">
								<h4><?php echo $test['test_title']; ?></h4>
                                <p> <?php echo $test['test_comment']; ?> </p>
                                <small> <?php echo $user['user_fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $test['test_date']; ?></small>
                            </blockquote>
                        </div>
                    </div>
				<?php }	?>
		      </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>