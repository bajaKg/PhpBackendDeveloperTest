<?php
session_start();
session_destroy();
$_SESSION=array();
header('Location:../View/HomeScreen.php');
?>