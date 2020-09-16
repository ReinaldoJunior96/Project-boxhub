<?php
include '../crud/bhCRUD.php';
include '../crud/configCRUD.php';

date_default_timezone_set('America/Sao_Paulo');
$s = new ConfigCRUD();
$setor = $s->setor_id($_POST['setor_s']);
foreach($setor as $v){$nome_setor = $v->setor_s;}

$date = new DateTime();
$saida = array(
	'produto' => $_POST['produto_s'],
	'quantidade' => $_POST['saidaqte_p'], 
	'setor' => $nome_setor,
	'data' =>  (empty($_POST['data_s'])) ? $date->format('Y-m-d H:i:s') : $_POST['data_s']
);

$new_saida = new BhCRUD();
$new_saida->registrar_saida($saida);
echo "<script language=\"javascript\">window.history.back();</script>";

?>