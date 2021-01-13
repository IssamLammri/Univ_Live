<?php
include '../connexion.php';
session_start();

if(isset($_POST['submit']))
{
        $username= mysqli_real_escape_string($ma_connexion,$_POST["username"]);
        $password= mysqli_real_escape_string($ma_connexion,$_POST["password"]);
    

          $query ="SELECT * FROM super_utilisateur WHERE PSEUDO = '$username' AND PASSWORD = '$password' ";
         $result = mysqli_query($ma_connexion, $query);
         
       if(mysqli_num_rows($result) > 0)
       {
          $_SESSION['admin']  = 'admiin' ; 
            header('Location: ../MyAadmin/Admin.php');
        }


    if(isset($_POST['radio']))
      {
        $test=$_POST['radio'];
        if($test == 'CD')
        {
          $query1="SELECT * FROM chef_departement WHERE PSEUDO = '$username' AND  PASSWORD = '$password' ";
          $result1 = mysqli_query($ma_connexion, $query1);
          if(mysqli_num_rows($result1) > 0)
          {
            $req1="select CODE_CHEF_DEPT, ETAT from chef_departement where PSEUDO='$username' and PASSWORD='$password' ";
      $result = mysqli_query($ma_connexion, $req1);
       while($row3 = mysqli_fetch_array($result))  
                {
            $_SESSION['info'] = $row3['CODE_CHEF_DEPT'];
            $_SESSION['NIV']  = $row3['ETAT'];
              }
      header('Location: ../Profil/Profil.php');
      }
      else
      {
       echo"<script>alert('Votre login ou mot de passe invalide !')</script>";
      }
      }

        elseif($test == 'CF')
        {
          $query2="SELECT * FROM coordonateur_filiere WHERE PSEUDO = '$username' AND  PASSWORD = '$password' ";
      $result2 = mysqli_query($ma_connexion, $query2);
          if(mysqli_num_rows($result2) > 0)
          {
      $req1="select CODE_COR_FIL, ETAT from coordonateur_filiere where PSEUDO='$username' and PASSWORD='$password' ";
      $result = mysqli_query($ma_connexion, $req1);
      while($row3 = mysqli_fetch_array($result))  
      {
      $_SESSION['info'] = $row3['CODE_COR_FIL'];
      $_SESSION['NIV']  = $row3['ETAT'];
      }
      header('Location: ../Profil/Profil.php');
      }
      else
       echo"<script>alert('Votre login ou mot de passe invalide !')</script>";
      }

        elseif($test == 'CM')
        {
          $query3="SELECT * FROM coordonateur_module WHERE PSEUDO = '$username' AND   PASSWORD = '$password' ";
      $result3 = mysqli_query($ma_connexion, $query3);
          if(mysqli_num_rows($result3) > 0)
          {
      $req1="select CODE_COR_MODU, ETAT from coordonateur_module where PSEUDO='$username' and PASSWORD='$password' ";
      $result = mysqli_query($ma_connexion, $req1);
      while($row3 = mysqli_fetch_array($result))  
      {
      $_SESSION['info'] = $row3['CODE_COR_MODU'];
      $_SESSION['NIV']  = $row3['ETAT'];
      }
      header('Location: ../Profil/Profil.php');
      }
      else
       echo"<script>alert('Votre login ou mot de passe invalide !')</script>";
      }

        elseif($test == 'EN')
        {
          $query4="SELECT * FROM enseignant WHERE PSEUDO = '$username' AND  PASSWORD = '$password' ";
      $result4 = mysqli_query($ma_connexion, $query4);
          if(mysqli_num_rows($result4) > 0)
          {
      $req1="select CODE_ENS, ETAT from enseignant where PSEUDO='$username' and PASSWORD='$password' ";
      $result = mysqli_query($ma_connexion, $req1);
      while($row3 = mysqli_fetch_array($result))  
      {
      $_SESSION['info'] = $row3['CODE_ENS'];
      $_SESSION['NIV']  = $row3['ETAT'];
      }
      header('Location: ../Profil/Profil.php');
      }
      else
       echo"<script>alert('Votre login ou mot de passe invalide !')</script>";
    }

  }

}
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <!-- Ionicons -->
  <link href="../css/ionicons.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../index.php" class="glyphicon glyphicon-home"><b style="color:#3c8dbc;">Gestion-des</b>-Filières</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Connectez-vous pour commencer votre session</p>

    <form action="" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="username" value="username" id="username" name="username" onfocus="if (this.value == 'username'){this.value = '';} ">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="mot de passe" name="password" value="Password" id="password" onfocus="if (this.value == 'Password'){this.value = '';}">
         <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <label class="p-control" style="padding-left: 15px;"><input type="radio" name="radio" value="CF" checked=""><i style="padding-left: 10px;">Coordonateur filiere</i></label>
    <br><br>
    <label class="p-control" style="padding-left: 15px;"><input type="radio" name="radio" value="CM"><i style="padding-left: 10px;">Coordonateur Module</i></label> 
    <br><br>      
    <label class="p-control" style="padding-left: 15px;"><input type="radio" name="radio" value="EN"><i style="padding-left: 10px;">Enseignant</i></label>    
    <br><br>
    <label class="p-control" style="padding-left: 15px;"><input type="radio" name="radio" value="CD"><i style="padding-left: 10px;">Chef Departement</i></label>
        </div>
        <div class="col-xs-12"><br></div>
        <div class="col-xs-7">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Se connecter" />
        </div>  
        <!-- /.col -->
      </div>
    </form>

<br>
    <!-- /.social-auth-links -->
    <!-- <a href="register.php" class="text-center" style="padding-left: 70px;">Enregistrez un nouveau compte</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
