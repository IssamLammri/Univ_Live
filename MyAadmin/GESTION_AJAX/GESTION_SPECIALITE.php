<?php 

include '../../connexion.php';

if(isset($_POST['nomspecialite']))
{
	
	
	$nomspecialite=mysqli_real_escape_string($ma_connexion,$_POST['nomspecialite']);
	$id_spec= $_POST['id_spec']; 
	 
	mysqli_query($ma_connexion,"UPDATE `specialite_crm` SET `NOM_SPEC`= '$nomspecialite' WHERE `CODE_SPEC`= $id_spec  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_spec =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `specialite_crm`  WHERE `CODE_SPEC` = $id_spec  ");
	
	
	
	
}
?>