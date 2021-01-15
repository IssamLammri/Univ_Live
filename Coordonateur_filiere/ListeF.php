<?php
session_start();
include '../connexion.php';

$idf=$_SESSION['idf'];
$Etat = $_SESSION['NIV'];
$rest = $_SESSION['info'];

$reqq  = ($bd->query('Select  CODE_COR_FIL,IMAGE_COR_FIL,PRENOM_COR_FIL   , NOM_COR_FIL  from coordonateur_filiere  WHERE    CODE_COR_FIL  ="'.$rest.'"'));
$reqq2 = ($bd->query('select  U.NOM_UNIVERSITE , E.NOM_ETA ,   E.CODE_ETA                    from coordonateur_filiere as C  , etablissement as E  , universite as U where  C.CODE_COR_FIL="'.$rest.'" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
$reqq3 = ($bd->query('select NOM_FIL from filiere WHERE CODE_FIL="'.$idf.'" '));
$ress = $reqq->fetch();
$ress1 = $reqq2->fetch();
$ress2 = $reqq3->fetch();
$nom=$ress['NOM_COR_FIL'];
$prenom=$ress['PRENOM_COR_FIL'];
$imagecoord=$ress['IMAGE_COR_FIL'];
$codeCoordonateur=$ress['CODE_COR_FIL'];
$universite =$ress1['NOM_UNIVERSITE'];
$etat=$ress1['NOM_ETA'];
$etatcode=$ress1['CODE_ETA'];
$fil=$ress2['NOM_FIL'];
$req =($bd->query('select NOM_FIL, Date_Debut, Date_fin,NATURE_DIPLOME,SPICIALITE_DIPLOME from filiere where CODE_FIL="'.$idf.'" '));
$ress4 = $req->fetch();
$nomf=$ress4['NOM_FIL'];
$dd=$ress4['Date_Debut'];
$df=$ress4['Date_fin'];
$Nd=$ress4['NATURE_DIPLOME'];
// $Dfil=$ress4['DISCIPLINE_FIL'];
$Sp=$ress4['SPICIALITE_DIPLOME'];

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

$req1="select distinct(NATURE_DIPLOME) from filiere";
$req2="select distinct(DISCIPLINE_FIL) from filiere";
$req3="select distinct(SPICIALITE_DIPLOME) from filiere";

if(isset($_POST['accederModule']))
{ 
  $id_M= $_POST['accederModule'];
  $_SESSION['id_M']=$id_M ;
  $_SESSION['hhh']="hhh" ;
  header('Location:../Coordonateur_module/CordonnateurM.php');
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
  <title>Gestion des filières | Ma Filière</title>
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
  <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">  

    <script src="../js/jquery.knob.min.js"></script>
    <script src="../js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="../css/jquery-confirm.min.css">
  

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

#content {
  background: #fff;
  padding: 2em;
  height: 220px;
  position: relative;
  z-index: 2; 
  border-radius: 0 5px 5px 5px;
  box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5);
}

.comments ul ul {
    margin-left: 60px;
}
.comments .comment img {
    margin-right: 20px;
}
.comments .comment {
    padding: 6px;
}
.comments .comment:hover {
    background: #eee;
}


.shape{	
	border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
	-ms-transform:rotate(360deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(360deg); /* Safari and Chrome */
	transform:rotate(360deg);
}
.offer{
	background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
}
.offer-radius{
	border-radius:7px;
}
.offer-danger {	border-color: #d9534f; }
.offer-danger .shape{
	border-color: transparent #d9534f transparent transparent;
	border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-success {	border-color: #5cb85c; }
.offer-success .shape{
	border-color: transparent #5cb85c transparent transparent;
	border-color: rgba(255,255,255,0) #5cb85c rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-default {	border-color: #999999; }
.offer-default .shape{
	border-color: transparent #999999 transparent transparent;
	border-color: rgba(255,255,255,0) #999999 rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-primary {	border-color: #428bca; }
.offer-primary .shape{
	border-color: transparent #428bca transparent transparent;
	border-color: rgba(255,255,255,0) #428bca rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-info {	border-color: #5bc0de; }
.offer-info .shape{
	border-color: transparent #5bc0de transparent transparent;
	border-color: rgba(255,255,255,0) #5bc0de rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-warning {	border-color: #f0ad4e; }
.offer-warning .shape{
	border-color: transparent #f0ad4e transparent transparent;
	border-color: rgba(255,255,255,0) #f0ad4e rgba(255,255,255,0) rgba(255,255,255,0);
}

.shape-text{
	color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
	-ms-transform:rotate(30deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(30deg); /* Safari and Chrome */
	transform:rotate(30deg);
}	
.offer-content{
	padding:0 20px 10px;
}
.after-box {
  clear: left;
}
	
</style>



</head>
<body class="sidebar-mini wysihtml5-supported skin-blue">
<div class="wrapper">
<script src="../js/classie.js"></script>

<?php
$SQL="select d.NOM_DEPT , d.CODE_DEPT , e.CODE_ETA , e.NOM_ETA , u.CODE_UNIVERSITE , u.NOM_UNIVERSITE
			from  departement d , filiere f , etablissement e , universite u 
			where  d.CODE_DEPT = f.CODE_DEPT
            and d.CODE_ETA = e.CODE_ETA
            and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
			and f.CODE_FIL = '$idf'";
			
		$id_DEPT = null ; 	
		$nom_DEPT = null ;

		$id_ETAB = null ; 
		$nom_ETAB = null ;
		
		$id_UNIV = null ; 
		$nom_UNIV = null ;
			
		$query=mysqli_query($ma_connexion,$SQL);
		while($row=mysqli_fetch_assoc($query))
		{
			$id_DEPT = $row['CODE_DEPT'];
			$nom_DEPT = $row['NOM_DEPT'];
			
			$id_ETAB = $row['CODE_ETA'];
			$nom_ETAB = $row['NOM_ETA'];
			
			$id_UNIV = $row['CODE_UNIVERSITE'];
			$nom_UNIV = $row['NOM_UNIVERSITE'];
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
                    <h5 class="description-header">Université:</h5>
                    <span class="description-text"><?php echo $universite ; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Etablissement:</h5>
                    <span class="description-text"><?php echo $etat ; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Filière:</h5>
                    <span class="description-text"><?php echo $fil ;  ?></span>
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
              <h3 class="box-title">Filière : <?php echo $fil ;  ?> </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h2 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Informations concernant cette filière : 
                      </a>
                    </h2>
                    <br>
                    <br>

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Idenfication" data-toggle="tab">Idenfication</a></li>					    
			    <li><a href="#debouche" data-toggle="tab">Débouches</a></li>
			    <li><a href="#competence" data-toggle="tab">Compétences </a></li>				    
			    <li><a href="#Formation" data-toggle="tab">Formation</a></li>
			    <li><a href="#Effectifs" data-toggle="tab">Effectifs</a></li>
			    <li><a href="#Module" data-toggle="tab">Modules</a></li>
				<li><a href="#PreRequis" data-toggle="tab">Prérequis</a></li>
			    <li><a href="#indicateur" data-toggle="tab">Indicateurs</a></li>
			    
			    <li><a href="#commentaire2" data-toggle="tab" style="margin-right: 10px;">Commentaires</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Idenfication">
                
              	<form class="form-horizontal" action="" method="POST">
                  <div class="form-group">
                            <label for="intituleinput" class="col-sm-3 control-label">Intitulé de la filière</label>
                                <div class="col-sm-6">
                            <input readonly="readonly" list="cookies1" type="text" class="form-control" id="intituleinput" placeholder="Intitulé de la filière" name="intituleinput" value="<?php echo $nomf ; ?>" required>
                                </div>
                                <div class="col-sm-3">
                                	<button id="intituleinputbtnactiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="intituleinputbtnvider" type="button" class="btn btn-default intituleinputbtn"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="universite" class="col-sm-3 control-label">Université</label>
                                <div class="col-sm-6">
                            <select class="form-control" name="universite" id="universite" readonly="true" >
														<?php
													$SQL="select * from universite;";
													$query=mysqli_query($ma_connexion,$SQL);
													while($row=mysqli_fetch_assoc($query))
													{
														if ( $row['CODE_UNIVERSITE'] == $id_UNIV)
														echo ' 
														<option  value="'.$row['CODE_UNIVERSITE'].'" selected>'.$row['NOM_UNIVERSITE'].'</option>
														<';
														else
															echo ' 
														<option  value="'.$row['CODE_UNIVERSITE'].'" >'.$row['NOM_UNIVERSITE'].'</option>
														<';
													}
													?>
												</select>
                                </div>
                                <div class="col-sm-3">
                                	<button id="univActiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="univVider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="etablissment" class="col-sm-3 control-label">Etablissement</label>
                                <div class="col-sm-6">
                                	<select class="form-control" name="etablissment"  id="etablissment"  onchange="getvalChange(this);"readonly="true" >
													<option  value="<?php echo $id_ETAB ; ?>"><?php echo $nom_ETAB ; ?></option>
												</select> 
                                </div>
                                <div class="col-sm-3">
                                	<button id="etablActiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="etablVider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="departementInput" class="col-sm-3 control-label">Département</label>
                                <div class="col-sm-6">
                                	<select class="form-control" name="departementInput"  id="departementInput" readonly="true" >
													<option value="<?php echo $id_DEPT ; ?>" ><?php echo $nom_DEPT ; ?></option>
												</select>
                                </div>
                                <div class="col-sm-3">
                                	<button id="deptActiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="deptVider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="disciplineinput0" class="col-sm-3 control-label">Discipline de la filière</label>
                                <div class="col-sm-6">
                                	<?php
									$ind2 = 0 ;
									$query = " SELECT d.CODE_decipline_FIL , d.decipline_FIL FROM decipline_filiere d  WHERE d.CODE_FIL = '$idf' ";
									$result = mysqli_query($ma_connexion, $query); 
								   while(($row = mysqli_fetch_array($result)) == true )  
									{ 										
										$code = $row['CODE_decipline_FIL'] ;
										$name = $row['decipline_FIL'] ;
														
										echo ' <input readonly="readonly" onkeyup="testImpossibleop(this.value,'.$code.')" type="text" class="form-control" ondblclick="this.readOnly=false"  placeholder="iscipline de la filière" name="disciplineinput'.$ind2.'"  id="disciplineinput'.$code.'" value="'.$name.'" required> ' ;
										echo "<input type='hidden' value='$code' name='d". $ind2 . "' /> ";
										$ind2++ ; 
									}
						            ?>
                                </div>
                                <div class="col-sm-3">
                                	<?php
										if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '<button id="ajouterDiscpline" type="button" class="btn btn-default"><i class="fa fa-plus-square fa-lg"></i></button>										
										<button onclick="deleteDisciplineFil()" type="button" class="btn btn-default"><i class="fa fa-trash fa-lg"></i></button>' ; 
										}
										?>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group" id="deciplines"></div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="diplomeinput" class="col-sm-3 control-label">Diplôme de la filière</label>
                                <div class="col-sm-6">
                                	<select  class="form-control" id="diplomeinput" readonly="readonly" name="diplomeinput"  required >
										
												<?php 
													$SQL="select CODE_TYPE_DIPLOME , NOM_TYPE_DIPLOME  from type_diplome  where CODE_TYPE_DIPLOME != 1 ;";
													$query=mysqli_query($ma_connexion,$SQL);
													while($row=mysqli_fetch_assoc($query))
													{	
															
															$codeDEB = $row['CODE_TYPE_DIPLOME'];
															$libelleDEB = $row['NOM_TYPE_DIPLOME'];
															if($codeDEB == $Nd  )
															{
																echo "<option value='$codeDEB' selected>$libelleDEB</option> " ; 
															}
															else{
																echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
															}
													}
													?> 
											</select>
                                </div>
                                <div class="col-sm-3">
                                	<button id="diplomeinputbtnactiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="diplomeinputbtnvider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline;"><br></div>
                  <div class="form-group">
                            <label for="optioninput0" class="col-sm-3 control-label">Option de la filière</label>
                                <div class="col-sm-6">
                                	<?php
											$ind1 = 0 ;
											$query = " SELECT o.CODE_OPTION_FIL , o.OPTION_FIL FROM option_filiere o  WHERE o.CODE_FIL = '$idf' ";
											$result = mysqli_query($ma_connexion, $query); 
									   
									   
										   while(($row = mysqli_fetch_array($result)) == true )  
											{ 										
												$code = $row['CODE_OPTION_FIL'] ;
												$name = $row['OPTION_FIL'] ;
												echo ' <input onkeyup="testImpossibleop(this.value,'.$code.')"   readonly="readonly" ondblclick="this.readOnly=false" type="text" class="form-control" id="optioninput'.$code.'"  placeholder="Option de la filière" name="optioninput'.$ind1.'" value="'.$name.'" required> ' ;
												echo " <input type='hidden' value='$code' name='o". $ind1 . "' /> ";
												$ind1++; 
											}	
									?>
                                </div>
                                <div class="col-sm-3">
                                	<?php
										if (!isset($_SESSION['TESTcorORbon'])) 
										{
									echo '<button id="ajouterOption" type="button" class="btn btn-default"><i class="fa fa-plus-square fa-lg"></i></button>
										<button onclick="deleteOptionFil()" type="button" class="btn btn-default"><i class="fa fa-trash fa-lg"></i></button>'; 
										}
										?>
                                </div>
                  </div>

                  <div style="display: inline"><br></div>
                  <div class="form-group" id="option"></div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="specialiteinout" class="col-sm-3 control-label">Spécialité</label>
                                <div class="col-sm-6">
                                	<input readonly="readonly" list="cookies5" type="text" class="form-control" id="specialiteinout" placeholder="Spécialité de la filière" name="specialiteinout" value="<?php echo $Sp ; ?>" required>
                                </div>
                                <div class="col-sm-3">
                                	<button id="specialitebtnactiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="specialitebtnvider" type="button" id="specialiteinoutbtn" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
                  <div class="form-group">
                            <label for="Da" class="col-sm-3 control-label">Date d'accréditation proposée</label>
                                <div class="col-sm-6">
                                	<input readonly="readonly" class="form-control" type="date" id="Da" placeholder="Date d'accréditation" name="Da" value="<?php echo $dd ; ?>" required>
                                </div>
                                <div class="col-sm-3">
                                	<button id="Dabtnactiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="Dabtnvider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
                                </div>
                  </div>
                  <div style="display: inline"><br></div>
					<div class="form-group" >
	                        <label for="Dfa" class="col-sm-3 control-label">Date de fin d'accréditation proposée</label>
	                            <div class="col-sm-6">
	                            	<input  readonly="readonly" type="date" class="form-control" id="Dfa" placeholder="Date de fin d'accréditation" name="Dfa" value="<?php echo $df ; ?>" required>
	                            </div>
	                            <div class="col-sm-3">
	                            	<button id="Dfabtnactiver" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
									<button id="Dfabtnvider" type="button" class="btn btn-default"><i class="fa fa-eraser fa-lg"></i></button>
	                            </div>
				    </div>

				    <script>
				  var $j = jQuery.noConflict();
					$j("#Da").datepicker({
						dateFormat: 'yy-mm-dd' 
						}) ;
					
					var $k = jQuery.noConflict();
					$k("#Dfa").datepicker({
						dateFormat: 'yy-mm-dd' 
						}) ;
					</script>          
					<div style="display: inline"><br></div>

					<div class="form-group" >
	                        <label for="Dfa" class="col-sm-3 control-label"></label>
	                            <div class="col-sm-6">
	                            	
	                            	<div class="offer offer-default">
														<div class="shape">
															<div class="shape-text">
																&nbsp;  <i class="fa fa-key" aria-hidden="true"></i>
							
															</div>
														</div>
														<div class="offer-content">
															<h3 class="lead">
																Liste des mots clés
															</h3>
															<p>
        																<?php
                														$query = " SELECT mc.NOM_MOTCLE , mc.CODE_MOTCLE 
                														FROM filiere_motCles fo , mot_cle mc  
                														WHERE fo.CODE_MOTCLE = mc.CODE_MOTCLE
                														AND fo.CODE_FIL = '$idf' ";
                														$result = mysqli_query($ma_connexion, $query); 
                												   
                												   
                													   while(($row = mysqli_fetch_array($result)) == true )  
                														{ 										
                															
                															$name = $row['NOM_MOTCLE'] ;
                															$code = $row['CODE_MOTCLE'] ;
                															echo "<span id='mocletxt$code'> $name , </span> ";
                															 
                														}
        														    ?>
															</p>
														</div>
													</div>



	                            </div>
	                            <div class="col-sm-3">
	                            </div>
				    </div>

				    <div style="display: inline"><br><br></div>

				    <div class="form-group"  style="border-right-style: solid;">
	                        <label for="mot_cle" class="col-sm-3 control-label">Ajouter des mots clés </label>
	                            <div class="col-sm-6">
	                            	<select class="form-control js-example-tags" id="motcle" readonly="readonly" name="motcle[]" multiple style="width:100%;">
        														<?php
              														$query = " SELECT NOM_MOTCLE 
              														FROM  mot_cle 
              														where CODE_MOTCLE NOT IN (
              														SELECT  `CODE_MOTCLE` FROM `filiere_motcles` WHERE `CODE_FIL` = '$idf')
              														 ";
              														$result = mysqli_query($ma_connexion, $query); 
              													   while(($row = mysqli_fetch_array($result)) == true )  
              														{ 										
              															$name = $row['NOM_MOTCLE'] ;
              															echo ' <option value="'.$name.'">'.$name.'</option>' ;	 
              														}
        														?>
														 
												       </select>	
												  <script src="../js/select2.min.js"></script>
												
												  <script>
												  var $j = jQuery.noConflict();
														$j(".js-example-tags").select2({
													  tags: true
													})
													
												
													
												</script>
	                            </div>
	                            <div class="col-sm-3">
	                            	<?php
										if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '<button id="activermotcle"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button>
										<button onclick="deletemotcle()" type="button" class="btn btn-default"><i class="fa fa-trash fa-lg"></i></button>' ; 
										}
										?>
	                            </div>
				    </div>

                  <div class="form-group" >
                    <div class="col-sm-offset-6 col-sm-10">
                      <button type="submit1" class="btn btn-success" style="margin-top: 20px;" name="submit1">Valider</button>
                    </div>
                  </div>
                </form>

              
              <div style="display: inline"><br></div><div style="display: inline"><br></div>
              <div style="display: inline"><br></div><div style="display: inline"><br></div>
              <div style="display: inline"><br></div><div style="display: inline"><br></div>
              </div><!-- /.tab-pane -->

              <div class="tab-pane" id="debouche">
                
              	<form class="form-horizontal" method="POST" onsubmit="functionsumit2()" >
              		<div class="box-body table-responsive no-padding">
							    	<table id="tableau1" class="table table-hover">
							    		<tr>
							    			<th>Débouches</th>						    			
							    			<th>Secteur d'activité </th>						    			
											<th>Modifier</th>
											<th>Supprimer</th>
							    		</tr>

										 <?php
										$inddebouche=0 ; 
										$query001 = "SELECT d.CODE_DEBOUCHE_FOR,d.DEBOUCHE_FOR , d.CODE_DOMAINE
												FROM formation_debouche fd , debouche_formation d 
												where fd.CODE_DEBOUCHE_FOR = d.CODE_DEBOUCHE_FOR
												and fd.CODE_FIL = '$idf' ";	
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$code = $row['CODE_DEBOUCHE_FOR'] ;
												$name = $row['DEBOUCHE_FOR'] ;
												$codeDomaine = $row['CODE_DOMAINE'] ;
												echo ' 
												<tr id="rowdebouche'.$inddebouche.'">
													<td><input type="text" readonly="readonly" class="form-control"  placeholder="Débouche" name="debouvheinput'.$inddebouche.'" id="debouvheinput'.$inddebouche.'" value="'.$name.'"></td>
													<input type="hidden" id="savemylife'.$inddebouche.'" value="'.$code.'" name="deb'. $inddebouche . '" /> 
													
													
													<td> <select readonly="readonly" class="form-control" id="DomaineDeboucheInput'.$inddebouche.'"  name="DomaineDeboucheInput'.$inddebouche.'"> ';
													
													
													$sql= "select CODE_SECTEUR, NOM_SECTEUR from secteur_activite
																	
																	 ";  
																																																	
																																																											
														$query=mysqli_query($ma_connexion,$sql) ;
														if(mysqli_num_rows($query) == 0)
														{
															echo '<option>Aucun resultat</ption>';
														}else{
															while($row = mysqli_fetch_assoc($query))
															{
																$codCord = $row['CODE_SECTEUR']  ; 
																$nomcordM = $row['NOM_SECTEUR']  ; 
																
																
																if ( $codCord == $codeDomaine )
																	echo "<option value='$codCord' selected> $nomcordM     </option> " ;
																else
																	echo "<option value='$codCord' > $nomcordM  </option> " ;
																
															}
														}

													echo '
													</select> </td>
													<td><button id="activerdebouche'.$inddebouche.'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
													<td><button id="supprimerdebouche'.$inddebouche.'" type="button" class="btn btn-default example3"><i class="fa fa-trash fa-lg "></i></button></td>
												</tr> ';
												
												$inddebouche++ ; 
											}
										} else {
											
										} 
										?>									
									</table>
								</div>
									<div id="valindiceincremeDeb" ></div> 
									<div id="lesdelete"></div>

									<?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button type="button" data-toggle="modal" data-target="#ajouterdebouche" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submit2" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              }

					?>


			</form>
		</div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="competence">
                <form class="form-horizontal" method="POST" onsubmit="functionsumit3()">
                	<div class="box-body table-responsive no-padding">
							    	<table id="tableau2" class="table table-hover">
							    		<tr>
							    			<th>Compétences</th>		
											<th>Domaines</th>	
											<th>source</th>	
											<th>Modifier</th>
											<th>Supprimer</th>
							    		</tr>
										
										
										 <?php
										
										
									   
										$indcompetance=0 ; 
										
										$query001 = "SELECT c.COMPETNECE,c.CODE_COMP, c.CODE_DOMAINE, c.source_comp
												FROM competence c , compfiliere cf
												where c.CODE_COMP = cf.CODE_COMP
												and cf.CODE_FIL = '$idf' ";	
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$code = $row['CODE_COMP'] ;
												$name = $row['COMPETNECE'] ;
												$codeDomaine = $row['CODE_DOMAINE'];
												$source_comp = $row['source_comp'];
												echo ' 
												<tr id="rowcompetance'.$indcompetance.'">
													<td><input type="text" readonly="readonly" class="form-control"  placeholder="competance" name="competanceinput'.$indcompetance.'" id="competanceinput'.$indcompetance.'" value="'.$name.'"></td>
													<input type="hidden" id="savemylifecmp'.$indcompetance.'" value="'.$code.'" name="comp'.$indcompetance.'" /> 
													
													<td> <select readonly="readonly" class="form-control" id="DomaineCopetanceInput'.$indcompetance.'"  name="DomaineCopetanceInput'.$indcompetance.'"> ';
													
													
													$sql= "select CODE_DOMAINE, NOM_DOMAINE from domaine
																	
																	 ";  
																																																																																												
														$query=mysqli_query($ma_connexion,$sql) ;
														if(mysqli_num_rows($query) == 0)
														{
															echo '<option>Aucun resultat</ption>';
														}else{
															while($row = mysqli_fetch_assoc($query))
															{
																$codCord = $row['CODE_DOMAINE']  ; 
																$nomcordM = $row['NOM_DOMAINE']  ; 

																if ( $codCord == $codeDomaine )
																	echo "<option value='$codCord' selected> $nomcordM     </option> " ;
																else
																	echo "<option value='$codCord' > $nomcordM  </option> " ;

															}
														}

													echo '
													</select></td>';

					echo '<td><input type="text" readonly="readonly" class="form-control"  placeholder="competance" name="competancesource'.$indcompetance.'" id="competancesource'.$indcompetance.'" value="'.$source_comp.'"></td>
													
													<td><button id="activercompetance'.$indcompetance.'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
													<td><button id="supprimercompetance'.$indcompetance.'" type="button" class="btn btn-default example3"><i class="fa fa-trash fa-lg "></i></button></td>
												</tr> ';
												
												$indcompetance++ ; 
											}
										} else {
											
										} 
																	
											   ?>	
										
  									  										
									</table>
								</div>
								
									<div id="lesdelete2"></div>
									<div id="indicejusquaCOMP" > </div>

									<?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button type="button" data-toggle="modal" data-target="#ajouterCometance" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submit3" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              }

					?>



			</form>


              </div>

              <div class="tab-pane" id="Formation">
                
              	<form class="form-horizontal" method="POST">
								<!--La partie Formation-->
							        <hr>
									 <?php
										$objreq = null; 
										$condreq = null; 
										$accereq = null; 
										
										$query001 = "SELECT f.OBJECTIFS_FORMATION, f.CONDITION_D_ACCEES, f.ACCES_PAR_PASSERELLE
												FROM filiere f 
												where f.CODE_FIL = '$idf' ";	
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$objreq = $row['OBJECTIFS_FORMATION'] ;
												$condreq =$row['CONDITION_D_ACCEES'] ;
												$accereq =$row['ACCES_PAR_PASSERELLE'] ;
											}
										} else {
											
										} 
										
										?>	
							        <div class="form-group">
							            <label for="objectiformation" class="col-sm-4 control-label">Objectif de la formation</label>
										<td><button id="activerobjectif" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td>
											<div class="col-xs-6">
												<textarea class="form-control" rows="3" name="objectiformation" id ="objectiformation" readonly="readonly" style="resize: none;"> <?php echo $objreq ; ?></textarea>
							                </div>	                    
							        </div>
							         <div class="form-group">
							            <label for="conditionacceprerequis" class="col-sm-4 control-label">Procédures de sélection</label>
										 <td><button id="activercondition" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td>
											<div class="col-xs-6">
												<textarea class="form-control" rows="3" name="conditionacceprerequis" id ="conditionacceprerequis" readonly="readonly" style="resize: none;"> <?php echo $condreq ; ?> </textarea>
							                </div>	                    
							        </div>
							         <div class="form-group">
							            <label for="acceepasserelle" class="col-sm-4 control-label">Accès par passrelle</label>
										 <td><button id="activeraccee" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td>
											<div class="col-xs-6">
										<textarea class="form-control" rows="3" name="acceepasserelle" id ="acceepasserelle" readonly="readonly" style="resize: none;"><?php echo $accereq ; ?> </textarea>
							                </div>	                    
							        </div>
									<?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
									          echo '
									  <div class="form-group" >
						            <div class="col-sm-offset-6">
						              <button type="submit" name="submit4" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
						            </div>
						          </div>' ; 	
              							}
										?>
							    </form>
              </div>

              <div class="tab-pane" id="Effectifs">

              	<form class="form-horizontal" method="POST">
								<br>
								
								
								<hr>
								 <!--La partie Effectifs-->
							        <?php
										
										$ideffectif = 0 ; 
										$query001 = "SELECT ef.CODE_EFFECTIF ,ef.EFFECTIF, ef.promotion
												FROM effectifs ef 
												where ef.CODE_FIL = '$idf' ";	
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$code = $row['CODE_EFFECTIF'] ;
												$name =$row['EFFECTIF'] ;
												$promo =$row['promotion'] ;
												
												/*
												hadi pr double click 3La inout twli enable 
												<input type="text" value="asdf" readonly="true" ondblclick="this.readOnly='';">
												*/
												
												
												echo ' 
												
												 <div class="form-group" id="roweffec'.$ideffectif.'"> '; 
												 
												 if ($ideffectif == 0)
													echo ' <label for="promoinput'.$ideffectif.'" class="col-sm-4 control-label">'.$promo.'ère promotion </label> '; 
												else 
													echo ' <label for="promoinput'.$ideffectif.'" class="col-sm-4 control-label">'.$promo.'ème promotion </label> ' ; 
	
													echo ' <td><button id="activereffec'.$ideffectif.'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td>
													       <td><button onclick="createCallback2effec('.$ideffectif.',roweffec'.$ideffectif.')"  type="button" class="btn btn-default"><i class="fa fa-trash fa-lg"></i></button></td>
														<div class="col-xs-4">
															<input readonly="readonly" type="number" class="form-control" id="promoinput'.$ideffectif.'"  name="promoinput'.$ideffectif.'"value="'.$name.'" >
															<input type="hidden" name="savepromoinput'.$ideffectif.'" id="savepromoinput'.$ideffectif.'"value="'.$code.'" >
														</div>	                    
												</div>
												';
												
												$ideffectif++ ; 
											}
										} else {
											
										} 
										
										?>	
									<div id="effectaddpromo"> </div> 
									<div id="lesdelete3"> </div> 
									

										<?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button type="button" id="newpromoddbtn" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submit5" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              }

					?>



							    </form>

              </div>

              <div class="tab-pane" id="Module">

              	<form class="form-horizontal" method="POST"  onsubmit="functionsumit6()">
              		<div class="box-body table-responsive no-padding">
							    	<table id="tableau" class="table table-hover">

										  <tr>
							    			<th>Semèstre</th>
							    			<th>Nom Module</th>
							    			<th>Volume global Module</th>
							    			<th>coordonnateur </th>
							    			
							    			<th>Modifer</th>
											<th>Supprimer</th>
											<th>Acceder</th>

							    		</tr>

										
										 <?php

										$indmodule=0 ; 
										
										$query001 = "SELECT   mo.CODE_MODU, mo.ID_SEMSTRE, mo.NOM_MODU, mo.VOLUME_HORAIRE_MODU 
													FROM module mo
													
													where mo.CODE_FIL =  '$idf'
													order by mo.ID_SEMSTRE , mo.CODE_MODU
													";	
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$code = $row['CODE_MODU'] ;
												$semes = $row['ID_SEMSTRE'] ;
												$modu = $row['NOM_MODU'] ;
												$vol = $row['VOLUME_HORAIRE_MODU'] ;
												
												
												echo ' 				
												<tr id="rowmodule'.$indmodule.'">	
													<td> <select readonly="readonly" class="form-control"   id="semestreinput'.$indmodule.'"  name="semestreinput'.$indmodule.'" > ';
														
														if ( strcmp($semes,"S1") == 0 )
															echo ' <option value="S1" selected> S1 </option>  ' ; 
														else
															echo ' <option value="S1" >S1</option>  ' ; 
														
														if ( strcmp($semes,"S2") == 0 )
															echo ' <option value="S2" selected> S2 </option>  ' ; 
														else
															echo ' <option value="S2" >S2</option>  ' ; 
														
														if ( strcmp($semes,"S3") == 0 )
															echo ' <option value="S3" selected> S3 </option>  ' ; 
														else
															echo ' <option value="S3" >S3</option>  ' ; 
														
														if ( strcmp($semes,"S4") == 0 )
															echo ' <option value="S4" selected> S4 </option>  ' ; 
														else
															echo ' <option value="S4" >S4</option>  ' ; 
														
														
														
														
													
													echo '</select> </td> 
													
													<input type="hidden" id="savemylifmodule'.$indmodule.'" value="'.$code.'" name="savemylifmodule'. $indmodule . '" /> 
													
													
													<td><input readonly="readonly" type="text" class="form-control"   ondblclick="this.readOnly=false"  id="moduleinput'.$indmodule.'"  name="moduleinput'.$indmodule.'"  value="'.$modu.'"  placeholder="Nom Module"></td>
													<td><input readonly="readonly" type="number" class="form-control"  min="80" step="10" max=100" ondblclick="this.readOnly=false"  id="volumeinput'.$indmodule.'"  name="volumeinput'.$indmodule.'"  value="'.$vol.'"  placeholder="Volume global Module"></td> 
													
													<td> <select readonly="readonly" class="form-control" id="cordonateurInput'.$indmodule.'"  name="cordonateurInput'.$indmodule.'" > <option value="null" >  </option>';
													
													
													$sql= "SELECT   CODE_COR_MODU , NOM_COR_MODU , PRENOM_COR_MODU 
																	FROM coordonateur_module 
																	where CODE_DEPT = '$id_DEPT'
																	 ";   
																																																	
															// hadi oblige khasse nzidhaa  <optgroup label="etablissmenet dyal cordonateur">
															
														$query=mysqli_query($ma_connexion,$sql) ;
														if(mysqli_num_rows($query) == 0)
														{
															// echo '<option>Aucun coordonateur</ption>';
														}else{
															while($row = mysqli_fetch_assoc($query))
															{
																$codCord = $row['CODE_COR_MODU']  ; 
																$nomcordM = $row['NOM_COR_MODU']  ; 
																$prenomcordM = $row['PRENOM_COR_MODU']  ; 
																
																echo "<option value='$codCord' > $nomcordM     $prenomcordM </option> " ;

															}
															
															
														}
														
														$sql= "SELECT   CODE_COR_MODU , NOM_COR_MODU , PRENOM_COR_MODU 
																	FROM coordonateur_module 
																	where CODE_COR_MODU = (SELECT CODE_COR_MODU
																							FROM module
																							WHERE CODE_MODU = '$code' ) ;
																	 ";   
																																																	
															// hadi oblige khasse nzidhaa  <optgroup label="etablissmenet dyal cordonateur">
															
														$query=mysqli_query($ma_connexion,$sql) ;
														if(mysqli_num_rows($query) == 0)
														{
															// echo '<option>Aucun coordonateur</ption>';
														}else{
															while($row = mysqli_fetch_assoc($query))
															{
																$codCord = $row['CODE_COR_MODU']  ; 
																$nomcordM = $row['NOM_COR_MODU']  ; 
																$prenomcordM = $row['PRENOM_COR_MODU']  ; 
																
																echo "<option value='$codCord' SELECTED> $nomcordM     $prenomcordM </option> " ;

															}
															
															
														}
															
													
													
													
													
													echo '
													</select> </td> 
													
													<td><button id="activermodule'.$indmodule.'"   onclick="activerinputmodule('.$indmodule.')" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
													<td><button id="supprimermodule'.$indmodule.'" onclick="supprimerinputmodule('.$indmodule.',rowmodule'.$indmodule.')" type="button" class="btn btn-default example3"><i class="fa fa-trash fa-lg "></i></button></td>
													<td><button id="accederModule'.$indmodule.'" type="submit" name="accederModule" value="'.$code.'" type="button" class="btn btn-default example3"><i class="fa fa-chevron-circle-right fa-lg "></i></button></td>
												</tr> 	

												';
												
												$indmodule++ ; 
											}
										} else {
											
										} 
																	
									
										   
										
											   ?>	
							
									</table>
								</div>
                <div id="valindiceincreme"> </div>
										<?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button type="button" data-toggle="modal" data-target="#ajouterModule" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submit6" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              }

					?>
					<div id="lesdelete4"></div>
					</form>
              </div>

              <div class="tab-pane" id="PreRequis">

              	<form class="form-horizontal" method="POST">
								<br>
								
								
								<hr>
								<fieldset id="LES_DIPLOMES" >
									<legend> LES DIPLOMES </legend>
									
									 <div class="col-sm-3">
											<center>
												<button type="button" data-toggle="modal" data-target="#ajouterDiplomeandPrerequis" class="btn btn-default btn-circle" style="width: 80px;height: 80px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
											</center>
							        </div>
									<input type="hidden" value="0" id="indjusquaDipl" name="indjusquaDipl">
									
									<div class="col-sm-6">
								 <!--La partie Effectifs-->
							        <?php
										
										$idDiplomes = 0 ;
												
										$query001 = "SELECT d.CODE_DIPLOME , d.TYPE, d.NOM_DIPLOME
												FROM filiere_diplomes fd , diplomes d 
												where d.CODE_DIPLOME = fd.CODE_DIPLOME
												and fd.CODE_FIL = '$idf' ";
												
										$result = mysqli_query($ma_connexion, $query001);
															
										if (mysqli_num_rows($result) > 0) {
											
											while($row = mysqli_fetch_assoc($result)) {
												$code = $row['CODE_DIPLOME'] ;
												$type =$row['TYPE'] ;
												$name =$row['NOM_DIPLOME'] ;
												
												$justforlegend = $idDiplomes + 1 ; 
												
												
											echo ' <div class="form-group" id="rowDiplome'.$idDiplomes.'"> '; 
												 
												 
												// echo ' <label for="" class="col-sm-4 control-label"> Diplome '.$justforlegend .' </label> ' ; 
												echo 'Diplome '.$justforlegend .' </label> ' ; 
	
													// echo ' <td><button id="activerPrerequis'.$idDiplomes.'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td> ' ; 
														
													echo '
															<select readonly="readonly" class="form-control"   id="TYPEdiplomeInput'.$idDiplomes.'"  name="TYPEdiplomeInput'.$idDiplomes.'" > 
														
														';
												 
												$SQL="select CODE_TYPE_DIPLOME , NOM_TYPE_DIPLOME
														from  type_diplome "
														;
														
												 	
													$query=mysqli_query($ma_connexion,$SQL);
													while($row=mysqli_fetch_assoc($query))
													{
														$id_TYPE = $row['CODE_TYPE_DIPLOME'];
														$nom_TYPE = $row['NOM_TYPE_DIPLOME'];
														
														if ( $id_TYPE == $type)
															echo "<option value='$id_TYPE' selected> $nom_TYPE     </option> " ;
														else
															echo "<option value='$id_TYPE' > $nom_TYPE  </option> " ;
													
													}
												
												
												
													echo '  </select>   
														
															<input readonly="readonly" type="text" class="form-control" id="DiplomeInputprerequis'.$idPrerequis.'"  name="DiplomeInputprerequis'.$idPrerequis.'" value="'.$name.'" >
															<input type="hidden" name="saveDiplomeinputprereq'.$idPrerequis.'" id="saveDiplomeinputprereq'.$idPrerequis.'"value="'.$code.'" >
															 
												
													                    
											</div>
											';
												
												$idDiplomes++ ; 
											}
										} else {
											
										} 
										
										?>	
									
									
										<div id="DiplomeAddDiploms"> </div> 
									<div id="lesdelete10"> </div> 
									</div>
									
									<div class="col-sm-3">
											<center>
												<button type="button"  data-toggle="modal" data-target="#ajouterDiplomeandPrerequis" class="btn btn-default btn-circle" style="width: 80px;height: 80px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;"><i class="fa fa-pencil-square-o" style="color:#a09595;"></i></button>
											</center>
							        </div>
									
									
								</fieldset>
								
								<br>
							        <?php
									if (!isset($_SESSION['TESTcorORbon'])) 
										{
									          echo '
									  <div class="form-group" >
						            <div class="col-sm-offset-6">
						              <button type="submit" name="submit7" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
						            </div>
						          </div>' ; 	
              							}
										?>
								
							    </form>



                
              </div>

              <div class="tab-pane" id="indicateur">

              	<br>	
								<div class="panel panel-default">
									<div class="panel-heading">
										Volume horaire des semstres par filiere 
									</div>
									<div class="panel-body" style="background-color: #e9e6da;">
										<div id="chartdiv1" style="width: 100%; height:600px;"></div> 
										
									</div>
								</div>
								
								
								
								
							<div class="panel panel-default">
								<div class="panel-heading">
									Volume horaire des modules par semestre 
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
										<li class="active"><a href="#sem1" data-toggle="tab" aria-expanded="true">semestre 1</a>
										</li>
										<li class=""><a href="#sem2" data-toggle="tab" aria-expanded="false">semestre 2 </a>
										</li>
										<li class=""><a href="#sem3" data-toggle="tab" aria-expanded="false">semestre 3</a>
										</li>
										<li class=""><a href="#sem4" data-toggle="tab" aria-expanded="false">semestre 4</a>
										</li>
									</ul>

									<div class="tab-content">
										<div class="tab-pane fade active in" id="sem1"  style="background-color: #e9e6da;">
											<div id="chartdiv2" style="width: 100%; height:600px;"  backgroundColor="#FFFFFF"></div> 
										</div>
										<div class="tab-pane fade" id="sem2"  style="background-color: #e9e6da;">
											<div id="chartdiv3" style="width: 100%; height:600px;"  backgroundColor="#FFFFFF"></div> 
										</div>
										<div class="tab-pane fade" id="sem3"  style="background-color: #e9e6da;" >
											<div id="chartdiv4" style="width: 100%; height:600px;"  backgroundColor="#FFFFFF"></div> 
										</div>
										<div class="tab-pane fade" id="sem4"  style="background-color: #e9e6da;">
											<div id="chartdiv5" style="width: 100%; height:600px;"  backgroundColor="#FFFFFF"></div> 
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									Volume horaire des matières ( de base ,  transversale, de spécialité ) par semestre
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
										<li class="active"><a href="#sem_mat1" data-toggle="tab" aria-expanded="true">semestre 1</a>
										</li>
										<li class=""><a href="#sem_mat2" data-toggle="tab" aria-expanded="false">semestre 2 </a>
										</li>
										<li class=""><a href="#sem_mat3" data-toggle="tab" aria-expanded="false">semestre 3</a>
										</li>
										<li class=""><a href="#sem_mat4" data-toggle="tab" aria-expanded="false">semestre 4</a>
										</li>
									</ul>

									<div class="tab-content">
										<div class="tab-pane fade active in" id="sem_mat1"  style="background-color: #e9e6da;">
											<div id="chartdiv6" style="width: 100%; height:600px;" ></div> 
										</div>
										<div class="tab-pane fade" id="sem_mat2"  style="background-color: #e9e6da;">
											<div id="chartdiv7" style="width: 100%; height:600px;" ></div> 
										</div>
										<div class="tab-pane fade" id="sem_mat3"  style="background-color: #e9e6da;" >
											<div id="chartdiv8" style="width: 100%; height:600px;" ></div> 
										</div>
										<div class="tab-pane fade" id="sem_mat4"  style="background-color: #e9e6da;">
											<div id="chartdiv9" style="width: 100%; height:600px;"  ></div> 
										</div>
									</div>
								</div>
							</div>



              </div>

                <?php 
      

                    // volume total par filiere  
                    
                     $kkk = 1 ; 
                    for ($indSe = 1 ; $indSe <= 4 ; $indSe++)
                    {
                      $seActive = 'S'.$indSe ; 
                      $query00 = "
                      SELECT SUM(m.VOLUME_HORAIRE_MODU)  as vloume
                      from module m 
                      where m.ID_SEMSTRE = '$seActive'
                      and m.CODE_FIL = '$idf' ;

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $matreturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          
                          $volumereturn = $row["vloume"] ; 
                          echo " <input type='hidden' id='mat". $kkk ."' value='Semestre ". $indSe ."' /> " ;
                          echo " <input type='hidden' id='mat". $kkk ."v' value='". $volumereturn ."' /> " ;
                          $kkk = $kkk + 1 ; 
                        }
                        
                        
                        
                      } else {
                        
                        echo "erro" ; 
                      }
                    
                    }
                    
                    // Volume des module par semestre 
                    
                      //S1

                    $kkksem1 = 1 ; 
                    $seActive = 'S1' ; 
                    
                       
                      $query00 = "
                      SELECT m.NOM_MODU , m.VOLUME_HORAIRE_MODU   as vloume
                      FROM module m 
                      WHERE m.ID_SEMSTRE = '$seActive'
                      and m.CODE_FIL = '$idf' ;

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          
                          $modReturn = $row["NOM_MODU"] ; 
                          $volumereturn = $row["vloume"] ; 
                          
                          echo ' <input type="hidden" id="matsem1'.$kkksem1.'" value="'.$modReturn.'" /> ' ;
                          echo " <input type='hidden' id='matsem1". $kkksem1 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem1 = $kkksem1 + 1 ; 
                        }
                        
                        
                        
                      } 
                                        
                    //S2

                    $kkksem2 = 1 ; 
                    $seActive = 'S2' ; 
                    
                       
                      $query00 = "
                      SELECT m.NOM_MODU , m.VOLUME_HORAIRE_MODU   as vloume
                      FROM module m 
                      WHERE m.ID_SEMSTRE = '$seActive'
                      and m.CODE_FIL = '$idf' ;

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          
                          $modReturn = $row["NOM_MODU"] ; 
                          $volumereturn = $row["vloume"] ; 
                          echo ' <input type="hidden" id="matsem2'.$kkksem2.'" value="'.$modReturn.'" /> ' ;
                          echo " <input type='hidden' id='matsem2". $kkksem2 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem2 = $kkksem2 + 1 ; 
                        }
                        
                        
                        
                      } 
                      
                      //S3

                    $kkksem3 = 1 ; 
                    $seActive = 'S3' ; 
                    
                       
                      $query00 = "
                      SELECT m.NOM_MODU , m.VOLUME_HORAIRE_MODU   as vloume
                      FROM module m 
                      WHERE m.ID_SEMSTRE = '$seActive'
                      and m.CODE_FIL = '$idf' ;

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          
                          $modReturn = $row["NOM_MODU"] ; 
                          $volumereturn = $row["vloume"] ; 
                          echo ' <input type="hidden" id="matsem3'.$kkksem3.'" value="'.$modReturn.'" /> ' ;
                          echo " <input type='hidden' id='matsem3". $kkksem3 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem3 = $kkksem3 + 1 ; 
                        }
                        
                        
                        
                      } 
                      
                      
                      
                      //S4

                    $kkksem4 = 1 ; 
                    $seActive = 'S4' ; 
                    
                       
                      $query00 = "
                      SELECT m.NOM_MODU , m.VOLUME_HORAIRE_MODU   as vloume
                      FROM module m 
                      WHERE m.ID_SEMSTRE = '$seActive'
                      and m.CODE_FIL = '$idf' ;

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          
                          $modReturn = $row["NOM_MODU"] ; 
                          $volumereturn = $row["vloume"] ; 
                          echo ' <input type="hidden" id="matsem4'.$kkksem4.'" value="'.$modReturn.'" /> ' ;
                          echo " <input type='hidden' id='matsem4". $kkksem4 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem4 = $kkksem4 + 1 ; 
                        }
                        
                        
                        
                      } 
                      
                            
                    // Volume des matieres ( transversale, de base , de specialite ) par semestre 
                    
                    //S1

                    $kkksem_mat1 = 1 ; 
                    $seActive = 'S1' ; 
                    
                    for ($ind_mat_cha = 0 ; $ind_mat_cha <= 2 ; $ind_mat_cha++)
                    {
                       
                      $query00 = "
                      SELECT SUM(m.VOLUME_HORAIRE_MAT)   as vloume
                      FROM matiere m , module mo 
                      where m.type_cour = $ind_mat_cha 
                      and m.CODE_MODU = mo.CODE_MODU
                      and mo.ID_SEMSTRE = '$seActive'
                      and mo.CODE_FIL =  '$idf'

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          $volumereturn = $row["vloume"] ;
                          
                          if ($ind_mat_cha == 0 ) 
                            echo " <input type='hidden' id='matsem_mat1". $kkksem_mat1 ."' value='matieres transversales' /> " ;
                          else if ($ind_mat_cha == 1 ) 
                            echo " <input type='hidden' id='matsem_mat1". $kkksem_mat1 ."' value='matieres de base' /> " ;
                          else 
                            echo " <input type='hidden' id='matsem_mat1". $kkksem_mat1 ."' value='matieres de specialite' /> " ;
                          
                          echo " <input type='hidden' id='matsem_mat1". $kkksem_mat1 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem_mat1 = $kkksem_mat1 + 1 ; 
                        }
                        
                        
                        
                      } 
                    }
                    
                    //S2

                    $kkksem_mat2 = 1 ; 
                    $seActive = 'S2' ; 
                    
                    for ($ind_mat_cha = 0 ; $ind_mat_cha <= 2 ; $ind_mat_cha++)
                    {
                       
                      $query00 = "
                      SELECT SUM(m.VOLUME_HORAIRE_MAT)   as vloume
                      FROM matiere m , module mo 
                      where m.type_cour = $ind_mat_cha 
                      and m.CODE_MODU = mo.CODE_MODU
                      and mo.ID_SEMSTRE = '$seActive'
                      and mo.CODE_FIL =  '$idf'

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          $volumereturn = $row["vloume"] ;
                          
                          if ($ind_mat_cha == 0 ) 
                            echo " <input type='hidden' id='matsem_mat2". $kkksem_mat2 ."' value='matieres transversales' /> " ;
                          else if ($ind_mat_cha == 1 ) 
                            echo " <input type='hidden' id='matsem_mat2". $kkksem_mat2 ."' value='matieres de base' /> " ;
                          else 
                            echo " <input type='hidden' id='matsem_mat2". $kkksem_mat2 ."' value='matieres de specialite' /> " ;
                          
                          echo " <input type='hidden' id='matsem_mat2". $kkksem_mat2 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem_mat2 = $kkksem_mat2 + 1 ; 
                        }
                        
                        
                        
                      } 
                    }
                    
                    
                    //S3

                    $kkksem_mat3 = 1 ; 
                    $seActive = 'S3' ; 
                    
                    for ($ind_mat_cha = 0 ; $ind_mat_cha <= 2 ; $ind_mat_cha++)
                    {
                       
                      $query00 = "
                      SELECT SUM(m.VOLUME_HORAIRE_MAT)  as vloume
                      FROM matiere m , module mo 
                      where m.type_cour = $ind_mat_cha 
                      and m.CODE_MODU = mo.CODE_MODU
                      and mo.ID_SEMSTRE = '$seActive'
                      and mo.CODE_FIL =  '$idf'

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          $volumereturn = $row["vloume"] ;
                          
                          if ($ind_mat_cha == 0 ) 
                            echo " <input type='hidden' id='matsem_mat3". $kkksem_mat3 ."' value='matieres transversales' /> " ;
                          else if ($ind_mat_cha == 1 ) 
                            echo " <input type='hidden' id='matsem_mat3". $kkksem_mat3 ."' value='matieres de base' /> " ;
                          else 
                            echo " <input type='hidden' id='matsem_mat3". $kkksem_mat3 ."' value='matieres de specialite' /> " ;
                          
                          echo " <input type='hidden' id='matsem_mat3". $kkksem_mat3 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem_mat3 = $kkksem_mat3 + 1 ; 
                        }
                        
                        
                        
                      } 
                    }
                    
                    
                    
                    //S4

                    $kkksem_mat4 = 1 ; 
                    $seActive = 'S4' ; 
                    
                    for ($ind_mat_cha = 0 ; $ind_mat_cha <= 2 ; $ind_mat_cha++)
                    {
                       
                      $query00 = "
                      SELECT SUM(m.VOLUME_HORAIRE_MAT)   as vloume
                      FROM matiere m , module mo 
                      where m.type_cour = $ind_mat_cha 
                      and m.CODE_MODU = mo.CODE_MODU
                      and mo.ID_SEMSTRE = '$seActive'
                      and mo.CODE_FIL =  '$idf'

                      " ;
                              
                      $result = mysqli_query($ma_connexion, $query00);
                      
                       $modReturn = null ; 
                       $volumereturn = null ; 
                       
                       
                      if (mysqli_num_rows($result) > 0) {
                        
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          $volumereturn = $row["vloume"] ;
                          
                          if ($ind_mat_cha == 0 ) 
                            echo " <input type='hidden' id='matsem_mat4". $kkksem_mat4 ."' value='matieres transversales' /> " ;
                          else if ($ind_mat_cha == 1 ) 
                            echo " <input type='hidden' id='matsem_mat4". $kkksem_mat4 ."' value='matieres de base' /> " ;
                          else 
                            echo " <input type='hidden' id='matsem_mat4". $kkksem_mat4 ."' value='matieres de specialite' /> " ;
                          
                          echo " <input type='hidden' id='matsem_mat4". $kkksem_mat4 ."v' value='". $volumereturn ."' /> " ;
                          $kkksem_mat4 = $kkksem_mat4 + 1 ; 
                        }
                      } 
                    }
      
                ?>

              <div class="tab-pane" id="commentaire2">

              	<div class="row">
										<div class="col-md-12">
										  <div class="panel panel-info" style="background-color: #f0f0f0;" >
											
											<div class="panel-body comments">
											  <textarea class="form-control" style="resize: none;" id="commentText" placeholder="votre commentaire..." rows="5"></textarea>
											  <br>
											  
											  <button type="button"  id="envoicomment" class="btn btn-info pull-right">Envoyer Le commentaire</button>
											  <div class="clearfix"></div>
											  <hr style="border-style: groove;bo: ;">
											  
											  
											  
											  <ul class="media-list" id="lesscommments">
											  
											   <?php

													$idcomment = 0 ; 	 
																							
													$query001 = "SELECT *
															FROM commentaiire c 
															where c.CODE_FIL = '$idf'
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
															
															$likes = 0  ; 
															$dislikes = 0 ; 
															
															
															$sql = " SELECT COUNT(code_comment) as Likes
															FROM commentlikedislike
															WHERE code_comment = '$code' 
															AND INDICE = 0  ";
															$result = mysqli_query($ma_connexion, $sql);

															if (mysqli_num_rows($result) > 0) {
																// output data of each row
																while($row = mysqli_fetch_assoc($result)) {
																	$likes  = $row["Likes"] ;
																}
															}
															
															
															$sql = " SELECT COUNT(code_comment) as DisLikes 
															FROM commentlikedislike
															WHERE code_comment = '$code' 
															AND INDICE = 1  ";
															$result = mysqli_query($ma_connexion, $sql);

															if (mysqli_num_rows($result) > 0) {
																// output data of each row
																while($row = mysqli_fetch_assoc($result)) {
																	$dislikes  = $row["DisLikes"] ;
																}
															}
															
															$indColorLIKE =  0; 
															
															$sql = " SELECT code_comment
																	FROM commentlikedislike
																	WHERE code_comment = $code
																	and UDER = $IDUSER
																	and TYPE = 'CORDFIL'
																	and INDICE = 0 ;  ";
															$result = mysqli_query($ma_connexion, $sql);

															if (mysqli_num_rows($result) > 0) {
																
																while($row = mysqli_fetch_assoc($result)) {
																	$indColorLIKE = 1 ; 
																}
															}
															else{
																
															}
															
															$indColorDISLIKE =  0; 
															
															$sql = " SELECT code_comment
																	FROM commentlikedislike
																	WHERE code_comment = $code
																	and UDER = $IDUSER
																	and TYPE = 'CORDFIL'
																	and INDICE = 1 ;  ";
															$result = mysqli_query($ma_connexion, $sql);

															if (mysqli_num_rows($result) > 0) {
																
																while($row = mysqli_fetch_assoc($result)) {
																	$indColorDISLIKE = 1 ; 
																}
															}
															else{
																
															}
															
															$LiDaroLike = ''; 
															
															$sql = "  SELECT ens.NOM_COR_FIL , ens.PRENOM_COR_FIL
																FROM commentlikedislike cml , coordonateur_filiere ens 
																where ens.CODE_COR_FIL = cml.UDER
																and cml.TYPE = 'CORDFIL'
																and cml.code_comment = $code 
																and cml.INDICE = 0 
                                                                  ";
															$result = mysqli_query($ma_connexion, $sql);

															if (mysqli_num_rows($result) > 0) {
																
																while($row = mysqli_fetch_assoc($result)) {
																	$nom_LIKET = $row["NOM_COR_FIL"] ;
																	$prenom_LIKET = $row["PRENOM_COR_FIL"] ;
																	
																	$LiDaroLike .= "$nom_LIKET   $prenom_LIKET  <br>  " ; 
																	
																}
															}
															
															
																
															
															
															
															if ( $typeUSER == "CORDFIL")
															{
																$query002 = "SELECT NOM_COR_FIL , PRENOM_COR_FIL , IMAGE_COR_FIL
																FROM coordonateur_filiere 
																WHERE CODE_COR_FIL = $IDUSER ";
																
															
																$result002 = mysqli_query($ma_connexion, $query002);
																				
																if (mysqli_num_rows($result002) > 0) 
																{
																
																 while($row002 = mysqli_fetch_assoc($result002)) 
																 {
																	
																	$nom_r = $row002['NOM_COR_FIL'] ;
																	$prenom_r = $row002['PRENOM_COR_FIL'] ;
																	$image = $row002['IMAGE_COR_FIL'] ;
																	
																	
																	
																	echo '	
																	<li class="media">
															  
																	  <div class="comment">
																		<a href="#" class="pull-left">
																		<img src="../images/'.$image .'" alt=""   class="img-circle" style="width: 60;width: 65px;height: 65px;">
																		</a>
																		<div class="media-body">
																		  <strong class="text-success">'.$nom_r .''. $prenom_r  .'</strong> 
																		  <div style="float: right;" >  ' ; 
																		  if ($indColorLIKE == 0)	
																			{
																				echo '<span id="lesLikes'.$idcomment.'" >'.$likes.' </span>  &nbsp;  <i class="fa fa-thumbs-up" aria-hidden="true" id="jaimme'.$idcomment.'" onclick="fonctionjame('.$idcomment.','.$likes.','.$code .')" style="cursor: pointer;"  > J\'aime  </i>  &nbsp; &nbsp; &nbsp;';

																			}
																			else	
																			{
																				echo '<span id="lesLikes'.$idcomment.'" >'.$likes.' </span>  &nbsp;  <i class="fa fa-thumbs-up" aria-hidden="true" id="jaimme'.$idcomment.'" onclick="fonctionjame('.$idcomment.','.$likes.','.$code .')" style="cursor: pointer; color: red;"  > J\'aime  </i>  &nbsp; &nbsp; &nbsp;';
																			}
																			
																			if ($indColorDISLIKE == 0)	
																			{
																				echo '<span id="lesDisLikes'.$idcomment.'" >'.$dislikes.' </span>  &nbsp;  <i class="fa fa-thumbs-down" aria-hidden="true" id="neJaimePas'.$idcomment.'" onclick="fonctionNojame('.$idcomment.','.$dislikes.','.$code .')" style="cursor: pointer;"  > je n\'aime pas  </i>  &nbsp; &nbsp; &nbsp;';

																			}
																			else	
																			{
																				echo '<span id="lesDisLikes'.$idcomment.'" >'.$dislikes.' </span>  &nbsp;  <i class="fa fa-thumbs-down" aria-hidden="true" id="neJaimePas'.$idcomment.'" onclick="fonctionNojame('.$idcomment.','.$dislikes.','.$code .')" style="cursor: pointer; color: #93a46dcc;"  > je n\'aime pas  </i>  &nbsp; &nbsp; &nbsp;';
																			}
																			
																		  
																			echo '
																			<i class="fa fa-commenting" aria-hidden="true" id="repondre'.$idcomment.'" onclick="fonctionrepondre('.$idcomment.','.$code.')" style="cursor: pointer;"  >  Repondre </i>
																		  </div>

																		  <span class="text-muted">
																		  <small class="text-muted">'.$date_comme.'  '.$time_comment.'</small>
																		  </span>
																		  <p style=" text-align: justify;">
																			'.$comment.'
																		  </p>
																		</div>
																		<div class="clearfix"></div>
																	  </div>
																	  
																	 
																	</li> '; 
																	
																	echo '<ul class="media-list" id="lesReplays'.$idcomment.'" > ' ; 
																	
																	
																	
																	
																	
																	
																	$query003 = "SELECT *
																			FROM commentaiirereply c 
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
																			

																		if ( $typeUSERrep == "CORDFIL")
																		{
																				$query004 = "SELECT NOM_COR_FIL , PRENOM_COR_FIL , IMAGE_COR_FIL
																				FROM coordonateur_filiere 
																				WHERE CODE_COR_FIL = $IDUSERrep
																			";	
																			
																			$result004 = mysqli_query($ma_connexion, $query004);
																								
																			if (mysqli_num_rows($result004) > 0) 
																			{
																				
																				while($row004 = mysqli_fetch_assoc($result004)) 
																				{
																					$nomrep = $row004['NOM_COR_FIL'] ;
																					$prenomrep= $row004['PRENOM_COR_FIL'] ;
																					$imagerep= $row004['IMAGE_COR_FIL'] ;
																					
																					
																	
																		
																					echo ' 
																						
																							<li class="media">
																							  <div class="comment">
																								<a href="#" class="pull-left">
																									<img src="../images/'.$imagerep .'" alt="" class="img-circle" style="width: 60;width: 65px;height: 65px;">
																								</a>
																								<div class="media-body">
																								  <strong class="text-success">'.$nomrep.''.$prenomrep.'</strong>
																								  <span class="text-muted">
																								  <small class="text-muted">'.$date_commerep.'  '.$time_commentrep.'</small>
																								  </span>
																								  <p style=" text-align: justify;">
																									'.$commentrep.'
																								  </p>
																								</div>
																								<div class="clearfix"></div>
																							  </div>
																							</li>	';												
																						  
																				} 
																			}
																			 
																		 }
																		}
																	 }
																		
																	echo '</ul> ';
																	$idcomment++;
																		
																 }
																
																	
																	
																	
																	
																}
															}
															// si ola makanch cordonateur 

															
														}
													}
													
													?>
												
												
																								
											  </ul>
											</div>
										  </div>
										</div>
									  </div>
									




                
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
      <b>By DAL</b>
    </div>
    <strong>Copyright &copy; 2017-2018</strong> All rights
    reserved.
  </footer>

  
