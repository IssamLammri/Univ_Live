<meta charset="UTF-8">
<?php


session_start();
include '../connexion.php';
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


$query = " INSERT INTO intervient(CODE_ENS,CODE_MAT) VALUES ('$rest','$test') " ;
$result = mysqli_query($ma_connexion,$query); 
header('Location:Profil.php');
}



if(isset($_POST['tl3']))
{
  
$test=$_POST['tl3'];
$rest = $_SESSION['info'];

$query = " INSERT INTO matiere_enregistrées(CODE_ENS,CODE_MAT) VALUES ('$rest','$test') " ;

$result = mysqli_query($ma_connexion,$query); 

 header('Location: ../Profil/profil.php');

 }

if(isset($_POST['testin']))
{


  $nomMatyy = $_POST['testin'];
  $query = "select M.NOM_MAT AS NOM_MAT,M.VOLUME_HORAIRE_MAT,M.VOLUME_COURS_MAT,M.VOLUME_TD_MAT,M.VOLUME_TP_MAT, MO.NOM_MODU AS NOM_MODU , F.NOM_FIL AS NOM_FIL , M.CODE_MAT AS CODE_MAT , D.NOM_DEPT as NOM_DEPT,Et.NOM_ETA as NOM_ETA
              from matiere M , module MO , filiere F,Departement D,etablissement Et
              where M.CODE_MODU=MO.CODE_MODU
              AND MO.CODE_FIL=F.CODE_FIL
              AND F.CODE_DEPT=D.CODE_DEPT
              AND D.CODE_ETA=Et.CODE_ETA
              AND M.CODE_MAT = '$nomMatyy' " ;
              $result = mysqli_query($ma_connexion,$query); 
              if(mysqli_num_rows($result) > 0)  
                {  
              while($row = mysqli_fetch_array($result))  
                {
                  echo '
        <label><input class="form-control" type="text" style="width: 526px;" value="Matiere :'.ucfirst(strtolower($row['NOM_MAT'])).'" readonly></label><br>       
     <label><input class="form-control" type="text" style="width: 526px;" value="Module :'.ucfirst(strtolower($row['NOM_MODU'])).'" readonly></label><br>        
        <label><input class="form-control" type="text" style="width: 526px;" value="Filiere :'.ucfirst(strtolower($row['NOM_FIL'])).'" readonly></label><br>
     <label><input class="form-control" type="text" style="width: 526px;" value="Departement :'.ucfirst(strtolower($row['NOM_DEPT'])).'" readonly></label><br>     
    <label><input class="form-control" type="text" style="width: 526px;" value="Etablissement :'.ucfirst(strtolower($row['NOM_ETA'])).'" readonly></label><br>
    <label><input class="form-control" type="text" style="width: 526px;" value="Volume Globale :'.ucfirst(strtolower($row['VOLUME_HORAIRE_MAT'])).'" readonly></label><br>
       <label><input class="form-control" type="text" style="width: 526px;" value="Volume Cours :'.ucfirst(strtolower($row['VOLUME_COURS_MAT'])).'" readonly></label><br>
       <label><input class="form-control" type="text" style="width: 526px;"  value="Volume TD :'.ucfirst(strtolower($row['VOLUME_TD_MAT'])).'" readonly></label><br>
       <label> <input class="form-control" type="text" style="width: 526px;" value="Volume TP :'.ucfirst(strtolower($row['VOLUME_TP_MAT'])).'" readonly></label><br>';
                }
              }

}




 ?>
