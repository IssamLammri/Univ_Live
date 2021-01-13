<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];

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



  
  $req  = ($bd->query('Select  PRENOM_COR_MODU,NOM_COR_MODU,SPECIALITE_COR_MODU from coordonateur_module WHERE CODE_COR_MODU  ="'.$rest.'"'));

  $req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA,D.CODE_DEPT as code_dep,E.CODE_ETA as code_eta from coordonateur_module as C , etablissement as E , universite as U , departement as D where C.CODE_COR_MODU  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

  $req44 = ($bd->query('SELECT count(CODE_MODU) as Nombre_mod FROM modules_partages WHERE CODE_CORM_v="'.$rest.'"'));
  $req55 = ($bd->prepare('SELECT  m.NOM_MODU FROM modules_partages as i , module as m WHERE (i.CODE_CORM_v="'.$rest.'" or i.CODE_CORM_v="0") and i.CODE_MODU=m.CODE_MODU '));

  $req77 = ($bd->prepare('SELECT  m.NOM_COR_MODU,m.PRENOM_COR_MODU FROM modules_partages as i , coordonateur_module as m WHERE i.CODE_CORM_v="'.$rest.'" and i.CODE_CORM_C=m.CODE_COR_MODU '));

  $req99 = ($bd->prepare('SELECT i.CODE_CORM_C FROM modules_partages as i , module as m WHERE (i.CODE_CORM_v="'.$rest.'" or i.CODE_CORM_v="0") and i.CODE_MODU=m.CODE_MODU'));

  $req33 = ($bd->prepare('SELECT i.CODE_CORM_v FROM modules_partages as i , module as m WHERE (i.CODE_CORM_v="'.$rest.'" or i.CODE_CORM_v="0") and i.CODE_MODU=m.CODE_MODU '));

  $req6 = ($bd->prepare('SELECT m.CODE_MODU FROM modules_partages as i , module as m WHERE (i.CODE_CORM_v="'.$rest.'" or i.CODE_CORM_v="0") and i.CODE_MODU=m.CODE_MODU '));

  $req55->execute();
  $req77->execute();
  $req99->execute();
  $req33->execute();
  $req6->execute();
  $ress11= $req44->fetch();
  $ress55= $req2->fetch();
  $ress = $req->fetch();
  $code_eta=$ress55['code_eta'];
  $ress22  =  $req55->fetchAll();
  $ress99  =  $req77->fetchAll();
  $ress88  =  $req6->fetchAll();
  $ress33 = $req33->fetchAll();
  $prenom = $ress['PRENOM_COR_MODU'];
  $nom    = $ress['NOM_COR_MODU'];
  $sep    = $ress['SPECIALITE_COR_MODU'];
  $nb1     = $ress11['Nombre_mod'];
  $nb1     = $nb1-1;