</div>

<div class="modal fade" id="supprimerOption" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">SUPPRIMER OPTIONS FILIERES </h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						
						
							<label>LES OPTIONS DE LA FILIERE </label>
							<select class="form-control" name='supprimerOptionList' id="supprimerOptionList" multiple> 
							
							</select> 
						
						</div>
						
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="supprimerOptionMethod()" class="btn btn-danger">Supprimer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  <script>
		  
		   function supprimerOptionMethod(  ){	
		   
		   var option_selected="";
		    $('#supprimerOptionList option').each(function () {
				var isselected = $(this).is("option:selected");
				if (isselected) 
				{
					option_selected=option_selected+" "+$(this).val();
					$("#optioninput"+$(this).val()).remove();
					
				}
			});
			
			var dataString = 'lesID=' + option_selected ; 
			
			$.ajax({
				type: "POST",
				url: "supprimerOotion_DISP.php",
				data: dataString,
				cache: true,
				success: function(html){
					swal(
							'SUPPRIMER!',
							'LES OPTIONS SELECTIONNEES ONT  BIEN ETES SUPPRIMEES.',
							'success'
						  )
					$("#supprimerOption").modal("hide");
					
					}

					
				});
		   }
		   
		   
		   
				
					
		</script>
		
		</div>
  </div> 
  
  
  <div class="modal fade" id="supprimerDecipline" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">SUPPRIMER DECIPLINE FILIERES </h4>
			</div>
			<div class="modal-body">
				 
						
							<label>LES DECIPLINE DE LA FILIERE </label>
							<select class="form-control" name='supprimerDeciplineList' id="supprimerDeciplineList" multiple> 
								
							
							</select> 
						
						
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="supprimerDEciplineMethod()" class="btn btn-danger">Supprimer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  <script>
		  
		   function supprimerDEciplineMethod(  ){	
		   
		   var option_selectedd="";
		    $('#supprimerDeciplineList option').each(function () {
				var isselected = $(this).is("option:selected");
				if (isselected) 
				{
					option_selectedd=option_selectedd+" "+$(this).val();
					
					$("#disciplineinput"+$(this).val()).remove();
				}
			});
			
			var dataString = 'lesIDi=' + option_selectedd ; 
			
			$.ajax({
				type: "POST",
				url: "supprimerOotion_DISP.php",
				data: dataString,
				cache: true,
				success: function(html){
					$("#supprimerDecipline").modal("hide");	
					swal(
							'SUPPRIMER!',
							'LES DECIPLINES SELECTIONNEES ONT  BIEN ETES SUPPRIMEES.',
							'success'
						  )
						  
						  
						  
					 
					}
					
					
					
					
				
					
					
				});
		   }
		   
		   
		   
				
					
		</script>
		
		</div>
  </div> 
	
	
	
	
	
	<div class="modal fade" id="supprimerMotcles" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Supprimer Mots clés de la filière </h4>
			</div>
			<div class="modal-body">
				 
						
							<label>Les Mots clé de la filière </label>
							<select class="form-control" name='supprimermotcleList' id="supprimermotcleList" multiple> 
								
							
							</select> 
						
						
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="summrimermotclemethode()" class="btn btn-danger">Supprimer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  <script>
		  
		   function summrimermotclemethode(  ){	
		   
		   var option_selectedd="";
		    $('#supprimermotcleList option').each(function () {
				var isselected = $(this).is("option:selected");
				if (isselected) 
				{
					option_selectedd=option_selectedd+" "+$(this).val();
					
					$("#mocletxt"+$(this).val()).remove();
          window.location.reload();
				}
			});
			
			var dataString = 'lesIDi=' + option_selectedd ; 
			
			$.ajax({
				type: "POST",
				url: "supprimerMotcle.php",
				data: dataString,
				cache: true,
				success: function(html){
					$("#supprimerMotcles").modal("hide");	
					swal(
							'SUPPRIMER!',
							'LES MOT CLES SELECTIONNEES ONT  BIEN ETES SUPPRIMEES.',
							'success'
						  )  
					 
					}
					
				});
		  }
		   
		   
		   
				
					
		</script>
		
		</div>
  </div> 
	
	
	
	
	
	
	
	
	
	<div class="modal fade" id="ajouterdebouche" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">NOUVEAU DEBOUCHE </h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom du débouche </label>
						<input type="text" placeholder="debouche" class="name form-control" id="newDEBtext" required />
						
						<div id="infohiddenDebouche" >
						
							<label>Secteur d'activité </label>
							<select class="form-control" name='lesDomaineNEWTEXT' id="lesDomaineNEWTEXT"> 
								<option value='0' style="font-weight: bold;" SELECTED disabled  > Secteur d'activité </option>

      							    <?php 			
          									$SQL="select CODE_SECTEUR,NOM_SECTEUR from secteur_activite;";
          									$query=mysqli_query($ma_connexion,$SQL);
          									while($row=mysqli_fetch_assoc($query))
          									{	
          											$codeDEB = $row['CODE_SECTEUR'];
          											$libelleDEB = $row['NOM_SECTEUR'];

          											echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
          									}
      									?> 

							</select> 
						
						</div>
						
						<br>
						<label>Ou bien choisir un débouche </label>
						<br>
						<br>
						<div class="col-xs-4">
							<select class="form-control" name='domaineadd' id="domaineadd"> 
								<option value='0' style="font-weight: bold;" SELECTED disabled  > Secteur d'activité </option>
							<?php 
														
									$SQL="select CODE_SECTEUR,NOM_SECTEUR from secteur_activite;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{	
											$codeDEB = $row['CODE_SECTEUR'];
											$libelleDEB = $row['NOM_SECTEUR'];

											echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
									}

									?> 
							</select> 
						</div>
						<div class="col-xs-8">
							<select class="form-control" name='deboucheadd' id="deboucheadd"> 
								<option value="0" disabled selected>  </option>
							</select> 
						</div>
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ajouterDEBOUCHE()" class="btn btn-primary">Ajouter</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  <script>
		  var ikd=1; 
		  var ikdUPDT=100; 
		  var indice  ;
		   function ajouterDEBOUCHE(  ){	
		   


			if ( $("#newDEBtext").val() == '')
			{
				if ( $("#deboucheadd").val() == null )
				{
						swal(
						  'Erreur...',
						  'Aucun debouche pour ce secteur !',
						  'error'
						)
				}
				else 
				{
		
					var id = $("#deboucheadd").val() ; 
					var name = $("#deboucheadd :selected").text();
					
					var idDomaine = $("#domaineadd").val() ; 
					var nameDomaine = $("#domaineadd :selected").text();
				
				
					$('#tableau1').append('<tr id="row'+ikdUPDT+'"><td><input type="text" class="form-control"  value="'+name+'" readonly="readonly" name="newdebinput'+ikdUPDT+'" id="newdebinput'+ikdUPDT+'"><input type="hidden" name="lasSave'+ikdUPDT+'" value="'+id+'"/></td><td><input type="text" class="form-control"  value="'+nameDomaine+'" readonly="readonly" name="newdebinputDomaine'+ikdUPDT+'" id="newdebinputDomaine'+ikdUPDT+'"><input type="hidden" name="lasSaveDomaine'+ikdUPDT+'" value="'+idDomaine+'"/></td><td><button id="activernewdebouche'+ikdUPDT+'"  onclick="createCallbackadd('+ikdUPDT+')"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td> <td><button id="'+ikdUPDT+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td></tr>');
					ikdUPDT++ ; 
					
				}
		    }
			else{
				
				var dataString2 =  'nomdebouche='+ $("#newDEBtext").val() ; 
				$.ajax
					({
						type: "POST",
						url: "get_TEST_nom_debouche.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							
							if (html.trim() == 1 )
							{
								swal(
								  'Attention...',
								  'ce debouche exist deja!',
								  'warning'
								)
								
								
								
							}
							else
							{
								
								indice = 0 ;
								for (var x=1 ; x< ikd ; x++)
								{

									if ($("#newdebinput"+x).val().toUpperCase() == $("#newDEBtext").val().toUpperCase())
									{
										indice = 1 ; 
									}
									
								}
								if ( indice == 0 ) 
								{
									if ( $("#lesDomaineNEWTEXT").val() == null )
									{
											swal(
											  'Erreur...',
											  'Vous avez manquez de choisir le secteur d\'activite !',
											  'error'
											)
									}
									else{
										var name = $("#newDEBtext").val() ; 
										var idDomaine = $("#lesDomaineNEWTEXT").val() ; 
										var nameDomaine = $("#lesDomaineNEWTEXT :selected").text();				
										
										$("#newDEBtext").val(''); 
										
										$('#tableau1').append('<tr id="row'+ikd+'"><td><input type="text" class="form-control"  value="'+name+'" readonly="readonly" name="newdebinput'+ikd+'" id="newdebinput'+ikd+'"></td><td><input type="text" class="form-control"  value="'+nameDomaine+'" readonly="readonly" name="newdebinputDomaine'+ikd+'" id="newdebinputDomaine'+ikd+'"> <input type="hidden" name="lasSaveDomaine'+ikd+'" value="'+idDomaine+'"/> </td> <td><button id="activernewdebouche'+ikd+'"  onclick="createCallbackadd('+ikd+')"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td> <td><button id="'+ikd+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td></tr>');
										ikd++ ; 
									}
								}
								else{
									
									swal(
											  'Erreur...',
											  'Vous avez deja ajouter ce debouche !',
											  'error'
											)
								}
				
							}
								
							
						}
					});	
				
				
				
				
				
				
				
				
				
				
				
				
								
			}
		   }
		   
		   function functionsumit2() {
			
					var x = document.createElement("input");
					x.setAttribute("type", "hidden");
					x.setAttribute("name", "valeurindiceDebouche");													
					x.setAttribute("value", ikd );													
					$('#valindiceincremeDeb').append(x);
					
					var y = document.createElement("input");
					y.setAttribute("type", "hidden");
					y.setAttribute("name", "valeurindiceDebouchewith");													
					y.setAttribute("value", ikdUPDT );													
					$('#valindiceincremeDeb').append(y);
				}
				
		   
		   
				
					
		</script>
		<script>
		  $("#infohiddenDebouche").hide();
		 
		  $('#newDEBtext').keyup(function() {
				if ( $(this).val() == '')
				{
					$("#infohiddenDebouche").hide();
					
				}
				else{
					$("#infohiddenDebouche").show();
					
				}
		});
			 
		  

		  </script>
		</div>
  </div> 
  
  
  <div class="modal fade" id="ajouterModule" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">NOUVEAU MODULE </h4>
			</div>
			<div class="modal-body">
				 
						
						<div class="form-group">
						
							<br>
							<div class="col-xs-2">
							<label for="NEW_MODULE_Semestre">Semèstre </label>
								<select  class="form-control" id="NEW_MODULE_Semestre" name="NEW_MODULE_Semestre"  required >
									<option value="S1">S1</option> 
									<option value="S2">S2</option>
									<option value="S3">S3</option> 
									<option value="S4">S4</option> 
								</Select>
							</div>
							
							<div class="col-xs-8">
							<label for="NEW_MODULE_libellle">Nom module </label>
								<input placeholder="module" class="name form-control"  id="NEW_MODULE_libellle"autofocus="" required="" type="text">
							</div>
							
							<div class="col-xs-2">
								<label for="NEW_MODULE_volume">Volume </label>
								<input min="80" value="90" max="100" class="form-control" id="NEW_MODULE_volume" step="10"  type="number" required>
							</div>
						
							
						
							<br><br>
							<br><br>
							<br>
							
							
								<input  type="checkbox" id="TEST_CORD_SELECT" > &nbsp;<label for="TEST_CORD_SELECT">
									Affecter un cordonateur à ce module : 
								</label>
						
							
							
							
						<div id="hideINfoInchange" >	
							<div class="radio center " style="margin-left: 162px;">
							 <label><input type="radio" name="CLASSEMENT"  value="Filiere"id="Class_Filiere" checked >Filière</label>						 
							  <label><input type="radio" name="CLASSEMENT" value="Grade"id="Class_Grade" >Grade</label>
							  <label><input type="radio" name="CLASSEMENT" value="Specialite"id="Class_Specialite" >Spécialité</label>
							</div>
							
							
							
							
							<div class="col-xs-4" >
							
								<select class="form-control" name='NEW_MODULE_LEFILIERES' id="NEW_MODULE_LEFILIERES" > 
									<option value='0' style="font-weight: bold;" selected disabled  >FILIERE</option>
								<?php 
															
										$SQL="select CODE_FIL , NOM_FIL from filiere  where CODE_DEPT = $id_DEPT ;";
										$query=mysqli_query($ma_connexion,$SQL);
										while($row=mysqli_fetch_assoc($query))
										{	
												$codeDEB = $row['CODE_FIL'];
												$libelleDEB = $row['NOM_FIL'];

												echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
										}

										?> 
								</select> 
							</div>
							
							<div class="col-xs-8">
								<select class="form-control" name='NEW_MODULE_COrdonateurSelect' id="NEW_MODULE_COrdonateurSelect"> 
									<option value="0" disabled selected> </option>
								</select> 
							</div>
					</div>		
							<script>
							$('#hideINfoInchange').hide();
							$('#TEST_CORD_SELECT').change(function() {
							   if($(this).is(":checked")) {
								  $('#hideINfoInchange').show();
								  
							   }else{
								   $('#hideINfoInchange').hide();
							   }
							   
							});
							</script>
							<script>
							var resultClass = 'Filiere' ; 
							var departActive = '<?php echo $id_ETAB ?>' ;
							var dataString = 'departActive=' + departActive ; 
								$('input[type=radio][name=CLASSEMENT]').change(function() {
									
										if (this.value == 'Filiere') {
											dataString += '&indice=Filiere' ; 
											resultClass = 'Filiere' ; 
										}
									   else if (this.value == 'Grade') {
											dataString += '&indice=Grade' ; 
											resultClass = 'Grade' ; 
										}
										else if (this.value == 'Specialite') {
											dataString += '&indice=Specialite' ; 
											resultClass = 'Specialite' ; 
										}
										
										
										
										$.ajax({
										type: "POST",
										url: "getClassCHangeMAG.php",
										data: dataString,
										cache: true,
										success: function(html){
											  $("#NEW_MODULE_LEFILIERES").html(html);
						
										}
										});
									
										
									});
										
										
									$("#NEW_MODULE_LEFILIERES").change(function()
										{
											var id=$(this).val();
											var dataString1 = 'id='+ id  ; 
											
											if (resultClass == 'Filiere') {
												dataString1 += '&indice=Filiere'  ; 
											}
											
											
											else if (resultClass == 'Grade') {
												dataString1 += '&indice=Grade' ; 
											}
											else if (resultClass == 'Specialite') {
												dataString1 += '&indice=Specialite' ; 
											}
											
											dataString1 += '&departActive=' + departActive ; 
											
											$.ajax
											({
												type: "POST",
												url: "getcordonateurparmodule.php",
												data: dataString1,
												cache: false,
												success: function(html)
												{
													$("#NEW_MODULE_COrdonateurSelect").html(html);
												}
											});
										});
		
										
									
							</script>
							 
							
							
							<br><br><br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ajouterModulefonc()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  
		
			
		  <script>
		  var ikdmodule=1; 
		  var tableAtester = []; 
		  var indicator = 0 ; 
		   function ajouterModulefonc(  ){
			   
			  if ($("#NEW_MODULE_libellle").val() != '') 
			  {
				var idfil = '<?php echo $idf ; ?>' ;
				var dataString2 =  'nomModule='+ $("#NEW_MODULE_libellle").val() + '&idf='+ idfil ; 
				
				$.ajax
					({
						type: "POST",
						url: "get_TEST_nom_Module.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							
							if (html.trim() == 1 )
							{
								swal(
								  'Attention...',
								  'ce module exist deja!',
								  'warning'
								)
								
								
								
							}
							else{
								indicator = 0 ; 
								if (ikdmodule > 1 )
								{
									for (var i = 1; i < ikdmodule; i++) {
										if (  tableAtester[i] ==  $("#NEW_MODULE_libellle").val() )
												indicator = 1 ; 		
									}
								}
								
								
								if( indicator == 1  )
								{
									swal(
									  'Attention...',
									  'ce module exist deja!',
									  'warning'
									)
								}
								else
								{
									 
									
									var semestreNEW = $("#NEW_MODULE_Semestre :selected").text(); 
									var moduleNEW = $("#NEW_MODULE_libellle").val() ; 
									var volumeNEW = $("#NEW_MODULE_volume").val() ;
									tableAtester[ikdmodule] = moduleNEW ; 
									if ( $("#NEW_MODULE_volume").val() <= 100  && $("#NEW_MODULE_volume").val() >= 80 )
									{
										// alert("Enter some text..");
										// $("#newDEBtext").focus();
										var cordonateurExistsName = $("#NEW_MODULE_COrdonateurSelect :selected").text();
										var cordonateurExistsID = $('select[name=NEW_MODULE_COrdonateurSelect]').val() ; 
										if ($('select[name=NEW_MODULE_COrdonateurSelect]').val() == null )
										{
											cordonateurExistsID = null ; 
										}
										if ( ! $('#TEST_CORD_SELECT').is(":checked"))
										{
											cordonateurExistsID = null ; 
											cordonateurExistsName = '' ; 
										}
										
										
										
										
										$('#tableau').append('<tr id="row'+ikdmodule+'">  <input type="hidden" name="idExisistCordonateur'+ikdmodule+'" value="'+cordonateurExistsID+'" />   <td><input type="text" class="form-control"  value="'+semestreNEW+'"  readonly="readonly" name="newsestreinput'+ikdmodule+'" id="newsestreinput'+ikdmodule+'" ></td>       <td><input type="text" class="form-control"  value="'+moduleNEW+'" onkeyup="testNommoduleImpossible(this.value,'+ikdmodule+')"  ondblclick="this.readOnly=false" breadonly="readonly" name="newmoduleinput'+ikdmodule+'" id="newmoduleinput'+ikdmodule+'"></td>         <td><input type="number" class="form-control"  ondblclick="this.readOnly=false" value="'+volumeNEW+'" readonly="readonly" name="newvolumeinput'+ikdmodule+'" id="newvolumeinput'+ikdmodule+'" min="80" max="100" ></td>      <td><input type="text" class="form-control"  value="'+cordonateurExistsName+'" readonly="readonly" name="newCordonateur'+ikdmodule+'" id="newCordonateur'+ikdmodule+'" ></td>        <td><button id="activernewcometance'+ikdmodule+'"  onclick="activerinputmodulenew('+ikdmodule+')"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>      <td><button id="'+ikdmodule+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td>      </tr>');
										ikdmodule++ ; 

									}
									else{
										swal(
														  'Attention...',
														  'le volume doit être compris entre 80 et 100 heures ; !',
														  'error'
											)
											$("#NEW_MODULE_volume").val(90) ;
									}
								
								
								}
							}
								
							
						}
					});	
			  }
			  else
			  {
				  swal(
					  'Attention...',
					  'Vous avez manquez de remplir le nom du  module !',
					  'error'
					)
			  }

			
		
		   }
		   
		    var  valtest ;
		    var  indice22 = '<?php echo $indmodule ?>' ;
		 	  function testNommoduleImpossible(e,H) {
			// alert(es);
				for (var x=1 ; x< ikdmodule ; x++)
				{
					if (x != H) 
					{
						valtest = $("#newmoduleinput"+x).val();
						if (valtest == e)
						{
							swal(
							  'Oups...',
							  'ce module exist deja!',
							  'error'
							)
							$("#newmoduleinput"+H).val('');
						}
					}
				}
				
				for (var x=1 ; x< indice22 ; x++)
				{
					
						valtest = $("#moduleinput"+x).val();
						if (valtest == e)
						{
							swal(
							  'Oups...',
							  'ce module exist deja!',
							  'error'
							)
							$("#newmoduleinput"+H).val('');
						}
					
				}
					
			}
			
			
		   function functionsumit6() {
					var x = document.createElement("input");
          x.setAttribute("type", "text");
					x.setAttribute("hidden", "true");
					x.setAttribute("name", "valeurindiceModule");													
					x.setAttribute("value", ikdmodule );													
					$('#valindiceincreme').append(x);
				}
				
					
		</script>
		</div>
  </div> 
  
  
  
  
  
  
  <div class="modal fade" id="ajouterCometance" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">NOUVELLE COMPETANCE </h4>
			</div>
			
		
			
			
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom de compétance </label>
						<input type="text" placeholder="Competance" class="name form-control" id="newCOMPtext" required />
						<div id="infohiddenCompetance">
							<label>Domaine </label>
							<select  name='lesDomaineNEWTEXTcompetance' class="form-control" id="lesDomaineNEWTEXTcompetance"> 
								<option value='0' style="font-weight: bold;" SELECTED disabled > Domaine </option>
							<?php 
									$SQL="select CODE_DOMAINE,NOM_DOMAINE from domaine;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{	
											$codeDEB = $row['CODE_DOMAINE'];
											$libelleDEB = $row['NOM_DOMAINE'];

											echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
									}
									?> 
							</select>
							<label>source compétences</label><br>
							<input type="radio" name="source_nv"  value="Académique" id="académique_nv" checked>&nbsp&nbspà base Académique<br>
							<input type="radio" name="source_nv"  value="Annonces" id="annonces_nv">&nbsp&nbspà base des annonces

						</div>
						<br>
						<label>Ou bien choisir une compétance</label>
						<br>
	<input type="radio" name="source_exi" value="Académique" id="académique_exi">&nbsp&nbspà base Académique&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="radio" name="source_exi" value="Annonces" id="annonces_exi">&nbsp&nbspà base des annonces<br><br>
						<div id="infohiddenCompetance_source">
						<div class="col-xs-4">
							<label>Domaine</label>
							<select class="form-control" name='domaineadd2' id="domaineadd2"> 
								<option value='0' style="font-weight: bold;" SELECTED disabled>Domaine</option>
							<?php 					
									$SQL="select CODE_DOMAINE,NOM_DOMAINE from domaine;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{	
											$codeDEB = $row['CODE_DOMAINE'];
											$libelleDEB = $row['NOM_DOMAINE'];
											echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
									}
									?> 
							</select>
						</div>
						<div class="col-xs-8">
							<label>les compétences</label>
							<!-- <input type="text" name="competence_exi" required="" id="competence_exi" class="form-control" readonly="true"> 
							<div id="COMPRESULT"></div> -->
							<select class="form-control js-example-tags" multiple="" id="motcle_comp" readonly="true" name="motcle_comp" style="width:100%;">

								</select>	
							<script src="../js/select2.min.js"></script>
												
							  <script>
							  var $j = jQuery.noConflict();
									$j(".js-example-tags").select2({
								  tags: true
								});
							</script>
						</div>
						<br><br>
						</div>
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ajouterCompetance()" class="btn btn-primary">Ajouter</button>
			  <!-- <button type="button" onclick="hahaa()" class="btn btn-primary">Ajouter</button> -->
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		
		  <script>
		
		  var ikdcmp=1; 
		  var ikdcmpUPD=100; 
		   function ajouterCompetance( ){

		   
			if ( $("#newCOMPtext").val() == '')
			{
				
				if ( $("#competanceadd").val() == '' )
				{
						swal(
						  'Erreur...',
						  'Vous devez remplir le champs des compétences !',
						  'error'
						)
				}
				else 
				{
					var aaa=0;
					var count = $('#total_comp').val();
					$('.select2-selection__choice').each(function(){
		  			var name=$(this).attr('title');
		  			for(var ll=100;ll<=count;ll++){
		  				var tt=$('#newcompinput'+ll).val();
		  				if(tt == name)
		  					aaa=1;
		  			}
		  			if(aaa==0){
		  			var id;
		  			$('#motcle_comp').find('option').each(function() {
		  				if($(this).text()==name){
		  					id=$(this).val();
		  				}
		  			});

					//var id = $("#competanceadd").val() ; 
					//var name = $("#competanceadd :selected").text();
					var source_comp_name2=$('input[name=source_exi]:checked').val();
					var idDomaine = $("#domaineadd2").val() ; 
					var nameDomaine = $("#domaineadd2 :selected").text();
					
					$('#tableau2').append('<tr id="row'+ikdcmpUPD+'"><td><input type="hidden" id="total_comp" value="'+ikdcmpUPD+'"><input type="text" class="form-control"  value="'+name+'" readonly="readonly" name="newcompinput'+ikdcmpUPD+'" id="newcompinput'+ikdcmpUPD+'"><input type="hidden" name="lasSaveCMP'+ikdcmpUPD+'" value="'+id+'"/></td><td><input type="text" class="form-control"  value="'+nameDomaine+'" readonly="readonly" name="newcompinputDomaine'+ikdcmpUPD+'" id="newcompinputDomaine'+ikdcmpUPD+'"><input type="hidden" name="lasSaveCMPDomaine'+ikdcmpUPD+'" value="'+idDomaine+'"/></td><td><input id="newcompsource'+ikdcmpUPD+'" type="text" class="form-control" name="newcompsource'+ikdcmpUPD+'" value="'+source_comp_name2+'" readonly="readonly"></td><td><button id="activernewcompetance'+ikdcmpUPD+'"  onclick="createCallbackaddcmp('+ikdcmpUPD+')"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td> <td><button id="'+ikdcmpUPD+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td></tr>');
					ikdcmpUPD++ ;
		  			}
		  			else {
		  				swal(
						  'Erreur...',
						  'Vous essayez d\'entrer une compétence deja existant !',
						  'error'
						)
		  			}
		  			});
				}
		    }
			else
			{
				
				var dataString2='nomcompetance='+$("#newCOMPtext").val();
				$.ajax
				({
					type: "POST",
					url: "get_TEST_nom_competance.php",
					data: dataString2,
					cache: false,
					success: function(html)
					{
						
						if (html.trim() == 1 )
						{
							swal(
							  'Attention...',
							  'cet competance existe deja!',
							  'warning'
							)	
						}
						else
						{
							if ( $("#lesDomaineNEWTEXTcompetance").val() == null )
							{
									swal(
									  'Erreur...',
									  'Vous avez manquez de choisir le domaine !',
									  'error'
									)
							}
							else{
								var name = $("#newCOMPtext").val() ; 
								var source_comp_name1=$('input[name=source_nv]:checked').val();
								var idDomaine = $("#lesDomaineNEWTEXTcompetance").val() ; 
								var nameDomaine = $("#lesDomaineNEWTEXTcompetance :selected").text();	
								$('#tableau2').append('<tr id="row'+ikdcmp+'"><td><input type="text" class="form-control"  value="'+name+'" readonly="readonly" name="newcompinput'+ikdcmp+'" id="newcompinput'+ikdcmp+'"></td><td><input type="text" class="form-control"  value="'+nameDomaine+'" readonly="readonly" name="newcompinputDomaine'+ikdcmp+'" id="newcompinputDomaine'+ikdcmp+'"><input type="hidden" name="lasSaveCMPDomaine'+ikdcmp+'"  value="'+idDomaine+'"/></td><td><input id="newcompsource'+ikdcmp+'" type="text" class="form-control" name="newcompsource'+ikdcmp+'" value="'+source_comp_name1+'" readonly="readonly"></td><td><button id="activernewcompetance'+ikdcmp+'"  onclick="createCallbackaddcmp('+ikdcmp+')"  type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td> <td><button id="'+ikdcmp+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td></tr>');

								$("#newCOMPtext").val(''); 
								ikdcmp++ ; 
										
							}
				
						}
								
							
					}
				});	
						
			}
			}
		   
		     function functionsumit3() {
			
					var x = document.createElement("input");
					x.setAttribute("type", "hidden");
					x.setAttribute("name", "valeurindiceCompetance");													
					x.setAttribute("value", ikdcmp );													
					$('#indicejusquaCOMP').append(x);
					
					var y = document.createElement("input");
					y.setAttribute("type", "hidden");
					y.setAttribute("name", "valeurindiceCompetanceWith");													
					y.setAttribute("value", ikdcmpUPD );													
					$('#indicejusquaCOMP').append(y);
				}
				
					
		</script>
		
		<script>
		  $("#infohiddenCompetance").hide();
		  $('#newCOMPtext').keyup(function() {
				if ( $(this).val() == '')
				{
					$("#infohiddenCompetance").hide();
				}
				else{
					$("#infohiddenCompetance").show();
				}
			});
			
		$("#infohiddenCompetance_source").hide();
		  $('input[name="source_exi"]').change(function(){
				if ( $(this).val() == 'Académique' || $(this).val() == 'Annonces')
				{
					$("#domaineadd2").val("");
					$("#infohiddenCompetance_source").show();
				}
			});
		  </script>
		</div>
  </div>
					
	  
  
  <div class="modal fade" id="ajouterDiplomeandPrerequis" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">NOUVEAU DIPLOME</h4>
			</div>
			<div class="modal-body">
					
					<fieldset>
						<legend>Diplome</legend>
						
						
						<label>choisir un Diplome</label>
						<br>
						<br>
						<div class="col-xs-12">
							<select class="form-control" name='diplomeaddindice' id="diplomeaddindice"> 
								<option value='0' style="font-weight: bold;" >TYPE</option>
							<?php 
														
									$SQL="select CODE_TYPE_DIPLOME, NOM_TYPE_DIPLOME  from type_diplome;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{	
											$codeDEB = $row['CODE_TYPE_DIPLOME'];
											$libelleDEB = $row['NOM_TYPE_DIPLOME'];

											echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
									}

									?> 
							</select> 
						</div>
						
						<br><br>
							<div  name='diplomeaddselect' id="diplomeaddselect" >
							
							
							</div>
						
						<br>
						
					</fieldset>
					
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ajouterDiplome()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
			</div>
		  </div>
		  </form>
		  <script>
		  function getCheckedBoxes(chkboxName) {
				  var checkboxes = document.getElementsByName(chkboxName);
				  var checkboxesChecked = [];
				  // loop over them all
				  for (var i=0; i<checkboxes.length; i++) {
					 // And stick the checked ones onto an array...
					 if (checkboxes[i].checked) {
						checkboxesChecked.push(checkboxes[i]);
					 }
				  }
				  // Return the array if it is non-empty, or null
				  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
				}
		  
		  var ikdDiplome=1; 
		  var ikdcmpUPDDiplome=100; 
		   function ajouterDiplome( ){	
							
				var VAluesTYPEDiplomesNEWTEXT = $("#diplomeaddindice :selected").text();					
				var VAluesTYPEDiplomesNEWID= $("#diplomeaddindice").val() ; 
				
				var VAlueslesDiplomesNEWID = $("#diplomeaddselect").val() ; 
				var VAlueslesDiplomesNEWTEXT = $("#diplomeaddselect :selected").text();	
				
				
				var checkedBoxes = getCheckedBoxes("cbox1");

				var monArraySeria = '';
				for (var i in checkedBoxes)
				{
					
					VAlueslesDiplomesNEWTEXT = checkedBoxes[i].value ;

					  var k =  VAlueslesDiplomesNEWTEXT.split("::"); 
					  VAlueslesDiplomesNEWTEXT = k[1] ; 
					  VAlueslesDiplomesNEWTEXT2 = k[0] ; 
					
					$('#LES_DIPLOMES').append('<div class="form-group" id="rowDiplomeADDS'+ikdcmpUPDDiplome+'"> <label for="" class="col-sm-4 control-label"> Diplome Ajoute </label>  <div class="col-xs-4"><input type="text" readonly="readonly" class="form-control"   value="'+VAluesTYPEDiplomesNEWTEXT+'" id="TYPEdiplomeInputADDS'+ikdcmpUPDDiplome+'"  name="TYPEdiplomeInputADDS'+ikdcmpUPDDiplome+'"  >   <input readonly="readonly" type="hidden" class="form-control" id="DiplomeInputprerequisADD'+ikdcmpUPDDiplome+'"  name="DiplomeInputprerequisADD'+ikdcmpUPDDiplome+'" value="'+VAlueslesDiplomesNEWTEXT2+'" >          <input readonly="readonly" type="text" class="form-control" value="'+VAlueslesDiplomesNEWTEXT+'" ><input type="hidden"   name="SaveInputDiplomeEXIST'+ikdcmpUPDDiplome+'" value="'+VAlueslesDiplomesNEWID+'" ></div>	</div>');
												
					ikdcmpUPDDiplome++ ;
					
					
					$("#indjusquaDipl").val(ikdcmpUPDDiplome) ; 
				}
				

		   }
		   

					
		</script>
		
		
		</div>
  </div>

				</div>

				<!--block onglets
				====================================-->	
</div>			

<?php

$indError = 0 ; 
if(isset($_POST['submit1']))
{
	
	
	$intitule=mysqli_real_escape_string($ma_connexion, $_POST['intituleinput']) ;
	$date1 = ''; 
	$date2 = '';
	if(isset($_POST['Da'])) 
		$date1 = mysqli_real_escape_string($ma_connexion, $_POST['Da']) ;
	if(isset($_POST['Dfa'])) 
		$date2 = mysqli_real_escape_string($ma_connexion, $_POST['Dfa']) ; 
	
	$diplome = mysqli_real_escape_string($ma_connexion,$_POST['diplomeinput']) ;
	$specialite = '' ; 
	if(isset($_POST['specialiteinout']))
		$specialite = mysqli_real_escape_string($ma_connexion,$_POST['specialiteinout']) ;	
    $departementInp = $_POST['departementInput'];
	
	
	 $sql = " UPDATE `filiere` 
		SET `NOM_FIL`= '$intitule' ,
		`NATURE_DIPLOME`='$diplome',
		`SPICIALITE_DIPLOME`='$specialite',
		`Date_Debut`= '$date1',
		`Date_fin`=  '$date2',
		`CODE_DEPT`=  '$departementInp'
		WHERE `CODE_FIL` = '$idf' 	";
		
		if (mysqli_query($ma_connexion, $sql)) {
		
		} else {
			// echo "Error updating record: " . mysqli_error($ma_connexion);
			$indError = 1 ; 
		}

	
	

	
	for ($i = 0 ; $i < $ind1 ; $i++) 												
	{
		$txt = "o".$i ;
		$txt2 = "optioninput".$i ; 
		
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
		$idchange = $_POST["$txt"] ; 
		$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt2"])  ; 
	
			$sql = " UPDATE option_filiere
			set OPTION_FIL = '$valuechange' 
			where CODE_OPTION_FIL  = '$idchange'  ; ";


			if (mysqli_query($ma_connexion, $sql)) {
		
			} else {
				// echo "Error updating record: " . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
	
	}

	
	for ($i = 0 ; $i < $ind2 ; $i++) 												
	{
		$txt = "d".$i ;
		$txt2 = "disciplineinput".$i ;
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{		
			$idchange = $_POST["$txt"] ; 
			$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt2"])   ; 
	
			$sql = " UPDATE decipline_filiere
			set decipline_FIL = '$valuechange' 
			where CODE_decipline_FIL  = '$idchange'  ; ";


			if (mysqli_query($ma_connexion, $sql)) {
		
			} else {
				// echo "Error updating record: " . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
	
	}
	
	for ($ii = 2 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["new".$ii]))
		{
						
				$txt = "new".$ii ;		
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt"])  ; 
				
					
					$sql = " INSERT INTO `option_filiere`(`CODE_FIL`, `OPTION_FIL`) VALUES ('$idf','$valuechange') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ;
					}

		}
	}
	
	for ($ii = 2 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["newd".$ii]))
		{
						
				$txt = "newd".$ii ;		
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt"])  ; 
				
					
					$sql = " INSERT INTO `decipline_filiere`(`CODE_FIL`, `decipline_FIL`) VALUES ('$idf','$valuechange') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ;
					}

		}
	}
	
	
	foreach ($_POST['motcle'] as $selectedOption)
	{
		
		
		$sql = " INSERT INTO `mot_cle`(`NOM_MOTCLE`) VALUES ('$selectedOption') ; "; 
		
		if (mysqli_query($ma_connexion, $sql)) {
			$last_id = mysqli_insert_id($ma_connexion);
			
			$sql2 = " INSERT INTO `filiere_motCles`(`CODE_FIL`, `CODE_MOTCLE`) VALUES ('$idf','$last_id') ; "; 
			
			if (mysqli_query($ma_connexion, $sql2)) {
			
			} else {
				
			}
			
		
		} else {
			
			$SQLADD="SELECT `CODE_MOTCLE` FROM `mot_cle` WHERE `NOM_MOTCLE` = '$selectedOption'  ";
			$queryADD=mysqli_query($ma_connexion,$SQLADD);
			while($row=mysqli_fetch_assoc($queryADD))
			{
				$last_id = $row['CODE_MOTCLE'];
				
				$sql2 = " INSERT INTO `filiere_motCles`(`CODE_FIL`, `CODE_MOTCLE`) VALUES ('$idf','$last_id') ; "; 
				
				if (mysqli_query($ma_connexion, $sql2)) {
				
				} else {
					
				}
			
			}
			
		}
		
	}
	if ( $indError == 0 )
	{
		echo "<meta http-equiv='refresh' content='0' />";
	}
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer des informations deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}
}



