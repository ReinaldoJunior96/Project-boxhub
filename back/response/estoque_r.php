<?php 
require_once('../crud/bhCRUD.php');
$produto = array(
	'produto' => $_POST['produto_e'],
	'quantidade' => $_POST['quantidade_e'], 
	'valor' => str_replace(",",".",$_POST['valor_un']),
	'categoria' => $_POST['categoria_e'],
	'marca' => $_POST['marca_e'],
	'unidade' => $_POST['unidade_e'],
	'estoque_minimo_e' => $_POST['estoque_minimo_e'],
);

if(@$_POST['new'] == 1) {	
	$new_produto = new BhCRUD();
	$new_produto->newProduto($produto);
	echo "<script language=\"javascript\">window.history.back();</script>";
}elseif(@$_POST['edit'] == 1){
	$edit = new BhCRUD();
	$edit->edit_Produto($produto,$_POST['id']);
	echo "<script language=\"javascript\">window.history.back();</script>";
}



?>