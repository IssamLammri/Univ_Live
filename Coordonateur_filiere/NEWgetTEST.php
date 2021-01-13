<?php
	include '../connexion.php';

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
		
        $sql= "SELECT d.CODE_DIPLOME , d.TYPE, d.NOM_DIPLOME
												FROM  diplomes d 
												where d.TYPE = '$id'  
												and d.CODE_DIPLOME not in (SELECT CODE_DIPLOME
																			FROM filiere_diplomes ) 
		
		";
		$ind = 0 ;
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo '<option>Aucune Prerequis </option>';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                ?>
               
				
				<div class="form-control" >
				<input  type="checkbox" id="DIplchekii<?php echo $ind ;?>" name="cbox1" value="<?php echo $row['CODE_DIPLOME']; ?>"><label id="" for="DIplchekii<?php echo $ind ;?>">
				  <?php echo $row['NOM_DIPLOME']; ?>
				</label>
				</div>
                <?php
				$ind++ ; 
            }
        }
    }else{

        echo '<option>Error</ption>';
		
	
    }


?>