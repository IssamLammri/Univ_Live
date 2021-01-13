
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
	<!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-multiselect.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">  
	<script src="../js/sweetalert2.min.js"></script>	
	

 
</head>
<body>

<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];
if ( $Etat == "coordonateur filiere")
{
	$rest = $_SESSION['info'];
	
	$test="SELECT count(CODE_CORD_DEM) as nb FROM `filiere_demandes`  where  CODE_FIL IN ( SELECT CODE_FIL
                                                                               FROM filiere f
                                                                               WHERE f.CODE_COR_FIL = $rest ) ; ";
	$result=mysqli_query($ma_connexion,$test);
	if(mysqli_num_rows($result) > 0)  
		{
	while($row = mysqli_fetch_array($result))  
			{ 
	$nb_d=$row['nb'];
		}
	}
	
	
}
if(isset($_POST['Quitter']))
{  
  
 // Inialize session
  session_start();

// Delete certain session
  unset($_SESSION['NIV']);
  // Delete all session variables
  // session_destroy();
  session_destroy();
 // Jump to login page
header('Location: ../login/login.php');

}

if (!isset($_SESSION['NIV'])) 
{
header('Location: ../login/login.php');
}




?>









	<!--Barre de navigation
	=====================================-->
	    <!-- Navigation -->
	     <?php 
	    include("../includes/nav-bar-fil.php");
	    ?> 
    <!--contenu
	=====================================-->
<form method="POST" >
<div class="well">
<p>
 <?php 
	$incre = 0 ; 
 $sql= "SELECT * FROM `filiere_demandes` WHERE CODE_FIL IN ( SELECT f.CODE_FIL 
															FROM filiere f , coordonateur_filiere cf 
															WHERE cf.CODE_COR_FIL = f.CODE_COR_FIL
															and cf.CODE_COR_FIL = $rest ) ";

	$query=mysqli_query($ma_connexion,$sql) ;
    while($row = mysqli_fetch_assoc($query))
    {
		$code_cord = $row['CODE_CORD_DEM'] ; 
		$code_filiere_dem = $row['CODE_FIL'] ; 
		
		// $nomcorddem = '' ;
		// $prenomcorddem = '' ;
		// $nom_fildemande = '' ;
		
		$sql2= "SELECT * FROM coordonateur_filiere WHERE CODE_COR_FIL =  $code_cord ";

		$query2=mysqli_query($ma_connexion,$sql2) ;
		while($row = mysqli_fetch_assoc($query2))
		{
			$nomcorddem = $row['NOM_COR_FIL'] ; 
			$prenomcorddem = $row['PRENOM_COR_FIL'] ; 				
							
		} 
		
		$sql2= "SELECT * FROM filiere WHERE CODE_FIL =  '$code_filiere_dem' ";

		$query2=mysqli_query($ma_connexion,$sql2) ;
		while($row = mysqli_fetch_assoc($query2))
		{
			$nom_fildemande = $row['NOM_FIL'] ; 				
						
		}

		echo '
		
	<div class="col-md-6 contentwidgets-grid" style="margin-left: 382px; margin-top: 43px;" id="divFiliere'.$incre.'">
		
		<div class="widge-text1">
		<p style="float: right; position: absolute; left: 96%;top: -18px; cursor: pointer; " onclick="fonction_annuler('.$incre.')">  <i style="font-size: 30px; color: #0e62c7;" class="fa fa-times-circle" aria-hidden="true"></i> </p>
			<h4>'.$nomcorddem.' '.$prenomcorddem.'</h4>
			<p>'.$nomcorddem.' '.$prenomcorddem.' a demande de partager avec lui (elle) la filière <b> '.$nom_fildemande.' </b> afin qu\il (elle) puisse travailler sur la filiere dans le future.</p>
		</div>
		<div class="icon-img1" style="cursor: pointer;"  onclick="accepterdemande('.$incre.')">
			<i class="fa fa-share-alt" aria-hidden="true"></i>
		</div>
		<input type="hidden" id="saveIDfiliere'.$incre.'" value="'.$code_filiere_dem.'" />
		<input type="hidden" id="saveCodeCord'.$incre.'" value="'.$code_cord.'" />
	</div>
		
		
		
		';
		$incre++ ; 
		echo "<br/><br/>";
		
			
    } 
 ?>
  
	</p>
	</div>
	</form>
	
	<script>
	function accepterdemande(indice)
	{
		var active = '<?php echo $rest ; ?>' ; 
		var dataString = 'codefil=' + $("#saveIDfiliere"+indice).val() + '&codecord=' + $("#saveCodeCord"+indice).val()+ '&active=' + active;
		// alert(dataString);	
			$.ajax({
				type: "POST",
				url: "accepterDemande.php",
				data: dataString,
				cache: true,
				success: function(html){
					// alert(html);
					swal(
							'Succès!',
							'La filière a bien ete partager.',
							'success'
						  )
					$("#divFiliere"+indice).remove();
					
					}

					
				});
	}
	
	function fonction_annuler(indice)
	{
		var active = '<?php echo $rest ; ?>' ; 
		var dataString = 'codefildemande=' + $("#saveIDfiliere"+indice).val() + '&codecord=' + $("#saveCodeCord"+indice).val()+ '&active=' + active;
		
		swal({
		  title: 'Vous etes sure ?',
		  text: "vous allez annuler la demande de partage !",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Oui, annuler la demande!'
		}).then(function () {
		  
		  $.ajax({
				type: "POST",
				url: "accepterDemande.php",
				data: dataString,
				cache: true,
				success: function(html){
					
					swal(
							'Succès!',
							'La filière a bien ete partager.',
							'success'
						  )
					$("#divFiliere"+indice).remove();
					
					}

					
				});
		
		})
			
	}
	</script>

	




 </body>
</html>


