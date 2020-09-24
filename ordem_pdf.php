<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require 'back/crud/bhCRUD.php';
$dados = new BhCRUD();
$dados_ordem = $dados->verOrdemTotal($_GET['id_ordem']);
if (empty($dados_ordem['0']->item_compra)) {
	echo "<script language=\"javascript\">alert(\"Ordem sem itens!!\")</script>";
	echo "<script language=\"javascript\">window.history.back();</script>";
}else{
	require_once "fpdf/fpdf.php";
	$pdf = new FPDF("P", "pt", "A4");
	$pdf->AddPage();
	$file = "Ordem_de_compra.pdf";
	$tipo_pdf = "I";
	/*Parâmetros da função SetFont('Fonte', 'Estilo', Tamanho)*/
// $pdf->SetFont('Arial', 'B', 20);
// $pdf->Cell(0, 20, '', '', '1', '');
// $pdf->Ln(30);
	/*Parâmetros da função Cell(Tamanho da celula, Altura da celula, 'Texto', 'bordas', 'Quebra de linha', 'Alinhamento')*/
	$pdf->SetFont('arial', 'B', 12);
	/*Parâmetros da função Cell(Espaço entre linhas)*/

	$pdf->Image('images/logo.png', 385, 15, -200);
	$pdf->Cell(0, 40, utf8_decode('Ordem de Compra'), '', '1', 'L');
	$pdf->Cell(0, 0, utf8_decode('Cliente: ' . mb_strtoupper(@$dados_ordem['0']->nome_f, 'UTF-8')), '', '1', 'L');
	$date = date_create(@$dados_ordem['0']->data_c);
	$pdf->SetFont('arial', '', 10);
	$pdf->Cell(0, 40, utf8_decode('Data da Transação: ' . date_format(@$date, 'd/m/Y')), '', '1', 'L');

	$pdf->Ln(20);
	$pdf->Cell(300, 20, utf8_decode("Produto / Material"), 1, 0, "C");
	$pdf->Cell(80, 20, utf8_decode("Quantidade"), 1, 0, "C");
	$pdf->Cell(80, 20, utf8_decode("Valor Un"), 1, 0, "C");
	$pdf->Cell(80, 20, utf8_decode("Valor Total"), 1, 0, "C");
	$pdf->Ln(25);
	$pdf->SetFont('arial', '', 11);
	$vTotal = 0;
	foreach ($dados_ordem as $v) {
		$vTotal += $v->valor_un_e*$v->qtde_compra;
		$pdf->Cell(300, 20, utf8_decode($v->produto_e), 1, 0, "C");
		$pdf->Cell(80, 20, utf8_decode($v->qtde_compra), 1, 0, "C");
		$pdf->Cell(80, 20, utf8_decode("R$ " . str_replace(".", ",",  $v->valor_un_e)), 1, 0, "C");
		$pdf->Cell(80, 20, utf8_decode("R$ ". str_replace(".", ",",  $v->valor_un_e*$v->qtde_compra)), 1, 0, "C");
		$pdf->Ln(25);    
	}
	$pdf->Cell(460, 20, utf8_decode("Total a Pagar"), 1, 0, "C");
	$pdf->SetFont('arial', 'B', 12);
	$pdf->Cell(80, 20, utf8_decode("R$ " . str_replace(".", ",",  $vTotal)), 1, 0, "C");
	$pdf->Output($file, $tipo_pdf);

}