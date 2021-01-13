<!DOCTYPE html>
<?php
session_start();
if ( !isset($_SESSION['admin'])){
	header('Location: ../login/login.php');
}

include '../connexion.php';
include 'REMPLISSAGE.php';

?>
<?php
if ( isset($_POST['Deconnexion'])){
session_unset() ;
session_destroy() ;
header('Location: ../login/login.php');
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion des comptes </title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- NEW STYLE-->
   <link rel="stylesheet" type="text/css" href="../css/NEWstyleTAB.css">	
   <!-- Sweet alert-->
   <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css"> 
   <link rel="stylesheet" type="text/css" href="../css/AdminLTE.min.css"> 
   
    <!-- data table-->
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   
   
   
</head>
<body>
    <div id="wrapper">
	<nav class="navbar-default navbar-side" role="navigation" style="position: fixed;">
			 
                <a class="navbar-brand form-control"  style="text-align: center; background-color: #A70303; color: #fff;font-size: 30px; font-weight: 700; "href="admin.php">admin</a> 
           
            <div class="sidebar-collapse" >
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
					
                    <li>
                        <a class="active-menu"  href="admin.php"><i class="fa fa-user-plus fa-3x"></i> CREATION DES COMPTES</a>
                    </li>
					
					 <li>
                        <a href="Gestion.php#GESION_VILLE"><i class="fa fa-sitemap fa-3x"></i> GESTION ADMINISTRATIF <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="Gestion.php#GESION_VILLE">Gestion des Villes </a>
                            </li>
                            <li>
                                <a href="Gestion.php#GESION_University">Gestion des University </a>
                            </li>
							<li>
                                <a href="Gestion.php#GESION_Etablissmenet">Gestion des Etablissmenets</a>
                            </li>
                            <li>
                                <a href="Gestion.php#GESION_Departement">Gestion des Departements</a>
                            </li>
                            <li>
                                <a href="Gestion.php#GESION_Domaines">Gestion des Domaines</a>
                            </li>
                            <li>
                                <a href="Gestion.php#GESION_Diplomes">Gestion des Diplomes</a>
                            </li>
							<li>
                                <a href="Gestion.php#GESION_Grades">Gestion des Grades</a>
                            </li>
							<li>
                                <a href="Gestion.php#GESION_Specialite">Gestion des Specialites</a>
                            </li>
							
                            
                        </ul>
                     </li>  
                     <li>
                        <a  href="suivie.php"><i class="fa  fa-line-chart fa-3x"></i> SUIVIE</a>
                    </li>
                    <li>
                        <a  href="accreditaion.php"><i class="fa fa-cogs fa-3x"></i> Gestion des comptes </a>
                    </li>
						  
					                   
                   
                  
                </ul>
               
            </div>
            
        </nav> 
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
          <form method="POST" > 
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Derniere connexion : 30 Mars 2017 &nbsp; <input type="submit" class="btn btn-danger square-btn-adjust"  value="Deconnexion" name="Deconnexion"> </input> </div>
      </form>  
		</nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		
		 <div class="panel panel-primary">
             <div class="panel-heading">
                 RECHERCHE
             </div>
             <div class="panel-body">
			   <div class="form-group">
                       <label>Select type compte </label>
                       <select class="form-control" id="typeCompte">
						    <option value="" disabled selected>Merci de choisir le type du compte </option>
						    <option value="CD"> Chef département </option>
						    <option value="CF"> Coordonnateur Filière </option>
						    <option value="CM"> Coordonnateur Module </option>
						    <option value="ENS"> Enseignant </option>
						  </select>
                 </div>
				 
				  <div class="form-group">
                      
                       <a href="#"  onclick="getResult()" class="btn btn-primary form-control"> Lancer la recherche &nbsp&nbsp
					   <i class="fa fa-search" name="recherche"></i>
					   </a>
                 </div>
				 
				
             </div>
             
         </div>
           
		   
		     <div class="panel panel-default">
                       
                        <div class="panel-heading">
                            RESULTAT RECHERCHE
                        </div>
                        
                        <div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover"   id="result_shearch">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">#</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
											<th>Universite</th>
                                            <th>Etablissment</th>
                                            <th>Département</th>								
                                            <th>PLUS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result_ajax">
									
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
			  
         <!-- /. PAGE WRAPPER  -->
        </div>
		
		
		
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
     <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	 <!-- SWEET ALERT -->
    <script src="../js/sweetalert2.min.js"></script>	
	
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
   <script>
            $(document).ready(function () {
                $('#result_shearch').dataTable();
            });
    </script>
	
	<script type="text/javascript">
		
			$("#universite").change(function()
			{
				var id=$(this).val();
				//alert(id);
				var dataString = 'id='+ id;
				$.ajax
				({
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
				$.ajax
				({
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

		
	</script>
	

		
    
   
</body>
</html>
<div class="modal fade" id="infoporfile" role="dialog">
		<div class="modal-dialog" style="margin-top: 200px;">
		<form action="" class="formName">
		  <!-- Modal content-->
	
			
			
			
		
			
			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua-active">
				  <h3 class="widget-user-username"><span id="nomProfile"></span> </h3>
				  <h5 class="widget-user-desc"><span id="typeProfile"></span> </h5>
				</div>
				<div class="widget-user-image" id="imageProfile">
				  
				</div>
				<div class="box-footer">
				  <div class="row">
					<div class="col-sm-4 border-right">
					  <div class="description-block">
						<h5 class="description-header">Grade</h5>
						<span class="description-text" id="gradeProfile" > </span>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-4 border-right">
					  <div class="description-block">
						<h5 class="description-header"><span id="valeurTypeaffichege"></span> </h5>
						<span class="description-text" id="typeAffichege" > </span>
						<br><button class="btn btn-primary" id="typeAffichege" style="cursor: pointer;" onclick="affichierinfo()"> detaille</button>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-4">
					  <div class="description-block">
						<h5 class="description-header">Spécialite</h5>
						<span class="description-text" id="specialiteProfile" ></span>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</div>
			</div>
			
		
			
		  </div>
		  </form>
		  
		
		  
		</div>
  </div>



	
	<script>
	
	var info ; 
	var type ; 
	function help(i) 
	{		
							
				var k =  $("#value"+i).val().split("::"); 
				$("#nomProfile").text(k[0]);
				$("#typeProfile").text(k[1]);
				$("#gradeProfile").text(k[2]);
				$("#specialiteProfile").text(k[3]);
				$("#imageProfile").html('<img  class="img-circle" style="width:128 ;height:128 ;" src="../images/'+k[4]+'" alt="image">');
				
				var k2 =  $("#valueADD"+i).val().split("::"); 
				$("#valeurTypeaffichege").text(k2[0]);
				$("#typeAffichege").text(k2[1]);
				info = k2[2] ;
				type = k2[1] ;
			
				$("#infoporfile").modal("show");
	}
	
	
	function  affichierinfo()
	{
		swal({
			  title: " LA LISTE DES " + type.toUpperCase(),
			  html: info,
			  
			});
	}
	function getResult()
	{
				
				var dataString = 'type='+ $("#typeCompte").val()  ; 
				$.ajax
				({
					type: "POST",
					url: "SUIVIE_AJAX/result_t_compte.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#result_ajax").html(html);
						
						

					}
				});
			
				
				
	}
	
	</script>
	















<?php
if (isset($_POST['submit0'])){
if (((!empty($_POST['Uv'] )) and ((!empty($_POST['Et'] ))) and ((!empty($_POST['Dpet'] )))and ((!empty($_POST['Nom'] )) and ((!empty($_POST['Prenom']))) and ((!empty($_POST['Pseudo'])))and ((!empty($_POST['Password'])))))){
$nom=$_POST['Nom'];
$prenom=$_POST['Prenom'];
$pseudo=$_POST['Pseudo'];
$moddepass=$_POST['Password'];
$etab = $_POST['Dpet'] ; 

$sql = " INSERT INTO chef_departement (CODE_DEPT, PSEUDO,PASSWORD,NOM_CHEF,PRENOM_CHEF) VALUES ('$etab','$pseudo','$moddepass','$nom','$prenom') ; "; 
	
	if (mysqli_query($ma_connexion, $sql)) {
		echo "<script >
		
		swal(
				'Ajouter!',
				'LE COMPTE A BIEN ETE AJOUTER.',
				'success'
				) 
				</script> "  ; 

	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
	}
}
else if ( isset($_POST['submit1'])){
if (((!empty($_POST['Uv'] )) and ((!empty($_POST['Et'] ))) and ((!empty($_POST['Dpet'] )))and ((!empty($_POST['Nom'] )) and ((!empty($_POST['Prenom']))) and ((!empty($_POST['Pseudo'])))and ((!empty($_POST['Password'])))))){
$nom=$_POST['Nom'];
$prenom=$_POST['Prenom'];
$pseudo=$_POST['Pseudo'];
$moddepass=$_POST['Password'];
$dept = $_POST['Dpet'] ; 
$etab = $_POST['Et'] ; 

$sql = " INSERT INTO `coordonateur_filiere`(`CODE_ETA`, `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_FIL`, `PRENOM_COR_FIL`)	VALUES ('$etab','$dept','$pseudo','$moddepass','$nom','$prenom') ; "; 
	
	if (mysqli_query($ma_connexion, $sql)) {
		echo "<script >
		
		swal(
				'Ajouter!',
				'LE COMPTE A BIEN ETE AJOUTER.',
				'success'
				) 
				</script> "  ; 

	} else {
		echo "Error updating record: " . mysqli_error($ma_connexion);
	}
	}

}
else if ( isset($_POST['submit2'])){
if (((!empty($_POST['Uv'] )) and ((!empty($_POST['Et'] ))) and ((!empty($_POST['Dpet'] )))and ((!empty($_POST['Nom'] )) and ((!empty($_POST['Prenom']))) and ((!empty($_POST['Pseudo'])))and ((!empty($_POST['Password'])))))){
$nom=$_POST['Nom'];
$prenom=$_POST['Prenom'];
$pseudo=$_POST['Pseudo'];
$moddepass=$_POST['Password'];
$etab = $_POST['Dpet'] ; 

$sql = " INSERT INTO `coordonateur_module`(`CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_MODU`, `PRENOM_COR_MODU`) VALUES ('$etab','$pseudo','$moddepass','$nom','$prenom') ; "; 
	
	if (mysqli_query($ma_connexion, $sql)) {
		echo "<script >
		
		swal(
				'Ajouter!',
				'LE COMPTE A BIEN ETE AJOUTER.',
				'success'
				) 
				</script> "  ; 
	} else {
		echo "Error updating record: " . mysqli_error($ma_connexion);
	}
	}
}
else if ( isset($_POST['submit3'])){
if (((!empty($_POST['Uv'] )) and ((!empty($_POST['Et'] ))) and ((!empty($_POST['Dpet'] )))and ((!empty($_POST['Nom'] )) and ((!empty($_POST['Prenom']))) and ((!empty($_POST['Pseudo'])))and ((!empty($_POST['Password'])))))){
$nom=$_POST['Nom'];
$prenom=$_POST['Prenom'];
$pseudo=$_POST['Pseudo'];
$moddepass=$_POST['Password'];
$etab = $_POST['Dpet'] ; 

$sql = " INSERT INTO `enseignant`(`CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_ENS`, `PRENOM_ENS`) VALUES ('$etab','$pseudo','$moddepass','$nom','$prenom') ; "; 
	
	if (mysqli_query($ma_connexion, $sql)) {
		echo "<script >
		
		swal(
				'Ajouter!',
				'LE COMPTE A BIEN ETE AJOUTER.',
				'success'
				) 
				</script> "  ; 

	} else {
		echo "Error updating record: " . mysqli_error($ma_connexion);
	}
	}
}



?>


