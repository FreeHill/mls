<?php
include("config/error.php");
$pay=$_REQUEST['q'];
$pid=$_REQUEST['pid'];

//echo $pid; exit;
//echo "select * from mlm_register where user_profileid='$pid'";  exit;
$pemail=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$pid'"));

$pemailval=$pemail['user_email'];

$memid=$pemail['user_membership'];

$offpay="select * from mlm_offlinepayment where (email_id='$pemailval' and status!='1') and (payment_id='$pay' and membership_id ='$memid')";

//echo "select * from mlm_offlinepayment where (email_id='$pemailval' and status='0') and payment_id='$pay'"; exit;
$count=mysql_num_rows(mysql_query($offpay));

//echo $count; exit;

if($count=='1')
{
echo "0";
}
else
{
echo "1";
}


?>


