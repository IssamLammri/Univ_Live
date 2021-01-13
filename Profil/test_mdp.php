<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];

if ( $Etat == "coordonateur filiere") 
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req=($bd->query('Select PASSWORD,PSEUDO from coordonateur_filiere WHERE CODE_COR_FIL="'.$rest.'" '));
	$ress = $req->fetch();
	$mdpv = $ress['PASSWORD'];
	$psd = $ress['PSEUDO'];
	
	if(isset($_POST['query']))
	{
	$mdp=$_POST['query'];
	if($mdp == $mdpv)
	{
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS VALIDE</label>';
	}
	else
	{
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS NON VALIDE</label>';
	}
	}

	if(isset($_POST['Pseudo']))
	{
    $Pseudo = $_POST['Pseudo'];
    $sql = "SELECT 1 FROM `coordonateur_filiere` where `PSEUDO`='".$Pseudo."' AND `PSEUDO` !='".$psd."' ";
    $result = mysqli_query($ma_connexion,$sql); 
	if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }
	}


}

elseif ( $Etat == "enseignant")
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req=($bd->query('Select PASSWORD,PSEUDO from enseignant WHERE CODE_ENS="'.$rest.'" '));
	$ress = $req->fetch();
	$mdpv = $ress['PASSWORD'];
	$psd = $ress['PSEUDO'];
	
	if(isset($_POST['query']))
	{
	$mdp=$_POST['query'];
	if($mdp == $mdpv)
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS VALIDE</label>';
	else
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS NON VALIDE</label>';
	}

	if(isset($_POST['Pseudo']))
	{
    $Pseudo = $_POST['Pseudo'];
    $sql = "SELECT 1 FROM `enseignant` where `PSEUDO`='".$Pseudo."' AND `PSEUDO` !='".$psd."' ";
    $result = mysqli_query($ma_connexion,$sql); 
	if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }
	}



}

elseif ($Etat =="Coordonnateur Module")
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req=($bd->query('Select PASSWORD,PSEUDO from coordonateur_module WHERE CODE_COR_MODU="'.$rest.'" '));
	$ress = $req->fetch();
	$mdpv = $ress['PASSWORD'];
	$psd = $ress['PSEUDO'];

	if(isset($_POST['query']))
	{
	$mdp=$_POST['query'];
	if($mdp == $mdpv)
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS VALIDE</label>';
	else
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS NON VALIDE</label>';
	}


	if(isset($_POST['Pseudo']))
	{
    $Pseudo = $_POST['Pseudo'];
    $sql = "SELECT 1 FROM `coordonateur_module` where `PSEUDO`='".$Pseudo."' AND `PSEUDO` !='".$psd."' ";
    $result = mysqli_query($ma_connexion,$sql); 
	if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }
	}

}

elseif ($Etat =="Chef Departement")
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req=($bd->query('Select PASSWORD from chef_departement WHERE CODE_CHEF_DEPT="'.$rest.'" '));
	$ress = $req->fetch();
	$mdpv = $ress['PASSWORD'];
	
	if(isset($_POST['query']))
	{
	$mdp=$_POST['query'];
	if($mdp == $mdpv)
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS VALIDE</label>';
	else
	echo '<label id="validationtt" class="col-sm-8 control-label">MOT DE PASS NON VALIDE</label>';
	}
}






?>