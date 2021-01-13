<?php
	include '../connexion.php';

    if (isset($_POST['nomOption']))
    {
		
		$nomOption=$_POST['nomOption'];
		
		
		
        
			$sql= "SELECT OPTION_FIL
					FROM option_filiere
					WHERE OPTION_FIL = '$nomOption' " ;  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '0';
			}else{
				echo '1';
			}
		
		
		
		
		
    }


?>