<?php

$sunplanqry=mysql_query("SELECT * FROM mlm_sunplan WHERE sun_id='1'")or die(mysql_error());
$sunplan=mysql_fetch_array($sunplanqry);

$daytocalculate=date("l");
$monthend=date("t");
$todate=date("d");

if($sunplan['sun_type']=='1')
{

if($sunplan['sun_calcdate']=='end') {
	$calcday=$monthend;
} elseif($sunplan['sun_calcdate']=='') {
	$calcday=1;
} else {
	$calcday=$sunplan['sun_calcdate'];
}

$currday=date("d");
$currmnth=date("m");
$dbstatusdate=number_format(date("m",strtotime($sunplan['sun_modify_date'])));

if($calcday==$currday && $currmnth==$dbstatusdate)
 {
if($sunplan['sun_calcstatus']==0) 
{
multilevel();
		
$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=1,sun_modify_date=NOW() WHERE sun_id=1");
		
	}

	
}

else
{
$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=0 WHERE sun_id=1");
}

}

else if($sunplan['sun_type']=='2')
{
      
	  if($daytocalculate==$sunplan['sun_day'])
	  {
	   if($sunplan['sun_calcstatus']==0) {
	   multilevel();

		$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=1,sun_modify_date=NOW() WHERE sun_id=1");
		
		}
		
		
}else
{
$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=0 WHERE sun_id=1");
}



}
else
{
}






?> 