<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu4='class="active"';

$detail=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$_REQUEST[pid]'"));

?>
<style>
.label.arrowed-in:before
{

padding:10px;
}
.label.arrowed-in-right:after
{
padding:10px;
}

</style>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php include("includes/sidebar.php"); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="dashboard.php">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>

						<li>
							<a href="products.php">Products</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">View Product Details</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
						VIEW PRODUCT DETAIL
						
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
					
					     <div class="control-group">
						
							<label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">PRODUCT INFORMATION </label>

						  </div>
					
					<div class="span12">
							<!--PAGE CONTENT BEGINS-->

								<div class="control-group">
									<div style="float:left; font-weight:bold; width:150px;">Product Name</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_name']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								</div>
								<div style="position:absolute; margin-left:40%; margin-top:-20px; border:solid 3px #CCCCCC;">
                                	<a onClick="window.open('product_video.php?pro_url=<?php echo $detail['pro_url']; ?>', 'windowname1', 'scrollbars,resizable,width=480, height=287'); return false;" style="cursor:pointer;"><img src="../uploads/products/logo/thumb/<?php echo $detail['pro_logo']; ?>" style="vertical-align:middle; width:200px; height:170px;" 	/> </a><br>
                                    <div style="background-color:#4383B1; color:#FFF; text-align:center; font-weight:bold;border-top:solid 3px #CCCCCC; word-wrap:break-word;"><?php echo $detail['pro_name']; ?></div>
                                </div>
								<div class="control-group">
								<div style="float:left; font-weight:bold; width:150px;" >Product Cost</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_cost']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								
								</div>
                                
								<div class="control-group">
								<div style="float:left; font-weight:bold; width:150px;" >Product Quantity</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_qnty']; echo $detail['pro_qnty_type']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								
								</div>


								
									<div class="control-group">
									
									<div style="float:left; font-weight:bold; width:150px;" >Purchase Bonus</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_bonus']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								
								</div>
									<div class="control-group">
									
									<div style="float:left; font-weight:bold; width:150px;" >Indirect Purchase Bonus</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_indirect_bonus']; ?></div>
									<div style="clear:both;">&nbsp;</div>
								
								</div>
								

							<div class="control-group">
							<div style="float:left; font-weight:bold; width:150px;" >Available Stock</div>
									<div style="float:left; width:20px;" align="center">:</div>
						            <div style="float:left;"><?php echo $detail['pro_stock']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>
                               <div class="control-group">
                               
							<div align="center" style="font-weight:bold; " >[ <a onClick="window.open('product_video.php?pro_url=<?php echo $detail['pro_url']; ?>', 'windowname1', 'scrollbars,resizable,width=480, height=287'); return false;" style="cursor:pointer;">View Product Video</a> ]</div>
									
								</div> 
                                
								
								<div class="control-group">
							<div style="float:left; font-weight:bold; width:755px; background-color:#F5F5F5;" >&nbsp;&nbsp;&nbsp;Description</div>
									<div style="float:left; width:20px;" align="center"></div>
						            <div style="float:left;text-align:justify;width:745px; line-height:22px; margin:0px 10px;"><?php echo $detail['pro_desc']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>	
						<div class="control-group">
							<div style="float:left; font-weight:bold;width:755px; background-color:#F5F5F5;">&nbsp;&nbsp;&nbsp;Features</div>
									<div style="float:left; width:20px;" align="center"></div>
						            <div style="float:left; text-align:justify; margin:0px 30px; line-height:22px;"><?php echo $detail['pro_features']; ?></div>
									<div style="clear:both;">&nbsp;</div>
									
								</div>
				
</div>
</div>
				  <div class="row-fluid">
				    <div class="form-actions">
  <!--									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>
-->					<a href="edit_products.php?edit=<?php echo $_REQUEST['pid']; ?>" class="btn btn-info" style="font-weight:bold;">EDIT</a>
    
    
    &nbsp; &nbsp; &nbsp;
    <!--<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>-->
    
    <a href="product.php?" class="btn" style="font-weight:bold;">BACK</a>
    
  </div>

					
</div>
						  
					</div>

						
							<div class="hr hr-18 dotted hr-double"></div>

							
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/flot/jquery.flot.min.js"></script>
		<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>

	
	</body>
</html>
