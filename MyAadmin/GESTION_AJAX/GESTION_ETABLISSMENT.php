<?php 

include '../../connexion.php';


if(isset($_POST['nometablissment']))
{
	
	
	$nometablissment=mysqli_real_escape_string($ma_connexion,$_POST['nometablissment']);
	$id_univ =  $_POST['id_univ']; 
	$id_etab= $_POST['id_etab']; 
	 
	mysqli_query($ma_connexion,"UPDATE `etablissement` SET CODE_UNIVERSITE = $id_univ ,`NOM_ETA`= '$nometablissment'  WHERE `CODE_ETA`= $id_etab  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_etab =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `etablissement`  WHERE `CODE_ETA` = $id_etab  ");
	
	
	
	
}
?>