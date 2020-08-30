<?php 
include("config/error.php");

include("includes/head.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}
$ussserid=(isset($_REQUEST['ussserid']))? $_REQUEST['ussserid'] :$_SESSION['profileid'];
$level1Width = 4;
$levelWidth = 2;

$level0height = 1;
$level1height = 1;
$level2height = 2;
$level3height = 4;
$level4height = 8;
$level5height = 16;
$level6height = 32;
$level7height = 64;
$level8height = 128;
$level9height = 256;
$level10height = 512;
$level11height = 1024;
$level12height = 2048;
$level13height = 4096;


$level0 = array();
$level1 = array();
$level2 = array(); 	// equals level1height by levelwidth
$level3 = array();	// equals level2height by levelwidth
$level4 = array();	// equals level3height by levelwidth
$level5 = array();
$level6 = array();
$level7 = array();
$level8 = array();
$level9 = array();
$level10 = array();
$level11 = array();
$level12 = array();
$level13 = array();



$level1Sponsees = array();
$level2Sponsees = array();
$level3Sponsees = array();
$level4Sponsees = array();
$level5Sponsees = array();
$level6Sponsees = array();
$level7Sponsees = array();
$level8Sponsees = array();
$level9Sponsees = array();
$level10Sponsees = array();
$level11Sponsees = array();
$level12Sponsees = array();



$level1Profiles = array();
$level2Profiles = array();
$level3Profiles = array();
$level4Profiles = array();
$level5Profiles  = array();
$level6Profiles  = array();
$level7Profiles  = array();
$level8Profiles  = array();
$level9Profiles  = array();
$level10Profiles = array();
$level11Profiles = array();
$level12Profiles = array();
$level13Profiles = array();


$select = mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");
$u_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid' "));
if($u_num > 0){
	while($fetch=mysql_fetch_array($select)){
	$level0[0] = $fetch['user_fname']." [". $fetch['user_profileid'] ."]";
	}
}

//populating Level 1
for ($i=1; $i <= $level0height; $i++){
	for ($j=0; $j <= $level1Width; $j++){
	$level1[$i][$j] = $i.$j;
	}
}

$level1[1][0] = $level0[0];
$level1Profiles[1][0] = $ussserid;


//populating Level 2
for ($i=1; $i <= $level2height; $i++){
	for ($j=0; $j <= $levelWidth; $j++){
	$level2[$i][$j] = $i.$j;
	}
}

//populating Level 3
for ($i=1; $i <= $level3height; $i++){
	for ($j=0; $j <= $levelWidth; $j++){
	$level3[$i][$j] = $i.$j;
	}
}

//populating Level 4
for ($i=1; $i <= $level4height; $i++){
	for ($j=0; $j <= $levelWidth; $j++){
	$level4[$i][$j] = $i.$j;
	}
}


//populating Level 5
for ($i=1; $i <= $level5height; $i++){
	for ($j=0; $j <= $levelWidth; $j++){
	$level5[$i][$j] = $i.$j;
	}
}

//populating Level 6
for ($i=1; $i <= $level6height; $i++){
	for ($j=0; $j <= $levelWidth; $j++){
	$level6[$i][$j] = $i.$j;
	}
}

//Populating Level 7 
for($i=1;$i <= $level7height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level7[$i][$j] = $i.$j;
    }
}

//Populating Level 8
for($i=1;$i <= $level8height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level8[$i][$j] = $i.$j;
    }
}

//Populating Level 9 
for($i=1;$i <= $level9height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level9[$i][$j] = $i.$j;
    }
}    
//Populating Level 10
for($i=1;$i <= $level10height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level10[$i][$j] = $i.$j;
    }
}

//Populating Level 11
for($i=1;$i <= $level11height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level11[$i][$j] = $i.$j;
    }
}

//Populating Level 12
for($i=1;$i <= $level12height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level12[$i][$j] = $i.$j;
    }
}

