<?php
	include '../connexion.php';

    if (isset($_POST['idfil_foropt']))
    {
        $id=$_POST['idfil_foropt'];

        $sql= "SELECT mc.NOM_MOTCLE , mc.CODE_MOTCLE
														FROM filiere_motCles fo , mot_cle mc  
														WHERE fo.CODE_MOTCLE = mc.CODE_MOTCLE
														AND fo.CODE_FIL  = '$id' ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucune Option </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_MOTCLE']; ?>"><?php echo $row['NOM_MOTCLE']; ?></option>

                <?php
            }
        }
    }
	
	


?>