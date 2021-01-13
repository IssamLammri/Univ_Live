<?php
session_start();
include '../connexion.php';
$Etat = $_SESSION['NIV'];
if ( $Etat == "enseignant")
{
	$rest = $_SESSION['info'];
	$bd = new PDO('mysql:host=localhost;dbname=pfe', 'root', '' , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$req  = ($bd->query('Select  PRENOM_ENS , NOM_ENS ,SPECIALTE_ENS  from enseignant WHERE   CODE_ENS  ="'.$rest.'"'));
	$req2 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA from enseignant as C , etablissement as E , universite as U , departement as D where C.CODE_ENS  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
	$req3 = ($bd->query('select U.NOM_UNIVERSITE , E.NOM_ETA from enseignant as C , etablissement as E , universite as U , departement as D where C.CODE_ENS  ="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
	$req4 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM intervient WHERE CODE_ENS="'.$rest.'"'));
	$req5 = ($bd->prepare('SELECT 	m.NOM_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT'));
	$req6 = ($bd->prepare('SELECT 	m.CODE_MAT FROM intervient as i , matiere as m WHERE i.CODE_ENS="'.$rest.'" and i.CODE_MAT=m.CODE_MAT '));
	$ress = $req->fetch();
	$ress1= $req4->fetch();
	$req5->execute();
	$ress2  =  $req5->fetchAll();
	$prenom = $ress['PRENOM_ENS'];
	$nom = $ress['NOM_ENS'];
	$sep = $ress['SPECIALTE_ENS'];
	$nb     = $ress1['Nombre_Mat'];
	$nb     = $nb-1;


	$req44 = ($bd->query('SELECT count(CODE_MAT) as Nombre_Mat FROM matiere_partagee WHERE CODE_ENS_v="'.$rest.'" or CODE_ENS_v=0'));
	$req55 = ($bd->prepare('SELECT 	m.NOM_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or  i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));
	$req66 = ($bd->prepare('SELECT 	m.CODE_MAT FROM matiere_partagee as i , matiere as m WHERE (i.CODE_ENS_v="'.$rest.'" or i.CODE_ENS_v="0") and i.CODE_MAT=m.CODE_MAT '));
	$req55->execute();
	$ress11= $req44->fetch();
	$ress22  =  $req55->fetchAll();
	$nb1     = $ress11['Nombre_Mat'];
	$nb1     = $nb1-1;


	if(isset($_POST['exporter1']))
	{

	$type_inter=$_POST['type_intervention'];
	$code_mat=$_POST['output'];


        	$query ="INSERT INTO `intervient` (`CODE_ENS`, `CODE_MAT`) VALUES ('$rest','$code_mat')" ;
        	$result=mysqli_query($ma_connexion,$query); 
        	if($result == true)
        	{
        	}
        	else
        	echo "<script>alert('Vous intervenez cette matiere deja')</script>";
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
header('Location: ../index.php');

}

if (!isset($_SESSION['NIV'])) 
{
header('Location: ../index.php');
}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Mes Matière partagées</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">  
  <link rel="stylesheet" type="text/css" href="../css/ionicons.min.css">  
  <!-- Theme style -->
  <!-- jQuery -->
    <script src="../js/jquery.js"></script>
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src="../js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css">  
  <script src="../js/sweetalert2.min.js"></script>

    <script src="../js/jquery.knob.min.js"></script>
    <script src="../js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="../css/jquery-confirm.min.css">
  <script src="../js/jquery-confirm.min.js"></script>
  <script type="text/javascript">
  $(function() {
    $('#Matieres_sauvegardees').addClass("active");
  });
</script>
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
<body class="sidebar-mini wysihtml5-supported skin-blue">
<div class="wrapper">

<?php include("../includes/header.php"); ?>
<?php include("../includes/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mes Matières Sauvegardées
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">


      	<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <form name="sform1" id="sform1" method="POST" onsubmit="return checkall();">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Le Type de l'intervention</h4>
			</div>

			<div class="modal-body" style="height: 170px;">

					<div class="form-group">
						<!-- <label class="col-sm-4 control-label">Le Reporting</label> -->
					</div>
					
			<input type="hidden" name="output">
			<br><br>
			</div>
			<div class="modal-footer">
			<button type="submit" name="exporter1" value="exporter1" id="exporter1" class="btn btn-default">Suivant</button>
			 <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			</div>
		</div>
			</form>
</div>
</div>



		<div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mes Matières Sauvegardées : <?php echo $nb1+1  ?></h3>
            </div>

			<form method="post" action="telepdf.php">
				<div class="box-body table-responsive no-padding">
				<table id="findresult" class="table table-hover">
					<thead>
					</thead>
					<tbody>

      
<?php
$rest = $_SESSION['info'];
$query = "select M.NOM_MAT AS NOM_MAT,M.VOLUME_COURS_MAT as VCM,M.VOLUME_TD_MAT as VTD,M.VOLUME_TP_MAT as VTP, MO.NOM_MODU AS NOM_MODU,F.NOM_FIL AS NOM_FIL,M.CODE_MAT AS CODE_MAT,D.NOM_DEPT as NOM_DEPT,Et.NOM_ETA as NOM_ETA
           from matiere M , module MO , filiere F,Departement D,etablissement Et,matiere_enregistrées ms
           where M.CODE_MODU=MO.CODE_MODU
           AND MO.CODE_FIL=F.CODE_FIL
           AND F.CODE_DEPT=D.CODE_DEPT
           AND D.CODE_ETA=Et.CODE_ETA
           AND ms.CODE_MAT=M.CODE_MAT
           AND ms.CODE_ENS='$rest' ";

              $result = mysqli_query($ma_connexion, $query); 
              $i=0;
              if(mysqli_num_rows($result) > 0)  
                {  
                echo            '<tr>';
                echo            '<th>matière</th>';
                echo            '<th>module</th>';
                echo            '<th>filière</th>';
                echo              '<th>Departement</th>';
                echo              '<th>Etablissement</th>';
                echo              '<th>Volume_C</th>';
                echo              '<th>Volume_TD</th>';
                echo              '<th>Volume_TP</th>';                
                echo            '<th class="download">Télécharger</th>';
                echo            '<th>Autoriser</th>';               
                echo          '</tr>';
                echo '<tr>';
               while($row = mysqli_fetch_array($result))  
                  {
                  	$NOM_MAT=$row['NOM_MAT'];
                  	$NOM_MODU=$row['NOM_MODU'];
                  	$NOM_FIL=$row['NOM_FIL'];
                  	$NOM_DEPT=$row['NOM_DEPT'];
                  	$NOM_ETA=$row['NOM_ETA'];
                  	$VCM=$row['VCM'];
                  	$VTD=$row['VTD'];
                  	$VTD=$row['VTD'];

                echo "<td> ".$NOM_MAT."</td>";
                echo '<td>'.$NOM_MODU.'</td>';
                echo '<td>'.$NOM_FIL.'</td>';
                echo '<td>'.$NOM_DEPT.'</td>';
                echo '<td>'.$NOM_ETA.'</td>';
                echo '<td>'.$VCM.'</td>';
                echo '<td>'.$VTD.'</td>';
                echo '<td>'.$VTD.'</td>';                
                echo '<td><button id="'.$i.'" type="submit" value="'.ucfirst(strtolower($row['NOM_MAT'])).'" name ="tl1" class="btn btn-default"><i class=" fa fa-cloud-download"></i></button></td>';
                echo '<td><button id="mod'.$i.'" type="button" value="'.ucfirst(strtolower($row['CODE_MAT'])).'" name ="tl2" class="btn btn-default" onClick="afficher1(this)"><i class="fa fa-plus-square"></i></button></td>';
                $i++;
                echo '</tr>';
                }
              }
?>

			</tbody>
			</table>
		</div>
			</form>


            </div>
          <!-- /.box -->
        </div>

      </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>By DAL</b>
    </div>
    <strong>Copyright &copy; 2017-2018</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script>
		var text="#mod0,";
      for(var ii = 1; ii<30;ii++){
        text +="#mod"+ii+",";
      }
      text += "#mod30";
      
      
        $(text).click(function(){
          $("#myModal1").modal();
        });

        function afficher1(objButton) 
    { 
    var testin = objButton.value;
    document.sform1.output.value=testin 
      } 


   function checkall()
	{

		var cours = document.getElementById('cours');
		var td = document.getElementById('td');
		var tp = document.getElementById('tp');
		var enca = document.getElementById('enca');
		
	if(cours.checked==true || td.checked==true || tp.checked==true || enca.checked==true)
	{
	return true;
	}
	else
	{
	return false;
	}

	}

	</script>

</body>
</html>
