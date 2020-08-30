<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu12='class="active"';

if(isset($_REQUEST['submit']))
{
	$ptype=mysql_real_escape_string($_REQUEST['ptype']);
	$cday=mysql_real_escape_string($_REQUEST['calday']);
	
	$caldate=mysql_real_escape_string($_REQUEST['date']);
	
	//echo $caldate; exit; 
	
	$ccc=mysql_num_rows(mysql_query("select * from mlm_sunplan where sun_id='1'"));
	
	//echo $ccc;  exit;
	
	if($ccc=='0')
	{

		
		$qry=mysql_query("insert into mlm_sunplan set sun_type='$ptype', sun_day='$cday', sun_calcdate='$caldate', sun_id ='1',sun_modify_date=NOW()");
	}
	else 
	{

			$qry=mysql_query("update mlm_sunplan set sun_type='$ptype', sun_day='$cday', sun_calcdate='$caldate',sun_modify_date=NOW() where sun_id ='1'");
	
	}
	if($qry)
	{
		header("Location:sun_plan.php?suss");
		echo "<script>window.location='sun_plan.php?suss';</script>";
	}
}

$calcc=mysql_fetch_array(mysql_query("select * from mlm_sunplan where sun_id='1'"));

?>
 
<!-- <link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> -->
 
 <script>
 
 function calc(val)
 {
 if(val==1)
 {
 document.getElementById('cal1').style.display="block";
 document.getElementById('cal2').style.display="none";
 }
  if(val==2)
 {
 document.getElementById('cal1').style.display="none";
 document.getElementById('cal2').style.display="block";
 }
 }
 
 </script>
 
 
 
<style type="text/css">
.form-horizontal .controls {
	margin-left: 355px;
}

.form-horizontal .control-label {
	width: 350px;
}

.form-horizontal .form-actions {
	text-align: center;
	padding-left: 0;
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

						
						<li class="active">Payout general Details</li>
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Payout Details
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
						
						 <?php 
						   
						   if(isset($_REQUEST['suss']))
						   {
						  ?> 
						  
						   <div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="icon-remove"></i>
								</button>

							 <i class="icon-ok green"></i>
								<strong class="green">
									 Updated Successfully !!!
								</strong>
						
							</div>
						   
						   <?php }
						   
						   ?>
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return bvalidate();" enctype="multipart/form-data" />
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Payout Type <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									&nbsp;&nbsp;<input type="radio" name="ptype" id="ptype" value="1" style="opacity:1;" <?php if($calcc['sun_type']=='1') { ?> checked="checked" <?php } ?> onclick="return calc(1);"/>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Monthly &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ptype" id="ptype" value="2" style="opacity:1;" <?php if($calcc['sun_type']=='2') { ?> checked="checked" <?php } ?>  onclick="return calc(2);"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Weekly
									</div>
								</div>


						         
								<div class="control-group"  id="cal1" <?php if($calcc['sun_type']=='1') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
									<label class="control-label" for="form-field-1">Calculation Date <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
						 <!--<input type="text" name="date" id="date" class="tcal" value="<?php //echo $calcc['sun_calcdate']; ?>"/>-->
						&nbsp;&nbsp; <select name="date" id="date" required="true">
						 <option value="">--Calculate Day--</option>
						 <!--<option value="start" <?php if($calcc['sun_calcdate']=='start') { ?> selected="selected" <?php } ?>>Month Starting</option>-->
						 <?php
						 for($i=1; $i<=28; $i++)
						 {
						 ?>
						 <option value="<?php echo $i; ?>" <?php if($calcc['sun_calcdate']==$i) { ?> selected="selected" <?php } ?>><?php echo $i; ?></option> 
						 <?php }
						  ?>
						  <option value="end" <?php if($calcc['sun_calcdate']=='end') { ?> selected="selected" <?php } ?>>Month End</option>
						 </select>
						 
									</div>
								</div>
						
								
								
								<div class="control-group" id="cal2" <?php if($calcc['sun_type']=='2') { ?> style="display:block;"  <?php } else { ?> style="display:none;" <?php } ?>>
									<label class="control-label" for="form-field-1">Calculation day <span style="color:#FF0000;">*</span> : </label>

                           <div class="controls">
										<label for="mon" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="mon" value="Monday"  style="opacity:1;" <?php if($calcc['sun_day']=='Monday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Monday
										</label>
										
										<label for="tues" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="tues" value="Tuesday"  style="opacity:1;" <?php if($calcc['sun_day']=='Tuesday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tuesday
										</label>
										
										<label for="wed" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="wed" value="Wednesday"  style="opacity:1;" <?php if($calcc['sun_day']=='Wednesday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Wednesday
										</label>
										
										<label for="thurs" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="thurs" value="Thursday"  style="opacity:1;" <?php if($calcc['sun_day']=='Thursday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thursday
										</label>
										
										<label for="fri" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="fri" value="Friday"  style="opacity:1;" <?php if($calcc['sun_day']=='Friday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Friday
										</label>
										
										<label for="sat" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="fri" value="Saturday"  style="opacity:1;" <?php if($calcc['sun_day']=='Saturday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Saturday
										</label>
										
										<label for="sun" style="line-height: 25px; float:left; margin:0 5px;">
											 <input type="radio" name="calday" id="sun" value="Sunday"  style="opacity:1;" <?php if($calcc['sun_day']=='Sunday') { echo 'checked="checked"'; } ?> /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sunday
										</label>
									</div>
								</div>
									
								<div class="form-actions">
<!--									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>
-->								<input type="submit" name="submit" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">
									

									&nbsp; &nbsp; &nbsp;
									<!--<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>-->
									
									<input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">
									
								</div>

								<div class="hr"></div>

								<!--/row-->


								<!--/row-->

							
								
							</form>

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
