<?php
include("../config/error.php");
include("includes/header.php");

if ((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id'] == "")) {
    header("location:index.php");
}

$menu6 = 'class="active"';

$detail = mysql_fetch_array(mysql_query("select * from mlm_register where user_id='$_REQUEST[detail]'"));

?>
<style>
    .label.arrowed-in:before {

        padding: 10px;
    }

    .label.arrowed-in-right:after {
        padding: 10px;
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
                    <a href="user.php">Users</a>

                    <span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
                </li>
                <li class="active">View User Details</li>
            </ul><!--.breadcrumb-->
        </div>



    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                VIEW USER DETAIL

            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">

            <div class="control-group">

                <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">BASIC
                    INFORMATION </label>

            </div>

            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Sponser Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_sponsername']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Sponser id</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_sponserid']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Password</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_password']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">PAN Card Number</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_pancard']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Placement Position</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;">
                        <?php if ($detail['user_placement'] == 'L') {
                            echo "Left";
                        } else if ($detail['user_placement'] == 'R') {
                            echo "Right";
                        } else {
                            echo "Nil";
                        }

                        ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Placement Id</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_placementid']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>


            </div>
        </div>
        <div class="row-fluid">

            <div class="control-group">

                <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">PERSONAL
                    INFORMATION </label>

            </div>


            <div class="span12">
                <!--PAGE CONTENT BEGINS-->


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">First Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_fname']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Second Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_secondname']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Last Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_lname']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">D.O.B</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_dob']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Phone</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_phone']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Email</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_email']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Name as per Bank</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_accholdername']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Bank Account No</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_accno']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Bank Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_bankname']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Branch</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_branch']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">IFSC code</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_ifsccode']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <label style="border-bottom:1px #CCCCCC solid; font-weight:bold; color:#FF6600;">Communication
                        Address </label>

                </div>


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Address 1</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_commaddr1']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Address 2</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_commaddr2']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Country</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;">
                        <?php

                        $sqlcon = mysql_fetch_array(mysql_query("select * from mlm_country where country_status='0' and country_id='$detail[user_country]' order by country_name asc"));
                        ?>
                        <?php echo $sqlcon['country_name']; ?>

                    </div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">State</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php

                        $sqlstate = mysql_fetch_array(mysql_query("select * from mlm_state where state_status='0' and state_id='$detail[user_state]' order by state_name asc"));
                        ?>
                        <?php echo $sqlstate['state_name']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">City</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php

                        $sqlcity = mysql_fetch_array(mysql_query("select * from mlm_city where city_status='0' and city_id='$detail[user_city]' order by city_name asc"));
                        ?>
                        <?php echo $sqlcity['city_name']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Postal Code</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_postalcode']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">
                    <label style="border-bottom:1px #CCCCCC solid; font-weight:bold; color:#FF6600;">Permanent Address
                        &nbsp
                    </label>
                </div>


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Address 1</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_paddr1']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Address 2</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_paddr2']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Country</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;">
                        <?php

                        $sqlcon = mysql_fetch_array(mysql_query("select * from mlm_country where country_status='0' and country_id='$detail[user_pcountry]' order by country_name asc"));
                        ?>
                        <?php echo $sqlcon['country_name']; ?>

                    </div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">State</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php

                        $sqlstate = mysql_fetch_array(mysql_query("select * from mlm_state where state_status='0' and state_id='$detail[user_pstate]' order by state_name asc"));
                        ?>
                        <?php echo $sqlstate['state_name']; ?></div>
                    <div style="clear:both;">&nbsp;</div>
                </div>

                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">City</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php

                        $sqlcity = mysql_fetch_array(mysql_query("select * from mlm_city where city_status='0' and city_id='$detail[user_pcity]' order by city_name asc"));
                        ?>
                        <?php echo $sqlcity['city_name']; ?></div>
                    <div style="clear:both;">&nbsp;</div>
                </div>


                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Postal Code</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_ppostalcode']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">
                    <label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">&nbsp;</label>

                </div>


            </div>
        </div>
        <div class="row-fluid">

            <div class="control-group">

                <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">NOMINEE
                    INFORMATION </label>

            </div>

            <div class="span12">
                <!--PAGE CONTENT BEGINS-->


                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Name</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_nomineename']; ?></div>
                    <div style="clear:both;">&nbsp;</div>
                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Identity Card Type</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_identifycardtype']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>


                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Identity Card Number</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_idnumber']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Phone</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_nphone']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>

                <div class="control-group">

                    <div style="float:left; font-weight:bold; width:150px;" align="right">Email</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_nemail']; ?></div>
                    <div style="clear:both;">&nbsp;</div>


                </div>


                <div class="control-group">

                    <label style="border-bottom:1px #CCCCCC solid; font-weight:bold; color:#FF6600;">Communication
                        Address </label>

                </div>


                <div class="control-group">
                    <div style="float:left; font-weight:bold; width:150px;" align="right">Address 1</div>
                    <div style="float:left; width:20px;" align="center">:</div>
                    <div style="float:left;"><?php echo $detail['user_naddr1']; ?></div>
                    <div style="clear:both;">&nbsp;</div>

                </div>
            </div>

            <div class="control-group">
                <div style="float:left; font-weight:bold; width:150px;" align="right">Address 2</div>
                <div style="float:left; width:20px;" align="center">:</div>
                <div style="float:left;"><?php echo $detail['user_naddr2']; ?></div>
                <div style="clear:both;">&nbsp;</div>
            </div>

            <div class="control-group">
                <div style="float:left; font-weight:bold; width:150px;" align="right">Country</div>
                <div style="float:left; width:20px;" align="center">:</div>
                <div style="float:left;">
                    <?php

                    $sqlcon = mysql_fetch_array(mysql_query("select * from mlm_country where country_status='0' and country_id='$detail[user_ncountry]' order by country_name asc"));
                    ?>
                    <?php echo $sqlcon['country_name']; ?>

                </div>
                <div style="clear:both;">&nbsp;</div>

            </div>

            <div class="control-group">
                <div style="float:left; font-weight:bold; width:150px;" align="right">State</div>
                <div style="float:left; width:20px;" align="center">:</div>
                <div style="float:left;"><?php

                    $sqlstate = mysql_fetch_array(mysql_query("select * from mlm_state where state_status='0' and state_id='$detail[user_nstate]' order by state_name asc"));
                    ?>
                    <?php echo $sqlstate['state_name']; ?></div>
                <div style="clear:both;">&nbsp;</div>
            </div>

            <div class="control-group">
                <div style="float:left; font-weight:bold; width:150px;" align="right">City</div>
                <div style="float:left; width:20px;" align="center">:</div>
                <div style="float:left;"><?php

                    $sqlcity = mysql_fetch_array(mysql_query("select * from mlm_city where city_status='0' and city_id='$detail[user_ncity]' order by city_name asc"));
                    ?>
                    <?php echo $sqlcity['city_name']; ?></div>
                <div style="clear:both;">&nbsp;</div>
            </div>

            <div class="control-group">
                <div style="float:left; font-weight:bold; width:150px;" align="right">Postal Code</div>
                <div style="float:left; width:20px;" align="center">:</div>
                <div style="float:left;"><?php echo $detail['user_npostalcode']; ?></div>
                <div style="clear:both;">&nbsp;</div>
            </div>


            <div class="form-actions">
                <!--									<button class="btn btn-info" type="button">
                                                        <i class="icon-ok bigger-110"></i>
                                                        Submit
                                                    </button>
                --> <a href="user_edit.php?edit=<?php echo $_REQUEST['detail']; ?>" class="btn btn-info"
       style="font-weight:bold;">EDIT</a>


                &nbsp; &nbsp; &nbsp;
                <!--<button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                </button>-->

                <a href="user.php?" class="btn" style="font-weight:bold;">BACK</a>

            </div>


        </div>
    </div>
