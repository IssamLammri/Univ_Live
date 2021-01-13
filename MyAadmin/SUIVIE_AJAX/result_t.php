<?php
include '../../connexion.php';


if (isset($_POST['id_dept']))
{
    $id=$_POST['id_dept'];
    
	$nom_univ =$_POST['nom_univ']; 
	$nom_etab =$_POST['nom_etab']; 
	$colorSW =$_POST['color']; 
	$ind_incre =$_POST['indcompteur']; 
	     
	


    $sql= "select * from filiere WHERE CODE_DEPT ='$id'";
    $query=mysqli_query($ma_connexion,$sql) ;

    if(mysqli_num_rows($query) == 0)
    {
        
    }else{
		
        while($row = mysqli_fetch_assoc($query))
        {
			
            echo '
			<tr class='.$colorSW.'>
                <td>'.$ind_incre.'</td> ';
				 ?>
			<td> <a  onclick="hello('<?php echo $row['CODE_FIL']; ?>','<?php echo $row['CODE_COR_FIL']; ?>')" style="cursor: pointer;"><?php echo $row['NOM_FIL']; ?></a ></td>
            <?php
                echo ' 
                <td>'.$nom_etab.'</td>
                <td>'.$row['NOM_FIL'].'</td>
                
                <td>
				<div class="progress progress-striped active">
				  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '.$row['avancement'].'%">
					<span class="sr-only">70% Complete (success)</span>
				  </div>
				</div>
				</td>
                <td> en cour d\'accréditation </td>
                <td style="text-align: center;"><a href="statistiques.php?idf='.$row['CODE_FIL'].'">
<button type="button" class="btn btn-info btn-circle" style="width: 30px;height: 30px; " ><i class="fa fa-line-chart"></i>
                            </button></a>
				</td>
            </tr>
			';

			$ind_incre++ ; 
			
        }
    }
}else{

    echo '<option>Error</ption>';
}

