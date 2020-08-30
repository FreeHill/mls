<?php
include("config/error.php"); 

if(isset($_REQUEST['getprovalue'])) {
	$id=$_REQUEST['id'];
	$selectproduct=mysql_fetch_array(mysql_query("SELECT pro_cost,pro_bv,pro_stock FROM mlm_products WHERE pro_id='$id'"));
	echo "Rs ".$selectproduct['pro_cost']."/-"."-=-".$selectproduct['pro_bv']."-=-".$selectproduct['pro_stock'];
}
?>