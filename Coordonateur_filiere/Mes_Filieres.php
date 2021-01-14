<?php

session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];
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
  $req  = ($bd->query('Select PRENOM_COR_FIL,NOM_COR_FIL ,SPCIALITE_COR_FIL from coordonateur_filiere WHERE CODE_COR_FIL="'.$rest.'"'));
  $req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA from coordonateur_filiere as C  , etablissement as E  , universite as U where  C.CODE_COR_FIL="' . $rest . '" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
  $req3 = ($bd->query('select U.NOM_UNIVERSITE,E.NOM_ETA from coordonateur_filiere as C  , etablissement as E  , universite as U where  C.CODE_COR_FIL="' . $rest . '" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
  $req4 = ($bd->query('Select  count(CODE_FIL)as Nombre_Fil from filiere WHERE  CODE_COR_FIL  ="'.$rest.'"'));
  $req5 = ($bd->prepare('Select NOM_FIL from filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
  $req10 = ($bd->prepare('Select ETAT from filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
  $req6 = ($bd->prepare('Select CODE_FIL from filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
  $req9 = ($bd->prepare('SELECT avancement FROM filiere WHERE CODE_COR_FIL="'.$rest.'" '));
  $req12 = ($bd->prepare('SELECT Statut_fil FROM filiere WHERE CODE_COR_FIL="'.$rest.'" '));
  $ress = $req->fetch();
  $ress1= $req4->fetch();
  $req5->execute();
  $req10->execute();
  $req6->execute();
  $req9->execute();
  $req12->execute();
  $ress12= $req12->fetch();
  $ress3=$req6->fetchAll();
  $ress9=$req9->fetchAll();
  $ress2  =  $req5->fetchAll();
  $ress10  =  $req10->fetchAll();
  $prenom = $ress['PRENOM_COR_FIL'];
  $nom    = $ress['NOM_COR_FIL'];
  $sep    = $ress['SPCIALITE_COR_FIL'];
  $nb     = $ress1['Nombre_Fil'];
  $Statut_fil     = $ress12['Statut_fil'];
  $nb     = $nb-1;

  if(isset($_POST['submit']))
  {
    $id  = $_POST['id']; 
    $req6->execute();
    $ress3=$req6->fetchAll();
    $idf = implode($ress3[$id]);
    $_SESSION['idf']=$idf ;
    header('Location:ListeF.php');
  }

  
  if(isset($_POST['Masquer']))
  {
    $id  = $_POST['id']; 
    $req6->execute();
      $ress3=$req6->fetchAll();
    $idf = implode($ress3[$id]);

    $Statut_filF;
    if($Statut_fil == 0)
        $Statut_filf=1;
    else
        $Statut_filf=0;
    
    $sql = "UPDATE `filiere` SET `Statut_fil`='$Statut_filf' WHERE `CODE_FIL`='$idf'";
    if (mysqli_query($ma_connexion, $sql)) {
    } else {
      echo "Error updating record: " . mysqli_error($ma_connexion);
    }
    echo "<meta http-equiv='refresh' content='0' />";
  }
  
  if(isset($_POST['valider']))
  { 
    
    $id  = $_POST['output33']; 
    $req6->execute();
      $ress3=$req6->fetchAll();
    $mat = implode($ress3[$id]);
     
    

    if(isset($_POST['multiselect']) && !empty($_POST['multiselect']))
    {
    $Col1_Array = $_POST['multiselect'];
      foreach($Col1_Array as $selectValue)
        {
        try {
          $test  = ($bd->query('INSERT INTO filiere_partagee(CODE_FIL,CODE_CORF_v,CODE_CORF_C) VALUES ("'.$mat.'","'.$selectValue.'","'.$rest.'")'));
        } catch (Exception $e) 
        {
          echo "Error: " . $e->getMessage();  
        }
    }
    // header('Location:Mes_Filieres.php');
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
header('Location:../login/login.php');
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Mes Filières</title>
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
    $('#Mes_Filieres').addClass("active");
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
        Mes filières
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

            
           <div class="col-md-12 showhideadd">
            <form name="sform" id="sform" method="POST" >
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Structure du reporting : </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Veuillez choisir les semstres : 
                      </a>
                    </h4>


        <div class="table-responsive">          
               
  <table class="table">
  <tr>
    <td></td>
    <td>S1</td>
    <td>S2</td>
    <td>S3</td>
    <td>S4</td>
  </tr>
  <tr>
    <td><label>Les Semestres</label></td>
    <td><input type="checkbox" name="S1" value="S1" id="S1" checked></td>
    <td><input type="checkbox" name="S2" value="S2" id="S2" checked></td>
    <td><input type="checkbox" name="S3" value="S3" id="S3" checked></td>
    <td><input type="checkbox" name="S4" value="S4" id="S4" checked></td>
  </tr>


  </table>
  <br><br>

      <INPUT TYPE="hidden" NAME="output" id="output" VALUE=""> 
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label"></label>
          <div class="pull-right">
        <button type="button" name="precedent" value="precedent" id="precedent" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left">&nbsp;Précédent</span></button>
        <button type="button" name="exporter" value="exporter" id="exporter" class="btn btn-primary">Suivant&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
      </div>
          </div>                      
    </div>
    </div>
    </div>
    </div>
       </div>    
       </div> </form>     
       </div>   
       



          <div class="col-md-12 showhideadd2">
            <form name="sform2" id="sform2" method="POST" >
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Structure du reporting : </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Veuillez choisir les Modules (choix multiple) : 
                      </a>
                    </h4>

            
        <div class="table-responsive">             
  <table class="table">
  <tr>
    <td><input type="text" class="form-control" id="semestre" name="semestre" readonly=""></td>
  </tr>
  
  </table>

  <?php
  echo '
  <div id="S1_S1" class="form-group">

  </div>

  '?>

  <br><br>

      <INPUT TYPE="hidden" NAME="output1" id="output1" VALUE="">  
      <INPUT TYPE="hidden" NAME="output_semestre" id="output_semestre" VALUE="">  
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label"></label>
          <div class="pull-right">
    <button type="button" name="precedent1" value="precedent1" id="precedent1" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left">&nbsp;Précédent</button>
    <button type="button" name="exporter1" value="exporter1" id="exporter1" class="btn btn-primary">Suivant&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
           </div>
          </div>                      
      </div>
    </div>
    </div>
    </div>
       </div>    
       </div> </form>     
       </div>  



          <div class="col-md-12 showhideadd3">
            <form name="sform3" id="sform3" method="POST" >
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Structure du reporting : </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Veuillez choisir les Matieres (choix multiple) : 
                      </a>
                    </h4>


            
        <div class="table-responsive">           
  <table class="table">
  <tr>
    <td><input type="text" class="form-control" id="semestre1" name="semestre1" readonly=""></td>
  </tr>
  </table>

  <?php
  echo '
  <div id="S2_S2" class="form-group">
  </div>

  '?>


  <br><br>

      <INPUT TYPE="hidden" NAME="output2" id="output2" VALUE="">    
     
<div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label"></label>
          <div class="pull-right">
   <button type="button" name="precedent2" value="precedent2" id="precedent2" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left">&nbsp;Précédent</button>
   <button type="button" name="exporter2" value="exporter2" id="exporter2" class="btn btn-primary">Suivant&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></button>
           </div>
          </div>

       </div>
    </div>
    </div>
    </div>
       </div>    
       </div> </form>     
       </div>  



          <div class="col-md-12 showhideadd4">
            <form name="sform4" id="sform4" action="pdf_mat.php" method="POST" onsubmit="return checkall();">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Structure du reporting : </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Veuillez valider votre choix : 
                      </a>
                    </h4>
            
        <div class="table-responsive">           
  <table class="table">
      <tr>
    <td>Titre(s) De(s) Matiere(s) : </td>
    <td><input type="checkbox" name="titre" value="titre" id="titre" checked=""></td>
  </tr>

  <tr>
    <td>Volume(s)(Globale,Cours,TD,TP )</td>
    <td><input type="checkbox" name="volume" value="volume" id="volume" checked=""></td>
  </tr>

  <tr>
    <td>Programme(s)</td>
    <td><input type="checkbox" name="Programme" value="Programme" id="Programme" checked=""></td>
  </tr>

  </table>

  <br><br>

      <INPUT TYPE="hidden" name="output3" id="output3" VALUE="">    
      <INPUT TYPE="hidden" name="output3_f" id="output3_f" VALUE="">
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label"></label>
          <div class="pull-right">
  <button type="button" name="precedent3" value="precedent3" id="precedent3" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left">&nbsp;Précédent</button>
  <button type="submit" name="exporter3" value="exporter3" id="exporter3" class="btn btn-success">Telecharger&nbsp;&nbsp;<span class="glyphicon glyphicon-cloud-download"></span></button>
           </div>
          </div>


       </div>
    </div>
    </div>
    </div>
       </div>    
       </div> </form>     
       </div>  

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <form name="sform33" id="sform33" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Partage de la filière </h4>
      </div>

      <div class="modal-body" style="height: 300px;">

          <div class="form-group">
            <label class="col-sm-6">Les Coordonateurs des filieres : </label>
            <div class="col-sm-8">
              <select id="example-post" name="multiselect[]" multiple="multiple" style="width: 200px;height: 200px;">;

              <?php
              session_start();
              $rest11=$_SESSION['idf'];
              try 
              {
                $reqq  = ($bd->query('SELECT distinct CODE_COR_FIL , NOM_COR_FIL ,PRENOM_COR_FIL from coordonateur_filiere where CODE_COR_FIL != "'.$rest.'"  '));
                $reqq->execute();
                $ress=$reqq->fetchAll();
                
                  foreach($ress as $row ) { 
                  
                    echo '<option value="'. $row["CODE_COR_FIL"].'">'. $row["NOM_COR_FIL"].'  '.$row["PRENOM_COR_FIL"].'</option>' ;
                       
                  }
              }catch(PDOException $e) 
                {
                  echo "Error: " . $e->getMessage();  
                }
                
                echo '<INPUT TYPE="hidden" NAME="output33" VALUE="">';
              ?>
              </select>
            </div>
          </div>
          
      
          <br><br>
          
      </div>

      <div class="modal-footer">
        <button type="submit" name="valider" value="valider" id="valider" class="btn btn-default">VALIDER</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">ANNULER</button>
      </div>
    </div>
    </form>
    </div>
   </div>




        <div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mes Filières : <?php echo $nb+1  ?></h3>
            </div>
            <?php
            for ($i = 0 ; $i <= $nb ; $i++) 
              {
                $avanc =implode($ress9[$i]);
                $NomF =implode($ress2[$i]);
                $ETAT_fil =implode($ress10[$i]);
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
                        Filière '.$j.' : '.$NomF.'-'.$ETAT_fil.'
                      </a>
                      <br>
                      <br>';if($Statut_fil == '1'){
                '<span class="pull-left">&nbsp;&nbsp;Etat d\'avancement  en % :</span>';
                     }echo '
                    </h4>
                    <div class="panel-default pull-right">
                    <form method="POST" action="">';
                      if($Statut_fil == '1'){ echo '
                  <button type="submit"  name="submit" class="btn btn-success"><span class="glyphicon glyphicon-arrow-up">&nbsp;Accéder</span></button>
                  <button type="button" name="partager" class="btn btn-info " id="mod'.$i.'" value='.$i.' onClick="afficher(this)"><span class="glyphicon glyphicon-file">&nbsp;Reporting</span></button>
                  <button type="button" name="partag_NEW" data-toggle="modal" data-target="#myModal" class="btn btn-primary" id="moddk'.$i.'" value='.$i.' onClick="afficher1(this)"><span class="glyphicon glyphicon-share">&nbsp;Partager</span></button>'; };echo '
                  <button type="submit" name="Masquer" class="btn btn-danger"><span class="glyphicon glyphicon-eye-close">';if($Statut_fil == '1'){echo '&nbsp;Masquer';}else{echo '&nbsp;DeMasquer';} echo '</span></button>
                    <input type="text" name="id" value='.$i.' hidden>
                    </form>
                </div>
                  </div>';
            if($Statut_fil == '1'){ echo '
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <input class="knob" id="kuy'.$i.'" data-width="200" data-min="0" data-displayPrevious=true value="'.$avanc.'/'.implode($ress3[$i]).'">
                    </div>
                  </div>';}echo '
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
      <b>By DMA</b>
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
    
    
      var text="#mod0,";    
      for(var ii = 1; ii<30;ii++){
        text +="#mod"+ii+",";
      }
      text += "#mod30";
        $(text).click(function()
        {
          $(".showhideadd").show();
          $(".test").hide();

        });
      
        
    $('#example-multiple-selected').multiselect();

function afficher(objButton) 
{ 
    var testin = objButton.value;
    document.sform.output.value=testin 

} 


</script>


<script type="text/javascript">

$(".showhideadd").hide();
$(".showhideadd2").hide();
$(".showhideadd3").hide();
$(".showhideadd4").hide();


$("#exporter").on('click', function () 
{
    var checkbox_value=" ";
    var idf = document.getElementById('output').value;
    
    $("#sform :checkbox").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) 
        {
            checkbox_value=checkbox_value+" "+$(this).val();
        }
    });
    document.getElementById('semestre').value = "les Semestres choisis "+":"+checkbox_value;
    document.getElementById('output1').value = idf;
     document.getElementById('output_semestre').value = checkbox_value;
     if(checkbox_value != " ")
    {
    $(".showhideadd").hide();
  $(".showhideadd2").show();
    $.ajax
         ({
                url:"search_pdf.php",
                     method:"POST",  
                     data:{checkbox_value:checkbox_value,idf:idf},
                     success: function(html)
          {
            $('#S1_S1').html(html); 
                     }  
        }); 

     }
});


$("#exporter1").on('click', function () 
{
  var option_selected="";
  var test= document.getElementById('semestre').value;
  var idf = document.getElementById('output1').value;
  var semestre = document.getElementById('output_semestre').value;


    $("option:selected").each(function () {
        var isselected = $(this).is("option:selected");
        if (isselected) 
        {
            option_selected=option_selected+" "+$(this).val();
        }
    });
    document.getElementById('semestre1').value = "les Semestres choisis "+":"+semestre;
    document.getElementById('output2').value = test;
    if(option_selected != "")
    {
    $(".showhideadd2").hide();
  $(".showhideadd3").show();
    $.ajax
         ({
                url:"search_pdf_mat.php",
                     method:"POST",  
                     data:{option_selected:option_selected,idf:idf,semestre:semestre},
                     success: function(html)
                       {
                      $('#S2_S2').html(html); 
                        }  
        }); 
     }

});

$("#exporter2").on('click', function () 
{

  var option_selected="";
  var idf = document.getElementById('output2').value;
    $('#selectid option').each(function () {
        var isselected = $(this).is("option:selected");
        if (isselected) 
        {
            option_selected=option_selected+" "+$(this).val();
        }
    });
    if(option_selected != "")
    {
    $(".showhideadd3").hide();
  $(".showhideadd4").show();
    document.getElementById('output3').value = option_selected;
    document.getElementById('output3_f').value = idf;
  }
});

    
$('#precedent').on('click',function(){
  $(".showhideadd").hide();
  $(".test").show();
});
$('#precedent1').on('click',function(){
  $(".showhideadd2").hide();
  $(".showhideadd").show();
});
$('#precedent2').on('click',function(){
  $(".showhideadd3").hide();
  $(".showhideadd2").show();
});
$('#precedent3').on('click',function(){
  $(".showhideadd4").hide();
  $(".showhideadd3").show();
});


</script>


<script type="text/javascript">
  

var titre = document.getElementById('titre');
var volume = document.getElementById('volume');
var test_pr = document.getElementById('Programme');


titre.onchange = function() 
{
    if (titre.checked==false) 
    {
        document.getElementById("volume").checked = false;
        document.getElementById("Programme").checked = false;
    }
};


volume.onchange = function() 
{
    if (volume.checked==true) 
    {
        document.getElementById("titre").checked = true;
    }
};

test_pr.onchange = function() 
{
    if (test_pr.checked==true) 
    {
        document.getElementById("titre").checked = true;
    }
};

</script>



<script>
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
                      url: "avancement_f.php",
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

function checkall()
{
  var titre = document.getElementById('titre');
  var volume = document.getElementById('volume');
  var test_pr = document.getElementById('Programme');

  if (titre.checked==true || volume.checked==true || test_pr.checked==true) 
  {
    return true;
  }
  else
  {
  return false;
  }
}

function afficher1(objButton) 
{     
    var testin = objButton.value;
    document.sform33.output33.value=testin;
    //$("#myModal").modal('show');
}

</script>


</body>
</html>
