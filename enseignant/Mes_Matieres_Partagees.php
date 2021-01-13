<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];

if ( $Etat == "enseignant")
{
  $rest = $_SESSION['info'];
  $req  = ($bd->query('Select PRENOM_ENS,NOM_ENS,SPECIALTE_ENS from enseignant WHERE   CODE_ENS  ="'.$rest.'"'));

  $req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA,D.CODE_DEPT as code_dep from enseignant as C , etablissement as E , universite as U , departement as D where C.CODE_ENS  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

  $req44 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM matiere_partagee WHERE CODE_ENS_v="'.$rest.'"'));
  $req55 = ($bd->prepare('SELECT  m.NOM_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));
  $req77 = ($bd->prepare('SELECT  m.NOM_ENS,m.PRENOM_ENS FROM matiere_partagee as i , enseignant as m WHERE i.CODE_ENS_v="'.$rest.'" and i.CODE_ENS_C=m.CODE_ENS '));

  $req99 = ($bd->prepare('SELECT i.CODE_ENS_C FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT'));

  $req33 = ($bd->prepare('SELECT i.CODE_ENS_v FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));

  $req6 = ($bd->prepare('SELECT m.CODE_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));

  $req55->execute();
  $req77->execute();
  $req99->execute();
  $req33->execute();
  $req6->execute();
  $ress11= $req44->fetch();
  $ress= $req->fetch();
  $ress22  =  $req55->fetchAll();
  $ress99  =  $req77->fetchAll();
  $ress88  =  $req6->fetchAll();
  $ress33 = $req33->fetchAll();
  $prenom = $ress['PRENOM_ENS'];
  $nom = $ress['NOM_ENS'];
  $sep = $ress['SPECIALTE_ENS'];
  $nb1     = $ress11['Nombre_Mat'];
  $nb1     = $nb1-1;


  if(isset($_POST['Exporter']))
  {
  $id=$_POST['output1']; 
  $id_mat = implode($ress88[$id]);
  $id_mod= $_POST['module']; 

  $sqm="INSERT INTO `matiere`(`CODE_MODU`, `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `avancement`, `type_cour`) SELECT '$id_mod', `NOM_MAT`, `DESCRIPTION_MAT`, `SEPCIALITE_MAT`, `VOLUME_HORAIRE_MAT`, `VOLUME_COURS_MAT`, `VOLUME_TD_MAT`, `VOLUME_TP_MAT`, `VOLUME_AP_MAT`, `ACTIVITE_PRATIQUE`, `avancement`, `type_cour` FROM `matiere` WHERE CODE_MAT=$id_mat ";
  $result=mysqli_query($ma_connexion,$sqm);
  $id_mat_new = mysqli_insert_id($ma_connexion);
  $test  ="INSERT INTO intervient(CODE_ENS,CODE_MAT) VALUES ('$rest','$id_mat_new')";
  $result1=mysqli_query($ma_connexion,$test);

  $test1="SELECT CODE_COMP from compmatiere where CODE_MAT=$id_mat ";
  $result=mysqli_query($ma_connexion,$test1);
  while ($row = mysqli_fetch_array($result))
  {
  $code_cmp=$row['CODE_COMP'];
  $test2="INSERT INTO compmatiere(CODE_MAT,CODE_COMP,taux,type) VALUES ('$id_mat_new','$code_cmp',0,0)";
  $result3=mysqli_query($ma_connexion,$test2);
  }
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
  <title>Gestion des filières | Mes Matière partagées</title>
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
    $('#Mes_Matieres_Partagees').addClass("active");
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
        Mes Matière partagées
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
        <h4 class="modal-title">Information sur la matiere partagée</h4>
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
    
      <!-- Modal content-->
      <form name="sform1" id="sform1" method="POST">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter cette matiere</h4>
      </div>

      <div class="modal-body" style="height: 150px;">

          <div class="form-group" id="aaa">
          <label class="form-group">Choisissez l'un des modules :</label>
          <br><br>
          <select name="module" id="module" class="form-group">
        <?php
            $sql= "SELECT DISTINCT M.CODE_MODU as CODE_MODU,M.NOM_MODU as NOM_MODU
            FROM module M , departement d , etablissement et,filiere F
            WHERE M.CODE_FIL =F.CODE_FIL 
            AND F.CODE_DEPT=D.CODE_DEPT
            AND F.CODE_DEPT=$code_dep ";


            $query=mysqli_query($ma_connexion,$sql) ;
            if(mysqli_num_rows($query) == 0)
            {
            echo '<option>Aucun resultats pour les modules</option>';
            }else{
            while($row = mysqli_fetch_assoc($query))
            {
            $CODE_MODU = $row['CODE_MODU']; 
            $NOM_MODU = $row['NOM_MODU']; 
            echo "<option value='$CODE_MODU'>$NOM_MODU</option> " ;
            }
            }

        ?>
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
              <h3 class="box-title">Mes Matières Partagés : <?php echo $nb1+1  ?></h3>
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
                        Matière partagée '.$j.' : '.$NomF.'
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
                     url:"nom_ens_part.php",
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



</script>

</body>
</html>
