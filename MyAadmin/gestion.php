<!DOCTYPE html>
<?php
session_start();
if ( !isset($_SESSION['admin'])){
	header('Location: ../login/login.php');
}

include '../connexion.php';

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
    <title>GESTION ADMINISTRATIF</title>
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
  
   
   <link rel="stylesheet" href="../css/jquery-confirm.min.css">
	
   
   
	
		
		
		<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../css/set2.css" />
		
		
   
   
   
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
                         <a  href="accreditaion.php"><i class="fa  fa-cogs fa-3x"></i>  Gestion des Comptes</a>
                    </li>
						   
					                   
                   
                  
                </ul>
               
            </div>
            
        </nav> 
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
          <form method="POST" id="form_GU"> 
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Derniere connexion : 30 Mars 2017 &nbsp; <input type="submit" class="btn btn-danger square-btn-adjust"  value="Deconnexion" name="Deconnexion"> </input> </div>
      </form>  
		</nav>   
           <!-- /. NAV TOP  -->
         
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>GESTION ADMIN</h2>   
                        
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
				  
				<div class="row">
				  <div class="col-md-12">
					
					
					<section class="content" style="background : #f3f3f3;"  id="GESION_VILLE">
					<h3> &nbsp;&nbsp; ENTRER UNE VILLE  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="ville_ADD_GV" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-map-marker icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DE la ville</span>
							</label>
						</span>
						
						
						
						
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_VILLE" style="margin-top: 16px;height: 57px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES VILLES EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover"   id="TABLE_GESTION_VILLE">
								<thead>
									<tr class="info">
										<th  style="width: 70px; ">#</th>
										<th>Ville</th>
										<th style="width: 70px; text-align: center;" >Modifier</th>
										<th style="width: 70px; text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_VILLE = 1 ; 
						
						$SQL="SELECT  v.NOM_VILLE , v.CODE_VILLE 
								FROM  ville v 
								ORDER BY v.CODE_VILLE
								;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_VILLE'.$id_Gestion_VILLE.'">
                                 <td>'.$id_Gestion_VILLE.'</td>
                                 <td id="TAB_gestionVille_ville'.$id_Gestion_VILLE.'">'.$row['NOM_VILLE'].'</td>
								 <input type="hidden" id="save_TAB_gestionVille_ville'.$id_Gestion_VILLE.'"  name="save_TAB_gestionVille_ville'.$id_Gestion_VILLE.'" value="'.$row['CODE_VILLE'].'" /> 
								 
								 <td style="text-align: center;"><i class="fa fa-pencil-square fa-2x" aria-hidden="true" onclick="modifier_VILLE('.$id_Gestion_VILLE.')"  style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center;"><i class="fa fa-trash fa-2x" aria-hidden="true"         onclick="supprimer_VILLE('.$id_Gestion_VILLE.')" style="cursor: pointer;" ></i></td>
                             </tr> ';
							
							 $id_Gestion_VILLE++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
					</section>
					
					<section class="content" style="background : #f6f0f0;"  id="GESION_University">
						<h3> &nbsp;&nbsp; ENTRER UNE NOUVELLE UNVIVERSITE  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="univ_ADD_GU" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-university icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DE l'universite</span>
							</label>
						</span>
						
						
						
						<div class="col-xs-12">
						<select class="form-control" name="VILLE_ADD_GU">
						<option value="" disabled selected>Merci de choisir la ville </option>
						<?php
						
						$SQL="SELECT CODE_VILLE , NOM_VILLE FROM `ville`  ;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo ' <option value="'.$row['CODE_VILLE'].'">'.$row['NOM_VILLE'].'</option>  ' ; 
							
						}
						
						?>
							
					
						</select>
						</div>
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_UNIVERSITY" style="margin-top: 14px;height: 108px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES  UNVIVERSITE EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="TABLE_GESTION_UNIVERSITI" >
								<thead>
									<tr class="info">
										<th  style="width: 70px;">#</th>
										<th>Universite</th>
										<th>Ville</th>
										<th style="width: 70px;text-align: center;" >Modifier</th>
										<th style="width: 70px;text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_UNIV = 1 ; 
						
						$SQL="SELECT u.CODE_UNIVERSITE,u.NOM_UNIVERSITE , v.NOM_VILLE , v.CODE_VILLE 
								FROM universite u , ville v 
								where u.CODE_VILLE = v.CODE_VILLE
								ORDER BY u.CODE_UNIVERSITE";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_UNIV'.$id_Gestion_UNIV.'">
                                 <td>'.$id_Gestion_UNIV.'</td>
                                 <td id="TAB_gestionUniversite_univ'.$id_Gestion_UNIV.'">'.$row['NOM_UNIVERSITE'].'</td>
								 <input type="hidden" id="save_TAB_gestionUniversite_univ'.$id_Gestion_UNIV.'" value="'.$row['CODE_UNIVERSITE'].'" /> 
                                 <td id="TAB_gestionUniversite_ville'.$id_Gestion_UNIV.'">'.$row['NOM_VILLE'].'</td>
								 <input type="hidden" id="save_TAB_gestionUniversite_ville'.$id_Gestion_UNIV.'"  name="save_TAB_gestionUniversite_ville'.$id_Gestion_UNIV.'" value="'.$row['CODE_VILLE'].'" /> 
								 
								 <td style="text-align: center; "><i class="fa fa-pencil-square fa-2x" aria-hidden="true"  onclick="modifier_UNIVERSITY('.$id_Gestion_UNIV.')"  style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center; "><i class="fa fa-trash fa-2x" aria-hidden="true"          onclick="supprimer_UNIVERSITY('.$id_Gestion_UNIV.')" style="cursor: pointer;" ></i></td>
                             </tr> ';
							
							 $id_Gestion_UNIV++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
                      
                    							
					</section>
					<section class="content" style="background : #f3f3f3;"  id="GESION_Etablissmenet">
					<h3> &nbsp;&nbsp; ENTRER UN NOUVEAU ETABLISSEMENT  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="etabissment_ADD_GE" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-graduation-cap icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DE l'etablissment</span>
							</label>
						</span>
						
						
						
						<div class="col-xs-6">
						
						<select class="form-control" id="VILLE_ADD_GE" readonly="readonly">
						<option value="" disabled selected>Merci de choisir une ville </option>
						<?php
						
						$SQL="SELECT CODE_VILLE , NOM_VILLE FROM `ville`  ;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo ' <option value="'.$row['CODE_VILLE'].'">'.$row['NOM_VILLE'].'</option>  ' ; 
							
						}
						
						?>
						</select>	
					</div>
						
						<div class="col-xs-6">
						<select class="form-control" name="UNIVERSITY_ADD_GE" id="UNIVERSITY_ADD_GE">
						<option value="" disabled selected>Merci de choisir une ville tout d'abord </option>

						</select>
						</div>
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_Etablissmenent" style="margin-top: 14px;height: 108px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES  ETABLISSEMENTS EXISTANTES</h3>
						
						<br>
						
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="TABLE_GESTION_Etablissmenet" >
								<thead>
									<tr class="info">
										<th  style="width: 70px;">#</th>
										<th>Etablissment</th>
										<th>UNIVERSITY</th>
										<th style="width: 70px;text-align: center;" >Modifier</th>
										<th style="width: 70px;text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_ETAB = 1 ; 
						
						$SQL="SELECT e.CODE_ETA , e.NOM_ETA , u.CODE_UNIVERSITE , u.NOM_UNIVERSITE
						FROM etablissement e , universite u 
						where e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
						ORDER BY e.CODE_ETA";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_ETAB'.$id_Gestion_ETAB.'">
                                 <td>'.$id_Gestion_ETAB.'</td>
                                 <td id="TAB_gestionEtalissment_etab'.$id_Gestion_ETAB.'">'.$row['NOM_ETA'].'</td>
								 <input type="hidden" id="save_TAB_gestionEtalissment_etab'.$id_Gestion_ETAB.'" value="'.$row['CODE_ETA'].'" /> 
                                 <td id="TAB_gestionEtalissment_univ'.$id_Gestion_ETAB.'">'.$row['NOM_UNIVERSITE'].'</td>
								 <input type="hidden" id="save_TAB_gestionEtalissment_univ'.$id_Gestion_ETAB.'"   value="'.$row['CODE_UNIVERSITE'].'" /> 
								 
								 <td style="text-align: center;"><i class="fa fa-pencil-square fa-2x" aria-hidden="true" onclick="modifier_ETABLISSMENT('.$id_Gestion_ETAB.')"  style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center;"><i class="fa fa-trash fa-2x" aria-hidden="true"         onclick="supprimer_ETABLISSMENT('.$id_Gestion_ETAB.')" style="cursor: pointer;" ></i></td>
                             </tr> ';
							
							 $id_Gestion_ETAB++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
                      
					</section>
					
					<section class="content" style="background : #f6f0f0;"  id="GESION_Departement">
					<h3> &nbsp;&nbsp; ENTRER UN NOUVEAU DEPARTEMENT  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="departement_ADD_GDept" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-flag icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DE departement</span>
							</label>
						</span>
						
						
						
						<div class="col-xs-6">
						
						<select class="form-control" id="UNIVERSITY_ADD_GDept" readonly="readonly">
						<option value="" disabled selected>Merci de choisir une university </option>
						<?php
						
						$SQL="SELECT CODE_UNIVERSITE , NOM_UNIVERSITE FROM `universite`  ;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo ' <option value="'.$row['CODE_UNIVERSITE'].'">'.$row['NOM_UNIVERSITE'].'</option>  ' ; 
							
						}
						
						?>
							
					
						</select>
						</div>
						<div class="col-xs-6">
						<select class="form-control" name="ETABLISSMENT_ADD_GDept" id="ETABLISSMENT_ADD_GDept">
						<option value="" disabled selected>Merci de choisir une university tout d'abord </option>

						</select>
						
						
						</div>
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_Departement" style="margin-top: 14px;height: 108px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES  Departement EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="TABLE_GESTION_DEPARTEMENT" >
								<thead>
									<tr class="info">
										<th  style="width: 70px;">#</th>
										<th>DEPARTMENT</th>
										<th>ETABLISSMENT</th>
										<th style="width: 70px; text-align: center;" >Modifier</th>
										<th style="width: 70px; text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_DEPT = 1 ; 
						
						$SQL="SELECT d.CODE_DEPT , d.NOM_DEPT , e.CODE_ETA , e.NOM_ETA
								FROM etablissement e , departement d
								where e.CODE_ETA = d.CODE_ETA
								ORDER BY d.CODE_DEPT";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_DEPT'.$id_Gestion_DEPT.'">
                                 <td>'.$id_Gestion_DEPT.'</td>
                                 <td id="TAB_gestionDepartement_dept'.$id_Gestion_DEPT.'">'.$row['NOM_DEPT'].'</td>
								 <input type="hidden" id="save_TAB_gestionDepartement_dept'.$id_Gestion_DEPT.'" value="'.$row['CODE_DEPT'].'" /> 
                                 <td id="TAB_gestionDepartement_etab'.$id_Gestion_DEPT.'">'.$row['NOM_ETA'].'</td>
								 <input type="hidden" id="save_TAB_gestionDepartement_etab'.$id_Gestion_DEPT.'"   value="'.$row['CODE_ETA'].'" /> 
								 
								 <td style=" text-align: center;" ><i class="fa fa-pencil-square fa-2x" aria-hidden="true" onclick="modifier_DEPARTEMENT('.$id_Gestion_DEPT.')" style="cursor: pointer;" ></i></td>
                                 <td style=" text-align: center;" ><i class="fa fa-trash fa-2x" aria-hidden="true" onclick="supprimer_DEPARTEMENT('.$id_Gestion_DEPT.')"style="cursor: pointer;" ></i></td>
                             </tr> ';
							
							 $id_Gestion_DEPT++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
					</section>
					
					<section class="content" style="background : #f3f3f3;"  id="GESION_Domaines">
					<h3> &nbsp;&nbsp; ENTRER UN DOMAINE  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="DOMAINE_ADD_GDomaine" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-map-marker icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DU DOMAINE</span>
							</label>
						</span>
						
						
						
						
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_DOMAINE" style="margin-top: 16px;height: 57px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES DOMAINES EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover"   id="TABLE_GESTION_DOMAINE">
								<thead>
									<tr class="info">
										<th  style="width: 70px; ">#</th>
										<th>DOMAINE</th>
										<th style="width: 70px; text-align: center;" >Modifier</th>
										<th style="width: 70px; text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_Domaine = 1 ; 
						
						$SQL="SELECT  CODE_DOMAINE , NOM_DOMAINE
							FROM domaine
							ORDER BY CODE_DOMAINE
								;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_Domaine'.$id_Gestion_Domaine.'">
                                 <td>'.$id_Gestion_Domaine.'</td>
                                 <td id="TAB_gestionDomaine_domaine'.$id_Gestion_Domaine.'">'.$row['NOM_DOMAINE'].'</td>
								 <input type="hidden" id="save_TAB_gestionDomaine_domaine'.$id_Gestion_Domaine.'"  name="save_TAB_gestionDomaine_domaine'.$id_Gestion_Domaine.'" value="'.$row['CODE_DOMAINE'].'" /> 
								 
								 <td style="text-align: center;"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"  onclick="modifier_Domaine('.$id_Gestion_Domaine.')" style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center;"><i class="fa fa-trash fa-2x" aria-hidden="true"  onclick="supprimer_Domaine('.$id_Gestion_Domaine.')"  style="cursor: pointer;"></i></td>
                             </tr> ';
							
							 $id_Gestion_Domaine++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
					</section>
					
					<section class="content" style="background : #f6f0f0;"  id="GESION_Diplomes">
					<h3> &nbsp;&nbsp; ENTRER un  NOUVEAU DIPLOME </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="Diplome_ADD_GDiplome" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-graduation-cap icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DU Diplome</span>
							</label>
						</span>
						
						
						
						<div class="col-xs-12">
						<select class="form-control" name="Type_ADD_GDiplome">
						<option value="" disabled selected>Merci de choisir un TYPE </option>
						<?php
						
						$SQL="SELECT CODE_TYPE_DIPLOME , NOM_TYPE_DIPLOME FROM `type_diplome`  ;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo ' <option value="'.$row['CODE_TYPE_DIPLOME'].'">'.$row['NOM_TYPE_DIPLOME'].'</option>  ' ; 
							
						}
						
						?>
							
					
						</select>
						</div>
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_DIPLOME" style="margin-top: 14px;height: 108px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES  DIPLOMES EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="TABLE_GESTION_Diplomes" >
								<thead>
									<tr class="info">
										<th  style="width: 70px;">#</th>
										<th>type</th>
										<th>Diplome</th>
										<th style="width: 70px;text-align: center;" >Modifier</th>
										<th style="width: 70px;text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_Diplomes = 1 ; 
						
						$SQL="SELECT  d.CODE_DIPLOME , d.NOM_DIPLOME , td.CODE_TYPE_DIPLOME , td.NOM_TYPE_DIPLOME
							FROM diplomes d , type_diplome td
							where d.TYPE = td.CODE_TYPE_DIPLOME
							ORDER BY d.CODE_DIPLOME ";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_Diplome'.$id_Gestion_Diplomes.'">
                                 <td>'.$id_Gestion_Diplomes.'</td>
                                 <td id="TAB_gestionDiplomes_type'.$id_Gestion_Diplomes.'">'.$row['NOM_TYPE_DIPLOME'].'</td>
								 <input type="hidden" id="save_TAB_gestionDiplomes_type'.$id_Gestion_Diplomes.'" value="'.$row['CODE_TYPE_DIPLOME'].'" /> 
                                 <td id="TAB_gestionDiplomes_diplome'.$id_Gestion_Diplomes.'">'.$row['NOM_DIPLOME'].'</td>
								 <input type="hidden" id="save_TAB_gestionDiplomes_diplome'.$id_Gestion_Diplomes.'"  value="'.$row['CODE_DIPLOME'].'" /> 
								 
								 <td style="text-align: center; "><i class="fa fa-pencil-square fa-2x" aria-hidden="true" onclick="modifier_Diplome('.$id_Gestion_Diplomes.')"  style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center; "><i class="fa fa-trash fa-2x" aria-hidden="true"  onclick="supprimer_Diplome('.$id_Gestion_Diplomes.')"  style="cursor: pointer;" ></i></td>
                             </tr> ';
							
							 $id_Gestion_Diplomes++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
                      
					</section>
					
					<section class="content" style="background : #f3f3f3;"  id="GESION_Grades">
					<h3> &nbsp;&nbsp; ENTRER UN GRADE  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="GRADE_ADD_GGrade" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-map-marker icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DU grade</span>
							</label>
						</span>
						
						
						
						
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_Grade" style="margin-top: 16px;height: 57px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES GRADES EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover"   id="TABLE_GESTION_GRADE">
								<thead>
									<tr class="info">
										<th  style="width: 70px; ">#</th>
										<th>GRADE</th>
										<th style="width: 70px; text-align: center;" >Modifier</th>
										<th style="width: 70px; text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_GRADE = 1 ; 
						
						$SQL="SELECT  CODE_GRAD , NOM_GRAD
							FROM grade_crm
							ORDER BY CODE_GRAD
								;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_Grade'.$id_Gestion_GRADE.'">
                                 <td>'.$id_Gestion_GRADE.'</td>
                                 <td id="TAB_gestionGrade_grade'.$id_Gestion_GRADE.'">'.$row['NOM_GRAD'].'</td>
								 <input type="hidden" id="save_TAB_gestionGrade_grade'.$id_Gestion_GRADE.'"  value="'.$row['CODE_GRAD'].'" /> 
								 
								 <td style="text-align: center;"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"  onclick="modifier_Grade('.$id_Gestion_GRADE.')" style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center;"><i class="fa fa-trash fa-2x" aria-hidden="true"  onclick="supprimer_Grade('.$id_Gestion_GRADE.')"  style="cursor: pointer;"></i></td>
                             </tr> ';
							
							 $id_Gestion_GRADE++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
					</section>
					
					
					<section class="content" style="background : #f6f0f0;"  id="GESION_Specialite">
					<h3> &nbsp;&nbsp; ENTRER UNE SPECIALITE  </h3>
						<form  method="POST">
						<div class="col-sm-10">
						<span class="input input--fumi" >
							<input name="SPECIALITE_ADD_SPECIALITE" class="input__field input__field--fumi" type="text" id="input-23" />
							<label class="input__label input__label--fumi" for="input-23">
								<i class="fa fa-fw fa-map-marker icon icon--fumi"></i>
								<span class="input__label-content input__label-content--fumi">NOM DU specialite</span>
							</label>
						</span>
						
						
						
						
						</div>
						<div class="col-sm-2">
						
						
						
						<input type="submit" name="AJOUTER_Specialite" style="margin-top: 16px;height: 57px;width: 158px;" value="Ajouter" class="btn btn-primary"/>
						</div>
					</form>
						
						<br>
						<br>
						<br>
						<br>
						
						<h3> &nbsp;&nbsp; OU BIEN MODIFIER LES SPECIALITES EXISTANTES</h3>
						
						<br>
						<div class="panel panel-default">
                        
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover"   id="TABLE_GESTION_SPECIALITE">
								<thead>
									<tr class="info">
										<th  style="width: 70px; ">#</th>
										<th>SPECIALITE</th>
										<th style="width: 70px; text-align: center;" >Modifier</th>
										<th style="width: 70px; text-align: center;" >Suprimer</th>
									</tr>
								</thead>
                                <tbody>
                     <!--    Context Classes  -->
                    
                        <?php
						$id_Gestion_SPECIALITE = 1 ; 
						
						$SQL="SELECT  CODE_SPEC , NOM_SPEC
							FROM specialite_crm
							ORDER BY CODE_SPEC
								;";
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							echo '
							 <tr  id="GEST_Specialite'.$id_Gestion_SPECIALITE.'">
                                 <td>'.$id_Gestion_SPECIALITE.'</td>
                                 <td id="TAB_gestionSpecialite_spec'.$id_Gestion_SPECIALITE.'">'.$row['NOM_SPEC'].'</td>
								 <input type="hidden" id="save_TAB_gestionSpecialite_spec'.$id_Gestion_SPECIALITE.'"  value="'.$row['CODE_SPEC'].'" /> 
								 
								 <td style="text-align: center;"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"  onclick="modifier_Specialite('.$id_Gestion_SPECIALITE.')" style="cursor: pointer;" ></i></td>
                                 <td style="text-align: center;"><i class="fa fa-trash fa-2x" aria-hidden="true"  onclick="supprimer_Specialite('.$id_Gestion_SPECIALITE.')"  style="cursor: pointer;"></i></td>
                             </tr> ';
							
							 $id_Gestion_SPECIALITE++ ; 
						}
						
						?>
                        
                        
                           
                                       
                                    </tbody>
                                </table>
                         </div>
                         </div>
                         </div>
					</section>
					
					
					 
				</div>
				</div>
            
                 <!-- /. ROW  -->
             <hr />  


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
		  <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#TABLE_GESTION_VILLE').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche une ville &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  Villes",
						"sInfo":           "Affichage des villes _START_ &agrave; _END_ sur _TOTAL_ villes",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 villes",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ villes au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes villes &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				});
				
				
		
                $('#TABLE_GESTION_UNIVERSITI').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche une universite &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  universites",
						"sInfo":           "Affichage des universites _START_ &agrave; _END_ sur _TOTAL_ universites",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 universites",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ universites au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes universites &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				});
			
				
		
                $('#TABLE_GESTION_Etablissmenet').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un etablissment &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  etablissments",
						"sInfo":           "Affichage des etablissments _START_ &agrave; _END_ sur _TOTAL_ etablissments",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 etablissments",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ etablissments au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes etablissments &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				});
				
				
			$('#TABLE_GESTION_DEPARTEMENT').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un departement &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  departements",
						"sInfo":           "Affichage des departements _START_ &agrave; _END_ sur _TOTAL_ departements",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 departements",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ departements au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes departements &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				
				});
				
				$('#TABLE_GESTION_DOMAINE').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un domaine &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  domaines",
						"sInfo":           "Affichage des domaines _START_ &agrave; _END_ sur _TOTAL_ domaines",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 domaines",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ domaines au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes domaines &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				
				});
				
				$('#TABLE_GESTION_Diplomes').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un diplome &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  diplomes",
						"sInfo":           "Affichage des diplomes _START_ &agrave; _END_ sur _TOTAL_ diplomes",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 diplomes",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ diplomes au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes diplomes &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				
				});
				
				$('#TABLE_GESTION_GRADE').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un grade &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  grades",
						"sInfo":           "Affichage des grades _START_ &agrave; _END_ sur _TOTAL_ grades",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 grades",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ grades au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes grades &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				
				});
				
					
				$('#TABLE_GESTION_SPECIALITE').DataTable({
					
				"language":{
						"sProcessing":     "Traitement en cours...",
						"sSearch":         "Recherche un specialite &nbsp;:",
						"sLengthMenu":     "Afficher _MENU_  specialites",
						"sInfo":           "Affichage des specialites _START_ &agrave; _END_ sur _TOTAL_ specialites",
						"sInfoEmpty":      "Affichage de la ville 0 &agrave; 0 sur 0 specialites",
						"sInfoFiltered":   "(filtr&eacute; de _MAX_ specialites au total)",
						"sInfoPostFix":    "",
						"sLoadingRecords": "Chargement en cours...",
						"sZeroRecords":    "Aucunes specialites &agrave; afficher",
						"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
						"oPaginate": {
							"sFirst":      "Premier",
							"sPrevious":   "Pr&eacute;c&eacute;dent",
							"sNext":       "Suivant",
							"sLast":       "Dernier"
						},
						"oAria": {
							"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
							"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
						}
					}
				
				});
				
				
				});
				
				
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	 <!-- SWEET ALERT -->
    <script src="../js/sweetalert2.min.js"></script>	
	
	<script src="../js/classie.js"></script>
	
	<script src="../js/jquery-confirm.min.js"></script>
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
		var current = null ; 
		function modifier_UNIVERSITY(param)
		{
			// alert(param);
			$("#Gestion_UNIVERSITY_MODAL").modal("show");
			$("#UnivTEXT").val($("#TAB_gestionUniversite_univ"+param).text());
			$("#ville_select").val($("#save_TAB_gestionUniversite_ville"+param).val());
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_UNIVERSITY()
			{	

			  var dataString = 'nom_university=' + $("#UnivTEXT").val() + '&id_ville=' + $("#ville_select").val() +'&id_univ=' +   document.getElementById("save_TAB_gestionUniversite_univ"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_UNIVERSITY.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'cet UNIVERSITY A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionUniversite_univ"+current).text($("#UnivTEXT").val());
						  $("#TAB_gestionUniversite_ville"+current).text($("#ville_select :selected").text());
					}
					 
				});
			  
			  
			  $("#Gestion_UNIVERSITY_MODAL").modal("hide");
		
			}

			
		function supprimer_UNIVERSITY(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer cet university .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionUniversite_univ"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_UNIVERSITY.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'L\'universite A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_UNIV"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
		
		<script>
		var current = null ; 
		function modifier_VILLE(param)
		{
			// alert(param);
			$("#Gestion_VILLE_MODAL").modal("show");
			$("#VilleTEXT").val($("#TAB_gestionVille_ville"+param).text());
			
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_VILLES()
			{	

			  var dataString = 'nomville=' + $("#VilleTEXT").val() +'&id_ville=' +   document.getElementById("save_TAB_gestionVille_ville"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_VILLE.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'CET VILLE A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionVille_ville"+current).text($("#VilleTEXT").val());
						  
					}
					 
				});
			  
			  
			  $("#Gestion_VILLE_MODAL").modal("hide");
		
			}

			
		function supprimer_VILLE(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer cet ville .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionVille_ville"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_VILLE.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'La ville A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_VILLE"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
		
		<script>
		var current = null ; 
		function modifier_ETABLISSMENT(param)
		{
			
			$("#Gestion_ETABLISSMENT_MODAL").modal("show");
			$("#ETABTEXT").val($("#TAB_gestionEtalissment_etab"+param).text());
			$("#univ_select").val($("#save_TAB_gestionEtalissment_univ"+param).val());
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_ETABLISSMENT()
			{	

			  var dataString = 'nometablissment=' + $("#ETABTEXT").val() + '&id_univ=' + $("#univ_select").val() +'&id_etab=' +   document.getElementById("save_TAB_gestionEtalissment_etab"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_ETABLISSMENT.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'cet etablissment A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionEtalissment_etab"+current).text($("#ETABTEXT").val());
						  $("#TAB_gestionEtalissment_univ"+current).text($("#univ_select :selected").text());
					}
					 
				});
			  
			  
			  $("#Gestion_ETABLISSMENT_MODAL").modal("hide");
		
			}

			
		function supprimer_ETABLISSMENT(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer cet etablissment .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionEtalissment_etab"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_ETABLISSMENT.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'L\'etablissment A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_ETAB"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
		
		
		<script>
		var current = null ; 
		function modifier_DEPARTEMENT(param)
		{
			
			$("#Gestion_DEPARTEMENT_MODAL").modal("show");
			$("#deptTEXT").val($("#TAB_gestionDepartement_dept"+param).text());
			$("#etab_select").val($("#save_TAB_gestionDepartement_etab"+param).val());
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_DEPARTEMENT()
			{	

			  var dataString = 'nom_departement=' + $("#deptTEXT").val() + '&id_etab=' + $("#etab_select").val() +'&id_department=' +   document.getElementById("save_TAB_gestionDepartement_dept"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_DEPARTEMENT.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'cet etablissment A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionDepartement_dept"+current).text($("#deptTEXT").val());
						  $("#TAB_gestionDepartement_etab"+current).text($("#etab_select :selected").text());
					}
					 
				});
			  
			  
			  $("#Gestion_DEPARTEMENT_MODAL").modal("hide");
		
			}

			
		function supprimer_DEPARTEMENT(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer ce departement .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionDepartement_dept"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_DEPARTEMENT.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'Le departement A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_DEPT"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
		
		
		<script>
		var current = null ; 
		function modifier_Diplome(param)
		{
			// alert(param);
			$("#Gestion_DIPLOME_MODAL").modal("show");
			$("#DiplomeTEXT").val($("#TAB_gestionDiplomes_diplome"+param).text());
			$("#typedep_SELECT").val($("#save_TAB_gestionDiplomes_type"+param).val());
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_DIPLOME()
			{	

			  var dataString = 'nom_diplome=' + $("#DiplomeTEXT").val() + '&type=' + $("#typedep_SELECT").val() +'&id_diplome=' +   document.getElementById("save_TAB_gestionDiplomes_diplome"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_DIPLOMES.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'ce DIPLOME A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionDiplomes_diplome"+current).text($("#DiplomeTEXT").val());
						  $("#TAB_gestionDiplomes_type"+current).text($("#typedep_SELECT :selected").text());
					}
					 
				});
			  
			  
			  $("#Gestion_DIPLOME_MODAL").modal("hide");
		
			}

			
		function supprimer_Diplome(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer ce Diplome .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionDiplomes_diplome"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_DIPLOMES.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'Le diplome A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_Diplome"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
		
		
			<script>
		var current = null ; 
		function modifier_Specialite(param)
		{
			// alert(param);
			$("#Gestion_SPECIALITE_MODAL").modal("show");
			$("#SpecialiteTEXT").val($("#TAB_gestionSpecialite_spec"+param).text());
			
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_SPECIALITE()
			{	

			  var dataString = 'nomspecialite=' + $("#SpecialiteTEXT").val() +'&id_spec=' +   document.getElementById("save_TAB_gestionSpecialite_spec"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_SPECIALITE.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'CE grade A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionSpecialite_spec"+current).text($("#SpecialiteTEXT").val());
						  
					}
					 
				});
			  
			  
			  $("#Gestion_SPECIALITE_MODAL").modal("hide");
		
			}

			
		function supprimer_Specialite(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer cet specialite .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionSpecialite_spec"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_SPECIALITE.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'La specialite A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_Specialite"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		</script>
		
		
		
			<script>
		var current = null ; 
		function modifier_Grade(param)
		{
			// alert(param);
			$("#Gestion_GRADE_MODAL").modal("show");
			$("#gradeTAXT").val($("#TAB_gestionGrade_grade"+param).text());
			
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_GRADE()
			{	

			  var dataString = 'nomgrade=' + $("#gradeTAXT").val() +'&id_grade=' +   document.getElementById("save_TAB_gestionGrade_grade"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_GRADE.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'CE grade A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionGrade_grade"+current).text($("#gradeTAXT").val());
						  
					}
					 
				});
			  
			  
			  $("#Gestion_GRADE_MODAL").modal("hide");
		
			}

			
		function supprimer_Grade(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer ce grade .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionGrade_grade"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_GRADE.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'Le grade A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_Grade"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		</script>
		
		<script>
		$("#VILLE_ADD_GE").change(function()
				{
					var id=$(this).val();
					var dataString = 'id='+ id;
					$.ajax
					({
						type: "POST",
						url: "../LES-GET/get_universite.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#UNIVERSITY_ADD_GE").html(html);
						}
					});
				});
				
				  
		$("#UNIVERSITY_ADD_GDept").change(function()
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
							$("#ETABLISSMENT_ADD_GDept").html(html);
						}
					});
				});
		</script>
		
		
		<script>
		var current = null ; 
		function modifier_Domaine(param)
		{
			// alert(param);
			$("#Gestion_Domaine_MODAL").modal("show");
			$("#DomaineTEXT").val($("#TAB_gestionDomaine_domaine"+param).text());
			
			
			current = param ; 
	 
		}
		
		function ENREGISTRER_GESTTION_DOMAINES()
			{	

			  var dataString = 'nomdomaine=' + $("#DomaineTEXT").val() +'&id_domaine=' +   document.getElementById("save_TAB_gestionDomaine_domaine"+current).value ; 
			  
			  $.ajax({
					type: "POST",
					url: "GESTION_AJAX/GESTION_DOMAINE.php",
					data: dataString,
					cache: true,
					success: function(html){
						
						swal(
										'MODIFIED!',
										'CE DOMAINE A BIEN ETE MODIFIE.',
										'success'
									  )
						  $("#TAB_gestionDomaine_domaine"+current).text($("#DomaineTEXT").val());
						  
					}
					 
				});
			  
			  
			  $("#Gestion_Domaine_MODAL").modal("hide");
		
			}

			
		function supprimer_Domaine(param)
		{
			
			 $.confirm({
                   title: 'Cela peut être critique',
                   content: 'vous voulez vraiment supprimer ce Domaine .',
                   icon: 'fa fa-warning',
                   animation: 'zoom',
                   closeAnimation: 'zoom',
                   buttons: {
                       confirm: {
                           text: 'OUI, BIEN SURE!',
                           btnClass: 'btn-warning',
                           action: function () {
								
								var dataString = 'id_delete=' + document.getElementById("save_TAB_gestionDomaine_domaine"+param).value ; 

							   $.ajax({
								type: "POST",
								url: "GESTION_AJAX/GESTION_DOMAINE.php",
								data: dataString,
								cache: true,
								success: function(html){
									swal(
										'SUPPRIMER!',
										'Le domaine A BIEN ETE supprimer.',
										'success'
									  )
									
									$("#GEST_Domaine"+param).remove();
								}
								 
							});
								
                           }
                       },
                       cancel: function () {
                          
                       }
                   }
               });
		}
		
		</script>
	
		
		
  <div class="modal fade" id="Gestion_UNIVERSITY_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DE L'UNIVERSITE</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom de l'UNIVERSITE </label>
						<input type="text" placeholder="universite" class="name form-control" id="UnivTEXT" required />

						<br>
						<label>choisir LA VILLE </label>
						<br>
						
						<select class="form-control" name='ville_select' id="ville_select"> 
								<option value="" disabled selected>Merci de choisir la ville </option>
										<?php
									
									$SQL="SELECT CODE_VILLE , NOM_VILLE FROM `ville`  ;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{
										echo ' <option value="'.$row['CODE_VILLE'].'">'.$row['NOM_VILLE'].'</option>  ' ; 
										
									}
									
									?>
						</select> 
						
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_UNIVERSITY()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
		
    <div class="modal fade" id="Gestion_VILLE_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DE LA VILLE</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom de la ville </label>
						<input type="text" placeholder="ville" class="name form-control" id="VilleTEXT" required />

						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_VILLES()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
	</div>
  
  
  <div class="modal fade" id="Gestion_ETABLISSMENT_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DE L'ETABLISSMENT</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom de l'ETABLISSMENT </label>
						<input type="text" placeholder="universite" class="name form-control" id="ETABTEXT" required />

						<br>
						<label>choisir L'UNIVERSITY </label>
						<br>
						
						<select class="form-control" name='univ_select' id="univ_select"> 
								<option value="" disabled selected>Merci de choisir l'university </option>
										<?php
									
									$SQL="SELECT CODE_UNIVERSITE , NOM_UNIVERSITE FROM `universite`  ;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{
										echo ' <option value="'.$row['CODE_UNIVERSITE'].'">'.$row['NOM_UNIVERSITE'].'</option>  ' ; 
										
									}
									
									?>
						</select> 
						
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_ETABLISSMENT()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
  
  
  
  <div class="modal fade" id="Gestion_DEPARTEMENT_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DU DEPARTEMENT</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom du departement </label>
						<input type="text" placeholder="departement" class="name form-control" id="deptTEXT" required />

						<br>
						<label>choisir L'etablissment </label>
						<br>
						
						<select class="form-control" name='etab_select' id="etab_select"> 
								<option value="" disabled selected>Merci de choisir l'etablissment </option>
										<?php
									
									$SQL="SELECT CODE_ETA , NOM_ETA FROM `etablissement`  ;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{
										echo ' <option value="'.$row['CODE_ETA'].'">'.$row['NOM_ETA'].'</option>  ' ; 
										
									}
									
									?>
						</select> 
						
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_DEPARTEMENT()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
  
  
  
  <div class="modal fade" id="Gestion_Domaine_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DE LA VILLE</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom du domaine </label>
						<input type="text" placeholder="domaine" class="name form-control" id="DomaineTEXT" required />

						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_DOMAINES()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
	</div>
	
	
		
  <div class="modal fade" id="Gestion_DIPLOME_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION DU DIPLOME</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom de diplome </label>
						<input type="text" placeholder="diplome" class="name form-control" id="DiplomeTEXT" required />

						<br>
						<label>choisir LE TYPE </label>
						<br>
						
						<select class="form-control" name='typedep_SELECT' id="typedep_SELECT"> 
								<option value="" disabled selected>Merci de choisir le type </option>
										<?php
									
									$SQL="SELECT CODE_TYPE_DIPLOME , NOM_TYPE_DIPLOME
									FROM type_diplome  ;";
									$query=mysqli_query($ma_connexion,$SQL);
									while($row=mysqli_fetch_assoc($query))
									{
										echo ' <option value="'.$row['CODE_TYPE_DIPLOME'].'">'.$row['NOM_TYPE_DIPLOME'].'</option>  ' ; 
										
									}
									
									?>
						</select> 
						
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_DIPLOME()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
  
    <div class="modal fade" id="Gestion_GRADE_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION SUR LE GRADE</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom du grade </label>
						<input type="text" placeholder="grade" class="name form-control" id="gradeTAXT" required />

						<br>
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_GRADE()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
   
    <div class="modal fade" id="Gestion_SPECIALITE_MODAL" role="dialog">
		<div class="modal-dialog">
		<form action="" class="formName">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">INFORMATION SUR LA SPECIALITE</h4>
			</div>
			<div class="modal-body">
				 
						<div class="form-group">
						<label>Enter le nom du specialite </label>
						<input type="text" placeholder="Specialite" class="name form-control" id="SpecialiteTEXT" required />

						<br>
						
						<br>
						</div>
				
			</div>
			<div class="modal-footer">
			  <button type="button" onclick="ENREGISTRER_GESTTION_SPECIALITE()" class="btn btn-primary">Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
			</div>
		  </div>
		  </form>
		 
		
		
		</div>
  </div>
   
