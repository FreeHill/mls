<?php include("config/error.php");

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $profileid = $_REQUEST['id'];
} else {
    header("Location:index.php");
    exit;
}

include("includes/head.php");
?>
<head>
<script type="text/javascript">
    function checkIt(evt) {
        evt = (evt) ? evt : window.event
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            status = "This field accepts numbers only."
            return false
        }
        status = "";
        return true
    }
</script>
    <script>
        function disstate(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication country");
                document.getElementById("addresscountry").focus();
                return false;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("astate").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function discity(str) {
//alert(str);

            document.getElementById('loading').style.display = 'block';

            if (str == "") {
                alert("Please choose the communication State");
                document.getElementById("addressstate").focus();
                return false;
            }
            // alert("gfhfg");
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("addresscity").innerHTML = xmlhttp.responseText;
                    document.getElementById('loading').style.display = 'none';
                }
            }
            xmlhttp.open("GET", "cityajax.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function stateview(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please choose the permanent country");
                document.getElementById("cpcontry").focus();
                return false;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("pstate").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax2.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function cityview(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please choose the Permanent State");
                document.getElementById("cpstate").focus();
                return false;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById("pcity").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "cityajax2.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>

        function commadrs() {
            var add1 = document.getElementById('addressline1').value;
            var add2 = document.getElementById('addressarea').value;
            var pc = document.getElementById('addresspostal').value;
            var coon = document.getElementById('addresscountry').value;
            var sttt = document.getElementById('addressstate').value;
            var cttt = document.getElementById('addresscity').value;


            if (document.getElementById('comm').checked == true) {
                document.getElementById('paddress1').value = add1;
                document.getElementById('paddress2').value = add2;
                document.getElementById('pzipcode').value = pc;
                document.getElementById('cpcountry').value = coon;
                document.getElementById('cpstate').value = sttt;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //alert(xmlhttp.responseText);
                        document.getElementById("pcity").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "cityvalue.php?q=" + cttt + "&st=" + sttt, true);
                xmlhttp.send();


            }

            if (document.getElementById('comm').checked == false) {
                document.getElementById('paddress1').value = "";
                document.getElementById('paddress2').value = "";
                document.getElementById('pzipcode').value = "";
                document.getElementById('cpcountry').value = "";
                document.getElementById('cpstate').value = "";
                document.getElementById('cpcity').value = "";
            }


        }

    </script>
    <script>
        function mailval(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please enter the email");
                document.getElementById("emailaddress").focus();
                return false;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    if (xmlhttp.responseText == 1) {
                        document.getElementById("err").innerHTML = "<font style='color:#006633;'>Valid Email !!!</font>";
                    } else {
                        document.getElementById("emailaddress").value = "";
                        document.getElementById("err").innerHTML = "<font style='color:#FF0000;'>Email Address Already exists, Click Here to <span><a href='forgot.php' style='font-weight:bold; color:#000000; text-decoration:underline;'>  Forgot Password  !!!</a></span></font>";
                    }

                }
            }
            xmlhttp.open("GET", "getmail.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

</head>
<body>
<div class="container main">
    <!-- Start Header-->
    <?php include("includes/header.php"); ?>
    <!-- End Header-->

    <!-- Start Navigation -->
    <?php include("includes/menu.php"); ?>
    <!-- End Navigation -->
    <hr/>
    <div class="row">
        <div class="span3">
            <div class="row">
                &nbsp;
            </div>
        </div>
        <div class="span9">
            <div class="row">
                <div class="form2" style="margin-left:-10px;">
                    <div class="span5">


                        <div class="span7" style="width:600px;">
                            <div class="barmenu">
                                <ul>
                                    <li class="active"><a href="#">Step1</a></li>
                                    <li class="active"><a href="#">Step2</a></li>
                                    <li><a href="#">Step3</a></li>
                                    <li><a href="#">Step4</a></li>

                                </ul>
                            </div>

                            <h2 class="widget-title"><span>Step 2*(Personal Information)</span></h2>
                            <div class="sidebar-line"><span></span></div>
                            <form class="register-form" method="post" action="registerfunc.php">
                                <label for="inputEmail"><span class="required">*</span> First Name:*</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your first name" name="firstname" id="firstname"
                                       required="true"/>

                                <label for="inputEmail">Second Name:</label><input class="input-block-level"
                                                                                   style="width:400px; margin-bottom:16px; "
                                                                                   placeholder="Enter your second name"
                                                                                   type="text" name="secondname"
                                                                                   id="secondname"/>

                                <label for="lastname"><span class="required">*</span> Last Name:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px; "
                                       placeholder="Enter your last name" type="text" name="lastname" id="lastname"/>

                                <label for="d"><span class="required">*</span> Date of Birth:*</label>
                                <label>
                                    <select id="d" class="styledselect-day" name="dobdate" required="true">
                                        <option value="">date</option>
                                        <option value="01">1</option>
                                        <option value="02">2</option>
                                        <option value="03">3</option>
                                        <option value="04">4</option>
                                        <option value="05">5</option>
                                        <option value="06">6</option>
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </label>
                                <label>
                                    <select id="m" name="dobmonth" class="styledselect-month" required="true">
                                        <option value="">month</option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Aug</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                </label>
                                <label>
                                    <input class="input-block-level" style="width:70px; margin-bottom:16px;" type="text"
                                           placeholder="YYYY" name="dobyear" id="dobyear" required="true"/>

                                    <!--<select  id="y" name="dobyear" class="styledselect-year" required="true">
                                    <option value="">year</option>

                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    </select>-->


                                </label>


                                <label for="inputEmail"><span class="required"></span>*Communication Address:</label>
                                <div class="sidebar-line"><span></span></div>
                                <br>

                                <label for="inputEmail"><span class="required">*</span> Address Line 1</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your address #1" name="addressline1" id="addressline1"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span>Area</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Area" name="addressarea" id="addressarea"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Country</label>
                                <!--<input class="input-block-level"  style="width:400px; margin-bottom:16px;"type="text" placeholder="Enter your Country" name="addresscountry" id="addresscountry" required="true" /> -->
                                <select name="addresscountry" id="addresscountry"
                                        onChange="return disstate(this.value);" class="input-block-level"
                                        style="width:400px; margin-bottom:16px;" required="true">
                                    <option value="">--- Choose Country ---</option>
                                    <?php

                                    $sqlcon = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                    while ($rowcountry = mysql_fetch_array($sqlcon)) {
                                        ?>
                                        <option value="<?php echo $rowcountry['country_id']; ?>" <?php if ($rowcountry['country_id'] == '94') { ?> selected="selected" <?php } ?>><?php echo $rowcountry['country_name']; ?></option>

                                    <?php } ?>

                                </select>

                                <label for="inputEmail"><span class="required">*</span> State</label>
                                <!--	 <input class="input-block-level"  style="width:400px; margin-bottom:16px;"type="text" placeholder="Enter your State" name="addressstate" id="addressstate" required="true" />-->
                                <div id="astate">
                                    <select name="addressstate" id="addressstate" onChange="return discity(this.value);"
                                            class="input-block-level" style="width:400px; margin-bottom:16px;"
                                            required="true">
                                        <option value="">--- Choose State ---</option>
                                        <?php
                                        $sele = mysql_query("select * from mlm_state where country_id ='94' and state_status='0'");
                                        while ($st = mysql_fetch_array($sele)) {
                                            ?>

                                            <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <label for="inputEmail"><span class="required">*</span>City</label>
                                <!--<input class="input-block-level"  style="width:400px; margin-bottom:16px;"type="text" placeholder="Enter your City" name="addresscity" id="addresscity" required="true" /> -->
                                <div id="acity">
                                    <select name="addresscity" id="addresscity" lass="input-block-level"
                                            style="width:400px; margin-bottom:16px;" required="true">
                                        <option value="">--- Choose City ---</option>
                                        <option value="ACCRA">ACCRA</option>
                                    </select><img src="images/ajax_loading.gif" id="loading" style="display: none;"/>
                                </div>

                                <label for="inputEmail"><span class="required">*</span> Postal Code</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Postal code" name="addresspostal" id="addresspostal"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span>Permanent Address: &nbsp;<input
                                            type="checkbox" name="comm" id="comm" onClick="return commadrs();"
                                            style="opacity: 1;"/> &nbsp;&nbsp;&nbsp;<span
                                            style="color:#999999; font-weight:normal;">&nbsp;(Communication Address same as Permanent Address)&nbsp;</span></label>
                                <div class="sidebar-line"><span></span></div>

                                <label for="inputEmail"><span class="required">*</span> Address Line 1</label><input
                                        class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                        placeholder="* Enter your address #1" name="paddress1" id="paddress1"
                                        required="true"/>

                                <label for="inputEmail"><span class="required">*</span>Area</label><input
                                        class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                        placeholder="* Enter your address #2" name="paddress1" id="paddress2"
                                        required="true"/>


                                <label for="inputEmail"><span class="required">*</span>Postal Code</label>

                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="* Enter your address #1" name="pzipcode" id="pzipcode"
                                       required="true"/>


                                <label for="inputEmail"><span class="required">*</span> Country</label>

                                <select name="cpcountry" id="cpcountry" onChange="return stateview(this.value);"
                                        style="width:400px; margin-bottom:16px;" class="input-block-level"
                                        required="true">
                                    <option value="">--- Choose Country ---</option>
                                    <?php

                                    $sqlcon = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                    while ($rowcountry = mysql_fetch_array($sqlcon)) {
                                        ?>
                                        <option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>

                                    <?php } ?>

                                </select>
                                <label for="inputEmail"><span class="required">*</span>State</label>
                                <div id="pstate">
                                    <select name="cpstate" id="cpstate" onChange="return cityview(this.value);"
                                            style="width:400px; margin-bottom:16px;" class="input-block-level"
                                            required="true">
                                        <option value="">--- Choose State ---</option>
                                        <?php
                                        $sele = mysql_query("select * from mlm_state where state_status='0' order by state_name asc");
                                        while ($st = mysql_fetch_array($sele)) {
                                            ?>

                                            <option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputEmail"><span class="required">*</span> City</label>

                                <div id="pcity">
                                    <select name="cpcity" id="cpcity" style="width:400px; margin-bottom:16px;"
                                            class="input-block-level" required="true">
                                        <option value="">--- Choose City ---</option>
                                        <option value="ACCRA">ACCRA</option>

                                    </select>
                                </div>

                                <label><span class="required">Contact details:</label>
                                <div class="sidebar-line"><span></span></div>

                                <label for="inputEmail"><span class="required">*</span>Phone (or) Mobile:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Phone number" name="phonenum" id="phonenum"
                                       onKeyPress="return checkIt(event);" required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Email:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Email address" name="emailaddress" id="emailaddress"
                                       required="true" onchange="mailval(this.value);"/><br/><span id="err">&nbsp;</span>


                                <label><span class="required">Bank details:</label>
                                <div class="sidebar-line"><span></span></div>

                                <label for="inputEmail"><span class="required">*</span> Bank account name:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your bank account name" name="bankaccname" id="bankaccname"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Bank Account No:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your account number" name="accnum" id="accnum"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Bank Name:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your bank name" name="bankname" id="bankname"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span>Branch:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Branch name" name="branchname" id="branchname"
                                       required="true"/>

                                <label for="inputEmail"><span class="required">*</span>IFSC code:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Bank IFSC code" name="ifsc" id="ifsc"
                                       required="true"/><br><br>

                                <input type="hidden" name="profileid" value="<?= $profileid ?>"/>
                                <button class="btn btn-primary" name="registrationtwo" type="submit">Next</button>
                                <button class="btn btn-inverse" type="reset">Reset</button>
                                <br><br>
                                <!--   <label class="checkbox inline">
                                <input type="checkbox" class="box"id="inlineCheckbox1" value="option1" required="true"> <a href="#">I read and agree Privacy Policy</a>
                                </label>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
        </div>
        <br class="clear"/>

    </div>

    <?php include("includes/footer.php"); ?>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>