<?php 
include '../connexion.php';

if(isset($_POST['mat']))
	
{
	$idc= $_POST['idComment']; 
	$textcontent=mysqli_real_escape_string($ma_connexion,$_POST['textcontent']);
	$user= $_POST['user']; 
	$date_comm = date('Y-m-d');
	$datinsert = date('Y-m-d', strtotime($date_comm)) ; 
	$timesinsert = gmdate('h:i:s');
	
	
	
	
	mysqli_query($ma_connexion,"INSERT INTO `commentaiirereplyens`(`code_comment`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`) VALUES ($idc,'$textcontent',$user,'ENS','$datinsert','$timesinsert') ");

}
else

{
	$idc= $_POST['idComment']; 
	$textcontent=mysqli_real_escape_string($ma_connexion,$_POST['textcontent']);
	$user= $_POST['user']; 
	$date_comm = date('Y-m-d');
	$datinsert = date('Y-m-d', strtotime($date_comm)) ; 
	$timesinsert = gmdate('h:i:s');
	
	
	
	
	mysqli_query($ma_connexion,"INSERT INTO `commentaiirereply`(`code_comment`, `comment`, `UDER`, `TYPE`, `Date_comment`, `time_comment`) VALUES ($idc,'$textcontent',$user,'CORDFIL','$datinsert','$timesinsert') ");

}


?>
