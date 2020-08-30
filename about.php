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
                        <h2>About</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
            <hr />
			<!-- banar end -->
			
			<div class="row">
                 <?php include("includes/leftmenu.php"); ?>
                    <div class="span8 single">
                       <?php
					   $about=mysql_fetch_array(mysql_query("select cms_aboutus from mlm_cms"));
					   echo $about['cms_aboutus'];
					   ?>
                    </div>
                
            </div>
			
			<?php include("includes/footer.php"); ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        
	</body>
</html>