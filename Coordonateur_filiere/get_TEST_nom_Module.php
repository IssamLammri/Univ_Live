<?php
	include '../connexion.php';

    if (isset($_POST['nomModule']))
    {
		
		$nomModule=$_POST['nomModule'];
		$idf=$_POST['idf'];
		
		
		
        
			$sql= "SELECT CODE_MODU
					FROM module
					WHERE NOM_MODU = '$nomModule' 
					AND CODE_FIL = '$idf' " ;  
						  
																																											
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