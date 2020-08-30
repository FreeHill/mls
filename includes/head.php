<?php 

$allusers=mysql_query("select totalreference_bonus,totalindirect_bonus,totalindirect_purbonus,total_amount,user_profileid,withdraw_amount,balance_amount from mlm_register");
while($rowall=mysql_fetch_array($allusers))
{
$totallref=$rowall['totalreference_bonus'];
$totallin=$rowall['totalindirect_bonus'];
$totallinp=$rowall['totalindirect_purbonus'];
$totamtp=$totallref+$totallin+$totallinp;

$totalwd=$rowall['withdraw_amount'];
$balamt=$totamtp-$totalwd;

$upus=mysql_query("update mlm_register set total_amount='$totamtp',balance_amount='$balamt'  where user_profileid='$rowall[user_profileid]'");

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title><?php echo $website_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo $website_desc; ?>" />
	<meta name="keywords" content="<?php echo $website_keywords; ?>" />

    <!-- Le styles -->
    
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/jquery.css" rel="stylesheet" />
	<link href="css/dev.css" rel="stylesheet" />
  

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
       <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />