<?php
session_start();
include '../connexion.php';
$rest = $_SESSION['info'];
$rest11=$_SESSION['idf'];
$Etat = $_SESSION['NIV'];

$reqq  = ($bd->query('Select  PRENOM_ENS   , NOM_ENS, IMAGE_ENS   from enseignant  WHERE    CODE_ENS  ="' . $rest . '"'));
$ress = $reqq->fetch();
$nom=$ress['NOM_ENS'];
$prenom=$ress['PRENOM_ENS'];
$image_ENS=$ress['IMAGE_ENS'];

$req5 = ($bd->query('SELECT m.NOM_MAT,m.CODE_MAT FROM intervient as i , matiere as m WHERE CODE_ENS  ="' . $rest . '" and i.CODE_MAT=m.CODE_MAT and i.CODE_MAT="'. $rest11 . '" '));
$ress1 = $req5->fetch();
$matiere=$ress1['NOM_MAT'];
$idmat=$ress1['CODE_MAT'];


$req6 = ($bd->query('SELECT mo.NOM_MODU,mo.CODE_MODU,mo.ID_SEMSTRE FROM module as mo , matiere as m WHERE m.NOM_MAT  ="' . $matiere . '" and mo.CODE_MODU=m.CODE_MODU '));
$ress2 = $req6->fetch();
$module=$ress2['NOM_MODU'];
$idmodule = $ress2['CODE_MODU'];
$semestre = $ress2['ID_SEMSTRE'];

$req7 = ($bd->query("SELECT  f.CODE_FIL,f.NOM_FIL  from filiere f , module m where f.CODE_FIL = m.CODE_FIL and m.CODE_MODU = '$idmodule'"));
$ress3 = $req7->fetch();
$idfil=$ress3['CODE_FIL'];
$nomfil=$ress3['NOM_FIL'];


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
  <title>Gestion des filières | Ma Matière</title>
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

<link rel="stylesheet" type="text/css" href="../css/set2.css">  	
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">  		
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">  


	
	<link href="../css/datepicker3.css" rel="stylesheet">
	<!--indicateur-->
	<link rel="stylesheet" href="../css/morris.css">
	
	<script src="../js/jquery.min.js"></script>
	<script src="../js/raphael-min.js"></script>
	<script src="../js/morris.min.js"></script>
	
	<script src="../js/jquery-ui.js"></script>
	
	<script src="../js/amcharts.js" type="text/javascript"></script>
    <script src="../js/pie.js" type="text/javascript"></script>
	
	<link href="../css/select2.min.css" rel="stylesheet" />

  <script type="text/javascript">
  $(function() {
    $('#Mes_Filieres').addClass("active");
  });
</script>
<style>
#ex1Slider .slider-selection {
  background: #BABABA;
}*






/**
 * Oscuro: #283035
 * Azul: #03658c
 * Detalle: #c7cacb
 * Fondo: #dee1e3
 ----------------------------------*/
 

 * {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
 }
 
 a {
  color: #03658c;
  text-decoration: none;
 }

ul {
  list-style-type: none;
}



/** ====================
 * Lista de Comentarios
 =======================*/
.comments-container {
  margin: 60px auto 15px;
  width: 768px;
}

.comments-container h1 {
  font-size: 36px;
  color: #283035;
  font-weight: 400;
}

.comments-container h1 a {
  font-size: 18px;
  font-weight: 700;
}

.comments-list {
  margin-top: 30px;
  position: relative;
}

/**
 * Lineas / Detalles
 -----------------------*/
.comments-list:before {
  content: '';
  width: 2px;
  height: 100%;
  background: #c7cacb;
  position: absolute;
  left: 32px;
  top: 0;
}

.comments-list:after {
  content: '';
  position: absolute;
  background: #c7cacb;
  bottom: 0;
  left: 27px;
  width: 7px;
  height: 7px;
  border: 3px solid #dee1e3;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
}

.reply-list:before, .reply-list:after {display: none;}
.reply-list li:before {
  content: '';
  width: 60px;
  height: 2px;
  background: #c7cacb;
  position: absolute;
  top: 25px;
  left: -55px;
}


.comments-list li {
  margin-bottom: 15px;
  display: block;
  position: relative;
}

.comments-list li:after {
  content: '';
  display: block;
  clear: both;
  height: 0;
  width: 0;
}

.reply-list {
  padding-left: 88px;
  clear: both;
  margin-top: 15px;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
  width: 65px;
  height: 65px;
  position: relative;
  z-index: 99;
  float: left;
  border: 3px solid #FFF;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
  -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
  box-shadow: 0 1px 2px rgba(0,0,0,0.2);
  overflow: hidden;
}

.comments-list .comment-avatar img {
  width: 100%;
  height: 100%;
}

.reply-list .comment-avatar {
  width: 50px;
  height: 50px;
}

.comment-main-level:after {
  content: '';
  width: 0;
  height: 0;
  display: block;
  clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
  width: 680px;
  float: right;
  position: relative;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
  -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
  box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}

.comments-list .comment-box:before, .comments-list .comment-box:after {
  content: '';
  height: 0;
  width: 0;
  position: absolute;
  display: block;
  border-width: 10px 12px 10px 0;
  border-style: solid;
  border-color: transparent #FCFCFC;
  top: 8px;
  left: -11px;
}

.comments-list .comment-box:before {
  border-width: 11px 13px 11px 0;
  border-color: transparent rgba(0,0,0,0.05);
  left: -12px;
}

.reply-list .comment-box {
  width: 610px;
}
.comment-box .comment-head {
  background: #FCFCFC;
  padding: 10px 12px;
  border-bottom: 1px solid #E5E5E5;
  overflow: hidden;
  -webkit-border-radius: 4px 4px 0 0;
  -moz-border-radius: 4px 4px 0 0;
  border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
  float: right;
  margin-left: 14px;
  position: relative;
  top: 2px;
  color: #A6A6A6;
  cursor: pointer;
  -webkit-transition: color 0.3s ease;
  -o-transition: color 0.3s ease;
  transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
  color: #03658c;
}

.comment-box .comment-name {
  color: #283035;
  font-size: 14px;
  font-weight: 700;
  float: left;
  margin-right: 10px;
}

.comment-box .comment-name a {
  color: #283035;
}

.comment-box .comment-head span {
  float: left;
  color: #999;
  font-size: 13px;
  position: relative;
  top: 1px;
}

.comment-box .comment-content {
  background: #FFF;
  padding: 12px;
  font-size: 15px;
  color: #595959;
  -webkit-border-radius: 0 0 4px 4px;
  -moz-border-radius: 0 0 4px 4px;
  border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
.comment-box .comment-name.by-author:after {
  content: 'auteur';
  background: #03658c;
  color: #FFF;
  font-size: 12px;
  padding: 3px 5px;
  font-weight: 700;
  margin-left: 10px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
  .comments-container {
    width: 480px;
  }

  .comments-list .comment-box {
    width: 390px;
  }

  .reply-list .comment-box {
    width: 320px;
  }
}


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

<script src="../js/classie.js"></script>
    <script>
      (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
          (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
              return this.replace(rtrim, '');
            };
          })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
          // in case the input is already filled..
          if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
          }

          // events:
          inputEl.addEventListener( 'focus', onInputFocus );
          inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
          classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
          if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
          }
        }
      })();
    </script>



</head>
<body class="sidebar-mini wysihtml5-supported skin-blue">
<div class="wrapper">


<?php   
    
               
$query = " SELECT *  from matiere where CODE_MAT = '$idmat' ";
$result = mysqli_query($ma_connexion, $query); 

$nommatreq        = null ; 
$volumeglobalreq = null ; 
$volumecourreq   = null ; 
$volumeTPreq     = null ; 
$volumeTDreq     = null ; 
$volumeAPreq     = null ; 
$specmatreq     = null ; 
$DESCRIPTION_REQ     = null ; 
$type_cour     = null ; 

