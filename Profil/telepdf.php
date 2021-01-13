<?php

include '../connexion.php';
session_start();

if(isset($_POST['tl1']))
{
	
$test=$_POST['tl1'];


	$query = "select M.NOM_MAT AS NOM_MAT , MO.NOM_MODU AS NOM_MODU , F.NOM_FIL AS NOM_FIL , M.DESCRIPTION_MAT AS DESCRIPTION_MAT
              from matiere M , module MO , filiere F
              where M.CODE_MODU=MO.CODE_MODU
              AND MO.CODE_FIL=F.CODE_FIL
              AND NOM_MAT = '$test' ";


  $result = mysqli_query($ma_connexion,$query); 

 while ($ligne= mysqli_fetch_array($result))
  {
    $r1=$ligne['NOM_MAT'];
	$r2=$ligne['NOM_MODU'];
	$r3=$ligne['NOM_FIL'];
	$r4=$ligne['DESCRIPTION_MAT'];
}

	include ("../FPDF/fpdf.php");
   $pdf=new FPDF();
   $pdf->AddPage();
   $pdf->SetLineWidth(1);
   $pdf->SetLineWidth(10);
   $pdf->SetFont("Times","B","20");
   $pdf->Text(80,10,"Description matiere");
   $pdf->SetFont("Arial","B","10");
   $pdf->Text(30,50,"Nom matiere :  $r1 ");
   $pdf->Text(30,60,"DESCRIPTION matiere : $r4 ");
   $pdf->Text(30,70,"NOM MODULE  : $r2");
   $pdf->Text(30,80,"NOM FILIERE : $r3");


	$pdf->Output();
 }


if(isset($_POST['tl2']))
{
  
$test=$_POST['tl2'];
$rest = $_SESSION['info'];


$query = " INSERT INTO intervient(CODE_ENS,CODE_INTERVENTION,CODE_MAT) VALUES ('$rest','','$test') " ;
$result = mysqli_query($ma_connexion,$query); 
header('Location:Profil.php');
}


if(isset($_POST['tl3']))
{
  
$test=$_POST['tl3'];
$rest = $_SESSION['info'];


$query = " INSERT INTO matiere_enregistrées(CODE_ENS,CODE_MAT) VALUES ('$rest','$test') " ;

$result = mysqli_query($ma_connexion,$query); 

 header('Location:Profil.php');


 }



 ?>
