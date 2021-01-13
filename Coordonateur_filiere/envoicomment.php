<?php 
include '../connexion.php';
if(isset($_POST['idfil']))
{
	$content=mysqli_real_escape_string($ma_connexion,$_POST['content']);
	$idf= $_POST['idfil']; 
	$user= $_POST['user']; 
	$date_comm = date('Y-m-d');
	$datinsert = date('Y-m-d', strtotime($date_comm)) ; 
	$timesinsert = gmdate('h:i:s');
	mysqli_query($ma_connexion,"INSERT INTO `commentaiire`(`CODE_FIL`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`)
									     VALUES('$idf','$content',$user,'CORDFIL','$datinsert','$timesinsert') ");

}

if(isset($_POST['idmat']))
{
	$content=mysqli_real_escape_string($ma_connexion,$_POST['content']);
	$idmat= $_POST['idmat']; 
	$user= $_POST['user']; 
	$date_comm = date('Y-m-d');
	$datinsert = date('Y-m-d', strtotime($date_comm)) ; 
	$timesinsert = gmdate('h:i:s');
	mysqli_query($ma_connexion,"INSERT INTO `commentaiireens`(`CODE_MAT`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`)
									     VALUES('$idmat','$content',$user,'ENS','$datinsert','$timesinsert') ");

}

?>

