<?php
require_once('../crud/bhCRUD.php');
$deleteProd= new BhCRUD();
// var_dump($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
$deleteProd->deleteProdOrdem($_GET['idprod']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>