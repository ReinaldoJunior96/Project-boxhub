<?php 
require_once('../controllers/bhCRUD.php');
$nf = array(
	'numero' => $_POST['numero_nf'],
	'data_e' => $_POST['datae_nf'], 
	'data_l' => $_POST['datal_nf'],
	'fornecedor' => $_POST['fornecedor_nf'],
	'valor' => $_POST['valor_nf'],
	'obs' => $_POST['obs_nf'],
);


if ($_POST['tipo'] == 'edit') {
	$editnf = new BhCRUD();
	$editnf-> edit_NF($nf, $_POST['idnf']);
	echo "<script language=\"javascript\">window.history.back();</script>";
}elseif ($_POST['tipo'] == 'new') {
	$newnf = new BhCRUD();
	$newnf->insert($nf);
	echo "<script language=\"javascript\">window.history.back();</script>";
}



?>