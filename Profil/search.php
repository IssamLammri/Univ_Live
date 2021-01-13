<?php  

include '../connexion.php';
 
 if(isset($_POST["query"]))  
 {  

       $rch1 = mysqli_real_escape_string($ma_connexion, $_POST["query"]) ;
       $code_etab=$_POST['code_etab'];
       $code_dept=$_POST['code_dept'];
      $output = '';  
      $query = "SELECT DISTINCT(m.NOM_MAT), m.CODE_MAT
                FROM matiere m , module mo , filiere f , etablissement e
                WHERE m.CODE_MODU = mo.CODE_MODU
                and mo.CODE_FIL = f.CODE_FIL
                and f.CODE_DEPT =  '$code_dept' 
                and m.NOM_MAT LIKE '%".$rch1."%'";

      $result = mysqli_query($ma_connexion, $query); 
      $output = '<ul class="list-unstyled">'; 

      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li onClick="afficher5(this)" value="'.$row["CODE_MAT"].'">matiere : '.$row["NOM_MAT"].'</li>';
           }  
            echo $output;
      }
      


} 

?> 