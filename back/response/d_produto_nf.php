<?php 
require_once('../crud/bhCRUD.php');

$delete_prod_nf = new BhCRUD();
$delete_prod_nf->delete_prod_NF($_GET['id_prod_nf'],$_GET['item_estoque'],$_GET['qtde_nf']);
echo "<script language=\"javascript\">window.history.back();</script>";


?>