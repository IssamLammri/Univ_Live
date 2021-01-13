<?php
//connexion locale , login "root" et sans mot de passe 
$ma_connexion =mysqli_connect("localhost","root","")or die("impossible to connect at bd");
mysqli_set_charset($ma_connexion,"utf8");
//2. Conexion à la base de données
$connect_base=mysqli_select_db($ma_connexion,"pfe")or die("impossible to accedc to db");
?>


