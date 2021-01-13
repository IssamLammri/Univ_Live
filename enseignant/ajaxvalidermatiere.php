<?php 


$conn = mysqli_connect('localhost', 'root', '', 'pfe');
mysqli_set_charset($conn,"utf8");

if(isset($_POST['nommat']))
{
	$nommat=mysqli_real_escape_string($conn,$_POST['nommat']);
	$volumeglobal= $_POST['volumeglobal']; 
	$volumeCour= $_POST['volumeCour']; 
	$volumeTP= $_POST['volumeTP']; 
	$volumeTD= $_POST['volumeTD']; 
	$volumeAP= $_POST['volumeAP']; 
	$idmat= $_POST['idmat']; 
	$idmodule= $_POST['idmodule']; 
	$enseignant= $_POST['enseignant']; 
	
	$intervention= $_POST['intervention']; 
	$pieces = explode("/", $intervention);
	$CoursINT = $pieces[0];
	$TDINT = $pieces[1];
	$TPINT = $pieces[2];
	$EncadrementINT = $pieces[3];
	
	$SpecialiteMat= $_POST['SpecialiteMat']; 
	$typeCour= $_POST['typeCour']; 
	mysqli_query($conn,"UPDATE matiere SET  NOM_MAT = '$nommat', VOLUME_HORAIRE_MAT = $volumeglobal , 
	VOLUME_COURS_MAT = $volumeCour , VOLUME_TP_MAT = $volumeTP , VOLUME_TD_MAT = $volumeTD ,  
	VOLUME_AP_MAT = $volumeAP , SEPCIALITE_MAT = $SpecialiteMat , type_cour = $typeCour 	where CODE_MAT = '$idmat' ");
	
	
	$sommeREQq = null  ; 
	
	$query001 = "SELECT SUM(m.VOLUME_COURS_MAT)  as sommeREQ                           
	FROM matiere m
	WHERE m.CODE_MODU = '$idmodule' ";				
	$result = mysqli_query($conn, $query001);					
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$sommeREQq = $row['sommeREQ'] ;		
		}
	} else {		
	} 
	mysqli_query($conn,"UPDATE module SET  VOLUME_COURS_MODU = $sommeREQq where CODE_MODU = '$idmodule' ");
	
	
	
	$query001 = "SELECT SUM(m.VOLUME_TD_MAT)  as sommeREQ                           
	FROM matiere m
	WHERE m.CODE_MODU = '$idmodule' ";				
	$result = mysqli_query($conn, $query001);					
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$sommeREQq = $row['sommeREQ'] ;		
		}
	} else {		
	} 
	mysqli_query($conn,"UPDATE module SET  VOLUME_TD_MODU = $sommeREQq where CODE_MODU = '$idmodule' ");
	
	
	$query001 = "SELECT SUM(m.VOLUME_TP_MAT)  as sommeREQ                           
	FROM matiere m
	WHERE m.CODE_MODU = '$idmodule' ";				
	$result = mysqli_query($conn, $query001);					
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$sommeREQq = $row['sommeREQ'] ;		
		}
	} else {		
	} 
	mysqli_query($conn,"UPDATE module SET  VOLUME_TP_MODU = $sommeREQq where CODE_MODU = '$idmodule' ");
	
	
	$query001 = "SELECT SUM(m.VOLUME_AP_MAT)  as sommeREQ                           
	FROM matiere m
	WHERE m.CODE_MODU = '$idmodule' ";				
	$result = mysqli_query($conn, $query001);					
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$sommeREQq = $row['sommeREQ'] ;		
		}
	} else {		
	} 
	mysqli_query($conn,"UPDATE module SET  VOLUME_AP_MODU = $sommeREQq where CODE_MODU = '$idmodule' ");
	
	
	$query001 = "SELECT SUM(m.VOLUME_HORAIRE_MAT)  as sommeREQ                           
	FROM matiere m
	WHERE m.CODE_MODU = '$idmodule' ";				
	$result = mysqli_query($conn, $query001);					
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$sommeREQq = $row['sommeREQ'] ;		
		}
	} else {		
	} 
	mysqli_query($conn,"UPDATE module SET  VOLUME_HORAIRE_MODU = $sommeREQq where CODE_MODU = '$idmodule' ");
	
	
	
	
	
	if ( $CoursINT == '1' )
	{
		$sql = " SELECT * 
			FROM enseigneer
			WHERE CODE_ENS = $enseignant
			AND CODE_INTERVENTION = 1
			AND CODE_MAT =  $idmat  ";
					
	    $result = mysqli_query($conn, $sql);
        
	    if (mysqli_num_rows($result) == 0) 
			
				mysqli_query($conn,"INSERT INTO `enseigneer`(`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES($enseignant,1,$idmat) ");
			
	}
	else{
		mysqli_query($conn,"DELETE FROM `enseigneer` WHERE `CODE_INTERVENTION` = 1  AND `CODE_ENS` = $enseignant  and   CODE_MAT =  $idmat  ");
	    	 
	}
	
	if ( $TDINT == '1' )
	{
		$sql = " SELECT * 
			FROM enseigneer
			WHERE CODE_ENS = $enseignant
			AND CODE_INTERVENTION = 2
			AND CODE_MAT =  $idmat  ";
					
	    $result = mysqli_query($conn, $sql);
        
	    if (mysqli_num_rows($result) == 0) 

				mysqli_query($conn,"INSERT INTO `enseigneer`(`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES($enseignant,2,$idmat) ");
			
			
	}
	else{
		mysqli_query($conn,"DELETE FROM `enseigneer` WHERE `CODE_INTERVENTION` = 2  AND `CODE_ENS` = $enseignant  and   CODE_MAT =  $idmat  ");
	     	 
	}
	
	if ( $TPINT == '1' )
	{
		$sql = " SELECT * 
			FROM enseigneer
			WHERE CODE_ENS = $enseignant
			AND CODE_INTERVENTION = 3
			AND CODE_MAT =  $idmat  ";
					
	    $result = mysqli_query($conn, $sql);
        
	    if (mysqli_num_rows($result) == 0) 

				mysqli_query($conn,"INSERT INTO `enseigneer`(`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES($enseignant,3,$idmat) ");
			
			
	}
	else{
		mysqli_query($conn,"DELETE FROM `enseigneer` WHERE `CODE_INTERVENTION` = 3  AND `CODE_ENS` = $enseignant  and   CODE_MAT =  $idmat  ");
	   	 
	}
	
	
	if ( $EncadrementINT == '1' )
	{
		$sql = " SELECT * 
			FROM enseigneer
			WHERE CODE_ENS = $enseignant
			AND CODE_INTERVENTION = 4
			AND CODE_MAT =  $idmat  ";
					
	    $result = mysqli_query($conn, $sql);
        
	    if (mysqli_num_rows($result) == 0) 

			mysqli_query($conn,"INSERT INTO `enseigneer`(`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES($enseignant,4,$idmat) ");
		
	}
	else{
		mysqli_query($conn,"DELETE FROM `enseigneer` WHERE `CODE_INTERVENTION` = 4  AND `CODE_ENS` = $enseignant  and   CODE_MAT =  $idmat  ");
	    	 
	}
	
	if ( $intervention == '0/0/0/0')
	{
		mysqli_query($conn,"INSERT INTO `enseigneer`(`CODE_ENS`, `CODE_INTERVENTION`, `CODE_MAT`) VALUES($enseignant,0,$idmat) ");
		
	}
	else
	{
		mysqli_query($conn,"DELETE FROM `enseigneer` WHERE `CODE_INTERVENTION` = 0  AND `CODE_ENS` = $enseignant  and   CODE_MAT =  $idmat  ");
	    
	}
	
		
}

if(isset($_POST['content']))
{
	$desc=mysqli_real_escape_string($conn,$_POST['content']);
	$idmat= $_POST['idmat']; 
	mysqli_query($conn,"UPDATE matiere 
						SET  DESCRIPTION_MAT = '$desc'
						where CODE_MAT = $idmat  ");
	
}


?>
