<?php
include("../config/error.php");
include("includes/header.php");

if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$menu19='class="active"';

if(isset($_REQUEST['submit']))
{
	$plan_name = mysql_real_escape_string($_REQUEST['mem_name']);
	$ref_count = mysql_real_escape_string($_REQUEST['referal_count']); 
	$ref_type = mysql_real_escape_string($_REQUEST['referal_type']); 
	$amount=mysql_real_escape_string($_REQUEST['act_amt']);
	$percentage = mysql_real_escape_string($_REQUEST['ref_percentage']);
	$indir_per=mysql_real_escape_string($_REQUEST['indir_ref']);
	$p_bonus=mysql_real_escape_string($_REQUEST['bonus']);
	if(($plan_name == "") or ($amount == "") or ($percentage == ""))
	{
		header("Location:membership.php?error");
		exit;
	}
		
	if($ref_count=='')
	{
		$ref_count="Unlimited";
	}
 $insert = mysql_query("INSERT INTO mlm_membership (membership_name,refferal_count,refer_type,act_amount,referance_percentage,indirect_reference,purchase_bonus) VALUES ('$plan_name','$ref_count','$ref_type','$amount','$percentage','$indir_per','$p_bonus')");

	if($insert)
	 { 
	 header("Location:membership.php?succ"); 
	 ?>
	<script>
	window.location="membership.php?succ";
	</script>	
	<?php
	}
}
if(isset($_REQUEST['update']))
{
	$plan_id = mysql_real_escape_string($_REQUEST['plan_id']);
	$pla_nam = mysql_real_escape_string($_REQUEST['mem_name']);
	$ref = mysql_real_escape_string($_REQUEST['referal_count']);
	$amt=mysql_real_escape_string($_REQUEST['act_amt']);
	$percent = mysql_real_escape_string($_REQUEST['ref_percentage']);
	$update = mysql_query("UPDATE mlm_membership SET membership_name='$pla_nam',refferal_count='$ref',act_amount='$amt',referance_percentage='$percent' WHERE id=$plan_id");
	if($update) {
			header("Location:membership.php?editsuccess");
		echo "<script>window.location='membership.php?editsuccess';</script>";
	}
}
 
?>
<style type="text/css">
#payid
{
	cursor:not-allowed;
}
</style>
<script type="text/javascript">
	var type=1;
	function view_limit(val)
	{
		type=val;
		
		if(type==1)
		{
			document.getElementById('ref_limit').style.display="block";
			
		}
		else
		{
		
			document.getElementById('ref_limit').style.display="none";
		
		}
	}
	
	function planvalidate()
	{
		var mem=document.getElementById('mem_name').value;
		if(mem=="")
		{
			alert("Please Enter Membership Name	");
			document.getElementById('mem_name').focus();
			return false;  
		}
		var ref=document.getElementById('referal_count').value;
		if(type==1)
		{
			if(ref=="")
			{
				alert("Please Enter Refferal Count");
				document.getElementById('referal_count').focus();
				return false;
			}
			else if(isNaN(document.getElementById('referal_count').value))
			{
				alert("Please Enter Valid Count");
				document.getElementById('referal_count').focus();
				return false;
			}
		}
		var amt=document.getElementById('act_amt').value;
		if(amt=="")
		{
			alert("Please Enter Activate Amount");
			document.getElementById('act_amt').focus();
			return false;
		}
		else if(isNaN(document.getElementById('act_amt').value))
		{
			alert("Please Enter Valid Amount");
			document.getElementById('act_amt').focus();
			return false;
		}
		var per=document.getElementById('ref_percentage').value;
		if(per=="")
		{
			alert("Please Enter Referral Percentage ");
			document.getElementById('ref_percentage').focus();
			return false;
		}
		else if(isNaN(document.getElementById('ref_percentage').value))
		{
			alert("Please Enter Valid Percentage ");
			document.getElementById('ref_percentage').focus();
			return false;
		}
		var ind=document.getElementById('indir_ref').value;
		if(ind=="")
		{
			alert("Please Enter Indirect Referral Percentage");
			document.getElementById('indir_ref').focus();
			return false;
		}
		else if(isNaN(document.getElementById('indir_ref').value))
		{
			alert("Please Enter Valid Indirect Referral Percentage");
			document.getElementById('indir_ref').focus();
			return false;
		}
		
	}
	
</script>

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
							<a href="membership.php">Mebership Plan</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Add New Membership</li>
					</ul><!--.breadcrumb-->

					
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
					Add New Membership
						
						</h1>
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<form class="form-horizontal" name="general"  method="post" action="" onsubmit="return planvalidate();" enctype="multipart/form-data" />
								<div class="control-group">
									<label class="control-label" for="form-field-1">Membership Name<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="mem_name" id="mem_name" />
									</div>
								</div>
									<input type="hidden" name="user_id" value="<?php echo $idd; ?>">
								<div class="control-group">
									<label class="control-label" for="form-field-2">Referral Type<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
                                   <input type="radio" name="referal_type" value="1" style=" opacity:1; " checked="checked" onclick="view_limit(1);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limited&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="referal_type"  value="2" style=" opacity:1;" onclick="view_limit(2);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unlimited
									</div>
								</div>
                                
								<div class="control-group" id="ref_limit">
									<label class="control-label" for="form-field-2">Referral Count <span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										 <input type="text" name="referal_count" id="referal_count"  />
									</div>
								</div>


	                               <div class="control-group">
									<label class="control-label" for="form-field-2">Activate amount<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="act_amt" id="act_amt"/>
									</div>
								</div>
                                
                                 <div class="control-group">
									<label class="control-label" for="form-field-2">Reference percentage<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="ref_percentage" id="ref_percentage"  />
									</div>
								</div>
                                
                                 <div class="control-group">
									<label class="control-label" for="form-field-2">Indirect Reference Percentage<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="indir_ref" id="indir_ref"  />
									</div>
								</div>

								 <div class="control-group">
									<label class="control-label" for="form-field-2">Purchase Bonus<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
									<input type="radio" name="bonus" value="1" style=" opacity:1; " checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Available&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="bonus"  value="0" style=" opacity:1;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unavailable
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