if(isset($_POST['submit2']))
{

	
for ($ii = 0 ; $ii < $inddebouche ; $ii++) 												
	{
		$txt = "deb".$ii ;
		$txt2 = "debouvheinput".$ii ; 
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
			
			$idchange = $_POST["$txt"] ; 
			$valuechange = $_POST["$txt2"] ; 
			$domainechange = $_POST["DomaineDeboucheInput".$ii] ; 
			
			$sql = " UPDATE `debouche_formation` SET `DEBOUCHE_FOR`= '".mysqli_real_escape_string($ma_connexion,$valuechange)."',
			 CODE_DOMAINE = $domainechange WHERE `CODE_DEBOUCHE_FOR` = $idchange "; 
					
			if (mysqli_query($ma_connexion, $sql)) {
				
			} else {
				// echo "Error updating record: " . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
		
		
		if(isset($_POST["deletedebouche".$ii]))
		{
				
						
				$valuechange = $_POST["deletedebouche".$ii] ;  
				
				
					
					$sql = " DELETE FROM `formation_debouche` WHERE CODE_DEBOUCHE_FOR =  $valuechange and CODE_FIL = '$idf' ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					
					// $sql = " DELETE FROM  debouche_formation where CODE_DEBOUCHE_FOR =  $valuechange; "; 
				
					// if (mysqli_query($ma_connexion, $sql)) {
							
					// } else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
					// }

		}
	}
	

$idjusqueDEB = $_POST["valeurindiceDebouche"];
for ($ii = 1 ; $ii < $idjusqueDEB; $ii++) 												
	{
		if(isset($_POST["newdebinput".$ii]))
		{
						
				$txt = "newdebinput".$ii ;		
				$valuechange = $_POST["$txt"]  ; 
				$domainechange = $_POST["lasSaveDomaine".$ii]  ; 
				$last_id = null ; 
					
					$sql = " INSERT INTO `debouche_formation`(`DEBOUCHE_FOR`,`CODE_DOMAINE`) VALUES ('".mysqli_real_escape_string($ma_connexion,$valuechange)."',$domainechange) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					
					$sql = " INSERT INTO `formation_debouche`(`CODE_FIL`, `CODE_DEBOUCHE_FOR`) VALUES ('$idf',$last_id) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}

		}
	}
	
$idjusqueDEBwith = $_POST["valeurindiceDebouchewith"];
for ($ii = 100 ; $ii < $idjusqueDEBwith ; $ii++) 												
	{
		if(isset($_POST["newdebinput".$ii]))
		{
						
				$txt = "newdebinput".$ii ;		
			
				$txt2 = "lasSave".$ii ;					
				$last_id = $_POST["$txt2"] ; 
				
				
					
					$sql = " INSERT INTO `formation_debouche`(`CODE_FIL`, `CODE_DEBOUCHE_FOR`) VALUES ('$idf',$last_id) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}

		}
	}
	

	if ( $indError == 0 )
		echo "<meta http-equiv='refresh' content='0' />";
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer un debouche  deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}

}



