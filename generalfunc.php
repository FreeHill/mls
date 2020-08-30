<?php

$generalfetch=mysql_fetch_array(mysql_query("select gen_startvalue,gen_need_reach,gen_maintain from mlm_generalsetting where gen_id='1'"));

define('STARTVALUE', $generalfetch['gen_startvalue']);
define('NEED_REACH', $generalfetch['gen_need_reach']);
define('MAINTAIN', $generalfetch['gen_maintain']);

function product_purchase($proid,$user,$rkey,$type,$status) {
	//echo $proid." -- ".$user;
	$product=$proid;
	$profileid=$user;
	$currip=$_SERVER['REMOTE_ADDR'];
	
	$usertable=mysql_fetch_array(mysql_query("SELECT * FROM mlm_register WHERE user_profileid='$profileid'"));
	$productdata=mysql_fetch_array(mysql_query("SELECT * FROM mlm_products WHERE pro_id='$product'"));
	$refererpercent=mysql_fetch_array(mysql_query("SELECT binary_cvvalue FROM mlm_binaryplan WHERE binary_id=1"));
	
	$repurchasechk=mysql_query("SELECT * FROM mlm_user_status WHERE usr_user='$profileid'");

	$amount=$productdata['pro_cost'];
	$insert=mysql_query("INSERT INTO mlm_purchase (pay_user,randomkey, pay_userid, pay_email, pay_phone, pay_product, pay_amount, pay_type, pay_date, pay_ip, pay_payment) VALUES ('$usertable[user_id]','$rkey', '$profileid', '$usertable[user_email]', '$usertable[user_phone]', '$productdata[pro_id]', '$amount', '$type', NOW(), '$currip', '$status')");
	//$insert="1";
	
	$stockupdate=mysql_query("UPDATE mlm_products SET pro_stock=pro_stock-1 WHERE pro_id='$productdata[pro_id]'");
	
	if($insert) {
		$updatecount=mysql_query("UPDATE mlm_user_status SET usr_purchased_num=usr_purchased_num+1 WHERE usr_user='$profileid'");
		$chkmaintaing = check_maining($profileid, $productdata['pro_bv']);
		if($chkmaintaing=='1') {
			return "1";
		} else {
			return $chkmaintaing;
		}
	} else {
		return "Purchase error : <br>".mysql_error();
	}
}

function check_maining($user, $cv) {
	//echo $user." - ".$cv;exit;
	$usertable=mysql_fetch_array(mysql_query("SELECT usr_maintan_reset FROM mlm_user_status WHERE usr_user='$user'"));
	$urrmnth=date("m");
	if($usertable['usr_maintan_reset']!=$urrmnth) {
		$update=mysql_query("UPDATE mlm_user_status SET usr_purchase_cv='$cv', usr_purch_cv_total=usr_purch_cv_total+$cv, usr_maintan_reset=$urrmnth WHERE usr_user='$user'");
	} else {
		$update=mysql_query("UPDATE mlm_user_status SET usr_purchase_cv=usr_purchase_cv+$cv, usr_purch_cv_total=usr_purch_cv_total+$cv WHERE usr_user='$user'");
	}
	
	if($update) {
		return 1;
	} else {
		return "Maitanence checking error : <br>".mysql_error();
	}
}

function assign_purchase_cv() {
	$refererpercent=mysql_fetch_array(mysql_query("SELECT binary_cvvalue FROM mlm_binaryplan WHERE binary_id=1"));
	
	$selectdircv=mysql_query("SELECT pay_userid, pay_product, pay_date, pay_id FROM mlm_purchase WHERE pay_purchase_calc=0 AND pay_payment=1");
	while($rowdircv=mysql_fetch_array($selectdircv)) {
		$profileid=$rowdircv['pay_userid'];
		$productdata=mysql_fetch_array(mysql_query("SELECT pro_bv FROM mlm_products WHERE pro_id='$rowdircv[pay_product]'"));
		$calccv=$productdata['pro_bv'];
		
		//addcv($profileid,$calccv);
		
		$updatecal=mysql_query("INSERT INTO mlm_payoutcalc set pay_user='$profileid', pay_purchaseid='$rowdircv[pay_id]', pay_cv='$calccv', pay_reason='Purchase CV', bonus_type=0, pay_date='$rowdircv[pay_date]', pay_calc_status='1'");
		
		$stockupdate=mysql_query("UPDATE mlm_register SET purchased_bv=purchased_bv+$calccv WHERE user_profileid='$profileid' AND purchased_bv<$refererpercent[binary_cvvalue]");
		
		$stockupdate=mysql_query("UPDATE mlm_register SET total_bv=total_bv+$calccv WHERE user_profileid='$profileid'");
		
		$updatepurch=mysql_query("UPDATE mlm_purchase SET pay_purchase_calc=1 WHERE pay_id='$rowdircv[pay_id]'");
	}
}

