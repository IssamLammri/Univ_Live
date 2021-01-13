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
    <title>suivie </title>
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
                         <a  href="accreditaion.php"><i class="fa  fa-cogs fa-3x"></i> Gestion des Comptes </a>
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
                       <label>Select universite</label>
                       <select class="form-control" id="universite">
						   <?php
								remplir_university();
						   ?>
						  </select>
                 </div>
				 
				 <div class="form-group">
                       <label>Select etablissement</label>
                       <select class="form-control" id="etablissement">
						  <option value="" disabled selected>Merci de choisir l'etablissement </option>
						 </select>
                 </div>
				 
				 
				 <div class="form-group">
                       <label>Select departement</label>
                       <select class="form-control" id="departement">
						  <option value="" disabled selected>Merci de choisir l'departement </option>
						 </select>
                 </div> 
				 
				 <div class="form-group">
                      
                       <a href="#"  onclick="getResult()" class="btn btn-primary form-control"> Lancer la recherche &nbsp&nbsp
					   <i class="fa fa-search" name="recherche"></i>
					   </a>
                 </div>
             </div>
             
         </div>
           
		     <form method="POST" id="switchTOfil" action="../Coordonateur_filiere/ListeF.php"> 
		     <div class="panel panel-default">
                       
                        <div class="panel-heading">
                            RESULTAT RECHERCHE
                        </div>
                        
                        <div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover"   id="tabsave">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">#</th>
                                            <th>Université</th>
                                            <th>Etablissment</th>
                                            <th>Filière</th>
                                            <th>Progession</th>
                                            <th>Etat</th>
                                            <th>Statistiques</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result_ajax">
									
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
			  </form>
			  
			  <!-- /.  <input type="hidde" name="saveIDfil"i="saveIDfil" />   -->
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
	
	
	<script>
	function hello(idfil,idcoord)
	{
		dataString = 'idfil=' +idfil + '&idcord=' +idcoord ;
		alert(dataString);
		$.ajax
		({
			type: "POST",
			url: "switchID.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				
				document.getElementById("switchTOfil").submit();

			}
		});
		
		// alert(dataString) ; 
		
		
		
		
	}
	var indCOLOR = 0 ; 
	var indcompteur = 1 ; 
	var classSW = ["success", "info", "warning", "danger"];
	function getResult()
	{
				
				var dataString = 'id_dept='+ $("#departement").val() + '&color=' + classSW[indCOLOR] + '&nom_univ='+ $("#universite :selected").text() + '&nom_etab='+ $("#etablissement :selected").text()+ '&indcompteur='+ indcompteur; 
				
				$.ajax
				({
					type: "POST",
					url: "SUIVIE_AJAX/result_t.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#result_ajax").append(html);
						indcompteur ++ ; 

					}
				});
				
				indCOLOR++ ; 
				if(indCOLOR == 4)
					indCOLOR = 0 ; 
	}
	
	</script>
	
    
   
</body>
</html>



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


