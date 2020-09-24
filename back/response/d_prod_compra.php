<?php
require_once('../crud/bhCRUD.php');
$deleteProd= new BhCRUD();
$deleteProd->deleteProdOrdem($_GET['idprod']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>