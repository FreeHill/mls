<?php
include("../config/error.php");

$result=mysql_query("select user_id,user_subexpiry from mlm_register where user_status !='5'");
			while($user_subexpiry=mysql_fetch_array($result)){
				if($user_subexpiry['user_subexpiry'] <= date("Y-m-d")){
				$user_id=$user_subexpiry['user_id'];
				echo "This user id: $user_id Account Suspended<br/>";
				$qry=mysql_query("update mlm_register set user_status='5' where user_id='$user_id'");
				}
			}
?>
