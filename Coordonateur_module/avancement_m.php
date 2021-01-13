<?php  

include '../connexion.php';


if (isset($_POST['valueKK']))
  {
        $valueKK=$_POST['valueKK'];
        $idmat=$_POST['idmat'];
  
        $test = explode("/", $idmat);

        mysqli_query($ma_connexion," UPDATE module SET avancement = $valueKK where CODE_MODU= '".$test[1]."' ");

                
    }
?> 