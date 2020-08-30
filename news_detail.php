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
               

                    <!-- start sidebar -->

                    <?php include("includes/leftmenu.php"); ?>
                    <!-- end sidebar -->

                <?php
				$news_detail=mysql_fetch_array(mysql_query("select * from mlm_news where news_id='$_REQUEST[newid]'"));
				
				 ?>

                <div class="span9">

                    <div class="row">
                        <div class="span9">
                            <h2>News Detail</h2>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="span9">
                             <img src="uploads/news/large/<?php echo $news_detail['news_image']; ?>"  />
                        </div>

                    </div>
                    <hr />
               
                    <div class="row">
                        <div class="span9">
                            <h3><?php echo $news_detail['news_title']; ?> <span style="float:right; "><?php echo date("d-m-Y",strtotime($news_detail['news_date'])); ?></span></h3>
                            <p><?php echo $news_detail['news_desc']; ?></p>

                            
                        </div>

                    </div>

                </div>
            </div>
			<div style="margin-left: -20px; width: 952px;">
           <?php 
			
			include("includes/footer.php");
			
			?>
			</div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>