<?php  
include '../connexion.php';

session_start();
$Etat = $_SESSION['NIV'];
$rest = $_SESSION['info'];

$req6 = ($bd->prepare('Select   CODE_FIL from filiere WHERE CODE_COR_FIL  ="' . $rest . '"'));

$idf=$_POST["idf"];
$req6->execute();
$ress3=$req6->fetchAll();
$idf = implode($ress3[$idf]);
 
 if(isset($_POST["checkbox_value"]))  
 {  
      
    $outp=$_POST["checkbox_value"];
    
    $outtes = explode(" ",$outp);
    foreach ($outtes as  $value) 
    {

      
      $output = ''; 
      if($value != "")
      {
        
      echo '<br>';
   
		  
	$query = 'select distinct Mo.NOM_MODU As NOM_MODU,Mo.CODE_MODU As CODE_MODU
          from module Mo 
          where  Mo.ID_SEMSTRE="'.$value.'"
          AND Mo.CODE_FIL="'.$idf.'"'; 

      $result = mysqli_query($ma_connexion, $query); 
      
      if(mysqli_num_rows($result) > 0)  
      {  
        echo '<input type="text" class="form-control" id="semestre" value="'.$value.'" name="semestre" readonly="">'.'<br>';
        echo '<select NAME="Testing[]" class="form-control" multiple>';
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<option value="'.$row["CODE_MODU"].'" selected>Module : '.$row["NOM_MODU"].'</option>';
           }  
      }
      else
      {
        echo '<center><label>Aucun résultats n a été trouvé pour semestre "'.$value.'" </label><center>';
      }

    
    $output.='<br><br>';
    echo $output;
    echo '</select>';
  }
  
  }

 }

?> 