<?php
include_once '../../controllers/bhCRUD.php';
include_once '../../controllers/configCRUD.php';

date_default_timezone_set('America/Sao_Paulo');
//$s = new ConfigCRUD();
//$setor = $s->setor_id($_GET['setor_s']);
//foreach($setor as $v){$nome_setor = $v->setor_s;}

$saida = array(
    'produto' => $_POST['produto_s'],
    'quantidade' => $_POST['saidaqte_p'],
    'setor' => $_POST['setor_s'],
    'data' => $_POST['data_s']
);
$new_saida = new BhCRUD();
$date = new DateTime();
for ($i = 0; $i < count($saida['produto']); $i++):
    if (!empty($saida['produto'][$i]) AND !empty($saida['quantidade'][$i])):
        $vrrSaida = array(
            'produto' => $saida['produto'][$i],
            'quantidade' => $saida['quantidade'][$i],
            'setor' => $_POST['setor_s'],
            'data' => $_POST['data_s']
        );
        $new_saida->registrar_saida($vrrSaida);

        //echo "Produto: ". $saida['produto'][$i] . "/ Quantidade: " . $saida['quantidade'][$i] . "/ setor: ".  $_POST['setor_s'] ."/ data: ". $_POST['data_s']."<br>";
    endif;
endfor;



echo "<script language=\"javascript\">alert(\"Saída Registrada\")</script>";
echo "<script language=\"javascript\">window.history.go(-2);</script>";

?>