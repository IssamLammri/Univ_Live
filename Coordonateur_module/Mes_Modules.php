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



$req  = ($bd->query('Select  PRENOM_COR_MODU , NOM_COR_MODU ,SPECIALITE_COR_MODU  from coordonateur_module WHERE CODE_COR_MODU  ="'.$rest.'"'));
$req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA from coordonateur_module as C , etablissement as E , universite as U , departement as D where C.CODE_COR_MODU  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
$req3 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA from coordonateur_module as C , etablissement as E , universite as U , departement as D where C.CODE_COR_MODU  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
$req4 = ($bd->query('Select  count(CODE_MODU)as Nombre_Modu from module WHERE CODE_COR_MODU  ="'.$rest.'"'));
$req5 = ($bd->prepare('Select NOM_MODU from module WHERE CODE_COR_MODU  ="'.$rest.'"'));
$req6 = ($bd->prepare('Select CODE_MODU from module WHERE CODE_COR_MODU  ="'.$rest.'"'));
$req9 = ($bd->prepare('SELECT avancement FROM module WHERE CODE_COR_MODU="'.$rest.'" '));
$ress = $req->fetch();
$ress1= $req4->fetch();
$req5->execute();
$req9->execute();
$req6->execute();
$ress2  =  $req5->fetchAll();
$ress9=$req9->fetchAll();
$ress3=$req6->fetchAll();
$prenom = $ress['PRENOM_COR_MODU'];
$nom    = $ress['NOM_COR_MODU'];
$sep    = $ress['SPECIALITE_COR_MODU'];
$nb     = $ress1['Nombre_Modu'];
$nb     = $nb-1;


if(isset($_POST['submit']))
{
$id  = $_POST['id']; 
$req6->execute();
$ress3=$req6->fetchAll();
$idf = implode($ress3[$id]);
$_SESSION['idf']=$idf ;
header('Location:CordonnateurM.php');
}

/*"SELECT M.`CODE_MAT`,M.NOM_MAT FROM `matiere_demandées` Md,matiere M,Module Mo WHERE md.CODE_MAT=M.CODE_MAT AND md.CODE_MAT=M.CODE_MAT AND M.CODE_MODU=Mo.CODE_MODU
AND Mo.CODE_COR_MODU=25"*/


  if(isset($_POST['valider']))
  { 

    $id  = $_POST['output']; 
    $req6->execute();
      $ress3=$req6->fetchAll();
    $mat = implode($ress3[$id]);

    if(isset($_POST['multiselect']) && !empty($_POST['multiselect']))
    {
    $Col1_Array = $_POST['multiselect'];
      foreach($Col1_Array as $selectValue)
        {
        try {
          $test  = ($bd->query('INSERT INTO modules_partages(CODE_MODU,CODE_CORM_v, CODE_CORM_C) VALUES ("'.$mat.'","'.$selectValue.'","'.$rest.'")'));
        } catch (Exception $e) 
        {
          echo "Error: " . $e->getMessage();  
        }
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

if(!isset($_SESSION['NIV'])) 
{
header('Location: ../login/login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestion des filières | Mes Modules</title>
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
    $('#Mes_Modules').addClass("active");
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
        Mes Modules :
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
        <h4 class="modal-title">Partagé un module</h4>
      </div>

      <div class="modal-body" style="height: 150px;">

          <div class="form-group">
            <label class="col-sm-6 control-label">Les Coordonateurs Modules</label>
            <div class="col-sm-12">
              <select id="example-post" class="form-control" name="multiselect[]" multiple="multiple">;

              <?php

              $test  ="SELECT * FROM coordonateur_module";
              $result1=mysqli_query($ma_connexion,$test);
              if(mysqli_num_rows($result1) == 0)
              {
              echo '<option>Aucun resultats Pour les Coordonateurs Modules</option>';
              }else{
              while($row = mysqli_fetch_assoc($result1))
              {
              $CODE_COR_MODU = $row['CODE_COR_MODU']; 
              $NOM_COR_MODU = $row['NOM_COR_MODU']; 
              $PRENOM_COR_MODU = $row['PRENOM_COR_MODU'];
              echo "<option value='$CODE_COR_MODU'>$NOM_COR_MODU $PRENOM_COR_MODU</option> " ;
              }
              }
              ?>

              </select>
              <input type="hidden" name="output" value="">
            </div>
          </div>
      </div>
      <div class="modal-footer">
      <button type="Acceder" name="valider" value="valider" id="valider" class="btn btn-default">VALIDER</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">ANNULER</button>
      </div>
      </div>
      </form>
      </div>
      </div>



        <div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mes Modules : <?php echo $nb+1  ?></h3>
            </div>
            <?php
            for ($i = 0 ; $i <= $nb ; $i++) 
              {
                $avanc =implode($ress9[$i]);
                $NomF =implode($ress2[$i]);
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
                        Module '.$j.' : '.$NomF.'
                      </a>
                    </h4>
                    <div class="btn-group pull-right">
                  <form method="post">
                    <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-arrow-up">&nbsp;Accéder</span></button>
                    <button type="button" name="partager" data-toggle="modal" data-target="#myModal" class="btn btn-info" id="mod'.$i.'" value='.$i.' onClick="afficher(this)"><span class="glyphicon glyphicon-share">&nbsp;Partager</span></button>
                    <input type="text" name="id" value='.$i.' hidden>
                    </form>
                </div>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <input class="knob" id="kuy'.$i.'" data-width="200" data-min="0" data-displayPrevious=true value="'.$avanc.'/'.implode($ress3[$i]).'" >
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
      <b>By MAL</b>
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
<script type="text/javascript">



function afficher(objButton) 
{     
    var testin = objButton.value;
    document.sform.output.value=testin;
} 





  $(function($) {

              var $j = jQuery.noConflict();
                $j(".knob").knob({
                    release : function (value) {

                      

                      var x2 = this.$.attr('value') ; 
            var bdkaaa = (this.$.attr('value')) ;


 $.confirm({
        theme: 'dark',
        title: 'confirmation!',
        
        buttons: {
          formSubmit: {
            text: 'confirmer',
            btnClass: 'btn-blue',
            action: function () {
                
              console.log(x2);
                      console.log("release : " + value);
              
                         

            var dataString =  'valueKK=' + value +'&idmat=' + bdkaaa;
              
                  $.ajax({
                      type: "POST",
                      url: "avancement_m.php",
                      data: dataString,
                      cache: true,
                      success: function(html)
                      {

                      }
                });
              
              
              
            }
          },
          cancel: function () {
            //close
          },
        },
        onContentReady: function () {
          // bind to events
          var jc = this;
          this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
          });
        }
      }); 

                    },

                });
            });
 </script>


</body>
</html>
