<?php
include("../config/error.php"); 
$q = $_GET['q'];

$sql=mysql_query("select * from mlm_register where user_fname='$q' and user_status='0'");

$fetch=mysql_fetch_array($sql);

$num=mysql_num_rows($sql);
$count=mysql_fetch_array(mysql_query("select * from mlm_register where user_status='0'"));
if($count=='0')
{
?>
<input type="text" name="sidd" id="sidd" value="owner" style="background-color:#F0F0F0;"/>

<?php }
else
{
if($num != 0)
{ ?>
<input type="text" name="sidd" id="sidd" value="<?php echo $fetch['user_sponserid']; ?>"/>&nbsp;<span style="color:#006633;"> Valid Sponser name</span>
<?php }
else
{ ?>
<input type="text" name="sidd" id="sidd" disabled="disabled"/> &nbsp;<span style="color:#FF0000;"> Invalid Sponser name</span>

<?php }


}




?>