<?php 

include '../../connexion.php';


if(isset($_POST['id_univ']))
{
	
	
	$nom_university=mysqli_real_escape_string($ma_connexion,$_POST['nom_university']);
	$id_ville= $_POST['id_ville']; 
	$id_univ =  $_POST['id_univ']; 
	mysqli_query($ma_connexion,"UPDATE `universite` SET `CODE_VILLE`=  $id_ville ,`NOM_UNIVERSITE`=  '$nom_university' WHERE `CODE_UNIVERSITE`= $id_univ  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_univ =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `universite`  WHERE `CODE_UNIVERSITE`= $id_univ  ");
	
	
	
	
}
?>