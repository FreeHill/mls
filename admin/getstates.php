<?php
include("../config/error.php");
if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}
if(isset($_REQUEST['service']))
{
$name = $_REQUEST['service'];
$result = mysql_query("select * from mlm_state where state_name LIKE '".$name."%' ");
while($rows = mysql_fetch_array($result)){
			?>
			<tr>
            <td width='75%'><a onclick='addstate(<?php echo $rows['state_id'];?>,"<?php echo $rows["state_name"];?>","<?php echo $rows['country_code'];?>");' href='#allids'><?php echo $rows['state_name'];?></a></td>
            <td width='25%'><?php echo $rows['country_code'];?></td>
            </tr>
			<?php
}
}
?>