<?php 
require_once('../crud/farmaciaCRUD.php');
$p = new FarmaciaCRUD();
// $produtos = $p->relatorio1($_POST['id_produto'],$_POST['setor'],$_POST['dataI'],$_POST['dataF']);
$produtos = $p->relatorio1($_POST['setor']);

var_dump($produtos);
