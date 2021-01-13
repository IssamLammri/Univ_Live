<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];

if ( $Etat =="coordonateur filiere") 
{
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

	$req=($bd->query('Select CF.PRENOM_COR_FIL,CF.PSEUDO,CF.NOM_COR_FIL,CF.EMAIL_COR_FIL,CF.TELE_COR_FIL,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_filiere CF,departement D WHERE CODE_COR_FIL="'.$rest.'" AND CF.CODE_DEPT=D.CODE_DEPT'));

	$req1  = ($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from coordonateur_filiere CF,specialite_crm SP WHERE CF.CODE_COR_FIL ="'.$rest.'" AND SP.CODE_SPEC=CF.SPCIALITE_COR_FIL'));

	$req3  = ($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from coordonateur_filiere CF,grade_crm GR WHERE CF.CODE_COR_FIL ="'.$rest.'" AND GR.CODE_GRAD=CF.GRADE_COR_FIL'));



	$req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_filiere as C,etablissement as E,universite as U where C.CODE_COR_FIL="'.$rest.'" and C.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE ;'));

	$req4 = ($bd->query('Select count(CODE_FIL)as Nombre_Fil from filiere WHERE CODE_COR_FIL="'.$rest.'"'));
	$req5 = ($bd->prepare('Select NOM_FIL from filiere WHERE CODE_COR_FIL="'.$rest.'"'));
	$req6 = ($bd->prepare('Select CODE_FIL from filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));

	$ress = $req->fetch();
	$ress11 = $req1->fetch();
	$ress22 = $req3->fetch();
	$ress1= $req4->fetch();
	$ress3= $req2->fetch();
	$req5->execute();
	$ress2  =  $req5->fetchAll();
	$prenom = $ress['PRENOM_COR_FIL'];
	$nom    = $ress['NOM_COR_FIL'];
	$Pseudo    = $ress['PSEUDO'];
	$sep    = $ress11['NOM_SPEC'];
	$code_sep=$ress11['CODE_SPEC'];
	$grade = $ress22['NOM_GRAD'];
	$code_grade = $ress22['CODE_GRAD'];
	$email    = $ress['EMAIL_COR_FIL'];
	$tele    = $ress['TELE_COR_FIL'];
	$nom_dept = $ress['nom_dept'];
	$code_dept=$ress['code_dept'];
	$nom_uni=$ress3['nom_uni'];
	$nom_etab=$ress3['nom_eta'];
	$code_uni=$ress3['code_uni'];
	$code_eta=$ress3['code_eta'];


if(isset($_POST['Modifier1']))
	{

		$code_uni=$_POST['universite'];
		$code_etab=$_POST['etablissement'];
		$code_dept=$_POST['departement'];
		$nom=$_POST['nom'];
		$Pseudo=$_POST['Pseudo'];
		$prenom=$_POST['prenom'];
		$grade=$_POST['grade'];
		$spec=$_POST['Specialite'];
		$email=$_POST['email'];
		$tele=$_POST['tele'];

	$sql= "UPDATE `coordonateur_filiere` SET `CODE_ETA`=$code_etab,`CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_COR_FIL`='".$nom."',`PRENOM_COR_FIL`='".$prenom."',`SPCIALITE_COR_FIL`='".$spec."',`GRADE_COR_FIL`='".$grade."',`EMAIL_COR_FIL`='".$email."',`TELE_COR_FIL`='".$tele."' WHERE `CODE_COR_FIL`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
	}

if(isset($_POST['valider1']))
{

	$newpassword=$_POST['newpassword'];
	$sql= "UPDATE `coordonateur_filiere` SET `PASSWORD`='".$newpassword."' WHERE `CODE_COR_FIL`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
}




}
elseif ( $Etat == "enseignant")
{
	$rest = $_SESSION['info'];

	$req  = ($bd->query('Select E.PRENOM_ENS,E.NOM_ENS,E.PSEUDO,E.EMAIL_ENS,E.TELE_ENS,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from enseignant E,departement D WHERE E.CODE_ENS ="'.$rest.'" AND D.CODE_DEPT=E.CODE_DEPT '));


	$req1 =($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from enseignant E,specialite_crm SP WHERE E.CODE_ENS="'.$rest.'" AND SP.CODE_SPEC=E.SPECIALTE_ENS'));

	$req3 =($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from enseignant E,grade_crm GR WHERE E.CODE_ENS ="'.$rest.'" AND GR.CODE_GRAD=E.GRADE_ENS'));




	$req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from enseignant as C,etablissement as E,universite as U,departement as D where C.CODE_ENS  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

	$req4 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM intervient WHERE CODE_ENS="'.$rest.'"'));
	$req5 = ($bd->prepare('SELECT 	m.NOM_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT'));
	$req6 = ($bd->prepare('SELECT 	m.CODE_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT '));
	$ress = $req->fetch();
	$ress3 = $req2->fetch();
	$ress1= $req4->fetch();
	$ress11 = $req1->fetch();
	$ress22 = $req3->fetch();
	$req5->execute();
	$ress2  =  $req5->fetchAll();
	$prenom = $ress['PRENOM_ENS'];
	$nom = $ress['NOM_ENS'];
	$Pseudo    = $ress['PSEUDO'];
	$sep    = $ress11['NOM_SPEC'];
	$code_sep=$ress11['CODE_SPEC'];
	$grade = $ress22['NOM_GRAD'];
	$code_grade = $ress22['CODE_GRAD'];
	$email    = $ress['EMAIL_ENS'];
	$tele    = $ress['TELE_ENS'];
	$nom_dept = $ress['nom_dept'];
	$code_dept=$ress['code_dept'];

	$nom_uni=$ress3['nom_uni'];
	$nom_etab=$ress3['nom_eta'];
	$code_uni=$ress3['code_uni'];
	$code_eta=$ress3['code_eta'];

	if(isset($_POST['Modifier1']))
	{

		$code_uni=$_POST['universite'];
		$code_etab=$_POST['etablissement'];
		$code_dept=$_POST['departement'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$Pseudo=$_POST['Pseudo'];
		$grade=$_POST['grade'];
		$spec=$_POST['Specialite'];
		$email=$_POST['email'];
		$tele=$_POST['tele'];

	$sql= "UPDATE `enseignant` SET `CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_ENS`='".$nom."',`PRENOM_ENS`='".$prenom."',`SPECIALTE_ENS`='".$spec."',`GRADE_ENS`='".$grade."',`EMAIL_ENS`='".$email."',`TELE_ENS`='".$tele."' WHERE `CODE_ENS`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
	}


	if(isset($_POST['valider1']))
	{

	$newpassword=$_POST['newpassword'];
	$sql= "UPDATE `enseignant` SET `PASSWORD`='".$newpassword."' WHERE `CODE_ENS`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
	}

}

elseif ($Etat =="Coordonnateur Module")
{
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
	
	
	$req=($bd->query('Select CM.PRENOM_COR_MODU,CM.PSEUDO,CM.NOM_COR_MODU,CM.EMAIL_COR_MODU, CM.TELE_COR_MODU, D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_module CM,departement D WHERE CM.CODE_COR_MODU="'.$rest.'" AND CM.CODE_DEPT=D.CODE_DEPT'));

	$req1 =($bd->query('Select SP.CODE_SPEC,SP.NOM_SPEC from coordonateur_module CM,specialite_crm SP WHERE CM.CODE_COR_MODU="'.$rest.'" AND SP.CODE_SPEC=CM.SPECIALITE_COR_MODU'));

	$req3 =($bd->query('Select GR.NOM_GRAD,GR.CODE_GRAD from coordonateur_module CM,grade_crm GR WHERE CM.CODE_COR_MODU ="'.$rest.'" AND GR.CODE_GRAD=CM.GRADE_COR_MODU'));


	$req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_module as CM,etablissement as E,universite as U,departement as D where CM.CODE_COR_MODU="'.$rest.'" and CM.CODE_DEPT=D.CODE_DEPT and CM.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

	$req4 = ($bd->query('Select  count(CODE_MODU)as Nombre_Modu from module WHERE CODE_COR_MODU="'.$rest.'"'));
	$req5 = ($bd->prepare('Select NOM_MODU from module WHERE CODE_COR_MODU="'.$rest.'"'));
	$req6 = ($bd->prepare('Select CODE_MODU from module WHERE CODE_COR_MODU  ="'.$rest.'"'));

	$ress = $req->fetch();
	$ress3 = $req2->fetch();
	$ress1= $req4->fetch();
	$ress11 = $req1->fetch();
	$ress22 = $req3->fetch();
	$req5->execute();
	$ress2  =  $req5->fetchAll();

	$prenom = $ress['PRENOM_COR_MODU'];
	$nom    = $ress['NOM_COR_MODU'];
	$Pseudo =$ress['PSEUDO'];
	$sep    = $ress11['NOM_SPEC'];
	$code_sep=$ress11['CODE_SPEC'];
	$grade = $ress22['NOM_GRAD'];
	$code_grade = $ress22['CODE_GRAD'];
	$email    = $ress['EMAIL_COR_MODU'];
	$tele    = $ress['TELE_COR_MODU'];
	$nom_dept = $ress['nom_dept'];
	$code_dept=$ress['code_dept'];

	$nom_uni=$ress3['nom_uni'];
	$nom_etab=$ress3['nom_eta'];
	$code_uni=$ress3['code_uni'];
	$code_eta=$ress3['code_eta'];

	if(isset($_POST['Modifier1']))
	{

		$code_uni=$_POST['universite'];
		$code_etab=$_POST['etablissement'];
		$code_dept=$_POST['departement'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$Pseudo=$_POST['Pseudo'];
		$grade=$_POST['grade'];
		$spec=$_POST['Specialite'];
		$email=$_POST['email'];
		$tele=$_POST['tele'];

	$sql= "UPDATE `coordonateur_module` SET `CODE_ETA`=$code_etab,`CODE_DEPT`=$code_dept,`PSEUDO`='".$Pseudo."',`NOM_COR_MODU`='".$nom."',`PRENOM_COR_MODU`='".$prenom."',`SPECIALITE_COR_MODU`='".$spec."',`GRADE_COR_MODU`='".$grade."',`EMAIL_COR_MODU`='".$email."',`TELE_COR_MODU`='".$tele."' WHERE `CODE_COR_MODU`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
	}

	if(isset($_POST['valider1']))
	{

	$newpassword=$_POST['newpassword'];
	$sql= "UPDATE `coordonateur_module` SET `PASSWORD`='".$newpassword."' WHERE `CODE_COR_MODU`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
	}


}
elseif ($Etat =="Chef Departement")
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req  = ($bd->query('Select NOM_CHEF , PRENOM_CHEF ,SPECIALITE_CHEF from chef_departement WHERE  CODE_CHEF_DEPT="'.$rest.'"'));
	$req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA       from chef_departement as C  , Etablissement as E  , universite as U , departement as D  where 	C.CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
	$req3 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA       from chef_departement as C  , Etablissement as E  , universite as U , departement as D  where 	C.CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
	$req4 = ($bd->query('select count(F.CODE_FIL) as nombre_Fil from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
	$req5 = ($bd->prepare('select NOM_FIL  from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
	$req6 = ($bd->prepare('select CODE_FIL from chef_departement as C , departement as D , filiere as F where CODE_CHEF_DEPT="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_DEPT=F.CODE_DEPT ;' ));
	$ress=$req->fetch();
	$ress1=$req4->fetch();
	$req5->execute();
	$ress2=$req5->fetchAll();
	$prenom = $ress['PRENOM_CHEF'];
	$nom    = $ress['NOM_CHEF'];
	$sep    = $ress['NOM_SPEC'];
	$code_sep=$ress['CODE_SPEC'];
	$grade = $ress['NOM_GRAD'];
	$code_grade = $ress['CODE_GRAD'];
	$nb     = $ress1['nombre_Fil'];
	$nb     = $nb-1;

	if(isset($_POST['valider1']))
	{

	$newpassword=$_POST['newpassword'];
	$sql= "UPDATE `chef_departement` SET `PASSWORD`='".$newpassword."' WHERE `CODE_CHEF_DEPT`='".$rest."' ";
		$result=mysqli_query($ma_connexion,$sql);
		echo "<meta http-equiv='refresh' content='0' />";
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
 header('Location: ../index.php');

}
if (!isset($_SESSION['NIV'])) 
{
 header('Location: ../index.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Paramètre Profil</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">   

</head>


<body>
	<!--Barre de navigation
	=====================================-->
	    <!-- Navigation -->
	     <?php 
	   
	   if( $Etat == "enseignant")
	   include("../includes/nav-bar-ens.php");

	    else if($Etat == "coordonateur filiere")
	    include("../includes/nav-bar-fil.php");

		else if($Etat == "Coordonnateur Module")
	    include("../includes/nav-bar-mod.php");
	    ?> 
	     

    <!--contenu
	=====================================-->
	<br>
	<div class="container">
		<br>
			
				<!--block de progression
				====================================-->
				<div class="well modifier-profil">					
						<ul class="nav nav-tabs">
						    <li class="active"><a href="#InfoEnseignant" data-toggle="tab"><?php echo $Etat ?></a></li>
						    <li><a href="#password" data-toggle="tab">Mot de Passe</a></li>
						</ul>
						<div class="tab-content">
						    <div class="tab-pane active" id="InfoEnseignant">
						    	<form class="form-horizontal" method="POST" action="">
						    		<br>
						    		<div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Université</label>
						                    <div class="col-xs-4">
						                        <select class="form-control" name="universite" id="universite">												
						                        <?php
						                        	echo '
						                        	<option value="'.$code_uni.'" selected>'.$nom_uni.'</option>';
						                        	$sql= "select * from universite WHERE CODE_UNIVERSITE !='$code_uni'";
													$result=mysqli_query($ma_connexion,$sql);
													if(mysqli_num_rows($result) > 0)  
													{
													while($row = mysqli_fetch_array($result))  
													{  
												echo'<option value="'.$row['CODE_UNIVERSITE'].'">'.$row['NOM_UNIVERSITE'].'</option>';
													}
													}
						                        	?>
												</select>
						                    </div>
						            </div>
						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Etablissement</label>
						                    <div class="col-xs-4">
						                        <select list="cookies2" class="form-control" name="etablissement" id="etablissement">		
													<?php
						                        	echo '
						                        	<option value="'.$code_eta.'" selected>'.$nom_etab.'</option>';
						                        	?>
												</select>
						                    </div>
						            </div>
						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Département</label>
						                    <div class="col-xs-4">
						                        <select class="form-control" name="departement" id="departement">
						                        <?php
						                        	echo '
						                        	<option value="'.$code_dept.'" selected>'.$nom_dept.'</option>';
						                        ?>
												</select>
						                    </div>
						            </div>
						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Nom</label>
						                    <div class="col-xs-4">
						                        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom ?>" placeholder="nom">
						                    </div>
						            </div>
						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Prenom</label>
						                    <div class="col-xs-4">
						                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom ?>" placeholder="prenom">
						                    </div>
						            </div>
						            <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Grade</label>
						                    <div class="col-xs-4">
						                        <select class="form-control" name="grade" id="grade">												
						                        <?php
						                        	echo '
						                        	<option value="'.$code_grade.'" selected>'.$grade.'</option>';
						                        	$sql= "select * from grade_crm WHERE CODE_GRAD !='$code_sep'";
													$result=mysqli_query($ma_connexion,$sql);
													if(mysqli_num_rows($result) > 0)  
													{
													while($row = mysqli_fetch_array($result))  
													{  
												echo'<option value="'.$row['CODE_GRAD'].'">'.$row['NOM_GRAD'].'</option>';
													}
													}
						                        	?>
												</select>
						                    </div>
						            </div>
						              <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Spécialité</label>
						                    <div class="col-xs-4">
						                       <select class="form-control" name="Specialite" id="Specialite">												
						                        <?php
						                        	echo '
						                        	<option value="'.$code_sep.'" selected>'.$sep.'</option>';
						                        	$sql= "select * from specialite_crm WHERE CODE_SPEC !='$code_sep'";
													$result=mysqli_query($ma_connexion,$sql);
													if(mysqli_num_rows($result) > 0)  
													{
													while($row = mysqli_fetch_array($result))  
													{  
												echo'<option value="'.$row['CODE_SPEC'].'">'.$row['NOM_SPEC'].'</option>';
													}
													}
						                        	?>
												</select>
						                    </div>
						             </div>

						             <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Pseudo</label>
						                    <div class="col-xs-4">
						                       <input type="text" class="form-control" name="Pseudo" onkeyup="testImpossibleop(this)" id="Pseudo" value="<?php echo $Pseudo ?>" placeholder="Pseudo">
						                    </div>
						             </div>
						              <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
						                    <div class="col-xs-4">
						                       <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" placeholder="Email">
						                    </div>
						             </div>
						             <div class="form-group">
						                <label for="inputEmail3" class="col-sm-4 control-label">Téléphone</label>
						                    <div class="col-xs-4">
						                       <input type="text" class="form-control" pattern="[0][6|5|7][0-9]{8}" name="tele" id="tele" value="<?php echo $tele ?>" placeholder="Téléphone:[0[6-5-7]XXXXXXXX]">
						                    </div>
						             </div>
						             <div class="form-group">
							            <label for="inputEmail3" class="col-sm-4 control-label"></label>
							            	<div class="col-xs-4">
											<button type="submit" id="Modifier1" name="Modifier1" value="modifier" class="btn btn-default btn-lg btn-block">Modifier</button>
							             	</div>	                    
							        </div>
						    	</form>

							        
						    </div>

						  
						    <div class="tab-pane" id="password">
						   		<form class="form-horizontal" method="POST" action="" onsubmit="return checkall();">
							    		<br>
							    	<div class="form-group">
							            <label for="password" class="col-sm-4 control-label">Ancien mot de passe</label>
											<div class="col-xs-4">
							                	<input type="password" class="form-control" name="passwordold" id="passwordold" placeholder="Ancien mot de passe" required>
							                </div>
							                <div class="col-xs-4" id="confirmation_pass0">
							                </div>	  	                    
							        </div>	
							        <div class="form-group">
							            <label for="newpassword" class="col-sm-4 control-label">Nouveau mot de passe</label>
											<div class="col-xs-4">
							                	<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nouveau mot de passe" required>
							                </div>            
							        </div>	
							        <div class="form-group">
							            <label for="newpassword1" class="col-sm-4 control-label">Retaper mot de passe</label>
											<div class="col-xs-4">
							                	<input type="password" class="form-control" name="newpassword1" id="newpassword1" placeholder="Retaper mot de passe" required>
							                </div>
							                <div class="col-xs-4" id="confirmation_pass1">
							                	<label class="col-sm-8 control-label" id="confirmation_pass13"></label>
							                </div>	                    
							        </div>	
							      
							      
							        <div class="form-group">
							            <label for="inputEmail3" class="col-sm-4 control-label"></label>
							            	<div class="col-xs-4">
											<button type="submit" id="valider1" name="valider1" class="btn btn-default btn-lg btn-block">Modifier</button>
							             	</div>	                    
							        </div>
							        
						        </form>					    	
						    </div>
						  		
					
				</div>
						
	</div>



	<!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>

    <script type="text/javascript">
    	$(document).ready(function()
			{	
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

    $('#passwordold').keyup(function(){  
           			var query=$(this).val();
					var dataString = 'query='+ query;
					$.ajax
					({
						type: "POST",
						url: "test_mdp.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							$("#confirmation_pass0").html(html);
						}
					});
      });

    	$('#newpassword1').keyup(function()
    	{  

					var mdpnew= $('#newpassword').val();  
					var mdpnew1= $('#newpassword1').val();  
					if(mdpnew==mdpnew1)
					{
					$.ajax
					({

						success: function()
						{
							$("#confirmation_pass13").html("MOT DE PASS CONFIRME");
						}

					});
				}
				else
				{
					$.ajax
					({

						success: function()
						{
							$("#confirmation_pass13").html("MOT DE PASS NON CONFIRME");
						}

					});
				}

      });
    });

    </script>

    <script type='text/javascript'>

	function checkall()
	{

		var test=$("#validationtt").text();
		var mdp=$('#newpassword').val();
		var newmdp=$('#newpassword1').val();
		

	if(test=="MOT DE PASS VALIDE" && mdp==newmdp)
	{
	return true;
	}
	else
	{
	return false;
	}

	}

	function testImpossibleop(obj)
	{
		var Pseudo = obj.value;
		var dataString2 = 'Pseudo='+ Pseudo;
				$.ajax
					({
						type: "POST",
						url: "test_mdp.php",
						data: dataString2,
						cache: false,
						success: function(html)
						{
							if (html.trim() == "404") 
							{
							swal(
								  'Erreur...',
								  'Ce Pseudo existe Deja',
								  'error'
								)
								$("#Pseudo").val('<?php echo $Pseudo ?>');
							}
			
						}
					});
	}



</script>


</body>
</html>