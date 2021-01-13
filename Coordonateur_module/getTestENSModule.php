<?php
	include '../connexion.php';

    if (isset($_POST['nomCC']))
    {
		
		$nomCC=$_POST['nomCC'];
		$prenomCC=$_POST['prenomCC'];
		
		
        
			$sql= "SELECT   DISTINCT ( CODE_ENS ) , NOM_ENS , PRENOM_ENS 
																	FROM enseignant
																	where NOM_ENS = '$nomCC'
																	AND PRENOM_ENS = '$prenomCC' " ;  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '0';
			}else{
				echo '1';
			}
		
		
		
		
		
    }else{

        echo '<option>Error</ption>';
    }


?>