while(($row = mysqli_fetch_array($result)) == true )  
{                     
  $nommatreq        = $row['NOM_MAT'] ;
  $volumeglobalreq  = $row['VOLUME_HORAIRE_MAT'] ;
  $volumecourreq    = $row['VOLUME_COURS_MAT'] ;
  $volumeTPreq      = $row['VOLUME_TP_MAT'] ;
  $volumeTDreq      = $row['VOLUME_TD_MAT'] ;
  $volumeAPreq      = $row['VOLUME_AP_MAT'] ;
  $specmatreq = $row['SEPCIALITE_MAT'] ;
  $DESCRIPTION_REQ = $row['DESCRIPTION_MAT'] ;
  $type_cour = $row['type_cour'] ;
  
}



?>  



<?php include("../includes/header.php"); ?>
<?php include("../includes/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Détails Filière : 
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">


        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('../images/photo1.png') center center;">
              <h3 class="widget-user-username"><?php echo $nom ; echo ' ' ; echo $prenom ;  ?></h3>
              <h5 class="widget-user-desc"><?php echo $Etat ;  ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="
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
                                            
                                            
                                        ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Semestre: </h5>
                    <span class="description-text"><?php echo $semestre; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Module:</h5>
                    <span class="description-text"><?php echo $module ; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Matière:</h5>
                    <span class="description-text"><?php echo $matiere; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
            

        <div class="col-md-12 showhideadd">
            <form name="sform" id="sform" method="POST" >
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Matière : <?php echo $matiere ;  ?> </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h2 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Informations concernant cette Matière : 
                      </a>
                    </h2>
                    <br>
                    <br>

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Matiere" data-toggle="tab">Matière</a></li>
                <li><a href="#descriptionMatière" data-toggle="tab">Description Matière</a></li>
                <li><a href="#indicateur" data-toggle="tab">Indicateurs</a></li>
                <li><a href="#commentaire" data-toggle="tab">Commentaire</a></li>
                <li><a href="#competence" data-toggle="tab">compétences</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="Matiere">
                <form class="form-horizontal" action="" method="POST">

                  <div class="form-group">
                            <label for="nommatinput" class="col-sm-3 control-label">Nom Matière</label>
                                <div class="col-sm-6">
                            <input type="text" class="form-control" readOnly="true" ondblclick="this.readOnly=false" id="nommatinput" placeholder="Nom Matière" value="<?php echo $nommatreq ; ?>">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="typeCourinput" class="col-sm-3 control-label">type cour</label>
                                <div class="col-sm-6">
                                  <select class="form-control" name="typeCourinput" id="typeCourinput" readonly="true" >
                            <?php
                            if ($type_cour == 0 ) 
                            {
                              echo '
                              <option  value="0" selected>transversale</option> 
                              <option  value="1" >de base</option>  
                              <option  value="2" >de specialite</option>  
                              ' ;
                            }
                            if ($type_cour == 1 ) 
                            {
                              echo '
                              <option  value="0" >transversale</option> 
                              <option  value="1" selected>de base</option>  
                              <option  value="2" >de specialite</option>  
                              ' ; 
                            }
                            if ($type_cour == 2 ) 
                            {
                              echo '
                              <option  value="0" >transversale</option> 
                              <option  value="1" >de base</option>  
                              <option  value="2" selected>de specialite</option>  
                              ' ;
                            }
                          
                          ?>
                        </select>
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="specialitematinput" class="col-sm-3 control-label">Specialite</label>
                                <div class="col-sm-6">
                              <select class="form-control" name="specialitematinput" id="specialitematinput" readonly="true" >
                                    <?php
                                  $SQL="select * from specialite_crm;";
                                  $query=mysqli_query($ma_connexion,$SQL);
                                  while($row=mysqli_fetch_assoc($query))
                                  {
                                    if ( $row['CODE_SPEC'] == $specmatreq)
                                    echo ' 
                                    <option  value="'.$row['CODE_SPEC'].'" selected>'.$row['NOM_SPEC'].'</option>
                                    <';
                                    else
                                      echo ' 
                                    <option  value="'.$row['CODE_SPEC'].'" >'.$row['NOM_SPEC'].'</option>
                                    <';
                                  }
                                  ?>
                                </select>
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Volume Global<small> (Max :..h)</small></label>
                                <div class="col-sm-6">
                                  <input type="number" min="0" class="form-control"  readOnly="true" ondblclick="this.readOnly=false" placeholder="0" id="volumeglobalinput" value="<?php echo $volumeglobalreq ; ?>">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                         <label for="inputEmail3" class="col-sm-3 control-label">Volume Cours<small> (Max :..h)</small></label>
                                <div class="col-sm-6">
                                  <input type="number" min="0" class="form-control" readOnly="true" ondblclick="this.readOnly=false" id="volumecoursinput" value="<?php echo $volumecourreq ; ?>"  placeholder="0">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Volume TP<small> (Max :..h)</small></label>
                                <div class="col-sm-6">
                            <input type="number" min="0"  class="form-control"  readOnly="true" ondblclick="this.readOnly=false" id="volumeTPinput" value="<?php echo $volumeTPreq ; ?>"   placeholder="0">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Volume TD<small> (Max :..h)</small></label>
                                <div class="col-sm-6">
                                  <input type="number" min="0"  class="form-control"  readOnly="true" ondblclick="this.readOnly=false" id="volumeTDinput" value="<?php echo $volumeTDreq ; ?>"  placeholder="0">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Volume AP<small> (Max :..h)</small></label>
                                <div class="col-sm-6">
                                  <input type="number" min="0"  class="form-control"  readOnly="true" ondblclick="this.readOnly=false" id="volumeAPinput" value="<?php echo $volumeAPreq ; ?>"   placeholder="0">
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>

                  <?php
                  $CHECKCours = null ;
                  $CHECKtd = null ;
                  $CHECKtp = null ;
                  $CHECKEncadrement = null ;
                  $codeINTERV = null ; 
                  $SQL="SELECT CODE_INTERVENTION
                      FROM enseigneer
                      WHERE CODE_ENS = $rest
                      AND CODE_MAT = $idmat ";
                  $query=mysqli_query($ma_connexion,$SQL);
                  while($row=mysqli_fetch_assoc($query))
                  {
                    $codeINTERV = $row['CODE_INTERVENTION'] ; 
                    if ($codeINTERV == 1)
                      $CHECKCours = 1 ; 
                    
                    if ($codeINTERV == 2)
                      $CHECKtd = 1 ; 
                    
                    
                    if ($codeINTERV == 3)
                      $CHECKtp = 1 ; 
                    
                    
                    if ($codeINTERV == 4)
                      $CHECKEncadrement = 1 ; 
                  }
                  ?>



                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Type d'intervention</label>
                                <div class="col-sm-6">
                                    <div class="checkbox"> 
                          <label>
                          <input type="checkbox" value="" id="CoursInputCHECK" <?php if($CHECKCours ==1) echo "checked" ; ?> >
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Cours
                          </label>
                        </div>
                        
                        <div class="checkbox">
                          <label>
                          <input type="checkbox" value="" id="TDInputCHECK" <?php if($CHECKtd ==1) echo "checked" ; ?>>
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          TD
                          </label>
                        </div>
                        
                        
                        <div class="checkbox">
                          <label>
                          <input type="checkbox" value=""   id="TPInputCHECK" <?php if($CHECKtp ==1) echo "checked" ; ?>>
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          TP
                          </label>
                        </div>
                        
                        
                        <div class="checkbox">
                          <label>
                          <input type="checkbox" value=""  id="EncadrementInputCHECK" <?php if($CHECKEncadrement ==1) echo "checked" ; ?>> 
                          <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                          Encadrement
                          </label>
                        </div>
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div style="display: inline"><br></div>
                  <?php
                    if (!isset($_SESSION['TestCordModule'])) 
                    {
                       echo '<div class="form-group" >
                    <div class="col-sm-offset-6 col-sm-10">
                      <button type="button" id="validermatiereinfo" class="btn btn-success" style="margin-top: 20px;">Valider</button>
                    </div>
                  </div>' ; 
                    }
                    ?>

                  <div style="display: inline"><br></div><div style="display: inline"><br></div>
                  <div style="display: inline"><br></div><div style="display: inline"><br></div>
                </form>
              </div>


              <div class="tab-pane" id="descriptionMatière">
                <form class="form-horizontal" action="" method="POST">

                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Description Matière</label>
                                <div class="col-sm-6">
                                  <textarea  readonly="true" ondblclick="this.readOnly=false" class="form-control" rows="3" id="Description_matiere_input" style="resize: none;"> <?php echo $DESCRIPTION_REQ ; ?> </textarea>
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>

                  <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Evaluation</label>
                                <div class="col-sm-6">
                                  <div class="checkbox">
                                      <label>
                                      <input type="checkbox" value="">
                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                       Examen final
                                      </label>
                                    </div>
                                    
                                    
                                    <div class="checkbox">
                                      <label>
                                      <input type="checkbox" value="">
                                      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                      Control Continue
                                      </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                  <button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <?php
                    if (!isset($_SESSION['TestCordModule'])) 
                    {
                       echo '<div class="form-group" >
                    <div class="col-sm-offset-6 col-sm-10">
                      <button type="button" id="validerdescriptionMatière" class="btn btn-success" style="margin-top: 20px;">Valider</button>
                    </div>
                  </div>' ; 
                    }
                    ?>
                </form>
		          </div>

              <div class="tab-pane" id="indicateur">

                <div id="chartdiv1" style="width: 100%; height:500px;"></div>  
                <div id="chartdiv2" style="width: 100%; height:500px;"></div>  
                <div id="chartdiv3" style="width: 100%; height: 400px;"></div> 
                <div id="chartdiv4" style="width: 100%; height: 400px;"></div> 
                
              </div>

              <div class="tab-pane" id="commentaire">
                <form class="form-horizontal" action="" method="POST">

                  <textarea class="form-control" id="commentText" placeholder="Ecrivez votre commentaire" rows="5" style="resize: none;"></textarea>
							<br>
							
							<button type="button"  id="envoicomment" class="btn btn-info pull-right">Envoyer Le commentaire</button>
							<div class="clearfix"></div>
							<hr style="border-style: groove;">
							
						    	<form class="form-horizontal">
									<div class="comments-container">
									<ul id="comments-list" class="comments-list" >
									
				 <?php

								$idcomment = 0 ; 	 
																		
								$query001 = "SELECT *
										FROM commentaiireens c 
										where c.CODE_MAT = '$idmat'
										 ";	
										
								$result001 = mysqli_query($ma_connexion, $query001);
													
								if (mysqli_num_rows($result001) > 0) 
								{
									
									while($row001 = mysqli_fetch_assoc($result001)) 
									{
										$code = $row001['code_comment'] ;
										$comment = $row001['comment'] ;
										$date_comme = $row001['Date_comment'] ;
										$time_comment = $row001['time_comment'] ;
										$typeUSER = $row001['TYPE'] ;
										$IDUSER = $row001['UDER'] ;
										
										$indColor =  0; 
										
										$sql = " SELECT code_comment
												FROM commentlikedislikeens
												WHERE code_comment = $code
												and UDER = $IDUSER
												and TYPE = 'ENS'
												and INDICE = 0 ;  ";
										$result = mysqli_query($ma_connexion, $sql);

										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$indColor = 1 ; 
											}
										}
										else{
										}
										$LiDaroLike = ''; 
										
										$sql = " SELECT ens.NOM_ENS , ens.PRENOM_ENS
											FROM commentlikedislikeens cml , enseignant ens 
											where ens.CODE_ENS = cml.UDER
											and cml.TYPE = 'ENS'
											and cml.code_comment = $code 
											and cml.INDICE = 0   ";
										$result = mysqli_query($ma_connexion, $sql);

										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$nom_LIKET = $row["NOM_ENS"] ;
												$prenom_LIKET = $row["PRENOM_ENS"] ;
												
												$LiDaroLike .= "$nom_LIKET   $prenom_LIKET  <br>  " ; 
												
											}
										}
										if ( $typeUSER == "ENS")
										{
											$query002 = "SELECT e.NOM_ENS , e.PRENOM_ENS , e.IMAGE_ENS
												FROM enseignant e
												where e.CODE_ENS =  $IDUSER ";
											
										
											$result002 = mysqli_query($ma_connexion, $query002);
															
											if (mysqli_num_rows($result002) > 0) 
											{
											
											 while($row002 = mysqli_fetch_assoc($result002)) 
											 {
												
												$nom_r = $row002['NOM_ENS'] ;
												$prenom_r = $row002['PRENOM_ENS'] ;
												$image = $row002['IMAGE_ENS'] ;
																	
																	
																	
										echo ' 
										
										<li>
												<div class="comment-main-level">
													<!-- Avatar -->
													<div class="comment-avatar"><img src="../images/'.$image .'" alt=""   ></div>
													<!-- Contenedor del Comentario -->
													<div class="comment-box">
														<div class="comment-head">
															<h6 class="comment-name by-author">'.$nom_r .' '. $prenom_r  .'</h6>
															<span>'.$date_comme.'  '.$time_comment.'</span> 

															<i class="fa fa-reply"  id="repondre'.$idcomment.'" onclick="fonctionrepondre('.$idcomment.','.$code.')"></i>	 ';														 
															
															
															if ($indColor == 0)	
															{
																	echo ' <i data-toggle="tooltip" data-placement="top" data-html="true" title="'.$LiDaroLike.'"  class="fa fa-heart" id="Like_CMT'.$idcomment.'" onclick="fonctionLike('.$idcomment.','.$code.')"></i>'	;		
															}
																else	
																{
																	echo '<i data-toggle="tooltip" data-placement="top" data-html="true" title="'.$LiDaroLike.'"  class="fa fa-heart" id="Like_CMT'.$idcomment.'" style="color : red ;" onclick="fonctionLike('.$idcomment.','.$code.')"></i>';
																}
														echo '</div>
														<div class="comment-content">
															'.$comment.'
														</div>
													</div>
												</div>
												
										';
																	
									echo '
									
									<ul class="comments-list reply-list" id="lesReplays'.$idcomment.'" > '; 
									
									$query003 = "SELECT *
											FROM commentaiirereplyens c 
											where c.code_comment = '$code' ";	
											
									$result003 = mysqli_query($ma_connexion, $query003);
														
									if (mysqli_num_rows($result003) > 0) 
									{
										
										while($row003 = mysqli_fetch_assoc($result003)) 
										{
											$coderep = $row003['code_comment'] ;
											$commentrep = $row003['comment'] ;
											$date_commerep = $row003['Date_comment'] ;
											$time_commentrep = $row003['time_comment'] ;
											$typeUSERrep = $row003['TYPE'] ;
											$IDUSERrep = $row003['UDER'] ;
											

										if ( $typeUSERrep == "ENS")
										{
												$query004 = "SELECT e.NOM_ENS , e.PRENOM_ENS , e.IMAGE_ENS
													FROM enseignant e
													where e.CODE_ENS  = $IDUSERrep
														";	
											
											
											
											$result004 = mysqli_query($ma_connexion, $query004);
																
											if (mysqli_num_rows($result004) > 0) 
											{
												
												while($row004 = mysqli_fetch_assoc($result004)) 
												{
													$nomrep = $row004['NOM_ENS'] ;
													$prenomrep= $row004['PRENOM_ENS'] ;
													$imagerep= $row004['IMAGE_ENS'] ;
													
													
													echo ' 
													<li>
														<!-- Avatar -->
														<div class="comment-avatar"><img src="../images/'.$imagerep .'" alt=""  ></div>
														<!-- Contenedor del Comentario -->
														<div class="comment-box">
															<div class="comment-head">
																<h6 class="comment-name">'.$nomrep.' '.$prenomrep.'</h6>
																<span>'.$date_commerep.'  '.$time_commentrep.'</span>
																
															</div>
															<div class="comment-content">
																'.$commentrep.'
																</div>
														</div>
													</li> ' ; 
				
											}
											 
										 }
										}
									 }	
								 }
								echo '  </ul> ';
								}
								
							}
						}
														
														echo '</li>' ;
														$idcomment++;
																	
														
													}
													}
													
													?>
										
										</ul>
									</div>
                </form>
              </div>


              <div class="tab-pane" id="competence">
                <?php
                echo ' <form method="POST" > ';
                 echo ' <div id="lescurseurs" > ';
                  echo ' <div class="row"> ' ; 
                
                $iNEWi = 1 ; $jdk = null ; 
                $avc = null ; 

                echo ' <div class="col-md-12"> '; 
                echo '<h3>les compétences par rapport au matiere</h3>';
                echo '<div class="box-body table-responsive no-padding">';
                echo '<table class="table table-hover" border="2">
                  <tr>
                  <th>compétence</th>
                  <th>curseur</th>
                  <th>pourcentage</th>
                  </tr>';
                
                $query = " SELECT c.COMPETNECE ,c.CODE_DOMAINE, c.source_comp, cm.taux as avancementcomp , c.CODE_COMP , cm.type
                    							FROM compmatiere cm , competence c 
                    							where cm.CODE_COMP = c.CODE_COMP
                    							and cm.CODE_MAT = '$idmat'
                    							and cm.type=0 ";
                
                $result = mysqli_query($ma_connexion, $query); 
         
                     while(($row = mysqli_fetch_array($result)) == true )  
                      { 
                    
                      $code = $row['CODE_COMP'] ;
						$codeDomaine = $row['CODE_DOMAINE'];
						$source_comp = $row['source_comp'];
						$name = $row['COMPETNECE'];
						$avc= $row['avancementcomp'] ;
                      
                      echo "<tr> <td>$name : $source_comp"  ; 
                      echo "<input type='hidden' value='$code' name='".$iNEWi."'/></td> ";  
                            
                      echo " <td><input  id='slidermod$iNEWi' name='k".$iNEWi."' Onchange='change1(this.value)' type='range' min='0' max='100' step='1' value='".$avc."'/></td>
                      <td><span id='val1'>$avc%</span> </td></tr>"; 
                           $iNEWi = $iNEWi + 1 ;
                    }
                    
                echo '</table>';
                echo ' </div > ';   
                echo ' </div > ';   
                    

                echo ' <div class="col-md-12"> '; 
                echo '<h3>les compétences par rapport au matiere concérnée</h3>';
                echo '<div class="box-body table-responsive no-padding">';
                echo '<table class="table table-hover" border="2">
                  <tr>
                  <th>compétence</th>
                  <th>curseur</th>
                  <th>pourcentage</th>
                  <th>Supprimer</th>
                  </tr>';

                  $query = " SELECT c.COMPETNECE ,c.CODE_DOMAINE, c.source_comp, cm.taux as avancementcomp , c.CODE_COMP , cm.type
                    							FROM compmatiere cm , competence c 
                    							where cm.CODE_COMP = c.CODE_COMP
                    							and cm.CODE_MAT = '$idmat'
                    							and cm.type=1 ";
                
                   
                    $result = mysqli_query($ma_connexion, $query); 
                     
                     
                     while(($row = mysqli_fetch_array($result)) == true )  
                      { 
                    
                    	$code = $row['CODE_COMP'] ;
						$codeDomaine = $row['CODE_DOMAINE'];
						$source_comp = $row['source_comp'];
						$name = $row['COMPETNECE'];
						$avc= $row['avancementcomp'] ; 
                    
                    echo "<tr><td>$name : $source_comp"  ; 
                    echo "<input type='hidden' value='$code' name='".$iNEWi."' /></td> ";
                          
                    echo "<td><input id='slidermod$iNEWi' name='k".$iNEWi."' Onchange='change2(this)' type='range' min='0' step='1' max='100' value='".$avc."'/><td><span class='k".$iNEWi."'>$avc%</span></td></td>"  ; 
                    
                    
                         $iNEWi = $iNEWi + 1 ;
                    echo "<td><button type='submit' class='btn btn-default example3' id='sup".$iNEWi."' name='sup1' value='".$code."' ><i class='fa fa-trash fa-lg'></i></button></td></tr> " ;     
                    
                    }
                    echo '</table>';
                    echo ' </div> ';
                    echo ' </div> ';
                    echo '<div style="display: inline"><br></div><div style="display: inline"><br></div>';

                    $jdk = $iNEWi ; 
					echo "<br><br>" ; 


                    echo '<center> <button type="button" onclick="myFunction()" class="btn btn-primary"  id="nouvellecomp"> Ajouter une nouvelle competence </button><center>  <br>' ; 
                    
                    echo '
                    <section class="content" id="hidenewcom" >
        
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede noselect" id="input-35" type="text" readonly="true" value="'.$matiere.'" >
                          <label class="input__label input__label--kaede" for="input-35">
                            <span class="input__label-content input__label-content--kaede">matiere</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede" id="newcompname" type="text" name="input-4">
                          <label class="input__label input__label--kaede" for="newcompname">
                            <span class="input__label-content input__label-content--kaede">compétence</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede" id="newcomptaux" name="exnewcomp" type="number" min="0" max="100">
                          <label class="input__label input__label--kaede" for="newcomptaux">
                            <span class="input__label-content input__label-content--kaede">Taux</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                        <input type="radio" name="source_exi" value="Académique" id="académique_exi">&nbsp&nbspà base Académique&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <input type="radio" name="source_exi" value="Annonces" id="annonces_exi">&nbsp&nbspà base des annonces<br><br>
                      </span>
                      
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                       

                      <div class="funkyradio">
                        <div class="funkyradio-primary">
                          <input type="checkbox" name="checkbox" id="checkbox1"   />
                          <label for="checkbox1">Confirmer votre choix </label>
                        </div>
                        
                      </div>
                    </div>
                    <br><br>
                    </section>' ;
                    
                    echo '</div></div>' ;
                    

                    echo '<br><center><button type="submit" id="enregistrer" name="enregistrer" class="btn btn-danger">Enregistrer</button></center>' ; 
                    echo ' </form > ';
                ?>
                <script>
                  $("#hidenewcom").hide();
                  function myFunction() {
                    $("#hidenewcom").show();
                  }
                </script>
                <script type="text/javascript">
	function change1(obj)
     { 
         	var a=obj;
         	$('#val1').text(a+'%');
      }
    function change2(obj)
     { 
         	var a=$(obj).val();
         	var b=$(obj).attr('name');
         	$('.'+b).text(a+'%');
      }
