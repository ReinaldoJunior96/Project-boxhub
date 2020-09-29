<?php
include '../controllers/bhCRUD.php';
date_default_timezone_set('America/Sao_Paulo');
$f = new BhCRUD();
$data = new DateTime();
$f->cadOrdemCompra($_POST['nome_f'],(empty($_POST['data_c']))
    ? $data->format('Y-m-d')
    : date("Y-m-d", strtotime($_POST['data_c'])));
echo "<script language=\"javascript\">window.history.back();</script>";