function direct_referal() {
	
	$selectdir=mysql_query("SELECT pay_userid,pay_product,pay_id FROM mlm_purchase WHERE pay_referal_calc=0 AND pay_payment=1");
	while($rowdir=mysql_fetch_array($selectdir)) {
		$profileid=$rowdir['pay_userid'];
		
		$directrefrer=mysql_fetch_array(mysql_query("SELECT user_sponserid FROM mlm_register WHERE user_profileid='$profileid'"));
		$refererid=$directrefrer['user_sponserid'];
		
		$productdata=mysql_fetch_array(mysql_query("SELECT pro_bv FROM mlm_products WHERE pro_id='$rowdir[pay_product]'"));
		$calccv=$productdata['pro_bv'];
		
		$refererpercent=mysql_fetch_array(mysql_query("SELECT binary_refbonus FROM mlm_binaryplan WHERE binary_id=1"));
		
		$totcv=$calccv*($refererpercent['binary_refbonus']/100);
		
		$gen_startvalue=STARTVALUE;
		$gen_need_reach=NEED_REACH;
		
		$binaryplan=mysql_fetch_array(mysql_query("SELECT binary_cvvalue FROM mlm_binaryplan WHERE binary_id=1"));
		
		$selectreff=mysql_query("SELECT user_profileid FROM mlm_register AS R JOIN mlm_user_status AS S ON R.user_profileid=S.usr_user WHERE R.total_bv>$gen_need_reach AND R.total_bv>$gen_startvalue AND user_status=0 AND user_profileid='$refererid' GROUP BY `user_profileid` ORDER BY R.user_id DESC");
		
		if(mysql_num_rows($selectreff)>0) {
		
		//echo $refererid." - ".$totcv;exit;
		
		addcv($refererid,$totcv);
		
		$updatecal=mysql_query("INSERT INTO mlm_payoutcalc set pay_user='$refererid', pay_cv='$totcv', pay_reason='Direct Referal Bonus CV', bonus_type=1, pay_date=NOW(), pay_calc_status='1'");
		
		}
		$updatereferal=mysql_query("UPDATE mlm_purchase SET pay_referal_calc=1 WHERE pay_id='$rowdir[pay_id]'");
	}
	
}

