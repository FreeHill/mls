<?php
include("../config/error.php");

 $city=$_REQUEST['q'];
 $state=$_REQUEST['st'];
 
  $cities=mysql_fetch_array(mysql_query("select * from mlm_city where state_id='$state' and city_id='$city' and city_status='0'"));
  
?>
<select name="cpcity" id="cpcity" >
<option value="">--- Choose City ---</option>

		
		<option value="<?php echo $cities['city_id']; ?>" selected="selected"><?php echo $cities['city_name']; ?></option>
	
		</select>