<?php 
require_once('../crud/farmaciaCRUD.php');
$delete_saida = new FarmaciaCRUD();
// var_dump($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
$delete_saida->cancelarSaida($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>