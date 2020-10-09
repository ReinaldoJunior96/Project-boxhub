<?php
require_once('../controllers/EstoqueController.php');
$estoque = new EstoqueController();
$produto = array(
    'produto' => @$_POST['produto_e'],
    'quantidade' => @$_POST['quantidade_e'],
    'valor' => number_format(@$_POST['valor_un'],2,',',''),
    'categoria' => @$_POST['categoria_e'],
    'marca' => @$_POST['marca_e'],
    'unidade' => @$_POST['unidade_e'],
    'estoque_minimo_e' => @$_POST['estoque_minimo_e'],
);

if (@$_POST['new'] == 1) {
    $estoque->newProduto($produto);
   echo "<script language=\"javascript\">window.history.back();</script>";
} elseif (@$_POST['edit'] == 1) {
    $estoque->edit_Produto($produto, $_POST['id']);
    echo "<script language=\"javascript\">window.history.back();</script>";
}
?>