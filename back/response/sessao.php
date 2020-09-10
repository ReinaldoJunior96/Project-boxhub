<?php
include '../crud/bhCRUD.php';
$attLogin = new BhCRUD();
if($attLogin->login($_POST['user'],$_POST['password']) == 1){
    session_cache_expire(1440);
    session_start();
    $_SESSION['user'] = (!isset($_POST['user'])) ? NULL : $_POST['user'];
    $_SESSION['password'] = (!isset($_POST['password'])) ? NULL : $_POST['password'];
    header("location: ../../index.php");
}else{
    header("location: ../../login.php");
}