//Populating Level 13
for($i=1;$i <= $level13height; $i++){
    for ($j=0; $j <= $levelWidth; $j++){
	$level13[$i][$j] = $i.$j;
    }
}

function levelColorSelector($level, $index){
	$css_style = "default-level";
	switch($level){
		
		case 0:
		if($index == 0){
		$css_style = "sunflower-level0";
		}
		else{
		$css_style = "sunflower-level0";
		}
		break;
		
		case 1:
		if($index == 0){
		$css_style = "sunflower-level0";
		}
		else{
		$css_style = "sunflower-level1";
		}
		break;
		
		case 2:
		if($index == 0){
		$css_style = "sunflower-level1";
		}
		else{
		$css_style = "sunflower-level2";
		}
		break;
		
		case 3:
		if($index == 0){
		$css_style = "sunflower-level2";
		}
		else{
		$css_style = "sunflower-level3";
		}
		break;
		
		case 4:
		if($index == 0){
		$css_style = "sunflower-level3";
		}
		else{
		$css_style = "sunflower-level4";
		}
		break;
		
		case 5:
		if($index == 0){
		$css_style = "sunflower-level4";
		}
		else{
		$css_style = "sunflower-level5";
		}
		break;
		
		case 6:
		if($index == 0){
		$css_style = "sunflower-level5";
		}
		else{
		$css_style = "sunflower-level6";
		}
		break;
		
		case 7:
		if($index == 0){
		$css_style = "sunflower-level6";
		}
		else{
		$css_style = "sunflower-level7";
		}
		break;
		
		case 8:
		if($index == 0){
		$css_style = "sunflower-level7";
		}
		else{
		$css_style = "sunflower-level8";
		}
		break;
		
		case 9:
		if($index == 0){
		$css_style = "sunflower-level8";
		}
		else{
		$css_style = "sunflower-level9";
		}
		break;
		
		case 10:
		if($index == 0){
		$css_style = "sunflower-level9";
		}
		else{
		$css_style = "sunflower-level10";
		}
		break;
		
		case 11:
		if($index == 0){
		$css_style = "sunflower-level10";
		}
		else{
		$css_style = "sunflower-level11";
		}
		break;
		
		case 12:
		if($index == 0){
		$css_style = "sunflower-level11";
		}
		else{
		$css_style = "sunflower-level12";
		}
		break;
		
		case 13:
		if($index == 0){
		$css_style = "sunflower-level12";
		}
		else{
		$css_style = "sunflower-level13";
		}
		break;
		
		//case default:
		
	}
	
	return $css_style;
}
function getSponsee($level){
global $ussserid;
global $levelWidth;

global $level0;
global $level1;
global $level2;
global $level3;
global $level4;
global $level5;
global $level6;
global $level7;
global $level8;
global $level9;
global $level10;
global $level11;
global $level12;
global $level13;

global $level1Sponsees;
global $level2Sponsees;
global $level3Sponsees;
global $level4Sponsees;
global $level5Sponsees;
global $level6Sponsees;
global $level7Sponsees;
global $level8Sponsees;
global $level9Sponsees;
global $level10Sponsees;
global $level11Sponsees;
global $level12Sponsees;

global $level1Profiles;
global $level2Profiles;
global $level3Profiles;
global $level4Profiles;
global $level5Profiles;
global $level6Profiles;
global $level7Profiles;
global $level8Profiles;
global $level9Profiles;
global $level10Profiles;
global $level11Profiles;
global $level12Profiles;
global $level13Profiles;

global $ussserid_num1;
global $ussserid_num2;
global $ussserid_num3;
global $ussserid_num4;
global $ussserid_num5;
global $ussserid_num6;
global $ussserid_num7;
global $ussserid_num8;
global $ussserid_num9;
global $ussserid_num10;
global $ussserid_num11;
global $ussserid_num12;
global $ussserid_num13;

switch($level){
case 1:
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id desc");
$ussserid_num1=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' and user_profileid!='$ussserid' order by user_id asc"));
	if($ussserid_num1 > 0){
		$i = 1;
		$j = 4;
		$k = 0;
		$z = 2;
		
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level1[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level2[$j-2][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level1Sponsees[$j] = $fetch_ussserid['user_profileid'];
			$level2Profiles[$j][$k] = $fetch_ussserid['user_profileid'];
			$level1Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j--;
		
		}
		
	}
break;

case 2:
$i = 2;
$z = 0;
foreach($level1Sponsees as $sponsor){
//var_dump($sponsor);
$j = 1;
$k = 0;
$y = 2;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num2=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num2 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
		//echo $z;
			$level2[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level3[$j+$z][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
		    $level2Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
		    $level3Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level2Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
			
		}
	}
	


$i--;  
$z+=2;
}
//var_dump($level3);
break;

case 3:
$i = 1;
$z = 0;
foreach($level2Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num3=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num3 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level3[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level4[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level3Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level4Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level3Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 4:
$i = 1;
$z = 0;
foreach($level3Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num4=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num4 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level4[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level5[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level4Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level5Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level4Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 5:
$i = 1;
$z = 0;
foreach($level4Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num5=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num5 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level5[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level6[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level5Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level6Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level5Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 6:
$i = 1;
$z = 0;
foreach($level5Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num6=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num6 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level6[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level7[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level6Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level7Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level6Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 7:
$i = 1;
$z = 0;
foreach($level6Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num7=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num7 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level7[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level8[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level7Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level8Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level7Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 8:
$i = 1;
$z = 0;
foreach($level7Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num8=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num8 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level8[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level9[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level8Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level9Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level8Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 9:
$i = 1;
$z = 0;
foreach($level8Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num9=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num9 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level9[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level10[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level9Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level10Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level9Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 10:
$i = 1;
$z = 0;
foreach($level9Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num10=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num10 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level10[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level11[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level10Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level11Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level10Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 11:
$i = 1;
$z = 0;
foreach($level10Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num11=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num11 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level11[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level12[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level11Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$leve1l2Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level11Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 12:
$i = 1;
$z = 0;
foreach($level11Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc");
$ussserid_num12=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id asc"));
	if($ussserid_num12 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level12[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level11[$z+$j][$k] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			$level12Sponsees[$z+$j] = $fetch_ussserid['user_profileid'];
			$level11Profiles[$z+$j][$k] = $fetch_ussserid['user_profileid'];
			$level12Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;

case 13:
$i = 1;
$z = 0;
foreach($level12Sponsees as $sponsor){
$j = 1;
$k = 0;
$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id desc");
$ussserid_num13=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$sponsor' and user_profileid!='$sponsor' order by user_id desc"));
	if($ussserid_num13 > 0){
		while($fetch_ussserid = mysql_fetch_array($select_ussserid)){
			$level12[$i][$j] = $fetch_ussserid['user_fname']." [". $fetch_ussserid['user_profileid'] ."]";
			//$level12[$z][$k] = $fetch_ussserid['user_lname']." [". $fetch_ussserid['user_profileid'] ."]";
			//$level11Sponsees[$z] = $fetch_ussserid['user_profileid'];
			$level12Profiles[$i][$j] = $fetch_ussserid['user_profileid'];
			$j++;
		}
	}
$i++;
$z+=2;
}

break;
}

}
getSponsee(1);
//var_dump($level1Sponsees);
getSponsee(2);
//var_dump($level2Sponsees);
getSponsee(3);
//var_dump($level3Sponsees);
getSponsee(4);
getSponsee(5);
getSponsee(6);
getSponsee(7);
getSponsee(8);
getSponsee(9);
getSponsee(10);
getSponsee(11);
getSponsee(12);
getSponsee(13);
?>

<style>
td {
    line-height: 0;
    padding: 1rem 0;
}
.sunflower-level0{
	background-color: blue;
}

.sunflower-level1{
	background-color: orange;
}

.sunflower-level2{
	background-color: purple;
}

.sunflower-level3{
	background-color: #EB3F1C;
}

.sunflower-level4{
	background-color: green;
}

.sunflower-level5{
	background-color: black;
}

.sunflower-level6{
	background-color: violet;
}

.sunflower-level7{
	background-color: cyan;
}

.sunflower-level8{
	background-color: pink;
}

.sunflower-level9{
	background-color: indigo;
}

.sunflower-level10{
	background-color: gray;
}

.sunflower-level11{
	background-color: #87CEFA ;
}

.sunflower-level12{
	background-color: violet;
}

.sunflower-level13{
	background-color:#FFD700 ;
}

.sunflower p{
	padding-bottom:5px;
}
ul.sunflower{
    display: flex;
    margin:0;
    margin-left:12px;
	/*float: left;*/
	display: flex;
    width: 100%;
    padding: 0;
    list-style: none;
    height: 70px;
}

.sunflower a {
    width: 95px;
    min-height:100%;
    text-align:left;
    font-size:12px;
    text-decoration: none;
    color: white;
    display: block;
    padding: 0.2em 0.6em;
    border: 1px solid white;
}

.sunflower a:hover {
    background-color: #EB1CDD;
}

</style>

<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	/*.numwraper img {
		width: 100%;
		height: 100%;
	}*/
	
	.numwraper span {
		position: absolute;
		right: 34%;
		top: 31%;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-weight:bold;
		font-size: 12px;
		background-color: #FFF;
		padding: 0px 2px 0px 2px;
		display: block;
	}

 a.tooltipp 
 {
 outline:none;
 opacity: 1;
  } 
 a.tooltipp strong 
 {
 line-height:30px;
 } 
 a.tooltipp:hover 
 {
 text-decoration:none;
 } 
 a.tooltipp span 
 {
  z-index:10;display:none; 
  padding:14px 20px;
   margin-top:-30px; 
   margin-left:10px; 
   width:280px;
    line-height:16px;
	 } 
	 a.tooltipp:hover span
	 { 
	 display:inline;
	  position:absolute; 
	 color:#111;
	  border:1px solid #DCA;
	   background:#fffAF0;} 
	   .callout {
	   z-index:20;
	   position:absolute;
	   top:30px;
	   border:0;
	   left:-12px;
	   } 
	   /*CSS3 extras*/
	    a.tooltipp span { 
		border-radius:4px;
		 -moz-border-radius: 4px;
		  -webkit-border-radius: 4px; 
		  -moz-box-shadow: 5px 5px 8px #CCC;
		   -webkit-box-shadow: 5px 5px 8px #CCC;
		    box-shadow: 5px 5px 8px #CCC;
			 }
			 
	.circle {
  display: block;
  width:60px;
  height:60px;
  margin: 1em auto;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  -webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 4px solid #eee;
  box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);  
}
	.level_circle{
  display: block;
  width:45px;
  height:45px;
  margin: 1em auto;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  -webkit-border-radius: 99em;
  -moz-border-radius: 99em;
  border-radius: 99em;
  border: 4px solid #eee;
  box-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);  
}
 </style>
</head>
     <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			
		
			<hr />
			
			<!-- Profile info -->
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
							<?php   ?>
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">YOUR DROPS</h4>
								<table width="100%" border="1" cellspacing="0" cellpadding="0" style="background:#F8F8F8; border-collapse:collapse; border:1px #FF6600 solid; ">
			
			<tr><?php $img=Getprofileimage($ussserid); ?>
			<td align="center" valign="bottom" style=" border:1px #FF6600 solid;"><img src="<?php echo $img; ?>" class="circle"  />		 			<a href="#" class="forgotlink tooltipp" style="margin-left:50px;">
			
			
			<?php
			
	       $select=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");
		$u_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid' "));
		if($u_num > 0)
		{
		while($fetch=mysql_fetch_array($select))
		{
					  
					  echo $fetch['user_fname'];
					  
			?>
					  <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch['user_fname'].$fetch['user_secondname']." ".$fetch['user_lname']; ?> </b></div>
                      <div style="clear:both;">&nbsp;</div>
                      </div>
                       <div>
					  <div style="width:300px;" align="left"> Sponsor Name : <b><?php echo $fetch['user_sponsername']; ?> </b></div>
					  <div style="clear:both;">&nbsp;</div>
                      </div>
                      <div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch['user_profileid']; ?></b></div>
                      <div style="float:left; width:150px;" align="left"> Membership : <b><?php echo Getmembetshipfromprofileid($fetch['user_profileid']); ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
                     
					   <div>
					 <div style="float:left; width:170px;" align="left"> Refferal Limit : <b><?php echo Getmembetshipcount($fetch['user_profileid']); ?> </b></div>
					  <div style="float:left; width:130px;" align="left"> Reffered Count: <b><?php echo directrefferalcount($fetch['user_profileid']); ?></b></div>
                       
					  </div>
					  
					 <!-- <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>-->
					  
					  
					  </div>
					  </span>
					  
					  
					  </a>
					  <?php } }?>
					  <!--Level 0-->
					  	<span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span></td>
                    </tr>
                    
                   
					  <!--Level 1-->
					  
					  <tr>
                      <td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
			                    <?php
			                    	for ($i=1; $i <= $level0height; $i++){
			                    		echo "<br><ul class='sunflower'>";
							for ($j=0; $j <= $level1Width; $j++){
							echo "<li><a href='sunflower.php?ussserid=" . $level1Profiles[$i][$j] . "' class='".levelColorSelector(1,$j)."'>".$level1[$i][$j]."</a></li>";
							//$level2[$i][$j] = $i.$j;
							}
							echo "</ul>";
						}
						echo "<br>";
			                    ?>
					  <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
					  
					  </td>
                    </tr>
                    
                    <!--Level 2-->
                    
                    <?php
                        if($ussserid_num1==4){
                             
                    ?>
                    <tr>
                    <td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 2</span>
	               <?php
	                    	for ($i=1; $i <= $level2height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level2Profiles[$i][$j] . "' class='".levelColorSelector(2,$j)."'>".$level2[$i][$j]."</a></li>";
					//$level2[$i][$j] = $i.$j;
					}
					echo "</ul>";
				}
				echo "<br>";
	                ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 2</span></td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                    <!--Level 3-->
                    <?php
                    if($ussserid_num1==4 && $ussserid_num2==2){
                      echo $ussserid_num2;
                    ?>
                    <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 3</span>
                    <?php
	                    	for ($i=1; $i <= $level3height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level3Profiles[$i][$j] . "' class='".levelColorSelector(3,$j)."'>".$level3[$i][$j]."</a></li>";
					//$level2[$i][$j] = $i.$j;
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 3</span></td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                    <!--Level 4-->
                    <?php
                    if($ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                        
                    ?>
                    
                    <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 4</span>
                    <?php
	                    	for ($i=1; $i <= $level4height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level4Profiles[$i][$j] . "' class='".levelColorSelector(4,$j)."'>".$level4[$i][$j]."</a></li>";
					//$level2[$i][$j] = $i.$j;
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 4</span></td>
                    </tr>
                    
                    <?php
                       }
                    ?>
                    <!--Level 5-->
                    <?php 
                    if($ussserid_num4 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>   
        
                    <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 5</span>
                    <?php
	                    	for ($i=1; $i <= $level5height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level5Profiles[$i][$j] . "' class='".levelColorSelector(5,$j)."'>".$level5[$i][$j]."</a></li>";
					//$level2[$i][$j] = $i.$j;
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 5</span></td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                    <!--Level 6-->
                    <?php 
                    if($ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 6</span>
                    <?php
	                    	for ($i=1; $i <= $level6height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level6Profiles[$i][$j] . "' class='".levelColorSelector(6,$j)."'>".$level6[$i][$j]."</a></li>";
					//$level2[$i][$j] = $i.$j;
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 6</span></td>
                    </tr>
                    <?php
                        }
                    ?>
                    
                     <!--Level 7-->
                    <?php 
                    if($ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                    
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 7</span>
                    <?php
	                    	for ($i=1; $i <= $level7height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level7Profiles[$i][$j] . "' class='".levelColorSelector(7,$j)."'>".$level7[$i][$j]."</a></li>";
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 7</span></td>
                    </tr>
                     <?php
                        }
                    ?>
                     <!--Level 8-->
                     <?php 
                    if($ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 8</span>
                    <?php
	                    	for ($i=1; $i <= $level8height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level8Profiles[$i][$j] . "' class='".levelColorSelector(8,$j)."'>".$level8[$i][$j]."</a></li>";
					
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 8</span></td>
                    </tr>
                      <?php
                        }
                    ?>
                    
                     <!--Level 9-->
                      <?php 
                    if($ussserid_num8==2 && $ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                    
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 9</span>
                    <?php
	                    	for ($i=1; $i <= $level9height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level9Profiles[$i][$j] . "' class='".levelColorSelector(9,$j)."'>".$level9[$i][$j]."</a></li>";
				
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 9</span></td>
                    </tr>
                      <?php
                        }
                    ?>
                     <!--Level 10-->
                    <?php 
                    if($usserid_num9==2 && $ussserid_num8==2 && $ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 10</span>
                    <?php
	                    	for ($i=1; $i <= $level10height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level10Profiles[$i][$j] . "' class='".levelColorSelector(10,$j)."'>".$level10[$i][$j]."</a></li>";
					
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 10</span></td>
                    </tr>
                     <?php
                        }
                    ?>
                     <!--Level 11-->
                     <?php 
                    if($ussserid_num10 ==2 && $usserid_num9==2 && $ussserid_num8==2 && $ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                    
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 11</span>
                    <?php
	                    	for ($i=1; $i <= $level11height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level11Profiles[$i][$j] . "' class='".levelColorSelector(11,$j)."'>".$level11[$i][$j]."</a></li>";
					
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 11</span></td>
                    </tr>
                      <?php
                        }
                    ?>
                     <!--Level 12-->
                      <?php 
                    if($ussserid_num11==2 && $ussserid_num10 ==2 && $usserid_num9==2 && $ussserid_num8==2 && $ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 12</span>
                    <?php
	                    	for ($i=1; $i <= $level12height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level12Profiles[$i][$j] . "' class='".levelColorSelector(12,$j)."'>".$level12[$i][$j]."</a></li>";
					
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 12</span></td>
                    </tr>
                      <?php
                        }
                    ?>
                      <!--Level 13-->
                     <?php 
                    if($ussserid_num11==2 && $ussserid_num10 ==2 && $usserid_num9==2 && $ussserid_num8==2 && $ussserid_num7==2 && $ussserid_num6==2 && $ussserid_num5==2 && $ussserid_num4==2 && $ussserid_num3==2 && $ussserid_num2==2 && $ussserid_num1==4){
                     ?>
                     <tr><td><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 13</span>
                    <?php
	                    	for ($i=1; $i <= $level13height; $i++){
	                    		echo "<br><ul class='sunflower'>";
					for ($j=0; $j <= $levelWidth; $j++){
					echo "<li><a href='sunflower.php?ussserid=" . $level13Profiles[$i][$j] . "' class='".levelColorSelector(13,$j)."'>".$level13[$i][$j]."</a></li>";
					
					}
					echo "</ul>";
				}
				echo "<br>";
	                    ?>
                    <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 13</span></td>
                    </tr>
                     
                  <?php
                        }
                  ?>
                   
			</table>
					
							</div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>