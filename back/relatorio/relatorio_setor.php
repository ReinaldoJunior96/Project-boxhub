<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require_once "../crud/farmaciaCRUD.php";
require_once "../../fpdf/fpdf.php";
$r = new FarmaciaCRUD();




// $pdf = new FPDF("P", "pt", "A4");
// $pdf->AddPage();
// $file = "relatorio.pdf";
// $tipo_pdf = "I";
// $pdf->SetTitle("Relatório - HVU", 12);
// $pdf->SetFont('Arial', 'B', 16);
// $pdf->Cell(0, 10, utf8_decode('Relatório HVU - Centro Cirúrgico'), 0, 0, "C");
// $pdf->Ln();
// $pdf->Ln(10);
// $pdf->setFont('Arial', 'B', 10);
// $pdf->Ln();
// $pdf->Cell(160, 20, utf8_decode('Produto / Material'), 1, 0, "C");
// $pdf->Cell(125, 20, "Quantidade", 1, 0, "C");
// $pdf->Cell(125, 20, utf8_decode("Valor Unitário"), 1, 0, "C");
// $pdf->Ln();
// foreach($result as $i){
//     $pdf->Cell(160, 20, $i->item_s, 1, 0, "C");
//     $pdf->Cell(125, 20, $i->quantidade_s, 1, 0, "C");
//     $pdf->Ln();
// }
// $pdf->Output();
