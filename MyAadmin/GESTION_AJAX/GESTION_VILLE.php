<?php 

include '../../connexion.php';


if(isset($_POST['nomville']))
{
	
	
	$nomville=mysqli_real_escape_string($ma_connexion,$_POST['nomville']);
	$id_ville= $_POST['id_ville']; 
	 
	mysqli_query($ma_connexion,"UPDATE `ville` SET `NOM_VILLE`= '$nomville' WHERE `CODE_VILLE`= $id_ville  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_ville =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `ville`  WHERE `CODE_VILLE` = $id_ville  ");
	
	
	
	
}
?>