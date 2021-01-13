<?php  

include '../connexion.php';


if (isset($_POST['valueKK']))
  {
        $valueKK=$_POST['valueKK'];
        $idmat=$_POST['idmat'];
  
        $test = explode("/", $idmat);

        mysqli_query($ma_connexion," UPDATE filiere SET avancement = $valueKK where CODE_FIL= '".$test[1]."' ");

                
    }
?> 