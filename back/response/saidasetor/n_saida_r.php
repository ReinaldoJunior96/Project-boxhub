<?php
include_once '../../controllers/bhCRUD.php';
include_once '../../controllers/configCRUD.php';

date_default_timezone_set('America/Sao_Paulo');
$s = new ConfigCRUD();
$setor = $s->setor_id($_GET['setor_s']);
foreach($setor as $v){$nome_setor = $v->setor_s;}

$date = new DateTime();
$saida = array(
	'produto' => $_GET['produto_s'],
	'quantidade' => $_GET['saidaqte_p'],
	'setor' =>  $_GET['setor_s'],
	'data' =>  $_GET['data_s']
);

$new_saida = new BhCRUD();
$new_saida->registrar_saida($saida);
echo "<script language=\"javascript\">window.history.back();</script>";

?>