</div>


<div class="hr hr-18 dotted hr-double"></div>


<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div>
<!--basic scripts-->

<!--[if !IE]>-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<![endif]-->

<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]>-->

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<!--<![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if ("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
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
    $(function () {
        $('.easy-pie-chart.percentage').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function () {
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {
                tagValuesAttribute: 'data-values',
                type: 'bar',
                barColor: barColor,
                chartRangeMin: $(this).data('min') || 0
            });
        });


        var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
        var data = [
            {label: "social networks", data: 38.7, color: "#68BC31"},
            {label: "search engines", data: 24.5, color: "#2091CF"},
            {label: "ad campaings", data: 8.2, color: "#AF4E96"},
            {label: "direct traffic", data: 18.6, color: "#DA5430"},
            {label: "other", data: 10, color: "#FEE074"}
        ]

        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
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
                    margin: [-30, 15]
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
            if (item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
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


        var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
        $.plot("#sales-charts", [
            {label: "Domains", data: d1},
            {label: "Hosting", data: d2},
            {label: "Services", data: d3}
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: {show: true},
                points: {show: true}
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
                backgroundColor: {colors: ["#fff", "#fff"]},
                borderWidth: 1,
                borderColor: '#555'
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

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function (e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0) return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
            });

        $('#tasks').sortable({
                opacity: 0.8,
                revert: true,
                forceHelperSize: true,
                placeholder: 'draggable-placeholder',
                forcePlaceholderSize: true,
                tolerance: 'pointer',
                stop: function (event, ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                    $(ui.item).css('z-index', 'auto');
                }
            }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function () {
            if (this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


    })
</script>


</body>
</html>
