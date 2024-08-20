<?php
require_once('public/fpdf/fpdf.php');

$listreserv = $this->reserver->getreserverById($idreserv);
$idvoit = $listreserv->getidvoit();
$idcli = $listreserv->getidcli();
$place = $listreserv->getplace();
$date_reserv = $listreserv->getdate_reserv();
$date_voyage = $listreserv->getdate_voyage();
$payment = $listreserv->getpayment();
$montant_avance = $listreserv->getmontant_avance();


$listclient = $this->clients->getclientById($idcli);
$nom = $listclient->getnom();
$numtel = $listclient->getnumtel();

$listvoitures = $this->voitures->getvoitureById($idvoit);
$types = $listvoitures->gettypes();
$frais = $listvoitures->getfrais();
$reste_payment=$frais - $montant_avance;


//$siPdf = new FPDF(['P'|'L','pc'|'mm'|'cm','A5'|'A4'|'A3']);
$siPdf = new FPDF('P','mm','A5');

//$siPdf->SetMargins(float left, float top [, float right]);
$siPdf->SetMargins(20, 20, 20);
$siPdf->AddPage();

//$siPdf->SetFont('Arial',''|'B'|'I'|'U'|'BI'|'BU'|'BIU',16);
$siPdf->SetFont('Arial','BI',16);

//$siPdf->Cell(0|nb|210mm, nb, utf8_decode('str'), 0|1, 0|1|2, 'L'|'C'|'R')
//$siPdf->Ln(1)
$siPdf->Cell(40,10,'RECU N : '.$idreserv);
$siPdf->Ln(10);

$siPdf->SetFont('Arial','BI',12);

$siPdf->Cell(40,10,'Date de Reservetion : '.$date_reserv);






$siPdf->Ln(10);
$siPdf->Cell(40,10,'Date de voyage : '.$date_voyage);

$siPdf->Ln(15);
$siPdf->Cell(40,10,'Nom du client : '.$nom);

$siPdf->Ln(10);
$siPdf->Cell(40,10,'Contact : '.$numtel);




$siPdf->Ln(15);
$siPdf->Cell(50,10,'Voiture N : '.$idvoit.' / Type de voiture : '.$types.'    /Place : '.$place);
$siPdf->Ln(10);
$siPdf->Cell(40,10,'Frais : '.$frais.' Ariary');

$siPdf->Ln(10);
$siPdf->Cell(40,10,'Payement : '.$payment);

$siPdf->Ln(10);
$siPdf->Cell(40,10,'Montant en avance : '.$montant_avance.' Ariary');
$siPdf->Ln(10);
$siPdf->Cell(40,10,'Reste a payer : '.$reste_payment. ' Ariary');
$siPdf->Ln(10);
$siPdf->Output($dest='', $name=$idreserv, $isUTF8=false);
?>