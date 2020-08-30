<?php
include("config/error.php");

include("generalfunc.php");


/* =============== Registration step - 1 =================== */

if (isset($_REQUEST['registerone'])) {
    //echo "test";exit;

//    Variables from register.php
        $captcha_code = $_SESSION['security_code'];
        $security_code = $_POST['security_code'];

//    compare captcha values
        if($captcha_code != $security_code){
            header("Location:register.php");
            echo '<script type=text/javascript> window.location="register.php"; </script>';
            exit;

        }


    $sponsorname = $_REQUEST['sponsorname'];
    $sponsorid = $_REQUEST['sponsorid'];
    $password = $_REQUEST['password'];
    $passwordagain = $_REQUEST['passwordagain'];
    $placementid = $_REQUEST['placementid'];
    $placementposition = $_REQUEST['placementposition'];
    $pancardnum = $_REQUEST['pancardnum'];

//    $profileid = generateid();


    $ip = $_SERVER['REMOTE_ADDR'];
    $validity = mysql_fetch_array(mysql_query("select validity from mlm_subscription"));

    $val = $validity['validity'];
    $exp = date("Y-m-d");
    $new_exp = date("Y-m-d", strtotime("$exp + $val month"));

    $insert = mysql_query("INSERT INTO mlm_register (user_profileid, user_password, user_sponsername,
                          user_sponserid, user_placementid, user_placement, user_subexpiry, user_pancard, user_date,
                          user_ip, user_status) VALUES ('$profileid', '$password', '$sponsorname', '$sponsorid', 
                                                        '$placementid', '$placementposition', '$new_exp', 
                                                        '$pancardnum', NOW(), '$ip', '5')");

   $id = mysql_insert_id();

    regcount($id, $profileid, $sponsorid);


    if ($insert) {
        header("Location:register_two.php?id=$profileid");
        echo '<script language="javascript"> window.location="register_two.php?id=' . $profileid . '"; </script>';
        exit;
    } else {
        die("Registration error please contact admin : <br>" . mysql_error());
        exit;
    }


}

/* =============== Registration step - 2 =================== */

if (isset($_REQUEST['registrationtwo'])) {
    //echo "test";
    $firstname = $_REQUEST['firstname'];
    $secondname = $_REQUEST['secondname'];
    $lastname = $_REQUEST['lastname'];
    $dobdate = $_REQUEST['dobdate'];
    $dobmonth = $_REQUEST['dobmonth'];
    $dobyear = $_REQUEST['dobyear'];

    $addressline1 = $_REQUEST['addressline1'];
    $addressarea = $_REQUEST['addressarea'];
    $addresscity = $_REQUEST['addresscity'];
    $addressstate = $_REQUEST['addressstate'];
    $addresspostal = $_REQUEST['addresspostal'];
    $addresscountry = $_REQUEST['addresscountry'];


    $padddress1 = $_REQUEST['padddress1'];
    $padddress2 = $_REQUEST['padddress2'];
    $cpcity = $_REQUEST['cpcity'];
    $cpstate = $_REQUEST['cpstate'];
    $pzipcode = $_REQUEST['pzipcode'];
    $cpcountry = $_REQUEST['cpcountry'];


    $phonenum = $_REQUEST['phonenum'];
    $emailaddress = $_REQUEST['emailaddress'];
    $bankaccname = $_REQUEST['bankaccname'];
    $accnum = $_REQUEST['accnum'];
    $bankname = $_REQUEST['bankname'];
    $branchname = $_REQUEST['branchname'];
    $ifsc = $_REQUEST['ifsc'];
    $profileid = $_REQUEST['profileid'];
    $dob = $dobyear . "-" . $dobmonth . "-" . $dobdate;

    //echo $firstname." - ".$secondname." - ".$lastname." - ".$dobdate." - ".$dobmonth." - ".$dobyear." - ".$addressline1." - ".$addressarea." - ".$addresscity." - ".$addressstate." - ".$addresspostal." - ".$addresscountry." - ".$phonenum." - ".$emailaddress." - ".$bankaccname." - ".$accnum." - ".$bankname." - ".$branchname." - ".$ifsc." - ".$profileid;exit;

    $update = mysql_query("UPDATE mlm_register SET user_fname='$firstname', user_lname='$lastname', user_secondname='$secondname', user_dob='$dob', user_commaddr1='$addressline1', user_city='$addresscity', user_state='$addressstate', user_country='$addresscountry', user_postalcode='$addresspostal', user_phone='$phonenum', user_email='$emailaddress', user_accholdername='$bankaccname', user_accno='$accnum', user_bankname='$bankname', user_branch='$branchname', user_ifsccode='$ifsc',user_paddr1='$padddress1',user_paddr2='$padddress2',user_pcity='$cpcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$pzipcode' WHERE user_profileid='$profileid'");

    if ($update) {
        header("Location:register_three.php?id=$profileid");
        echo '<script language="javascript"> window.location="register_three.php?id=' . $profileid . '"; </script>';
        exit;
    } else {
        die("Registration error your id is $profileid tell administrator about this : <br>" . mysql_error());
    }

}

