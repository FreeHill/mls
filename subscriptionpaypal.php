<?php
include("config/error.php");


function currency($from_Currency, $to_Currency, $amount) {

//echo $amount; exit;
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);

    $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt ($ch, CURLOPT_USERAGENT,
                 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('bld>', $rawdata);
    $data = explode($to_Currency, $data[1]);

    return round($data[0], 2);
}



$formaction = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // Test account
//$formaction = "https://www.paypal.com/cgi-bin/webscr"; // Live account

$paypalmail=$paypal_id;

$x_ordid=base64_encode($_REQUEST['id']);



$subs=mysql_fetch_array(mysql_query("select * from mlm_subscription"));

//echo $mems['act_amount']; exit;

$product_price=currency('USD','USD',$subs['cost']);

$item_name=$subs['name'];

$trip_type="2";
$item_number=1;

$return_url=$website_url."/subsuccess.php?success&id=$x_ordid";

$cancel=$website_url."/profile.php?subcancel&id=$x_ordid";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $website_title;  ?></title>
</head>
<script>
function FormSubmit()
{
document.frm_process.submit();	
}
</script>

<body onload="Javascript:FormSubmit();">
<table width="100%" height="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  align="center" valign="middle">
	
    <form name="frm_process" method="get" action="<?php echo $formaction; ?>">
<center>&nbsp;<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333"><img src="images/loading_pdf.gif" border="0" alt="loading" />&nbsp; </font></center>
<input type="hidden" name="cmd" value="_xclick" />
<table>
	<tr><td>
<!-- Owner Paypal Id -->
<input type="hidden" name="business" value="<?php echo $paypalmail; ?>" />
</td></tr>
<tr><td>
<!-- Product Name -->
<input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
</td></tr>
<tr><td>
<!-- Product Amount -->
<input type="hidden" name="amount" value="<?php echo $product_price; ?>" />
<input type="hidden" name="trip_type" value="<?php echo $trip_type; ?>" />
</td></tr>
<tr><td>
<input type="hidden" name="no_note" value="2" />
<input type="hidden" name="rm" value="2" />
</td></tr>
<tr><td>
<!-- Amount Currency -->
<input type="hidden" name="currency_code" value="USD" />
</td></tr>
<tr><td>
<input type="hidden" name="bn" value="PP-BuyNowBF" />
<input type="hidden" name="item_number" value="<?php echo $item_number; ?>">

</td></tr>
<tr><td>
<input type="hidden" name="notify_url" value="<?php echo $return_url; ?>">
<!-- Success Return Path -->
<input type="hidden" name="return" value="<?php echo $return_url; ?>">
</td></tr>
<tr><td>
<!-- Failure Return Path -->
<input type="hidden" name="cancel_return" value="<?php echo $cancel; ?>" />
</td></tr>
<tr><td>

</td></tr>
<tr><td></td>
</form>
    </td>
  </tr>
</table>

</body>
</html>