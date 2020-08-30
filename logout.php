<?PHP
session_start();
session_destroy();

unset($_SESSION['userid']);
unset($_SESSION['profileid']);
unset($_SESSION['user_fname']);

header('location: index.php');
echo "<script>window.location='index.php';</script>";
?> 