</script>

               
              <?php
              if(isset($_POST['sup1'])){
                
                $nomcomdele = $_POST['sup1'] ; 
                $query001 = "DELETE FROM `compmatiere` 
                      WHERE CODE_MAT = '$idmat' 
                      and CODE_COMP = '$nomcomdele' ";
                if (mysqli_query($ma_connexion, $query001)) {     
                    } else {
                      echo "Error updating record: " . mysqli_error($conn);
                    } 
                $query002 = "DELETE FROM `competence` 
                      WHERE CODE_COMP = $nomcomdele";
                      
                if (mysqli_query($ma_connexion, $query002)) {
                       echo "<meta http-equiv='refresh' content='0'>";
                    } else {
                      echo "Error updating record: " . mysqli_error($conn);
                    } 
                  }
              if(isset($_POST['enregistrer']))
              {
                if(isset($_POST['checkbox'])){
                  for ($x = 1; $x < $jdk; $x++) 
                  {
                      $txt = $x ;
                      $txt2 = "k".$x ; 
                      $idchange = $_POST["$txt"] ; 
                      $valavanc = $_POST["$txt2"] ; 
                      $query = "UPDATE CompMatiere
                          set taux = $valavanc
                          where CODE_MAT= '$idmat'
                          and CODE_COMP = '".$idchange."'";
                    
                    if (mysqli_query($ma_connexion, $query)) {
                    } else {
                      echo "Error updating record when add new comp " . mysqli_error($ma_connexion);
                    }
                  }
                    $nomcomp = mysqli_real_escape_string($ma_connexion,$_POST['input-4']);
      				$source=$_POST['source_exi'];

           $query0 = "INSERT INTO `competence`(`CODE_DOMAINE`,`COMPETNECE`,`source_comp`) VALUES ('1','$nomcomp','$source')";
                  

                  if (mysqli_query($ma_connexion, $query0)) {
                  } else {
                    echo "Error insert record: aze " . mysqli_error($ma_connexion);
                  }                     

                    $query001 = "SELECT CODE_COMP FROM competence
                            ORDER BY CODE_COMP DESC
                            LIMIT 1 ";  
                    $result = mysqli_query($ma_connexion, $query001);
                    $idcompnew = null ;             
                    if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                        $idcompnew = $row["CODE_COMP"] ; 
                      }
                    } else {
                      echo "0 results";
                    } 
    
                          
                    $valavanc = $_POST['exnewcomp'] ;
                    
                    
                      $comptertest = 0  ; 
                    $tabhelp1 = array();
                    $tabhelp2 = array();
                    $savecodecomp = array();
                    
                    $query = "  SELECT COUNT(cm.CODE_MAT) as nombrasavoir
                          FROM compmatiere cm , module mo , matiere m
                          WHERE cm.CODE_MAT = m.CODE_MAT
                          and m.CODE_MODU = '$idmodule'
                                              GROUP BY cm.CODE_COMP             
                    ";  

                
                    $result = mysqli_query($ma_connexion, $query); 
                     while(($row = mysqli_fetch_array($result)) == true )  
                          { 
                        
                        
                        $tabhelp1[]  = $row['nombrasavoir'] ;
                        $comptertest++ ;  
                        }
                        
                    
                    
                    $query = "  SELECT  cm.CODE_COMP , SUM(cm.taux)    as sommeasavoir                                  
                          FROM compmatiere cm , module mo , matiere m
                          WHERE cm.CODE_MAT = m.CODE_MAT
                          and m.CODE_MODU = '$idmodule' 
                          GROUP BY cm.CODE_COMP             
                    ";  

                
                    $result = mysqli_query($ma_connexion, $query); 
                     while(($row = mysqli_fetch_array($result)) == true )  
                          { 
                        $tabhelp2[]  = $row['sommeasavoir'] ;
                        $savecodecomp[]  = $row['CODE_COMP'] ;
                        }
                    

                    
                    for($bn = 0; $bn <= $comptertest; $bn++) {
                      
                      if (array_key_exists($bn, $tabhelp2) && array_key_exists($bn, $tabhelp1))
                      {
                      $vaornew = $tabhelp2[$bn] / (100 * $tabhelp1[$bn]) * 100 ; 
                      $query = "UPDATE compmodule
                      set taux = $vaornew
                      where compmodule.CODE_MODU = '$idmodule' 
                      and compmodule.CODE_COMP = $savecodecomp[$bn] ; " ; 

                      if (mysqli_query($ma_connexion, $query)) {
                                        
                      } else {
                        echo "Error updating record: hhhh" . $bn;
                      }
                      
                      }
                   
                    }

                    $query = "insert into  CompMatiere(`CODE_MAT`, `CODE_COMP`, `taux`,`type`) 
                          VALUES('$idmat',$idcompnew,$valavanc,1)"; 
                  if (mysqli_query($ma_connexion, $query)) {
                   echo "<meta http-equiv='refresh' content='0' />";
                  } else {
                    echo "Error updating record: " . mysqli_error($ma_connexion);
                  } 
                }
                  else 
                  {
                    for ($x = 1; $x < $iNEWi; $x++) 
                    {
                        $txt = $x ;
                        $txt2 = "k".$x ; 
                        $idchange = $_POST["$txt"] ; 
                        $valavanc = $_POST["$txt2"] ; 
                        
                        $query = "UPDATE CompMatiere
                            set taux = $valavanc
                            where CODE_MAT= '$idmat'
                            and CODE_COMP = '".$idchange."' ";
                      
                      if (mysqli_query($ma_connexion, $query)) {
                          echo "<meta http-equiv='refresh' content='0'>"; 
                      } else {
                        echo "Error updating record: " . mysqli_error($conn);
                      } 
                    } 
                    
                    $comptertest = 0  ; 
                    $tabhelp1 = array();
                    $tabhelp2 = array();
                    $savecodecomp = array();
                    
                    $query = "  SELECT COUNT(cm.CODE_MAT) as nombrasavoir
                          FROM compmatiere cm , module mo , matiere m
                          WHERE cm.CODE_MAT = m.CODE_MAT
                          and m.CODE_MODU = '$idmodule'
                                              GROUP BY cm.CODE_COMP             
                    ";  

                
                    $result = mysqli_query($ma_connexion, $query); 
                     while(($row = mysqli_fetch_array($result)) == true )  
                          { 
                        
                        
                        $tabhelp1[]  = $row['nombrasavoir'] ;
                        $comptertest++ ;  
                        }
                        
                    
                    
                    $query = "  SELECT  cm.CODE_COMP , SUM(cm.taux)    as sommeasavoir                                  
                          FROM compmatiere cm , module mo , matiere m
                          WHERE cm.CODE_MAT = m.CODE_MAT
                          and m.CODE_MODU = '$idmodule' 
                          GROUP BY cm.CODE_COMP             
                    ";  

                
                    $result = mysqli_query($ma_connexion, $query); 
                     while(($row = mysqli_fetch_array($result)) == true )  
                          { 
                        
                        
                        $tabhelp2[]  = $row['sommeasavoir'] ;
                        $savecodecomp[]  = $row['CODE_COMP'] ;
                          
                        }
                     

                    for($bn = 0; $bn <= $comptertest; $bn++) {
                      
                      if (array_key_exists($bn, $tabhelp2) && array_key_exists($bn, $tabhelp1))
                      {
                      $vaornew = $tabhelp2[$bn] / (100 * $tabhelp1[$bn]) * 100 ; 
                      $query = "UPDATE compmodule
                      set taux = $vaornew
                      where compmodule.CODE_MODU = '$idmodule' 
                      and compmodule.CODE_COMP = $savecodecomp[$bn] ; " ; 
                        
                      
                      
                      
                      if (mysqli_query($ma_connexion, $query)) {
                          
                
                      } else {
                        echo "Error updating record:  qsdqdqsdqsd" . $bn;
                      }
                      
                      }
                   
                    }

                  } 
                  
                }
              ?>
              </div>




          </div>
              <!-- /.tab-pane -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->


