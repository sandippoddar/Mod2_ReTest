<?php

require_once './Database/Query.php';
require_once __DIR__.'/../Dashboard/dashboardSession.php';
require_once __dir__.'/../vendor/autoload.php';

use Fpdf\Fpdf;
$queryOb = new Query();
$resultHealthy = $queryOb->fetchHealthyProduct();
$resultUnhealthy = $queryOb->fetchUnhealthyProduct();
$sumHealth = $queryOb->sumHealthyCart($_SESSION['userEmail']);
$sumUnhealth = $queryOb->sumUnhealthyCart($_SESSION['userEmail']);
$sum = ($sumHealth['SUM'] + $sumUnhealth['SUM']);

if (isset($_POST['submit'])) {
  $userEmail = $_SESSION['userEmail'];
  $queryOb = new Query();
  $fileVersion = rand(100000,999999);
  $pdf = new Fpdf();
  $pdf -> AddPage();
  $pdf -> SetFont('Arial', 'B', 16);
  $pdf -> Cell(0, 20, "User Receipt", 1, 1, 'C');

  $pdf->Cell(70,20,'User Name',1,0,'C');
  $pdf->Cell(0,20,'Product Price',1,1,'C');
  $pdf->Cell(0,20,'User Phone',1,1,'C');

  $pdf->Cell(70,20,$_POST['nname'],1,0,'C');
  $pdf->Cell(70,20,$_POST['price'],1,0,'C');
  $pdf->Cell(0,20,$_POST['phone'],1,1,'C');
  $pdf->Output('F','../Uploads/Invoice'.$fileVersion.'.pdf');
}
