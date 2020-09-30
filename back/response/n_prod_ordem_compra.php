<?php
include '../controllers/CompraController.php';
$f = new CompraController();
$f->addProdCompra($_POST['produto_c'], $_POST['ordem'], $_POST['saidaqte_p'], str_replace(',', '.', $_POST['valor_un_c']));
echo "<script language=\"javascript\">window.history.back();</script>";