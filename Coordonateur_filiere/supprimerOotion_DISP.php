<?php 
include '../connexion.php';
if(isset($_POST['lesID']))
{
	
	
	$lesID = $_POST['lesID'] ;
	$outtes = explode(" ",$lesID);
    foreach ($outtes as  $value) 
    {
	  
      if($value != "")
		  mysqli_query($ma_connexion,"DELETE FROM `option_filiere` WHERE `CODE_OPTION_FIL` = $value ");

  
	}

}
if(isset($_POST['lesIDi']))
{
	
	
	$lesIDi = $_POST['lesIDi'] ;
	$outtes = explode(" ",$lesIDi);
    foreach ($outtes as  $value) 
    {
	  
      if($value != "")
		  mysqli_query($ma_connexion,"DELETE FROM `decipline_filiere` WHERE `CODE_decipline_FIL` = $value ");

  
	}

}


?>
