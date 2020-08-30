<?php

session_start();
$q = $_REQUEST['q'];
if(strlen($q) > 5 && !empty($q)){
    echo '<span style="color:#006633;">Good to go !!!</span>';
}
else {
    echo '<span style="color:#FF0000;">Password characters should be at least 6!</span>';
}
?>