if(isset($_POST['submit3']))
{
	
for ($ii = 0 ; $ii < $indcompetance ; $ii++) 												
	{
		
		$txt = "comp".$ii ;
		$txt2 = "competanceinput".$ii;
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
			$idchange = $_POST["$txt"] ; 
			$valuechange = $_POST["$txt2"] ;
			$domainechange = $_POST["DomaineCopetanceInput".$ii]; 
			
			
			$sql = " UPDATE `competence` SET `COMPETNECE`= '".mysqli_real_escape_string($ma_connexion,$valuechange)."' , 
			CODE_DOMAINE = $domainechange WHERE `CODE_COMP`= $idchange  "; 
					
			if (mysqli_query($ma_connexion, $sql)) {
				
			} else {
				// echo "Error updating record:  1" . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
		
		if(isset($_POST["deletecompetance".$ii]))
		{
				
						
				$valuechange = $_POST["deletecompetance".$ii] ;  
				
					$sql = " DELETE FROM `competence` WHERE CODE_COMP =  $valuechange  ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						// echo "Error updating record:  2" . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					
					// $sql = " DELETE FROM  competence where CODE_COMP =  $valuechange; "; 
				
					// if (mysqli_query($ma_connexion, $sql)) {
							
					// } else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
					// }
					
					// $SQL="SELECT CODE_MAT
							// FROM matiere 
							// where CODE_MODU in ( SELECT m.CODE_MODU 
												// FROM module m 
												// WHERE m.CODE_FIL = '$idf' ) ";
					// $query=mysqli_query($ma_connexion,$SQL);
					// while($row=mysqli_fetch_assoc($query))
					// {
						// $currentIDmat = $row["CODE_MAT"] ; 
						
						// $sqlaa = " DELETE FROM `compmatiere` WHERE CODE_COMP =  $valuechange and CODE_MAT = $currentIDmat ; "; 
					
						// if (mysqli_query($ma_connexion, $sqlaa)) {
					
						// } else {
							
						// }
					
					
					// }
					
					
					// $SQL="SELECT m.CODE_MODU
							// FROM module m
							// where m.CODE_FIL = '$idf'  ";
					// $query=mysqli_query($ma_connexion,$SQL);
					// while($row=mysqli_fetch_assoc($query))
					// {
						// $currentCodeMod= $row["CODE_MODU"] ; 
						
						// $sqlaa = " DELETE FROM `compmodule` WHERE CODE_COMP =  $valuechange and CODE_MODU = '$currentCodeMod' ; "; 
					
						// if (mysqli_query($ma_connexion, $sqlaa)) {
					
						// } else {
							
						// }
					
					
					// }

		}
	}
	

$indicejusquaboucleNEW = $_POST["valeurindiceCompetance"] ; 
for ($ii = 1 ; $ii < $indicejusquaboucleNEW ; $ii++) 												
	{
		if(isset($_POST["newcompinput".$ii]) && isset($_POST["lasSaveCMPDomaine".$ii])  )
		{
						
				$domainechange = $_POST["lasSaveCMPDomaine".$ii];	  
				$source_compN = $_POST["newcompsource".$ii];
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["newcompinput".$ii]) ; 
				$last_id = null ; 
					
					$sql = "INSERT INTO `competence`(`CODE_DOMAINE`,`COMPETNECE`,`source_comp`) VALUES ($domainechange,'$valuechange','$source_compN')";
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
				
					} else {
						// echo "Error updating record: 33" . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					
					$sql = " INSERT INTO `compfiliere`(`CODE_FIL`, `CODE_COMP`, `taux`) VALUES ('$idf',$last_id,0) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: 34" . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					
					$SQL="SELECT CODE_MAT
							FROM matiere 
							where CODE_MODU in ( SELECT m.CODE_MODU 
												FROM module m 
												WHERE m.CODE_FIL = '$idf' ) ";
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentIDmat = $row["CODE_MAT"] ; 
						
						$sqlaa = " INSERT INTO `compmatiere`(`CODE_MAT`, `CODE_COMP`, `taux`, `type`) VALUES  ($currentIDmat,$last_id,0,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
					
						} else {
							// echo "Error updating record: 35 " . mysqli_error($ma_connexion);
							$indError = 1 ; 
						}
					
					
					}
					
					
					$SQL="SELECT m.CODE_MODU
							FROM module m
							where m.CODE_FIL = '$idf'  ";
							
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentCodeMod= $row["CODE_MODU"] ; 
						
						$sqlaa = " INSERT INTO `compmodule`(`CODE_MODU`, `CODE_COMP`, `taux`) VALUES  ('$currentCodeMod',$last_id,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
					
						} else {
							// echo "Error updating record: 36 " . mysqli_error($ma_connexion);
							$indError = 1 ; 
						}
					
					
					}

		}
	}
	
	
	
