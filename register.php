<?php
session_start();

include("config/error.php");
include("generalfunc.php");
//include("paycalculation.php");


include("includes/head.php");

?>
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

    function captchaval(str) {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                // alert(xmlhttp.responseText);
                document.getElementById("capterr").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "captchaval.php?q=" + str, true);
        xmlhttp.send();

    }

    function checkPassword(str) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("password-error").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "passwordval.php?q=" + str, true);
        xmlhttp.send();
    }

    function checksponser(str) {
        if (str == '') {
            return false;
        }

        if (str) {
            document.getElementById("sponsoridloading").style.display = 'inline-block';
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    if (xmlhttp.responseText == 0) {
                        document.getElementById("sponsorid").value = '';
                        document.getElementById("sponsorname").value = '';
                        document.getElementById("sponsormsg").style.color = "red";
                        document.getElementById("sponsormsg").innerHTML = "Sponsor id entered not valid, Please give valid id";
                        document.getElementById("sponsorid").focus();
                    } else if (xmlhttp.responseText == 1) {
                        document.getElementById("sponsorid").value = '';
                        document.getElementById("sponsorname").value = '';
                        document.getElementById("sponsormsg").style.color = "red";
                        document.getElementById("sponsormsg").innerHTML = "Sponsor id account suspended, Your Sponsor not paid Subscription!!";
                        document.getElementById("sponsorid").focus();
                    } else if (xmlhttp.responseText == 2) {
                        document.getElementById("sponsorid").value = '';
                        document.getElementById("sponsorname").value = '';
                        document.getElementById("sponsormsg").style.color = "red";
                        document.getElementById("sponsormsg").innerHTML = "This sponsor id exceeds the referral limit";
                        document.getElementById("sponsorid").focus();


                    } else {
                        document.getElementById("sponsorname").value = xmlhttp.responseText;
                        document.getElementById("sponsormsg").style.color = "green";
                        document.getElementById("sponsormsg").innerHTML = "Valid id";
                    }
                    document.getElementById("sponsoridloading").style.display = 'none';
                }
            }
            xmlhttp.open("GET", "getplacement.php?sponsor&q=" + str, true);
            xmlhttp.send();

        }
    }

    function formvalidation() {
        // e.preventDefault();
        var pass = document.getElementById("password").value;
        var pass1 = document.getElementById("passwordagain").value;

        if (pass !== '') {
            if (pass.length < 6) {
                alert("Please enter password above 6 letters");
                document.getElementById("password").focus();
                return false;
            }
        }

        if (pass1 !== '') {
            if (!pass.match(pass1)) {
                alert("Password and confirm password doesn\'t match");
                document.getElementById("password").value = '';
                document.getElementById("passwordagain").value = '';
                document.getElementById("password").focus();
                return false;
            }
        }

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
                <!--<div class="vertical-menu">
                    <h3 style="margin-top:10px;">Categories</h3>
                    <hr />
                    <ul class="nav">
                        <li><a href="blog.html">Category Item</a></li>
                        <li><a href="blog.html">Category Item</a></li>
                        <li><a href="blog.html">Category Item</a></li>
                        <li><a href="blog.html">Category Item</a></li>
                        <li><a href="blog.html">Category Item</a></li>
                        <li><a href="blog.html">Category Item</a></li>
                    </ul>
                    <br />
                    <h3>Archive</h3>
                    <hr />
                    <h4>Consultation with Doctor</h4>
                    <div class="sidebar-line"><span></span></div>
                    <p>
                        First corporate initiative in Ayurvedic stector in Kerala - the Southern State in
                        the 'Cradle of Ayurveda'.
                    </p>
                    <button class="btn btn-primary" type="submit">Clickhere</button><br><br>
                </div>-->
                &nbsp;
            </div>
        </div>
        <div class="span9">
            <div class="row">
                <div class="form2" style="margin-left: -10px;">
                    <div class="span5">

                        <div class="span7" style="width:600px;">

                            <div class="barmenu">
                                <ul>
                                    <li class="active"><a href="#">Step1</a></li>
                                    <li><a href="#">Step2</a></li>
                                    <li><a href="#">Step3</a></li>
                                    <li><a href="#">Step4</a></li>

                                </ul>
                            </div>

                            <h2 class="widget-title"><span>Step 1*(Basic Information)</span></h2>

                            <div class="sidebar-line"><span></span></div>
                            <form class="register-form" method="post"
                                  action="registerfunc.php" name="register" onsubmit="return formvalidation();">
                                <label for="sponsorid"><span class="required">*</span> Sponsor id:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:0px; "
                                       placeholder="Enter the Sponsor id" type="text" name="sponsorid" id="sponsorid"
                                       required="true" onBlur="return checksponser(this.value)"
                                       onKeyPress="return checkIt(event);"/> <span
                                        style="color:#999999"> Ex : 1202211 </span>
                                <div id="sponsormsg"
                                     style="margin-bottom:16px; width: 400px; color: red; padding: 0 5px;"></div>

                                <label for="sponsorname"><span class="required">*</span> Sponsor Name: <img
                                            src="images/ajax_loading.gif" id="sponsoridloading" style="display: none;"/></label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter the sponsor name" name="sponsorname" id="sponsorname"
                                       required="true" readonly="true"/>
                                <label for="password"><span class="required">*</span> Password:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;"
                                       placeholder="Enter your password" type="password" name="password" id="password"
                                       required="true" onkeyup="return checkPassword(this.value)"/>
                                <br><span id="password-error"></span>

                                <label for="passwordagain"><span class="required">*</span> Confirm Password:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:0px;"
                                       placeholder="Enter your password again" type="password" name="passwordagain"
                                       id="passwordagain" required="true"/>
                                <div id="passerror"
                                     style="margin-bottom:16px; width: 400px; color: red; padding: 0 5px;"></div>


                                <label for="inputEmail"><span class="required">*</span> Pan card:</label>

                                <input class="input-block-level" style="width:400px; margin-bottom:16px;"
                                       placeholder="Enter the Pan card number" type="text" name="pancardnum"
                                       id="pancardnum" required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Security Code</label>
                                <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="security_code" name="security_code" type="text" placeholder="Security Code"
                                       required="required" class="input-block-level"
                                       onKeyUp="return captchaval(this.value);"
                                       style="width:275px; margin-bottom:16px;"/></span>
                                <br><span id="capterr"></span>

                                <label for="inputEmail"><span class="required"></span> Register your account
                                    today</label>

                                <button class="btn btn-primary next" type="submit" name="registerone">Next</button>
                                <button class="btn btn-inverse" type="reset">Reset</button>
                                <br><br>
                                <label class="checkbox inline">
                                    <input type="checkbox" class="box" id="inlineCheckbox1" value="option1"
                                           required="required"> <a href="privacy.php" target="_blank">I read and agree
                                        Privacy Policy</a>
                                </label>
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
<script>

</script>

</body>
</html>