<?php 
require_once('../controllers/bhCRUD.php');

$delete_nf = new BhCRUD();
$delete_nf->delete_NF($_GET['idnf']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>