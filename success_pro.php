<?php

include("config/error.php");

//print_r($_REQUEST); exit;

$payment_status=strtolower($_REQUEST['payment_status']);

$txn_id=$_REQUEST['txn_id'];

$tax_value=$_REQUEST['tax'];

$gross_amt=$_REQUEST['mc_gross'];

$item_id=$_REQUEST['item_number'];

$id=base64_decode($_REQUEST['id']);

//$type=$_REQUEST['trip_type'];

$ip=$_SERVER['REMOTE_ADDR'];

//echo $id; 
//echo "select * from mlm_register where user_profileid='$_SESSION[profileid]'"; exit;

$reg=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$_SESSION[profileid]'"));

$memval=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$item_id'"));



if(isset($_REQUEST['payment_status']) && ($payment_status=='completed' || $payment_status=='pending'))
{

$pay_status=1;
//echo "update mlm_purchase set pay_txnid='$txn_id',pay_payment='$pay_status' where pay_userid='$_SESSION[profileid]' and randomkey='$id'"; exit;
$sdadfads=productbonus($item_id,$_SESSION['profileid']);

$valmem=mysql_query("update mlm_purchase set pay_txnid='$txn_id',pay_payment='$pay_status' where pay_userid='$_SESSION[profileid]' and randomkey='$id'");

}
else
{
$pay_status=0;
}
//$pay_status=1;

$fullpath = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[PHP_SELF]);


$orderdate=date('d-m-Y');


if($pay_status==1)
{

$subject="$website_team Product Purchase Details";

$msg =" 		
	<table width='500' cellpadding='0' cellspacing='0' border='0' > 

		<tr height='25'> 

		<td height='94' valign='top'  >
			
			<img src='$logourl'  style='line-height:25px;'  />
			
		</td> 

	</tr> 
	<tr>
	<td height='5' style='border-bottom:solid 1px #85B396;'>	</td>
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear $reg[user_fname], </b> 	
		
		</td> 
	
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Thank you for your order. We have attached herewith your invoice which contains your order details. To ensure the most prompt and efficient service, please always refer to your order number when contacting us Payment Information.</td>
		</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		<table style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
			      <tr><td width='43%'><b>Product Name</b> </td> <td>:</td> <td>$memval[pro_name]</td> 	</tr>
				  
				   <tr><td> <b>Amount</b> </td> <td>:</td> <td>$memval[pro_cost]</td> </tr>
				   
				  <tr><td> <b>Purchase Bonus</b> </td> <td>:</td> <td>$memval[pro_bonus]</td> </tr>
				  
				   <tr><td> <b>Indirect Purchase Bonus</b> </td> <td>:</td> <td>$memval[pro_indirect_bonus]</td> </tr>

                  <tr><td><b>Order Date</b></td> <td>:</td> <td>$txn_id</td></tr> 	

					<tr><td><b>Order ID</b></td> <td>:</td> <td>$orderdate</td></tr> 	
					
					<tr><td><b>Payment status</b></td> <td>:</td> <td>success</td></tr>	
		</table>
		</td> 
	
		
	</tr>
	
	

	<tr bgcolor='#FFFFFF'> 
	
		<td height='77' colspan='2' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 
		
			<p><b>Regards,</b><br> $website_team <br>
			  
			  <a href='$website_url/login.php' target='_blank'><b> $website_team </b></a>
		    </p>
  		</td>
		
	</tr> 
	
	

</table>";	
	
       		    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:$website_team	< $website_admin >" . "\r\n";

ini_set("SMTP","mail.i-netsolution.com");
				       
$userto=$reg['user_email'];	
/*$userto='sheik.inet@gmail.com';*/
//echo $userto;
//echo $subject;
//echo $msg;
//echo $headers;exit;
//	   			
mail($userto,$subject,$msg,$headers);





$msg1 =" 		
	<table width='500' cellpadding='0' cellspacing='0' border='0'> 

		<tr  height='25'> 

		<td height='94' valign='top'>
			
			<img src='$logourl'    />
			
		</td> 

	</tr> 
	
	<tr>
	<td height='5' style='border-bottom:solid 1px #85B396;'>	</td>
	</tr>
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
<b>Product Purchase order information.</b></td>
		</tr>

	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>User name</b> : $reg[user_fname]
		
		</td> 
	</td>
		
	</tr>
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Email ID</b> : $reg[user_email]
		
		</td> 
	</td>
		
	</tr>
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order date</b> : $orderdate	
		
		</td> 
	</td>
		
	</tr>

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order ID</b> : $txn_id	
		
		</td> 
	</td>
		
	</tr>
	
	
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Product Name</b> : $memval[pro_name]	
		
		</td> 
	</td>
		
	</tr>
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Success	
		
		</td> 
	</td>
		
	</tr>
	


	<tr bgcolor='#FFFFFF'> 
	
		<td height='77' colspan='2' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 
		
			<p><b>Regards,</b><br> $website_team <br>
			  
			  <a href='$website_url/login.php' target='_blank'><b> $website_team </b></a>
		    </p>
  		</td>
		
	</tr> 
	
	

</table>";	
	
       		    $headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= "From:$website_team	< $website_admin >" . "\r\n";
	
	ini_set("SMTP","mail.i-netsolution.com");
				
/*$adminto='mohaideen@i-netsolution.com';		*/			       
$adminto=$website_admin;	
	   			

mail($adminto,$subject,$msg1,$headers1);

header("location:profile.php?pay_suss");

}

else
{
$subject="$website_team product purchase Transaction failed";

$msg =" 		
	<table width='500' cellpadding='0' cellspacing='0' border='0' > 

		<tr  height='25'> 

		<td height='94' valign='top'>
			
			<img src='$logourl'    />
			
		</td> 

	</tr> 
	
	<tr>
	<td height='5' style='border-bottom:solid 1px #85B396;'>	</td>
	</tr>
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Dear $reg[user_fname], </b> 	
		
		</td> 
	</td>
		
	</tr>	
	
	
	<tr bgcolor='#FFFFFF'>
			<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
Your transaction has been failed. Please try again .</td>
		</tr>

	

	<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order ID</b> : $txn_id 	
		
		</td> 
	</td>
		
	</tr>
	
	
			<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Order date</b> : $orderdate	
		
		</td> 
	</td>
		
	</tr>
	
	
	
		<tr bgcolor='#FFFFFF' height='35'> 
	
		<td height='24' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-top:10px;'>
		
			<b>Payment status</b> : Failed	
		
		</td> 
	</td>
		
	</tr>
	
	
	
	

	<tr bgcolor='#FFFFFF'> 
	
		<td height='77' colspan='2' align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> 
		
			<p><b>Regards,</b><br> $website_team <br>
			  
			  <a href='$website_url/login.php' target='_blank'><b> $website_team </b></a>
		    </p>
  		</td>
		
	</tr> 
	
	

</table>";	
	
       		    $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:$website_team	< $website_admin >" . "\r\n";
				       
ini_set("SMTP","mail.i-netsolution.com");
/*$to='sheik.inet@gmail.com';	*/
$to=$reg['user_email'];	
	   			
/*echo $userto;
echo $subject;
echo $msg;
echo $headers;exit;*/
mail($to,$subject,$msg,$headers);

header("location:product_buy.php?pid=$item_id&err");



}




?>