<?php 
      
      
                    
                    
                    // exigence matiere 
                    $query00 = "
                    SELECT m.NOM_MAT , m.VOLUME_HORAIRE_MAT   as vloume 
                    FROM matiere m
                    where m.CODE_MODU = '$idmodule' ;

                    " ;
                            
                    $result = mysqli_query($ma_connexion, $query00);
                     $kkk = 1 ; 
                     $matreturn = null ; 
                     $volumereturn = null ; 
                     
                     
                    if (mysqli_num_rows($result) > 0) {
                      
                      
                      while($row = mysqli_fetch_assoc($result)) {
                        // $i=$row["NOM_MAT"];
                        // $i=explode(" ",$i);
                        // $matreturn = $i[0]; 
                        $matreturn = $row["NOM_MAT"];
                        $volumereturn = $row["vloume"] ; 
                        echo " <input type='hidden' id='mat". $kkk ."' value='". $matreturn ."' /> " ;
                        echo " <input type='hidden' id='mat". $kkk ."v' value='". $volumereturn ."' /> " ;
                        $kkk = $kkk + 1 ; 
                      }
                      
                      
                      
                    } else {
                      
                      echo "erro" ; 
                    }
                    
                    // exigence module 
                    
                    
                    $query00 = "
                    SELECT mo.NOM_MODU ,  mo.VOLUME_HORAIRE_MODU  AS vloume
                      FROM module mo 
                      where mo.CODE_FIL = '$idfil' ; 

                    " ;
                    
                     
                            
                    $result = mysqli_query($ma_connexion, $query00);
                     $kk = 1 ; 
                     $modreturn = null ; 
                     $volumereturn = null ; 
                    if (mysqli_num_rows($result) > 0) {
                      
                      
                      while($row = mysqli_fetch_assoc($result)) {
                        // $i=$row["CODE_MODU"];
                        // $i=explode(" ",$i);
                        // $modreturn = $i[0] ; 
                        $modreturn = $row["NOM_MODU"];
                        $volumereturn = $row["vloume"] ; 
                        echo " <input type='hidden' id='mod". $kk ."' value='". $modreturn ."' /> " ;
                        echo " <input type='hidden' id='mod". $kk ."v' value='". $volumereturn ."' /> " ;
                        $kk = $kk + 1 ; 
                      }
                      
                      
                      
                    } else {
                      
                      echo "erro" ; 
                    }
                    
      
      ?>









    </div>
    </div>
    </div>
    </div>    
    </div></form>     
    </div> 



          


      </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>By DAM</b>
    </div>
    <strong>Copyright &copy; 2017-2018</strong> All rights
    reserved.
  </footer>

  
