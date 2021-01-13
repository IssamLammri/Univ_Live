<?php
	include '../connexion.php';

    if (isset($_POST['indice']))
    {
		$indice=$_POST['indice'];
		$departActive=$_POST['departActive'];
		$id=$_POST['id'];
		
		if ($indice == 'Filiere')
		{
        
			$sql= "SELECT   DISTINCT ( c.CODE_COR_MODU ) , c.NOM_COR_MODU , c.PRENOM_COR_MODU 
						FROM coordonateur_module c , module m
						where c.CODE_COR_MODU = m.CODE_COR_MODU
						and m.CODE_FIL = '$id' ";  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun resultat </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_COR_MODU']  ; 
					$nomcordM = $row['NOM_COR_MODU']  ; 
					$prenomcordM = $row['PRENOM_COR_MODU']  ; 
					
					
					echo "<option value='$codCord' > $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
		
		
		if ($indice == 'Grade')
		{
        
			$sql= "SELECT   DISTINCT ( CODE_COR_MODU ) , NOM_COR_MODU , PRENOM_COR_MODU 
						FROM coordonateur_module 
						where `GRADE_COR_MODU` = $id 
						and  CODE_DEPT  =  $departActive ";  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun cordonateur pour ce grad  </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_COR_MODU']  ; 
					$nomcordM = $row['NOM_COR_MODU']  ; 
					$prenomcordM = $row['PRENOM_COR_MODU']  ; 
					
					
					echo "<option value='$codCord' > $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
		
		if ($indice == 'Specialite')
		{
        
			$sql= "SELECT   DISTINCT ( CODE_COR_MODU ) , NOM_COR_MODU , PRENOM_COR_MODU 
						FROM coordonateur_module 
						where `SPECIALITE_COR_MODU` = $id 
						and  CODE_DEPT  =  $departActive "; 
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun resultat </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_COR_MODU']  ; 
					$nomcordM = $row['NOM_COR_MODU']  ; 
					$prenomcordM = $row['PRENOM_COR_MODU']  ; 
					
					
					echo "<option value='$codCord' > $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
    }else{

        echo '<option>Error</ption>';
    }


?>