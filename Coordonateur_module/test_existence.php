<?php
session_start();
include '../connexion.php';
$idf=$_SESSION['idf'];

$sql = "SELECT CODE_FIL FROM `module` where `CODE_MODU`='".$idf."' ";
$result = mysqli_query($ma_connexion,$sql); 
while ($ligne1 = mysqli_fetch_array($result))
{
$CODE_FIL=$ligne1['CODE_FIL'];
}



if(isset($_POST['obj_modu']))
{
    $obj_modu = $_POST['obj_modu'];

    $sql = "SELECT 1 FROM `objectifs` where `OBJECTIFS_MODU`='".mysqli_real_escape_string($ma_connexion,$obj_modu)."' ";
    $result = mysqli_query($ma_connexion,$sql); 
    if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }

}
if(isset($_POST['pre_modu']))
{
    $pre_modu = $_POST['pre_modu'];

    $sql = "SELECT 1 FROM `prerequis` where `prerequis`='".mysqli_real_escape_string($ma_connexion,$pre_modu)."' ";
    $result = mysqli_query($ma_connexion,$sql); 
    if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }

}
if(isset($_POST['dida_modu']))
{
    $dida_modu = $_POST['dida_modu'];

    $sql = "SELECT 1 FROM `didactiques` where `DIDACTIQUE_MODU`='".mysqli_real_escape_string($ma_connexion,$dida_modu)."' ";
    $result = mysqli_query($ma_connexion,$sql); 
    if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }

}
if(isset($_POST['matiereNEW']))
{
    $matiereNEW = $_POST['matiereNEW'];

    $sql = "SELECT 1 FROM `matiere` Ma ,module Mo,filiere F where Ma.NOM_MAT='".mysqli_real_escape_string($ma_connexion,$matiereNEW)."' AND Ma.CODE_MODU=Mo.CODE_MODU AND Mo.CODE_FIL=F.CODE_FIL AND Mo.CODE_FIL='".$CODE_FIL."' ";
    $result = mysqli_query($ma_connexion,$sql); 
    if(mysqli_num_rows($result) > 0)  
    {
    echo '404';
    }

}

?>