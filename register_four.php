<?php include("config/error.php");
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $profileid = $_REQUEST['id'];
} else {
    header("Location:index.php");
    exit;
}
include("includes/head.php");

$sesvall = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$_SESSION[profileid]'"));

$sesmem = mysql_fetch_array(mysql_query("select * from mlm_membership where id='$sesvall[user_membership]'"));

?>


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
                                <?php
                                if ((!isset($_SESSION['profileid'])) && (!isset($_SESSION['userid']))) {
                                    ?>

                                    <ul>
                                        <li class="active"><a href="#">Step1</a></li>
                                        <li class="active"><a href="#">Step2</a></li>
                                        <li class="active"><a href="#">Step3</a></li>
                                        <li class="active"><a href="#">Step4</a></li>

                                    </ul>
                                <?php } ?>
                            </div>
                            <h2 class="widget-title"><span><?php
                                    if ((!isset($_SESSION['profileid'])) && (!isset($_SESSION['userid']))) {
                                        ?>Step 4* <?php } ?>(Membership details)</span></h2>
                            <div class="sidebar-line"><span></span></div>

                            <form class="register-form" method="post" action="registerfunc.php">
                                <label for="inputEmail"><span class="required">*</span> Membership list</label>
                                <table>

                                    <tr>
                                        <?php
                                        $sqlmem = "select * from mlm_membership where status='0' order by id asc";
                                        $qrymem = mysql_query($sqlmem);
                                        $i = 1;
                                        while ($rowmem = mysql_fetch_array($qrymem))
                                        {

                                        ?>

                                        <td>
                                            <table style=" background-color:#FFFFFF; width:230px; height:180px; border-radius:8px; margin:5px;">
                                                <tr style="border-bottom:1px #FF0000 solid;">
                                                    <td style="color: #E11E13; padding-left:10px; font-weight:bold;">
                                                        <input type="radio" name="memid" id="memid"
                                                               value="<?php echo $rowmem['id']; ?>"<?php if ($sesvall['user_membership'] >= $rowmem['id']) { ?> checked disabled<?php } ?>>&nbsp;<?php echo $rowmem['membership_name']; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding-left:10px;">
                                                        Referral Type :
                                                        <strong><?php if ($rowmem['refer_type'] == '1') {
                                                                echo "Limited";
                                                            } else if ($rowmem['refer_type'] == '2') {
                                                                echo "Unlimited";
                                                            } else {
                                                                echo "Not Mentioned";
                                                            } ?></strong>
                                                    </td>

                                                </tr>
                                                <?php
                                                if ($rowmem['refer_type'] != '2') { ?>
                                                    <tr>
                                                        <td style="padding-left:10px;">
                                                            Referrals : <strong><?php echo $rowmem['refferal_count']; ?>
                                                                Members</strong>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td style="padding-left:10px;">
                                                        Referrals Percentage :
                                                        <strong><?php echo $rowmem['referance_percentage']; ?>
                                                            %</strong>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td style="padding-left:10px;">
                                                        Indirect Income :
                                                        <strong><?php echo $rowmem['indirect_reference']; ?> %</strong>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td style="padding-left:10px;">
                                                        Amount :
                                                        <strong>Rs. <?php echo $rowmem['act_amount']; ?> </strong>
                                                    </td>

                                                </tr>

                                            </table>


                                        </td>
                                        <?php

                                        if ($i % 2 == 0)
                                        {

                                        ?>

                                    </tr>
                                    <tr>

                                        <?php } ?>

                                        <?php $i++;
                                        } ?>
                                    </tr>
                                </table>


                                <br style="clear:both;"><br>

                                <input type="hidden" name="profileid" value="<?= $profileid ?>"/>

                                <button class="btn btn-primary" name="registrationfour" id="registrationfour"
                                        type="submit">Pay Now
                                </button>
                                <button class="btn btn-inverse" type="reset">Reset</button>
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
<?php if (isset($_SESSION['choosedproid'])) { ?>
    <script language="javascript">
        getproductvalue(<?=$ppid?>);
    </script>
<?php } ?>

</body>
</html>