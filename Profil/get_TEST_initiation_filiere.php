<?php
	include '../connexion.php';

    if (isset($_POST['nomFil']))
    {
		
		$nomFil=$_POST['nomFil'];
		
		
		
        
			$sql= "SELECT CODE_FIL
					FROM filiere
					WHERE NOM_FIL = '$nomFil' " ;  
						  
																																											
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