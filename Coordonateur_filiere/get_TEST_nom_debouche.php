<?php
	include '../connexion.php';

    if (isset($_POST['nomdebouche']))
    {
		
		$nomdebouche=$_POST['nomdebouche'];
		
		
		
		
        
			$sql= "SELECT CODE_DEBOUCHE_FOR
					FROM debouche_formation
					WHERE DEBOUCHE_FOR = '$nomdebouche'  " ;  
						  
																																											
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