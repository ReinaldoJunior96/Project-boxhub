<?php 
require_once('../crud/bhCRUD.php');
$produto_nf = array(
	'produto' => $_POST['prod_id'],
	'quantidade' => $_POST['quantidade_pnf'],
	'lote' => $_POST['lote_pnf'],
	'validade' => $_POST['validade_pnf'],
	'nf' => $_POST['nf']
);

$new_produto_nf = new BhCRUD();
$new_produto_nf->addProd_nf($produto_nf);
echo "<script language=\"javascript\">window.history.back();</script>";


?>