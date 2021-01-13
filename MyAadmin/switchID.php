
<?php
session_start();
include '../connexion.php';


if (isset($_POST['idfil']))
{
    $idfil=$_POST['idfil'];
    $idcord=$_POST['idcord'];
	
	$_SESSION['idf']=$idfil;
	$_SESSION['info'] = $idcord ; 	
	$_SESSION['TESTcorORbon']='1';
	$_SESSION['TESTADmin']='1';
	$_SESSION['NIV']='coordonateur filiere';
	
	
}else{

    // echo '<option>Error</ption>';
}

