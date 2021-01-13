<?php 
include '../connexion.php';
if(isset($_POST['lesIDi']))
{
	
	
	$lesIDi = $_POST['lesIDi'] ;
	$outtes = explode(" ",$lesIDi);
    foreach ($outtes as  $value) 
    {
	  
      if($value != "")
		  mysqli_query($ma_connexion,"DELETE FROM `filiere_motcles` WHERE `CODE_MOTCLE` = $value ");

  
	}

}



?>
