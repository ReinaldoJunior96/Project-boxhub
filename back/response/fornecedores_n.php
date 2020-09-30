<?php

include '../controllers/FornecedorController.php';
$f = new FornecedorController();
$fornecedor = array(
    'nome' => @$_POST['fornecedor'],
    'contato' => @$_POST['telefone_fornecedor'],
    'email' => @$_POST['email_fornecedor'],
);
if (@$_POST['new'] == 1) {
    $f->novoFornecedor($fornecedor);
} elseif (@$_POST['edit'] == 1) {
    $f->editFornecedor($fornecedor, $_POST['idfornecedor']);
}
echo "<script language=\"javascript\">window.history.back();</script>";