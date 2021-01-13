<?php
include '../connexion.php';
?>

<?php
session_start();
$nomfilierer = $_GET["nomfilierer"];
$code_fil="";
$query001 = "SELECT CODE_FIL FROM filiere where NOM_FIL='$nomfilierer' ";
$result = mysqli_query($ma_connexion, $query001);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$code_fil = $row['CODE_FIL'];    
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Descriptif filière</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

</head>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../index.php" class="navbar-brand"><b>Gestion des </b>Filières</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Descriptif filière <span class="sr-only">(current)</span></a></li>
            <li><a href="Espace-Etudiant.php">Espace Etudiant</a></li>
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Decriptif filière
          <small>détails :</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">




        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Description" data-toggle="tab">Description</a></li>                      
                <li><a href="#prerequis" data-toggle="tab">pré-requis</a></li>
                <li><a href="#competence" data-toggle="tab">Compétences </a></li>                   
                <!-- <li><a href="#modules" data-toggle="tab">modules</a></li> -->
                <li><a href="#module_matieres" data-toggle="tab">modules & matières</a></li>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active" id="Description">
                <form class="form-horizontal">
                        <b style="font-size:25px;">Déscription</b><br><br>
                        <p>
                            La formation au Diplôme Universitaire de Technologie spécialité "Génie Logiciel" se déroule en quatre semestres. L'objectif de cette formation est de permettre à l'étudiant d'apprendre à maîtriser les Nouvelles Technologies de l'Information et de la Communication (NTIC) qui sont omniprésentes dans toute entreprise <br><br>

                            La formation, centrée sur le développement de logiciels, porte sur les techniques de modélisation et de développement dans le cadre de projets informatiques. L’accent est également mis sur la reprise et la réingénierie d’applications, sur l’ingénierie des modèles et, de manière plus générale, sur la modélisation et l’analyse de haut niveau pour la gestion de projets informatiques. 
                            <br><br>

                            En outre, les acquis reçus durant la formation permettent aux étudiants désirant poursuivre leurs études, d'intégrer les écoles d'ingénieurs nationales et internationales, les licences en sciences et techniques au sein des Facultés des Sciences et Techniques (FST), les licences professionnelles au sein des Facultés des sciences ainsi que les Ecoles Supérieures de Technologies et les Universités à l'étranger.
                        </p>
                            <hr>
                    </form>

              </div>

              <div class="tab-pane" id="prerequis">
                <form class="form-horizontal">
                    
                    
                        <p>
                            <b style="font-size:15px;">MODALITES D’ADMISSION</b><br>

                            –Diplômes requis : (Expliciter les séries de Baccalauréat requises)<br>

                            Etre titulaire du baccalauréat de type : <br>
                            <?php 
                             $query001 = "SELECT d.CODE_DIPLOME , d.TYPE, d.NOM_DIPLOME
                                            FROM filiere_diplomes fd , diplomes d 
                                            where d.CODE_DIPLOME = fd.CODE_DIPLOME
                                            and fd.CODE_FIL = '$code_fil' ";

                              $result = mysqli_query($ma_connexion, $query001);
                              
                              if (mysqli_num_rows($result) > 0) {
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                  $code = $row['CODE_DIPLOME'];
                                  $type =$row['TYPE'];
                                  $name =$row['NOM_DIPLOME'];    
                                   echo $name.'<br>'; 
                                  }
                                }                 
                             ?>
                             <br>
                             <b style="font-size:15px;">Pré-requis pédagogiques spécifiques :</b><br>
                            Aucun
                            <br>
                            <br>
                            <b style="font-size:15px;">Procédures de sélection :</b><br>
                           (Expliciter les formules de calcul de la note de sélection par série de Bac)
                            <br>
                            <?php 
                             $query001 = "SELECT CONDITION_D_ACCEES
                                            FROM filiere f 
                                            where CODE_FIL = '$code_fil' ";

                              $result = mysqli_query($ma_connexion, $query001);
                              
                              if (mysqli_num_rows($result) > 0) {
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                  $name = $row['CONDITION_D_ACCEES'];   
                                   echo $name.'<br>'; 
                                  }
                                }                 
                             ?>
                             <br>
                            <b style="font-size:15px;">ACCES PAR PASSERELLE</b> <br> 
                            <?php 
                             $query001 = "SELECT ACCES_PAR_PASSERELLE
                                            FROM filiere f 
                                            where CODE_FIL = '$code_fil' ";

                              $result = mysqli_query($ma_connexion, $query001);
                              
                              if (mysqli_num_rows($result) > 0) {
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                  $name = $row['ACCES_PAR_PASSERELLE'];   
                                   echo $name.'<br>'; 
                                  }
                                }                 
                             ?>
                            <br>

                            <b style="font-size:15px;">Accès en semestre 3</b><br>
                            -   Selon la capacité d’accueil de la filière<br>
                            -   Diplôme conforme au cahier de norme pédagogique national<br>
                            -   Satisfaire les prés requis des modules du troisième semestre  ainsi que du second semestre de la filière<br>
                            -Étude de dossier par la filière<br>
                        </p>  
                    </form>

              </div>

              <div class="tab-pane" id="competence">
                <form class="form-horizontal">
                     <b style="font-size:25px;">Competences</b><br><br>
                        <p>
                          <?php 
                             $query001 = "SELECT c.COMPETNECE as comp
                                          FROM competence c , compfiliere cf
                                          where c.CODE_COMP = cf.CODE_COMP
                                          and cf.CODE_FIL = '$code_fil' "; 

                              $result = mysqli_query($ma_connexion, $query001);
                              
                              if (mysqli_num_rows($result) > 0) {
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                  $name = $row['comp'];   
                                   echo '• '.$name.'<br>'; 
                                  }
                                }                 
                             ?>
                        </p>
                    </form>
              </div>

              <!-- <div class="tab-pane" id="modules">
                <form class="form-horizontal">
                        <p>
                            <?php 
                             $query001 = "SELECT DISTINCT(ID_SEMSTRE) 
                                              FROM module
                                              where CODE_FIL =  '$code_fil'
                                              order by ID_SEMSTRE "; 
                             $result = mysqli_query($ma_connexion, $query001);
                              if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                $semes = $row['ID_SEMSTRE'] ;

                                echo '<b style="font-size:15px;">Semèstre '.$semes.' :</b>
                                        <hr>';

                              $query002 = "SELECT mo.CODE_MODU, mo.NOM_MODU, mo.VOLUME_HORAIRE_MODU 
                                              FROM module mo
                                              where mo.CODE_FIL =  '$code_fil'
                                              AND ID_SEMSTRE='$semes'
                                              order by mo.ID_SEMSTRE , mo.CODE_MODU "; 

                              $result1 = mysqli_query($ma_connexion, $query002);
                              if (mysqli_num_rows($result) > 0) {
                                $i=1;
                                while($row1 = mysqli_fetch_assoc($result1)) {
                                  $code = $row1['CODE_MODU'] ;
                                  $modu = $row1['NOM_MODU'] ;
                                  $vol = $row1['VOLUME_HORAIRE_MODU'];  
                                  echo 'Module '.$i.' : '.$modu.' :<b> '.$vol.'h</b><br>';
                                  $i++;
                                  }
                                }    
                                echo '<br>';
                                }
                              }    
                             ?>
                        </p>
                    </form>
              </div> -->

              <div class="tab-pane" id="module_matieres">
                <form class="form-horizontal">
                        <p>
                            <?php 
                             $query001 = "SELECT DISTINCT(ID_SEMSTRE) 
                                              FROM module
                                              where CODE_FIL =  '$code_fil'
                                              order by ID_SEMSTRE "; 
                             $result = mysqli_query($ma_connexion, $query001);
                              if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                $semes = $row['ID_SEMSTRE'] ;

                                echo '<b style="font-size:15px;">Semèstre '.$semes.' :</b>
                                        <hr>';

                              $query002 = "SELECT mo.CODE_MODU, mo.NOM_MODU, mo.VOLUME_HORAIRE_MODU 
                                              FROM module mo
                                              where mo.CODE_FIL =  '$code_fil'
                                              AND ID_SEMSTRE='$semes'
                                              order by mo.ID_SEMSTRE , mo.CODE_MODU "; 

                              $result1 = mysqli_query($ma_connexion, $query002);
                              if (mysqli_num_rows($result) > 0) {
                                $i=1;
                                while($row1 = mysqli_fetch_assoc($result1)) {
                                  $code = $row1['CODE_MODU'] ;
                                  $modu = $row1['NOM_MODU'] ;
                                  $vol = $row1['VOLUME_HORAIRE_MODU'];  
                                  echo '<b>Module '.$i.' : '.$modu.' :<b> '.$vol.'h</b></b><br>';

                            $query003 = "SELECT m.CODE_MAT,m.NOM_MAT,m.VOLUME_HORAIRE_MAT 
                                              FROM matiere m,module mo
                                              where mo.CODE_MODU =  m.CODE_MODU
                                              AND mo.CODE_MODU='$code'
                                              order by m.CODE_MAT "; 
                              $result2 = mysqli_query($ma_connexion, $query003);
                              if (mysqli_num_rows($result) > 0) {
                                $jj=1;
                                while($row1 = mysqli_fetch_assoc($result2)) {
                                  $code_ma = $row1['CODE_MAT'] ;
                                  $mat = $row1['NOM_MAT'] ;
                                  $vol_ma = $row1['VOLUME_HORAIRE_MAT'];  
                                  echo '&nbsp;&nbsp;&nbsp;&nbsp;Matire'.$jj.' : '.$mat.' :<b> '.$vol_ma.'h</b><br>';
                                  $jj++;
                                }
                              }
                                  $i++;
                                  }
                                }    
                                echo '<br>';
                                }
                              }    
                             ?>
                        </p>
                    </form>
              </div>

            </div>  


            </div>
        

        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 3.0.0
      </div>
      <strong>Copyright &copy; 2017-2018 <a href="http://www.facebook.com/mohammeddib3">DAL</a>.</strong>All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
