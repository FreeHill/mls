<?php
include("config/error.php");
//print_r($_REQUEST); exit;

if (!isset($_SERVER['HTTP_REFERER'])){

   die("No Direct access!!"); exit;
}

if(isset($_REQUEST['success']))
{
$usrsubexp=mysql_fetch_array(mysql_query("select user_subexpiry from mlm_register where user_id='$_SESSION[userid]'"));

$validity=mysql_fetch_array(mysql_query("select 	validity from mlm_subscription"));

$val=$validity['validity'];
$exp=$usrsubexp['user_subexpiry'];

$new_exp=date("Y-m-d",strtotime("$exp + $val month"));

$qry=mysql_query("update mlm_register set user_subexpiry='$new_exp' where user_id='$_SESSION[userid]'");

if($qry)
{
header("Location:profile.php?subsucc");
}

}


?>



