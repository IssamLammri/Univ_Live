<?php  
include '../connexion.php';
session_start();
$Etat = $_SESSION['NIV'];
$rest = $_SESSION['info'];
$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $req6 = ($bd->prepare('Select   CODE_FIL from filiere WHERE CODE_COR_FIL  ="' . $rest . '"'));

$idf=$_POST["idf"];
$req6->execute();
$ress3=$req6->fetchAll();
$idf = implode($ress3[$idf]);
 
 if(isset($_POST["option_selected"]))  
 {  
      
    $outp=$_POST["option_selected"];
    $outp1=$_POST["semestre"];
    
    $outtes = explode(" ",$outp);
    foreach ($outtes as  $value) 
    {

      $output = ''; 
      if($value != "")
      {
      echo '<br>';
      $query = 'select Ma.NOM_MAT as NOM_MAT,Ma.CODE_MAT AS CODE_MAT
                  from matiere Ma,module Mo
                  where Mo.CODE_MODU=Ma.CODE_MODU
                  AND Mo.CODE_FIL="'.$idf.'"
                  AND Mo.CODE_MODU="'.$value.'" ';

      $query1 = 'select Mo.NOM_MODU as NOM_MODU, Mo.ID_SEMSTRE
                  from module Mo
                  where Mo.CODE_MODU="'.$value.'" ';
      $result1=mysqli_query($ma_connexion,$query1);
      $nom_modu="";
      $ID_SEMSTRE="";
      while($row1 = mysqli_fetch_array($result1))  
        {  
                $nom_modu=$row1['NOM_MODU'];
                $ID_SEMSTRE=$row1['ID_SEMSTRE'];
        } 

      $result = mysqli_query($ma_connexion, $query); 
      
      if(mysqli_num_rows($result) > 0)  
      {  
        echo '<input type="text" class="form-control" id="semestre" value="Semestre :'.$ID_SEMSTRE.''.'  Module : '.$nom_modu.'" name="semestre" readonly="">'.'<br>';
        echo '<select NAME="TESTING1[]" id="selectid" class="form-control" multiple>';
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<option selected  value="'.$row["CODE_MAT"].'">Matiere : '.$row["NOM_MAT"].'</option>';
           }  
          echo $output;
          echo '</select>';
      }
    
  }
  
  }
  }

?> 