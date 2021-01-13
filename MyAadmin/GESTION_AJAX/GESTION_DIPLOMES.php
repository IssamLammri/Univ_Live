<?php 

include '../../connexion.php';


if(isset($_POST['nom_diplome']))
{
	
	
	$nom_diplome=mysqli_real_escape_string($ma_connexion,$_POST['nom_diplome']);
	$type= $_POST['type']; 
	$id_diplome =  $_POST['id_diplome']; 
	mysqli_query($ma_connexion,"UPDATE `diplomes` SET `TYPE`=  $type ,`NOM_DIPLOME`=  '$nom_diplome' WHERE `CODE_DIPLOME`= $id_diplome  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_diplome =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `diplomes`  WHERE `CODE_DIPLOME`= $id_diplome  ");
	
	
	
	
}
?>