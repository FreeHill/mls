<?php
include("config/error.php");

 $state=$_REQUEST['q'];
?>
 <select name="addresscity" id="addresscity" lass="input-block-level" style="width:400px; margin-bottom:16px;" required="true">
<option value="">--- Choose City ---</option>
<?php
		   $cities=mysql_query("select state_id,city_id,city_name from mlm_city where state_id='$state' and city_status='0'");
		   while($ct=mysql_fetch_array($cities))
		   {
		?>
		
		<option value="<?php echo $ct['city_id']; ?>"><?php echo $ct['city_name']; ?></option>
		<?php
			}
		?>
		</select>