/* =============== Registration step - 3 =================== */

if (isset($_REQUEST['registrationthree'])) {
    //echo "test three";exit;
    $nomname = $_REQUEST['nomname'];
    $idcardtype = $_REQUEST['idcardtype'];
    $idcardtypename = (isset($_REQUEST['idcardtypename'])) ? $_REQUEST['idcardtypename'] : '';
    $idcardnum = $_REQUEST['idcardnum'];
    $nomaddress = $_REQUEST['nomaddress'];
    $nomarea = $_REQUEST['nomarea'];
    $nomcity = $_REQUEST['nomcity'];
    $nomstate = $_REQUEST['nomstate'];
    $nompostal = $_REQUEST['nompostal'];
    $nomcountry = $_REQUEST['nomcountry'];
    $nomphone = $_REQUEST['nomphone'];
    $nomemail = $_REQUEST['nomemail'];
    $profileid = $_REQUEST['profileid'];

    if ($idcardtype != 'others') {
        $idcardtypename = $idcardtype;
    }

    //echo $nomname." - ".$idcardtype." - ".$idcardtypename." - ".$idcardnum." - ".$nomaddress." - ".$nomarea." - ".$nomcity." - ".$nomstate." - ".$nompostal." - ".$nomcountry." - ".$nomphone." - ".$nomemail." - ".$profileid;exit;

    $update = mysql_query("UPDATE mlm_register SET user_nomineename='$nomname', user_identifycardtype='$idcardtypename', user_idnumber='$idcardnum', user_naddr1='$nomaddress', user_naddr2='$nomarea', user_ncity='$nomcity', user_nstate='$nomstate', user_ncountry='$nomcountry', user_npostalcode='$nompostal', user_nphone='$nomphone', user_nemail='$nomemail',user_status='1' WHERE user_profileid='$profileid'");


    if ($update) {
        header("Location:register_four.php?id=$profileid");
        echo '<script language="javascript"> window.location="register_four.php?id=' . $profileid . '"; </script>';
        exit;
    } else {
        die("Registration error your id is $profileid tell administrator about this error : <br>" . mysql_error());
    }

}

/* =============== Registration step - 4 =================== */

