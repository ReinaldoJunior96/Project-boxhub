<?php 
require_once('../crud/farmaciaCRUD.php');

if($_GET['p'] == 'cancelar'){
    $ng_solicitacao= new FarmaciaCRUD();
    $ng_solicitacao->recusar_pedidos($_GET['id']);
    echo "<script language=\"javascript\">window.history.back();</script>";
}elseif($_GET['p'] == 'aceitar'){
    $ac_solicitacao= new FarmaciaCRUD();
    /*id = da requisicao - ide= do estoque*/
    var_dump($ac_solicitacao->aceitar_pedidos($_GET['id'],$_GET['ide']));
    echo "<script language=\"javascript\">window.history.back();</script>";
}
