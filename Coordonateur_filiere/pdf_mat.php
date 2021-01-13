<?php  
include '../connexion.php';
require('mc_table.php');
 
if(isset($_POST['exporter3']))  
 {  
     $outp=$_POST['output3'];
    $outtes = explode(" ",$outp);

      $pdf=new PDF_MC_Table();
      $pdf->AddPage();
      $pdf->SetDrawColor(255,150,100);

      $pdf->SetFont('Arial','',10);

      //Table de 20 lignes et 4 colonnes
        

      if(isset($_POST['titre']) && isset($_POST['volume']) && isset($_POST['Programme']))
      {
      $pdf->SetWidths(array(40,40,20,20,15,10,10,25));
      srand(microtime()*1000000);
      $pdf->Row(array('Nom matiere','Nom Module','Semestre','VGlobale','VCours','VTD','VTP','Programme')); 
      }
      
      elseif(isset($_POST['titre']) && isset($_POST['volume']) )
      {
      $pdf->SetWidths(array(40,40,20,20,20,15,15));
      srand(microtime()*1000000);
      $pdf->Row(array('Nom matiere','Nom Module','Semestre','VGlobale','VCours','VTD','VTP'));
      }

      elseif(isset($_POST['titre']) && isset($_POST['Programme']))
      {
      $pdf->SetWidths(array(50,50,30,40));
      srand(microtime()*1000000);
      $pdf->Row(array('Nom matiere','Nom Module','Semestre','Programme'));
      }

      elseif(isset($_POST['titre']))
      {
      $pdf->SetWidths(array(60,60,50));
      srand(microtime()*1000000);
      $pdf->Row(array('Nom matiere','Nom Module','Semestre'));
      }

      

    if(isset($_POST['titre']))
      {
        if(isset($_POST['volume']))
          {  
            if(isset($_POST['Programme']))
            {

    foreach ($outtes as  $value) 
    {
      if($value != "")
      {

          $query="select Ma.NOM_MAT as NOM_MAT , Ma.VOLUME_HORAIRE_MAT AS VG ,Mo.NOM_MODU as NOM_MODU , Mo.ID_SEMSTRE as ID_SEMSTRE,Ma.VOLUME_COURS_MAT as VC , Ma.VOLUME_TD_MAT as VTD ,Ma.VOLUME_TP_MAT as VTP
          from matiere Ma , module Mo
          where Ma.CODE_MODU=Mo.CODE_MODU
          AND Ma.CODE_MAT='$value' ";

          $result = mysqli_query($ma_connexion, $query); 

          while($row = mysqli_fetch_array($result))
          {
          $pdf->Row(array(utf8_decode($row['NOM_MAT']),utf8_decode($row['NOM_MODU']),$row['ID_SEMSTRE'],$row['VG'],$row['VC'],$row['VTD'],$row['VTP'],utf8_decode('chargé')));
          }
          }
        }
        $pdf->Output('D','Descriptif filiere.pdf');
      }
      else
      {
        foreach ($outtes as  $value) 
    {
      if($value != "")
      {

          $query="select Ma.NOM_MAT as NOM_MAT , Ma.VOLUME_HORAIRE_MAT AS VG ,Mo.NOM_MODU as NOM_MODU , Mo.ID_SEMSTRE as ID_SEMSTRE,Ma.VOLUME_COURS_MAT as VC , Ma.VOLUME_TD_MAT as VTD ,Ma.VOLUME_TP_MAT as VTP
          from matiere Ma , module Mo
          where Ma.CODE_MODU=Mo.CODE_MODU
          AND Ma.CODE_MAT='$value' ";

          $result = mysqli_query($ma_connexion, $query); 

          while($row = mysqli_fetch_array($result))
          {
          $pdf->Row(array(utf8_decode($row['NOM_MAT']),utf8_decode($row['NOM_MODU']),$row['ID_SEMSTRE'],$row['VG'],$row['VC'],$row['VTD'],$row['VTP']));
          }
          }
        }
        $pdf->Output('D','Descriptif filiere.pdf');
      }
    }
      else if(isset($_POST['Programme']))
      {
  foreach ($outtes as  $value) 
    {
      if($value != "")
      {
          $query="select Ma.NOM_MAT as NOM_MAT ,Mo.NOM_MODU as NOM_MODU , Mo.ID_SEMSTRE as ID_SEMSTRE
          from matiere Ma , module Mo
          where Ma.CODE_MODU=Mo.CODE_MODU
          AND Ma.CODE_MAT='$value' ";

          $result = mysqli_query($ma_connexion, $query); 

          while($row = mysqli_fetch_array($result))
          {
          $pdf->Row(array(utf8_decode($row['NOM_MAT']),utf8_decode($row['NOM_MODU']),$row['ID_SEMSTRE'],utf8_decode('chargé')));
          }
          
         
      }
        
      } 
 $pdf->Output('D','Descriptif filiere.pdf');
  }
  else 
      {
  foreach ($outtes as  $value) 
    {
      if($value != "")
      {
          $query="select Ma.NOM_MAT as NOM_MAT ,Mo.NOM_MODU as NOM_MODU , Mo.ID_SEMSTRE as ID_SEMSTRE
          from matiere Ma , module Mo
          where Ma.CODE_MODU=Mo.CODE_MODU
          AND Ma.CODE_MAT='$value' ";

          $result = mysqli_query($ma_connexion, $query); 

          while($row = mysqli_fetch_array($result))
          {
          $pdf->Row(array(utf8_decode($row['NOM_MAT']),utf8_decode($row['NOM_MODU']),$row['ID_SEMSTRE']));
          }
          
         
      }
        
      } 
 $pdf->Output('D','Descriptif filiere.pdf');
  }



}
}

?> 