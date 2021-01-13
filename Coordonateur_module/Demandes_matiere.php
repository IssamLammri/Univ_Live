<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];
$rest = $_SESSION['info'];
$nb_d="";

$test="SELECT count(M.CODE_MAT) as nb FROM `matiere_demandees` Md,matiere M,Module Mo ,enseignant E WHERE md.CODE_MAT=M.CODE_MAT AND md.CODE_ENS=E.CODE_ENS AND md.CODE_MAT=M.CODE_MAT AND M.CODE_MODU=Mo.CODE_MODU AND Mo.CODE_COR_MODU='".$rest."' ";
$result=mysqli_query($ma_connexion,$test);
	if(mysqli_num_rows($result) > 0)  
		{
	while($row = mysqli_fetch_array($result))  
			{ 
	$nb_d=$row['nb'];
		}
	}	


if(isset($_POST['accepter']))
{
	$code_mat=$_POST['accepter'];

	$sqm="INSERT INTO `intervient`(`CODE_ENS`,`CODE_MAT`) SELECT `CODE_ENS`,'$code_mat' FROM `matiere_demandees` WHERE CODE_MAT='".$code_mat."' ";
	$result=mysqli_query($ma_connexion,$sqm);
	$sqll="DELETE FROM matiere_demandees where CODE_MAT='".$code_mat."' ";
	$result=mysqli_query($ma_connexion,$sqll);
	echo "<meta http-equiv='refresh' content='0' />";
}


if(isset($_POST['rejeter']))
{
	$type_inter=$_POST['acceptert'];
	$code_mat=$_POST['rejeter'];
	$sql="DELETE FROM matiere_demandees where CODE_MAT='".$code_mat."' ";
	$result=mysqli_query($ma_connexion,$sql);
	echo "<meta http-equiv='refresh' content='0' />";
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

if(!isset($_SESSION['NIV'])) 
{
header('Location: ../login/login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-multiselect.css">
	<!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-multiselect.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.knob.min.js"></script>
	<link rel="stylesheet" href="../css/jquery-confirm.min.css">
	<script src="../js/jquery-confirm.min.js"></script>
  <style>
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 900px;
    	width: 240px;
    }
     .row.content {height: auto;}

  </style>
</head>
<body>
	<!--Barre de navigation
	=====================================-->
	    <!-- Navigation -->
	   <?php
	    include("../includes/nav-bar-mod.php");
	    ?> 
    <!--contenu
	=====================================-->

	<br>

	<div class="container">
	<div class="row content">


		

<?php

	echo '<div class="container-fuild">
     <h3><gras> Les Demandes : </gras></h3>
      <hr>';
echo '<div class="well profil">';
echo '<div class="panel-group" id="accordion">';
echo '<form method="POST" action="">';

	$sql= "SELECT M.CODE_MAT,M.NOM_MAT,Md.CODE_ENS,E.NOM_ENS,E.PRENOM_ENS FROM `matiere_demandees` Md,matiere M,Module Mo ,enseignant E WHERE md.CODE_MAT=M.CODE_MAT AND md.CODE_ENS=E.CODE_ENS AND md.CODE_MAT=M.CODE_MAT AND M.CODE_MODU=Mo.CODE_MODU  AND Mo.CODE_COR_MODU='".$rest."' " ;

	$result=mysqli_query($ma_connexion,$sql);
	if(mysqli_num_rows($result) > 0)  
		{

			echo '<table id="tableau" class="table table-bordered">
	    		<tr>
	    			<th>Nom matière</th>
	    			<th>Nom et prénom enseignant</th>
					<th>Accepter</th>
					<th>Rejeter</th>
	    		</tr>';

		while($row = mysqli_fetch_array($result))  
			{  
     echo '
     	<tr>
		<td><input type="text" class="form-control" id="nom_mat" value="'.$row['NOM_MAT'].'" placeholder="Nom matière" readonly/></td>
		<td><input type="text" class="form-control" id="enseignant" value="'.$row['NOM_ENS']." ".$row['PRENOM_ENS'].'" readonly/></td>
		<td><button type="submit" name="accepter" class="btn btn-default form-control" value="'.$row['CODE_MAT'].'"><i class="fa fa-check-square-o"></i></button></td>
		<td><button type="submit" name="rejeter" class="btn btn-default form-control"  value="'.$row['CODE_MAT'].'"><i class="fa fa-close"></i></button></td>
		</tr>';
 			}
 		}
echo '</form>';
echo	'</div>';	        
echo	'</div>';
echo	'</div>';

?>

</div>
</div>

</body>
</html>


