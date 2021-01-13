<?php
	include '../connexion.php';

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
		
        $sql= "SELECT code_pre , prerequis
				FROM prerequis
				WHERE CODE_DOMAINE =  $id  ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucune Prerequis </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['code_pre']; ?>"><?php echo $row['prerequis']; ?></option>

                <?php
            }
        }
    }else{

        echo '<option>Error</ption>';
		
	
    }


?>