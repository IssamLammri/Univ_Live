<?php
include '../connexion.php';
?>

<?php
session_start();
$Etat = $_SESSION['NIV'];
if ( $Etat =="coordonateur filiere") 
{
  $rest = $_SESSION['info'];
  
  $req=($bd->query('Select CF.PRENOM_COR_FIL,CF.PSEUDO,CF.NOM_COR_FIL,CF.EMAIL_COR_FIL,CF.TELE_COR_FIL,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_filiere CF,departement D WHERE CODE_COR_FIL="'.$rest.'" AND CF.CODE_DEPT=D.CODE_DEPT'));

  $req1  = ($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from coordonateur_filiere CF,specialite_crm SP WHERE CF.CODE_COR_FIL ="'.$rest.'" AND SP.CODE_SPEC=CF.SPCIALITE_COR_FIL'));

  $req3  = ($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from coordonateur_filiere CF,grade_crm GR WHERE CF.CODE_COR_FIL ="'.$rest.'" AND GR.CODE_GRAD=CF.GRADE_COR_FIL'));



  $req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_filiere as C,etablissement as E,universite as U where C.CODE_COR_FIL="'.$rest.'" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE ;'));


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


  $req4 = ($bd->query('Select count(CODE_FIL)as Nombre_Fil from filiere WHERE CODE_COR_FIL="'.$rest.'"'));
  $req5 = ($bd->prepare('Select NOM_FIL from filiere WHERE CODE_COR_FIL="'.$rest.'"'));
  $req6 = ($bd->prepare('Select CODE_FIL from filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));

  $ress = $req->fetch();
  $ress11 = $req1->fetch();
  $ress22 = $req3->fetch();
  $ress1= $req4->fetch();
  $ress3= $req2->fetch();
  $req5->execute();
  $ress2  =  $req5->fetchAll();
  $prenom = $ress['PRENOM_COR_FIL'];
  $nom    = $ress['NOM_COR_FIL'];
  $Pseudo    = $ress['PSEUDO'];
  $sep    = $ress11['NOM_SPEC'];
  $code_sep=$ress11['CODE_SPEC'];
  $grade = $ress22['NOM_GRAD'];
  $code_grade = $ress22['CODE_GRAD'];
  $email    = $ress['EMAIL_COR_FIL'];
  $tele    = $ress['TELE_COR_FIL'];
  $nom_dept = $ress['nom_dept'];
  $code_dept=$ress['code_dept'];
  $nom_uni=$ress3['nom_uni'];
  $nom_etab=$ress3['nom_eta'];
  $code_uni=$ress3['code_uni'];
  $code_eta=$ress3['code_eta'];
  $nb     = $ress1['Nombre_Fil'];
  $nb     = $nb-1;

  if(isset($_POST['exporter']))
    {
      
       
    if (!empty($_POST['nomfiliere'] ))
    {
      $nomfil=$_POST['nomfiliere'];
      
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
        
        $residadd ="F".$idmodnew ; 
        
        
        $sql1="INSERT INTO `filiere`(`CODE_FIL`, `CODE_DEPT`, `CODE_COR_FIL`, `NOM_FIL`) 
            VALUES ('$residadd','$code_dept','$rest','$nomfil')";
            
        if (mysqli_query($ma_connexion, $sql1)) {
          
          
          $_SESSION['idf']=$residadd;
          header('Location:../Coordonateur_filiere/ListeF.php');
        
        
          } else {
            
            
            echo "Error updating record: " . mysqli_error($ma_connexion);
          }     
        
        
    }
    else{
    
      echo "
        <script>
      swal(
                  'Oups...',
                  'Un erreur c\'est produit !',
                  'error'
                )
       </script>
      ";
       

      }
    }

    if(isset($_POST['Modifier1']))
  {

    $code_uni=$_POST['universite'];
    $code_etab=$_POST['etablissement'];
    $code_dept=$_POST['departement'];
    $nom=$_POST['nom'];
    $Pseudo=$_POST['username'];
    $prenom=$_POST['prenom'];
    $grade=$_POST['grade'];
    $spec=$_POST['Specialite'];
    $email=$_POST['email'];
    $tele=$_POST['tele'];

  $sql= "UPDATE `coordonateur_filiere` SET `CODE_ETA`=$code_etab,`CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_COR_FIL`='".$nom."',`PRENOM_COR_FIL`='".$prenom."',`SPCIALITE_COR_FIL`='".$spec."',`GRADE_COR_FIL`='".$grade."',`EMAIL_COR_FIL`='".$email."',`TELE_COR_FIL`='".$tele."' WHERE `CODE_COR_FIL`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
  }




}
elseif ( $Etat == "enseignant")
{
  $rest = $_SESSION['info'];

  $req  = ($bd->query('Select E.PRENOM_ENS,E.NOM_ENS,E.PSEUDO,E.EMAIL_ENS,E.TELE_ENS,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from enseignant E,departement D WHERE E.CODE_ENS ="'.$rest.'" AND D.CODE_DEPT=E.CODE_DEPT '));


  $req1 =($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from enseignant E,specialite_crm SP WHERE E.CODE_ENS="'.$rest.'" AND SP.CODE_SPEC=E.SPECIALTE_ENS'));

  $req3 =($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from enseignant E,grade_crm GR WHERE E.CODE_ENS ="'.$rest.'" AND GR.CODE_GRAD=E.GRADE_ENS'));




  $req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from enseignant as C,etablissement as E,universite as U,departement as D where C.CODE_ENS  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

  $req4 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM intervient WHERE CODE_ENS="'.$rest.'"'));
  $req5 = ($bd->prepare('SELECT   m.NOM_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT'));
  $req6 = ($bd->prepare('SELECT   m.CODE_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT '));
  $ress = $req->fetch();
  $ress3 = $req2->fetch();
  $ress1= $req4->fetch();
  $ress11 = $req1->fetch();
  $ress22 = $req3->fetch();
  $req5->execute();
  $ress2  =  $req5->fetchAll();
  $prenom = $ress['PRENOM_ENS'];
  $nom = $ress['NOM_ENS'];
  $Pseudo    = $ress['PSEUDO'];
  $sep    = $ress11['NOM_SPEC'];
  $code_sep=$ress11['CODE_SPEC'];
  $grade = $ress22['NOM_GRAD'];
  $code_grade = $ress22['CODE_GRAD'];
  $email    = $ress['EMAIL_ENS'];
  $tele    = $ress['TELE_ENS'];
  $nom_dept = $ress['nom_dept'];
  $code_dept=$ress['code_dept'];

  $nom_uni=$ress3['nom_uni'];
  $nom_etab=$ress3['nom_eta'];
  $code_uni=$ress3['code_uni'];
  $code_eta=$ress3['code_eta'];

  $nb     = $ress1['Nombre_Mat'];
  $nb     = $nb-1;
  $nb=$nb-1;


  $req44 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM matiere_partagee WHERE CODE_ENS_v="'.$rest.'" or CODE_ENS_v=0'));
  $req55 = ($bd->prepare('SELECT  m.NOM_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or  i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));
  $req66 = ($bd->prepare('SELECT  m.CODE_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));
  $req55->execute();
  $ress11= $req44->fetch();
  $ress22  =  $req55->fetchAll();
  $nb1     = $ress11['Nombre_Mat'];
  $nb1     = $nb1-1;



  if(isset($_POST['exporter1']))
  {
  $code_mat=$_POST['output'];
  $query ="INSERT INTO `matiere_demandees` (`CODE_ENS`,`CODE_MAT`) VALUES ('$rest','$code_mat')" ;
  $result=mysqli_query($ma_connexion,$query); 
  if($result == true)
  {}
  else
  echo "<script>alert('vous intervenez cette matiere')</script>";
  }

  if(isset($_POST['Modifier1']))
  {

    $code_uni=$_POST['universite'];
    $code_etab=$_POST['etablissement'];
    $code_dept=$_POST['departement'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $Pseudo=$_POST['username'];
    $grade=$_POST['grade'];
    $spec=$_POST['Specialite'];
    $email=$_POST['email'];
    $tele=$_POST['tele'];

  $sql= "UPDATE `enseignant` SET `CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_ENS`='".$nom."',`PRENOM_ENS`='".$prenom."',`SPECIALTE_ENS`='".$spec."',`GRADE_ENS`='".$grade."',`EMAIL_ENS`='".$email."',`TELE_ENS`='".$tele."' WHERE `CODE_ENS`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
  }


  if(isset($_POST['valider1']))
  {

  $newpassword=$_POST['newpassword'];
  $sql= "UPDATE `enseignant` SET `PASSWORD`='".$newpassword."' WHERE `CODE_ENS`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
  }

}

elseif ($Etat =="Coordonnateur Module")
{
  $rest = $_SESSION['info'];

  $nb_d="";

  $test="SELECT count(M.CODE_MAT) as nb FROM `matiere_demandees` Md,matiere M,Module Mo ,enseignant E WHERE md.CODE_MAT=M.CODE_MAT AND md.CODE_ENS=E.CODE_ENS AND md.CODE_MAT=M.CODE_MAT AND M.CODE_MODU=Mo.CODE_MODU AND Mo.CODE_COR_MODU='".$rest."' ";
  $result=mysqli_query($ma_connexion,$test);
  if(mysqli_num_rows($result) > 0)  
    {
  while($row = mysqli_fetch_array($result))  
      { 
  $nb_d=$row['nb'];
    }
  }

  
  $req=($bd->query('Select CM.PRENOM_COR_MODU,CM.PSEUDO,CM.NOM_COR_MODU,CM.EMAIL_COR_MODU, CM.TELE_COR_MODU, D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_module CM,departement D WHERE CM.CODE_COR_MODU="'.$rest.'" AND CM.CODE_DEPT=D.CODE_DEPT'));

  $req1 =($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from coordonateur_module CM,specialite_crm SP WHERE CM.CODE_COR_MODU="'.$rest.'" AND SP.CODE_SPEC=CM.SPECIALITE_COR_MODU'));

  $req3 =($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from coordonateur_module CM,grade_crm GR WHERE CM.CODE_COR_MODU ="'.$rest.'" AND GR.CODE_GRAD=CM.GRADE_COR_MODU'));


  $req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_module as CM,etablissement as E,universite as U,departement as D where CM.CODE_COR_MODU="'.$rest.'" and CM.CODE_DEPT=D.CODE_DEPT and CM.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

  $req4 = ($bd->query('Select  count(CODE_MODU)as Nombre_Modu from module WHERE CODE_COR_MODU="'.$rest.'"'));
  $req5 = ($bd->prepare('Select NOM_MODU from module WHERE CODE_COR_MODU="'.$rest.'"'));
  $req6 = ($bd->prepare('Select CODE_MODU from module WHERE CODE_COR_MODU  ="'.$rest.'"'));

  $ress = $req->fetch();
  $ress3 = $req2->fetch();
  $ress1= $req4->fetch();
  $ress11 = $req1->fetch();
  $ress22 = $req3->fetch();
  $req5->execute();
  $ress2  =  $req5->fetchAll();

  $prenom = $ress['PRENOM_COR_MODU'];
  $nom    = $ress['NOM_COR_MODU'];
  $Pseudo =$ress['PSEUDO'];
  $sep    = $ress11['NOM_SPEC'];
  $code_sep=$ress11['CODE_SPEC'];
  $grade = $ress22['NOM_GRAD'];
  $code_grade = $ress22['CODE_GRAD'];
  $email    = $ress['EMAIL_COR_MODU'];
  $tele    = $ress['TELE_COR_MODU'];
  $nom_dept = $ress['nom_dept'];
  $code_dept=$ress['code_dept'];

  $nom_uni=$ress3['nom_uni'];
  $nom_etab=$ress3['nom_eta'];
  $code_uni=$ress3['code_uni'];
  $code_eta=$ress3['code_eta'];

  $nb     = $ress1['Nombre_Modu'];
  $nb     = $nb-1;

  if(isset($_POST['Modifier1']))
  {

    $code_uni=$_POST['universite'];
    $code_etab=$_POST['etablissement'];
    $code_dept=$_POST['departement'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $Pseudo=$_POST['username'];
    $grade=$_POST['grade'];
    $spec=$_POST['Specialite'];
    $email=$_POST['email'];
    $tele=$_POST['tele'];

  $sql= "UPDATE `coordonateur_module` SET `CODE_ETA`=$code_etab,`CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_COR_MODU`='".$nom."',`PRENOM_COR_MODU`='".$prenom."',`SPECIALITE_COR_MODU`='".$spec."',`GRADE_COR_MODU`='".$grade."',`EMAIL_COR_MODU`='".$email."',`TELE_COR_MODU`='".$tele."' WHERE `CODE_COR_MODU`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
  }

  if(isset($_POST['valider1']))
  {

  $newpassword=$_POST['newpassword'];
  $sql= "UPDATE `coordonateur_module` SET `PASSWORD`='".$newpassword."' WHERE `CODE_COR_MODU`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
  }
}

elseif ($Etat =="Chef Departement")
{
  $rest = $_SESSION['info'];
  $req  = ($bd->query('Select NOM_CHEF , PRENOM_CHEF ,SPECIALITE_CHEF from chef_departement WHERE  CODE_CHEF_DEPT="'.$rest.'"'));
  $req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA       from chef_departement as C  , Etablissement as E  , universite as U , departement as D  where  C.CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
  $req3 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA       from chef_departement as C  , Etablissement as E  , universite as U , departement as D  where  C.CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
  $req4 = ($bd->query('select count(F.CODE_FIL) as nombre_Fil from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
  $req5 = ($bd->prepare('select NOM_FIL  from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
  $req6 = ($bd->prepare('select CODE_FIL from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
  $ress=$req->fetch();
  $ress1=$req4->fetch();
  $req5->execute();
  $ress2=$req5->fetchAll();
  $prenom = $ress['PRENOM_CHEF'];
  $nom    = $ress['NOM_CHEF'];
  $sep    = $ress['SPECIALITE_CHEF'];
  $nb     = $ress1['nombre_Fil'];
  $nb     = $nb-1;


if(isset($_POST['valider1']))
  {

  $newpassword=$_POST['newpassword'];
  $sql= "UPDATE `chef_departement` SET `PASSWORD`='".$newpassword."' WHERE `CODE_CHEF_DEPT`='".$rest."' ";
    $result=mysqli_query($ma_connexion,$sql);
    echo "<meta http-equiv='refresh' content='0' />";
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
  <title>Gestion des filières | Profil</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">  
  <link rel="stylesheet" type="text/css" href="../css/ionicons.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src="../js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">  
  <script src="../js/sweetalert2.min.js"></script>
  <script type="text/javascript">
  $(function() {
    $('#profil').addClass("active");
  });
</script>
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
        Profil de l'utilisateur
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive " src="
<?php
                                            $rest = $_SESSION['info'];
                                            $bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
                                            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            
                                            if ( $Etat =="coordonateur filiere" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_FIL from coordonateur_filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_FIL'];
                                                    echo "../images/".$url;
                                                }
                                            else if ( $Etat =="Coordonnateur Module" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_MODU from coordonateur_module WHERE CODE_COR_MODU  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_MODU'];
                                                    echo "../images/".$url;
                                                }
                                            else{
                                                    $req  = ($bd->query('Select IMAGE_ENS from enseignant WHERE CODE_ENS  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_ENS'];
                                                    echo "../images/".$url;
                                                }
                                            
                                            
                                        ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $prenom." ".$nom ?></h3>

              <p class="text-muted text-center"><?php echo $Etat ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Téléphone</b> <a class="pull-right"><?php echo $tele; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sur Moi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Spécialité</strong>

              <p class="text-muted">
               <?php echo $sep  ?>
              </p>

              <hr>

              <strong><i class="fa fa-institution margin-r-5"></i>Université</strong>

              <p class="text-muted"><?php echo $nom_uni  ?></p>

              <hr>

              <strong><i class="fa fa-institution margin-r-5"></i>Etablissement</strong>

              <p class="text-muted"><?php echo $nom_etab  ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i>Compétances</strong>

              <p>
                <span class="label label-danger">java</span>
                <span class="label label-danger">HTML5</span>
                <span class="label label-danger">Ajax</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Jquery</span>
              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activités-utilisateur</a></li>
              <li><a href="#timeline" data-toggle="tab">Image-Profil</a></li>
              <li><a href="#settings" data-toggle="tab">parametres-profil</a></li>
              <li><a href="#password" data-toggle="tab">Mot-de-passe-profil</a></li>
            </ul>
            <div class="tab-content">

              <div class="active tab-pane" id="activity">
                <div class="row">
                <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            if ($Etat =="coordonateur filiere"){
              echo '
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>1</h3>
              <p>Filiere(s)</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="../Coordonateur_filiere/Mes_Filieres.php" class="small-box-footer">Plus d\'informations<i class="fa fa-arrow-circle-right"></i></a>
          </div></div>
            <div class="col-lg-3">
            <button type="button" id="Cfiliere" name="Cfiliere" style="margin-top: 60px;" class="btn btn-primary btn-block"><i class="fa fa-plus-square fa-1x"></i> Créer draft fillère</button>';
              }
            ?>
        </div>
      </div>
       <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Liste des choses à faire</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" value="">
                  <!-- todo text -->
                  <span class="text">Concevoir un joli thème</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 3 weeks</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Rendre le thème Responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 2 weeks</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Laisse le thème briller comme une étoile</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="">
                  <span class="text">Vérifiez vos messages et notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i>Ajouter un item</button>
            </div>
          </div>
        </div>
              <!-- /.tab-pane -->
 <div class="tab-pane" id="timeline">

<div class="row">
<div class="col-sm-6 col-md-4">                             
<img src="
                                        <?php
                                            $rest = $_SESSION['info'];
                                            $bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
                                            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            
                                            if ( $Etat =="coordonateur filiere" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_FIL from coordonateur_filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_FIL'];
                                                    echo "../images/".$url;
                                                }
                                            else if ( $Etat =="Coordonnateur Module" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_MODU from coordonateur_module WHERE CODE_COR_MODU  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_MODU'];
                                                    echo "../images/".$url;
                                                }
                                            else{
                                                    $req  = ($bd->query('Select IMAGE_ENS from enseignant WHERE CODE_ENS  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_ENS'];
                                                    echo "../images/".$url;
                                                }
                                            
                                            
                                        ?>" alt="" class="img-rounded img-responsive" >

<form method="post" enctype="multipart/form-data">
<input class="form-control" type="file" name="fileToUpload">
<input type="submit" value="Upload Image" name="submitimage">
</form>
<?php
                                            if(isset($_POST["submitimage"])) {
                                                $errors= array();
                                                $file_name = $_FILES['fileToUpload']['name'];
                                                //$file_size =$_FILES['fileToUpload']['size'];
                                                $file_tmp =$_FILES['fileToUpload']['tmp_name'];
                                                //$file_type=$_FILES['fileToUpload']['type'];
                                                
                                                //$expensions= array("jpeg","jpg","png");
                                                
                                                //move_uploaded_file($file_tmp,"images/".$file_name);
                                                if ( $Etat =="coordonateur filiere" ) 
                                                {
                                                    try{
                                                $sql = "update coordonateur_filiere set IMAGE_COR_FIL = '".$file_name."'
                                                     WHERE  CODE_COR_FIL = '".$rest."'" ; 
                                                    $bd->exec($sql);
                                                    move_uploaded_file($file_tmp,"../images/".$file_name);
                                                    echo "<meta http-equiv='refresh' content='0' />";
                                                }catch(PDOException $e)
                                                    {
                                                    echo $sql . "<br>" . $e->getMessage();
                                                    }
                                                }
                                                else if ( $Etat =="Coordonnateur Module" ) 
                                                {
                                                    try{
                                                $sql = "update coordonateur_module set IMAGE_COR_MODU = '".$file_name."'
                                                     WHERE  CODE_COR_MODU = '".$rest."'" ; 
                                                    $bd->exec($sql);
                                                    move_uploaded_file($file_tmp,"../images/".$file_name);
                                                    echo "<meta http-equiv='refresh' content='0' />";
                                                }catch(PDOException $e)
                                                    {
                                                    echo $sql . "<br>" . $e->getMessage();
                                                    }
                                                }
                                                else{
                                                    try{
                                                $sql = "update enseignant set IMAGE_ENS = '".$file_name."'
                                                     WHERE CODE_ENS = '".$rest."'" ; 
                                                    $bd->exec($sql);
                                                    move_uploaded_file($file_tmp,"../images/".$file_name);
                                                    echo "<meta http-equiv='refresh' content='0' />";
                                                }catch(PDOException $e)
                                                    {
                                                    echo $sql . "<br>" . $e->getMessage();
                                                    }
                                                    
                                                }
                                                    
                                                
                                                    
                                                //echo "name of file ".$file_name." file size ".$file_size." file temp ".$file_tmp." file type ".$file_type." file extention ".$file_ext;
                                            }
                                        ?>
 </div>
<div class="col-sm-6 col-md-8">
                                <h3><?php echo $Etat ?></h3>
                                <p>
                                    <i class="fa fa-chevron-circle-right "></i> Nom : <?php echo $nom ?>
                                    <br />
                                    <i class="fa fa-chevron-circle-right "></i> prénom :  <?php echo $prenom ?> 
                                    <br />
                                    <i class="fa fa-check-square"></i> nom d'utilisateur :  <?php echo  $Pseudo ;?>
</p>
 </div>
 </div>
</div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="" method="POST">
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Université</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="universite" id="universite">                       
                                    <?php
                                      echo '
                                      <option value="'.$code_uni.'" selected>'.$nom_uni.'</option>';
                                      $sql= "select * from universite WHERE CODE_UNIVERSITE !='$code_uni'";
                          $result=mysqli_query($ma_connexion,$sql);
                          if(mysqli_num_rows($result) > 0)  
                          {
                          while($row = mysqli_fetch_array($result))  
                          {  
                        echo'<option value="'.$row['CODE_UNIVERSITE'].'">'.$row['NOM_UNIVERSITE'].'</option>';
                          }
                          }
                                      ?>
                        </select>
                                </div>
                  </div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Etablissement</label>
                               <div class="col-sm-9">
                                    <select list="cookies2" class="form-control" name="etablissement" id="etablissement">   
                          <?php
                                      echo '
                                      <option value="'.$code_eta.'" selected>'.$nom_etab.'</option>';
                                      ?>
                        </select>
                                </div>
                  </div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Département</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="departement" id="departement">
                                    <?php
                                      echo '
                                      <option value="'.$code_dept.'" selected>'.$nom_dept.'</option>';
                                    ?>
                        </select>
                                </div>
                  </div>

                  <div class="form-group">
                    <label for="nom" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom ?>" placeholder="nom">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="prenom" class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom ?>" placeholder="prenom">
                    </div>
                  </div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Grade</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="grade" id="grade">                       
                                    <?php
                                      echo '
                                      <option value="'.$code_grade.'" selected>'.$grade.'</option>';
                                      $sql= "select * from grade_crm WHERE CODE_GRAD !='$code_sep'";
                          $result=mysqli_query($ma_connexion,$sql);
                          if(mysqli_num_rows($result) > 0)  
                          {
                          while($row = mysqli_fetch_array($result))  
                          {  
                        echo'<option value="'.$row['CODE_GRAD'].'">'.$row['NOM_GRAD'].'</option>';
                          }
                          }
                                      ?>
                        </select>
                                </div>
                  </div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Spécialité</label>
                                <div class="col-sm-9">
                                   <select class="form-control" name="Specialite" id="Specialite">                        
                                    <?php
                                      echo '
                                      <option value="'.$code_sep.'" selected>'.$sep.'</option>';
                                      $sql= "select * from specialite_crm WHERE CODE_SPEC !='$code_sep'";
                          $result=mysqli_query($ma_connexion,$sql);
                          if(mysqli_num_rows($result) > 0)  
                          {
                          while($row = mysqli_fetch_array($result))  
                          {  
                        echo'<option value="'.$row['CODE_SPEC'].'">'.$row['NOM_SPEC'].'</option>';
                          }
                          }
                                      ?>
                        </select>
                                </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">nom d'utilisateur</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="username" onkeyup="usernametest(this)" id="username" value="<?php echo $Pseudo ?>" placeholder="nom d'utilisateur">
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" id="email" onkeyup="emailtest(this)" value="<?php echo $email ?>" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tele" class="col-sm-3 control-label">telephone</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" pattern="[0][6|5|7][0-9]{8}" name="tele" id="tele" value="<?php echo $tele ?>" placeholder="Téléphone:[0[6-5-7]XXXXXXXX]">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="Modifier1">Valider</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tab-pane" id="password">
               <form class="form-horizontal" method="POST" action="" onsubmit="return checkall();">
                      <br>
                    <div class="form-group">
                          <label for="password" class="col-sm-4 control-label">Ancien mot de passe</label>
                      <div class="col-xs-4">
                                <input type="password" class="form-control" name="passwordold" id="passwordold" placeholder="Ancien mot de passe" required>
                              </div>
                              <div class="col-xs-4" id="confirmation_pass0">
                              </div>                          
                      </div>  
                      <div class="form-group">
                          <label for="newpassword" class="col-sm-4 control-label">Nouveau mot de passe</label>
                      <div class="col-xs-4">
                                <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe" required>
                              </div>            
                      </div>  
                      <div class="form-group">
                          <label for="newpassword1" class="col-sm-4 control-label">Retaper mot de passe</label>
                      <div class="col-xs-4">
                                <input type="password" class="form-control" name="newpassword1" id="newpassword1" placeholder="Retaper mot de passe" required>
                              </div>
                              <div class="col-xs-4" id="confirmation_pass1">
                                <label class="col-sm-12 control-label" id="confirmation_pass13"></label>
                              </div>                      
                      </div>  
                      <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-sm-offset-5 col-sm-10">
                      <button type="submit" id="valider1" name="valider1" class="btn btn-danger">Modifier</button>
                            </div>                      
                      </div>
                      
                    </form>               
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <form name="sform" id="sform" method="POST">
       <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Initiation de la filiere</h4>
      </div>

      <div class="modal-body" >

          <label >Nom draft Filière :</label> 
            <input class="form-control" style="margin-left: 20px; width: 90%; " type="text" name="nomfiliere" id="nomfiliere" placeholder="Nom Filiere">
          
          <label >abréviation :</label> 
            <input class="form-control" style="margin-left: 20px; width: 90%;" type="text" name="abreviation" id="abreviation" placeholder="abréviation" readonly disabled>

          <script>
              $('#nomfiliere').keyup(function(e) 
              {
                var dataString2='nomFil='+ $(this).val() ; 
                      
                  $.ajax
                  ({
                    type: "POST",
                    url: "get_TEST_initiation_filiere.php",
                    data: dataString2,
                    cache: false,
                    success: function(html)
                    {
                      if (html == 1 )
                      {
                        swal(
                          'Attention...',
                          'cette filiere existe deja!',
                          'warning'
                        )
                        $('#nomfiliere').val('');  
                      }
                      else
                      {
                        var x = $('#nomfiliere').val();
                        var y = x.split(" ");
                        var yy1 = y[0];
                        var yy2 = y[1];
                        var yy3 = y[2];
                        if (yy2 != undefined)
                          $('#abreviation').val(yy1[0].toUpperCase()+' '+ yy2[0].toUpperCase());
                        
                        if (yy3 != undefined)
                          $('#abreviation').val(yy1[0].toUpperCase()+' '+ yy2[0].toUpperCase()+' '+ yy3[0].toUpperCase());
                      }
                    }
                  }); 
                }); 

                
            </script> 

      </div>
      <div class="modal-footer">
      <button type="submit" name="exporter" value="exporter" id="exporter" class="btn btn-primary">Suivant</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>

      </form>

    </div>
</div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>By MDL</b>
    </div>
    <strong>Copyright &copy; 2017-2018</strong> All rights
    reserved.
  </footer>

  
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/sweetalert2.min.js"></script>

<script type="text/javascript">
      $("#universite").change(function()
        {
          var id=$(this).val();
          var dataString = 'id='+ id;
          $.ajax({ 
            type: "POST",
            url: "../LES-GET/get_etablissement.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#etablissement").html(html);
            }
          });
        });
    $("#etablissement").change(function()
        {
          var id=$(this).val();
          var dataString = 'id='+ id;
          $.ajax({ 
            type: "POST",
            url: "../LES-GET/getDepartement.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#departement").html(html);
            }
          });
    });

    $('#passwordold').keyup(function(){  
                var query=$(this).val();
          var dataString = 'query='+ query;
          $.ajax({ 
            type: "POST",
            url: "test_mdp.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#confirmation_pass0").html(html);
            }
          });
      });

      $('#newpassword1').keyup(function()
      {  

          var mdpnew= $('#newpassword').val();  
          var mdpnew1= $('#newpassword1').val();  
          if(mdpnew==mdpnew1)
          {
          $.ajax({ 
            success: function()
            {
              $("#confirmation_pass13").html("MOT DE PASS CONFIRME");
            }
          });
        }
        else
        {
          $.ajax({ 
            success: function()
            {
              $("#confirmation_pass13").html("MOT DE PASS NON CONFIRME");
            }
          });
        }
      });

    </script>
    <script type='text/javascript'>

  function checkall()
  {

    var test=$("#validationtt").text();
    var mdp=$('#newpassword').val();
    var newmdp=$('#newpassword1').val();
    

  if(test=="MOT DE PASS VALIDE" && mdp==newmdp)
  {
  return true;
  }
  else
  {
  return false;
  }

  }

  function testImpossibleop(obj)
  {
    var Pseudo = obj.value;
    var dataString2 = 'Pseudo='+ Pseudo;
        $.ajax({ 
            type: "POST",
            url: "test_mdp.php",
            data: dataString2,
            cache: false,
            success: function(html)
            {
              if (html.trim() == "404") 
              {
              swal(
                  'Erreur...',
                  'Ce Pseudo existe Deja',
                  'error'
                )
                $("#Pseudo").val('<?php echo $Pseudo ?>');
              }
            }
          });
  }
</script>

<script>
    
        $('#Cfiliere').click(function()
        {
          $("#myModal").modal('show');
        });


    function afficher5(objButton) 
    { 
         var testin = objButton.value; 
         document.sform2.matmaty.value=testin;
    } 


    function checkall()
  {

    var cours = document.getElementById('cours');
    var td = document.getElementById('td');
    var tp = document.getElementById('tp');
    var enca = document.getElementById('enca');
    
  if(cours.checked==true || td.checked==true || tp.checked==true || enca.checked==true)
  {
  return true;
  }
  else
  {
  return false;
  }

  }
</script>




</body>
</html>
