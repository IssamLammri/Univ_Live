<?php
	include '../connexion.php';
	
	
	if (isset($_POST['indice']))
    {
		$indice=$_POST['indice'];
		$username=$_POST['usernamenew'];
		$password=$_POST['password'];
		
		
		
		
		
		if($indice == 'CF')
		{
			
			$SQL="select IMAGE_COR_FIL  FROM coordonateur_filiere WHERE PSEUDO = '$username' AND PASSWORD = '$password' " ;
				
				
			
			$query=mysqli_query($ma_connexion,$SQL);
			while($row=mysqli_fetch_assoc($query))
			{
				
				$image = $row['IMAGE_COR_FIL'];
					echo '<img src="../images/'.$image.'" alt=""  alt="" style="width: 127px;height: 127px;" />';
				
			
			}
			
				
				
					
		}
		
		if($indice == 'CM')
		{
			
			$SQL="select IMAGE_COR_MODU  FROM coordonateur_module WHERE PSEUDO = '$username' AND PASSWORD = '$password' " ;
				
				
			
			$query=mysqli_query($ma_connexion,$SQL);
			while($row=mysqli_fetch_assoc($query))
			{
				
				$image = $row['IMAGE_COR_MODU'];
					echo '<img src="../images/'.$image.'" alt=""  />';
				
			
			}
					
		}
		
		if($indice == 'EN')
		{
			
			
			$SQL="select IMAGE_ENS  FROM enseignant WHERE PSEUDO = '$username' AND PASSWORD = '$password' " ;
							
							
						
						$query=mysqli_query($ma_connexion,$SQL);
						while($row=mysqli_fetch_assoc($query))
						{
							
							$image = $row['IMAGE_ENS'];
								echo '<img src="../images/'.$image.'" alt=""  />';
							
						
						}
						
		}
		
	}
    else
    {
		
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$req = $bd->prepare('SELECT 1 FROM super_utilisateur WHERE 	PSEUDO = :username AND PASSWORD = :password');
		$req->execute(array(
			':username' => $username,
			':password' => $password));
		$resultat = $req->fetch();
        if (!$resultat)
		{
			$req = $bd->prepare('SELECT IMAGE_CHEF  FROM chef_departement WHERE PSEUDO = :username AND 	PASSWORD = :password');
			$req->execute(array(
				':username' => $username,
				':password' => $password));
			$resultat = $req->fetch();
			if (!$resultat)
			{
				$req = $bd->prepare('SELECT IMAGE_COR_FIL FROM coordonateur_filiere WHERE PSEUDO = :username AND PASSWORD = :password');
				$req->execute(array(
					':username' => $username,
					':password' => $password));
				$resultat = $req->fetch();
				
				if (!$resultat)
				{
					$req = $bd->prepare('SELECT IMAGE_COR_MODU FROM coordonateur_module WHERE PSEUDO = :username AND PASSWORD = :password');
					$req->execute(array(
						':username' => $username,
						':password' => $password));
					$resultat = $req->fetch();
					if (!$resultat)
					{
						$req = $bd->prepare('SELECT IMAGE_ENS FROM enseignant WHERE PSEUDO = :username AND PASSWORD = :password');
						$req->execute(array(
							':username' => $username,
							':password' => $password));
						$resultat = $req->fetch();
						if (!$resultat)
						{
							// echo"<script>alert('Votre login ou mot de passe invalide !')</script>";
							// echo "error" ; 
						}
						else
						{
							$image = $resultat['IMAGE_ENS'];
							echo '<img src="../images/'.$image.'" alt="" style="width: 127px;height: 127px;" />';
						}
					}
					else
					{
						$image = $resultat['IMAGE_COR_MODU'];
						echo '<img src="../images/'.$image.'" alt="" style="width: 127px;height: 127px;" />';
					}
				}
				else
				{
					$image = $resultat['IMAGE_COR_FIL'];
					echo '<img src="../images/'.$image.'" alt="" style="width: 127px;height: 127px;" />';
				}
			}
			else
			{
				$image = $resultat['IMAGE_CHEF']; 
				echo '<img src="../images/'.$image.'" alt="" style="width: 127px;height: 127px;" />';
			}
		}
		else
		{
			$image = 'Admin_PIC.png' ; 
			echo '<img src="../images/'.$image.'" alt="" style="width: 127px;height: 127px;" />';
		}
		
		
		
		
    }
	
	
	
	


?>