</div>


  
</div>

</div>			




</script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/indicateurs.js"></script>
<script>
      $(document).ready(function() {
        if (location.hash) {
          $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle]", function(event) {
          location.hash = this.getAttribute("href");
        });
      });
      $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
      });
    
    
            var chart;
      var legend;
      var nb = '<?php echo $kkk ; ?>' ; 

      // var testtab = null ; 
            // var chartData = null ; 
      
      
      
      
      
      
      
      $( document ).ready(function() {
        
      /* pour savoir la taille 
      Object.keys(chartData).length = 2 ; 
      alert(Object.keys(chartData).length);
      */
      
      
       var chartData = [];

      
      var xxxx ;  
      var yyyy ;
      var zzzz ;
      for(var ii = 0; ii < (nb - 1 ) ; ii++)
      {
        xxxx = ii + 1 ; 
        yyyy = "mat"+xxxx ; 
        zzzz = "mat"+xxxx+"v" ; 
        chartData[ii] = {
          "country" :  document.getElementById(yyyy).value , 
          "visits" : document.getElementById(zzzz).value 
        }
        
  
      }
      
      // pour modifier  chartData[0].country = "" ;  
      
      
      
      


            AmCharts.ready(function () {
                  
    
       chart = new AmCharts.AmPieChart();

                // title of the chart
                chart.addTitle("VOLUME DES MATIERE DANS LE MODULE : <<  <?php echo" $module" ; ?>  >> ", 13);

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
         
                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]]</b> ([[percents]]%) </span>";
            
            
        // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv1");
        
        
        
        // 2
        chartData = [];
        
        var nb = '<?php echo $kk ; ?>' ; 
        
        for(var ii = 0; ii < (nb - 1 ) ; ii++)
        {
          xxxx = ii + 1 ; 
          yyyy = "mod"+xxxx ; 
          zzzz = "mod"+xxxx+"v" ; 
          chartData[ii] = {
            "country" :  document.getElementById(yyyy).value , 
            "litres" : document.getElementById(zzzz).value 
          }
        }
        
  
      
      
      
      chart = new AmCharts.AmPieChart();
      chart.addTitle("VOLUME DES MODULES DANS LA FILIERE : <<  <?php echo" $nomfil" ; ?> >> ", 13);
                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
        

                // WRITE
                chart.write("chartdiv2");
        
        
        // 3 
        
        chartData = [{
                "country": "compparmodule1",
                "litres": 301.9,
                "pattern": {
                    "url": "patterns/black/pattern1.png",
                    "width": 4,
                    "height": 4,
                    "color": "#cc0000"
                }
            }, {
                "country": "compparmodule2",
                "litres": 201.1,
                "pattern": {
                    "url": "patterns/black/pattern2.png",
                    "width": 4,
                    "height": 4
                }
            }, {
                "country": "compparmodule3",
                "litres": 165.8,
                "pattern": {
                    "url": "patterns/black/pattern3.png",
                    "width": 4,
                    "height": 4
                }
            }, {
                "country": "compparmodule4",
                "litres": 139.9,
                "pattern": {
                    "url": "patterns/black/pattern4.png",
                    "width": 4,
                    "height": 4
                }
            } , {
                "country": "compparmodule5",
                "litres": 129.9,
                "pattern": {
                    "url": "patterns/black/pattern4.png",
                    "width": 4,
                    "height": 4
                }
            }
            ];
      
      chart = new AmCharts.AmPieChart();
        
        // title of the chart
                chart.addTitle("Existence des compétence par module ", 16);

                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";
                chart.patternField = "pattern";
                chart.outlineColor = "#000000";
                chart.outlineAlpha = 0.6;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";

                var legend = new AmCharts.AmLegend();
                legend.markerBorderColor = "#000000";
                legend.switchType = undefined;
                legend.align = "center";
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv3");
        
        
        
        // 4
        
        chartData = [{
                "country": "comp1",
                "litres": 301.9,
                "pattern": {
                    "url": "patterns/black/pattern1.png",
                    "width": 4,
                    "height": 4,
                    "color": "#cc0000"
                }
            }, {
                "country": "comp2",
                "litres": 201.1,
                "pattern": {
                    "url": "patterns/black/pattern2.png",
                    "width": 4,
                    "height": 4
                }
            }, {
                "country": "comp3",
                "litres": 165.8,
                "pattern": {
                    "url": "patterns/black/pattern3.png",
                    "width": 4,
                    "height": 4
                }
            }, {
                "country": "comp4",
                "litres": 139.9,
                "pattern": {
                    "url": "patterns/black/pattern4.png",
                    "width": 4,
                    "height": 4
                }
            }
            ];
      
      chart = new AmCharts.AmPieChart();
        
        // title of the chart
                chart.addTitle("Existence des compétence par filiere ", 16);

                chart.dataProvider = chartData;
                chart.titleField = "country";
                chart.valueField = "litres";
                chart.patternField = "pattern";
                chart.outlineColor = "#000000";
                chart.outlineAlpha = 0.6;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";

                var legend = new AmCharts.AmLegend();
                legend.markerBorderColor = "#000000";
                legend.switchType = undefined;
                legend.align = "center";
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv4");
      
        
        

            });
      
      
      
            
});
           
        </script>

