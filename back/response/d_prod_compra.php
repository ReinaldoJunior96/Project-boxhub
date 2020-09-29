<?php
require_once('../controllers/bhCRUD.php');
$deleteProd= new BhCRUD();
$deleteProd->deleteProdOrdem($_GET['idprod']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>