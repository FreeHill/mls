<?php include("config/error.php");

include("generalfunc.php");

include("paycalculation.php");

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

			

			<!-- sliding banar -->

			<div class="row">



                <div class="span12">



                    <div id="myCarousel" class="carousel slide">

                        <div class="carousel-inner">

                            <div class="item active">

                                <img alt="" src="img/1.jpg" />

                                <div class="carousel-caption">

                                    <!--h4>First Thumbnail label</h4>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,

                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                                        Ut enim ad minim veniam, quis nostrud. </p-->

                                </div>

                            </div>

                            <div class="item">

                                <img alt="" src="img/2.jpg" />

                                <!--div class="carousel-caption">

                                    <h4>Second Thumbnail label</h4>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,

                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                                        Ut enim ad minim veniam, quis nostrud. </p>

                                </div-->

                            </div>



                            <div class="item">

                                <img alt="" src="img/3.jpg" />

                                <!--div class="carousel-caption">

                                    <h4>Third Thumbnail label</h4>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,

                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

                                        Ut enim ad minim veniam, quis nostrud. </p>

                                </div-->

                            </div>

                        </div>



                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>

                        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>                    </div>

                    <hr />

                </div>

            </div>

			<div class="row">

				<div style="align:center;margin-left:25px">

				  <div style="float:left;margin-left:10px;"><a href="register.php"><img width="300px" height="120px" src="img/join.jpg"></a></div>

					<div style="float:left;margin-left:10px;"><a href="contact.php"><img width="300px" src="img/opportunity.jpg"></a></div>

					<div style="float:left;margin-left:10px;"><a href="#"><img width="300px" src="img/products.jpg"></a></div>

			   </div>



            </div>

			<div class="row">&nbsp;</div>

			<br class="clear">

			<!-- sliding banar end -->

			

			<!-- News marquee -->

			<div class="row">

				<div class="navbar-inner span12" style="width: 900px;">

					<h4 style="color:#fff; line-height:40px;"> Recent News <a href="news.php" style="float:right;" id="whithelink">View all</a></h4>

				</div>

				<div class="span12" style="height:75px;">

					<marquee onMouseOver="this.scrollAmount=0" onMouseOut="this.scrollAmount=2" scrollamount="2" behavior="scroll" direction="up" style="width: 99.6%; height:100%; border:2px #DDD solid; border-radius:3px;">

						<table cellpadding="7" cellspacing="0" border="0">

							<?php 

								$news=mysql_query("select * from mlm_news where news_status='0' order by news_id desc ");

					$nom_rows=mysql_num_rows(mysql_query("select * from mlm_news where news_status='0'"));

					$countnews=1;

					while($res=mysql_fetch_array($news))

					{?>

							<tr>

								<td width="10%" style="vertical-align: top;"><!-- Codes by BloggerTipsSEOTricks.com <br />-->

									 <a href="news_detail.php?newid=<?php echo $res['news_id']; ?>"><img src="uploads/news/mid/<?php echo $res['news_image']; ?>"  /></a>                            </td>

								<td width="80%">

									<?php 

								echo substr($res['news_desc'],0,250);

								if(strlen($res['news_desc'])>250)

								{

									echo "...";

								}

								

							 ?>

                                				</td>

								<td width="10%">

									<span><?php echo date("d-m-Y",strtotime($res['news_date'])); ?></span>

								</td>

							</tr>

							<?php } ?>

						</table>

					</marquee>

					<hr />

				</div>

			</div>

			<!-- News marquee end -->

			

			<div class="row">&nbsp;</div>

			<br class="clear" />

			

			<div class="row">

                <?php include("includes/leftmenu.php"); ?>

                <div class="span9">

                    <div class="row">

                        <div class="span9">

							<div class="banner">

								<h3 style="margin-top:-50px;"><?php echo $website_name; ?></h3>

								<p>

								<?php 

						         $welcome=mysql_fetch_array(mysql_query("select * from mlm_cms where cms_id='1'"));		

								echo $welcome['cms_welcome'];

								?></p>
								<br><br>
								<div style="text-align:center">
								<h3>FORCED MATRIX</h3>
								<img src="<?php echo $website_url; ?>/uploads/logo/Matrix-MLM-Software_0.jpg">
								</div>
								<!--h3>What We Do</h3>

								<p>

								<?php 

						        // echo $welcome['cms_whatwedo'];

								?>&nbsp;<a href="about.php">more detail</a>

								</p-->

							</div>

                        </div>

                    </div>

                    <br />

                </div>

				<br class="clear" />

                <div class="span12">

					<hr />

					<h3 style="border:1px #DDD solid; padding:3px 3px 3px 23px;">Latest Product</h3>

					<a href="javascript:void(0);" style="float:left;" onClick="changeMarquee('left')">

						<img src="img/right.png" style="width: 25px; height: 99px;">

					</a>

					<div class="banner2">

						<ul class="slide">

						<?php 

						$product=mysql_query("select * from mlm_products order by pro_id desc limit 10");

						while($result=mysql_fetch_array($product))

						{

						?>

							<li>

								<div class="bottomslide">

									<img src="uploads/products/logo/thumb/<?php echo $result['pro_logo']; ?>"/>

									<span>

										<h5><?php echo $result['pro_name']; ?></h5>

										<p>	<?php 

								echo substr($result['pro_desc'],0,30);

								if(strlen($result['pro_desc'])>30)

								{

									echo "...";

								}

								

							 ?></p>

										<a href="service_detail.php?pid=<?php echo $result['pro_id']; ?>" class="greenbtn">View</a>

									</span>

								</div>

							</li>

						<?php } ?>

						</ul>

					</div>

					<a href="javascript:void(0);" style="float:left;" onClick="changeMarquee('right')">

						<img src="img/left.png" style="width: 25px; height: 99px;">

					</a>

                </div>

            </div>

			

			<?php include("includes/footer.php"); ?>

			</div>

			<script src="js/jquery.js"></script>

        <script src="js/bootstrap.js"></script>

        <script type="text/javascript">

            $(document).ready(function(){

                $('.carousel').carousel({

                    interval: 5000

                })

            });

        </script>

		<script type="text/javascript">

		//Plugin start

		(function($)

		{

			var methods = 

			{

				init : function( options ) 

				{

				return this.each(function()

				{

				var _this=$(this);

				_this.data('marquee',options);

				var _li=$('>li',_this);

				

				_this.wrap('<div class="slide_container"></div>')

				.height(_this.height())

				.hover(function(){if($(this).data('marquee').stop){$(this).stop(true,false);}},

				function(){if($(this).data('marquee').stop){$(this).marquee('slide');}})

				.parent()

				.css({position:'relative',overflow:'hidden','height':$('>li',_this).height()})

				.find('>ul')

				.css({width:screen.width*2,position:'absolute'});

				

				for(var i=0;i<Math.ceil((screen.width*3)/_this.width());++i)

				{

				_this.append(_li.clone());

				} 

				

				_this.marquee('slide');});

				},

				

				slide:function()

				{

				var $this=this;

				$this.animate({'left':$('>li',$this).width()*-1},

				$this.data('marquee').duration,

				'swing',

				function()

				{

				$this.css('left',0).append($('>li:first',$this));

				$this.delay($this.data('marquee').delay).marquee('slide');

				

				}

				);

				

				}

			};

			

			$.fn.marquee = function(m) 

			{

				var settings={

				'delay':2000,

				'duration':900,

				'stop':true

				};

				

				if(typeof m === 'object' || ! m)

				{

				if(m){ 

				$.extend( settings, m );

				}

				

				return methods.init.apply( this, [settings] );

				}

				else

				{

				return methods[m].apply( this);

				}

			};

			}

			)( jQuery );

			

			//Plugin end

			

			//call

			$(document).ready(

			function(){$('.slide').marquee({delay:9000});}

		);

		

		</script>

		

	</body>

</html>

