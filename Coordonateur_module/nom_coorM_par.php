<?php  
session_start();
include '../connexion.php';
 
if(isset($_POST["testin"]))  
{  
      $code=$_POST['testin'];

    $test = explode("/", $code);

      echo '
      <label class="control-group">Nom Module : '.$test[1].' </label><br><br>

      <label class="control-group">Partagée par Le coordonateur De Module  : '.$test[0].'</label>';

}

?> 