function weekly_calculation() {
	
	$gen_startvalue=STARTVALUE;
	$gen_need_reach=NEED_REACH;
	$gen_maintain=MAINTAIN;
	/*$refererpercent=mysql_fetch_array(mysql_query("SELECT binary_refbonus FROM mlm_binaryplan WHERE binary_id=1"));
	gen_maintain*/
	
	$binaryplan=mysql_fetch_array(mysql_query("SELECT binary_cvvalue FROM mlm_binaryplan WHERE binary_id=1"));
	
	//echo "SELECT user_profileid FROM mlm_register AS R JOIN mlm_user_status AS S ON R.user_profileid=S.usr_user WHERE S.usr_purchase_cv>$gen_maintain AND R.total_bv>$gen_need_reach AND R.total_bv>$gen_startvalue AND user_status=0 AND S.usr_binary=0 GROUP BY `user_profileid` ORDER BY R.user_id DESC";exit;
	
	$selectbin=mysql_query("SELECT user_profileid FROM mlm_register AS R JOIN mlm_user_status AS S ON R.user_profileid=S.usr_user WHERE S.usr_purchase_cv>$gen_maintain AND R.total_bv>$gen_need_reach AND R.total_bv>$gen_startvalue AND user_status=0 AND S.usr_binary=0 GROUP BY `user_profileid` ORDER BY R.user_id DESC");
	
	while($rowbin=mysql_fetch_array($selectbin)) {
		
		$tmpleft=0;
		$tmpright=0;
		
		//echo "SELECT purchased_bv FROM mlm_register WHERE user_placementid='$rowbin[user_profileid]' AND user_placement='L' AND purchased_bv>=$binaryplan[binary_cvvalue] <br>";
		
		$subuserleftqry=mysql_query("SELECT purchased_bv, user_profileid FROM mlm_register WHERE user_placementid='$rowbin[user_profileid]' AND user_placement='L'");
		
		//echo "SELECT purchased_bv FROM mlm_register WHERE user_placementid='$rowbin[user_profileid]' AND user_placement='R' AND purchased_bv>=$binaryplan[binary_cvvalue] <br>";
		
		$subuserrightqry=mysql_query("SELECT purchased_bv, user_profileid FROM mlm_register WHERE user_placementid='$rowbin[user_profileid]' AND user_placement='R'");
		
		//echo "test <br>";exit;
		
		if(mysql_num_rows($subuserleftqry)==1 && mysql_num_rows($subuserrightqry)==1) {
					
			$subuserleftrow=mysql_fetch_array($subuserleftqry);
			$subuserrightrow=mysql_fetch_array($subuserrightqry);
			
			$tmpleft = binarycalc($subuserleftrow['user_profileid'],0);
			
			$tmpright = binarycalc($subuserrightrow['user_profileid'],0);
			
			//echo $tmpleft." - ".$tmpright."<br>";//exit;
			
			//echo $subuserleftrow['purchased_bv']."-".$subuserrightrow['purchased_bv']."<br>";
			$leftcvnum=calcroud(number_format($tmpleft/$binaryplan['binary_cvvalue'],2));
			$rightcvnum=calcroud(number_format($tmpright/$binaryplan['binary_cvvalue'],2));
			
			$selectcalctable=mysql_query("SELECT bin_profile,bin_left,bin_right FROM mlm_binary WHERE bin_profile='$rowbin[user_profileid]'");
			if(mysql_num_rows($selectcalctable)==0) {
				$newcalculation=1;
			} else {
				$rowcalctable=mysql_fetch_array($selectcalctable);
				$leftcvnum=$leftcvnum+$rowcalctable['bin_left'];
				$rightcvnum=$rightcvnum+$rowcalctable['bin_right'];
				$newcalculation=0;
			}
			//echo $leftcvnum." - ".$rightcvnum."<br>";
			if($leftcvnum>=$rightcvnum) {
				$calcnum=$rightcvnum;
				$calc_cv=$calcnum*$binaryplan['binary_cvvalue'];
			} elseif($leftcvnum<$rightcvnum) {
				$calcnum=$leftcvnum;
				$calc_cv=$calcnum*$binaryplan['binary_cvvalue'];
			}
			//echo $calc_cv."<br>";
			$leftcv=$tmpleft-$calc_cv;
			$rightcv=$tmpright-$calc_cv;
			
			$finalcv=$calc_cv*(20/100);
			//echo $finalcv."<br>";
			//echo "Balance in left : ".$leftcv." - Right : ".$rightcv."<br>";
			
			//echo $finalcv."<br>"; //continue;
			
			//$updateuserpurchasecv=mysql_query("UPDATE mlm_register SET purchased_bv=0 WHERE user_profileid='$rowbin[user_profileid]'");
			
			//echo $rowbin['user_profileid']." r - r ".$finalcv;exit;
			
			if($newcalculation==1) {
				$insertcvcalc=mysql_query("INSERT INTO mlm_binary (bin_profile, bin_left, bin_right, bin_date) VALUES ($rowbin[user_profileid], '$leftcv', '$rightcv', NOW())");
			} else {
				$insertcvcalc=mysql_query("UPDATE mlm_binary SET bin_left='$leftcv', bin_right='$rightcv', bin_total='0', bin_date=NOW() WHERE bin_profile='$rowbin[user_profileid]'");
			}
			
			addcv($rowbin['user_profileid'],$finalcv);
			///$updateusertable=mysql_query("UPDATE mlm_register SET accumulated_bv=accumulated_bv+$finalcv, total_bv=total_bv+$finalcv WHERE user_profileid='$rowbin[user_profileid]'");
			 
			$inertrecord=mysql_query("INSERT INTO mlm_payoutcalc (pay_user, pay_cv, pay_reason, pay_date,bonus_type,pay_calc_status) VALUES ('$rowbin[user_profileid]', '$finalcv', 'Binary calculation - team bonus', NOW(),'2','1')");
			
		}
		
	}
	
	$updatepaytable=mysql_query("UPDATE mlm_purchase SET pay_binary_calc='1' WHERE pay_binary_calc='0' AND pay_payment='1'");
}



