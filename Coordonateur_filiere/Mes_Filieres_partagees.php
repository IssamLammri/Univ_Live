<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];
if ( $Etat == "coordonateur filiere")
{
  $rest = $_SESSION['info'];
  $test="SELECT count(CODE_CORD_DEM) as nb FROM `filiere_demandes`  where  CODE_FIL IN ( SELECT CODE_FIL
                                                                               FROM filiere f
                                                                               WHERE f.CODE_COR_FIL = $rest ) ; ";
  $result=mysqli_query($ma_connexion,$test);
  if(mysqli_num_rows($result) > 0)  
    {
  while($row = mysqli_fetch_array($result))  
      { 
  $nb_d=$row['nb'];
    }
  }
  $req  = ($bd->query('Select  CF.PRENOM_COR_FIL,CF.NOM_COR_FIL,SP.CODE_SPEC,GR.NOM_GRAD,GR.CODE_GRAD,SP.NOM_SPEC,CF.SPCIALITE_COR_FIL, CF.CODE_DEPT from coordonateur_filiere CF,grade_crm GR,specialite_crm SP WHERE CODE_COR_FIL  ="' . $rest . '" AND SP.CODE_SPEC=CF.SPCIALITE_COR_FIL AND GR.CODE_GRAD=CF.GRADE_COR_FIL'));
  $req2 = ($bd->query('select  U.NOM_UNIVERSITE , E.NOM_ETA                      from coordonateur_filiere as C  , etablissement as E  , universite as U where  C.CODE_COR_FIL="' . $rest . '" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
  $req3 = ($bd->query('select  U.NOM_UNIVERSITE , E.NOM_ETA                      from coordonateur_filiere as C  , etablissement as E  , universite as U where  C.CODE_COR_FIL="' . $rest . '" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
  $req4 = ($bd->query('Select  count(CODE_FIL)as Nombre_Fil                      from filiere                                                            WHERE    CODE_COR_FIL  ="' . $rest . '"'));
  $req5 = ($bd->prepare('Select   NOM_FIL                                        from filiere                                                            WHERE    CODE_COR_FIL  ="' . $rest . '"'));
  $req6 = ($bd->prepare('Select   CODE_FIL                                       from filiere                                                            WHERE    CODE_COR_FIL  ="' . $rest . '"'));
  $ress = $req->fetch();
  $ress1= $req4->fetch();
  $req5->execute();
  $ress2  =  $req5->fetchAll();
  $prenom = $ress['PRENOM_COR_FIL'];
  $nom    = $ress['NOM_COR_FIL'];
  $sep    = $ress['NOM_SPEC'];
  $code_dep = $ress['CODE_DEPT'];
  $nb     = $ress1['Nombre_Fil'];
  $nb     = $nb-1;


  $req44 = ($bd->query('SELECT count(CODE_FIL) as Nombre_fil FROM filiere_partagee WHERE CODE_CORF_v="'.$rest.'" or CODE_CORF_v=0'));
  $req55 = ($bd->prepare('SELECT  m.NOM_FIL FROM filiere_partagee as i , filiere as m WHERE (i.CODE_CORF_v="'.$rest.'" or  i.CODE_CORF_v="0") and i.CODE_FIL=m.CODE_FIL '));

  $req99 = ($bd->prepare('SELECT i.CODE_CORF_C FROM filiere_partagee as i , filiere as m WHERE (i.CODE_CORF_v="'.$rest.'" or  i.CODE_CORF_v="0") and i.CODE_FIL=m.CODE_FIL '));

  $req66 = ($bd->prepare('SELECT  m.CODE_FIL FROM filiere_partagee as i , filiere as m WHERE (i.CODE_CORF_v="'.$rest.'" or i.CODE_CORF_v="0") and i.CODE_FIL=m.CODE_FIL '));

  $req55->execute();
  $req99->execute();
  $req66->execute();
  $ress11= $req44->fetch();
  $ress66= $req66->fetchAll();
  $ress22  =  $req55->fetchAll();
  $ress99 = $req99->fetchAll();
  $nb1     = $ress11['Nombre_fil'];
  $nb1     = $nb1-1;

  if (isset($_POST['accederMAT']))
  {
    $id  = $_POST['filierActive']; 
    $req66->execute();
    $ress3=$req66->fetchAll();
    $idf = implode($ress3[$id]);
    
    
    
    
    
  
    $_SESSION['idf']=$idf;
    $_SESSION['TESTcorORbon']='1';
    header('Location:../Coordonateur_filiere/ListeF.php');
  }
  
  if(isset($_POST['valider']))
  { 

    $id  = $_POST['output']; 
    $req6->execute();
      $ress3=$req6->fetchAll();
    $idf = implode($ress3[$id]);
    $_SESSION['idf']=$idf;
    $mat=$_SESSION['idf'];

    if(isset($_POST['multiselect']) && !empty($_POST['multiselect']))
    {
    $Col1_Array = $_POST['multiselect'];
      foreach($Col1_Array as $selectValue)
        {
        try {
          $test  = ($bd->query('INSERT INTO matiere_partagee(CODE_MAT,CODE_ENS_V, CODE_ENS_C) VALUES ("'.$mat.'","'.$selectValue.'","'.$rest.'")'));
        } catch (Exception $e) 
        {
          echo "Error: " . $e->getMessage();  
        }
    }
    header('Location:Mes_Matieres.php');
    }
  }
  
  if(isset($_POST['supprimer1']))
  {
    $id  = $_POST['id']; 
    $req66->execute();
    $ress3=$req66->fetchAll();
    $idf = implode($ress3[$id]);
    
    $sql= "DELETE FROM `filiere_partagee` WHERE CODE_FIL = '$idf'  AND CODE_CORF_v =  $rest ";
             
        if (mysqli_query($ma_connexion, $sql)) {
      
      echo "
        <script>
        swal(
            'succès',
            'La filière a bien été supprimée !',
            'success'
          )
         </script>
      ";
      echo "<meta http-equiv='refresh' content='0' />"; 
      
    } else {

    }
  
  }
  if(isset($_POST['Ajouter']))
  {
    
    $id  = $_POST['id']; 
    $req66->execute();
    $ress3=$req66->fetchAll();
    $idf = implode($ress3[$id]);
    
  
  
    
        $idmodnew= null ;
        $query001 = "SELECT COUNT(*) as nbasavoir
                  FROM filiere";  
                  
        $result = mysqli_query($ma_connexion, $query001);
        
        $idmodnew = null ;            
        if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) {
            $idmodnew = $row["nbasavoir"] ; 
            $idmodnew++; 
          }
        } else {
          echo "0 results";
        }   
        
        $idFILIERE_NEW ="F".$idmodnew ;   
        
        $query001 = "SELECT * FROM filiere
                  where  CODE_FIL = '$idf' "; 
                  
        $result = mysqli_query($ma_connexion, $query001);
        
                  
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              $CODE_DEPT =   mysqli_real_escape_string($ma_connexion,$row["CODE_DEPT"]) ;         
              $NOM_FIL =  mysqli_real_escape_string($ma_connexion,$row["NOM_FIL"]) ;
              $OBJECTIFS_FORMATION =  mysqli_real_escape_string($ma_connexion,$row["OBJECTIFS_FORMATION"]) ;
              $CONDITION_D_ACCEES = mysqli_real_escape_string($ma_connexion,$row["CONDITION_D_ACCEES"]) ;
              $ACCES_PAR_PASSERELLE = mysqli_real_escape_string($ma_connexion,$row["ACCES_PAR_PASSERELLE"]) ;
              $NATURE_DIPLOME = mysqli_real_escape_string($ma_connexion,$row["NATURE_DIPLOME"]) ;
              $SPICIALITE_DIPLOME = mysqli_real_escape_string($ma_connexion,$row["SPICIALITE_DIPLOME"]) ;
              // $Date_Debut = mysqli_real_escape_string($ma_connexion,$row["Date_Debut"]) ;
              // $Date_fin = mysqli_real_escape_string($ma_connexion,$row["Date_fin"]) ;              
              $MOTS_CLES = mysqli_real_escape_string($ma_connexion,$row["MOTS_CLES"]) ; 
              
              // echo $Date_Debut ; 
              // echo $Date_fin ; 
              
              // if ($Date_Debut == '')
                // $Date_Debut = null ;
              
              // if ($Date_fin == '')
                // $Date_fin = null ;
              
              
              
            }
          } 
          
        
          
          $sql = " INSERT INTO `filiere`(`CODE_FIL`, `CODE_DEPT`, `CODE_COR_FIL`, `NOM_FIL`, `OBJECTIFS_FORMATION`, `CONDITION_D_ACCEES`, `ACCES_PAR_PASSERELLE`, `NATURE_DIPLOME`, `SPICIALITE_DIPLOME`, `MOTS_CLES`) 
                      VALUES ('$idFILIERE_NEW','$code_dep','$rest','$NOM_FIL','$OBJECTIFS_FORMATION','$CONDITION_D_ACCEES','$ACCES_PAR_PASSERELLE','$NATURE_DIPLOME','$SPICIALITE_DIPLOME','$MOTS_CLES') ; "; 
          
          if (mysqli_query($ma_connexion, $sql)) {
          
          } else {
            // echo "Error updating record: aa  fili" . mysqli_error($ma_connexion);
          }
          
          
          $query001 = "SELECT decipline_FIL FROM `decipline_filiere` WHERE CODE_FIL = '$idf'";  
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              $decipline_FIL = mysqli_real_escape_string($ma_connexion,$row["decipline_FIL"]) ; 

              mysqli_query($ma_connexion,"INSERT INTO `decipline_filiere`(`CODE_FIL`, `decipline_FIL`)
                       VALUES('$idFILIERE_NEW','$decipline_FIL') ");
            }
          }
          
          $query001 = "SELECT OPTION_FIL FROM `option_filiere` WHERE CODE_FIL = '$idf'";  
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              $OPTION_FIL = mysqli_real_escape_string($ma_connexion,$row["OPTION_FIL"]) ; 

              mysqli_query($ma_connexion,"INSERT INTO `option_filiere`(`CODE_FIL`, `OPTION_FIL`)
                       VALUES('$idFILIERE_NEW','$OPTION_FIL') ");
            }
          }
          
          
          $query001 = "SELECT CODE_DEBOUCHE_FOR
                        FROM formation_debouche
                        where CODE_FIL = '$idf'"; 
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              $CODE_DEBOUCHE_FOR = mysqli_real_escape_string($ma_connexion,$row["CODE_DEBOUCHE_FOR"]) ; 
              

              mysqli_query($ma_connexion,"INSERT INTO `formation_debouche`(`CODE_FIL`, `CODE_DEBOUCHE_FOR`)
                       VALUES('$idFILIERE_NEW','$CODE_DEBOUCHE_FOR') ");
            }
          }
          
          
          $query001 = "SELECT   CODE_COMP
                        FROM compfiliere
                        where CODE_FIL = '$idf'"; 
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              $CODE_COMP = mysqli_real_escape_string($ma_connexion,$row["CODE_COMP"]) ; 
              

              mysqli_query($ma_connexion,"INSERT INTO `compfiliere`(`CODE_FIL`, `CODE_COMP`, `taux`) 
                       VALUES('$idFILIERE_NEW','$CODE_COMP',0) ");
            }
          }
          
          $query001 = "SELECT   EFFECTIF , promotion
                        FROM effectifs
                        where CODE_FIL = '$idf'"; 
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              
              $EFFECTIF = mysqli_real_escape_string($ma_connexion,$row["EFFECTIF"]) ; 
              $promotion = mysqli_real_escape_string($ma_connexion,$row["promotion"]) ; 
              

              mysqli_query($ma_connexion,"INSERT INTO `effectifs`(`CODE_FIL`, `EFFECTIF`, `promotion`) 
                       VALUES('$idFILIERE_NEW','$EFFECTIF','$promotion') ");
            }
          }else{
            // echo "Error updating effec : " . mysqli_error($ma_connexion);
          }
          
          
          
          
          $query001 = "SELECT   *
                        FROM module
                        where CODE_FIL = '$idf'"; 
                
          $result = mysqli_query($ma_connexion, $query001);
            
          if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
              
              
              $CODE_MODU = mysqli_real_escape_string($ma_connexion,$row["CODE_MODU"]) ; 
              $ID_SEMSTRE = mysqli_real_escape_string($ma_connexion,$row["ID_SEMSTRE"]) ; 
              $NOM_MODU = mysqli_real_escape_string($ma_connexion,$row["NOM_MODU"]) ; 
              $VOLUME_HORAIRE_MODU = mysqli_real_escape_string($ma_connexion,$row["VOLUME_HORAIRE_MODU"]) ; 
              $VOLUME_COURS_MODU = mysqli_real_escape_string($ma_connexion,$row["VOLUME_COURS_MODU"]) ; 
              $VOLUME_TD_MODU = mysqli_real_escape_string($ma_connexion,$row["VOLUME_TD_MODU"]) ; 
              $VOLUME_TP_MODU = mysqli_real_escape_string($ma_connexion,$row["VOLUME_TP_MODU"]) ; 
              $VOLUME_AP_MODU = mysqli_real_escape_string($ma_connexion,$row["VOLUME_AP_MODU"]) ; 
              $Evaluation_connaissances = mysqli_real_escape_string($ma_connexion,$row["Evaluation_connaissances"]) ; 
              
              
              $bbbbb = $idFILIERE_NEW."%" ; 
              $queryTEST = "SELECT COUNT(*) as nbasavoir
                      FROM module
                      WHERE CODE_MODU LIKE '$bbbbb'"; 
                      
              $resulttest = mysqli_query($ma_connexion, $queryTEST);
              
              $idmodnew = null ;            
              if (mysqli_num_rows($resulttest) > 0) {
                
                while($row = mysqli_fetch_assoc($resulttest)) {
                  $idmodnew = $row["nbasavoir"] ; 
                  $idmodnew++; 
                  
                }
              } else {
                // echo "0 results";
              }   
              
              $residadd = $idFILIERE_NEW."MD".$idmodnew ; 
              
              $sqlfinall = "INSERT INTO `module`(`CODE_MODU`, `CODE_COR_MODU`, `CODE_FIL`, `ID_SEMSTRE`, `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`)
                                      VALUES ('$residadd',null,'$idFILIERE_NEW','$ID_SEMSTRE','$NOM_MODU','$VOLUME_HORAIRE_MODU','$VOLUME_COURS_MODU','$VOLUME_TD_MODU','$VOLUME_TP_MODU','$VOLUME_AP_MODU','$Evaluation_connaissances')";

              
              if (mysqli_query($ma_connexion, $sqlfinall)) {
                
                $quryFORmod1 = "SELECT CODE_OBJECTIF_MODU FROM `objectifs_modules` WHERE CODE_MODU = '$CODE_MODU'"; 
                
                $resultFORmod1 = mysqli_query($ma_connexion, $quryFORmod1);
                  
                if (mysqli_num_rows($resultFORmod1) > 0) {
                  
                  while($row = mysqli_fetch_assoc($resultFORmod1)) {
                    $CODE_OBJECTIF_MODU = $row["CODE_OBJECTIF_MODU"];

                    mysqli_query($ma_connexion,"INSERT INTO `objectifs_modules`(`CODE_MODU`, `CODE_OBJECTIF_MODU`)
                           VALUES('$residadd','$CODE_OBJECTIF_MODU') ");
                  }
                }
                
                
                $quryFORmod1 = "SELECT code_pre FROM `module_prerequis` WHERE CODE_MODU = '$CODE_MODU'";  
                
                $resultFORmod1 = mysqli_query($ma_connexion, $quryFORmod1);
                  
                if (mysqli_num_rows($resultFORmod1) > 0) {
                  
                  while($row = mysqli_fetch_assoc($resultFORmod1)) {
                    $code_pre = $row["code_pre"];

                    mysqli_query($ma_connexion,"INSERT INTO `module_prerequis`(`CODE_MODU`, `code_pre`)
                           VALUES('$residadd','$code_pre') ");
                  }
                }
                
                
                
                $quryFORmod1 = "SELECT CODE_DIDACTIQUE_MODU FROM `module_didactique` WHERE CODE_MODU = '$CODE_MODU'"; 
                
                $resultFORmod1 = mysqli_query($ma_connexion, $quryFORmod1);
                  
                if (mysqli_num_rows($resultFORmod1) > 0) {
                  
                  while($row = mysqli_fetch_assoc($resultFORmod1)) {
                    $CODE_DIDACTIQUE_MODU = $row["CODE_DIDACTIQUE_MODU"];

                    mysqli_query($ma_connexion,"INSERT INTO `module_didactique`(`CODE_MODU`, `CODE_DIDACTIQUE_MODU`)
                           VALUES('$residadd','$CODE_DIDACTIQUE_MODU') ");
                  }
                }
                
                
                $quryFORmod1 = "SELECT CODE_COMP , taux  FROM `compmodule` WHERE CODE_MODU = '$CODE_MODU'"; 
                
                $resultFORmod1 = mysqli_query($ma_connexion, $quryFORmod1);
                  
                if (mysqli_num_rows($resultFORmod1) > 0) {
                  
                  while($row = mysqli_fetch_assoc($resultFORmod1)) {
                    $CODE_COMP = $row["CODE_COMP"];
                    $taux = $row["taux"];

                    mysqli_query($ma_connexion,"INSERT INTO `compmodule`(`CODE_MODU`, `CODE_COMP`, `taux`) VALUES ('$residadd','$CODE_COMP','$taux')
                    ");
                  }
                }
                
                
                
                $queryImpossible = "SELECT * FROM matiere where CODE_MODU = '$CODE_MODU'";  
                
                $resultImpossible = mysqli_query($ma_connexion, $queryImpossible);
                  
                if (mysqli_num_rows($result) > 0) {
                
                  while($row = mysqli_fetch_assoc($resultImpossible)) {
                    $NOM_MAT = mysqli_real_escape_string($ma_connexion,$row["NOM_MAT"]) ; 
                    $DESCRIPTION_MAT = mysqli_real_escape_string($ma_connexion,$row["DESCRIPTION_MAT"]) ; 
                    $SEPCIALITE_MAT = mysqli_real_escape_string($ma_connexion,$row["SEPCIALITE_MAT"]) ; 
                    $VOLUME_HORAIRE_MAT = $row["VOLUME_HORAIRE_MAT"] ; 
                    $VOLUME_COURS_MAT = $row["VOLUME_COURS_MAT"] ; 
                    $VOLUME_TD_MAT = $row["VOLUME_TD_MAT"] ; 
                    $VOLUME_TP_MAT = $row["VOLUME_TP_MAT"] ; 
                    $VOLUME_AP_MAT = $row["VOLUME_AP_MAT"] ; 
                    $ACTIVITE_PRATIQUE = $row["ACTIVITE_PRATIQUE"] ; 
                    $type_cour = $row["type_cour"] ; 
                    
                    
                    

                    $sqlMatiere = "INSERT INTO `matiere`(`CODE_MODU`, `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `type_cour`) 
                                           VALUES('$residadd','$NOM_MAT','$DESCRIPTION_MAT','$SEPCIALITE_MAT','$VOLUME_HORAIRE_MAT','$VOLUME_COURS_MAT','$VOLUME_TD_MAT','$VOLUME_TP_MAT','$VOLUME_AP_MAT','$ACTIVITE_PRATIQUE','$type_cour') ";
                  
                    
                    if (mysqli_query($ma_connexion, $sqlMatiere)) {
                      
                  
                    } else {
                      // echo "Error updating record: matt " . mysqli_error($ma_connexion);
                    }
                              
                    
                  
                  }
                }
          
                
            
              } else {
                
                // echo "Error updating record finall : " . mysqli_error($ma_connexion);
              }
            
            }
          }else {
            // echo "Error updating module : " . mysqli_error($ma_connexion);
          }
          
          
          
          
          
          echo "<script>
            swal(
              'AJOUTER!',
              'LA FILIERE A BIEN ETE AJOUTER .',
              'success'
              )
            
          </script>" ;
          

        mysqli_query($ma_connexion,"DELETE FROM `filiere_partagee` WHERE `CODE_FIL` = '$idf' and CODE_CORF_v = '$rest' ");          
          
          
          unset($_SESSION['TESTcorORbon']);

          // header('Location: Mes_Filieres.php');
          header( "refresh:1;url=Mes_Filieres.php" );
          
          
          
            
          

  }
}