if (isset($_REQUEST['registrationfour'])) {
    //echo "test four"; exit;
    $product = $_REQUEST['memid'];
    $profileid = $_REQUEST['profileid'];

    $selmem = mysql_fetch_array(mysql_query("select * from mlm_membership where id='$product'"));

    $amount = $selmem['act_amount'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $ins = mysql_query("insert into mlm_paymembers set mempay_userid='$profileid',mempay_memid='$product',mempay_amount='$amount',mempay_date=NOW(),mempay_ip='$ip',mempay_paystatus='0'");

    $update = mysql_query("UPDATE mlm_register SET user_status='1',user_membership='$product',user_paystatus='0' WHERE user_profileid='$profileid'");

    //$statususr=mysql_query("INSERT INTO mlm_user_status (usr_user) VALUES ('$profileid')");


    if ($ins) {

        header("Location:register_five.php?id=$profileid");
        echo '<script language="javascript"> window.location="register_five.php?id=' . $profileid . '"; </script>';
        exit;
    }

}


/* =============== Registration step -5  =================== */
if (isset($_REQUEST['registrationfive'])) {
    //echo "test four"; exit;
    $payid = $_REQUEST['payid'];
    $profileid = $_REQUEST['profileid'];
    $paytype = $_REQUEST['paytype'];

    $selusr = mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$profileid'"));
    $selpay = mysql_fetch_array(mysql_query("select * from mlm_offlinepayment where email_id ='$selusr[user_email]'"));
    $selmem = mysql_fetch_array(mysql_query("select * from mlm_paymembers where mempay_userid='$profileid'"));

    $sdsd = refbonus($profileid);

    $firstname = $selusr['user_fname'];
    $prooofid = $selusr['user_profileid'];
    $userremail = $selusr['user_email'];
    $pasdsdf = $selusr['user_password'];

    $dsds = mysql_query("update mlm_paymembers set mempay_paystatus='1',mem_paytype='$paytype',mem_transid ='$selpay[transaction_id]' where mempay_userid='$profileid'");

    $update = mysql_query("UPDATE mlm_register SET user_status='0',user_paystatus='1',user_paytype='$paytype' WHERE user_profileid='$profileid'");


    $ins = mysql_query("update mlm_offlinepayment set status='1',pay_status='1',payment_type='$paytype' where payment_id='$payid' ");


    //$statususr=mysql_query("INSERT INTO mlm_user_status (usr_user) VALUES ('$profileid')");

    $subject = "Welcome to " . $website_name;

    $msg = "<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
   <tr bgcolor='#006699' height='25'>
      <td><img src=" . $logourl . " border='0' width='100px' height='auto' /></td>
   </tr>
   <tr bgcolor='#FFFFFF'>
      <td>&nbsp;</td>
   </tr>
 
   <tr bgcolor='#FFFFFF' height='35'>
      <td style='padding-left:20px; font-family:Arial; font-size:18px; line-height:18px; text-decoration:none; color:#000000;'>Hello  $firstname, </td>
   </tr>
   <tr bgcolor='#FFFFFF' height='35'>
      <td style=' padding-left: 20px; font-family: Arial; font-size: 14px; line-height: 18px; text-decoration: none; color: #000000;'>
         Below are your details,
      </td>
   </tr>
   <tr bgcolor='#FFFFFF' height='35'>
      <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Profile ID: $prooofid </td>
   </tr>
   <tr bgcolor='#FFFFFF' height='35'>
      <td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password: $pasdsdf</td>
   </tr>
  
   <tr bgcolor='#FFFFFF'>
      <td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Thank you!<br>
         " . $website_name . "<br>
      </td>
   </tr>
   <tr bgcolor='#FFFFFF'>
      <td>&nbsp;</td>
   </tr>
   <tr height='40'>
      <td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
         color: #ffffff;'>&copy; Copyright " . date("Y") . "&nbsp;" . "<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>" . $website_name . "</a>." . "</td>
   </tr>
</table>";

    $headers = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From:' . $website_name . '<' . $website_admin . '>' . "\r\n";

    $to = $userremail;

//echo $to."<br>".$msg."<br>".$subject."<br>".$headers; exit;

    mail($to, $subject, $msg, $headers);

    if ($ins) {

        header("Location:login.php?regsucc");
        echo '<script language="javascript"> window.location="login.php?regsucc"; </script>';
        exit;
    }

}

/* =============== Registration step -5 skip =================== */

if (isset($_REQUEST['registrationfive_skip'])) {
    //echo "Final";exit;
    $profileid = $_REQUEST['profileid'];

    $update = mysql_query("UPDATE mlm_register SET user_status='1' WHERE user_profileid='$profileid'");

    $statususr = mysql_query("INSERT INTO mlm_user_status (usr_user) VALUES ('$profileid')");


    echo "$id -- $profileid -- $sponsorid";



    if ($update) {
        header("Location:login.php?succ");
        echo '<script language="javascript"> window.location="login.php?succ"; </script>';
        exit;
    } else {
        die("Registration error your id is $profileid tell administrator about this error : <br>" . mysql_error());
    }
}




?>