if(isset($_POST['Exporter']))
{

  $id=$_POST['output1']; 
  $id_modu = implode($ress88[$id]);
  $id_fil= $_POST['filiere'];
  $semestre= $_POST['semestre'];



      $idmodnew= null ;
      $query001 = "SELECT COUNT(*) as nbasavoir
                FROM module 
                where CODE_FIL='$id_fil' "; 
                
        $result = mysqli_query($ma_connexion, $query001);
        
        $idmodnew = null ;        
        if (mysqli_num_rows($result) > 0) {
          
          while($row = mysqli_fetch_assoc($result)) 
          {
            $idmodnew = $row["nbasavoir"] ; 
            $idmodnew++;
          }
        } else {
          echo "0 results";
        }   
        
        $residadd =$id_fil."MD".$idmodnew;

$sqm="INSERT INTO `module`(`CODE_MODU`, `CODE_COR_MODU`, `CODE_FIL`, `ID_SEMSTRE`, `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`, `PENDERATION`, `avancement`) SELECT '".$residadd."','".$rest."', '".$id_fil."', '".$semestre."', `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`, `PENDERATION`, `avancement` FROM `module` WHERE CODE_MODU='".$id_modu."' ";

  $result=mysqli_query($ma_connexion,$sqm);

  $test1="SELECT CODE_OBJECTIF_MODU from objectifs_modules where CODE_MODU='".$id_modu."' ";
  $result=mysqli_query($ma_connexion,$test1);
  while ($row = mysqli_fetch_array($result))
  {
  $code_obj=$row['CODE_OBJECTIF_MODU'];
  $test2="INSERT INTO objectifs_modules(CODE_MODU,CODE_OBJECTIF_MODU) VALUES ('".$residadd."',$code_obj)";
  $result3=mysqli_query($ma_connexion,$test2);
  }

  $test2="SELECT CODE_DIDACTIQUE_MODU from module_didactique where CODE_MODU='".$id_modu."' ";
  $result2=mysqli_query($ma_connexion,$test2);
  while ($row2 = mysqli_fetch_array($result2))
  {
  $code_dida=$row2['CODE_DIDACTIQUE_MODU'];
  $test3="INSERT INTO module_didactique(CODE_MODU,CODE_DIDACTIQUE_MODU) VALUES ('".$residadd."','$code_dida')";
  $result4=mysqli_query($ma_connexion,$test3);
  }

  $test3="SELECT code_pre from module_prerequis where CODE_MODU='".$id_modu."' ";
  $result3=mysqli_query($ma_connexion,$test3);
  while ($row3 = mysqli_fetch_array($result3))
  {
  $code_pre=$row3['code_pre'];
  $test4="INSERT INTO module_prerequis(CODE_MODU,code_pre) VALUES ('".$residadd."',$code_pre)";
  $result5=mysqli_query($ma_connexion,$test4);
  }

  $sql7="select Ma.CODE_MAT as code_mat from matiere Ma,Module Mo where Ma.CODE_MODU=MO.CODE_MODU AND Mo.CODE_MODU='".$id_modu."' ";
  $result7 = mysqli_query($ma_connexion, $sql7);
  while ($row7 = mysqli_fetch_array($result7))
  { 
  $code_mat=$row7['code_mat'];
  $sqm="INSERT INTO `matiere`(`CODE_MODU`, `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `avancement`, `type_cour`) SELECT '".$residadd."', `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `avancement`, `type_cour` FROM `matiere` WHERE CODE_MAT=$code_mat ";
  $result=mysqli_query($ma_connexion,$sqm);
  $id_mat_new = mysqli_insert_id($ma_connexion);
/*  $test  ="INSERT INTO intervient(CODE_ENS,CODE_INTERVENTION,CODE_MAT) VALUES (,1,$id_mat_new)";
  $result1=mysqli_query($ma_connexion,$test);*/

  $test1="SELECT CODE_COMP from compmodule where CODE_MODU='".$id_modu."' ";
  $result=mysqli_query($ma_connexion,$test1);
  while ($row = mysqli_fetch_array($result))
  {
  $code_cmp=$row['CODE_COMP'];
  $test2="INSERT INTO compmodule(CODE_MODU,CODE_COMP,taux) VALUES ('".$residadd."','$code_cmp',0)";
  $result3=mysqli_query($ma_connexion,$test2);
  }
  }

  $testrtt="DELETE FROM   modules_partages WHERE CODE_MODU='".$id_modu."'";
  $result=mysqli_query($ma_connexion,$testrtt);
  echo "<meta http-equiv='refresh' content='0' />";

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
  <title>Gestion des filières | Mes Modules partagées</title>
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
    $('#Mes_Modules_Partages').addClass("active");
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
      <form name="sform" id="sform" method="POST">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Information sur le partagée</h4>
      </div>

      <div class="modal-body" style="height: 150px;">

          <div class="form-group" id="hahaha">

            </div>

          </div>
          
          </div>
          </form>
              </div>
          </div>



          <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <form name="sform1" id="sform1" method="POST" onsubmit="return checkall();">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter ce module</h4>
      </div>

      <div class="modal-body" style="height: 250px;">

          <div class="form-group" id="aaa">
          <label class="form-group">Choisissez les informations suivants :</label>
          <br><br>
          <label class="form-group">Choisissez Une filiere :</label>
          <br>
          <select name="filiere" id="filiere" class="form-group">
          <option selected value="0">--choississez la filiere--</option>
          <?php
            $sql= "SELECT DISTINCT F.CODE_FIL as CODE_FIL,F.NOM_FIL as NOM_FIL
            FROM filiere F,departement d,etablissement et
            WHERE F.CODE_DEPT=D.CODE_DEPT
            AND D.CODE_ETA=et.CODE_ETA
            AND et.CODE_ETA=$code_eta";


            $query=mysqli_query($ma_connexion,$sql) ;
            if(mysqli_num_rows($query) == 0)
            {
            echo '<option>Aucun resultats pour les modules</option>';
            }else{
            while($row = mysqli_fetch_assoc($query))
            {
            $CODE_FIL = $row['CODE_FIL']; 
            $NOM_FIL = $row['NOM_FIL']; 
            echo "<option value='$CODE_FIL'>$NOM_FIL</option>" ;
            }
            }

        ?>
        </select>
        <br>
        <br>
        <label class="form-group">Choisissez le semestre :</label>
        <br>
        <select name="semestre" id="semestre" class="form-group">
        <option selected value="0">--choississez le semestre--</option>
        <option value='S1'>S1</option>
        <option value='S2'>S2</option>
        <option value='S3'>S3</option>
        <option value='S4'>S4</option>
        </select>

        <input type="hidden" name="output1" value="">
            </div>

          </div>
        <div class="modal-footer">
      <button type="submit" name="Exporter" value="Exporter" id="Exporter" class="btn btn-default">VALIDER</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">ANNULER</button>
      </div>
          </div>
          </form>
      </div>
    </div>  








        <div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mes Modules Partagés : <?php echo $nb1+1  ?></h3>
            </div>
            <?php
            for ($i = 0 ; $i <= $nb1 ; $i++) 
              {
                $NomF =implode($ress22[$i]);
                $code_ens_pa=implode($ress99[$i]);
                $CODE_MAT=implode($ress22[$i]);
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
                        Module partagé '.$j.' : '.$NomF.'
                      </a>
                    </h4>
                    <div class="btn-group pull-right">
                  <form method="post">
                    <button type="button" name="info" class="btn btn-primary" id="mod'.$i.'" value="'.$code_ens_pa.'/'.$CODE_MAT.'" onClick="afficher(this)"><span class="glyphicon glyphicon-eye-open">&nbsp;information</span></button>
                    <button type="button" name="Ajouter" class="btn btn-success" id="m'.$i.'" value='.$i.' onClick="afficher1(this)"><span class="glyphicon glyphicon-plus-sign">&nbsp;Ajouter</span></button>
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

function afficher(objButton) 
{
    var testin = objButton.value;
    $("#myModal").modal();

    $.ajax({  
                     url:"nom_coorM_par.php",
                     method:"POST",  
                     data:{testin:testin},  
                     success:function(data)  
                     {  
                          $('#hahaha').fadeIn();  
                          $('#hahaha').html(data);  
                     }  
             }); 
}


function afficher1(objButton) 
{ 
  var testin1 = objButton.value;
  document.sform1.output1.value=testin1;
  $("#myModal1").modal();

}

function checkall()
{
  if ($("#filiere").val() != 0 && $("#semestre").val() != 0) 
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
