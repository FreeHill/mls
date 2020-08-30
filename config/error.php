<?php
session_start();
error_reporting(0);
$db_host = "localhost";
$db_username = "myauctio_mls";
$db_pwd = "D7I255DuYMYK";
$db_name = "myauctio_mls";
$conn = @mysql_connect($db_host, $db_username, $db_pwd);
$db = @mysql_select_db($db_name, $conn);
//$conn= new mysqli_connect($db_host,$db_username,$db_pwd);
//$db = new mysqli_select_db($conn,$db_name);


//include "db_configue.php";


$gsetting = mysql_query("select * from mlm_generalsetting where gen_id='1'");


$generalfetch = mysql_fetch_array($gsetting);

$website_title = $generalfetch['gen_title'];

$website_name = $generalfetch['gen_sitename'];

$website_keywords = $generalfetch['gen_keywords'];

$website_desc = $generalfetch['gen_desc'];

$website_team = $generalfetch['gen_team'];

$website_admin = $generalfetch['gen_mail'];

$website_url = $generalfetch['gen_url'];

$paypal_id = $generalfetch['gen_paypal'];

$sitelogo = $generalfetch['gen_logo'];

$logourl = $website_url . "/uploads/logo/" . $sitelogo;

$fblink = "";
$twitlink = "";
$skyplink = "";
$gpluslink = "";

$gen_cvvalue = $generalfetch['gen_cvvalue'];

$gen_minwithdraw = $generalfetch['gen_minwithdraw'];

$gen_fundtransfer = $generalfetch['gen_fundtransfer'];

$gen_tax = $generalfetch['gen_tax'];

$gen_ceilcount = $generalfetch['gen_ceilcount'];


$gen_startvalue = $generalfetch['gen_startvalue'];

$gen_need_reach = $generalfetch['gen_need_reach'];

$gen_maintain = $generalfetch['gen_maintain'];


function getPageName()
{

    return basename($_SERVER['PHP_SELF']);

}


function generateid()

{

    $selectregcount = mysql_fetch_array(mysql_query("SELECT * FROM mlm_regcountnew WHERE reg_id=1"));

    $renewdate = explode("-", $selectregcount['reg_date']);

    $currmonth = date("m");

    $currentyear = date("Y");

    if (($renewdate[0] < $currentyear) || ($renewdate[1] < $currmonth)) {

        $updateregcount = mysql_query("UPDATE mlm_regcountnew SET reg_count=1, reg_date=NOW() WHERE reg_id=1");

        return $currentyear . $currmonth . "1";

    } else {

        $currentcount = $selectregcount['reg_count'] + 1;

        $updateregcount = mysql_query("UPDATE mlm_regcountnew SET reg_count=$currentcount WHERE reg_id=1");

        return $renewdate[0] . $renewdate[1] . $selectregcount['reg_count'];

    }

}


function GetUserNameFromId($userid)

{

    $select_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'");


    $fetch_userid = mysql_fetch_array($select_userid);

    return $fetch_userid['user_fname'] . " " . $fetch_userid['user_lname'];


}

function GetmemberFromId($type)

{

    $select = mysql_query("SELECT * FROM `mlm_membership` WHERE `id`='$type'");


    $fetch_mem = mysql_fetch_array($select);

    return $fetch_mem['membership_name'];


}

function Getproductname($idd)

{

    $select = mysql_query("SELECT pro_name FROM `mlm_products` WHERE `pro_id`='$idd'");


    $fetch_mem = mysql_fetch_array($select);

    return $fetch_mem['pro_name'];


}

function Getprofileimage($proid)

{

    $select = mysql_query("SELECT user_image FROM `mlm_register` WHERE `user_profileid`='$proid'");


    $fetch_mem = mysql_fetch_array($select);


    if (file_exists("uploads/profile_image/mid/" . $fetch_mem['user_image']) && $fetch_mem['user_image'] != '') {

        return $product_image = "uploads/profile_image/mid/" . $fetch_mem['user_image'];

    } else {

        return $product_image = "images/nouser.png";

    }


}

function Getproductimage($idd)

{

    $select = mysql_query("SELECT pro_logo FROM `mlm_products` WHERE `pro_id`='$idd'");


    $fetch_mem = mysql_fetch_array($select);


    if (file_exists("../uploads/products/logo/mid/" . $fetch_mem['pro_logo']) && $fetch_mem['pro_logo'] != '') {

        return $product_image = "../uploads/products/logo/mid/" . $fetch_mem['pro_logo'];

    } else {

        return $product_image = "../images/noproduct_image.jpg";

    }


}

function Getproductbonus($idd)

{

    $select = mysql_query("SELECT pro_bonus FROM `mlm_products` WHERE `pro_id`='$idd'");


    $fetch_mem = mysql_fetch_array($select);

    return $fetch_mem['pro_bonus'];


}

function GetUserIDPosFromId($userid, $pos)

{


    $select_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'");

    $userid_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'"));

    if ($userid_num > 0) {

        $fetch_userid = mysql_fetch_array($select_userid);

        return $fetch_userid['user_profileid'];

    } else {

        return 0;

    }


}

function Getprofileimageadmin($proid)
{
    $select = mysql_query("SELECT user_image FROM `mlm_register` WHERE `user_profileid`='$proid'");

    $fetch_mem = mysql_fetch_array($select);

    if (file_exists("../uploads/profile_image/mid/" . $fetch_mem['user_image']) && $fetch_mem['user_image'] != '') {
        return $product_image = "../uploads/profile_image/mid/" . $fetch_mem['user_image'];
    } else {
        return $product_image = "images/nouser.png";
    }

}


function SunGetUserNameFromId($userid)

{

    $select_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'");

    $userid_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'"));

    if ($userid_num > 0) {

        $fetch_userid = mysql_fetch_array($select_userid);

        return $fetch_userid['user_fname'];

    } else {

        return "Empty";

    }

}


function SunfGetUserNamePosFromId($userid)

{

    //echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid'";

    $select_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid'");

    $userid_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid' "));

    if ($userid_num > 0) {

        while ($fetch_userid = mysql_fetch_array($select_userid)) {

            echo $fetch_userid['user_fname'];

        }

    } else {

        return "Empty";

    }

}


function SunfGetUserIDPosFromId($userid)

{

    //echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid' ";

    $select_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid' ");

    $userid_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'"));

    if ($userid_num > 0) {

        while ($fetch_userid = mysql_fetch_array($select_userid)) {

            return $fetch_userid['user_sponserid'];

        }

    } else {

        return 0;

    }


}


function getcity($city)

{

    $select_city = mysql_query("SELECT * FROM `mlm_city` WHERE `city_id`='$city' ");

    $city_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_city` WHERE `city_id`='$city'"));

    if ($city_num > 0) {

        $fetch_city = mysql_fetch_array($select_city);

        {

            return $fetch_city['city_name'];

        }

    } else {

        return "Not Mentioned";

    }


}


function getstate($state)

{

    $select_state = mysql_query("SELECT * FROM `mlm_state` WHERE `state_id`='$state' ");

    $state_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_state` WHERE `state_id`='$state'"));

    if ($state_num > 0) {

        $fetch_state = mysql_fetch_array($select_state);

        {

            return $fetch_state['state_name'];

        }

    } else {

        return "Not Mentioned";

    }


}


function getcountry($country)

