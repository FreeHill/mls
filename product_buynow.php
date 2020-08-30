<?php 
include("config/error.php");
include("generalfunc.php");

if(isset($_REQUEST['cancel'])) {
	unset($_SESSION['choosedproid']);
	header("Location:index.php");
	 echo '<script language="javascript"> window.location="index.php"; </script>';exit;
}

if(!isset($_REQUEST['pid']) || $_REQUEST['pid']=='') {
	header("Location:index.php");
	 echo '<script language="javascript"> window.location="index.php"; </script>';exit;
}

if(!isset($_SESSION['profileid']) || $_SESSION['profileid']=='') {
	$_SESSION['choosedproid']=$_REQUEST['pid'];
	header("Location:login.php");
       echo '<script language="javascript"> window.location="login.php"; </script>';exit;

}

$product=$_REQUEST['pid'];
$profileid=$_SESSION['profileid'];
$type=$_REQUEST['type'];
$status=$_REQUEST['status'];

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

$rankey=random_string(8); 

$purchasestatus = product_purchase($product, $profileid,$rankey,$type,$status);

if($purchasestatus!='1') 
{
	echo "Error : ".$purchasestatus;exit;
} 
else
{

if(isset($_REQUEST['buynow']))
{
$balamt=$_REQUEST['balamt'];

$updatpurc=mysql_query("update mlm_register set totalpurchase_bonus='$balamt' where user_profileid='$profileid'");

productbonus($product,$profileid);
	
	header("Location:profile.php?");
	echo '<script language="javascript"> window.location="profile.php?"; </script>';exit;

}
else
{

if($_REQUEST['propay']=='1')
{

	header("Location:paypal_pro.php?pid=$product&rval=$rankey");
	echo '<script language="javascript"> window.location="paypal_pro.php?pid='.$product.'&rval='.$rankey.'"; </script>';exit;
}
else
{

header("Location:other_pro.php?pid=$product");
	echo '<script language="javascript"> window.location="other_pro.php?pid='.$product.'"; </script>';exit;
}
}

}




?>