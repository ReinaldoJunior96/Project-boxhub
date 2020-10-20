<?php
require_once('../../controllers/EstoqueController.php');
$estoque = new EstoqueController();
$estoque->removeFornecedorProf($_GET['idpf']);
echo "<script language=\"javascript\">window.history.back();</script>";
?>

