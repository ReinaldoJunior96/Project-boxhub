<?php 
require_once('../crud/farmaciaCRUD.php');

$delete_nf = new FarmaciaCRUD();
$delete_nf->delete_NF($_GET['idnf']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>