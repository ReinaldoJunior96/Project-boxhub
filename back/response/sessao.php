<?php
session_cache_expire(1440);
session_start();

$_SESSION['user'] = (!isset($_POST['user'])) ? NULL : $_POST['user'];
$_SESSION['password'] = (!isset($_POST['password'])) ? NULL : $_POST['password'];
header("location: ../../index.php");