<?php
include("../config/error.php");
include("includes/header.php");

if ((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id'] == "")) {
    header("location:index.php");
}

$menu6 = 'class="active"';

if (isset($_REQUEST['update1'])) {
    //echo "testting";
    $uid = $_REQUEST['uid'];
    $name = mysql_real_escape_string($_REQUEST['sname']);
    $sponserid = mysql_real_escape_string($_REQUEST['sid']);
    $pancard = $_REQUEST['pancard'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $insert = mysql_query("update mlm_register set user_sponsername='$name',user_sponserid='$sponserid',user_pancard='$pancard' where user_id='1'");

    if ($insert) {
        // echo "testing;"; exit;
        header("Location:sponser_member.php?upsucc");
        ?>
        <script>
            window.location = "sponser_member.php?upsucc";
        </script>
        <?php

    }
}


if (isset($_REQUEST['update2'])) {

    //echo "testting";
    $uid = $_REQUEST['uid'];
    $fname = mysql_real_escape_string($_REQUEST['fname']);
    $secname = mysql_real_escape_string($_REQUEST['secname']);
    $lname = mysql_real_escape_string($_REQUEST['lname']);
    $date = date("Y-m-d", strtotime($_REQUEST['date']));

    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $holder = $_REQUEST['holder_name'];
    $accno = $_REQUEST['accno'];
    $bank_name = $_REQUEST['bank_name'];
    $branch = $_REQUEST['branch'];
    $ifsccode = $_REQUEST["ifsc_code"];

    $caddr1 = $_REQUEST['caddr1'];
    $cddr2 = $_REQUEST['caddr2'];
    $ccountry = $_REQUEST['ccountry'];
    $cstate = $_REQUEST['cstate'];
    $ccity = $_REQUEST['ccity'];
    $czipcode = $_REQUEST['czipcode'];

    $cpaddr1 = $_REQUEST['cpaddr1'];
    $cpddr2 = $_REQUEST['cpaddr2'];
    $cpcountry = $_REQUEST['cpcountry'];
    $cpstate = $_REQUEST['cpstate'];
    $cpcity = $_REQUEST['cpcity'];
    $cpzipcode = $_REQUEST['cpzipcode'];

    $profile_image = $_FILES['pimage']['name'];

    if ($profile_image == "") {
        if ($_REQUEST['hide_image'] == "") {
            header("Location:sponser_member.php?edit=$uid&not-a-image");
            exit;
        } else {
            $cate_img_small = $_REQUEST['hide_image'];
        }

    } else {

        //echo "test hid = ".$_REQUEST['imagehide'];

        if ($_REQUEST['hide_image'] != "") {

            unlink("../uploads/profile_image/original/" . $_REQUEST['hide_image']);
            unlink("../uploads/profile_image/thumb/" . $_REQUEST['hide_image']);
            unlink("../uploads/profile_image/mid/" . $_REQUEST['hide_image']);

        }

        $img_size = filesize($_FILES['pimage']['tmp_name']);
        //echo $img_size;exit;
        if ($img_size > 2097152) //1048576 = 1MB
        {
            header("Location:sponser_member.php?edit=$uid&largeimage");
            exit;
        } else {
            $split_name = explode(".", $profile_image);
            //echo $split_name[1]; exit;
            if (($split_name[1] == 'jpg') || ($split_name[1] == 'jpeg') || ($split_name[1] == 'gif') || ($split_name[1] == 'png') || ($split_name[1] == 'JPG') || ($split_name[1] == 'JPEG') || ($split_name[1] == 'GIF') || ($split_name[1] == 'PNG')) {

                include("includes/resize-class.php");
                //echo "image ok "; exit;
                //$cate_img_very_small = "cat_very_small".date("dmY")."-".rand("100","999").".".$split_name[1];
                $cate_img_small = "pro" . date("dmY") . "-" . rand("100", "999") . "." . $split_name[1];
                $image_path = "../uploads/profile_image/thumb/";
                $image_path_thumb = "../uploads/profile_image/mid/";

                move_uploaded_file($_FILES['pimage']['tmp_name'], "../uploads/profile_image/original/" . $cate_img_small);

                //small image
                $resizeObj = new resize("../uploads/profile_image/original/" . $cate_img_small);

                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
                $resizeObj->resizeImage(150, 150, 'exact');

                $resizeObj->saveImage($image_path . $cate_img_small, 100);

                //very small image
                //$resizeObj = new resize($_FILES['cate_image']['tmp_name']);

                // *** 2) Resize image (options: exact, portrait, landscape, auto, crop) landscape
                $resizeObj->resizeImage(60, 60, 'exact');

                $resizeObj->saveImage($image_path_thumb . $cate_img_small, 100);

                //unlink("../uploads/".$feature_image);

                //echo $cate_img_very_small.", ".$cate_img_small; exit;
            } else {
                header("Location:sponser_member.php?edit=$uid&not-a-image");
                exit;
            }
        }
    }

    $insert = mysql_query("update mlm_register set user_fname='$fname',user_secondname='$secname',user_lname='$lname',user_dob='$date',user_phone='$phone',user_email='$email',user_accholdername='$holder',user_branch='$branch',user_ifsccode='$ifsccode',user_accno='$accno',user_bankname='$bank_name',user_commaddr1='$caddr1',user_commaddr2='$cddr2',user_city='$ccity',user_state='$cstate',user_country='$ccountry',user_postalcode='$czipcode' ,user_paddr1='$cpaddr1',user_paddr2='$cpddr2',user_pcity='$cpcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$cpzipcode',user_image='$cate_img_small' where user_id='1'");


    if ($insert) {
        // echo "testing;"; exit;
        header("Location:sponser_member.php?upsucc");
        ?>
        <script>
            window.location = "sponser_member.php?upsucc";
        </script>
        <?php

    }
}

if (isset($_REQUEST['update3'])) {

    //echo "testting";
    $uid = $_REQUEST['uid'];
    $nname = mysql_real_escape_string($_REQUEST['nname']);
    $ncountry = mysql_real_escape_string($_REQUEST['ncountry']);
    $nstate = mysql_real_escape_string($_REQUEST['nstate']);
    $ncity = mysql_real_escape_string($_REQUEST['ncity']);
    $nzipcode = mysql_real_escape_string($_REQUEST['nzipcode']);
    $nphone = mysql_real_escape_string($_REQUEST['nphone']);
    $nemail = mysql_real_escape_string($_REQUEST['nemail']);
    $naddr1 = mysql_real_escape_string($_REQUEST['naddr1']);
    $naddr2 = mysql_real_escape_string($_REQUEST['naddr2']);

    $ncnumber = mysql_real_escape_string($_REQUEST['ncnumber']);
    if ($_REQUEST['icid'] == "others") {
        $nct = mysql_real_escape_string($_REQUEST['nctype']);
    } else {
        $nct = mysql_real_escape_string($_REQUEST['icid']);
    }


    $insert = mysql_query("update mlm_register set user_nomineename='$nname',user_identifycardtype='$nct',user_idnumber='$ncnumber',user_naddr1='$naddr1',user_naddr2='$naddr2',user_ncountry='$ncountry',user_nstate='$nstate',user_ncity='$ncity',user_npostalcode='$nzipcode',user_nphone='$nphone',user_nemail='$nemail' where user_id='1'");


    if ($insert) {
        // echo "testing;"; exit;
        header("Location:sponser_member.php?success");
        ?>
        <script>
            window.location = "sponser_member.php?success";
        </script>
        <?php

    }
}

$edit = mysql_fetch_array(mysql_query("select * from mlm_register where user_id='1'"));
?>
<style>
    .label.arrowed-in:before {

        padding: 10px;
    }

    .label.arrowed-in-right:after {
        padding: 10px;
    }

</style>
<script>

    function card(val) {
        if (val == 'others') {
            document.getElementById('carrrrdtype').style.display = "block";

        } else {

            document.getElementById('carrrrdtype').style.display = "none";
        }


    }

</script>

<script>
    function nvalidate() {
        if (document.getElementById('nname').value == "") {
            alert("Please Enter Nominee Name");
            document.getElementById('nname').focus();
            return false;

        }

        if (document.getElementById('ncnumber').value == "") {
            alert("Please Enter identity card Number");
            document.getElementById('ncnumber').focus();
            return false;

        }

        if (document.getElementById('nphone').value == "") {
            alert("Please Enter Phone Number");
            document.getElementById('nphone').focus();
            return false;

        }

        if (document.getElementById('nemail').value == "") {
            alert("Please Enter the email address");
            document.getElementById('nemail').focus();
            return false;

        } else {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (re.test(document.getElementById('nemail').value) == false) {
                alert("Enter the Valid Email Address");
                document.getElementById('nemail').focus();
                document.getElementById('nemail').value = "";
                return false;
            }

        }


        if (document.getElementById('naddr1').value == "") {
            alert("Please Enter the address");
            document.getElementById('naddr1').focus();
            return false;

        }

        if (document.getElementById('ncountry').value == "") {
            alert("Please Enter the country");
            document.getElementById('ncountry').focus();
            return false;

        }

        if (document.getElementById('nstate').value == "") {
            alert("Please Enter the state");
            document.getElementById('nstate').focus();
            return false;

        }

        if (document.getElementById('ncity').value == "") {
            alert("Please Enter the city");
            document.getElementById('ncity').focus();
            return false;

        }

        if (document.getElementById('nzipcode').value == "") {
            alert("Please Enter the zipcode");
            document.getElementById('nzipcode').focus();
            return false;

        }


    }

</script>


<link rel="stylesheet" type="text/css" href="tcal.css"/>
<script type="text/javascript" src="tcal.js"></script>
<script>
    function uservalidate1() {
        if (document.getElementById('sname').value == "") {
            alert("please enter the sponser name");
            document.getElementById('sname').focus();
            return false;

        }

        if (document.getElementById('sid').value == "") {
            alert("please enter the sponser id");
            document.getElementById('sid').focus();
            return false;

        }

        if (document.getElementById('pass1').value == "") {
            alert("please enter the Password");
            document.getElementById('pass1').focus();
            return false;

        }

        if (document.getElementById('pass2').value == "") {
            alert("please enter the Confirm-Password");
            document.getElementById('pass2').focus();
            return false;

        }

        if (document.getElementById('pancard').value == "") {
            alert("please enter the Pancard Number");
            document.getElementById('pancard').focus();
            return false;

        }

        if (document.getElementById('pass1').value != document.getElementById('pass2').value) {
            alert("Password not Match !!!");
            document.getElementById('pass2').value = '';
            document.getElementById('pass2').focus();
            return false;
        }

        if (document.getElementById('position').value == "") {
            alert("please enter the Placement Position");
            document.getElementById('position').focus();
            return false;

        }


    }

</script>

<script>
    function showstate1(str) {
//alert("gfhfg");

        if (str == "") {
            alert("Please choose the communication country");
            document.getElementById("ncontry").focus();
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
        xmlhttp.open("GET", "state_ajax3.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script>
    function cityshow1(str) {
//alert("gfhfg");

        if (str == "") {
            alert("Please choose the communication State");
            document.getElementById("nstate").focus();
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
        xmlhttp.open("GET", "city_ajax3.php?q=" + str, true);
        xmlhttp.send();
    }
</script>
<script>

    function uservalidate2() {


        if (document.getElementById('fname').value == "") {
            alert("Enter the first Name");
            document.getElementById('fname').focus();
            return false;
        }

        if (document.getElementById('datee').value == "") {
            alert("Please Choose date of birth");
            document.getElementById('datee').focus();
            return false;
        }

        if (document.getElementById('phone').value == "") {
            alert("Enter the phone number");
            document.getElementById('phone').focus();
            return false;
        }

        if (document.getElementById('email').value == "") {
            alert("Please Enter the email address");
            document.getElementById('email').focus();
            return false;

        } else {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (re.test(document.getElementById('email').value) == false) {
                alert("Enter the Valid Email Address");
                document.getElementById('email').focus();
                document.getElementById('email').value = "";
                return false;
            }

        }

        if (document.getElementById('holder_name').value == "") {
            alert("Enter the name as per bank");
            document.getElementById('holder_name').focus();
            return false;
        }

        if (document.getElementById('accno').value == "") {
            alert("Enter the Account Number");
            document.getElementById('accno').focus();
            return false;
        }

        if (document.getElementById('bank_name').value == "") {
            alert("Enter the bank name");
            document.getElementById('bank_name').focus();
            return false;
        }

        if (document.getElementById('branch').value == "") {
            alert("Enter the branch name");
            document.getElementById('branch').focus();
            return false;
        }

        if (document.getElementById('ifsc_code').value == "") {
            alert("Enter the ifsc code");
            document.getElementById('ifsc_code').focus();
            return false;
        }

        if (document.getElementById('caddr1').value == "") {
            alert("Enter the communication Address");
            document.getElementById('caddr1').focus();
            return false;
        }

        if (document.getElementById('ccountry').value == "") {
            alert("Enter the communication country");
            document.getElementById('ccountry').focus();
            return false;
        }

        if (document.getElementById('cstate').value == "") {
            alert("Enter the communication state");
            document.getElementById('cstate').focus();
            return false;
        }

        if (document.getElementById('ccity').value == "") {
            alert("Enter the communication city");
            document.getElementById('ccity').focus();
            return false;
        }

        if (document.getElementById('czipcode').value == "") {
            alert("Enter the communication postalcode");
            document.getElementById('czipcode').focus();
            return false;
        }

        if (document.getElementById('cpaddr1').value == "") {
            alert("Enter the permanent Address");
            document.getElementById('cpaddr1').focus();
            return false;
        }

        if (document.getElementById('cpcountry').value == "") {
            alert("Enter the permanent country");
            document.getElementById('cpcountry').focus();
            return false;
        }

        if (document.getElementById('cpstate').value == "") {
            alert("Enter the permanent state");
            document.getElementById('cstate').focus();
            return false;
        }

        if (document.getElementById('cpcity').value == "") {
            alert("Enter the permanent city");
            document.getElementById('cpcity').focus();
            return false;
        }

        if (document.getElementById('cpzipcode').value == "") {
            alert("Enter the permanent postalcode");
            document.getElementById('cpzipcode').focus();
            return false;
        }

    }


</script>

<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">

    tinyMCE.init({

        // General options

        mode: "textareas",

        theme: "simple",

        plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options

        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,",


        theme_advanced_toolbar_location: "top",

        theme_advanced_toolbar_align: "left",

        theme_advanced_statusbar_location: "bottom",

        theme_advanced_resizing: false,


        // Example content CSS (should be your site CSS)

        content_css: "css/content.css",


        // Drop lists for link/image/media/template dialogs

        template_external_list_url: "lists/template_list.js",

        external_link_list_url: "lists/link_list.js",

        external_image_list_url: "lists/image_list.js",

        media_external_list_url: "lists/media_list.js",


        // Replace values for the template plugin

        template_replace_values: {

            username: "Some User",

            staffid: "991234"

        }

    });

</script>


<script>
    function showstate(str) {
//alert("gfhfg");

        if (str == "") {
            alert("Please choose the communication country");
            document.getElementById("ccontry").focus();
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
                document.getElementById("cstatee").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "state_ajax.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script>
    function showcity(str) {
//alert("gfhfg");

        if (str == "") {
            alert("Please choose the communication State");
            document.getElementById("cstate").focus();
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
                document.getElementById("ccityy").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "city_ajax.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script>
    function stateshow(str) {
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
                document.getElementById("cpstatee").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "state_ajax2.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script>
    function cityshow(str) {
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
                document.getElementById("cpcityy").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "city_ajax2.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<script>

    function commadrs() {
        var add1 = document.getElementById('caddr1').value;
        var add2 = document.getElementById('caddr2').value;
        var pc = document.getElementById('czipcode').value;
        var coon = document.getElementById('ccountry').value;
        var sttt = document.getElementById('cstate').value;
        var cttt = document.getElementById('ccity').value;

        if (document.getElementById('comm').checked == true) {
            document.getElementById('cpaddr1').value = add1;
            document.getElementById('cpaddr2').value = add2;
            document.getElementById('cpzipcode').value = pc;
            document.getElementById('cpcountry').value = coon;
            document.getElementById('cpstate').value = sttt;
            document.getElementById('cpcity').value = cttt;
        }

        if (document.getElementById('comm').checked == false) {
            document.getElementById('cpaddr1').value = "";
            document.getElementById('cpaddr2').value = "";
            document.getElementById('cpzipcode').value = "";
            document.getElementById('cpcountry').value = "";
            document.getElementById('cpstate').value = "";
            document.getElementById('cpcity').value = "";
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
                    <a href="user.php">Users</a>

                    <span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
                </li>
                <li class="active">Edit Users</li>
            </ul><!--.breadcrumb-->


        </div>

        <div class="page-content">
            <div class="page-header position-relative">
                <h1>
                    UPDATE SPONSER MEMBER DETAIL

                </h1>
            </div><!--/.page-header-->

            <div class="row-fluid">

                <div class="control-group">

                    <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">BASIC
                        INFORMATION </label>

                </div>

                <div class="span12">
                    <!--PAGE CONTENT BEGINS-->

                    <form class="form-horizontal" name="general" method="post" action=""
                          onsubmit="return uservalidate1();" enctype="multipart/form-data"/>
                    <!--<div class="control-group">
									<label class="control-label" for="form-field-1">Sponser Name &nbsp;<span style="color:#FF0000;">*</span> : </label>

									<div class="controls">
										<input type="text" name="sname" id="sname" value="<?php echo $edit['user_sponsername']; ?>"/>
									</div>
								</div>-->

                    <div class="control-group">
                        <label class="control-label" for="form-field-2">Profile id &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <span id="spid"><input type="text" name="sid" id="sid"
                                                   value="<?php echo $edit['user_profileid']; ?>" readonly/></span>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-2">PAN Card Number &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="pancard" id="pancard"
                                   value="<?php echo $edit['user_pancard']; ?>"/>

                        </div>
                    </div>
                    <div class="control-group">

                        <div class="form-actions">
                            <!--
                            --> <input type="submit" name="update1" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">


                            &nbsp; &nbsp; &nbsp;

                            <input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">

                        </div>

                    </div>


                    </form>
                </div>
            </div>
            <div class="row-fluid">

                <div class="control-group">

                    <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">PERSONAL
                        INFORMATION </label>

                </div>


                <div class="span12">
                    <!--PAGE CONTENT BEGINS-->

                    <form class="form-horizontal" name="general" method="post" action=""
                          onsubmit="return uservalidate1();" enctype="multipart/form-data"/>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">First Name &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="fname" id="fname" value="<?php echo $edit['user_fname']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-2">Second Name &nbsp;&nbsp;: </label>

                        <div class="controls">
                            <input type="text" name="secname" id="secname"
                                   value="<?php echo $edit['user_secondname']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-2">Last Name &nbsp;&nbsp;: </label>

                        <div class="controls">
                            <input type="text" name="lname" id="lname" value="<?php echo $edit['user_lname']; ?>"/>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-2">D.O.B &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="date" class="tcal" id="datee"
                                   value="<?php echo $edit['user_dob']; ?>"/>

                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Phone &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="phone" id="phone" value="<?php echo $edit['user_phone']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Email &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="email" id="email" value="<?php echo $edit['user_email']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Name as per Bank &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="holder_name" id="holder_name"
                                   value="<?php echo $edit['user_accholdername']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Bank Account No &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="accno" id="accno" value="<?php echo $edit['user_accno']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Bank Name &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="bank_name" id="bank_name"
                                   value="<?php echo $edit['user_bankname']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Branch &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="branch" id="branch" value="<?php echo $edit['user_branch']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> IFSC code &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="ifsc_code" id="ifsc_code"
                                   value="<?php echo $edit['user_ifsccode']; ?>"/>
                        </div>
                    </div>
                    <?php

                    if (file_exists("../uploads/profile_image/mid/" . $edit['user_image']) && $edit['user_image'] != '') {

                        $profile_image = "../uploads/profile_image/mid/" . $edit['user_image'];
                    } else {

                        $profile_image = "images/nouser.png";
                    }


                    ?>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Current Image &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="hidden" name="hide_image" id="hide_image"
                                   value="<?php echo $edit['user_image']; ?>"/>
                            <img src="<?php echo $profile_image; ?>" width="50" height="50"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Profile Image &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="file" name="pimage" id="pimage"/>
                        </div>
                    </div>


                    <div class="control-group">

                        <label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Communication Address </label>

                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 1 &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="caddr1" id="caddr1"
                                   value="<?php echo $edit['user_commaddr1']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 2 &nbsp; : </label>

                        <div class="controls">
                            <input type="text" name="caddr2" id="caddr2"
                                   value="<?php echo $edit['user_commaddr2']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Country &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <select name="ccountry" id="ccountry" onchange="return showstate(this.value);">
                                <option value="">--- Choose Country ---</option>
                                <?php

                                $sqlcon = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                while ($rowcountry = mysql_fetch_array($sqlcon)) {
                                    ?>
                                    <option value="<?php echo $rowcountry['country_id']; ?>" <?php if ($rowcountry['country_id'] == $edit['user_country']) { ?> selected="selected" <?php } ?>><?php echo $rowcountry['country_name']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">State &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls" id="cstatee">
                            <select name="cstate" id="cstate" onchange="return showcity(this.value);">
                                <option value="">--- Choose State ---</option>
                                <?php

                                $sqls = mysql_query("select * from mlm_state where state_status='0' and country_id='$edit[user_country]' order by state_name asc");
                                while ($rows = mysql_fetch_array($sqls)) {
                                    ?>
                                    <option value="<?php echo $rows['state_id']; ?>" <?php if ($rows['state_id'] == $edit['user_state']) { ?> selected="selected" <?php } ?>><?php echo $rows['state_name']; ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">City &nbsp;<span style="color:#FF0000;">*</span>
                            : </label>

                        <div class="controls" id="ccityy">
                            <select name="ccity" id="ccity">
                                <option value="">--- Choose City ---</option>

                                <?php

                                $sqlc = mysql_query("select * from mlm_city where city_status='0' and state_id='$edit[user_state]' order by city_name asc");
                                while ($rowc = mysql_fetch_array($sqlc)) {
                                    ?>
                                    <option value="<?php echo $rowc['city_id']; ?>" <?php if ($rowc['city_id'] == $edit['user_city']) { ?> selected="selected" <?php } ?>><?php echo $rowc['city_name']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Postal Code &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="czipcode" id="czipcode"
                                   value="<?php echo $edit['user_postalcode']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Permanent Address </label>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 1 &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="cpaddr1" id="cpaddr1" value="<?php echo $edit['user_paddr1']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 2 &nbsp; : </label>

                        <div class="controls">
                            <input type="text" name="cpaddr2" id="cpaddr2" value="<?php echo $edit['user_paddr2']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Country &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <select name="cpcountry" id="cpcountry" onchange="return stateshow(this.value);">
                                <option value="">--- Choose Country ---</option>
                                <?php

                                $sqlconn = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                while ($rowcounntry = mysql_fetch_array($sqlconn)) {
                                    ?>
                                    <option value="<?php echo $rowcounntry['country_id']; ?>" <?php if ($rowcounntry['country_id'] == $edit['user_pcountry']) { ?> selected="selected" <?php } ?>><?php echo $rowcounntry['country_name']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">State &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls" id="cpstatee">
                            <select name="cpstate" id="cpstate" onchange="return cityshow(this.value);">
                                <option value="">--- Choose State ---</option>
                                <?php
                                $sele = mysql_query("select * from mlm_state where state_status='0' and country_id='$edit[user_pcountry]' order by state_name asc");
                                while ($st = mysql_fetch_array($sele)) {
                                    ?>

                                    <option value="<?php echo $st['state_id']; ?>" <?php if ($st['state_id'] == $edit['user_pstate']) { ?> selected="selected" <?php } ?>><?php echo $st['state_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">City &nbsp;<span style="color:#FF0000;">*</span>
                            : </label>

                        <div class="controls" id="cpcityy">
                            <select name="cpcity" id="cpcity">
                                <option value="">--- Choose City ---</option>
                                <?php
                                $selc = mysql_query("select * from mlm_city where city_status='0' and state_id='$edit[user_pstate]' order by city_name asc");
                                while ($stc = mysql_fetch_array($selc)) {
                                    ?>

                                    <option value="<?php echo $stc['city_id']; ?>" <?php if ($stc['city_id'] == $edit['user_pcity']) { ?> selected="selected" <?php } ?>><?php echo $stc['city_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Postal Code &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="cpzipcode" id="cpzipcode"
                                   value="<?php echo $edit['user_ppostalcode']; ?>"/>
                        </div>
                    </div>


                    <input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['edit']; ?>"/>

                    <div class="form-actions">
                        <!--									<button class="btn btn-info" type="button">
                                                                <i class="icon-ok bigger-110"></i>
                                                                Submit
                                                            </button>
                        --> <input type="submit" name="update2" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">


                        &nbsp; &nbsp; &nbsp;
                        <!--<button class="btn" type="reset">
                            <i class="icon-undo bigger-110"></i>
                            Reset
                        </button>-->

                        <input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">

                    </div>
                    </form>
                </div>

            </div>
            <div class="row-fluid">

                <div class="control-group">

                    <label style="border:1px #CCCCCC solid; font-weight:bold; background-color:#4383B1; height:20px; color:#FFFFFF; padding:8px; font-size:14px;">NOMINEE
                        INFORMATION </label>

                </div>

                <div class="span12">
                    <!--PAGE CONTENT BEGINS-->
                    <form class="form-horizontal" name="general" method="post" action=""
                          onsubmit="return uservalidate1();" enctype="multipart/form-data"/>
                    <div class="control-group">
                        <label class="control-label" for="form-field-1"> Nominee Name &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="nname" id="nname"
                                   value="<?php echo $edit['user_nomineename']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-2">Identity Card Type &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="radio" name="icid" id="vcid" style="opacity:1;"
                                   value="Voters ID" <?php if ($edit['user_identifycardtype'] == 'Voters ID') { ?> checked="checked" <?php } ?>
                                   onclick="return card(this.value);"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voters ID
                            <input type="radio" name="icid" id="pcid" style="opacity:1;" value="PAN Card"
                                   onclick="return card(this.value);" <?php if ($edit['user_identifycardtype'] == 'PAN Card') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAN
                            Card <input type="radio" name="icid" id="psid" style="opacity:1;" value="Passport"
                                        onclick="return card(this.value);" <?php if ($edit['user_identifycardtype'] == 'Passport') { ?> checked="checked" <?php } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passport
                            <input type="radio" name="icid" id="dlid" style="opacity:1;" value="Driving License"
                                   onclick="return card(this.value);" <?php if ($edit['user_identifycardtype'] == 'Driving License') { ?> checked="checked" <?php } ?>/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Driving
                            License
                            <input type="radio" name="icid" id="otid" style="opacity:1;"
                                   value="others" <?php if (($edit['user_identifycardtype'] != 'Driving License') && ($edit['user_identifycardtype'] != 'Passport') && ($edit['user_identifycardtype'] != 'PAN Card') && ($edit['user_identifycardtype'] != 'Voters ID')) { ?>  checked="checked" <?php } ?>
                                   onclick="return card(this.value);"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Others
                        </div>
                    </div>

                    <div class="control-group" id="carrrrdtype">
                        <label class="control-label" for="form-field-2">Enter Card type &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="nctype" id="nctype"
                                   value="<?php echo $edit['user_identifycardtype']; ?>"/>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-2">Identity Card Number &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="ncnumber" id="ncnumber"
                                   value="<?php echo $edit['user_idnumber']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Phone &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="nphone" id="nphone" value="<?php echo $edit['user_nphone']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Email &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="nemail" id="nemail" value="<?php echo $edit['user_nemail']; ?>"/>
                        </div>
                    </div>


                    <div class="control-group">

                        <label style="border-bottom:1px #CCCCCC solid; font-weight:bold;">Communication Address </label>

                    </div>


                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 1 &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="naddr1" id="naddr1" value="<?php echo $edit['user_naddr1']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Address 2 &nbsp;&nbsp;: </label>

                        <div class="controls">
                            <input type="text" name="naddr2" id="naddr2" value="<?php echo $edit['user_naddr2']; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Country &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <select name="ncountry" id="ncountry" onchange="return showstate1(this.value);">
                                <option value="">--- Choose Country ---</option>
                                <?php

                                $nsqlcon = mysql_query("select * from mlm_country where country_status='0' order by country_name asc");
                                while ($nrowcountry = mysql_fetch_array($nsqlcon)) {
                                    ?>
                                    <option value="<?php echo $nrowcountry['country_id']; ?>" <?php if ($nrowcountry['country_id'] == $edit['user_ncountry']) { ?> selected="selected" <?php } ?>><?php echo $nrowcountry['country_name']; ?></option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">State &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls" id="nstatee">
                            <select name="nstate" id="nstate" onchange="return cityshow1(this.value);">
                                <option value="">--- Choose State ---</option>
                                <?php
                                $nsele = mysql_query("select * from mlm_state where state_status='0' and country_id='$edit[user_ncountry]' order by state_name asc");
                                while ($nst = mysql_fetch_array($nsele)) {
                                    ?>

                                    <option value="<?php echo $nst['state_id']; ?>" <?php if ($nst['state_id'] == $edit['user_nstate']) { ?> selected="selected" <?php } ?>><?php echo $nst['state_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">City &nbsp;<span style="color:#FF0000;">*</span>
                            : </label>

                        <div class="controls" id="ncityy">
                            <select name="ncity" id="ncity">
                                <option value="">--- Choose City ---</option>
                                <?php
                                $nselc = mysql_query("select * from mlm_city where city_status='0' and state_id='$edit[user_nstate]' order by city_name asc");
                                while ($nstc = mysql_fetch_array($nselc)) {
                                    ?>

                                    <option value="<?php echo $nstc['city_id']; ?>" <?php if ($nstc['city_id'] == $edit['user_ncity']) { ?> selected="selected" <?php } ?>><?php echo $nstc['city_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="form-field-1">Postal Code &nbsp;<span
                                    style="color:#FF0000;">*</span> : </label>

                        <div class="controls">
                            <input type="text" name="nzipcode" id="nzipcode"
                                   value="<?php echo $edit['user_npostalcode']; ?>"/>
                        </div>
                    </div>

                    <input type="hidden" name="uid" id="uid" value="<?php echo $_REQUEST['edit']; ?>"/>

                    <div class="form-actions">
                        <!--									<button class="btn btn-info" type="button">
                                                                <i class="icon-ok bigger-110"></i>
                                                                Submit
                                                            </button>
                        --> <input type="submit" name="update3" value="SUBMIT" class="btn btn-info" style="font-weight:bold;">


                        &nbsp; &nbsp; &nbsp;
                        <!--<button class="btn" type="reset">
                            <i class="icon-undo bigger-110"></i>
                            Reset
                        </button>-->

                        <input type="reset" name="reset" value="RESET" class="btn" style="font-weight:bold;">

                    </div>


                    </form>
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
