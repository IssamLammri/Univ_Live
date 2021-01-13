<?php 

include '../../connexion.php';

if(isset($_POST['nomdomaine']))
{
	
	
	$nomdomaine=mysqli_real_escape_string($ma_connexion,$_POST['nomdomaine']);
	$id_domaine= $_POST['id_domaine']; 
	 
	mysqli_query($ma_connexion,"UPDATE `domaine` SET `NOM_DOMAINE`= '$nomdomaine' WHERE `CODE_DOMAINE`= $id_domaine  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_domaine =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `domaine`  WHERE `CODE_DOMAINE` = $id_domaine  ");
	
	
	
	
}
?>