</body>
</html>


<?php
if (isset($_POST['AJOUTER_UNIVERSITY'])){
if (!empty($_POST['VILLE_ADD_GU']) && !empty($_POST['univ_ADD_GU']))
{
$ville = $_POST['VILLE_ADD_GU'] ; 
$univ = $_POST['univ_ADD_GU'] ; 


$sql = " INSERT INTO `universite`(`CODE_VILLE`, `NOM_UNIVERSITE`) VALUES ('$ville','$univ') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
} 
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
}

if (isset($_POST['AJOUTER_VILLE'])){

if (!empty($_POST['ville_ADD_GV']))
{	
$ville = $_POST['ville_ADD_GV'] ; 



$sql = " INSERT INTO `ville`(`NOM_VILLE`) VALUES ('$ville') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}

if (isset($_POST['AJOUTER_Etablissmenent'])){
if (!empty($_POST['etabissment_ADD_GE']) and !empty($_POST['UNIVERSITY_ADD_GE']))
{
$etab = $_POST['etabissment_ADD_GE'] ; 
$university = $_POST['UNIVERSITY_ADD_GE'] ; 




$sql = " INSERT INTO `etablissement`( `CODE_UNIVERSITE`, `NOM_ETA`) VALUES ($university,'$etab') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}



if (isset($_POST['AJOUTER_Departement'])){
if (!empty($_POST['ETABLISSMENT_ADD_GDept']) and !empty($_POST['departement_ADD_GDept']))
{
$etab = $_POST['ETABLISSMENT_ADD_GDept'] ; 
$dept = $_POST['departement_ADD_GDept'] ; 


$sql = " INSERT INTO `departement`( `CODE_ETA`, `NOM_DEPT`) VALUES ($etab,'$dept') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}


if (isset($_POST['AJOUTER_DOMAINE'])){
if (!empty($_POST['DOMAINE_ADD_GDomaine']))
{
$domaine = $_POST['DOMAINE_ADD_GDomaine'] ; 



$sql = " INSERT INTO `domaine`(`NOM_DOMAINE`) VALUES ('$domaine') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}

if (isset($_POST['AJOUTER_DIPLOME'])){
if (!empty($_POST['Diplome_ADD_GDiplome']) && !empty($_POST['Type_ADD_GDiplome']))
{  
$diplome = $_POST['Diplome_ADD_GDiplome'] ; 
$type = $_POST['Type_ADD_GDiplome'] ; 


$sql = " INSERT INTO `diplomes`(`TYPE`, `NOM_DIPLOME`) VALUES ('$type','$diplome') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
} 
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
}




if (isset($_POST['AJOUTER_Grade'])){
if (!empty($_POST['GRADE_ADD_GGrade']))
{
$grade = $_POST['GRADE_ADD_GGrade'] ; 



$sql = " INSERT INTO `grade_crm`(`NOM_GRAD`) VALUES ('$grade') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}


if (isset($_POST['AJOUTER_Specialite'])){
if (!empty($_POST['SPECIALITE_ADD_SPECIALITE']))
{
$specialite = $_POST['SPECIALITE_ADD_SPECIALITE'] ; 



$sql = " INSERT INTO `specialite_crm`(`NOM_SPEC`) VALUES ('$specialite') ; "; 
		if (mysqli_query($ma_connexion, $sql)) {
		
		echo "<meta http-equiv='refresh' content='0' />";	
	} else {
		echo "Error updating record: aa " . mysqli_error($ma_connexion);
	}
}
else{
	echo "<script >
		
		swal(
				'ERREUR!',
				'VOUS AVEZ MANQUEZ DE REMPLIR UN CHAMP.',
				'error'
				) 
				</script> "  ; 
}
		 
}





?>
