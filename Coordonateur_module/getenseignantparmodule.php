<?php
	include '../connexion.php';

    if (isset($_POST['indice']))
    {
		$indice=$_POST['indice'];
		$departActive=$_POST['departActive'];
		$EtabActive=$_POST['EtabActive'];
		$id=$_POST['id'];
		
		if ($indice == 'departement')
		{
        
			$sql= "SELECT en.CODE_ENS,en.NOM_ENS,en.PRENOM_ENS 
						FROM enseignant en,departement d,etablissement e
						where en.CODE_DEPT=d.CODE_DEPT
						and  en.CODE_DEPT  =  $departActive 
						and e.CODE_ETA = $EtabActive ";  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun resultat </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_ENS']  ; 
					$nomcordM = $row['NOM_ENS']  ; 
					$prenomcordM = $row['PRENOM_ENS']; 
					
					
					echo "<option value='$codCord'> $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
		
		
		if ($indice == 'Grade')
		{
        
			$sql= "SELECT   CODE_ENS , NOM_ENS , PRENOM_ENS 
						FROM enseignant 
						where `GRADE_ENS` = $id 
						and  CODE_DEPT  =  $departActive ";  
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun enseignant pour ce grad  </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_ENS']  ; 
					$nomcordM = $row['NOM_ENS']  ; 
					$prenomcordM = $row['PRENOM_ENS']  ; 
					
					
					echo "<option value='$codCord' > $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
		
		if ($indice == 'Specialite')
		{
        
			$sql= "SELECT CODE_ENS , NOM_ENS , PRENOM_ENS 
						FROM enseignant 
						where `SPECIALTE_ENS` = $id 
						and  CODE_DEPT  =  $departActive "; 
						  
																																											
			$query=mysqli_query($ma_connexion,$sql) ;
			if(mysqli_num_rows($query) == 0)
			{
				echo '<option>Aucun resultat </option>';
			}else{
				while($row = mysqli_fetch_assoc($query))
				{
					$codCord = $row['CODE_ENS']  ; 
					$nomcordM = $row['NOM_ENS']  ; 
					$prenomcordM = $row['PRENOM_ENS']  ; 
					
					
					echo "<option value='$codCord' > $nomcordM $prenomcordM </option> " ;

					
				}
			}
		}
		
		
    }else{

        echo '<option>Error</option>';
    }


?>