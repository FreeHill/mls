<?php
include("../config/error.php");
if(isset($_REQUEST['submit']))
{
	$idd=$_REQUEST['userid'];
	$type=$_REQUEST['membership'];
	$dd=date('Y-m-d'); 
	$sele=mysql_fetch_array(mysql_query("select * from mlm_membership where id='$type'"));
	$sql=mysql_query("update mlm_register set user_membership='$type' where user_profileid='$idd'"); 
	
	$update=mysql_query("update mlm_paymembers set mempay_memid='$type',mempay_amount='$sele[act_amount]',mempay_date='$dd',mempay_paystatus='1',mem_paytype='3' where mempay_userid='$idd'");
	echo "<script>window.close();</script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Membership</title>
</head>

<body>
<div align="center" style="border:solid 1px #CCC;">
	<h3>Change User Membership</h3>
	<form method="post" action="">
    <input type="hidden" name="userid" value="<?php echo $_REQUEST['proid']; ?>" />
    <span>Membership : </span>
    <select name="membership">
     <option value="">--- Select ---</option>
     <?php 
	 $mem=mysql_query("select * from mlm_membership where status='0'");
	 while($res=mysql_fetch_array($mem))
	 {
		 ?> <option value="<?php echo $res['id']; ?>"><?php echo $res['membership_name']; ?></option> <?php
	 }
	 ?>
     </select>
     <br /><br />
		<input type="submit" name="submit" value="Submit" />
        <input type="reset" name="cancel" value="Cancel" onclick="window.close();" />
     </form>
	<br />
   </div>
</body>
</html>