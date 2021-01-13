<?php 


include '../connexion.php';
if(isset($_POST['vallLike']))
{
	$idc= $_POST['idComment']; 
	$user= $_POST['user']; 
	$vallLike= $_POST['vallLike']; 	
	
	
	
	$sql = " SELECT code_comment , UDER
					FROM commentlikedislike
					WHERE code_comment = $idc AND UDER = $user  ";
					
	    $result = mysqli_query($ma_connexion, $sql);
        
	    if (mysqli_num_rows($result) > 0) {

	    	while($row = mysqli_fetch_assoc($result)) {
	    		
				mysqli_query($ma_connexion,"UPDATE `commentlikedislike` SET `INDICE` = $vallLike  WHERE `commentlikedislike`.`code_comment` = $idc  and  `commentlikedislike`.`UDER` = $user ; ");
	    	 
	    	}
	    }
		
		else
			{
				mysqli_query($ma_connexion,"INSERT INTO `commentlikedislike`(`code_comment`, `UDER`, `TYPE`, `INDICE`) VALUES($idc,$user,'CORDFIL',$vallLike) ");
			
			}
		
	  
	
	
	

}

if(isset($_POST['vallDislike']))
{
	$idc= $_POST['idComment']; 
	$user= $_POST['user']; 
	$vallDislike= $_POST['vallDislike']; 	
	
	
	$sql = " SELECT code_comment , UDER
					FROM commentlikedislike
					WHERE code_comment = $idc AND UDER = $user ";
					
	    $result = mysqli_query($conn, $sql);
        
	    if (mysqli_num_rows($result) > 0) 
		{

	    	while($row = mysqli_fetch_assoc($result)) 
			{
	    		
				mysqli_query($conn,"UPDATE `commentlikedislike` SET `INDICE` = $vallDislike WHERE `commentlikedislike`.`code_comment` = $idc and  `commentlikedislike`.`UDER` = $user  ");
	    	
	    	}
	    }
		
		else
			{
				mysqli_query($conn,"INSERT INTO `commentlikedislike`(`code_comment`, `UDER`, `TYPE`, `INDICE`) VALUES($idc,$user,'CORDFIL',$vallDislike) ");
			
			}

}



?>
