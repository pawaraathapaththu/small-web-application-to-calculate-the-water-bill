<?php
session_start();

if(!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

$_SESSION = array();

session_destroy();

header("Location: login.php");
exit;
?>
