<?php
	include '../connexion.php';

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
		$filiereactive=$_POST['filiereactive'];
        $sql= "SELECT d.CODE_DIPLOME , d.TYPE, d.NOM_DIPLOME
												FROM  diplomes d 
												where d.TYPE = '$id'  ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucun Diplome </ption>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_DIPLOME']; ?>"><?php echo $row['NOM_DIPLOME']; ?></option>

                <?php
            }
        }
    }else{

        echo '<option>Error</ption>';
		
	
    }


?>