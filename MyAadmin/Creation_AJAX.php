<?php 

include '../connexion.php';


if(isset($_POST['indiceToSubmit']))
{
	$indiceToSubmit = $_POST['indiceToSubmit'] ; 
	$etablissement = $_POST['etablissement'] ; 
	$departement = $_POST['departement'] ; 
	$nom_ch = $_POST['nom_ch'] ; 
	$prenom_ch = $_POST['prenom_ch'] ; 
	$Grade = $_POST['Grade'] ; 
	$specialite = $_POST['specialite'] ; 
	$pseudo = $_POST['pseudo'] ; 
	$mdp = $_POST['mdp'] ; 
	
	if ( $indiceToSubmit == 'CD')
	{
		$sql = " INSERT INTO chef_departement (CODE_DEPT, PSEUDO,PASSWORD,NOM_CHEF,PRENOM_CHEF,`SPECIALITE_CHEF`, `GRADE_CHEF`) VALUES 
			('$etablissement','$pseudo','$mdp','$nom_ch','$prenom_ch','$specialite','$Grade') ; "; 
	
		if (mysqli_query($ma_connexion, $sql)) {
			

		} else {
				echo '404' ; 
			}
	}
	
	if ( $indiceToSubmit == 'CF')
	{
		$sql = " INSERT INTO `coordonateur_filiere`(`CODE_ETA`, `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_FIL`, `PRENOM_COR_FIL`, `SPCIALITE_COR_FIL`, `GRADE_COR_FIL`)	
			VALUES ('$etablissement','$departement','$pseudo','$mdp','$nom_ch','$prenom_ch','$specialite','$Grade') ; "; 

		if (mysqli_query($ma_connexion, $sql)) {
			

		} else {
				echo '404' ; 
			}
		
	}
	
	if ( $indiceToSubmit == 'CM')
	{
		
		$sql = " INSERT INTO `coordonateur_module`(`CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_COR_MODU`, `PRENOM_COR_MODU`, `SPECIALITE_COR_MODU`, `GRADE_COR_MODU`,`CODE_ETA`) 
			VALUES ('$departement','$pseudo','$mdp','$nom_ch','$prenom_ch','$specialite','$Grade','$etablissement') ; "; 
			
			if (mysqli_query($ma_connexion, $sql)) {
			
			} else {
				echo '404' ; 
			}
	}
	
	if ( $indiceToSubmit == 'ENS')
	{
		
		$sql = " INSERT INTO `enseignant`(`CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_ENS`, `PRENOM_ENS`, `SPECIALTE_ENS`, `GRADE_ENS`) 
				VALUES ('$departement','$pseudo','$mdp','$nom_ch','$prenom_ch','$specialite','$Grade') ; "; 
			
			if (mysqli_query($ma_connexion, $sql)) {
				

			} else {
				echo '404' ; 
			}
	}
	
	
	
	
	
	
}


?>