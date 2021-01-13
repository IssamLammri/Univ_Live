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
    <title>admin </title>
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
                        <a  href="suivie.php"><i class="fa fa-line-chart fa-3x"></i> SUIVIE</a>
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
		
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>CREATION  DES COMPTES</h2>   
                        <h5>MERCI BIEN DE CHOISIR LE COMPTE A CREER . </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
            <div class="row">
				<div class="col-md-3 col-sm-6 col-xs-6 changeAdminCompte" onclick="switchDIV('CD')"  >           
					 <div class="panel panel-back noti-box">
						<span class="icon-box bg-color-red set-icon">
							<i class="fa fa-male"></i>
						</span>
						<div class="text-box" >
							<p class="main-text"> Chef département</p>
							<p class="text-muted"> C département </p>
						</div>
					 </div>
				</div>
				 
				<div class="col-md-3 col-sm-6 col-xs-6 changeAdminCompte" onclick="switchDIV('CF')">           
					<div class="panel panel-back noti-box">
						<span class="icon-box bg-color-green set-icon">
							<i class="fa fa-user"></i>
						</span>
						<div class="text-box" >
							<p class="main-text">C Filière</p>
							<br>
							<p class="text-muted">Coordonnateur Filière</p>
						</div>
					 </div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-6 changeAdminCompte" onclick="switchDIV('CM')">           
					<div class="panel panel-back noti-box">
						<span class="icon-box bg-color-blue set-icon">
							<i class="fa fa-user"></i>
						</span>
						<div class="text-box" >
							<p class="main-text">C Module</p>
							<br>
							<p class="text-muted">Coordonnateur Module</p>
						</div>
					 </div>
				 </div>
				 
				<div class="col-md-3 col-sm-6 col-xs-6 changeAdminCompte" onclick="switchDIV('ENS')">           
					<div class="panel panel-back noti-box">
						<span class="icon-box bg-color-brown set-icon">
							<i class="fa fa-user"></i>
						</span>
						<div class="text-box" >
							<p class="main-text">Enseignant</p>
							<br>
							<p class="text-muted">Enseignant</p>
						</div>
					 </div>
				 </div>
			</div>
                 <!-- /. ROW  -->
             <hr />  


			<div class="row">
				<div class="col-sm-12">
                    <div class="panel panel-primary" id="TOhideDIV" style="display: none;">
                        <div class="panel-heading"  id="TOchangeColor" >
                            <span id="divTitleChancge"> Créer Compte chef département </span>
                        </div>
                        <div class="panel-body" style="background-color: #f6f6f6;" >
                            <div class="creer-compte" style="margin-top: 90px;">
								<form class="form-horizontal" id="form" method="POST">
												
										<div class="form-group">
											<label for="universite" class="col-sm-4 control-label">Université</label>
												<div class="col-xs-5">
													<select class="form-control" name="Uv" placeholder="Université" id="universite">
													
														<?php 
																
														remplir_university();

														?> 
														
														
													</select>
												</div>
										</div>
										<div class="form-group">
											<label for="etablissement" class="col-sm-4 control-label">Etablissement</label>
												<div class="col-xs-5">
													<select class="form-control" name="Et" id="etablissement">
														<option value="0" >--select un etablissement--</option>
													</select>
												</div>
										</div>
										<div class="form-group">
											<label for="departement" class="col-sm-4 control-label">Département</label>
												<div class="col-xs-5">
													<select class="form-control" name="Dpet" placeholder="Département" id="departement">
														<option selected="selected">--select un departement--</option>
													</select>
												</div>
										</div>	
										<div class="form-group">
											<label for="nom_ch"  class="col-sm-4 control-label" id="NOM_CHANGE">Nom chef département</label>
												<div class="col-xs-5">
													<input type="text" name="Nom" class="form-control" id="nom_ch" placeholder="Nom chef département">
												</div>	                    
										</div>
									<div class="form-group">
										<label for="prenom_ch" class="col-sm-4 control-label"  id="PRENOM_CHANGE">Prénom chef département</label>
										<div class="col-xs-5">
											<input type="text" name="Prenom" class="form-control" id="prenom_ch" placeholder="Prénom chef département">
										</div>
									</div>
									
										<div class="form-group">
											<label for="universite" class="col-sm-4 control-label">Grade</label>
												<div class="col-xs-5">
													<select class="form-control" name="Grade" placeholder="Grade" id="Grade">
													
														<?php 
																
														remplir_Grade();

														?> 
														
														
													</select>
												</div>
										</div>
										
										
										
											<div class="form-group">
											<label for="universite" class="col-sm-4 control-label">Spécialité</label>
												<div class="col-xs-5">
													<select class="form-control" name="specialite" placeholder="specialite" id="specialite">
													
														<?php 
																
														remplir_Specialite();

														?> 
														
														
													</select>
												</div>
										</div>
									
									
									
									
									
									
									
									

										<div class="form-group">
											<label for="pseudo" class="col-sm-4 control-label">Pseudo</label>
											<div class="col-xs-5">
												<input type="text"  name="Pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
											</div>
										</div>
										<div class="form-group">
											<label for="mdp" class="col-sm-4 control-label">Mot de passe</label>
											<div class="col-xs-5">
												<input type="password" name="Password" class="form-control" id="mdp" placeholder="Mot de passe">
											</div>
										</div>
										
										
										<div class="form-group">
											<label for="mdp" class="col-sm-4 control-label">Confirmer mot de passe</label>
											<div class="col-xs-5">
												<input type="password" name="Password" class="form-control" id="mdpConfirm" placeholder="Mot de passe">
											</div>
										</div>
										<br>
										<div class="form-group">
											<div class="col-xs-5" >
												<button type="button" id="add-user" class="btn btn-default btn-lg btn-block " data-toggle="modal"  style="margin-left: 413px;" data-target="#myModal">Créer</button>
											</div>
										</div>
										
										<br>										    		
								</form>
							</div>                       
						</div>
                        <div class="panel-footer"  id="divFooterChancge">
                            <span id="divFooterChancge">chef département </span>
                        </div>
                    </div>
                </div>
			</div>		
			
               <!-- /. ROW  -->

             <!-- /. PAGE INNER  -->
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
		var indiceToSubmit ;
		function switchDIV( param)
		{	
			 indiceToSubmit = param ; 
			 var div = document.getElementById('TOchangeColor');
				
			if ( param == 'CD')
			{
				div.style.backgroundColor = '#c91515';
				$("#divTitleChancge").text('Créer Compte chef département');
				$("#NOM_CHANGE").text('Nom chef département');
				$("#PRENOM_CHANGE").text('Preom chef département');
				$("#divFooterChancge").text('chef département');
				// $("#add-user").attr("name", "submit0");
				$("#nom_ch").attr("placeholder", "Nom chef departement");
				$("#prenom_ch").attr("placeholder", "Preom chef departement");
				$("#TOhideDIV").show();
			}
			
			if ( param == 'CF')
			{
				div.style.backgroundColor = '#67c046';
				$("#divTitleChancge").text('Créer Compte coordonateur filiere');
				$("#NOM_CHANGE").text('Nom Coordonnateur filiere');
				$("#PRENOM_CHANGE").text('Preom Coordonnateur filiere');
				$("#divFooterChancge").text('Coordonnateur filiere');
				// $("#add-user").attr("name", "submit1");
				$("#nom_ch").attr("placeholder", "Nom coordonateur filiere");
				$("#prenom_ch").attr("placeholder", "Preom coordonateur filiere");
				$("#TOhideDIV").show();
				
			}
			
			if ( param == 'CM')
			{
				div.style.backgroundColor = '#878dce';
				$("#divTitleChancge").text('Créer Compte coordonateur module');
				$("#NOM_CHANGE").text('Nom Coordonnateur Module');
				$("#PRENOM_CHANGE").text('Preom Coordonnateur Module');
				$("#divFooterChancge").text('Coordonnateur Module');
				// $("#add-user").attr("name", "submit2");
				$("#nom_ch").attr("placeholder", "Nom coordonateur module");
				$("#prenom_ch").attr("placeholder", "Preom coordonateur module");
				$("#TOhideDIV").show();
			}
			
			if ( param == 'ENS')
			{
				div.style.backgroundColor = '#7e0000';
				$("#divTitleChancge").text('Créer Compte enseignant');
				$("#NOM_CHANGE").text('Nom enseignant ');
				$("#PRENOM_CHANGE").text('Preom enseignant');
				$("#divFooterChancge").text('enseignant');
				// $("#add-user").attr("name", "submit3");
				$("#nom_ch").attr("placeholder", "Nom enseignant");
				$("#prenom_ch").attr("placeholder", "Preom enseignant");
				$("#TOhideDIV").show();
			}
			
			
		}
		
		$('#add-user').click(function(){ 
		
		if ( $("#etablissement").val() != null && $("#departement").val() != null && $("#nom_ch").val() != '' && $("#prenom_ch").val() != '' && $("#Grade").val() != null && $("#specialite").val() != null && $("#pseudo").val() != '' &&  $("#mdp").val() != '' ) 
		{
			if ($("#mdp").val() == $("#mdpConfirm").val()) 
			{
				var dataString2 =  'indiceToSubmit='+ indiceToSubmit + '&etablissement='+ $("#etablissement").val() + '&departement='+ $("#departement").val() + '&nom_ch='+ $("#nom_ch").val() + '&prenom_ch='+ $("#prenom_ch").val() + '&Grade='+ $("#Grade").val() + '&specialite='+ $("#specialite").val() + '&pseudo='+ $("#pseudo").val() + '&mdp='+ $("#mdp").val()   ; 
				
				$.ajax
					({
						type: "POST",
						url: "Creation_AJAX.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							
							
							if (html.trim() == "404") 
							{
								swal(
									'Erreur!',
									'ce compte existe deja .',
									'error'
									) 
							}
							else{
								swal(
									'Ajouter!',
									'LE COMPTE A BIEN ETE AJOUTER.',
									'success'
									) 
							}
			
						
							
						}
					});
					
				
			}
			else
			{
				swal(
					  'Erreur...',
					  'les mots de pass ne sont pas identique !',
					  'error'
					)
			}
		}
		else{
			swal(
					  'Erreur...',
					  'Vous avez manquez de remplir un champ !',
					  'error'
					)
		}
		
	});
		</script>
    
   
</body>
</html>