<script>

$(document).ready(function(){
  
  // Run the init method on document ready:
  chat.init();
  
});

var chat = {
  
  // data holds variables for use in the class:
  
  data : {
    lastID    : 0,
    noActivity  : 0
  },
  
  // Init binds event listeners and sets up timers:
  
  init : function(){
    
    // Using the defaultText jQuery plugin, included at the bottom:
    $('#name').defaultText('nom coordonateur');
    $('#email').defaultText('Email coordonateur');
    
    // Converting the #chatLineHolder div into a jScrollPane,
    // and saving the plugin's API in chat.data:
    
    chat.data.jspAPI = $('#chatLineHolder').jScrollPane({
      verticalDragMinHeight: 12,
      verticalDragMaxHeight: 12
    }).data('jsp');
    
    // We use the working variable to prevent
    // multiple form submissions:
    
    var working = false;
    
    // Logging a person in the chat:
    
    $('#loginForm').submit(function(){
      
      if(working) return false;
      working = true;
      
      // Using our tzPOST wrapper function
      // (defined in the bottom):
      
      $.tzPOST('login',$(this).serialize(),function(r){
        working = false;
        
        if(r.error){
          chat.displayError(r.error);
        }
        else chat.login(r.name,r.gravatar);
      });
      
      return false;
    });
    
    // Submitting a new chat entry:
    
    $('#submitForm').submit(function(){
      
      var text = $('#chatText').val();
      
      if(text.length == 0){
        return false;
      }
      
      if(working) return false;
      working = true;
      
      // Assigning a temporary ID to the chat:
      var tempID = 't'+Math.round(Math.random()*1000000),
        params = {
          id      : tempID,
          author    : chat.data.name,
          gravatar  : chat.data.gravatar,
          text    : text.replace(/</g,'&lt;').replace(/>/g,'&gt;')
        };

      // Using our addChatLine method to add the chat
      // to the screen immediately, without waiting for
      // the AJAX request to complete:
      
      chat.addChatLine($.extend({},params));
      
      // Using our tzPOST wrapper method to send the chat
      // via a POST AJAX request:
      
      $.tzPOST('submitChat',$(this).serialize(),function(r){
        working = false;
        
        $('#chatText').val('');
        $('div.chat-'+tempID).remove();
        
        params['id'] = r.insertID;
        chat.addChatLine($.extend({},params));
      });
      
      return false;
    });
    
    // Logging the user out:
    
    $('a.logoutButton').click(function(){  
      
      $('#chatTopBar > span').fadeOut(function(){
        $(this).remove();
      });
      
      $('#submitForm').fadeOut(function(){
        $('#loginForm').fadeIn();
      });
      
      $.tzPOST('logout');
      
      return false;
    });
    
    // Checking whether the user is already logged (browser refresh)
    
    $.tzGET('checkLogged',function(r){
      if(r.logged){
        chat.login(r.loggedAs.name,r.loggedAs.gravatar);
      }
    });
    
    // Self executing timeout functions
    
    (function getChatsTimeoutFunction(){
      chat.getChats(getChatsTimeoutFunction);
    })();
    
    (function getUsersTimeoutFunction(){
      chat.getUsers(getUsersTimeoutFunction);
    })();
    
  },
  
  // The login method hides displays the
  // user's login data and shows the submit form
  
  login : function(name,gravatar){
    
    chat.data.name = name;
    chat.data.gravatar = gravatar;
    $('#chatTopBar').html(chat.render('loginTopBar',chat.data));
    
    $('#loginForm').fadeOut(function(){
      $('#submitForm').fadeIn();
      $('#chatText').focus();
    });
    
  },
  
  // The render method generates the HTML markup 
  // that is needed by the other methods:
  
  render : function(template,params){
    
    var arr = [];
    switch(template){
      case 'loginTopBar':
        arr = [
        '<span><img src="',params.gravatar,'" width="23" height="23" />',
        '<span class="name">',params.name,
        '</span><a href="" class="logoutButton rounded">Logout</a></span>'];
      break;
      
      case 'chatLine':
        arr = [
          '<div class="chat chat-',params.id,' rounded"><span class="gravatar"><img src="',params.gravatar,
          '" width="23" height="23" onload="this.style.visibility=\'visible\'" />','</span><span class="author">',params.author,
          ':</span><span class="text">',params.text,'</span><span class="time">',params.time,'</span></div>'];
      break;
      
      case 'user':
        arr = [
          '<div class="user" title="',params.name,'"><img src="',
          params.gravatar,'" width="30" height="30" onload="this.style.visibility=\'visible\'" /></div>'
        ];
      break;
    }
    
    // A single array join is faster than
    // multiple concatenations
    
    return arr.join('');
    
  },
  
  // The addChatLine method ads a chat entry to the page
  
  addChatLine : function(params){
    
    // All times are displayed in the user's timezone
    
    var d = new Date();
    if(params.time) {
      
      // PHP returns the time in UTC (GMT). We use it to feed the date
      // object and later output it in the user's timezone. JavaScript
      // internally converts it for us.
      
      d.setUTCHours(params.time.hours,params.time.minutes);
    }
    
    params.time = (d.getHours() < 10 ? '0' : '' ) + d.getHours()+':'+
            (d.getMinutes() < 10 ? '0':'') + d.getMinutes();
    
    var markup = chat.render('chatLine',params),
      exists = $('#chatLineHolder .chat-'+params.id);

    if(exists.length){
      exists.remove();
    }
    
    if(!chat.data.lastID){
      // If this is the first chat, remove the
      // paragraph saying there aren't any:
      
      $('#chatLineHolder p').remove();
    }
    
    // If this isn't a temporary chat:
    if(params.id.toString().charAt(0) != 't'){
      var previous = $('#chatLineHolder .chat-'+(+params.id - 1));
      if(previous.length){
        previous.after(markup);
      }
      else chat.data.jspAPI.getContentPane().append(markup);
    }
    else chat.data.jspAPI.getContentPane().append(markup);
    
    // As we added new content, we need to
    // reinitialise the jScrollPane plugin:
    
    chat.data.jspAPI.reinitialise();
    chat.data.jspAPI.scrollToBottom(true);
    
  },
  
  // This method requests the latest chats
  // (since lastID), and adds them to the page.
  
  getChats : function(callback){
    $.tzGET('getChats',{lastID: chat.data.lastID},function(r){
      
      for(var i=0;i<r.chats.length;i++){
        chat.addChatLine(r.chats[i]);
      }
      
      if(r.chats.length){
        chat.data.noActivity = 0;
        chat.data.lastID = r.chats[i-1].id;
      }
      else{
        // If no chats were received, increment
        // the noActivity counter.
        
        chat.data.noActivity++;
      }
      
      if(!chat.data.lastID){
        chat.data.jspAPI.getContentPane().html('<p class="noChats">No chats yet</p>');
      }
      
      // Setting a timeout for the next request,
      // depending on the chat activity:
      
      var nextRequest = 1000;
      
      // 2 seconds
      if(chat.data.noActivity > 3){
        nextRequest = 2000;
      }
      
      if(chat.data.noActivity > 10){
        nextRequest = 5000;
      }
      
      // 15 seconds
      if(chat.data.noActivity > 20){
        nextRequest = 15000;
      }
    
      setTimeout(callback,nextRequest);
    });
  },
  
  // Requesting a list with all the users.
  
  getUsers : function(callback){
    $.tzGET('getUsers',function(r){
      
      var users = [];
      
      for(var i=0; i< r.users.length;i++){
        if(r.users[i]){
          users.push(chat.render('user',r.users[i]));
        }
      }
      
      var message = '';
      
      if(r.total<1){
        message = 'No one is online';
      }
      else {
        message = r.total+' '+(r.total == 1 ? 'person':'people')+' online';
      }
      
      users.push('<p class="count">'+message+'</p>');
      
      $('#chatUsers').html(users.join(''));
      
      setTimeout(callback,15000);
    });
  },
  
  // This method displays an error message on the top of the page:
  
  displayError : function(msg){
    var elem = $('<div>',{
      id    : 'chatErrorMessage',
      html  : msg
    });
    
    elem.click(function(){
      $(this).fadeOut(function(){
        $(this).remove();
      });
    });
    
    setTimeout(function(){
      elem.click();
    },5000);
    
    elem.hide().appendTo('body').slideDown();
  }
};