if(isset($_POST['Quitter']))
{  
  
 // Inialize session
  session_start();

// Delete certain session
  unset($_SESSION['NIV']);
  // Delete all session variables
  // session_destroy();
  session_destroy();
 // Jump to login page
header('Location: ../login/login.php');

}

if (!isset($_SESSION['NIV'])) 
{
header('Location: ../login/login.php');
}





?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Mes Filières partagées</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">  
  <link rel="stylesheet" type="text/css" href="../css/ionicons.min.css">  
  <!-- Theme style -->
  <!-- jQuery -->
    <script src="../js/jquery.js"></script>
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src="../js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">  
  <script src="../js/sweetalert2.min.js"></script>

    <script src="../js/jquery.knob.min.js"></script>
    <script src="../js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="../css/jquery-confirm.min.css">
  <script src="../js/jquery-confirm.min.js"></script>
  <script type="text/javascript">
  $(function() {
    $('#Mes_Filieres_partagees').addClass("active");
  });
  </script>

<style>
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 900px;
    	width: 240px;
    }
     .row.content {height: auto;}
	 
	 
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
	 
  </style>
</head>
<body class="sidebar-mini wysihtml5-supported skin-blue">
<div class="wrapper">

<?php include("../includes/header.php"); ?>
<?php include("../includes/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mes filières
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form method="POST">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informations sur la filiere partagée :</h4>
      </div>

      <div class="modal-body" style="height: 150px;">

          <div class="form-group" id="hahaha">
          </div>
          
      </div>
      <input type="hidden" name="filierActive" id="filierActive" >
      <div class="modal-footer">
        <button type="submit" name="accederMAT" class="btn btn-primary">Acceder</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
      </div>
          
    </div>
  </form>
  </div>
</div>




            <div class="modal fade" id="ajouterFILMODAL" role="dialog">
    <div class="modal-dialog">
      <form method="PPOST" class="formName">
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> PARAMETRE FILIERE </h4>
          </div>
          <div class="modal-body">
             
                <div class="form-group">
                
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value=""  class="form-control" id="modue_CHOIX" > 
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                      LES DECIPLINE
                    </label>
                  </div>
                  
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value=""  class="form-control" id="modue_CHOIX" > 
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                      LES OPTIONS
                    </label>
                  </div>
                  
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value=""  class="form-control" id="modue_CHOIX" > 
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                      LES MODULES
                    </label>
                  </div>
                  
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value=""  class="form-control" id="modue_CHOIX" > 
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                      LES MATIERES
                    </label>
                  </div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
          </div>
          </div>
      </form>
    
    </div>
 </div>



        <div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mes Filieres Partagées : <?php echo $nb1+1  ?></h3>
            </div>
            <?php
            for ($i = 0 ; $i <= $nb1 ; $i++) 
              {
                $code_cor_pa=implode($ress99[$i]);
                $NomF =implode($ress22[$i]);
                $j=$i+1;
            echo '
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Filière '.$j.' : '.$NomF.'
                      </a>
                    </h4>
                    <div class="btn-group pull-right">
                  <form method="post">
                  <button type="button" name="info" class="btn btn-primary" id="mod'.$i.'" value="'.$code_cor_pa.'" onClick="afficher(this,'.$i.')"><span class="glyphicon glyphicon-eye-open">&nbsp;information</span></button>
                  <button type="submit" name="Ajouter" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign">&nbsp;Ajouter</span></button></li>
                    <button type="submit" name="supprimer1" class="btn btn-danger"><span class="glyphicon glyphicon-trash">&nbsp;Supprimer</span></button>
                    <input type="text" name="id" value='.$i.' hidden>
                    </form>
                </div>
                  </div>
                </div>
              </div>
            </div>';
          }
            ?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>By DAL</b>
    </div>
    <strong>Copyright &copy; 2017-2018</strong> All rights
    reserved.
  </footer>

  
</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/sweetalert2.min.js"></script>
 <script>

function afficher(objButton,idActive) 
{
    var testin = objButton.value;
    $("#myModal").modal();

    $.ajax({  
                     url:"nom_cor_part.php",
                     method:"POST",  
                     data:{testin:testin},  
                     success:function(data)  
                     {  
                          $('#hahaha').fadeIn();  
                          $('#hahaha').html(data);  
                     }  
             }); 
       
    $("#filierActive").val(idActive);
}

</script>

  <script>
       /*$("#ajouterFIL").click(function(){
         $("#ajouterFILMODAL").modal("show");
      });*/
    </script>

</body>
</html>