$indicejusquaboucleExixt = $_POST["valeurindiceCompetanceWith"] ; 	
for ($ii = 100 ; $ii < $indicejusquaboucleExixt ; $ii++) 												
	{
		if(isset($_POST["newcompinput".$ii]))
		{
						
				// $txt = "newcompinput".$ii ;		  
				// $valuechange = mysqli_real_escape_string($ma_connexion,$_POST['$txt']);
				$txt2 = "lasSaveCMP".$ii;				
				$last_id = $_POST["$txt2"];
					
					
					$sql = " INSERT INTO `compfiliere`(`CODE_FIL`,`CODE_COMP`,`taux`) VALUES ('$idf',$last_id,0) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$indError = 0;
					} else {
						// echo "Error updating record: 44" . mysqli_error($ma_connexion);
						$indError = 1 ; 
					}
					$SQL="SELECT CODE_MAT
							FROM matiere 
							where CODE_MODU in ( SELECT m.CODE_MODU 
												FROM module m 
												WHERE m.CODE_FIL = '$idf' ) ";
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentIDmat = $row["CODE_MAT"] ; 
						
						$sqlaa = " INSERT INTO `compmatiere`(`CODE_MAT`, `CODE_COMP`, `taux`, `type`) VALUES  ($currentIDmat,$last_id,0,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
							$indError = 0 ;
						} else {
							// echo "Error updating record: 45 " . mysqli_error($ma_connexion);
							$indError = 1 ; 
						}
					
					
					}
					
					

		}
	}
	
	
	
	

	
	if ( $indError == 0 )
		echo "<meta http-equiv='refresh' content='0' />";
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer un domaine  deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}

}

