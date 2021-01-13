<?php


$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//connexion locale , login "root" et sans mot de passe 
$ma_connexion =mysqli_connect("localhost","root","")or die("impossible to connect at bd");
mysqli_set_charset($ma_connexion,"utf8");
//2. Conexion à la base de données
$connect_base=mysqli_select_db($ma_connexion,"pfe")or die("impossible to accedc to db");


?>