function addcv($profileid,$calccv) {
	$selectuser=mysql_fetch_array(mysql_query("SELECT total_bv FROM mlm_register WHERE user_profileid='$profileid'"));
	
	$selrank=mysql_query("SELECT rank_id FROM mlm_rank WHERE rank_cv<=$selectuser[total_bv]+$calccv ORDER BY mlm_rank DESC");
	
	if($selrank) {
		$selectrank=mysql_fetch_array();
	} else {
		$selectrank['rank_id']='';
	}
	if(isset($selectrank['rank_id']) && $selectrank['rank_id']!='') {
		$rank=$selectrank['rank_id'];
	} else {
		$rank=0;
	}
	
	$updateuaercv=mysql_query("UPDATE mlm_register SET accumulated_bv=accumulated_bv+$calccv, total_bv=total_bv+$calccv, user_rank='$rank' WHERE user_profileid='$profileid'");
}

function calcroud($value) {
	$v=explode(".",$value);
	if($v[1]>00 && $v[1]<50) {
		$fv=$v[0];
	} elseif($v[1]>50) {
		$fv=$v[0].".5";
	} else {
		$fv=$v[0];
	}
	return $fv;
}


function multilevel() {
	
	$sunplanqry=mysql_fetch_array(mysql_query("SELECT * FROM mlm_sunplan WHERE sun_id='1'"));
	 
	 $sundate=$sunplanqry['sun_calcdate'];

	$usa=mysql_query("select * from mlm_register where user_status='0'");
	//echo $sunplanqry['sun_type']; exit;
	while($sprrow=mysql_fetch_array($usa))
	{
	

       
	 if($sunplanqry['sun_type']=='1')  
  
  {
 
	$calpay=mysql_fetch_array(mysql_query("select SUM(pay_amount) as amt from mlm_payoutcalc where (bonus_type=1 and pay_user='$sprrow[user_profileid]') and (pay_date BETWEEN date_sub( now( ) , INTERVAL $sundate DAY )AND NOW())")); 
	
	$calpay1=mysql_fetch_array(mysql_query("select SUM(pay_amount) as amt from mlm_payoutcalc where (bonus_type=3 and pay_user='$sprrow[user_profileid]') and (pay_date BETWEEN date_sub( now( ) , INTERVAL $sundate DAY ) AND NOW())")); 
	
	}
	else
	{
	
	//echo "select SUM(pay_amount) as amt from mlm_payoutcalc where (bonus_type=1 and pay_user='$sprrow[user_profileid]') and (pay_date BETWEEN date_sub( now( ) , INTERVAL 7 DAY ) AND NOW())"; 
	
		$calpay=mysql_fetch_array(mysql_query("select SUM(pay_amount) as amt from mlm_payoutcalc where (bonus_type=1 and pay_user='$sprrow[user_profileid]') and (pay_date BETWEEN date_sub( now( ) , INTERVAL 7 DAY ) AND NOW())")); 
	
	$calpay1=mysql_fetch_array(mysql_query("select SUM(pay_amount) as amt from mlm_payoutcalc where (bonus_type=3 and pay_user='$sprrow[user_profileid]') and (pay_date BETWEEN date_sub( now( ) , INTERVAL 7 DAY ) AND NOW())")); 
	}
	
	
	$useval=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$sprrow[user_profileid]'"));
	
	$spnr=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$useval[user_sponserid]'"));
	
	$memshi=mysql_fetch_array(mysql_query("select * from mlm_membership where status=0 and id='$spnr[user_membership]'")); 
	
	$asssa=$memshi['indirect_reference'];

   // echo $asssa; 

	$totref=$calpay['amt']+$calpay1['amt'];

   // echo $totref; 

    $indamt=$totref*($asssa/100);
	
	if($indamt > 0)
	{
	
$ins=mysql_query("insert into mlm_payoutcalc set pay_user='$spnr[user_profileid]',pay_amount='$indamt',pay_reason='Indirect Bonus',bonus_type='2',pay_date=NOW(),pay_calc_status='1'");
	
}
}

	
}

