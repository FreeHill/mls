<?php
include("../config/error.php"); 
$q = $_GET['q'];
$usr=$_REQUEST['ussr'];
//echo "select * from mlm_register where user_sponserid='$usr' and user_placement='$q' and user_status='0'"; exit;

$sql=mysql_query("select * from mlm_register where user_placementid='$usr' and user_placement='$q' and user_status='0'");

$fetch=mysql_fetch_array($sql);

$num=mysql_num_rows($sql);

if($num=='0')
{
echo "<span style='color:#006633;'>proceed !!!</span>";
}
else
{
echo "<span style='color:#FF0000;'>Already exists another person !!!</span>";
}


?>