if(isset($_POST['submit4']))
{
	
	$Objectif=$_POST['objectiformation'];
	$Condition = $_POST['conditionacceprerequis']; 
	$Acces = $_POST['acceepasserelle'];

	 $sql = " UPDATE `filiere` 
		SET `OBJECTIFS_FORMATION`= '".mysqli_real_escape_string($ma_connexion,$Objectif)."' ,
		`CONDITION_D_ACCEES`= '".mysqli_real_escape_string($ma_connexion,$Condition)."',
		`ACCES_PAR_PASSERELLE`= '".mysqli_real_escape_string($ma_connexion,$Acces)."'
		WHERE `CODE_FIL` = '$idf' 	";
		
		if (mysqli_query($ma_connexion, $sql)) {
			
			} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		 
	 echo "<meta http-equiv='refresh' content='0' />";	
}


if(isset($_POST['submit5']))
{
	
	for ($ii = 0 ; $ii < $ideffectif ; $ii++) 												
	{
		$txt = "savepromoinput".$ii ;
		$txt2 = "promoinput".$ii ; 
		$idchange = $_POST["$txt"] ; 
		$valuechange = $_POST["$txt2"] ;
		
		
		$sql = " UPDATE `effectifs` SET `EFFECTIF`= $valuechange WHERE `CODE_EFFECTIF`= $idchange and `CODE_FIL` = '$idf'   "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		
		if(isset($_POST["deleteeffectif".$ii]))
		{
				
						
				$valuechange = $_POST["deleteeffectif".$ii] ;  
				
				
					
					$sql = " DELETE FROM  effectifs where CODE_EFFECTIF =  $valuechange; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
							
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}

		}
		
		
	}
	$promoaddsave = $ideffectif  ; 
	for ($ii = 1 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["promoinputNEW".$ii]))
		{
				$promoaddsave++ ; 			
				$txt = "promoinputNEW".$ii ;		
				$valuechange = $_POST["$txt"] ; 
				$last_id = null ; 
				$anneepromo = $promoaddsave ; 
					
					$sql = " INSERT INTO `effectifs`(`CODE_FIL`, `EFFECTIF`, `promotion`, `ID_ANNE`) VALUES ('$idf',$valuechange,$promoaddsave,'$anneepromo') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
				
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
					
		}
	}
		 
														
														
														
	 echo "<meta http-equiv='refresh' content='0' />";	
}


