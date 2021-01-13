<?php 

include '../../connexion.php';
if(isset($_POST['nomgrade']))
{
	
	
	$nomgrade=mysqli_real_escape_string($ma_connexion,$_POST['nomgrade']);
	$id_grade= $_POST['id_grade']; 
	 
	mysqli_query($ma_connexion,"UPDATE `grade_crm` SET `NOM_GRAD`= '$nomgrade' WHERE `CODE_GRAD`= $id_grade  ");
	
	
	
	
}
if(isset($_POST['id_delete']))
{
	
	
	$id_grade =  $_POST['id_delete']; 
	mysqli_query($ma_connexion,"delete from  `grade_crm`  WHERE `CODE_GRAD` = $id_grade  ");
	
	
	
	
}
?>