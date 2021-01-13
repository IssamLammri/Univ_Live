<?php



function remplir_ville() {

	
	include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}

function remplir_university() {

	
  include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}


function remplir_etablissment() {
	include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}


function remplir_department() {
 include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}


function remplir_Domaine() {
 include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}


function remplir_Diplome() {
 include '../connexion.php';
    $sql= "select * from universite ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="" disabled selected>Merci de choisir l\'university </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_UNIVERSITE']; ?>" ><?php echo $row['NOM_UNIVERSITE']; ?></option>
            <?php
        }
    }

}


function remplir_Specialite() {
 include '../connexion.php';
    $sql= "select * from specialite_crm ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="0" disabled selected>Merci de choisir le grade </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_SPEC']; ?>" ><?php echo $row['NOM_SPEC']; ?></option>
            <?php
        }
    }

}


function remplir_Grade() {
 include '../connexion.php';
    $sql= "select * from grade_crm ";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
      
    }else{
		 echo '<option value="0" disabled selected>Merci de choisir la specialite </option>';
        while($row = mysqli_fetch_assoc($query))
        {
            ?>
            <option value="<?php echo $row['CODE_GRAD']; ?>" ><?php echo $row['NOM_GRAD']; ?></option>
            <?php
        }
    }

}


