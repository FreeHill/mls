<?php

include("config/error.php");

//print_r($_REQUEST); exit;
if(isset($_GET['user_sponserid']) && isset($_GET['user_profileid'])){
	
	$user_profileid=$_GET['user_profileid'];
	$user_sponserid=$_GET['user_sponserid'];
	  $tdate=date('Y-m-d');
	$lcnt=mysql_num_rows(mysql_query("select memid,level from mlm_mem_level where memid=$user_sponserid"));
	  
	  if($lcnt==0) {
	  $insert = mysql_query("INSERT INTO mlm_mem_level (memid,level) VALUES ('$user_sponserid',1)");
	  }
	  else{
	  $update = mysql_query("UPDATE mlm_mem_level SET level=(level+1) WHERE memid=$user_sponserid");
	  }
	  
	  $result= mysql_query("select memid,level from mlm_mem_level where memid=$user_sponserid");
	  
	  while($row_level=mysql_fetch_array($result))
	  {
		  if($level>4){
		  $level=5;
		  }
		  else{
		  $level = $row_level['level'];
			  if($level==2){
			  $topamtsres= mysql_query("select amount from mlm_top_amt where id='2'");
			  $usrid=GetTopMemberID();
				  while($topamts=mysql_fetch_array($topamtsres)){
					  $amounts=$topamts['amount'];
				  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$usrid','$amounts','2','$tdate')");
				  }
			  }
			  else if($level==3){
			  $usrid=GetTopMemberID();
			  $topamtsres= mysql_query("select amount from mlm_top_amt where id='3'");
				  while($topamts=mysql_fetch_array($topamtsres)){
				  $amounts=$topamts['amount'];
				  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$usrid','$amounts','2','$tdate')");
				  }
			  }
		  }
		  $res= mysql_query("select level,diramount,indamount from mlm_level_amt where level=$level");
		  while($row=mysql_fetch_array($res)){
		  $diramt = $row['diramount'];
		  $indamount = $row['indamount'];
		  }
		  $rsw= mysql_query("select user_sponserid from mlm_register where user_profileid=$user_sponserid");
		   while($rws=mysql_fetch_array($rsw)){
		  $usrsponsor = $rws['user_sponserid'];
		  }
			if($usrsponsor!=''){
		  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$user_sponserid','$diramt','1','$tdate')");
		  }
		  $sponsorcnt=mysql_num_rows(mysql_query("select * from mlm_mem_amount where memid=$user_sponserid AND is_direct='1'"));
		  $sp_res= mysql_query("select id,sponsor_req_min,sponsor_req_max from mlm_reward");
			 while($sprw=mysql_fetch_array($sp_res)){
			 $id=$sprw['id'];
			 $sponsor_req_min=$sprw['sponsor_req_min'];
			 $sponsor_req_min=$sprw['sponsor_req_min'];
			 $out_bonus=$sprw['out_bonus'];
				 if( ($sponsor_req_min <= $sponsorcnt) && ($sponsorcnt <= $sponsor_req_max)){
				 $outside = IsOutsideBonus($user_sponserid);
					 if($outside){
					  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$user_sponserid','$out_bonus','3','$tdate')");
					 }
					 else{
					 $updaterew = mysql_query("UPDATE mlm_register SET user_rewardid=$id WHERE user_profileid=$user_sponserid");
					 }
				 }
			 }
		   
	  }
	  if(!empty($user_sponserid)){
	  $rs= mysql_query("select user_sponserid from mlm_register where user_profileid=$user_sponserid");
		   while($rw=mysql_fetch_array($rs)){
		  $usr_sponsor = $rw['user_sponserid'];
			  if($usr_sponsor==''){
			  $topamtres= mysql_query("select amount from mlm_top_amt where id='1'");
				 while($topamt=mysql_fetch_array($topamtres)){
				  $amount=$topamt['amount'];
				  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$user_sponserid','$amount','1','$tdate')");
				  }
			  }
			  else if($usr_sponsor!=''){
			  $insert = mysql_query("INSERT INTO mlm_mem_amount (memid,amount,is_direct,date) VALUES ('$usr_sponsor','$indamount','2','$tdate')");
			  }
		  }
	  }
	  
	 
	  $sel=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$user_profileid'"));
	
	$prooofid=$sel['user_profileid'];
	$userremail=$sel['user_email'];
	$pasdsdf=$sel['user_password'];
	
		$subject="Login details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid (or) $userremail </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $pasdsdf</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$website_url/login.php?activate=".$prooofid."' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none;'>Click Here to activate your Profile</a></td>
						</tr>
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

ini_set('SMTP','mail.i-netsolution.com');
$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$website_admin.'>' . "\r\n";

$to=$userremail;


//echo $to."<br>".$msg."<br>".$subject."<br>".$headers; exit;

mail($to,$subject,$msg,$headers);
	  
	  echo "<script> window.location='login.php?regsucc'; </script>";
	  
}



?>



