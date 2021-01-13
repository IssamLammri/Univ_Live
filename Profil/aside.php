  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="
<?php
                                            $rest = $_SESSION['info'];
                                            $bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
                                            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            
                                            if ( $Etat =="coordonateur filiere" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_FIL from coordonateur_filiere WHERE CODE_COR_FIL  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_FIL'];
                                                    echo "../images/".$url;
                                                }
                                            else if ( $Etat =="Coordonnateur Module" ) 
                                                {
                                                    $req  = ($bd->query('Select IMAGE_COR_MODU from coordonateur_module WHERE CODE_COR_MODU  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_COR_MODU'];
                                                    echo "../images/".$url;
                                                }
                                            else{
                                                    $req  = ($bd->query('Select IMAGE_ENS from enseignant WHERE CODE_ENS  ="'.$rest.'"'));
                                                    $ress = $req->fetch();
                                                    $url = $ress['IMAGE_ENS'];
                                                    echo "../images/".$url;
                                                }
                                            
                                            
                                        ?>"  alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $prenom." ".$nom ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>En ligne</a>
        </div>
      </div>
      <!-- search form -->
      <form action="" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="rech" id="rech" onkeyup="recherche(this)" class="form-control" placeholder="recherche...">
              <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

<ul class="sidebar-menu">
        <li class="header">NAVIGATION PRINCIPALE</li>
        <li class="active"><a href="../Profil/Profil.php"><i class="fa fa-user"></i> <span>Profil</span></a></li>
        <?php 
        if ($Etat =="coordonateur filiere"){
          echo '
        <li ><a href="../Coordonateur_filiere/Mes_Filieres1.php"><i class="fa fa-archive"></i> <span>Mes filières</span></a></li>
        <li ><a href="../Coordonateur_filiere/Mes_Filieres_partagees1.php"><i class="fa fa-users"></i> <span>Mes filières partagées</span></a></li>';
      }if ($Etat =="enseignant"){
          echo '
        <li ><a href="Profil.php"><i class="fa fa-archive"></i> <span>Mes matiéres</span></a></li>
        <li ><a href="Profil.php"><i class="fa fa-users"></i> <span>Mes matiéres partagées</span></a></li>
        <li ><a href="Profil.php"><i class="fa fa-bookmark"></i> <span>Mes matiéres sauvegardées</span></a></li>

        ';
      }if ($Etat =="Coordonnateur Module"){
          echo '
        <li ><a href="Profil.php"><i class="fa fa-archive"></i> <span>Mes modules</span></a></li>
        <li ><a href="Profil.php"><i class="fa fa-users"></i> <span>Mes modules partagées</span></a></li>';
      }if ($Etat =="Chef Departement"){
          echo '
        <li ><a href="Profil.php"><i class="fa fa-archive"></i> <span>Mes ...</span></a></li>
        <li ><a href="Profil.php"><i class="fa fa-users"></i> <span>Mes .. partagées</span></a></li>';
      }
        ?>
        <li class="header">INFORMATIONS GENERALES</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>