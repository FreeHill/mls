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
				$event_detail=mysql_fetch_array(mysql_query("select * from mlm_events where event_id='$_REQUEST[eventid]'"));
				
				 ?>

                <div class="span9">

                    <div class="row">
                        <div class="span9">
                            <h2>Event Detail</h2>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="span9">
                             <img src="uploads/events/large/<?php echo $event_detail['event_image']; ?>"  />
                        </div>

                    </div>
                    <hr />
               
                    <div class="row">
                        <div class="span9">
                            <h3><?php echo $event_detail['event_title']; ?> <span style="float:right; "><?php echo date("d-m-Y",strtotime($event_detail['event_date'])); ?></span></h3>
                            <p><?php echo $event_detail['event_desc']; ?></p>

                            
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