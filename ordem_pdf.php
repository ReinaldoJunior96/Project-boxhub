<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require 'back/crud/bhCRUD.php';
$dados = new BhCRUD();
$dados_ordem = $dados->verOrdemTotal($_GET['id_ordem']);
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
//$pdf->Cell(0, 50, utf8_decode('ORDEM DE COMPRA'), '', '1', 'C');
$pdf->SetFont('arial', '', 11);
/*Parâmetros da função Cell(Espaço entre linhas)*/
$pdf->Image('images/logo.png', 235, 10, -300);
$pdf->Ln(30);
$pdf->Cell(0, 50, utf8_decode('ORDEM DE COMPRA'), '', '1', 'C');
$pdf->Ln(20);
$pdf->Cell(300, 20, utf8_decode("Produto / Material"), 1, 0, "C");
$pdf->Cell(80, 20, utf8_decode("Quantidade"), 1, 0, "C");
$pdf->Cell(80, 20, utf8_decode("Valor Un"), 1, 0, "C");
$pdf->Cell(80, 20, utf8_decode("Valor Total"), 1, 0, "C");
$pdf->Ln(30);
foreach ($dados_ordem as $v) {
    $pdf->Cell(300, 20, utf8_decode($v->produto_e), 1, 0, "C");
    $pdf->Cell(80, 20, utf8_decode("R$ ".$v->qtde_compra), 1, 0, "C");
    $pdf->Cell(80, 20, utf8_decode("R$ " .$v->valor_un_e), 1, 0, "C");
    $pdf->Cell(80, 20, utf8_decode("R$ ". $v->valor_un_e*$v->qtde_compra), 1, 0, "C");
    $pdf->Ln(30);
    // $pdf->MultiCell(
    //     0,
    //     15,
    //     utf8_decode($v->produto_e),
    //     1,
    //     'J',
    //     false
    // );

    // $pdf->MultiCell(
    //     0,
    //     15,
    //     utf8_decode('MICHAEL WILLI DA SILVA STREIDL, identidade nº 33.574.703-6 - SSP/SP e CPF/MF nº 275.549.898-63;'),
    //     '0',
    //     'L'
    // );
    // $pdf->MultiCell(
    //     0,
    //     15,
    //     utf8_decode('SHAYENE ALMEIDA STREIDL, identidade nº 44.003.369-X - SSP/SP e CPF/MF nº 328.189.018-04;'),
    //     '0',
    //     'L'
    // );
    // $pdf->Ln(-20);
    // $pdf->Cell(0, 120, strftime('PINHEIRO, ' . '%d de %B de %Y.', strtotime('today')), '', '1', 'C');
    // $pdf->Ln(-60);
    // $pdf->Cell(0, 80, '____________________________________________', '', '1', 'C');
    // $pdf->Ln(-25);
    // $pdf->Cell(0, 0, "Assinatura do(a) OUTORGANTE", '', '1', 'C');
    // $pdf->Ln(50);
    // $pdf->SetFont('Arial', 'B', 10);
    // $pdf->Cell(0, 0, utf8_decode("Observações:"), '', '1', 'L');
    // $pdf->Ln(30);
    // $pdf->Cell(0, 0,  utf8_decode("1º - Reconhecer firma por autenticidade."), '', '1', 'L');
    // $pdf->Ln(5);
    // $pdf->MultiCell(0, 20, utf8_decode("2º - O prazo de validade desta procuração é de 3 anos, contado da data de sua assinatura."), '0', 'L');
}
$pdf->Output($file, $tipo_pdf);
