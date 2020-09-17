<?php
require_once('../crud/bhCRUD.php');
$delete_ordem= new BhCRUD();
// var_dump($_GET['idsaida'],$_GET['prod'],$_GET['qtde']);
$delete_ordem->deleteOrdem($_GET['idordem']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>