function activecomp_repurchase($spnsr, $pro, $percent, $cc, $cv) {
	
	$gen_startvalue=STARTVALUE;
	$gen_need_reach=NEED_REACH;
	$gen_maintain=MAINTAIN;
	
	$userquery=mysql_query("SELECT user_profileid FROM mlm_register WHERE total_bv>$gen_startvalue AND user_status=0 AND user_profileid='$spnsr' GROUP BY `user_profileid`");
	
	if(mysql_num_rows($userquery)>0) {
		
		$userdata=mysql_fetch_array($userquery);
		
		if($userdata['user_profileid']!='' || $userdata['user_profileid']!=0) {
			$cvcalc=$cv*($percent[$cc]/100);
			$finalcalccv=number_format($cvcalc);
			
			addcv($userdata['user_profileid'], $finalcalccv);
			
			$insertcalc=mysql_query("INSERT INTO mlm_payoutcalc (pay_user, pay_purchaseid, pay_cv, pay_reason, bonus_type, pay_date, pay_calc_status) VALUES ('$userdata[user_profileid]', '$pro', '$finalcalccv', 'Repurchase Bonus', 3, NOW(), 1)");
			
			return 1;
			
		} else {
			return 0;
		}
		
	} else {
		
		$userquery1=mysql_fetch_array(mysql_query("SELECT user_sponserid FROM mlm_register WHERE user_profileid='$spnsr'"));
		
		if(($userquery1['user_sponserid']!='') || ($userquery1['user_sponserid']!=0)) {
			activecomp_repurchase($userquery1['user_sponserid'], $pro, $percent, $cc, $cv);
		}
		
	}
	
}

function activecompresion($spnsr, $pro, $percent, $cc, $cv) {
	
	$gen_startvalue=STARTVALUE;
	$gen_need_reach=NEED_REACH;
	$gen_maintain=MAINTAIN;
	
	$userquery=mysql_query("SELECT user_profileid FROM mlm_register AS R JOIN mlm_user_status AS S ON R.user_profileid=S.usr_user WHERE S.usr_purchase_cv>$gen_maintain AND R.total_bv>$gen_startvalue AND user_status=0 AND R.user_profileid='$spnsr' GROUP BY `user_profileid`");
	
	if(mysql_num_rows($userquery)>0) {
		
		$userdata=mysql_fetch_array($userquery);
		
		if($userdata['user_profileid']!='' || $userdata['user_profileid']!=0) {
			$cvcalc=$cv*($percent[$cc]/100);
			$finalcalccv=number_format($cvcalc);
			
			addcv($userdata['user_profileid'], $finalcalccv);
			
			$insertcalc=mysql_query("INSERT INTO mlm_payoutcalc (pay_user, pay_purchaseid, pay_cv, pay_reason, bonus_type, pay_date, pay_calc_status) VALUES ('$userdata[user_profileid]', '$pro', '$finalcalccv', 'Multilevel Bonus', 4, NOW(), 1)");
			
			return 1;
			
		} else {
			return 0;
		}
		
	} else {
		
		$userquery1=mysql_fetch_array(mysql_query("SELECT user_sponserid FROM mlm_register WHERE user_profileid='$spnsr'"));
		
		if(($userquery1['user_sponserid']!='') || ($userquery1['user_sponserid']!=0)) {
			activecompresion($userquery1['user_sponserid'], $pro, $percent, $cc, $cv);
		}
		
	}
	
}



?>