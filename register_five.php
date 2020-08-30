<?php include("config/error.php");
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $profileid = $_REQUEST['id'];
} else {
    header("Location:index.php");
    exit;
}
include("includes/head.php");
?>
<style>
    .barmenu ul li a:after {
        right: 15px;

    }

    .barmenu ul li:before {
        border-width: 0px;

    }

    .divclass {
        color: #000000;
        padding: 0;
        padding-left: 30px;
        padding-right: 0;
        font-size: 12px;
        font-weight: bold;
        font-family: Arial;
        line-height: 25px;
        margin: 0;

        top: 0;
        background: transparent;
    }
</style>
<script>
    function payvald(str) {
//alert(str);
        var pidd = document.getElementById('profileid').value;
//alert(pidd);
        if (str == "") {
            // alert("gdgfd");
            document.getElementById("payyv").innerHTML = "<font style='color:red;'>Please Enter the Payment Id</font>";
            document.getElementById("payid").focus();
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

                if (xmlhttp.responseText == 0) {
                    document.getElementById("payyv").innerHTML = "<font style='color:green;'> PaymentId is Valid, Please Proceed.</font>";

                } else {
                    document.getElementById("payyv").innerHTML = "<font style='color:red;'> PaymentId is Invalid, Please Try Again !!!</font>";
                    document.getElementById("payid").value = "";
                    document.getElementById("payid").focus();
                }


            }
        }
        xmlhttp.open("GET", "paymentid.php?q=" + str + "&pid=" + pidd, true);
        xmlhttp.send();
    }
</script>

<link href="tabmenu/tabmenu.css" rel="stylesheet" type="text/css"/>
<script src="tabmenu/tabmenu.js" type="text/javascript"></script>
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
                        <div class="span7">
                            <?php if (isset($_REQUEST['cancel'])) { ?>
                                <span style="color:#FF0000;">Transaction has been cancelled, Please try again!!!</span>
                            <?php }

                            ?>

                            <h2 class="widget-title"><span>Payment Option</span></h2>
                            <div class="sidebar-line"><span>
			</span></div>


                            <ul id="tabmenu" style="margin-bottom:20px;">
                                <li>
                                    <a href="javascript:void(0);">Online Payment</a>
                                    <ul>
                                        <li>
                                            <a href="paypal.php?id=<?php echo $_REQUEST['id']; ?>">
                                                <img src="images/paypal.jpeg" style="width:120px; cursor:pointer;"
                                                     alt="Paypal">

                                            </a><br>
                                            <a href="javascript:void(0);" style="text-decoration:none; color:#CCCCCC; ">Click
                                                image to pay the amount using paypal</a></li>


                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Offline Payment</a>
                                    <ul>
                                        <form class="register-form" method="post" action="registerfunc.php">
                                            <li>

                                                <div style="margin-top:30px;">
                                                    <div style="float:left;" class="divclass">Enter Payment Id <span
                                                                style="color:#FF0000;">*</span></div>
                                                    <div style="float:left;" class="divclass"> : &nbsp;&nbsp;</div>
                                                    <div style="float:left;"><input type="text" name="payid" id="payid"
                                                                                    onBlur="return payvald(this.value);"
                                                                                    required='required'>
                                                        <br>
                                                        <div id="payyv" class="divclass"
                                                             style="margin-left:-30px;"></div>

                                                    </div>
                                                    <div style="clear:both;">&nbsp;</div>
                                                </div>

                                                <br>
                                                <div style="margin-left:30px;">
                                                    <input type="hidden" name="profileid" id="profileid"
                                                           value="<?= $_REQUEST['id']; ?>"/>
                                                    <input type="hidden" name="paytype" id="paytype" value="1">
                                                    <button class="btn btn-primary" name="registrationfive"
                                                            id="registrationfive" type="submit"
                                                            style="margin-right:5px;">Submit
                                                    </button>&nbsp;&nbsp;
                                                    <button class="btn btn-inverse" type="reset">Reset</button>
                                                    <br><br>
                                                </div>
                                                <div style="border-bottom:1px solid #CCCCCC;">&nbsp;</div>
                                            </li>


                                            <li style="z-index:5; opacity:1;">
                                                <div class="divclass">
                                                    <span style="border-bottom:1px solid #CCCCCC;"> BANK ACCOUNT DETAILS</span>
                                                    <br><span
                                                            style="font-weight:normal; text-align:justify; color:#666666;">Make a payment using below bank Details, after payment admin send payment id , use that payment id complete the registration.</span>
                                                </div>

                                                <?php
                                                $memsql = "select * from mlm_bankdetails where status='0' ";
                                                $memqry = mysql_query($memsql);
                                                $i = 1;

                                                while ($memrow = mysql_fetch_array($memqry)) {
                                                    ?>

                                                    <div class="divclass"
                                                         style="font-weight:normal; line-height:25px; margin-bottom:10px;">
                                                        <table style="background-color:#F2F2F2; border:1px #CCCCCC solid; border-radius:10px; width:430px; min-height:100px; ">
                                                            <tr>
                                                                <td style="width:130px; padding:5px;" align="left">
                                                                    <table>
                                                                        <tr>

                                                                            <td>
                                                                                <strong style="color:#C40B06;"><?php echo $memrow['bank_name']; ?></strong>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <img src="uploads/banklogo/<?php echo $memrow['bank_logo']; ?>"
                                                                                     style="width:120px; height:80px; ">
                                                                            </td>
                                                                        </tr>

                                                                    </table>

                                                                </td>

                                                                <td style="width:300px;" align="left">
                                                                    <table>


                                                                        <tr>
                                                                            <td>Account Holder Name</td>
                                                                            <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                            <td>
                                                                                <strong><?php echo $memrow['account_name']; ?></strong>
                                                                            </td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td>Branch Name</td>
                                                                            <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                            <td>
                                                                                <strong><?php echo $memrow['branch_name']; ?></strong>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>Account Number</td>
                                                                            <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                            <td>
                                                                                <strong><?php echo $memrow['account_number']; ?></strong>
                                                                            </td>

                                                                        </tr>

                                                                        <tr>
                                                                            <td>IFSC Code</td>
                                                                            <td>:&nbsp;&nbsp;&nbsp;</td>
                                                                            <td>
                                                                                <strong><?php echo $memrow['ifsci']; ?></strong>
                                                                            </td>

                                                                        </tr>

                                                                    </table>


                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </div>
                                                <?php } ?>


                                            </li>


                                    </ul>
                                </li>
                                </form>


                            </ul>


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
<?php if (isset($_SESSION['choosedproid'])) { ?>
    <script language="javascript">
        getproductvalue(<?php $ppid?>);
    </script>
<?php } ?>

</body>
</html>