if(isset($_POST['submit6']))
{
	
for ($ii = 0 ; $ii < $indmodule ; $ii++) 										
	{
		$txt = "savemylifmodule".$ii ;
		

		$txt2add1 = "semestreinput".$ii ; 
		$txt2add2 = "moduleinput".$ii ; 
		$txt2add3 = "volumeinput".$ii ; 
		
		
		if (isset($_POST["$txt"]) && isset($_POST["$txt2add1"]) && isset($_POST["$txt2add2"]) && isset($_POST["$txt2add3"])  && isset($_POST["cordonateurInput".$ii]) ) 
		{
		$idchange = $_POST["$txt"] ; 
		
		$semestrechange = $_POST["$txt2add1"] ;
		$modulechange = $_POST["$txt2add2"] ;
		$volumechange = $_POST["$txt2add3"] ;
		
		
		$codeCordChange = $_POST["cordonateurInput".$ii] ;
		
		$sql = " UPDATE `module` SET `CODE_COR_MODU` = $codeCordChange ,`ID_SEMSTRE`= '$semestrechange', NOM_MODU = '".mysqli_real_escape_string($ma_connexion,$modulechange)."' , VOLUME_HORAIRE_MODU = $volumechange  WHERE `CODE_MODU`= '$idchange'  "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		
		}
		
		if(isset($_POST["deletemodule".$ii]))
		{
				
						
				$valuechange = $_POST["deletemodule".$ii] ;  
				
				
					
					$sql = " DELETE FROM `module` WHERE CODE_MODU =  '$valuechange'  "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
					
		}
	}
	

	$idjusque = $_POST["valeurindiceModule"];
for ($ii = 1 ; $ii < $idjusque ; $ii++) 												
	{
		echo $ii ;
		
		if(isset($_POST["newsestreinput".$ii]))
		{
			$id_coordMODULEchange = null ; 
			
			$id_coordMODULEchange = $_POST["idExisistCordonateur".$ii] ;
			
				$bbbbb = $idf."%" ; 
				$query001 = "SELECT COUNT(*) as nbasavoir
								FROM module
								WHERE CODE_MODU LIKE '$bbbbb'";	
								
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
				
				$residadd = $idf."MD".$idmodnew ; 
					
				$newsem = $_POST["newsestreinput".$ii] ; 
				$newmod = $_POST["newmoduleinput".$ii] ; 
				$newvol = $_POST["newvolumeinput".$ii] ; 
					
					$sql = " INSERT INTO `module`(`CODE_MODU`, `CODE_COR_MODU`, `CODE_FIL`, `ID_SEMSTRE`, `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`, `PENDERATION`) 
								VALUES ('$residadd',$id_coordMODULEchange,'$idf','$newsem','".mysqli_real_escape_string($ma_connexion,$newmod)."','$newvol','0','0','0','0','0','0') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						echo "bb <br>" ;
					} else {
						
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
					

		}
	}
	echo "<meta http-equiv='refresh' content='0' />";  
}



if(isset($_POST['submit7']))
{
for ($ii = 0 ; $ii < $idDiplomes ; $ii++) 										
	{
		$txt = "saveDiplomeinputprereq".$ii ;
		$txt2 = "DiplomeInputprerequis".$ii ; 


		
		if (isset($_POST["$txt"])  && isset($_POST["$txt2"]) ) 
		{
		$idchange = $_POST["$txt"] ; 
		$idchange2 = $_POST["$txt2"] ; 
		

		
		
		$sql = " UPDATE `filiere_diplomes` SET `CODE_DIPLOME` = $idchange   WHERE `CODE_FIL`= '$idf'  "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
	
		
		}
		
		// if(isset($_POST["deletemodule".$ii]))
		// {
				
						
				// $valuechange = $_POST["deletemodule".$ii] ;  
				
				
					
					// $sql = " DELETE FROM `module` WHERE CODE_MODU =  '$valuechange'  "; 
				
					// if (mysqli_query($ma_connexion, $sql)) {
						
					// } else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
					// }
					
		// }
	}
	

	$idjusque = $_POST["indjusquaDipl"];
for ($ii = 100 ; $ii < $idjusque ; $ii++) 												
	{
		
		if(isset($_POST["DiplomeInputprerequisADD".$ii]))
		{
			
			
			$diplome = $_POST["DiplomeInputprerequisADD".$ii] ;
			
			
				
				$sql = "INSERT INTO `filiere_diplomes`(`CODE_DIPLOME`, `CODE_FIL`) VALUES ($diplome,'$idf')";
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
					
					

		}
	}
	
	echo "<meta http-equiv='refresh' content='0' />";	
}

?>


 <?php 
		// $codeDEB = array() ; 			
		// $libelleDEB = array() ; 			
// $SQL="select * from debouche_formation`;";
// $query=mysqli_query($ma_connexion,$SQL);
// while($row=mysqli_fetch_assoc($query))
// {
	
		// $codeDEB[] = $row['CODE_DEBOUCHE_FOR'];
		// $libelleDEB[] = $row['DEBOUCHE_FOR'];
								// }

 ?> 


<!--Formation-->	

<!-- <script>
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
</script> -->
<script>
	$(document).ready(function(event){  
	      var i=1;  
	      $('#ajouter').click(function(){  
	           i++;  
	           $('#tableau').append('<tr id="row'+i+'"><td><input type="text" class="form-control" id="inputEmail3" placeholder="Semèstre"></td><td><input type="text" class="form-control" id="inputEmail3" placeholder="Nom Module"></td><td><input type="number" class="form-control" id="inputEmail3" placeholder="Volume global Module"></td><td><input type="text" class="form-control" id="inputEmail3" placeholder="Nom coordonnateur"></td><td><input type="text" class="form-control" id="inputEmail3" placeholder="Prénom coordonnateur"></td><td><input type="password" class="form-control" id="inputEmail3" placeholder="Code compte"></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td></tr>');
	      	});
	      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
	     });
</script>
<!--/Formation-->
<!--Débouche-->	
<script>
	$(document).ready(function(event){  
	      var i=1;  
	      $('#ajouter1').click(function(){  
	           i++;  
	           $('#tableau1').append('<tr id="row'+i+'"><td><input type="text" class="form-control" id="inputEmail3" placeholder="Débouche"></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td> </tr>');
	      	});
	      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
	     });
</script>
<!--/Débouche-->	
<!--Options-->	
<script>
 var i=1;  
	      $('#ajouterOption').click(function(){  
			     $('#option').append('<div id="row'+i+'"><label class="col-sm-3 control-label"></label> <div class="col-sm-6"> <input id="optionADD'+i+'" type="text" class="form-control"  onblur="testImpossible(this.value,'+i+')" placeholder="Option de la filière" name="new'+i+'" required> </div> <div class="col-sm-3"> <button id="'+i+'" type="button" class="btn btn-danger btn_remove" ><i class="fa fa-trash fa-lg"></i></button> </div> </div> </div>');
           i++;
		  });
	      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
		 
		 var  valtest ;
		 var toind ;
		 	function testImpossible(e,H) {
			// alert(es);
				
				toind = '<?php echo $ind1 ; ?>' ; 
				for (var x=2 ; x< i ; x++)
				{
					if (x != H) 
					{
						valtest = $("#optionADD"+x).val();
						if (valtest.toUpperCase() == e.toUpperCase())
						{
							swal(
							  'Oups...',
							  'les options doivent etres uniques !',
							  'error'
							)
							$("#optionADD"+H).val($("#optionADD"+H).val().slice(0, -1));
						}
					}
				}
				
				var dataString2 =  'nomOption='+ e ; 
				$.ajax
					({
						type: "POST",
						url: "get_TEST_nom_option.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							if (html == 1 )
							{
								swal(
								  'Attention...',
								  'les options doivent etres uniques !',
								  'warning'
								)
								$("#optionADD"+H).val($("#optionADD"+H).val().slice(0, -1));
								
							}
						}
						
					});	
					
				for (var x=0  ; x< toind ; x++)
				{
						valtest = $("#optionADD"+x).val();
						if (valtest.toUpperCase() == e.toUpperCase())
						{
							swal(
							  'Oups...',
							  'les options doivent etres uniques !',
							  'error'
							)
							$("#optioninput"+H).val($("#optioninput"+H).val().slice(0, -1));
						}	
				}
			}

			function testImpossibleop(e,H) {

				for (var x=2 ; x< i ; x++)
				{
						valtest = $("#optionADD"+x).val();
						if (valtest.toUpperCase() == e.toUpperCase())
						{
							swal(
							  'Oups...',
							  'les options doivent etres uniques !',
							  'error'
							)
							$("#optioninput"+H).val($("#optioninput"+H).val().slice(0, -1));
						}
				}
				var dataString2 =  'nomOption='+ e ; 
				$.ajax
					({
						type: "POST",
						url: "get_TEST_nom_option.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							if (html == 1 )
							{
								swal(
								  'Attention...',
								  'les options doivent etres uniques !',
								  'warning'
								)
								$("#optioninput"+H).val($("#optioninput"+H).val().slice(0, -1));
								
							}
						}
						
					});	
	
			}
</script>




<script type="text/javascript">
var i=1;
	      
      $('#ajouterDiscpline').click(function(){
        $('#deciplines').append('<div id="row'+i+'" > <label class="col-sm-3 control-label"></label> <div class="col-sm-6"> <input list="cookies3" type="text" class="form-control" id="desciplieADD'+i+'" onblur="testImpossible2(this.value,'+i+')" placeholder="decipline de la filière" name="newd'+i+'"  required> </div> <div class="col-sm-3"> <button id="'+i+'" type="button" class="btn btn-danger btn_remove" ><i class="fa fa-trash fa-lg"></i></button> </div> </div> </div>');
        i++;
			});
	      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#rowd'+button_id+'').remove();  
      }); 
		 
		  var  valtest ;
		 	  function testImpossible2(e,H) {
			// alert(es);
				for (var x=2 ; x< i ; x++)
				{
					if (x != H) 
					{
						valtest = $("#desciplieADD"+x).val();
						if (valtest == e)
						{
							swal(
							  'Oups...',
							  'les desciplines doivent etres uniques !',
							  'error'
							)
							$("#desciplieADD"+H).val($("#desciplieADD"+H).val().slice(0, -1));
						}
					}
				}
					
			}
</script>	
<script>
	$(document).ready(function(event){  
	      var i=1;  
	      $('#ajouter2').click(function(){  
	           i++;  
	           $('#tableau2').append('<tr id="row'+i+'"><td><input type="text" class="form-control" id="inputEmail3" placeholder="Compétence"></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash fa-lg"></i></button></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td></tr>');
	      	});
	      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
	     });
</script>	


