<?php
include '../connexion.php';

		$rch1 = $_POST['nomMat'];
		$rch2 = $_POST['nomFil'];
		$rch3 = $_POST['NomMod'];

		$query = "select M.NOM_MAT AS NOM_MAT , MO.NOM_MODU AS NOM_MODU , F.NOM_FIL AS NOM_FIL , M.CODE_MAT AS CODE_MAT
              from matiere M , module MO , filiere F
              where M.CODE_MODU=MO.CODE_MODU
              AND MO.CODE_FIL=F.CODE_FIL
              AND M.CODE_MAT = '".$rch1."'
			  AND MO.CODE_MODU = '".$rch3."'
			  AND F.CODE_FIL = '".$rch2."' ";

              $result = mysqli_query($ma_connexion, $query); 
              $i=0;
              if(mysqli_num_rows($result) > 0)  
                {  
               while($row = mysqli_fetch_array($result))  
                  { 
                echo '<tr>';
                echo "<td> <a href='#' > ".$row['NOM_MAT']."</a></td>";
                echo '<td>'.$row['NOM_MODU'].'</td>';
                echo '<td>'.$row['NOM_FIL'].'</td>';
                echo '<td><button id="'.$i.'" type="submit" value="'.$row['NOM_MAT'].'" name ="tl1" class="btn btn-default"><i class="fa fa fa-book fa-lg"></i></button></td>';
                echo '<td><button id="'.$i.'" type="submit" value="'.$row['CODE_MAT'].'" name ="tl2" class="btn btn-default"><i class="fa fa fa-book fa-lg"></i></button></td>';
                $i++;
                echo '</tr>';
                }
				}

?>			  
			  