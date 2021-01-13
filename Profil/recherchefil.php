<?php  

include '../connexion.php';
 
if(isset($_POST["nomfil"]))  
{  
      
     $output = '' ; 
	$nomfil=mysqli_real_escape_string($ma_connexion, $_POST['nomfil']) ;
	$codecordd= $_POST['codecordd'] ;

	$sql= "SELECT * FROM `filiere` WHERE UPPER(NOM_FIL)  LIKE UPPER('%".$nomfil."%') AND CODE_COR_FIL <> $codecordd 
			AND CODE_FIL NOT IN (SELECT CODE_FIL
								FROM filiere_demandes
								WHERE CODE_CORD_DEM = $codecordd ) LIMIT 8";
	$query=mysqli_query($ma_connexion,$sql) ;
      while($row = mysqli_fetch_assoc($query))
      {
			 ?>
			 <button  type="button" value="<?php echo $row['NOM_FIL']; ?>"onclick="document.getElementById('searchCF').value= this.value ;  document.getElementById('showinfo').value= '<?php echo $row['CODE_FIL']; ?>' ;  document.getElementById('saveIDactive').value= '<?php echo $row['CODE_FIL']; ?>' ; " class="btn btn-default form-control"><?php echo $row['NOM_FIL']; ?></button>
			
			<?php
      } 

}  

if(isset($_POST["idfilinfo"]))  
{  
      
 
	$idfilinfo= $_POST['idfilinfo'] ;

	
	$sql="select f.NOM_FIL , d.NOM_DEPT , e.NOM_ETA , u.NOM_UNIVERSITE, cf.PRENOM_COR_FIL   , cf.NOM_COR_FIL ,f.ETAT
			from  departement d , filiere f , etablissement e , universite u , coordonateur_filiere cf
			where  d.CODE_DEPT = f.CODE_DEPT
            and d.CODE_ETA = e.CODE_ETA
            and e.CODE_UNIVERSITE = u.CODE_UNIVERSITE
			and cf.CODE_COR_FIL = f.CODE_COR_FIL
			and f.CODE_FIL = '$idfilinfo'";
	$query=mysqli_query($ma_connexion,$sql) ;
      while($row = mysqli_fetch_assoc($query))
      {
		  echo '
		  
			<label style="margin-top: 3px;">nom de le filière </label>
			<input type="text" placeholder="nom filiere" value="'.$row['NOM_FIL'].'"style="margin-left: 4px;"class="name form-control" id="change_nomfil" readonly disabled />
			
			<label style="margin-top: 3px;">Université:  </label>
			<input type="text" placeholder="nom filiere" value="'.$row['NOM_UNIVERSITE'].'"style="margin-left: 4px;"class="name form-control" id="change_univer" readonly disabled />
			
			<label style="margin-top: 3px;">Etablissement  </label>
			<input type="text" placeholder="nom filiere" value="'.$row['NOM_ETA'].'"style="margin-left: 4px;"class="name form-control" id="change_etabl" readonly disabled />
			
			<label style="margin-top: 3px;">Departement  </label>
			<input type="text" placeholder="nom departement" value="'.$row['NOM_DEPT'].'"style="margin-left: 4px;"class="name form-control" id="change_dept" readonly disabled />
			
			
			<label style="margin-top: 3px;">coordonateur </label>
			<input type="text" placeholder="nom filiere" value="'.$row['NOM_COR_FIL'].' '.$row['PRENOM_COR_FIL'].'"style="margin-left: 4px;"class="name form-control" id="change_coord" readonly disabled />
			
			<label style="margin-top: 3px;">Etat </label>
			<input type="text" placeholder="nom filiere" value="'.$row['ETAT'].'"style="margin-left: 4px;"class="name form-control" id="change_etat" readonly disabled />
			<br>
		  
		  ';
      } 

} 

?> 




