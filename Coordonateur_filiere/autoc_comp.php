 <?php
  include '../connexion.php';

 if(isset($_POST['dom']) && isset($_POST['com']) && isset($_POST['source_comp']))  
 {  
      $output = '';  
      $sql= "SELECT * FROM competence WHERE COMPETNECE LIKE '%".$_POST["com"]."%' AND CODE_DOMAINE='".$_POST["dom"]."' AND source_comp='".$_POST["source_comp"]."' AND `CODE_COMP` NOT IN ( SELECT CODE_COMP
                                        FROM compfiliere
                                        where CODE_FIL = '$filiereactive' )  " ;
      $result = mysqli_query($ma_connexion, $sql);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["source_comp"].':'.$row["COMPETNECE"].'</li>';
           }  
      }
      echo $output;
  }

  if(isset($_POST['dom1']) && isset($_POST['source_comp1']))
  {
        $dom1=$_POST['dom1'];
        $filiereactive=$_POST['filiereActive'];
        $source_comp1=$_POST['source_comp1'];
    
        $sql= " SELECT `CODE_COMP` , `COMPETNECE`
        FROM competence
        WHERE `CODE_DOMAINE` = $dom1
                AND `source_comp`='$source_comp1'
        AND `CODE_COMP` NOT IN ( SELECT CODE_COMP
                                        FROM compfiliere
                                        where CODE_FIL = '$filiereactive' ) ";
                    
                    
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option value="0" disabled selected>Aucunes competances pour ce domaine </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
                <option value="<?php echo $row['CODE_COMP']; ?>"><?php echo $row['COMPETNECE']; ?></option>
                <?php
            }
        }
    }else{

        echo '<option>Error</option>';
    }




?>