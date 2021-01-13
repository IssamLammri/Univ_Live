<?php 
include '../connexion.php';
if(isset($_POST['content']))
{
	$content=mysqli_real_escape_string($ma_connexion,$_POST['content']);
	$idf= $_POST['idfil']; 
	mysqli_query($ma_connexion,"UPDATE filiere SET  commentaire = '$content'  where CODE_FIL = '$idf' ");
	
}



?>
