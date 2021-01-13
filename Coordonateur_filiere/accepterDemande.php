<?php
	include '../connexion.php';

    if (isset($_POST['active'])) 
	{
        $codefil=$_POST['codefil'];
        $codecord=$_POST['codecord'];
        $active=$_POST['active'];
		
        $sql= " INSERT INTO `filiere_partagee`(`CODE_FIL`, `CODE_CORF_v`, `CODE_CORF_C`) VALUES ('$codefil',$codecord,$active) ";
                    
               
       	if (mysqli_query($ma_connexion, $sql)) {
			
		} else {

		}
		
		$sql= "DELETE FROM `filiere_demandes` WHERE CODE_FIL = '$codefil'  AND CODE_CORD_DEM =  $codecord ";
                    
               echo $sql ;      
       	if (mysqli_query($ma_connexion, $sql)) {
			
		} else {

		}
	}
	
	if (isset($_POST['codefildemande'])) 
	{
        $codefil=$_POST['codefildemande'];
        $codecord=$_POST['codecord'];
        
		$sql= "DELETE FROM `filiere_demandes` WHERE CODE_FIL = '$codefil'  AND CODE_CORD_DEM =  $codecord ";
                    
                 
       	if (mysqli_query($ma_connexion, $sql)) {
			
		} else {

		}
	}
   


?>