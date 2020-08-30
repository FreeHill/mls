<?php include("config/error.php");
if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
	$profileid=$_REQUEST['id'];
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
        function showstate(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication country");
                document.getElementById("nomcontry").focus();
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
                    document.getElementById("nstatee").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "stateajax3.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function cityshow(str) {
//alert("gfhfg");

            if (str == "") {
                alert("Please choose the communication State");
                document.getElementById("nomstate").focus();
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
                    document.getElementById("ncityy").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "cityajax3.php?q=" + str, true);
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
                                    <li class="active"><a href="#">Step3</a></li>
                                    <li><a href="#">Step4</a></li>

                                </ul>
                            </div>
                            <h2 class="widget-title"><span>Step 3*(Nominee Information)</span></h2>
                            <div class="sidebar-line"><span></span></div>
                            <script language="javascript">
                                function othercheck(status) {
                                    if (status == 'yes') {
                                        document.getElementById('otheridname').style.display = 'block';
                                    } else {
                                        document.getElementById('otheridname').style.display = 'none';
                                    }
                                }
                            </script>
                            <form class="register-form" method="post" action="registerfunc.php">
                                <label for="inputEmail"><span class="required">*</span> Nominee Name</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your full name" name="nomname" id="nomname" required="true"/>


                                <label><span class="required">*</span> Identity Card Type :</label>

                                <div style="float:left; width:30%;">
                                    <label for="voterid" class="checkbox" style="color: #dd4814;">
                                        <input type="radio" name="idcardtype" id="voterid" class="box"
                                               id="inlineCheckbox1" value="Voters ID" onclick="othercheck('no')"/>
                                        &nbsp; Voters ID
                                    </label>

                                    <label for="pancard" class="checkbox" style="color: #dd4814;">
                                        <input type="radio" name="idcardtype" id="pancard" class="box"
                                               id="inlineCheckbox1" value="PAN Card" onclick="othercheck('no')"/>
                                        &nbsp; PAN Card
                                    </label>

                                    <label for="passport" class="checkbox" style="color: #dd4814;">
                                        <input type="radio" name="idcardtype" id="passport" class="box"
                                               id="inlineCheckbox1" value="Passport" onclick="othercheck('no')"/>
                                        &nbsp; Passport
                                    </label>

                                    <label for="driving" class="checkbox" style="color: #dd4814;">
                                        <input type="radio" name="idcardtype" id="driving" class="box"
                                               id="inlineCheckbox1" value="Driving License" onclick="othercheck('no')"/>
                                        &nbsp; Driving License
                                    </label>

                                    <label for="others" class="checkbox" style="color: #dd4814;">
                                        <input type="radio" name="idcardtype" id="others" class="box"
                                               id="inlineCheckbox1" value="others" onclick="othercheck('yes')"/>
                                        &nbsp; Others
                                    </label>
                                </div>

                                <div style="float:left; width: 50%;">
                                    <div style="width:90%;  display:none;" id="otheridname">
                                        <label for="inputEmail"><span class="required">*</span>ID card name</label>
                                        <input class="input-block-level" style="width:220px; margin-bottom:16px;"
                                               type="text" placeholder="Enter Id card type here" name="idcardtypename"
                                               id="idcardtypename"/>
                                    </div>

                                    <div style="width:90%;">
                                        <label for="inputEmail"><span class="required">*</span>ID Card number</label>
                                        <input class="input-block-level" style="width:220px; margin-bottom:16px;"
                                               type="text" placeholder="Enter Id card number" name="idcardnum"
                                               id="idcardnum" required="true"/>
                                    </div>
                                </div>

                                <br style="clear:both;"><br>

                                <label><span class="required"></span>*Communication Address:</label>
                                <div class="sidebar-line"><span></span></div>
                                <br>

                                <label><span class="required">*</span> Address Line 1</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your address #1" name="nomaddress" id="nomaddress"
                                       required="true"/>

                                <label><span class="required">*</span>Area</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your area" name="nomarea" id="nomarea" required="true"/>


                                <label for="inputEmail"><span class="required">*</span> Postal Code*</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your Postal Code" name="nompostal" id="nompostal"
                                       required="true"/>


                                <label for="inputEmail"><span class="required">*</span> Country</label>
                                <!--<input class="input-block-level"  style="width:400px; margin-bottom:16px;" type="text" placeholder="Enter your Country" name="nomcountry" id="nomcountry" required="true" /> -->
                                <select name="nomcountry" id="nomcountry" onChange="return showstate(this.value);"
                                        style="width:400px; margin-bottom:16px;" required="true">
                                    <option value="">--- Choose Country ---</option>
                                    <?php

                                    $sqlcon = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                    while ($rowcountry = mysql_fetch_array($sqlcon)) {
                                        ?>
                                        <option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>

                                    <?php } ?>

                                </select>
                                <label><span class="required">*</span> State</label>
                                <div id="nstatee">
                                    <select name="nomstate" id="nomstate" onChange="return cityshow(this.value);"
                                            style="width:400px; margin-bottom:16px;" required="true">
                                        <option value="">--- Choose State ---</option>
                                        <option value="dummy">Dummy</option>

                                    </select>
                                </div>

                                <label><span class="required">*</span>City</label>
                                <div id="ncityy">
                                    <select name="nomcity" id="nomcity" style="width:400px; margin-bottom:16px;"
                                            required="true">
                                        <option value="">--- Choose City ---</option>
                                        <option value="ACCRA">ACCRA</option>
                                    </select>
                                </div>


                                <label for="inputEmail"><span class="required">*</span>Phone:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your phone" name="nomphone" id="nomphone"
                                       onKeyPress="return checkIt(event);" required="true"/>

                                <label for="inputEmail"><span class="required">*</span> Email:</label>
                                <input class="input-block-level" style="width:400px; margin-bottom:16px;" type="text"
                                       placeholder="Enter your email address" name="nomemail" id="nomemail"
                                       required="true"/>
                                <br><br>

                                <input type="hidden" name="profileid" value="<?= $profileid ?>"/>
                                <button class="btn btn-primary" name="registrationthree" type="submit">Next</button>
                                <button class="btn btn-inverse" type="Reset">Reset</button>
                                <br><br>

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