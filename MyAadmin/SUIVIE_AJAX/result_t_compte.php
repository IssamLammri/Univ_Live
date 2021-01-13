<?php
include '../../connexion.php';


if (isset($_POST['type']))
{
    $type=$_POST['type'];
	$ind_incre = 1; 
	$indCOLOR = 0; 
	$colorSW = ["success", "info", "warning", "danger"] ; 
  
	if ( $type == 'CD') 
	{
		
		
		
		$sql= "SELECT f.CODE_CHEF_DEPT , f.ETAT , f.NOM_CHEF , f.PRENOM_CHEF , u.NOM_UNIVERSITE , e.NOM_ETA , d.NOM_DEPT , g.NOM_GRAD , s.NOM_SPEC
				FROM chef_departement f , universite u , etablissement e , departement d , grade_crm g , specialite_crm s	
				where f.CODE_DEPT = d.CODE_DEPT
                and d.CODE_ETA = e.CODE_ETA
				and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE 
                and f.GRADE_CHEF = g.CODE_GRAD
                and f.SPECIALITE_CHEF = s.CODE_SPEC ";
		$query=mysqli_query($ma_connexion,$sql) ;

		if(mysqli_num_rows($query) == 0)
		{
			
		}else{
			
			while($row = mysqli_fetch_assoc($query))
			{
				
				echo '
				<tr class='.$colorSW[$indCOLOR].'>
					<td>'.$ind_incre.'</td> 
					<td>'.$row['NOM_CHEF'].'</td>
					<td>'.$row['PRENOM_CHEF'].'</td>
					<td>'.$row['NOM_UNIVERSITE'].'</td>
					<td>'.$row['NOM_ETA'].'</td>
					<td>'.$row['NOM_DEPT'].'</td>
					<input type="hidden" id="value'.$row['CODE_CHEF_DEPT'].'" value="'.$row['NOM_CHEF'].'     '.$row['PRENOM_CHEF'].'::'.$row['ETAT'].'::'.$row['NOM_GRAD'].'::'.$row['NOM_SPEC'].'" >';
					
					 ?>
<td style="text-align: center;"><a onclick="help('<?php echo $row['CODE_CHEF_DEPT']; ?>')" >
	<button type="button" class="btn btn-info btn-circle" style="width: 30px;height: 30px; " ><i class="fa fa-plus"></i>
								</button></a>
					</td>
				</tr>

				<?php
			echo '
					
				';
				
				$ind_incre++ ; 
				$indCOLOR++ ; 
				
				if($indCOLOR == 4)
					$indCOLOR = 0 ;
				
			}
		}
		
	
		
		
		
	}
	if ( $type == 'CF') 
	{
		$codeCordFil = '' ; 
		$sql= "SELECT f.IMAGE_COR_FIL , f.CODE_COR_FIL , f.ETAT , f.NOM_COR_FIL , f.PRENOM_COR_FIL , u.NOM_UNIVERSITE , e.NOM_ETA , d.NOM_DEPT,g.NOM_GRAD , s.NOM_SPEC
				FROM coordonateur_filiere f , universite u , etablissement e , departement d , grade_crm g , specialite_crm s
				WHERE f.CODE_ETA = e.CODE_ETA
				and f.CODE_DEPT = d.CODE_DEPT
				and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
                and f.GRADE_COR_FIL = g.CODE_GRAD
                and f.SPCIALITE_COR_FIL = s.CODE_SPEC";
		$query=mysqli_query($ma_connexion,$sql) ;

		if(mysqli_num_rows($query) == 0)
		{
			
		}else{
			
			while($row = mysqli_fetch_assoc($query))
			{
				$codeCordFil = $row['CODE_COR_FIL'] ; 
				echo '
				<tr class='.$colorSW[$indCOLOR].'>
					<td>'.$ind_incre.'</td> 
					<td>'.$row['NOM_COR_FIL'].'</td>
					<td>'.$row['PRENOM_COR_FIL'].'</td>
					<td>'.$row['NOM_UNIVERSITE'].'</td>
					<td>'.$row['NOM_ETA'].'</td>
					<td>'.$row['NOM_DEPT'].'</td>
					<input type="hidden" id="value'.$row['CODE_COR_FIL'].'" value="'.$row['NOM_COR_FIL'].'     '.$row['PRENOM_COR_FIL'].'::'.$row['ETAT'].'::'.$row['NOM_GRAD'].'::'.$row['NOM_SPEC'].'::'.$row['IMAGE_COR_FIL'].'" >';
					
					 ?>
<td style="text-align: center;"><a onclick="help('<?php echo $row['CODE_COR_FIL']; ?>')" >
	<button type="button" class="btn btn-info btn-circle" style="width: 30px;height: 30px; " ><i class="fa fa-plus"></i>
								</button></a>
					</td>
				</tr>

				
				<?php
				$nbrAsavoit = 0;
				$lesmatiere = '' ;
				$sqlADD= "SELECT m.NOM_FIL , (SELECT COUNT(mo.CODE_FIL)FROM filiere mo WHERE mo.CODE_COR_FIL = '$codeCordFil' )as nbs
						FROM   filiere m 
						where m.CODE_COR_FIL = '$codeCordFil' ";
									
				$queryADD=mysqli_query($ma_connexion,$sqlADD) ;
				
				if(mysqli_num_rows($queryADD) == 0)
				{
					$nbrAsavoit = 0 ; 
					
				}else{
					
					while($row = mysqli_fetch_assoc($queryADD))
					{
						
																
							$nbrAsavoit = $row['nbs'] ;
							$lesmatiere .= $row['NOM_FIL'] ."<br/>" ;

						
					}
				}
				
							
				echo '
				<input type="hidden"  id="valueADD'.$codeCordFil.'" value="'.$nbrAsavoit.'::Filières::'.$lesmatiere.'" >';
			
				
				$ind_incre++ ; 
				$indCOLOR++ ; 
				
				if($indCOLOR == 4)
					$indCOLOR = 0 ;
				
			}
		}
	}
	if ( $type == 'CM') 
	{
		$codeCordmodule = '' ; 
		$sql= "SELECT f.IMAGE_COR_MODU ,f.CODE_COR_MODU , f.ETAT , f.NOM_COR_MODU , f.PRENOM_COR_MODU , u.NOM_UNIVERSITE , e.NOM_ETA , d.NOM_DEPT ,g.NOM_GRAD , s.NOM_SPEC
				FROM coordonateur_module f , universite u , etablissement e , departement d, grade_crm g , specialite_crm s
				WHERE f.CODE_ETA = e.CODE_ETA
				and f.CODE_DEPT = d.CODE_DEPT
				and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
                and f.GRADE_COR_MODU = g.CODE_GRAD
                and f.SPECIALITE_COR_MODU = s.CODE_SPEC  ";
		$query=mysqli_query($ma_connexion,$sql) ;

		if(mysqli_num_rows($query) == 0)
		{
			
		}else{
			
			while($row = mysqli_fetch_assoc($query))
			{
				$codeCordmodule = $row['CODE_COR_MODU'];
				echo '
				<tr class='.$colorSW[$indCOLOR].'>
					<td>'.$ind_incre.'</td> 
					<td>'.$row['NOM_COR_MODU'].'</td>
					<td>'.$row['PRENOM_COR_MODU'].'</td>
					<td>'.$row['NOM_UNIVERSITE'].'</td>
					<td>'.$row['NOM_ETA'].'</td>
					<td>'.$row['NOM_DEPT'].'</td>
					<input type="hidden" id="value'.$row['CODE_COR_MODU'].'" value="'.$row['NOM_COR_MODU'].'     '.$row['PRENOM_COR_MODU'].'::'.$row['ETAT'].'::'.$row['NOM_GRAD'].'::'.$row['NOM_SPEC'].'::'.$row['IMAGE_COR_MODU'].'" >';
					
					 ?>
<td style="text-align: center;"><a onclick="help('<?php echo $row['CODE_COR_MODU']; ?>')" >
	<button type="button" class="btn btn-info btn-circle" style="width: 30px;height: 30px; " ><i class="fa fa-plus"></i>
								</button></a>
					</td>
				</tr>

				<?php
				$nbrAsavoit = 0;
				$lesmatiere = '' ;
				$sqlADD= "SELECT m.NOM_MODU , (SELECT COUNT(mo.CODE_MODU)FROM module mo WHERE mo.CODE_COR_MODU = '$codeCordmodule' )as nbs
						FROM   module m 
						where m.CODE_COR_MODU = '$codeCordmodule' ";
									
				$queryADD=mysqli_query($ma_connexion,$sqlADD) ;
				
				if(mysqli_num_rows($queryADD) == 0)
				{
					$nbrAsavoit = 0 ; 
					
				}else{
					
					while($row = mysqli_fetch_assoc($queryADD))
					{
						
																
							$nbrAsavoit = $row['nbs'] ;
							$lesmatiere .= $row['NOM_MODU'] ."<br/>" ;

						
					}
				}
				
							
				echo '
				<input type="hidden"  id="valueADD'.$codeCordmodule.'" value="'.$nbrAsavoit.'::Modules::'.$lesmatiere.'" >';

			
				
				$ind_incre++ ; 
				$indCOLOR++ ; 
				
				if($indCOLOR == 4)
					$indCOLOR = 0 ;		
				
			}
		}
		
	}
	if ( $type == 'ENS') 
	{
		$codeENS = '' ; 
		
		$sql= "SELECT f.IMAGE_ENS ,f.CODE_ENS , f.ETAT , f.NOM_ENS , f.PRENOM_ENS , u.NOM_UNIVERSITE , e.NOM_ETA , d.NOM_DEPT ,g.NOM_GRAD , s.NOM_SPEC
				FROM enseignant f , universite u , etablissement e , departement d , grade_crm g , specialite_crm s
				where f.CODE_DEPT = d.CODE_DEPT
                and d.CODE_ETA = e.CODE_ETA
				and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
                and f.GRADE_ENS = g.CODE_GRAD
                and f.SPECIALTE_ENS = s.CODE_SPEC";
		$query=mysqli_query($ma_connexion,$sql) ;

		if(mysqli_num_rows($query) == 0)
		{
			
		}else{
			
			while($row = mysqli_fetch_assoc($query))
			{
				
				$codeENS = $row['CODE_ENS'];
				echo '
				<tr class='.$colorSW[$indCOLOR].'>
					<td>'.$ind_incre.'</td> 
					<td>'.$row['NOM_ENS'].'</td>
					<td>'.$row['PRENOM_ENS'].'</td>
					<td>'.$row['NOM_UNIVERSITE'].'</td>
					<td>'.$row['NOM_ETA'].'</td>
					<td>'.$row['NOM_DEPT'].'</td> ';
					
					

				
						echo '
						<input type="hidden" id="value'.$row['CODE_ENS'].'" value="'.$row['NOM_ENS'].'     '.$row['PRENOM_ENS'].'::'.$row['ETAT'].'::'.$row['NOM_GRAD'].'::'.$row['NOM_SPEC'].'::'.$row['IMAGE_ENS'].'" >';




					?>
<td style="text-align: center;"><a onclick="help('<?php echo $row['CODE_ENS']; ?>')" >
	<button type="button" class="btn btn-info btn-circle" style="width: 30px;height: 30px; " ><i class="fa fa-plus"></i>
								</button></a>

					</td>
				</tr>

				<?php
				$nbrAsavoit = 0;
				$lesmatiere = '' ;
				$sqlADD= "SELECT m.NOM_MAT , (SELECT COUNT(CODE_MAT)FROM intervient WHERE CODE_ENS = $codeENS )as nbs
						FROM intervient i  , matiere m 
						where i.CODE_ENS = $codeENS 
						and i.CODE_MAT = m.CODE_MAT ";
									
				$queryADD=mysqli_query($ma_connexion,$sqlADD) ;
				
				if(mysqli_num_rows($queryADD) == 0)
				{
					$nbrAsavoit = 0 ; 
					
				}else{
					
					while($row = mysqli_fetch_assoc($queryADD))
					{
						
																
							$nbrAsavoit = $row['nbs'] ;
							$lesmatiere .= $row['NOM_MAT'] ."<br/>" ;

						
					}
				}
				
							
				echo '
				<input type="hidden"  id="valueADD'.$codeENS.'" value="'.$nbrAsavoit.'::matières::'.$lesmatiere.'" >';



				
				
			echo '
					
				';

				$ind_incre++ ; 
				$indCOLOR++ ; 
				
				if($indCOLOR == 4)
					$indCOLOR = 0 ;
				
			}
		}
		
		
		
		
		
		
		
		
		
		
		
	}
	


}else{

    echo '<option>Error</ption>';
}
?>
