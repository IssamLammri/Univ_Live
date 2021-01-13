<?php
	include '../connexion.php';

    if (isset($_POST['idfil_foropt']))
    {
        $id=$_POST['idfil_foropt'];

        $sql= "SELECT o.CODE_OPTION_FIL , o.OPTION_FIL FROM option_filiere o  WHERE o.CODE_FIL = '$id' ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucune Option </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_OPTION_FIL']; ?>"><?php echo $row['OPTION_FIL']; ?></option>

                <?php
            }
        }
    }
	
	if (isset($_POST['idfil_fordescip']))
    {
        $id=$_POST['idfil_fordescip'];

        $sql= "SELECT d.CODE_decipline_FIL , d.decipline_FIL FROM decipline_filiere d  WHERE d.CODE_FIL = '$id' ";
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucune Option </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_decipline_FIL']; ?>"><?php echo $row['decipline_FIL']; ?></option>

                <?php
            }
        }
    }


?>