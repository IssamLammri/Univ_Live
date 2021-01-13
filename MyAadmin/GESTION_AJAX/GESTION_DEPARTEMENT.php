<?php 

include '../../connexion.php';


if(isset($_POST['nom_departement']))
{
	
	
	$nom_departement=mysqli_real_escape_string($ma_connexion,$_POST['nom_departement']);
	$id_etab =  $_POST['id_etab']; 
	$id_department= $_POST['id_department']; 
	 
	mysqli_query($ma_connexion,"UPDATE `departement` SET CODE_ETA = $id_etab ,`NOM_DEPT`= '$nom_departement'  WHERE `CODE_DEPT`= $id_department  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_department =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `departement`  WHERE `CODE_DEPT` = $id_department  ");
	
	
	
	
}
?>