// Custom GET & POST wrappers:

$.tzPOST = function(action,data,callback){
  $.post('php/ajax.php?action='+action,data,callback,'json');
}

$.tzGET = function(action,data,callback){
  $.get('php/ajax.php?action='+action,data,callback,'json');
}

// A custom jQuery method for placeholder text:

$.fn.defaultText = function(value){
  
  var element = this.eq(0);
  element.data('defaultText',value);
  
  element.focus(function(){
    if(element.val() == value){
      element.val('').removeClass('defaultText');
    }
  }).blur(function(){
    if(element.val() == '' || element.val() == value){
      element.addClass('defaultText').val(value);
    }
  });
  
  return element.blur();
}




</script>



    <script type="text/javascript">
      $("#validermatiereinfo").click(function() {
        var intervention ='';
        if (document.getElementById("CoursInputCHECK").checked == true )
          intervention = intervention.concat('1/') ; 
        else  
          intervention = intervention.concat('0/') ; 
        
        if (document.getElementById("TDInputCHECK").checked == true )
          intervention = intervention.concat('1/') ; 
        else  
          intervention = intervention.concat('0/') ; 
        
        
        if (document.getElementById("TPInputCHECK").checked == true )
          intervention = intervention.concat('1/') ; 
        else  
          intervention = intervention.concat('0/') ; 
        
        
        if (document.getElementById("EncadrementInputCHECK").checked == true )
          intervention = intervention.concat('1') ; 
        else  
          intervention = intervention.concat('0') ; 
        
        
        var nommat = $("#nommatinput").val();
        
        var volumeglobal = $("#volumeglobalinput").val();
        if(volumeglobal=='')
            volumeglobal = 0 ; 
          
        var volumeCour = $("#volumecoursinput").val();
        if(volumeCour=='')
            volumeCour = 0 ; 
          
        var volumeTP = $("#volumeTPinput").val();
        if(volumeTP=='')
            volumeTP = 0 ; 
          
        var volumeTD = $("#volumeTDinput").val();
        if(volumeTD=='')
            volumeTD = 0 ; 
          
        var volumeAP = $("#volumeAPinput").val();
        if(volumeAP=='')
            volumeAP = 0 ; 
          
        var SpecialiteMat = $("#specialitematinput").val();
      
          
        var typeCour = $("#typeCourinput").val();
          
          
        var idmat = '<?php echo $idmat ; ?>' ; 
        var idmodule = '<?php echo $idmodule ; ?>' ; 
        var enseignant = '<?php echo $rest ; ?>' ; 
        var dataString = 'nommat='+ nommat + '&volumeglobal='+ volumeglobal + '&volumeCour='+ volumeCour + '&volumeTP='+ volumeTP + '&volumeTD='+ volumeTD + '&volumeAP='+ volumeAP + '&idmat='+ idmat + '&idmodule='+ idmodule+ '&SpecialiteMat='+ SpecialiteMat+ '&enseignant='+ enseignant+ '&intervention='+ intervention+ '&typeCour='+ typeCour;
        
        if(nommat=='')

          {
          alert("Enter le nom du matiere ");
          $("#nommatinput").focus();
          }
        else
          {     
            $.ajax({
              type: "POST",
              url: "ajaxvalidermatiere.php",
              data: dataString,
              cache: true,
              success: function(html){
                swal(
                    'MODIFIED!',
                    'LA  MATIERE A BIEN ETE MODIFIE.',
                    'success'
                    )
              $("#nommatinput").prop('readonly', true);
              $("#volumeglobalinput").prop('readonly', true);
              $("#volumecoursinput").prop('readonly', true);
              $("#volumeTPinput").prop('readonly', true);
              $("#volumeTDinput").prop('readonly', true);
              $("#volumeAPinput").prop('readonly', true);
              $("#specialitematinput").prop('readonly', true);
              }  
            });
          }

        return false;
      });
    </script>
    
    


