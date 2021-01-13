<?php
	include '../connexion.php';

    if (isset($_POST['dom']) && isset($_POST['com']))
    {
		$nomcompetance=$_POST['nomcompetance'];
			$sql= "SELECT CODE_COMP
					FROM competence
					WHERE COMPETNECE = '$nomcompetance'  " ;  
																																								
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