{

    $select_country = mysql_query("SELECT * FROM `mlm_country` WHERE `country_id`='$country' ");

    $country_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_country` WHERE `country_id`='$country'"));

    if ($country_num > 0) {

        $fetch_country = mysql_fetch_array($select_country);

        {

            return $fetch_country['country_name'];

        }

    } else {

        return "Not Mentioned";

    }


}


// This function updates the total number of referrals the sponser has
function regcount($userid, $profileid, $sponsorid)

{


    //echo $userid."-".$profileid."-".$sponsorid; exit;


    $sel_userid = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$sponsorid'");

    $fet_user = mysql_fetch_array($sel_userid);


    $coureg = mysql_query("select * from mlm_reg_count where reg_profileid='$sponsorid'");


    $sdfds = mysql_fetch_array($coureg);

    $coun = mysql_num_rows($coureg);


    if ($coun == '0') {

        $inss = mysql_query("insert into mlm_reg_count set reg_profileid='$sponsorid',reg_refcount='1'");


    } else {

        $aal = $sdfds['reg_refcount'] + 1;


        $inss = mysql_query("update mlm_reg_count set reg_refcount='$aal' where reg_profileid='$sponsorid'");

    }


}


function member($type)

{

    $mem = mysql_fetch_array(mysql_query("select * from mlm_membership where id='$type'"));

    echo $mem['membership_name'];

}


function Getmembetshipfromprofileid($type)

{


    $user = mysql_fetch_array(mysql_query("select user_membership from mlm_register where user_profileid='$type'"));


    $mem = mysql_fetch_array(mysql_query("select * from mlm_membership where id=$user[user_membership]"));

    echo $mem['membership_name'];

}

function Getmembetshipcount($type)

{


    $user = mysql_fetch_array(mysql_query("select user_membership from mlm_register where user_profileid='$type'"));


    $mem = mysql_fetch_array(mysql_query("select * from mlm_membership where id=$user[user_membership]"));

    echo $mem['refferal_count'];

}

function directrefferalcount($sponser)

{

    $qur = mysql_query("select user_id from mlm_register where user_sponserid='$sponser'");

    $refcount = mysql_num_rows($qur);

    echo $refcount;

}


function refbonus($profileid)

{

    $selusr = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$profileid'"));

    $selpay = mysql_fetch_array(mysql_query("select * from mlm_offlinepayment where email_id ='$selusr[user_email]'"));

    $selmem = mysql_fetch_array(mysql_query("select * from mlm_paymembers where mempay_userid='$profileid'"));


    $selusrs = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$selusr[user_sponserid]'"));

    $regpur = $selusrs['totalreference_bonus'];


    $mem1 = mysql_fetch_array(mysql_query("select * from mlm_membership where id=$selusr[user_membership]"));

    $mem2 = mysql_fetch_array(mysql_query("select * from mlm_membership where id=$selusrs[user_membership]"));


    $mamt1 = $mem1['act_amount'];

    $mper = $mem2['referance_percentage'];


    $per = $mamt1 * ($mper / 100);


    $totamt = $per + $regpur;


    $upper = mysql_query("update mlm_register set totalreference_bonus='$totamt' where user_profileid='$selusr[user_sponserid]'");


    $refbonnns = mysql_query("insert into mlm_payoutcalc set pay_user='$selusr[user_sponserid]',pay_amount='$per',pay_reason='Referral Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='1'");


}


function productbonus($pid, $profileid)

{

    $selusr = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$profileid'"));


    $selpro = mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$pid'"));


    $selusrs = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$selusr[user_sponserid]'"));


    $dfhds = $selusrs['totalindirect_purbonus'];


    $pamt1 = $selusr['totalpurchase_bonus'];


    $pamt2 = $selpro['pro_cost'];


    //$pper=$pamt2*($mper/100);

    $ppamt = $selpro['pro_bonus'];


    $ippamt = $selpro['pro_indirect_bonus'];


    $intotamt = $dfhds + $ippamt;


    $totamt = $pamt1 + $ppamt;


    $uppper = mysql_query("update mlm_register set totalpurchase_bonus='$totamt' where user_profileid='$profileid'");


    $ssuppper = mysql_query("update mlm_register set totalindirect_purbonus='$intotamt' where user_profileid='$selusr[user_sponserid]'");


    $purbonnns = mysql_query("insert into mlm_payoutcalc set pay_user='$profileid', 	pay_purchaseid='$pid',pay_amount='$ppamt',pay_reason='Purchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='0'");


    $inpurbonnns = mysql_query("insert into mlm_payoutcalc set pay_user='$selusr[user_sponserid]',pay_purchaseid='$pid',pay_amount='$ippamt',pay_reason='Indirect Purchase Bonus',pay_calc_status='1',pay_date=NOW(),bonus_type='3'");


}

function sendmail($name, $email, $logourl, $website_name, $website_url, $website_admin)
{


    //echo $name."-".$email."-".$logourl."-".$website_name."-".$website_url."-".$website_admin; exit;
    $subject = "Upgrade Membership";

    $msg = "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #d64b14; width:550px;'>
			<tr bgcolor='#D64B14' height='25'>
				<td><img src=" . $logourl . " border='0' width='200' height='60' /></td>
			</tr>
							<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
							<tr bgcolor='#FFFFFF' height='30'>
							<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Dear $name</b></td>
							</tr>
	
								
								<tr bgcolor='#FFFFFF' height='35'>
							<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your Membership referral count exist the limit,please upgrade your membership imidiately otherwise you does not refer any one. 	</td>
							</tr>
							
							<tr bgcolor='#FFFFFF' height='35'>
							<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Click <a href='$website_url/login.php' >Here</a> to upgrade your membership</td>
							</tr>
						
					
								<tr bgcolor='#FFFFFF'>
				<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
					" . $website_name . "<br>
				</td>
			
			</tr>
							<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
							<tr height='40'>
			
	<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#D64B14;
	color: #FFFFFF;'>&copy; Copyright " . date("Y") . "&nbsp;" . "<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>" . $website_name . "</a>." . "
	</td>
	</tr>
	</table>";

    ini_set("SMTP", "mail.i-netsolution.com");
    $headers = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From:' . $website_name . '<' . $website_admin . '>' . "\r\n";


    mail($email, $subject, $msg, $headers);


}

//Direct Refferal Amount
function DirectRefAmount($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT SUM(amount) as dirtotal FROM `mlm_mem_amount` WHERE `is_direct`='1' AND `memid`='$user_profileid'"));
    return $usr_refdamt['dirtotal'];
}

//In Direct Refferal Amount
function InDirectRefAmount($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT SUM(amount) as indtotal FROM `mlm_mem_amount` WHERE `is_direct`='2' AND `memid`='$user_profileid'"));
    return $usr_refdamt['indtotal'];
}

//Outside Bonus Amount
function OutSideBonus($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT SUM(amount) as outbonus FROM `mlm_mem_amount` WHERE `is_direct`='3' AND `memid`='$user_profileid'"));
    return $usr_refdamt['outbonus'];
}

//Total Bonus Amount Paid
function TotalPaid($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT SUM(amount) as totalpaid FROM `mlm_mem_amount` WHERE `is_paid`='1' AND `memid`='$user_profileid'"));
    return $usr_refdamt['totalpaid'];
}

//Total Bonus Amount UnPaid
function TotalUnPaid($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT SUM(amount) as totalunpaid FROM `mlm_mem_amount` WHERE `is_paid`='0' AND `memid`='$user_profileid'"));
    return $usr_refdamt['totalunpaid'];
}


// Check the user whether he/she is from outside state
function IsOutsideBonus($user_profileid)
{
    $usr_state = mysql_query("SELECT user_state FROM `mlm_register` WHERE `user_profileid`='$user_profileid'");
    $ustate = $usr_state['user_state'];
    $stcnt = mysql_num_rows(mysql_query("select * from mlm_exemp_state where statecode=$ustate"));
    if ($stcnt >= 1) {
        return 1;
    } else {
        return 0;
    }
}

// Member Reward ID

function MemberRewardId($user_profileid)
{
    $usr_refdamt = mysql_fetch_array(mysql_query("SELECT user_rewardid FROM `mlm_register` WHERE `user_profileid`='$user_profileid'"));
    return $usr_refdamt['user_rewardid'];
}

// get top Member id from user_id
function GetTopMemberID()
{
    $userid = mysql_fetch_array(mysql_query("SELECT user_profileid FROM `mlm_register` WHERE `user_id`='1'"));
    return $userid['user_profileid'];
}


?>
