<?php
require_once('../crud/requisicao_crud.php');
date_default_timezone_set('America/Sao_Paulo');
/* Data + numero = identificacao do grupo*/
$data = date("Y-m-d H:i:s");
// $data = date("d-m-Y H:i:s", strtotime($d));


$verifica_user = new RequisicaoCRUD();
if ($verifica_user->verifica_users($_POST['solicitante']) == 1) {
    $solicitacao = array(
        'item' => @$_POST['item_solicitado'],
        'quantidade' => @$_POST['qtde_solicitada'],
        'setor' => @$_POST['setor'],
        'data' => $data,
        'solicitante' => @$_POST['solicitante'],
        'status' => '0'
    );
    $n_requisicao = new RequisicaoCRUD();
    $n_requisicao->new_requisicao($solicitacao);
} else {
    echo "Identificador invalido";
}


echo "<script language=\"javascript\">window.history.back();</script>";
