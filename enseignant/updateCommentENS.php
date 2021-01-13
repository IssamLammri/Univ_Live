<?php 

include '../connexion.php';



if(isset($_POST['vallLike']))
{
	$idc= $_POST['idComment']; 
	$user= $_POST['user']; 
	$vallLike= $_POST['vallLike']; 	
	
	
	
	$sql = " SELECT code_comment , UDER
					FROM commentlikedislikeens
					WHERE code_comment = $idc AND UDER = $user  ";
					
	    $result = mysqli_query($ma_connexion, $sql);
        
	    if (mysqli_num_rows($result) > 0) {

	    	while($row = mysqli_fetch_assoc($result)) {
	    		
				mysqli_query($ma_connexion,"UPDATE `commentlikedislikeens` SET `INDICE` = $vallLike  WHERE `commentlikedislikeens`.`code_comment` = $idc  and  `commentlikedislikeens`.`UDER` = $user ; ");
	    	 
	    	}
	    }
		
		else
			{
				mysqli_query($ma_connexion,"INSERT INTO `commentlikedislikeens`(`code_comment`, `UDER`, `TYPE`, `INDICE`) VALUES($idc,$user,'ENS',$vallLike) ");
			
			}
		
	  
	
	
	

}





?>
