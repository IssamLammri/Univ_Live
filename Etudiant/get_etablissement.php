<?php
include '../connexion.php';


if (isset($_POST['id']))
{
    $id=$_POST['id'];
    $sql= "select * from etablissement WHERE CODE_UNIVERSITE ='$id'";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
        echo '<option>Aucun resultat</ption>';
    }else{
        while($row = mysqli_fetch_assoc($query))
        {

            ?>
            <option value="0" disabled="" selected="true">--selectionnez un etablissement--</option>
            <option value="<?php echo $row['CODE_ETA']; ?>"><?php echo $row['NOM_ETA']; ?></option>
            <?php
        }
    }
}else{

    echo '<option>Error</option>';
}

