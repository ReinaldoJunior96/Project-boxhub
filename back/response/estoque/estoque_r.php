<?php
require_once('../../controllers/EstoqueController.php');
$estoque = new EstoqueController();
$produto = array(
    'produto' => @$_POST['produto_e'],
    'p_ativo' => @$_POST['p_ativo'],
    'quantidade' => @$_POST['quantidade_e'],
    'valor' => number_format(@$_POST['valor_un'], 2, ',', ''),
    'estoque_minimo_e' => @$_POST['estoque_minimo_e'],
    'principio_ativo' => $_POST['p_ativo'],
    'concentracao' => $_POST['concentracao'],
    'apresentacao' => $_POST['apresentacao'],
    'forma_farmaceutica' => $_POST['forma_farmaceutica'],
);

if (@$_POST['new'] == 1) {
    $estoque->newProduto($produto);
    echo "<script language=\"javascript\">window.history.back();</script>";
} elseif (@$_POST['edit'] == 1) {
    $estoque->edit_Produto($produto, $_POST['id']);
    echo "<script language=\"javascript\">window.history.back();</script>";
}
?>