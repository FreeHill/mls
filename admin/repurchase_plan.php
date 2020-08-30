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
	$level1=mysql_real_escape_string($_REQUEST['level1']);
	$level2=mysql_real_escape_string($_REQUEST['level2']);
	$level3=mysql_real_escape_string($_REQUEST['level3']);
	$level4=mysql_real_escape_string($_REQUEST['level4']);
	$level5=mysql_real_escape_string($_REQUEST['level5']);
	$level6=mysql_real_escape_string($_REQUEST['level6']);
	$level7=mysql_real_escape_string($_REQUEST['level7']);
	$level8=mysql_real_escape_string($_REQUEST['level8']);
	$level9=mysql_real_escape_string($_REQUEST['level9']);
	$level10=mysql_real_escape_string($_REQUEST['level10']);
	
	$level11=mysql_real_escape_string($_REQUEST['level11']);
	$level12=mysql_real_escape_string($_REQUEST['level12']);
	$level13=mysql_real_escape_string($_REQUEST['level13']);
	$level14=mysql_real_escape_string($_REQUEST['level14']);
	$level15=mysql_real_escape_string($_REQUEST['level15']);
	$level16=mysql_real_escape_string($_REQUEST['level16']);
	$level17=mysql_real_escape_string($_REQUEST['level17']);
	$level18=mysql_real_escape_string($_REQUEST['level18']);
	$level19=mysql_real_escape_string($_REQUEST['level19']);
	$level20=mysql_real_escape_string($_REQUEST['level20']);
	
	$ccc=mysql_num_rows(mysql_query("select * from mlm_re_purchase where re_id='1'"));
	
	//echo $ccc;  exit;
	
	if($ccc=='0')
	{
		//echo "insert into mlm_re_purchase set re_id='1', re_level1='$level1', re_level2='$level2', re_level3='$level3', re_level4='$level4', re_level5='$level5', re_level6='$level6', re_level7='$level7', re_level8='$level8', re_level9='$level9', re_level10='$level10', re_level11='$level11', re_level12='$level12', re_level13='$level13', re_level14='$level14', re_level15='$level15', re_level16='$level16', re_level17='$level17', re_level18='$level18', re_level19='$level19', re_level20='$level20'"; exit;
		
		$qry=mysql_query("insert into mlm_re_purchase set re_id='1', re_level1='$level1', re_level2='$level2', re_level3='$level3', re_level4='$level4', re_level5='$level5', re_level6='$level6', re_level7='$level7', re_level8='$level8', re_level9='$level9', re_level10='$level10', re_level11='$level11', re_level12='$level12', re_level13='$level13', re_level14='$level14', re_level15='$level15', re_level16='$level16', re_level17='$level17', re_level18='$level18', re_level19='$level19', re_level20='$level20'");
	}
	else 
	{
		//echo "update mlm_re_purchase set re_level1='$level1', re_level2='$level2', re_level3='$level3', re_level4='$level4', re_level5='$level5', re_level6='$level6', re_level7='$level7', re_level8='$level8', re_level9='$level9', re_level10='$level10', re_level11='$level11', re_level12='$level12', re_level13='$level13', re_level14='$level14', re_level15='$level15', re_level16='$level16', re_level17='$level17', re_level18='$level18', re_level19='$level19', re_level20='$level20 where re_id='1'";  exit;
		
		$qry=mysql_query("update mlm_re_purchase set re_level1='$level1', re_level2='$level2', re_level3='$level3', re_level4='$level4', re_level5='$level5', re_level6='$level6', re_level7='$level7', re_level8='$level8', re_level9='$level9', re_level10='$level10', re_level11='$level11', re_level12='$level12', re_level13='$level13', re_level14='$level14', re_level15='$level15', re_level16='$level16', re_level17='$level17', re_level18='$level18', re_level19='$level19', re_level20='$level20 where re_id='1'");
	}
	if($qry)
	{
		header("Location:repurchase_plan.php?suss");
		echo "<script>window.location='repurchase_plan.php?suss';</script>";exit;
	}
}

