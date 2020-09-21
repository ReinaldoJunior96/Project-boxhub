<?php
include '../crud/bhCRUD.php';
date_default_timezone_set('America/Sao_Paulo');
$f = new BhCRUD();
$data = new DateTime();
$f->addProdOdemCompra($_POST['produto_c'], $_POST['ordem'],$_POST['saidaqte_p']);
echo "<script language=\"javascript\">window.history.back();</script>";