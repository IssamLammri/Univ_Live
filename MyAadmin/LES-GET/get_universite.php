<?php
	include '../connexion.php';

if (isset($_POST['id']))
{
		$id=$_POST['id'];
        $sql= "select * from universite WHERE CODE_VILLE = $id ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucun resultat</ption>';
        }else{
			 echo '<option value="" disabled selected>Merci de choisir l\'universite </option>';
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                
                <option value="<?php echo $row['CODE_UNIVERSITE']; ?>"><?php echo $row['NOM_UNIVERSITE']; ?></option>

                <?php
            }
        }
    }else{

        echo '<option>Error</ption>';
    }


?>

				