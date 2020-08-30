<?php

$id=$_REQUEST['item_number'];


header("location:product_buy.php?pid=$id&cancel");

echo "<script>window.location='product_buy.php?pid=".$id."&cancel';</script>"; exit;

?>