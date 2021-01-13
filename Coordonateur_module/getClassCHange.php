<?php
	include '../connexion.php';

    if (isset($_POST['indice']))
    {
        $indice=$_POST['indice'];
        $EtabActive=$_POST['EtabActive'];
		
		if ($indice == 'departement')
		{
			echo '<option value="0" style="font-weight: bold;" >departement</option> ' ; 
				
									
				$SQL="select CODE_DEPT,NOM_DEPT from departement where CODE_ETA='$EtabActive' ";
				$query=mysqli_query($ma_connexion,$SQL);
				while($row=mysqli_fetch_assoc($query))
				{	
						$codeDEB = $row['CODE_DEPT'];
						$libelleDEB = $row['NOM_DEPT'];
						echo "<option value='$codeDEB'>$libelleDEB</option>" ; 
				}

		}
		
		
		if ($indice == 'Grade')
		{
			echo '<option value="0" style="font-weight: bold;" >Grade</option> ' ; 
				
									
				$SQL="select CODE_GRAD , NOM_GRAD from grade_crm";
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
			echo '<option value="0" style="font-weight: bold;" >Specialite</option> ' ; 
				
									
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
