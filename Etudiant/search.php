<?php  

 $connect = mysqli_connect("localhost", "root", "", "pfe");  
 mysqli_set_charset($connect,"utf8");

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * from filiere F WHERE NATURE_DIPLOME LIKE '%".$_POST["query"]."%' ORDER BY NATURE_DIPLOME LIMIT 1";
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["NATURE_DIPLOME"].'</li>';
           }  
      }
      echo $output;

      $output1 = '';
      $query1 ="SELECT NOM_DIPLOME FROM diplomes WHERE NOM_DIPLOME LIKE '%".$_POST["query"]."%'";
      $result1 = mysqli_query($connect, $query1); 
      if(mysqli_num_rows($result1) > 0)  
      {  
           while($row1 = mysqli_fetch_array($result1))  
           {  
                $output1 .= '<li>'.$row1["NOM_DIPLOME"].'</li>';
           }  
      } 
      echo $output1;

      $output2 = '';
      $query2 ="SELECT NOM_VILLE FROM ville WHERE NOM_VILLE LIKE '%".$_POST["query"]."%'";
      $result2 = mysqli_query($connect, $query2); 
      if(mysqli_num_rows($result2) > 0)  
      {  
           while($row2 = mysqli_fetch_array($result2))  
           {  
                $output2 .= '<li>'.$row2["NOM_VILLE"].'</li>';
           }  
      } 
      echo $output2;

}  

 ?> 