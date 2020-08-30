<?php

$id=base64_decode($_REQUEST['id']);


header("location:register_five.php?id=$id&cancel");

exit;

?>