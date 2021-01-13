<?php
	include '../connexion.php';

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
        $filiereactive=$_POST['filiereActive'];
        
        $sql= " SELECT CODE_DEBOUCHE_FOR , DEBOUCHE_FOR
				FROM debouche_formation
				WHERE CODE_DOMAINE = $id
				AND CODE_DEBOUCHE_FOR NOT IN (SELECT CODE_DEBOUCHE_FOR
											  FROM  formation_debouche  
											  where CODE_FIL = '$filiereactive' )  ;
											   ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
             echo '<option value="0" disabled selected> Aucun debouche pour ce secteur </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_DEBOUCHE_FOR']; ?>"><?php echo $row['DEBOUCHE_FOR']; ?></option>

                <?php
            }
        }
    }else{

        echo '<option>Error</ption>';
    }


?>
