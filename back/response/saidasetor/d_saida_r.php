<?php 
require_once('../../controllers/bhCRUD.php');
$delete_saida = new BhCRUD();
// var_dump($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
$delete_saida->cancelarSaida($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>