<?php  

session_start();
include '../connexion.php';
 

 if(isset($_POST["testin"]))  
 {  
      $code=$_POST['testin'];
      $NOM_FIL="";
      $NOM_COR_FIL="";
      $PRENOM_COR_FIL="";

      $query = "select CF.NOM_COR_FIL,CF.PRENOM_COR_FIL,F.NOM_FIL from coordonateur_filiere CF,filiere F WHERE CF.CODE_COR_FIL='".$code."' AND F.CODE_COR_FIL=CF.CODE_COR_FIL ";


      $result = mysqli_query($ma_connexion, $query); 
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $NOM_FIL=$row['NOM_FIL'];
                $NOM_COR_FIL=$row['NOM_COR_FIL'];
                $PRENOM_COR_FIL=$row['PRENOM_COR_FIL'];
           }
      }
      echo '
      <label class="control-group">Nom Filiere : '.$NOM_FIL.' </label><br><br><br>

      <label class="control-group">Partagée par : '.$NOM_COR_FIL.'&nbsp;'.$PRENOM_COR_FIL.'</label>';

} 

?> 