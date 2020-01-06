<?php 
require_once('../crud/farmaciaCRUD.php');
require_once('../crud/ConfigCRUD.php');

date_default_timezone_set('America/Sao_Paulo');
$s = new ConfigCRUD();
$setor = $s->setor_id($_POST['setor_s']);
foreach($setor as $v){$nome_setor = $v->setor_s;}


$saida = array(
	'produto' => $_POST['produto_s'],
	'quantidade' => $_POST['saidaqte_p'], 
	'setor' => $nome_setor,
	'data' => date("Y-m-d H:i:s")
);

$new_saida = new FarmaciaCRUD();
$new_saida->registrar_saida($saida);
echo "<script language=\"javascript\">window.history.back();</script>";


?>