<script type="text/javascript">
      $("#validerdescriptionMatière").click(function() {
        var content = $("#Description_matiere_input").val();          
        var idmat = '<?php echo $idmat ; ?>' ;
        var dataString = 'content='+ content + '&idmat='+ idmat ;
      
        
        if(content=='')

          {
          alert("Enter une description ");
          $("#Description_matiere_input").focus();
          }
        else
          {     
            $.ajax({
              type: "POST",
              url: "ajaxvalidermatiere.php",
              data: dataString,
              cache: true,
              success: function(html){
                swal(
                    'MODIFIED!',
                    'LA  MATIERE A BIEN ETE MODIFIE.',
                    'success'
                    )
              $("#Description_matiere_input").prop('readonly', true);
            
              }  
            });
          }

        return false;
      });
    </script>
    
<script type="text/javascript">
      $("#envoicomment").click(function() {
        var textcontent = $("#commentText").val();
        var idmat = '<?php echo $idmat ; ?>' ; 
        var user = '<?php echo $rest ; ?>' ; 
        var nomrepond = '<?php echo $nom ; echo ' ' ; echo $prenom ;  ?>' ; 
        var taswira = '<?php echo $image_ENS ; ?>' ; 
        
        var dateADD = new Date();
        var dd = dateADD.getDate();
        var mm = dateADD.getMonth()+1; //January is 0!
        var yyyy = dateADD.getFullYear();

        if(dd<10) {
          dd='0'+dd
        } 

        if(mm<10) {
          mm='0'+mm
        } 

        
        var hh = dateADD.getHours();
        var mmm = dateADD.getMinutes(); 
        var sss = dateADD.getSeconds();
        
        if(hh<10) {
          hh='0'+hh
        } 

        if(mmm<10) {
          mmm='0'+mmm
        } 

        if(sss<10) {
          sss='0'+sss
        } 
        
        
        dateADD = yyyy+'-'+mm+'-'+dd;
        
        
        
        
        
        var timeADD = hh+':'+mmm+':'+sss;

        var dataString = 'content='+ textcontent + '&idmat='+ idmat  + '&user='+ user  ;
        if(textcontent=='')

          {
          swal(
              'Oups...',
              'le commentaire ne doit pas etre vide !',
              'error'
            )
          $("#commentText").focus();
          }
        else
          {     
            $.ajax({
              type: "POST",
              url: "envoicomment.php",
              data: dataString,
              cache: true,
              success: function(html){
                swal(
                    'Ajouter!',
                    'LE COMMENTAIRE A BIEN ETE AJOUTER.',
                    'success'
                    )
                    $("#commentText").val('');
                    $('#comments-list').append('<li><div class="comment-main-level"><div class="comment-avatar"><img src="../images/'+taswira+'" alt=""></div><div class="comment-box"><div class="comment-head"><h6 class="comment-name by-author"><a href="http://creaticode.com/blog">'+nomrepond+'</a></h6><span>'+dateADD +' '+ timeADD+'</span><i class="fa fa-reply"></i><i class="fa fa-heart"></i></div><div class="comment-content">'+textcontent+'</div></div></div></li>');
                    
              }

            });
          }
        return false;
      });
    </script>   
    
    
    <script type="text/javascript">
    $("[data-toggle=tooltip]").tooltip();

    
    function fonctionLike( i ,idComment )
    {
      if (document.getElementById("Like_CMT"+i).style.color == "red" )
      {
         $("#Like_CMT"+i).css("color","#a6a6a6");   
      
        
        var user = '<?php echo $rest ; ?>' ; 
        var vallLike = 2 ; 
        var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
        $.ajax({
            type: "POST",
            url: "updateCommentENS.php",
            data: dataString,
            cache: true,
            success: function(html){
    
            }

          });
        
      }
      else{
        $("#Like_CMT"+i).css("color","red");    
        
        
        var user = '<?php echo $rest ; ?>' ; 
        var vallLike = 0 ; 
        var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
        $.ajax({
            type: "POST",
            url: "updateCommentENS.php",
            data: dataString,
            cache: true,
            success: function(html){
    
            }

          });
      }

      

    }
    
    
    </script>
    
    <script type="text/javascript">
    
    
    function fonctionrepondre( i ,idComment )
    {
      
      $.confirm({
        theme: 'dark',
        title: 'Reponse!',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter votre reponce </label>' +
        '<textarea placeholder="votre reponse" class="name form-control" autofocus required rows="5"></textarea>' + 
        '</div>' +
        '</form>',
        buttons: {
          formSubmit: {
            text: 'ajouter',
            btnClass: 'btn-blue',
            action: function () {
                var nomrepond = '<?php echo $nom ; echo ' ' ; echo $prenom ;  ?>' ; 
                var textcontent = this.$content.find('.name').val();
                var user = '<?php echo $rest ; ?>' ; 
                var taswira = '<?php echo $image_ENS ; ?>' ; 
                var dateADD = new Date();
                var dd = dateADD.getDate();
                var mm = dateADD.getMonth()+1; //January is 0!
                var yyyy = dateADD.getFullYear();

                if(dd<10) {
                  dd='0'+dd
                } 

                if(mm<10) {
                  mm='0'+mm
                } 
                
                var hh = dateADD.getHours();
                var mmm = dateADD.getMinutes(); 
                var sss = dateADD.getSeconds();
                
                if(hh<10) {
                  hh='0'+hh
                } 

                if(mmm<10) {
                  mmm='0'+mmm
                } 

                if(sss<10) {
                  sss='0'+sss
                } 
                
                

                dateADD = yyyy+'-'+mm+'-'+dd;

                var timeADD = hh+':'+mmm+':'+sss;

                var dataString = 'idComment='+ idComment + '&user='+ user + '&textcontent='+ textcontent + '&mat=11'  ;
                
                $.ajax({
                    type: "POST",
                    url: "EnvoieReponseComment.php",
                    data: dataString,
                    cache: true,
                    success: function(html){
                      swal(
                        'Ajouter!',
                        'Votre Reponse  A BIEN ETE AJOUTER.',
                        'success'
                        )
                        
                        $("#lesReplays"+i).append('<ul class="comments-list reply-list"><li><div class="comment-avatar"><img src="../images/'+taswira+'" alt=""></div><div class="comment-box"><div class="comment-head"><h6 class="comment-name">'+nomrepond+'</h6><span>'+dateADD +' '+ timeADD+'</span><i class="fa fa-reply"></i><i class="fa fa-heart"></i></div><div class="comment-content">'+textcontent+'</div></div></li></ul> ');
                              
            
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
                              

    }
    
    
    </script>
    

        

</body>
</html>
