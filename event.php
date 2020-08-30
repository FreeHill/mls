<?php include("config/error.php");
include("includes/head.php");
include("includes/function.php");
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .records {
            width: 510px;
            margin: 5px;
            padding:2px 5px;
            border:1px solid #B6B6B6;
        }
        
        .record {
            color: #474747;
            margin: 5px 0;
            padding: 3px 5px;
        	background:#E6E6E6;  
            border: 1px solid #B6B6B6;
            cursor: pointer;
            letter-spacing: 2px;
        }
        .record:hover {
            background:#D3D2D2;
        }
        
        
        .round {
        	-moz-border-radius:8px;
        	-khtml-border-radius: 8px;
        	-webkit-border-radius: 8px;
        	border-radius:8px;    
        }    
        
        p.createdBy{
            padding:5px;
            width: 510px;
        	font-size:15px;
        	text-align:center;
        }
        p.createdBy a {color: #666666;text-decoration: none;}        
    </style>    
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
                    <img src="img/portfolio-header.jpg" />
                     <div class="inner-page-title fixed">
                        <h2>Portfolios</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
			<!-- banar end -->
			<hr />
			
			<div class="row">
                <?php include("includes/leftmenu.php"); ?>

                <div class="span9">
				<?php
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 5;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
				
					$news=mysql_query("select * from mlm_events where event_status='0' order by event_id desc LIMIT {$startpoint} , {$limit}");
					$nom_rows=mysql_num_rows(mysql_query("select * from mlm_events where event_status='0'"));
					while($res=mysql_fetch_array($news))
					{
				?>
                    <div class="row">
                        <div class="span6" style="width:170px;">
                           <img src="uploads/events/thumb/<?php echo $res['event_image']; ?>"  />

                        </div>
                        <div class="span3" style="width:450px;">
                            <a href="event_detail.php?eventid=<?php echo $res['event_id']; ?>"><h4><?php echo $res['event_title']; ?></h4></a>
                            <p>
								<?php 
								echo substr($res['event_desc'],0,250);
								if(strlen($res['event_desc'])>250)
								{
									echo "...";
								}
								
							 ?>
                                
                            </p>
                            <br /><span><?php echo date("d-m-Y",strtotime($res['event_date'])); ?></span>
							<?php 
							if(strlen($res['event_desc'])>250)
								{ ?>
                           <span style="float:right;"> <a href="event_detail.php?eventid=<?php echo $res['event_id']; ?>">read more</a></span>
						   <?php } ?>
                        </div>	 
                    </div>
                    <hr />
					<?php
					}
					?>			

                   
                    <div>
            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                      
                    </div>
                </div>

            </div>
			
			<?php include("includes/footer.php"); ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>