$calcc=mysql_fetch_array(mysql_query("select * from mlm_re_purchase where re_id='1'"));

?>
 
<!-- <link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> -->
 
 <script>
 
 function bvalidate()
 {
 /*var refer = document.getElementById('refer').value;
  var cv = document.getElementById('cv').value;

		 
 if(refer == "")
	{
		alert("Enter the Referral bonus percentage");
		document.getElementById('refer').focus();
		return false;
	}
 
  if(cv == "")
	{
		alert("Enter the cv amount");
		document.getElementById('cv').focus();
		return false;
	}
 
 
*/
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

						
						<li class="active">Re-Purchase Plan</li>
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Re-Purchase Plan Management
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
								
								
								<div class="control-group" align="center">
								<h4><U>RE-PURCHASE BONUS 20 LEVELS</U></h4>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="form-field-1">Level 1 (%)<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="level1" id="level1" value="<?php echo $calcc['re_level1']; ?>" required="true"/>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 2 (%)<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="level2" id="level2" value="<?php echo $calcc['re_level2']; ?>" required="true"/>
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 3 (%)<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="level3" id="level3" value="<?php echo $calcc['re_level3']; ?>" required="true"/>
									</div>
								</div>
				           
						   <div class="control-group">
									<label class="control-label" for="form-field-1">Level 4 (%)<span style="color:#FF0000;">*</span> : </label>
									<div class="controls">
										<input type="text" name="level4" id="level4" value="<?php echo $calcc['re_level4']; ?>" required="true"/>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 5 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level5" id="level5" value="<?php echo $calcc['re_level5']; ?>" required="true"/>
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 6 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level6" id="level6" value="<?php echo $calcc['re_level6']; ?>" required="true"/>
									</div>
								</div>
				           

                             	<div class="control-group">
									<label class="control-label" for="form-field-1">Level 7 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level7" id="level7" value="<?php echo $calcc['re_level7']; ?>" required="true"/>
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 8 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level8" id="level8" value="<?php echo $calcc['re_level8']; ?>" required="true"/>
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 9 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level9" id="level9" value="<?php echo $calcc['re_level9']; ?>" required="true" />
									</div>
								</div>
				           
						   <div class="control-group">
									<label class="control-label" for="form-field-1">Level 10 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level10" id="level10" value="<?php echo $calcc['re_level10']; ?>" required="true" />
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 11 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level11" id="level11" value="<?php echo $calcc['re_level11']; ?>" required="true" />
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 12 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
								<input type="text" name="level12" id="level12" value="<?php echo $calcc['re_level12']; ?>" required="true"/>
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 13 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level13" id="level13" value="<?php echo $calcc['re_level13']; ?>" required="true" />
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 14 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level14" id="level14" value="<?php echo $calcc['re_level14']; ?>" required="true" />
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 15 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level15" id="level15" value="<?php echo $calcc['re_level15']; ?>"required="true" />
									</div>
								</div>
				           
						   <div class="control-group">
									<label class="control-label" for="form-field-1">Level 16 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level16" id="level16" value="<?php echo $calcc['re_level16']; ?>"required="true" />
									</div>
								</div>
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 17 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level17" id="level17" value="<?php echo $calcc['re_level17']; ?>"required="true" />
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 18 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level18" id="level18" value="<?php echo $calcc['re_level18']; ?>"required="true" />
									</div>
								</div>
								
											<div class="control-group">
									<label class="control-label" for="form-field-1">Level 19 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level19" id="level19" value="<?php echo $calcc['re_level19']; ?>"required="true" />
									</div>
								</div>
								
								
									<div class="control-group">
									<label class="control-label" for="form-field-1">Level 20 (%)<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="level20" id="level20" value="<?php echo $calcc['re_level20']; ?>"required="true" />
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