<script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
});
</script>
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
			
			
			
			
			
			<script>
			$('#intituleinputbtnactiver').click(function(){  
	           $('#intituleinput').prop('readonly', false);		           
			 });
			          
			 $('#Dabtnactiver').click(function(){  
	           $('#Da').prop('readonly', false);	
			 });
			 $('#Dfabtnactiver').click(function(){  
	           $('#Dfa').prop('readonly', false);	
			 });
			 $('#diplomeinputbtnactiver').click(function(){  
	           $('#diplomeinput').attr("readonly", false); 
			 });
			 $('#specialitebtnactiver').click(function(){  
	           $('#specialiteinout').prop('readonly', false);	
			 });
			  $('#univActiver').click(function(){  
	           $('#universite').attr("readonly", false); 	
			 });
			  $('#etablActiver').click(function(){  
	           $('#etablissment').attr("readonly", false); 	
			 });
			  $('#deptActiver').click(function(){  
	           $('#departementInput').attr("readonly", false); 	
			 });
			 
			 
			  $('#activerobjectif').click(function(){  
	           $('#objectiformation').prop('readonly', false);	
			 });
			  $('#activercondition').click(function(){  
	           $('#conditionacceprerequis').prop('readonly', false);	
			 });
			  $('#activeraccee').click(function(){  
	           $('#acceepasserelle').prop('readonly', false);	
			 });
			 
			    
			
			$('#intituleinputbtnvider').click(function(){  
	           $('#intituleinput').prop('readonly', false);
	           $('#intituleinput').val('');			   
	           $('#intituleinput').prop('readonly', true);	
			 });
			 
			 $('#Dabtnvider').click(function(){  
	           $('#Da').prop('readonly', false);
	           $('#Da').val('');			   
	           $('#Da').prop('readonly', true);	
			 });
			 
			 $('#Dfabtnvider').click(function(){  
	           $('#Dfa').prop('readonly', false);
	           $('#Dfa').val('');			   
	           $('#Dfa').prop('readonly', true);	
			 });
			 
			 $('#diplomeinputbtnvider').click(function(){  
	           $('#diplomeinput').prop('readonly', false);
	           $('#diplomeinput').val('');			   
	           $('#diplomeinput').prop('readonly', true);	
			 });
			 
			 $('#univVider').click(function(){  
	           $('#universite').prop('readonly', false);
	           $('#universite').val('');			   
	           $('#universite').prop('readonly', true);	
			 });
			  $('#etablVider').click(function(){  
	           $('#etablissment').prop('readonly', false);
	           $('#etablissment').val('');			   
	           $('#etablissment').prop('readonly', true);	
			 });
			 
			  $('#deptVider').click(function(){  
	           $('#departementInput').prop('readonly', false);
	           $('#departementInput').val('');			   
	           $('#departementInput').prop('readonly', true);	
			 });
			 
			 
			
			 
			 
			 $('#specialitebtnvider').click(function(){  
	           $('#specialiteinout').prop('readonly', false);
	           $('#specialiteinout').val('');			   
	           $('#specialiteinout').prop('readonly', true);	
			 });
			</script>
			
			
			<script>
			
			
			function createCallback( i ){
			  return function(){
				var txt2 = "#debouvheinput"+i ; 
				$(txt2).prop('readonly', false);
			  }
			}
			
			function createCallbackcmp( i ){
			  return function(){
				var txt2 = "#competanceinput"+i ; 
				$(txt2).prop('readonly', false);
			  }
			}
			
			function createCallbackeffec( i ){
			  return function(){
				var txt2 = "#promoinput"+i ; 
				$(txt2).prop('readonly', false);
			  }
			}
			
			
			
			function createCallback2(i,bdk ){
			  return function(){
				 
						
						 $.confirm({
                                            title: 'Cela peut être critique',
                                            content: 'vous voulez vraiment supprimer ce debouch .',
                                            icon: 'fa fa-warning',
                                            animation: 'zoom',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'OUI, BIEN SURE!',
                                                    btnClass: 'btn-warning',
                                                    action: function () {
														var x = document.createElement("input");
														x.setAttribute("type", "hidden");
														x.setAttribute("name", "deletedebouche"+bdk);
														var txty = 'savemylife'+bdk;
														var valsave = document.getElementById(txty).value;
														x.setAttribute("value", valsave);													
														$('#lesdelete').append(x);
														
                                                        var row = document.getElementById(i);
														var table = row.parentNode;
														while ( table && table.tagName != 'TABLE' )
															table = table.parentNode;
														if ( !table )
															return;
														table.deleteRow(row.rowIndex);
                                                    }
                                                },
                                                cancel: function () {
                                                   
                                                }
                                            }
                                        });
				   
                                       
                                  
				
			  }
			}
			
			
			
			function createCallback2cmp(i,bdk ){
			  return function(){
				 
						
						 $.confirm({
                                            title: 'Cela peut être critique',
                                            content: 'vous voulez vraiment supprimer cet competance .',
                                            icon: 'fa fa-warning',
                                            animation: 'zoom',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'OUI, BIEN SURE!',
                                                    btnClass: 'btn-warning',
                                                    action: function () {
														var x = document.createElement("input");
														x.setAttribute("type", "hidden");
														x.setAttribute("name", "deletecompetance"+bdk);
														var txty = 'savemylifecmp'+bdk;
														var valsave = document.getElementById(txty).value;
														x.setAttribute("value", valsave);													
														$('#lesdelete2').append(x);
														
                                                        var row = document.getElementById(i);
														var table = row.parentNode;
														while ( table && table.tagName != 'TABLE' )
															table = table.parentNode;
														if ( !table )
															return;
														table.deleteRow(row.rowIndex);
                                                    }
                                                },
                                                cancel: function () {
                                                   
                                                }
                                            }
                                        });
				   
                                       
                                  
				
			  }
			}
			//btn activer & supprimer debouche
			$(document).ready(function(){
			var nb = '<?php echo $inddebouche ; ?>' ; 
			  for(var i = 0; i < nb; i++) {
				  var txt1 = "#activerdebouche"+i ;
				  var txt2 = "#supprimerdebouche"+i ;
				$(txt1).click( createCallback( i ) );
				var k = "rowdebouche"+i
				$(txt2).click( createCallback2( k,i ) );
			  }
			});
			
			//btn activer & supprimer competance
			$(document).ready(function(){
			var nb2 = '<?php echo $indcompetance ; ?>' ; 
			  for(var i = 0; i < nb2; i++) {
				  var txt1 = "#activercompetance"+i ;
				  var txt2 = "#supprimercompetance"+i ;
				$(txt1).click( createCallbackcmp( i ) );
				var k = "rowcompetance"+i
				$(txt2).click( createCallback2cmp( k,i ) );
			  }
			});
			
			
			//btn activer effectif
			$(document).ready(function(){
			var nb2 = '<?php echo $ideffectif ; ?>' ;    
			  for(var i = 0; i < nb2; i++) {
				  var txt1 = "#activereffec"+i ;
				$(txt1).click( createCallbackeffec( i ) );
				
			  }
			});
			
			
			//btn activer new debouche 
			 function createCallbackadd( i ){			 
				var txt2 = "#newdebinput"+i ; 
				$(txt2).prop('readonly', false);			 
			}
			
			//btn activer new competance
			function createCallbackaddcmp( i ){
				var txt2 = "#newcompinput"+i ; 
				$(txt2).prop('readonly', false);
			  
			}
					
			function createCallback2effec(bdk,i ){
					
						 $.confirm({
                                            title: 'Cela peut être critique',
                                            content: 'vous voulez vraiment supprimer cet effectif .',
                                            icon: 'fa fa-warning',
                                            animation: 'zoom',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'OUI, BIEN SURE!',
                                                    btnClass: 'btn-warning',
                                                    action: function () {
														var x = document.createElement("input");
														x.setAttribute("type", "hidden");
														x.setAttribute("name", "deleteeffectif"+bdk);
														var txty = 'savepromoinput'+bdk;
														var valsave = document.getElementById(txty).value;
														x.setAttribute("value", valsave);													
														$('#lesdelete3').append(x);
														
                                                        $( i ).remove();
                                                    }
                                                },
                                                cancel: function () {
                                                   
                                                }
                                            }
                                        });
			}
			
			function deleetnewpromoadd( i )
			{
				$( i ).remove();
			}

			 var ikdpromo=1; 
			 var savepromocount = '<?php echo $ideffectif ; ?>' ; 
				savepromocount++ ; 
				
				
			$('#newpromoddbtn').click(function(){ 
			
				 $.confirm({
					title: 'NOUVELLE PROMOTION!',
					content: '' +
					'<form action="" class="formName">' +
					'<div class="form-group">' +
					'<label>Entrer leffectifs </label>' +
					'<input type="number" placeholder="effectif" class="name form-control" required />' +					
					'</div>' +
					'</form>',
					buttons: {
						formSubmit: {
							text: 'Ajouter',
							btnClass: 'btn-blue',
							action: function () {
								 
								 
								var name = this.$content.find('.name').val();
								
								if (name.trim() == '' )
									name = 0 ; 
								
								$('#effectaddpromo').append(' <div class="form-group" id="row'+ikdpromo+'" ><label for="inputEmail3" class="col-sm-4 control-label"> '+savepromocount+'éme promotion</label> <td><button id="activereffecnew'+ikdpromo+'" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg"></i></button></td> <td><button ondblclick="deleetnewpromoadd(row'+ikdpromo+')"  type="button" class="btn btn-default"><i class="fa fa-trash fa-lg"></i></button></td> <div class="col-xs-4"><input  readonly="readonly" type="number" class="form-control" id="promoinputNEW'+ikdpromo+'"  name="promoinputNEW'+ikdpromo+'" value="'+name+'" > </div>	</div>	');
								 ikdpromo++ ; 
								 savepromocount++ ; 
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
         
			 });

			//les button 
			function activerinputmodule(i)
			{
				$("#semestreinput"+i).attr("readonly", false); 
				$("#moduleinput"+i).prop('readonly', false);
				$("#volumeinput"+i).prop('readonly', false);
				$("#cordonateurInput"+i).attr("readonly", false); 
			} 
			function deleteOptionFil()
			{
					var idfil_foropt= '<?php echo $idf ; ?>' ; 
					var dataString = 'idfil_foropt='+ idfil_foropt;
					$.ajax
					({
						type: "POST",
						url: "RemplirOptionDescip.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#supprimerOptionList").html(html);
						}
					});
					
				$("#supprimerOption").modal("show");
				
			} 
			
			function deletemotcle()
			{
					var idfil_foropt= '<?php echo $idf ; ?>' ; 
					var dataString = 'idfil_foropt='+ idfil_foropt;
					$.ajax
					({
						type: "POST",
						url: "Remplirmotclefil.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#supprimermotcleList").html(html);
              // window.location.reload();
						}
					});
					
				$("#supprimerMotcles").modal("show");
				
			} 
			function deleteDisciplineFil()
			{
				var idfil_fordescip= '<?php echo $idf ; ?>' ; 
					var dataString = 'idfil_fordescip='+ idfil_fordescip;
					$.ajax
					({
						type: "POST",
						url: "RemplirOptionDescip.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#supprimerDeciplineList").html(html);
						}
					});
					
				$("#supprimerDecipline").modal("show");
				
			} 

			function activerinputmodulenew(i)
			{
				$("#newsestreinput"+i).prop('readonly', false);
				$("#newmoduleinput"+i).prop('readonly', false);
				$("#newvolumeinput"+i).prop('readonly', false);
				$("#newCordonateur"+i).attr("readonly", false); 
			}    
			
			function supprimerinputmodule(bdk,i ){
					
						 $.confirm({
                                            title: 'Cela peut être critique',
                                            content: 'vous voulez vraiment supprimer ce module .',
                                            icon: 'fa fa-warning',
                                            animation: 'zoom',
                                            closeAnimation: 'zoom',
                                            buttons: {
                                                confirm: {
                                                    text: 'OUI, BIEN SURE!',
                                                    btnClass: 'btn-warning',
                                                    action: function () {
														var x = document.createElement("input");
														x.setAttribute("type", "hidden");
														x.setAttribute("name", "deletemodule"+bdk);
														var txty = 'savemylifmodule'+bdk;
														var valsave = document.getElementById(txty).value;
														x.setAttribute("value", valsave);													
														$('#lesdelete4').append(x);
														
                                                         $( i ).remove();
                                                    }
                                                },
                                                cancel: function () {
                                                   
                                                }
                                            }
                                        });
			}

			</script>
			
		
		
		<script type="text/javascript">
		$(function() {
			$("#submitcommentaire").click(function() {
				var textcontent = $("#contentcomment").val();
				var idfil = '<?php echo $idf ; ?>' ; 
				var dataString = 'content='+ textcontent + '&idfil='+ idfil ;
				if(textcontent=='')

					{
					alert("Enter some text..");
					$("#contentcomment").focus();
					}
				else
					{			
						$.ajax({
							type: "POST",
							url: "commentajax.php",
							data: dataString,
							cache: true,
							success: function(html){
								swal(
										'MODIFIED!',
										'LE COMMENTAIRE A BIEN ETE MODIFIE.',
										'success'
									  )
							$("#contentcomment").prop('readonly', true);;
							}  
						});
					}
				return false;
			});
		});
		
		
		
		</script>
		
		<script>
		
		$("#universite").change(function()
				{
					var id=$(this).val();
					var dataString = 'id='+ id;
					$.ajax
					({
						type: "POST",
						url: "../LES-GET/get_etablissement.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#etablissment").html(html);
						}
					});
				});
				
		
		</script>
		
		<script>
		function getvalChange(sel)
			{
					var id= sel.value ; 
					var dataString = 'id='+ id;
					$.ajax
					({
						type: "POST",
						url: "../LES-GET/getDepartement.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#departementInput").html(html);
						}
					});
			}
		</script>
		
		<script>
		
		$("#domaineadd").change(function()
				{
					var id=$(this).val();
					var filiereActive = '<?php echo $idf ; ?>' ; 
					var dataString = 'id='+ id  + '&filiereActive=' + filiereActive  ;
					$.ajax
					({
						type: "POST",
						url: "getdebouchepardomaine.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#deboucheadd").html(html);
						}
					});
				});
		
		</script>
		
		
		
		<script>
		
		$("#domaineadd2").change(function()
				{
					var dom1=$(this).val();
					var filiereActive = '<?php echo $idf ; ?>' ; 
					var source_comp1=$('input[name=source_exi]:checked').val();
					var dataString = 'dom1='+ dom1  + '&filiereActive=' + filiereActive +'&source_comp1='+source_comp1;
					$.ajax
					({
						type: "POST",
						url: "autoc_comp.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#motcle_comp").html(html);
						}
					});
				});
		
		</script>
		
		<script>
		
		$("#diplomeaddindice").change(function()
				{
					var id=$(this).val();
					var filiereactive='<?php echo $idf ; ?>' ; 
					var dataString = 'id='+ id + '&filiereactive='+ filiereactive  ;
					$.ajax
					({
						type: "POST",
						url: "NEWgetTEST2.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#diplomeaddselect").html(html);
						}
					});
				});
			
		$("#Prerequisaddindice").change(function()
				{
					var id=$(this).val();
					var filiereactive='<?php echo $idf ; ?>' ; 
					var dataString = 'id='+ id + '&filiereactive='+ filiereactive  ;
					$.ajax
					({
						type: "POST",
						url: "getPrerequisParDomaine.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#Prerequisaddselect").html(html);
						}
					});
				});		
				
				
				
		
		</script>
			
      
		<script type="text/javascript">
		$(function() {
			$("#envoicomment").click(function() {
				var textcontent = $("#commentText").val();
				var idfil = '<?php echo $idf ; ?>' ; 
				var user = '<?php echo $codeCoordonateur ; ?>' ; 
				var nomrepond = '<?php echo $nom ; echo ' ' ; echo $prenom ;  ?>' ; 
				var taswira = '<?php echo $imagecoord ; ?>' ; 
				
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

				var dataString = 'content='+ textcontent + '&idfil='+ idfil  + '&user='+ user  ;
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
									  $('#lesscommments').append('<li class="media"><div class="comment"><a href="#" class="pull-left"><img src="../images/'+taswira+'" alt="" class="img-circle" style="width: 60;width: 65px;height: 65px;" ></a><div class="media-body" style="width: 60;width: 65px;height: 65px;" > <strong class="text-success">'+nomrepond+'</strong><span class="text-muted"> <small class="text-muted">'+dateADD +' '+ timeADD+'</small></span><p>'+textcontent+'</p></div><div class="clearfix"></div> </div></li>	 ');
									  
							}

						});
					}
				return false;
			});
		});
		
		
		
		</script>
		
		<script type="text/javascript">
		
		var indLike = 0 ; 
		var indDisLike = 0 ; 
		
		
		function fonctionjame( i , liked ,idComment)
		{
			if (document.getElementById("neJaimePas"+i).style.color != "#93a46dcc" )
			{
				if (document.getElementById("jaimme"+i).style.color == "red" )
				{
					 $("#jaimme"+i).css("color","#333333");	
					 $("#lesLikes"+i).text(liked - 1);

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 2 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
							data: dataString,
							cache: true,
							success: function(html){
					 
							}
					 
							});
					 
					
					
				}
				else{
					 $("#jaimme"+i).css("color","red");	
					 $("#lesLikes"+i).text(liked);

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 0 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
							data: dataString,
							cache: true,
							success: function(html){
					 
							}
					 
							});
				}
			}
			else{
				
				
				
					 $("#neJaimePas"+i).css("color",black);	
					 $("#jaimme"+i).css("color","red");	
					 $("#lesLikes"+i).text(liked + 1);
					 
					 $("#lesDisLikes"+i).text($("#lesLikes"+i).val() - 1);

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 0 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
							data: dataString,
							cache: true,
							success: function(html){
					 
							}
					 
							});
				
			}
			
		}
		
		
		function fonctionNojame( i , liked ,idComment)
		{
			if (document.getElementById("jaimme"+i).style.color != "red" )
			{
				if (document.getElementById("neJaimePas"+i).style.color == "#93a46dcc" )
				{
					 $("#neJaimePas"+i).css("color","#333333");	
					 $("#lesDisLikes"+i).text(liked - 1);

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 2 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
							data: dataString,
							cache: true,
							success: function(html){
					 
							}
					 
							});
					 
					
					
				}
				else{
					 $("#neJaimePas"+i).css("color","#93a46dcc");	
					 $("#lesDisLikes"+i).text(liked + 1);

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 1 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
							data: dataString,
							cache: true,
							success: function(html){
					 
							}
					 
							});
				}
			}
			else{
				
				
				
					$("#jaimme"+i).css("color","#333333");	
					 $("#neJaimePas"+i).css("color","#93a46dcc");	
					 
					 $("#lesDisLikes"+i).text(liked + 1);
					 $("#lesLikes"+i).text($("#lesLikes"+i).val() );

						
					 var user = '<?php echo $codeCoordonateur ; ?>' ; 
					 var vallLike = 1 ; 
					 var dataString = 'idComment='+ idComment + '&vallLike='+ vallLike + '&user='+ user  ;
					 $.ajax({
							type: "POST",
							url: "updateComment.php",
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
								var user = '<?php echo $codeCoordonateur ; ?>' ; 
								var taswira = '<?php echo $imagecoord ; ?>' ; 
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

								var dataString = 'idComment='+ idComment + '&user='+ user + '&textcontent='+ textcontent  ;
								
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
												
												$("#lesReplays"+i).append('<li class="media"><div class="comment"><a href="#" class="pull-left"><img src="../images/'+taswira+'" alt="" class="img-circle" style="width: 60;width: 65px;height: 65px;" ></a><div class="media-body"><strong class="text-success">'+nomrepond+'</strong><span class="text-muted"><small class="text-muted">'+dateADD +' '+ timeADD+'</small></span><p style=" text-align: justify;">'+textcontent+'</p> </div><div class="clearfix"></div></div></li> ');
														  
						
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

		<script>
		var expodate = '' ; 
$('#Da').keyup(function(e) 
		  {
			  
			  
			  var k =  $('#Da').val().split("-"); 
			  var newY = parseInt(k[0])+4 ; 
			  
			  if (newY != 'undefined' && k[1] != 'undefined' && k[2] != 'undefined' )
				var expodate = newY +'-'+k[1]+'-'+k[2] ;  
				
			
			  $('#Dfa').val(expodate) ;
				
			});			
	
		
</script>


<script>
$( document ).ready(function() {
	
			var chart;
			var legend;
			var nb ; 
			var chartData = [];
			var xxxx ; 	
			var yyyy ;
			var zzzz ;
			
			

            AmCharts.ready(function () {
				
				nb = '<?php echo $kkk ; ?>' ; 	
			
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
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
                chart.colors = ["#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6"];
                chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick
				}] ;
				
                // chart.backgroundColor = "fcd202";
                // chart.baseColor = "#fafafa";
                // chart.borderColor = "#000000";
				 
                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv1");
				
				
				

			function myCustomClick(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				var res = country[0] + country[9] ;
				// alert(res);
				var id= res ; 
				var idfil= '<?php echo $idf ; ?>' ; 
				var dataString = 'idsemestre='+ id + '&idfil='+ idfil;
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MODULES DE SEMESTRE ",
						  html: html,
						  
						});
						
					}
				});
				
				
			}
				
				
			
				
				chartData = [];
				nb = '<?php echo $kkksem1 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem1"+xxxx ; 
					zzzz = "matsem1"+xxxx+"v" ; 
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
                chart.colors = ["#27ae60", "#2980b9", "#ecf0f1", "#95a5a6"];
				  chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick1
				}] 

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv2");
				
				
				function myCustomClick1(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				
				// alert(res);
				var id= country ; 
				var idfil= '<?php echo $idf ; ?>' ; 
				var dataString = 'idmodule='+ id + '&idfil='+ idfil;
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MATIERES DU MODULE ",
						  html: html,
						  
						});
						
					
						
					}
				});
				
				
			}
				
				
				chartData = [];
				nb = '<?php echo $kkksem2 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem2"+xxxx ; 
					zzzz = "matsem2"+xxxx+"v" ; 
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#27ae60", "#2980b9", "#ecf0f1", "#95a5a6"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick1
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv3");
				
				
				
				chartData = [];
				nb = '<?php echo $kkksem3 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem3"+xxxx ; 
					zzzz = "matsem3"+xxxx+"v" ; 
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#27ae60", "#2980b9", "#ecf0f1", "#95a5a6"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick1
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv4");

           
				chartData = [];
				nb = '<?php echo $kkksem4 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem4"+xxxx ; 
					zzzz = "matsem4"+xxxx+"v" ; 
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#27ae60", "#2980b9", "#ecf0f1", "#95a5a6"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick1
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv5");
				
			
			
			chartData = [];
				nb = '<?php echo $kkksem_mat1 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem_mat1"+xxxx ; 
					zzzz = "matsem_mat1"+xxxx+"v" ; 
					
	
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#1abc9c", "#2ecc71", "#34495e"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick2_S1
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv6");
				
				
			function myCustomClick2_S1(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				
				// alert(res);
				
				var idfil= '<?php echo $idf ; ?>' ; 
				var id ; 
				if (country == 'matieres de base' )
					id = 1 ; 
				else if (country == 'matieres de specialite' )
					id= 2 ; 
				else
					id= 0 ; 
					
				var dataString = 'idtypecour='+ id + '&idfil='+ idfil + '&idsemestre=S1';
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MATIERES DU MODULE ",
						  html: html,
						  
						});
						
					
						
					}
				});
				
				
			}
				
				
				
				
				
				
				
				chartData = [];
				nb = '<?php echo $kkksem_mat2 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem_mat2"+xxxx ; 
					zzzz = "matsem_mat2"+xxxx+"v" ; 
					
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#1abc9c", "#2ecc71", "#34495e"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick2_S2
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv7");
				
				
			function myCustomClick2_S2(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				
				// alert(res);
				
				var idfil= '<?php echo $idf ; ?>' ; 
				var id ; 
				if (country == 'matieres de base' )
					id = 1 ; 
				else if (country == 'matieres de specialite' )
					id= 2 ; 
				else
					id= 0 ; 
					
				var dataString = 'idtypecour='+ id + '&idfil='+ idfil + '&idsemestre=S2';
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MATIERES DU MODULE ",
						  html: html,
						  
						});
						
					
						
					}
				});
				
				
			}
				
				chartData = [];
				nb = '<?php echo $kkksem_mat3 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem_mat3"+xxxx ; 
					zzzz = "matsem_mat3"+xxxx+"v" ; 
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#1abc9c", "#2ecc71", "#34495e"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick2_S3
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv8");
				
				
			function myCustomClick2_S3(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				
				// alert(res);
				
				var idfil= '<?php echo $idf ; ?>' ; 
				var id ; 
				if (country == 'matieres de base' )
					id = 1 ; 
				else if (country == 'matieres de specialite' )
					id= 2 ; 
				else
					id= 0 ; 
					
				var dataString = 'idtypecour='+ id + '&idfil='+ idfil + '&idsemestre=S3';
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MATIERES DU MODULE ",
						  html: html,
						  
						});
						
					
						
					}
				});
				
				
			}	
				
				
				chartData = [];
				nb = '<?php echo $kkksem_mat4 ; ?>' ; 	
			
				for(var ii = 0; ii < (nb - 1 ) ; ii++)
				{
					xxxx = ii + 1 ; 
					yyyy = "matsem_mat4"+xxxx ; 
					zzzz = "matsem_mat4"+xxxx+"v" ; 
					
					
					chartData[ii] = {
						"country" :  document.getElementById(yyyy).value , 
						"visits" : document.getElementById(zzzz).value 
					}
					
		
				}
                	 
				chart = new AmCharts.AmPieChart();

                // title of the chart

                chart.dataProvider = chartData;
                chart.titleField = "country" ;
                chart.valueField = "visits";
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 17;
				chart.colors = ["#1abc9c", "#2ecc71", "#34495e"];
				chart.listeners = [{
					"event": "clickSlice",
					"method": myCustomClick2_S4
				}] 
                

                chart.balloonText = "[[title]] <br><span style='font-size:14px' ><b>[[value]] heures </b> ([[percents]]%) </span>";
            
						
				// the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write("chartdiv9");
				
				
				function myCustomClick2_S4(e) {
				var country = e.dataItem.dataContext.country;
				// alert("You have clicked " + country + ".");
				
				
				// alert(res);
				
				var idfil= '<?php echo $idf ; ?>' ; 
				var id ; 
				if (country == 'matieres de base' )
					id = 1 ; 
				else if (country == 'matieres de specialite' )
					id= 2 ; 
				else
					id= 0 ; 
					
				var dataString = 'idtypecour='+ id + '&idfil='+ idfil + '&idsemestre=S4';
				// alert(dataString);
				$.ajax
				({
					type: "POST",
					url: "getResultchart.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						// var res = html.split("!!"); 
						var res = '<br/>' +html  ;
						swal({
						  title: "LES MATIERES DU MODULE ",
						  html: html,
						  
						});
						
					
						
					}
				});
				
				
			}	

            });

});
           
        </script>
		
</script>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../js/jquery-confirm.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/indicateurs.js"></script>


</body>
</html>
