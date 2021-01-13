<?php
	include '../connexion.php';

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
        $filiereactive=$_POST['filiereActive'];
        $source=$_POST['source'];
		
        $sql= " SELECT `CODE_COMP` , `COMPETNECE`
				FROM competence
				WHERE `CODE_DOMAINE` = $id
                AND `source_comp`='$source'
				AND `CODE_COMP` NOT IN ( SELECT CODE_COMP
                                        FROM compfiliere
                                        where CODE_FIL = '$filiereactive' ) ";
                    
                    
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option value="0" disabled selected>Aucunes competances pour ce domaine </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_COMP']; ?>"><?php echo $row['COMPETNECE']; ?></option>

                <?php
            }
        }
    }else{

        echo '<option>Error</option>';
    }


?>