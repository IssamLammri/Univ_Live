<?php
	include '../connexion.php';

    if (isset($_POST['indice']))
    {
        $indice=$_POST['indice'];
        $departActive=$_POST['departActive'];
        
		if ($indice == 'Filiere')
		{
				echo '<option value="0" style="font-weight: bold;" selected disabled >FILIERE</option> ' ; 
				
									
				$SQL="select CODE_FIL , NOM_FIL from filiere  where CODE_DEPT = $departActive;";
				$query=mysqli_query($ma_connexion,$SQL);
				while($row=mysqli_fetch_assoc($query))
				{	
						$codeDEB = $row['CODE_FIL'];
						$libelleDEB = $row['NOM_FIL'];

						echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
				}

								
		}
		
		
		
		
		if ($indice == 'Grade')
		{
			echo '<option value="0" style="font-weight: bold;" selected disabled>Grade</option> ' ; 
				
									
				$SQL="select CODE_GRAD , NOM_GRAD from grade_crm;";
				$query=mysqli_query($ma_connexion,$SQL);
				while($row=mysqli_fetch_assoc($query))
				{	
						$codeDEB = $row['CODE_GRAD'];
						$libelleDEB = $row['NOM_GRAD'];

						echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
				}

		}
		
		if ($indice == 'Specialite')
		{
			echo '<option value="0" style="font-weight: bold;"selected disabled >Specialite</option> ' ; 
				
									
				$SQL="select CODE_SPEC , NOM_SPEC from specialite_crm;";
				$query=mysqli_query($ma_connexion,$SQL);
				while($row=mysqli_fetch_assoc($query))
				{	
						$codeDEB = $row['CODE_SPEC'];
						$libelleDEB = $row['NOM_SPEC'];

						echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
				}

		}
        
       
    }else{

        echo '<option>Error</ption>';
    }


?>
