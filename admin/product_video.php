<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Video</title>
</head>

<body>
<div>
                      
                                  <?php
     require 'youtube.inc.php';
     $youtube = new youtube;
	
	 $youtube->get(1,$_REQUEST['pro_url']);
		
     echo $youtube->embed_html(); 
	
	

?> 
                    </div>
</body>
</html>