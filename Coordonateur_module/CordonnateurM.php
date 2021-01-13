<?php
session_start();
include '../connexion.php';


$Etat = $_SESSION['NIV'];
if(isset($_SESSION['hhh']))
{
$idmodule =$_SESSION['id_M'];
$reqq00  = ($bd->query('Select CODE_COR_MODU FROM module WHERE CODE_MODU ="'.$idmodule.'" '));
$ress00 = $reqq00->fetch();
$rest=$ress00['CODE_COR_MODU'];

$reqq  = ($bd->query('Select CM.NOM_COR_MODU,CM.PRENOM_COR_MODU,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_module CM,departement D WHERE CM.CODE_COR_MODU  ="'.$rest.'" AND CM.CODE_DEPT=D.CODE_DEPT '));

$reqq2 = ($bd->query('select  U.NOM_UNIVERSITE , E.NOM_ETA from coordonateur_module as C  , etablissement as E  , universite as U  , departement as D where   C.CODE_COR_MODU="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
$reqq3  =($bd->query('Select  NOM_MODU,ID_SEMSTRE from module  WHERE CODE_MODU="'.$idmodule.'"'));
$reqq9  =($bd->query('Select  CODE_MODU from module WHERE CODE_MODU="'.$idmodule.'" '));

$req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_module as CM,etablissement as E,universite as U,departement as D where CM.CODE_COR_MODU="'.$rest.'" and CM.CODE_DEPT=D.CODE_DEPT and CM.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));

$ress3 = $req2->fetch();
$ress = $reqq->fetch();
$ress1 = $reqq2->fetch();
$ress2 = $reqq3->fetch();
$ress9 = $reqq9->fetch();
$nom=$ress['NOM_COR_MODU'];
$code_modu=$ress9['CODE_MODU'];
$prenom=$ress['PRENOM_COR_MODU'];
$nom_dept = $ress['nom_dept'];
$code_dept=$ress['code_dept'];
$universite =$ress1['NOM_UNIVERSITE'];
$etat=$ress1['NOM_ETA'];
$monm=$ress2['NOM_MODU'];
$idsemestre=$ress2['ID_SEMSTRE'];
$nom_uni=$ress3['nom_uni'];
$nom_etab=$ress3['nom_eta'];
$code_uni=$ress3['code_uni'];
$code_eta=$ress3['code_eta'];
$reqq4=($bd->query('select count(Ma.CODE_MAT) as nb from matiere Ma , Module Mo where Ma.CODE_MODU=MO.CODE_MODU AND Mo.CODE_MODU="'.$idmodule.'" '));
$ress4 = $reqq4->fetch();
$nb=$ress4['nb'];
$nb=$nb-1;

$reqq5=($bd->query('select count(MP.CODE_OBJECTIF_MODU) as nb_obj from objectifs P , Module M ,objectifs_modules MP 
                    where MP.CODE_MODU=M.CODE_MODU 
                    AND P.CODE_OBJECTIF_MODU=MP.CODE_OBJECTIF_MODU 
                    AND MP.CODE_MODU="'.$idmodule.'"'));
$ress5 = $reqq5->fetch();
$nb1=$ress5['nb_obj'];
$nb1=$nb1-1;


$reqq6=($bd->query('select count(MP.code_pre) as nb_pre from prerequis P , Module M ,module_prerequis MP 
                    where MP.CODE_MODU=M.CODE_MODU 
                    AND P.code_pre=MP.code_pre 
                    AND MP.CODE_MODU="'.$idmodule.'"'));
$ress6 = $reqq6->fetch();
$nb2=$ress6['nb_pre'];
$nb2=$nb2-1;


$reqq7=($bd->query('select count(Di.CODE_DIDACTIQUE_MODU) as nb_did from module_didactique MD , Module M ,didactiques Di 
                    where MD.CODE_MODU=M.CODE_MODU 
                    AND Di.CODE_DIDACTIQUE_MODU=MD.CODE_DIDACTIQUE_MODU 
                    AND MD.CODE_MODU="'.$idmodule.'"'));
$ress7 = $reqq7->fetch();
$nb4=$ress7['nb_did'];
$nb4=$nb4-1;

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

else
{
$idf=$_SESSION['idf'];
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

$idmodule =$_SESSION['idf'];
$reqq  = ($bd->query('Select CM.NOM_COR_MODU,CM.PRENOM_COR_MODU,D.NOM_DEPT as nom_dept,D.CODE_DEPT As code_dept from coordonateur_module CM,departement D WHERE CODE_COR_MODU  ="'.$rest. '" AND CM.CODE_DEPT=D.CODE_DEPT '));
$reqq2 = ($bd->query('select  U.NOM_UNIVERSITE , E.NOM_ETA from coordonateur_module as C  , etablissement as E  , universite as U  , departement as D where   C.CODE_COR_MODU="'.$rest.'" and C.CODE_DEPT=D.CODE_DEPT and  D.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE = U.CODE_UNIVERSITE ;'));
$reqq3  =($bd->query('Select  NOM_MODU,ID_SEMSTRE from module  WHERE CODE_MODU="' . $idf . '"'));
$reqq9  =($bd->query('Select  CODE_MODU from module WHERE CODE_MODU="'.$idf.'" '));

$req2 = ($bd->query('select U.CODE_UNIVERSITE as code_uni,U.NOM_UNIVERSITE as nom_uni,E.NOM_ETA as nom_eta,E.CODE_ETA as code_eta from coordonateur_module as CM,etablissement as E,universite as U,departement as D where CM.CODE_COR_MODU="'.$rest.'" and CM.CODE_DEPT=D.CODE_DEPT and CM.CODE_ETA= E.CODE_ETA and E.CODE_UNIVERSITE=U.CODE_UNIVERSITE'));
$ress3 = $req2->fetch();
$ress = $reqq->fetch();
$ress1 = $reqq2->fetch();
$ress2 = $reqq3->fetch();
$ress9 = $reqq9->fetch();
$nom=$ress['NOM_COR_MODU'];
$code_modu=$ress9['CODE_MODU'];
$prenom=$ress['PRENOM_COR_MODU'];
$nom_dept = $ress['nom_dept'];
$code_dept=$ress['code_dept'];
$universite =$ress1['NOM_UNIVERSITE'];
$etat=$ress1['NOM_ETA'];
$monm=$ress2['NOM_MODU'];
$idsemestre=$ress2['ID_SEMSTRE'];
$nom_uni=$ress3['nom_uni'];
$nom_etab=$ress3['nom_eta'];
$code_uni=$ress3['code_uni'];
$code_eta=$ress3['code_eta'];
$reqq4=($bd->query('select count(Ma.CODE_MAT) as nb from matiere Ma , Module Mo where Ma.CODE_MODU=MO.CODE_MODU AND Mo.CODE_MODU="'.$idf.'" '));
$ress4 = $reqq4->fetch();
$nb=$ress4['nb'];
$nb=$nb-1;

$reqq5=($bd->query('select count(MP.CODE_OBJECTIF_MODU) as nb_obj from objectifs P , Module M ,objectifs_modules MP 
                    where MP.CODE_MODU=M.CODE_MODU 
                    AND P.CODE_OBJECTIF_MODU=MP.CODE_OBJECTIF_MODU 
                    AND MP.CODE_MODU="'.$idmodule.'"'));
$ress5 = $reqq5->fetch();
$nb1=$ress5['nb_obj'];
$nb1=$nb1-1;


$reqq6=($bd->query('select count(MP.code_pre) as nb_pre from prerequis P , Module M ,module_prerequis MP 
                    where MP.CODE_MODU=M.CODE_MODU 
                    AND P.code_pre=MP.code_pre 
                    AND MP.CODE_MODU="'.$idmodule.'"'));
$ress6 = $reqq6->fetch();
$nb2=$ress6['nb_pre'];
$nb2=$nb2-1;


$reqq7=($bd->query('select count(Di.CODE_DIDACTIQUE_MODU) as nb_did from module_didactique MD , Module M ,didactiques Di 
                    where MD.CODE_MODU=M.CODE_MODU 
                    AND Di.CODE_DIDACTIQUE_MODU=MD.CODE_DIDACTIQUE_MODU 
                    AND MD.CODE_MODU="'.$idmodule.'"'));
$ress7 = $reqq7->fetch();
$nb4=$ress7['nb_did'];
$nb4=$nb4-1;

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
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Ma Filière</title>
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

	<style>
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
</style>



  <script type="text/javascript">
  $(function() {
    $('#Mes_Modules').addClass("active");
  });
</script>




</head>
<body class="sidebar-mini wysihtml5-supported skin-blue">
<div class="wrapper">


<?php 
	 $SQL="SELECT f.NOM_FIL
			FROM module m , filiere f 
			where m.CODE_FIL = f.CODE_FIL
			and m.CODE_MODU ='".$idmodule."' ";
			
		$nom_FILiere = null ; 	
		$query=mysqli_query($ma_connexion,$SQL);
		while($row=mysqli_fetch_assoc($query))
		{
			$nom_FILiere = $row['NOM_FIL'];	
		}
?>



<?php include("../includes/header.php"); ?>
<?php include("../includes/aside.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Détails Module : 
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="modal fade" id="ajouterobjectif_test" role="dialog">
      <div class="modal-dialog">
      <form action="" class="formName">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nouvel Objectif </h4>
        </div>
        <div class="modal-body">
              <div class="form-group">
              <label>Enter le nom de l'objectif </label>
              <input type="text" placeholder="Objectif" class="name form-control" id="newOBJtext" required />
              
              <br>
              <label>Ou bien choisir un objectif parmi ceux</label>
              <br>
              <br>
              <div class="col-xs-12">
                <select class="form-control" name='obj_modu' id="obj_modu"> 
                  <option value="" style="font-weight: bold;" selected="" disabled="">Objectif</option>
                  <?php 
                    $sql="select OBJECTIFS_MODU as obj_modu,CODE_OBJECTIF_MODU as code_obj
                    from objectifs 
                    where CODE_OBJECTIF_MODU not in (SELECT CODE_OBJECTIF_MODU
                                      FROM objectifs_modules
                                       where CODE_MODU = '$idmodule') ";
                    $result=mysqli_query($ma_connexion,$sql);
                    while($row = mysqli_fetch_array($result))  
                       {  
                        $code_obj = $row['code_obj'];
                        $obj_modu = $row['obj_modu'];
                        echo '<option value='.$code_obj.'>'.$obj_modu.'</option>'; 
                    }
                  ?> 
                </select> 
              </div>
              <br>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="ajouterobj()" class="btn btn-primary">VALIDER</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
        </div>
        </div>
        </form>
        
        
        <script>
        
        var i=0;
         function ajouterobj()
         {  
          var nbr_lignes = document.getElementById('tableau_obj').rows.length; 
        document.getElementById('output1_obj').value = nbr_lignes;

        if ( $("#newOBJtext").val() != '')
        {
          var obj_modu = $("#newOBJtext").val(); 
          var dataString2 = 'obj_modu='+ obj_modu; 

        $.ajax
          ({
            type: "POST",
            url: "test_existence.php",
            data: dataString2,
            cache: false,
            success: function(html)
            {
              if (html.trim() == "404") 
              {
                swal(
                  'Erreur...',
                  'Cet objectif existe Deja',
                  'error'
                )
                $("#newOBJtext").val('');
              }
              else
              {
               var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#obt"+j).val();
                  if(obj_modu == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Cet objectif existe Deja',
                    'error'
                    )
                  $("#newOBJtext").val('');
                  }
                  else
                  {
                    $('#tableau_obj').append('<tr id="row_obj'+i+'"><td><input type="text" class="form-control" id="obt'+i+'" name="ob'+i+'"  placeholder="objectif_module" value="'+obj_modu+'" readonly required/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
                    $("#newOBJtext").val('');
                      i++;
                  }

                
              }
            }
          });
          
                       
               
          }

        else{

          var idExisistObjectifs = $('select[name=obj_modu]').val();
          var idExisistObjectifsName = $("#obj_modu :selected").text();
          if(idExisistObjectifs != null)
          {

          var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#obt"+j).val();
                  if(idExisistObjectifsName == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Cet objectif existe Deja',
                    'error'
                    )
                  $("#newOBJtext").val('');
                  }
                  else
                  {
               $('#tableau_obj').append('<tr id="row_pre'+i+'"><input type="hidden" name="idExisistObjectifs'+i+'" value="'+idExisistObjectifs+'"/><td><input type="text" class="form-control" id="obt'+i+'" name="ob'+i+'" placeholder="pre-requis_module" value="'+idExisistObjectifsName+'" required readonly/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
               $("#newOBJtext").val('');
            i++;                  
          }
        }
      else
      {
        swal(
                    'Erreur...',
                    'essayez de remplir l\'un des objectifs ',
                    'error'
                    )
      }
      }
      
         }  
      </script>
      </div>
  </div> 


<div class="modal fade" id="ajouterprerequis_test" role="dialog">
      <div class="modal-dialog">
      <form action="" class="formName">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nouvel pre-requis </h4>
        </div>
        <div class="modal-body">
           
              <div class="form-group">
              <label>Enter le nom du pre-requis </label>
              <input type="text" placeholder="Objectif" class="name form-control" id="newPREtext" required />
              
              <br>
              <label>Ou bien choisir des pre-requis parmi ceux</label>
              <br>
              <br>
              <div class="col-xs-12">
                <select class="form-control" name='pre_modu' id="pre_modu"> 
                  <option value="" style="font-weight: bold;" selected="" disabled="">Pre-Requis</option>
                  <?php 
                        
                    $sql="select P.prerequis as pre_modu,P.code_pre as code_pre
                    from prerequis P 
                    where P.code_pre not in (SELECT code_pre
                                      FROM module_prerequis
                                                                      where CODE_MODU = '$idmodule' ) ";
                    $result=mysqli_query($ma_connexion,$sql);
                    while($row = mysqli_fetch_array($result))  
                       {  

                        $codepre = $row['code_pre'];
                        $objectif_pre = $row['pre_modu'];
                        echo "<option value='".$codepre."'>$objectif_pre </option>"; 
                    }

                  ?> 
                </select> 
              </div>
              <br>
              </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" onclick="ajouterpre()" class="btn btn-primary">VALIDER</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
        </div>
        </div>
        </form>
        <script>
        var i=0;
         function ajouterpre()
         {  
          var nbr_lignes = document.getElementById('tableau_pre').rows.length; 
        document.getElementById('output1_pre').value = nbr_lignes;

        if ( $("#newPREtext").val() != '')
        {
          var pre_modu = $("#newPREtext").val();
          var dataString2 = 'pre_modu='+ pre_modu;
        

        $.ajax
          ({
            type: "POST",
            url: "test_existence.php",
            data: dataString2,
            cache: false,
            success: function(html)
            {
              if (html.trim() == "404") 
              {
                swal(
                  'Erreur...',
                  'Ce pre-requis existe Deja',
                  'error'
                )
                $("#newPREtext").val('');
              }
              else
              {
               var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#pre"+j).val();
                  if(pre_modu == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Ce pre-requis existe Deja',
                    'error'
                    )
                  $("#newPREtext").val('');
                  }
                  else
                  {
                       
               $('#tableau_pre').append('<tr id="row_pre'+i+'"><td><input type="text" class="form-control" id="pre'+i+'" name="pre'+i+'"  placeholder="pre-requis_module" value="'+pre_modu+'" readonly required/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
               $("#newPREtext").val('');
            i++;
                }
              }
            }
          });

        }

          else{

            var idExisistPrerequis = $('select[name=pre_modu]').val();
          var idExisistPrerequisName = $("#pre_modu :selected").text();
          if(idExisistPrerequis != null)
          {
            var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#pre"+j).val();
                  if(idExisistPrerequisName == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Ce pre-requis existe Deja',
                    'error'
                    )
                  $("#newPREtext").val('');
                  }
                  else
                  {
          
               $('#tableau_pre').append('<tr id="row_pre'+i+'"><input type="hidden" name="idExisistPrerequis'+i+'" value="'+idExisistPrerequis+'"/><td><input type="text" class="form-control" id="pre'+i+'" name="pre'+i+'" placeholder="pre-requis_module" value="'+idExisistPrerequisName+'" required readonly/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
               $("#newPREtext").val('');
            i++;        
        }
        }
      else
      {
        swal(
                    'Erreur...',
                    'essayez de remplir l\'un pre-requis ',
                    'error'
                    )
      }

         }  
      }
      </script>
      </div>
  </div> 

<div class="modal fade" id="ajouterdidactiques_test" role="dialog">
      <div class="modal-dialog">
      <form action="" class="formName">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nouvelle didactique </h4>
        </div>
        <div class="modal-body">
           
              <div class="form-group">
              <label>Enter le nom du didactiques </label>
              <input type="text" placeholder="Didactiques" class="name form-control" id="newDIDtext" required />
              
              <br>
              <label>Ou bien choisir des Didactiques parmi ceux</label>
              <br>
              <br>
              <div class="col-xs-12">
                <select class="form-control" name='dida_modu' id="dida_modu"> 
                  <option value="" style="font-weight: bold;"  selected="" disabled="">Didactiques</option>
                  <?php 
                        
                    $sql="select DIDACTIQUE_MODU as dida_modu,CODE_DIDACTIQUE_MODU as code_dida
                    from didactiques
                    where CODE_DIDACTIQUE_MODU not in (SELECT CODE_DIDACTIQUE_MODU
                                      FROM module_didactique
                                                                      where CODE_MODU = '$idmodule' ) ";
                    $result=mysqli_query($ma_connexion,$sql);
                    while($row = mysqli_fetch_array($result))  
                       {  

                        $codedida = $row['code_dida'];
                        $dida_pre = $row['dida_modu'];
                        echo "<option value='".$codedida."'> $dida_pre </option>"; 
                    }

                  ?> 
                </select> 
              </div>
              <br>
              </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" onclick="ajouterdida()" class="btn btn-primary">VALIDER</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
        </div>
        </div>
        </form>
        <script>
        var i=0;
         function ajouterdida()
         {  
          var nbr_lignes = document.getElementById('tableau_dida').rows.length; 
        document.getElementById('output1_dida').value = nbr_lignes;

        if ( $("#newDIDtext").val() != '')
        {

          var dida_modu = $("#newDIDtext").val(); 
          var dataString2 = 'dida_modu='+ dida_modu;
          $.ajax
          ({
            type: "POST",
            url: "test_existence.php",
            data: dataString2,
            cache: false,
            success: function(html)
            {
              if (html.trim() == "404") 
              {
                swal(
                  'Erreur...',
                  'didactique existe Deja',
                  'error'
                )
                $("#newDIDtext").val('');
              }
              else
              {
               var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#dida"+j).val();
                  if(dida_modu == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Didactiques existe Deja',
                    'error'
                    )
                  $("#newDIDtext").val('');
                  }
      else
        {
                                  
               $('#tableau_dida').append('<tr id="row_pre'+i+'"><td><input type="text" class="form-control" id="dida'+i+'" name="dida'+i+'"  placeholder="didactiques module" value="'+dida_modu+'" readonly required/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
               $("#newDIDtext").val('');
            i++;
          }
      }
    }
  });
      } 
        else
        {

          var idExisistDidactiques = $('select[name=dida_modu]').val();
          var idExisistDidactiquesName = $("#dida_modu :selected").text();  
          if(idExisistDidactiques != null)
          {

          var ind=0;
          for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#dida"+j).val();
                  if(idExisistDidactiquesName == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Didactiques existe Deja',
                    'error'
                    )
              }

        else
        {
               $('#tableau_dida').append('<tr id="row_pre'+i+'"><input type="hidden" name="idExisistDidactiques'+i+'" value="'+idExisistDidactiques+'"/><td><input type="text" class="form-control" id="dida'+i+'" name="dida'+i+'" placeholder="didactiques module" value="'+idExisistDidactiquesName+'" required readonly/></td><datalist id="cookies1"></datalist></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td> </tr>');
               $("#newDIDtext").val('');
        
            i++;  
            } 
          }
          else
        {
          swal(
                    'Erreur...',
                    'essayez de remplir l\'un pre-requis ',
                    'error'
                    )
        }

          }           
    }
      </script>
      </div>
  </div> 

  <div class="modal fade" id="ajoutermatiere_test" role="dialog">
    <div class="modal-dialog">
    <form action="" class="formName">
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouvelle Matiere </h4>
      </div>
      <div class="modal-body">
         
            
            <div class="form-group">
              
              <div class="col-xs-10">
              <label for="NEW_matiere_libellle">Nom du matiere</label>
                <input placeholder="matiere" class="name form-control"  id="NEW_matiere_libellle" autofocus="" required="" type="text">
              </div>
              
              <div class="col-xs-2">
                <label for="NEW_matiere_volume">Volume </label>
                <input min="0" value="90" class="name form-control" id="NEW_matiere_volume" step="10" min="0" max="200"  type="number" required>
              </div>
            
              
              <br><br>
              
            
              <div class="col-sm-12" id="infohiddenADDnomaaaa">
              <div class="col-sm-12" id="infohiddenADDnom">
              <label>Enter le nom de l'enseigant </label>
              <input type="text" placeholder="nom " class=" form-control" id="NEW_matiere_Corodonateurinput"   />
              </div>
              
              <div class="col-sm-6" id="infohiddenADDprenom">
                <label>prenom </label>
                <input type="text" placeholder="prenom " class=" form-control" id="NEW_matiere_CorodonateurinputPrenom"   />
              </div>
              
              <div id="infohidden" >
              
              <div class="col-xs-3">
                <label for="NEW_matiere_Corodonateur_etablissement">Etablissement </label>
                  <select  class="form-control" id="NEW_matiere_Corodonateur_etablissement" name="NEW_matiere_Corodonateur_etablissement"  required >
                    
                    <?php 
                                
                      $SQL="select CODE_ETA , NOM_ETA  from etablissement;";
                      $query=mysqli_query($ma_connexion,$SQL);
                      while($row=mysqli_fetch_assoc($query))
                      { 
                          
                          $codeDEB = $row['CODE_ETA'];
                          $libelleDEB = $row['NOM_ETA'];
                          if($codeDEB == $etatcode)
                          {
                            echo "<option value='$codeDEB' selected>$libelleDEB</option> " ; 
                          }
                          else{
                            echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
                          }

                          
                      }

                      ?> 
                  </Select>
                </div>
                
                
                <div class="col-xs-3">
                <label for="NEW_matiere_Corodonateur_Dept">departement </label>
                  <select  class="form-control" id="NEW_matiere_Corodonateur_Dept" name="NEW_matiere_Corodonateur_Dept"  required >
                    <option > -- SELECTIONNEZ DEPARTEMET --</option>
                  </Select>
                </div>
                
                <div class="col-xs-3">
                
                <label for="NEW_matiere_Corodonateur_specialite">Specialite </label>
                  <select  class="form-control" id="NEW_matiere_Corodonateur_specialite" name="NEW_matiere_Corodonateur_specialite"  required >
                    <?php 
                                
                      $SQL="select CODE_SPEC , NOM_SPEC  from specialite_crm;";
                      $query=mysqli_query($ma_connexion,$SQL);
                      while($row=mysqli_fetch_assoc($query))
                      { 
                          $codeDEB = $row['CODE_SPEC'];
                          $libelleDEB = $row['NOM_SPEC'];

                          echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
                      }
                      ?> 
                  </Select>
                </div>
                
                <div class="col-xs-3">
                <label for="NEW_matiere_Corodonateur_grade">Grade </label>
                  <select  class="form-control" id="NEW_matiere_Corodonateur_grade" name="NEW_matiere_Corodonateur_grade"  required >
                    <?php 
                                
                      $SQL="select CODE_GRAD , NOM_GRAD  from grade_crm;";
                      $query=mysqli_query($ma_connexion,$SQL);
                      while($row=mysqli_fetch_assoc($query))
                      { 
                          $codeDEB = $row['CODE_GRAD'];
                          $libelleDEB = $row['NOM_GRAD'];

                          echo "<option value='$codeDEB'>$libelleDEB</option> " ; 
                      }

                      ?> 
                  </Select>
                </div>
                
                
                
                <br><br>
              <br>
              </div>
              </div>
              
              <br>
              <br>
              <label>Ou bien choisir l'un des intervenants parmi ceux  classe par : </label>
              <div class="radio">
                <label><input type="radio" name="CLASSEMENT" value="departement" id="CLass_departement" >departement</label>               
                <label><input type="radio" name="CLASSEMENT" value="Grade" id="Class_Grade" >Grade</label>
                <label><input type="radio" name="CLASSEMENT" value="Specialite" id="Class_Specialite" >Specialite</label>
              </div>
              
              
              
              
              <div class="col-xs-4" >
              
                <select class="form-control" name='NEW_matiere_LEFILIERES' id="NEW_matiere_LEFILIERES" > 
                
                </select> 
              </div>
              
              <script>
              var resultClass = 'departement' ; 
              var departActive = '<?php echo $code_dept?>' ;
              var EtabActive = '<?php echo $code_eta ?>' ;
              var dataString = 'departActive=' + departActive + '&EtabActive=' + EtabActive; 
              
                $('input[type=radio][name=CLASSEMENT]').change(function() {

                    if (this.value == 'departement') {
                      dataString += '&indice=departement' ; 
                      resultClass = 'departement' ; 
                    }
                    
                    else if (this.value == 'Grade') {
                      dataString += '&indice=Grade' ; 
                      resultClass = 'Grade' ; 
                    }
                    else if (this.value == 'Specialite') {
                      dataString += '&indice=Specialite' ; 
                      resultClass = 'Specialite' ; 
                    }
                    $.ajax({
                      type: "POST",
                      url: "getClassCHange.php",
                      data: dataString,
                      cache: true,
                      success: function(html){
                          $("#NEW_matiere_LEFILIERES").html(html);
                      }
                    });
                  });
                    
                  $("#NEW_matiere_LEFILIERES").change(function()
                    {
                      var id=$(this).val();
                      var dataString1 = 'id='+ id + '&departActive=' + departActive + '&EtabActive=' + EtabActive; 
                      
                      if (resultClass == 'departement') {
                        dataString1 += '&indice=departement' ; 
                      }
                      
                      else if (resultClass == 'Grade') {
                        dataString1 += '&indice=Grade' ; 
                      }
                      else if (resultClass == 'Specialite') {
                        dataString1 += '&indice=Specialite' ; 
                      }
                      
                      $.ajax
                      ({
                        type: "POST",
                        url: "getenseignantparmodule.php",
                        data: dataString1,
                        cache: false,
                        success: function(html)
                        {
                          $("#NEW_matiere_COrdonateurSelect").html(html);
                        }
                      });
                    });
    
                    
                  
              </script>
               
              <div class="col-xs-8">
                <select class="form-control" name='NEW_matiere_COrdonateurSelect' id="NEW_matiere_COrdonateurSelect"> 
                  <option value=""></option>  
                </select> 
              </div>
              
              <br><br><br>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" onclick="ajoutermatierefonc()" class="btn btn-primary">VALIDER</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">QUITTER</button>
      </div>
      </div>
      </form>
      
      <script>
       var indiceNochange = 0 ; 
      $("#infohiddenADDnomaaaa").hide();
      $("#infohidden").hide();
      $("#infohiddenADDprenom").hide();
      </script>
      
      <script>
      var i=0; 
       function ajoutermatierefonc()
       {
         
         var nbr_lignes = document.getElementById('tableau').rows.length; 
        document.getElementById('output').value = nbr_lignes;
         
        var matiereNEW = $("#NEW_matiere_libellle").val() ; 
        var volumeNEW = $("#NEW_matiere_volume").val() ;
        var cordonateurExistsName = $("#NEW_matiere_COrdonateurSelect :selected").text();
        var cordonateurExistsID = $('select[name=NEW_matiere_COrdonateurSelect]').val(); 
        var dataString2 = 'matiereNEW='+ matiereNEW;

        $.ajax
          ({
            type: "POST",
            url: "test_existence.php",
            data: dataString2,
            cache: false,
            success: function(html)
            {
              if (html.trim() == "404") 
              {
                swal(
                  'Erreur...',
                  'Cette matiere existe Deja',
                  'error'
                )
                $("#NEW_matiere_libellle").val('');
              }
              else
              {
               var ind=0;
                for(j=0;j<nbr_lignes;j++)
                {
                  var test =$("#ne"+j).val();
                  if(matiereNEW == test)
                  ind=1;
                }
                if(ind == 1)
                  {
                    swal(
                    'Erreur...',
                    'Cette matiere existe Deja',
                    'error'
                    )
                  $("#NEW_matiere_libellle").val('');
                  }
      else
        {


  if ( matiereNEW != '')
    {
      
      $('#tableau').append('<tr id="row'+i+'"><input type="hidden" name="idExisistCordonateur'+i+'" value="'+cordonateurExistsID+'"/><td><input type="text" class="form-control" id="ne'+i+'" name="ne'+i+'" value="'+matiereNEW+'" placeholder="Nom matière" readonly required/></td> <td><input type="number" class="form-control" id="inputEmail3" name="ve'+i+'" value="'+volumeNEW+'" placeholder="Volume globale Matière" min="10" max="90" readonly required/></td> <td><input type="text" class="form-control"  value="'+cordonateurExistsName+'" readonly="readonly" name="newENS'+i+'" id="newENS'+i+'"></td><td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td><td><button id="'+i+'" type="button" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button></td></tr>');
      $("#NEW_matiere_libellle").val('');
      i++ ; 

        }

        else
        {
          swal(
                    'Erreur...',
                    'essayer de remplir les informations',
                    'error'
                    )
        }



}
      }
    }
  });
        
}

    </script>
    </div>
  </div> 

        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <div class="widget-user-header bg-black" style="background: url('../images/photo2.png') center;">
              <h3 class="widget-user-username"><?php echo $nom ; echo ' ' ; echo $prenom ;  ?></h3>
              <h5 class="widget-user-desc"><?php echo $Etat ;  ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php
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
                                            
                                            
                                        ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Université:</h5>
                    <span class="description-text"><?php echo $universite ; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Etablissement:</h5>
                    <span class="description-text"><?php echo $etat ; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Module:</h5>
                    <span class="description-text"><?php echo $monm ;  ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
            

        <div class="col-md-12 showhideadd">
            <form name="sform" id="sform" method="POST" >
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Module : <?php echo $monm ;  ?> </h3>
            </div>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h2 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Informations concernant ce Module : 
                      </a>
                    </h2>
                    <br>
                    <br>

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#a" data-toggle="tab">Objectif</a></li>
                <li><a href="#b" data-toggle="tab">Pre-requis</a></li>
                <li><a href="#Didactique-Module" data-toggle="tab">Didactique-Module</a></li>
                <li><a href="#Info-Matière" data-toggle="tab">Info-Matière</a></li>
               <!--  <li><a href="#indicateur"  data-toggle="tab">Indicateur</a></li> -->
                <li><a href="#comp" data-toggle="tab">Competances</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="a">

                <form action="" method="POST">
                	<div class="box-body table-responsive no-padding">
                  <table id="tableau_obj" class="table table-hover">
                      <tr>
                        <th>Objectif Module</th>
                      <th>Modifier</th>
                      <th>Supprimer</th>
                      </tr>
                      
                      <?php
                      

                    $sql="select P.OBJECTIFS_MODU as obj_modu,P.CODE_OBJECTIF_MODU as code_obj
                    from objectifs P , Module Mo ,objectifs_modules MP 
                    where MP.CODE_MODU=Mo.CODE_MODU 
                    AND P.CODE_OBJECTIF_MODU=MP.CODE_OBJECTIF_MODU
                    AND MP.CODE_MODU='$idmodule' ";
                     $result = mysqli_query($ma_connexion, $sql); 

                    if(mysqli_num_rows($result) > 0)  
                        {  $i=0;
                             while($row = mysqli_fetch_array($result))  
                             {  
                              $code_obj=$row['code_obj'];
                              $obj_modul=$row['obj_modu'];

                    echo '<tr id="row_obj'.$code_obj.'"><input type="hidden" name="'.$i.'" value="'.$code_obj.'">
                    <td><input type="text" name="o'.$i.'" class="form-control" id="o'.$i.'" value="'.$obj_modul.'" placeholder="Objectif Module" required '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '/></td>
                      <td><button id="" value="" type="button" class="btn btn-default" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
                      <td><button class="btn btn-danger btn_remove" name="'.$i.'" id="mod'.$i.'" value="'.$code_obj.'" type="button" onClick="affiche_obj(this)" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-fa fa-trash fa-lg modifier"></i></button></td>
                      </tr>';

                      $i++;
                    }
                  } 
                       ?>
                        
                       <input type="hidden" name="output1_obj" id="output1_obj" value="">
                       <input type="hidden" name="output2_obj" id="output2_obj" value="">
                    </tr>
                  </table>
                 <div class="form-group">
                          <label for="inputEmail3" class="col-sm-4 control-label"></label>
                            <div class="col-xs-4">
                            </div>
                  <?php
				if (!isset($_SESSION['hhh'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button id="ajouter_obj" type="button" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submamodu" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              			}
					?>
                  </div>
              </div>
                </form>

                
              </div>

              <div class="tab-pane" id="b">

                <form class="form-horizontal" action="" method="POST">
                	<div class="box-body table-responsive no-padding">
                    <table id="tableau_pre" class="table table-hover">
                      <tr>
                        <th>Pre-requis Module</th>
                      <th>Modifier</th>
                      <th>Supprimer</th>
                      </tr>
                      
                      <?php
                       

                    $sql="select P.prerequis as pre_modu,P.code_pre as code_pre
                    from prerequis P , Module Mo ,module_prerequis MP 
                    where MP.CODE_MODU=Mo.CODE_MODU 
                    AND P.code_pre=MP.code_pre
                    AND MP.CODE_MODU='$idmodule' ";
                     $result = mysqli_query($ma_connexion, $sql); 

                    if(mysqli_num_rows($result) > 0)  
                        {  $i=0;
                             while($row = mysqli_fetch_array($result))  
                             {  
                              $code_pre=$row['code_pre'];
                              $pre_modul=$row['pre_modu'];

                    echo '<tr id="row_pre'.$code_pre.'"><input type="hidden" name="'.$i.'" value="'.$code_pre.'">
                    <td><input type="text" name="p'.$i.'" class="form-control" id="p'.$i.'" value="'.$pre_modul.'" placeholder="Objectif Module" required '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '/></td>
                      <td><button id="" value="" type="button" class="btn btn-default" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
                      <td><button class="btn btn-danger btn_remove" name="'.$i.'" id="mod'.$i.'" value="'.$code_pre.'" type="button" onClick="affiche_pre(this)" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-fa fa-trash fa-lg modifier"></i></button></td>
                      </tr>';

                      $i++;
                    }
                  } 
                       ?>
                        
                       <input type="hidden" name="output1_pre" id="output1_pre" value="">
                       <input type="hidden" name="output2_pre" id="output2_pre" value="">
                    </tr>
                  </table>
                  <?php
				if (!isset($_SESSION['hhh'])) 
										{
										echo '   
								<div class="form-group" >
					            <div class="col-sm-offset-7">
					              <button id="ajouter_pre" type="button" onClick = "ajouterprerequis()" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
					            </div>
					          </div>' ;
					          echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submapre" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              			}
					?>
              </div>
                    </form>


                
		          </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="Didactique-Module">

                <br>
                  <form action="" method="POST">
                  	<div class="box-body table-responsive no-padding">
                  <table id="tableau_dida" class="table table-hover">
                      <tr>
                        <th>Didactiques Module</th>
                      <th>Modifier</th>
                      <th>Supprimer</th>
                      </tr>
                      
                      <?php
                      

                    $sql="select Di.DIDACTIQUE_MODU as dida_modu,Di.CODE_DIDACTIQUE_MODU as code_dida
                    from module_didactique MD , Module M ,didactiques Di 
                    where MD.CODE_MODU=M.CODE_MODU 
                    AND Di.CODE_DIDACTIQUE_MODU=MD.CODE_DIDACTIQUE_MODU 
                    AND MD.CODE_MODU='$idmodule' ";
                     $result = mysqli_query($ma_connexion, $sql); 

                    if(mysqli_num_rows($result) > 0)  
                        {  $i=0;
                             while($row = mysqli_fetch_array($result))  
                             {  
                              $code_dida=$row['code_dida'];
                              $dida_modul=$row['dida_modu'];

                    echo '<tr id="row_di'.$code_dida.'"><input type="hidden" name="'.$i.'" value="'.$code_dida.'">
                    <td><input type="text" name="d'.$i.'" class="form-control" id="d'.$i.'" value="'.$dida_modul.'" placeholder="didactiques Module" required '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '/></td>
                      <td><button id="" value="" type="button" class="btn btn-default" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-pencil-square-o fa-lg modifier"></i></button></td>
                      <td><button class="btn btn-danger btn_remove" name="'.$i.'" id="mod'.$i.'" value="'.$code_dida.'" type="button" onClick="affiche_dida(this)" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-fa fa-trash fa-lg modifier"></i></button></td>
                      </tr>';

                      $i++;
                    }
                  } 
                       ?>
                        
                       <input type="hidden" name="output1_dida" id="output1_dida" value="">
                       <input type="hidden" name="output2_dida" id="output2_dida" value="">
                    </tr>
                  </table>
              <?php
				if (!isset($_SESSION['hhh'])) 
					{
						echo '   
				<div class="form-group" >
	            <div class="col-sm-offset-7">
	              <button id="ajouter_dida" type="button" onClick = "affiche_nbr_dida();" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
	            </div>
	          </div>' ;
	          			echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submdida" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              			}
					?>
          </div>
                </form>



              </div>

              <div class="tab-pane" id="Info-Matière">

                <br>
                  <form class="form-horizontal" method="POST" action="">
                  	<div class="box-body table-responsive no-padding">
                    <table id="tableau" class="table table-hover">
                      <tr>
                        <th>Nom matière</th>
                        <th>Volume globale Matière</th>
                        <th>Nom et prénom enseignant</th>
                      <th>Modifier</th>
                      <th>Supprimer</th>
                      </tr>
                      
                      <?php
                      

                    $sql="select Ma.CODE_MAT as code_mat,Ma.NOM_MAT as nom_mat,Ma.VOLUME_HORAIRE_MAT as v_h
                    from matiere Ma , Module Mo 
                    where Ma.CODE_MODU=MO.CODE_MODU 
                    AND Mo.CODE_MODU='$code_modu' ";
                    $result = mysqli_query($ma_connexion, $sql); 

                     


                    if(mysqli_num_rows($result) > 0)  
                        {  
                            $i=0;
                             while($row = mysqli_fetch_array($result))  
                             {  
                              $code_mat=$row['code_mat'];
                              $nom_mat=$row['nom_mat'];
                        $v_h=$row['v_h'];

                        $sql3="select E.NOM_ENS as NOM_ENS,E.PRENOM_ENS as PRENOM_ENS,E.CODE_ENS as CODE_ENS
                        from enseignant E,intervient I,Module M,matiere Ma
                        Where E.CODE_ENS=I.CODE_ENS
                        AND I.CODE_MAT='$code_mat' ";
                        $result3 = mysqli_query($ma_connexion, $sql3); 
                        $code_ens_e=null;
                        $nom_ens_e=null;
                        $prenom_ens_e=null;

                        while($row3 = mysqli_fetch_array($result3)) 
                                {  
                              $code_ens_e=$row3['CODE_ENS'];
                              $nom_ens_e=$row3['NOM_ENS'];
                              $prenom_ens_e=$row3['PRENOM_ENS'];
                                }

                    echo '<tr id="row'.$code_mat.'"><input type="hidden" name="'.$i.'" value="'.$code_mat.'">
                    <td><input type="text" name="n'.$i.'" class="form-control" id="nom_mat" value="'.$nom_mat.'" placeholder="Nom matière" required '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '/></td>
                        <td><input type="number" class="form-control" min="10" max="90" id="v_h" name="v'.$i.'" value="'.$v_h.'" placeholder="Volume globale Matière" required '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '/></td>
                        <td>
                        <select name="e'.$i.'" class="form-control" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '>
                        <option value="'.$code_ens_e.'" selected>'.$nom_ens_e.' '.$prenom_ens_e.'</option>';
                        
                        $sql1="select E.NOM_ENS as NOM_ENS,E.PRENOM_ENS as PRENOM_ENS , E.CODE_ENS
                        from enseignant E
                        WHERE E.CODE_ENS != '$code_ens_e' ";
                        $result1 = mysqli_query($ma_connexion, $sql1); 
                        while($row1 = mysqli_fetch_array($result1))  
                                {
                              $CODE_ENS=$row1['CODE_ENS'];
                              $NOM_ENS=$row1['NOM_ENS'];
                              $PRENOM_ENS=$row1['PRENOM_ENS'];
                              echo '
                                <option value="'.$CODE_ENS.'">'.$NOM_ENS.' '.$PRENOM_ENS.'</option> ';
                             }
                        echo '
                        </select>
                      </td>
                      
                      <td><button id="" type="button" class="btn btn-default"><i class="fa fa-pencil-square-o fa-lg modifier" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '></i></button></td>
                      <td><button class="btn btn-danger btn_remove" name="'.$i.'" id="mod'.$i.'" value="'.$code_mat.'" type="button" onClick="affiche(this)" '; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo '><i class="fa fa-fa fa-trash fa-lg modifier"></i></button></td>
                      </tr>';

                      $i++;
                    }
                  } 
                       ?>
                        
                       <input type="hidden" name="output" id="output" value="">
                       <input type="hidden" name="output1" id="output1" value="">
                    </tr>
                  </table>
              <?php
				if (!isset($_SESSION['hhh'])) 
					{
						echo '   
				<div class="form-group" >
	            <div class="col-sm-offset-7">
	              <button id="ajouter_mat" type="button" onClick = "affiche_nbr_lignes()" class="btn btn-default btn-circle" style="width: 60px;height: 60px;padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 35px;margin-left: 200px;margin-top: 10px;"><i class="fa fa-plus" style="color:#a09595;"></i></button>
	            </div>
	          </div>' ;
	          			echo '
					  <div class="form-group" >
                    <div class="col-sm-offset-6">
                      <button type="submit" name="submatiere" class="btn btn-success" style="margin-top: 20px;">Enregistrer</button>
                    </div>
                  </div>' ; 	
              			}
					?>
              	</div>
                </form>  
              </div>

              <div class="tab-pane" id="comp">
                
                <?php
                echo ' <form method="POST" > ';
                 echo ' <div id="lescurseurs" > ';
                  echo ' <div class="row"> ' ; 
                
                $iNEWi = 1 ; $jdk = null ; 
                $avc = null ; 

                echo ' <div class="col-md-12" > ';  
                echo '<h3>compétences par rapport à la filiere</h3>';
                echo '<div class="box-body table-responsive no-padding">';
                echo '<table class="table table-hover" border="2">
                  <tr>
                  <th>compétence</th>
                  <th>curseur</th>
                  <th>pourcentage</th>
                  </tr>';
                
                $query = " SELECT c.COMPETNECE ,c.source_comp, cm.taux as avancementcomp , c.CODE_COMP 
                    FROM compmodule cm , competence c 
                    where cm.CODE_COMP = c.CODE_COMP
                    and cm.CODE_MODU = '$idmodule' ";
                
                   
                    $result = mysqli_query($ma_connexion, $query); 
                     
                     
                     while(($row = mysqli_fetch_array($result)) == true )  
                      { 
                    
                    $name = $row['COMPETNECE'] ;
                    $source_comp = $row['source_comp'] ;
                    $avc  = $row['avancementcomp'] ;
                    $codecompid = $row['CODE_COMP'] ; 
                    
                    echo "<tr> <td>$name : $source_comp"  ; 
                    echo "<input type='hidden' value='$codecompid' name='codecompetancehidden$iNEWi' /></td> ";       
                    echo "<td><input id='slidermod$iNEWi' disabled='' name='slidermod$iNEWi' type='range' min='1' max='100' value='".$avc."' enabled='false' "; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo "></td>
                    <td>$avc%</td>

                    </tr>"  ; 
                    
                         $iNEWi = $iNEWi + 1 ;
                    }
                    
                echo '</table>' ; 
                echo ' </div > ';
                echo ' </div > ';

                echo ' <div class="col-md-12"> '; 
                echo '<h3>les compétences par rapport au module</h3>';
                echo '<div class="box-body table-responsive no-padding">';
                echo '<table class="table table-hover" border="2">
                  <tr>
                  <th>compétence</th>
                  <th>curseur</th>
                  <th>pourcentage</th>
                  </tr>';
                
                $query = " SELECT c.COMPETNECE,c.source_comp,cm.taux as avancementcomp , c.CODE_COMP 
                    FROM compmodule1 cm , competence c 
                    where cm.CODE_COMP = c.CODE_COMP
                    and cm.CODE_MODU = '$idmodule'
                    and cm.type = 0";
                
                $result = mysqli_query($ma_connexion, $query); 
         
                     while(($row = mysqli_fetch_array($result)) == true )  
                      { 
                    
                      $name = $row['COMPETNECE'] ;
                      $source_comp = $row['source_comp'] ;
                      $avc  = $row['avancementcomp'] ;
                      $codecompid = $row['CODE_COMP'] ; 
                      
                      echo "<tr> <td>$name : $source_comp"  ; 
                      echo "<input type='hidden' value='$codecompid' name='".$iNEWi."' /></td> ";  
                            
                      echo " <td><input  id='slidermod$iNEWi' name='k".$iNEWi."' Onchange='change1(this.value)' type='range' min='0' max='100' step='1' value='".$avc."' "; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo "/></td>
                      <td><span id='val1'>$avc%</span> </td></tr>"; 
                           $iNEWi = $iNEWi + 1 ;
                    }
                    
                echo '</table>';
                echo ' </div > ';   
                echo ' </div > ';   
                    

                echo ' <div class="col-md-12"> '; 
                echo '<h3>les compétences par rapport au module concérné</h3>';
                echo '<div class="box-body table-responsive no-padding">';
                echo '<table class="table table-hover" border="2">
                  <tr>
                  <th>compétence</th>
                  <th>curseur</th>
                  <th>pourcentage</th>
                  <th>Supprimer</th>
                  </tr>';

                  $query = " SELECT c.COMPETNECE ,c.source_comp, cm.taux as avancementcomp , c.CODE_COMP 
                    FROM compmodule1 cm , competence c 
                    where cm.CODE_COMP = c.CODE_COMP
                    and cm.CODE_MODU = '$idmodule'
                    and cm.type = 1  ;";
                
                   
                    $result = mysqli_query($ma_connexion, $query); 
                     
                     
                     while(($row = mysqli_fetch_array($result)) == true )  
                      { 
                    
                    $name = $row['COMPETNECE'] ;
                    $source_comp = $row['source_comp'] ;
                    $avc  = $row['avancementcomp'] ;
                    $codecompid = $row['CODE_COMP'] ; 
                    
                    echo "<tr> <td>$name : $source_comp"  ; 
                    echo "<input type='hidden' value='$codecompid' name='".$iNEWi."' /></td> ";
                          
                    echo "<td><input id='slidermod$i' name='k".$iNEWi."' Onchange='change2(this)' type='range' min='0' step='1' max='100'  value='".$avc."' "; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo "/><td><span class='k".$iNEWi."'>$avc%</span></td></td>"  ; 
                    
                    
                         $iNEWi = $iNEWi + 1 ;
                    echo "<td>&nbsp;&nbsp<button type='submit' class='btn btn-default example3' id='sup".$iNEWi."' name='sup1' value='".$codecompid."' "; if(isset($_SESSION['hhh'])){ echo 'disabled' ;} echo " ><i class='fa fa-trash fa-lg'></i></button></td></tr> " ;     
                    
                    }
                    echo '</table>';
                    echo ' </div> ';
                    echo ' </div> ';
                    echo '<div style="display: inline"><br></div><div style="display: inline"><br></div>';

                    $jdk = $iNEWi ; 
					echo "<br><br>" ; 

                    if (!isset($_SESSION['hhh'])) 
                    {
                    echo '<center> <button type="button" onclick="myFunction()" class="btn btn-primary"  id="nouvellecomp"> Ajouter une nouvelle competence </button><center>  <br>' ; 
                  }
                    
                    echo '
                    <section class="content" id="hidenewcom" >
        
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede noselect" id="input-35" type="text" readonly="true" value="'.$monm.'" >
                          <label class="input__label input__label--kaede" for="input-35">
                            <span class="input__label-content input__label-content--kaede">Module</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede" id="newcompname" type="text" name="input-4">
                          <label class="input__label input__label--kaede" for="newcompname">
                            <span class="input__label-content input__label-content--kaede">Cometance</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                          <input class="input__field input__field--kaede" id="newcomptaux"  name="exnewcomp" type="number" min="0" max="100">
                          <label class="input__label input__label--kaede" for="newcomptaux">
                            <span class="input__label-content input__label-content--kaede">Taux</span>
                          </label>
                        </span>
                        <span class="input input--kaede">
                        <input type="radio" name="source_exi" value="Académique" id="académique_exi">&nbsp&nbspà base Académique&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <input type="radio" name="source_exi" value="Annonces" id="annonces_exi">&nbsp&nbspà base des annonces<br><br>
                      </span>
                      
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                       

                      <div class="funkyradio">
                        <div class="funkyradio-primary">
                          <input type="checkbox" name="checkbox" id="checkbox1"   />
                          <label for="checkbox1">Confirmer votre choix </label>
                        </div>
                        
                      </div>
                    </div>
                    <br><br>
                    </section>' ;
                    
                    echo '  </div>   </div>' ;
                    if (!isset($_SESSION['hhh'])) 
                    {

                    echo '<br><center><button type="submit" id="enregistrer" name="enregistrer" class="btn btn-danger">Enregistrer</button></center>' ; 
                    echo ' </form > ';
                  }
                ?>
                
                <?php
                
              if(isset($_POST['sup1'])){
              
                $nomcomdele = $_POST['sup1'] ; 
                $query001 = "DELETE FROM `compmodule1` 
                      WHERE CODE_MODU = '$idmodule' 
                      and CODE_COMP = '$nomcomdele'";

                if (mysqli_query($ma_connexion, $query001)) {
                    } else {
                      echo "Error updating record: " . mysqli_error($conn);
                    }   
                $query002 = "DELETE FROM `competence` 
                      WHERE CODE_COMP = $nomcomdele";
                      
                if (mysqli_query($ma_connexion, $query002)) {
                       echo "<meta http-equiv='refresh' content='0'>";  
                    } else {
                      echo "Error updating record: " . mysqli_error($conn);
                    } 
              }
                if(isset($_POST['enregistrer']))
                {
                  if(isset($_POST['checkbox']))
                  {
                    for ($kj = 1; $kj < $jdk; $kj++) 
                      {
                          $txt = $kj ;
                          $txt2 = "k".$kj ; 
                          $idchange = $_POST["$txt"] ; 
                          $valavanc = $_POST["$txt2"] ; 
                          
                          
                          $query = "UPDATE compmodule1
                              set taux = $valavanc
                              where CODE_MODU= '$idmodule'
                              and CODE_COMP = '".$idchange."'";
                        
                        if (mysqli_query($ma_connexion, $query)) {
                        } else {
                          echo "Error updating record: 222 " . mysqli_error($conn);
                        } 
                      }           
      $nomcomp = mysqli_real_escape_string($ma_connexion,$_POST['input-4']);
      $source=$_POST['source_exi'];
      $query0 = "INSERT INTO `competence`(`CODE_DOMAINE`,`COMPETNECE`,`source_comp`) VALUES ('1','$nomcomp','$source')" ;

                    if (mysqli_query($ma_connexion, $query0)) { 
                    } else {
                      echo "Error insert record: " . mysqli_error($conn);
                    }                     

                      $query001 = "SELECT CODE_COMP FROM competence
                              ORDER BY CODE_COMP DESC
                              LIMIT 1 ";  
                      $result = mysqli_query($ma_connexion, $query001);
                      $idcompnew = null ;             
                      if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                          $idcompnew = $row["CODE_COMP"] ; 
                        }
                      } else {
                        echo "0 results";
                      }     
                      $valavanc = $_POST['exnewcomp'] ;
                      $query = "insert into  compmodule1(`CODE_MODU`, `CODE_COMP`, `taux`,`type`) 
                            VALUES('$idmodule',$idcompnew,$valavanc,1)";  
                    if (mysqli_query($ma_connexion, $query)) {
                     echo "<meta http-equiv='refresh' content='0' />";
                    } else {
                      echo "Error updating record: 333" . mysqli_error($ma_connexion);
                    }
                  }
                else{
            for ($kj = 1; $kj < $jdk; $kj++) 
            {
              $txt = $kj ;
              $txt2 = "k".$kj ; 
              $idchange = $_POST["$txt"] ; 
              $valavanc = $_POST["$txt2"] ; 
              $query = "UPDATE compmodule1
                  set taux = $valavanc
                  where CODE_MODU= '$idmodule'
                  and CODE_COMP = '".$idchange."'";
                        
            if (mysqli_query($ma_connexion, $query)) {
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            } 
          }
          $comptertest = 0  ; 
          $tabhelp1 = array();
          $tabhelp2 = array();
          $savecodecomp = array();
          
          $query = "  SELECT COUNT(cm.CODE_MODU) as nombrasavoir
                FROM compmodule1 cm , module mo 
                WHERE cm.CODE_MODU = mo.CODE_MODU
                and mo.ID_SEMSTRE = '$idsemestre'
                          GROUP BY cm.CODE_COMP"; 
          $result = mysqli_query($ma_connexion, $query); 
           while(($row = mysqli_fetch_array($result)) == true )  
                { 
              $tabhelp1[]  = $row['nombrasavoir'] ;
              $comptertest++ ;  
              }
          $query = "  SELECT  cm.CODE_COMP , SUM(cm.taux)    as sommeasavoir                                  
                FROM compmodule1 cm , module mo 
                WHERE cm.CODE_MODU = mo.CODE_MODU
                and mo.ID_SEMSTRE = '$idsemestre'
                          GROUP BY cm.CODE_COMP"; 

      
          $result = mysqli_query($ma_connexion, $query); 
           while(($row = mysqli_fetch_array($result)) == true )  
                { 
              
              
                $tabhelp2[]  = $row['sommeasavoir'] ;
                $savecodecomp[]  = $row['CODE_COMP'] ;
                  
                }
           
           print_r($tabhelp2);
           print_r($tabhelp1);

          for($bn = 0; $bn <= $comptertest; $bn++) {
            
            $vaornew = $tabhelp2[$bn] / (100 * $tabhelp1[$bn]) * 100 ; 
            $query = "UPDATE compsemestre
            set taux = $vaornew
            where compsemestre.ID_SEMSTRE = '$idsemestre' 
            and compsemestre.CODE_COMP = $savecodecomp[$bn] ; " ; 
            
            if (mysqli_query($ma_connexion, $query)) {
                              
            } else {
              echo "Error updating record: " . $bn;
            }
         
          }
          echo "<meta http-equiv='refresh' content='0'>";
        } 
      }

      ?>
                
                
                <script>
                  $("#hidenewcom").hide();
                  function myFunction() {
                    $("#hidenewcom").show();
                  }
                </script>



      
              </div>


          </div>
              <!-- /.tab-pane -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->


    </div>
    </div>
    </div>
    </div>    
    </div></form>     
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
<script type="text/javascript">
	function change1(obj)
     { 
         	var a=obj;
         	$('#val1').text(a+'%');
      }
    function change2(obj)
     { 
         	var a=$(obj).val();
         	var b=$(obj).attr('name');
         	$('.'+b).text(a+'%');
      }
</script>



<script>
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});
</script>
<script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
});
</script>



<?php

$indError = 0 ; 
if(isset($_POST['submit1']))
{
	
	
	$intitule=mysqli_real_escape_string($ma_connexion, $_POST['intituleinput']) ;
	$date1 = ''; 
	$date2 = '';
	if(isset($_POST['Da'])) 
		$date1 = mysqli_real_escape_string($ma_connexion, $_POST['Da']) ;
	if(isset($_POST['Dfa'])) 
		$date2 = mysqli_real_escape_string($ma_connexion, $_POST['Dfa']) ; 
	
	$diplome = mysqli_real_escape_string($ma_connexion,$_POST['diplomeinput']) ;
	$specialite = '' ; 
	if(isset($_POST['specialiteinout']))
		$specialite = mysqli_real_escape_string($ma_connexion,$_POST['specialiteinout']) ;	
    $departementInp = $_POST['departementInput'];
	
	
	 $sql = " UPDATE `filiere` 
		SET `NOM_FIL`= '$intitule' ,
		`NATURE_DIPLOME`='$diplome',
		`SPICIALITE_DIPLOME`='$specialite',
		`Date_Debut`= '$date1',
		`Date_fin`=  '$date2',
		`CODE_DEPT`=  '$departementInp'
		WHERE `CODE_FIL` = '$idf' 	";
		
		if (mysqli_query($ma_connexion, $sql)) {
		
		} else {
			// echo "Error updating record: " . mysqli_error($ma_connexion);
			$indError = 1 ; 
		}

	
	

	
	for ($i = 0 ; $i < $ind1 ; $i++) 												
	{
		$txt = "o".$i ;
		$txt2 = "optioninput".$i ; 
		
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
		$idchange = $_POST["$txt"] ; 
		$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt2"])  ; 
	
			$sql = " UPDATE option_filiere
			set OPTION_FIL = '$valuechange' 
			where CODE_OPTION_FIL  = '$idchange'  ; ";


			if (mysqli_query($ma_connexion, $sql)) {
		
			} else {
				// echo "Error updating record: " . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
	
	}

	
	for ($i = 0 ; $i < $ind2 ; $i++) 												
	{
		$txt = "d".$i ;
		$txt2 = "disciplineinput".$i ;
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{		
			$idchange = $_POST["$txt"] ; 
			$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt2"])   ; 
	
			$sql = " UPDATE decipline_filiere
			set decipline_FIL = '$valuechange' 
			where CODE_decipline_FIL  = '$idchange'  ; ";


			if (mysqli_query($ma_connexion, $sql)) {
		
			} else {
				// echo "Error updating record: " . mysqli_error($ma_connexion);
				$indError = 1 ; 
			}
		}
	
	}
	
	for ($ii = 2 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["new".$ii]))
		{
						
				$txt = "new".$ii ;		
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt"])  ; 
				
					
					$sql = " INSERT INTO `option_filiere`(`CODE_FIL`, `OPTION_FIL`) VALUES ('$idf','$valuechange') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ;
					}

		}
	}
	
	for ($ii = 2 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["newd".$ii]))
		{
						
				$txt = "newd".$ii ;		
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["$txt"])  ; 
				
					
					$sql = " INSERT INTO `decipline_filiere`(`CODE_FIL`, `decipline_FIL`) VALUES ('$idf','$valuechange') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						// echo "Error updating record: " . mysqli_error($ma_connexion);
						$indError = 1 ;
					}

		}
	}
	
	
	foreach ($_POST['motcle'] as $selectedOption)
	{
		
		
		$sql = " INSERT INTO `mot_cle`(`NOM_MOTCLE`) VALUES ('$selectedOption') ; "; 
		
		if (mysqli_query($ma_connexion, $sql)) {
			$last_id = mysqli_insert_id($ma_connexion);
			
			$sql2 = " INSERT INTO `filiere_motCles`(`CODE_FIL`, `CODE_MOTCLE`) VALUES ('$idf','$last_id') ; "; 
			
			if (mysqli_query($ma_connexion, $sql2)) {
			
			} else {
				
			}
			
		
		} else {
			
			$SQLADD="SELECT `CODE_MOTCLE` FROM `mot_cle` WHERE `NOM_MOTCLE` = '$selectedOption'  ";
			$queryADD=mysqli_query($ma_connexion,$SQLADD);
			while($row=mysqli_fetch_assoc($queryADD))
			{
				$last_id = $row['CODE_MOTCLE'];
				
				$sql2 = " INSERT INTO `filiere_motCles`(`CODE_FIL`, `CODE_MOTCLE`) VALUES ('$idf','$last_id') ; "; 
				
				if (mysqli_query($ma_connexion, $sql2)) {
				
				} else {
					
				}
			
			}
			
		}
		
	}
	if ( $indError == 0 )
	{
		echo "<meta http-equiv='refresh' content='0' />";
	}
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer des informations deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}
}



if(isset($_POST['submit2']))
{

	
for ($ii = 0 ; $ii < $inddebouche ; $ii++) 												
	{
		$txt = "deb".$ii ;
		$txt2 = "debouvheinput".$ii ; 
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
			
			$idchange = $_POST["$txt"] ; 
			$valuechange = $_POST["$txt2"] ; 
			$domainechange = $_POST["DomaineDeboucheInput".$ii] ; 
			
			$sql = " UPDATE `debouche_formation` SET `DEBOUCHE_FOR`= '".mysqli_real_escape_string($ma_connexion,$valuechange)."',
			 CODE_DOMAINE = $domainechange WHERE `CODE_DEBOUCHE_FOR` = $idchange "; 
					
			if (mysqli_query($ma_connexion, $sql)) {
				
			} else {
				$indError = 1 ; 
			}
		}
		
		
		if(isset($_POST["deletedebouche".$ii]))
		{
				
						
				$valuechange = $_POST["deletedebouche".$ii] ;  
				
				
					
					$sql = " DELETE FROM `formation_debouche` WHERE CODE_DEBOUCHE_FOR =  $valuechange and CODE_FIL = '$idf' ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						$indError = 1 ; 
					}

		}
	}
	

$idjusqueDEB = $_POST["valeurindiceDebouche"];
for ($ii = 1 ; $ii < $idjusqueDEB; $ii++) 												
	{
		if(isset($_POST["newdebinput".$ii]))
		{
						
				$txt = "newdebinput".$ii ;		
				$valuechange = $_POST["$txt"]  ; 
				$domainechange = $_POST["lasSaveDomaine".$ii]  ; 
				$last_id = null ; 
					
					$sql = " INSERT INTO `debouche_formation`(`DEBOUCHE_FOR`,`CODE_DOMAINE`) VALUES ('".mysqli_real_escape_string($ma_connexion,$valuechange)."',$domainechange) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
				
					} else {
						$indError = 1 ; 
					}
					
					$sql = " INSERT INTO `formation_debouche`(`CODE_FIL`, `CODE_DEBOUCHE_FOR`) VALUES ('$idf',$last_id) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						$indError = 1 ; 
					}

		}
	}
	
$idjusqueDEBwith = $_POST["valeurindiceDebouchewith"];
for ($ii = 100 ; $ii < $idjusqueDEBwith ; $ii++) 												
	{
		if(isset($_POST["newdebinput".$ii]))
		{
						
				$txt = "newdebinput".$ii ;		
			
				$txt2 = "lasSave".$ii ;					
				$last_id = $_POST["$txt2"] ; 
				
				
					
					$sql = " INSERT INTO `formation_debouche`(`CODE_FIL`, `CODE_DEBOUCHE_FOR`) VALUES ('$idf',$last_id) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						$indError = 1 ; 
					}

		}
	}
	

	if ( $indError == 0 )
		echo "<meta http-equiv='refresh' content='0' />";
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer un debouche  deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}

}



if(isset($_POST['submit3']))
{
	
for ($ii = 0 ; $ii < $indcompetance ; $ii++) 												
	{
		
		$txt = "comp".$ii ;
		$txt2 = "competanceinput".$ii;
		if ( isset($_POST["$txt"]) && isset($_POST["$txt2"]) )
		{
			$idchange = $_POST["$txt"] ; 
			$valuechange = $_POST["$txt2"] ;
			$domainechange = $_POST["DomaineCopetanceInput".$ii]; 
			
			
			$sql = " UPDATE `competence` SET `COMPETNECE`= '".mysqli_real_escape_string($ma_connexion,$valuechange)."' , 
			CODE_DOMAINE = $domainechange WHERE `CODE_COMP`= $idchange  "; 
					
			if (mysqli_query($ma_connexion, $sql)) {
				
			} else {
				$indError = 1 ; 
			}
		}
		
		if(isset($_POST["deletecompetance".$ii]))
		{
						
				$valuechange = $_POST["deletecompetance".$ii] ;  
				
					$sql = " DELETE FROM `competence` WHERE CODE_COMP =  $valuechange  ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						$indError = 1 ; 
					}
		}
	}
	

$indicejusquaboucleNEW = $_POST["valeurindiceCompetance"] ; 
for ($ii = 1 ; $ii < $indicejusquaboucleNEW ; $ii++) 												
	{
		if(isset($_POST["newcompinput".$ii]) && isset($_POST["lasSaveCMPDomaine".$ii])  )
		{
						
				$domainechange = $_POST["lasSaveCMPDomaine".$ii];	  
				$source_compN = $_POST["newcompsource".$ii];
				$valuechange = mysqli_real_escape_string($ma_connexion,$_POST["newcompinput".$ii]) ; 
				$last_id = null ; 
					
					$sql = "INSERT INTO `competence`(`CODE_DOMAINE`,`COMPETNECE`,`source_comp`) VALUES ($domainechange,'$valuechange','$source_compN')";
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
					} else {
						$indError = 1 ; 
					}
					
					$sql = " INSERT INTO `compfiliere`(`CODE_FIL`, `CODE_COMP`, `taux`) VALUES ('$idf',$last_id,0) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
					} else {
						$indError = 1 ; 
					}
					
					$SQL="SELECT CODE_MAT
							FROM matiere 
							where CODE_MODU in ( SELECT m.CODE_MODU 
												FROM module m 
												WHERE m.CODE_FIL = '$idf' ) ";
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentIDmat = $row["CODE_MAT"] ; 
						
						$sqlaa = " INSERT INTO `compmatiere`(`CODE_MAT`, `CODE_COMP`, `taux`, `type`) VALUES  ($currentIDmat,$last_id,0,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
					
						} else {
							$indError = 1 ; 
						}
					}
					$SQL="SELECT m.CODE_MODU
							FROM module m
							where m.CODE_FIL = '$idf'  ";
							
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentCodeMod= $row["CODE_MODU"] ; 
						
						$sqlaa = " INSERT INTO `compmodule`(`CODE_MODU`, `CODE_COMP`, `taux`) VALUES  ('$currentCodeMod',$last_id,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
					
						} else {
							$indError = 1 ; 
						}	
					}
		}
	}
	
$indicejusquaboucleExixt = $_POST["valeurindiceCompetanceWith"] ; 	
for ($ii = 100 ; $ii < $indicejusquaboucleExixt ; $ii++) 												
	{
		if(isset($_POST["newcompinput".$ii]))
		{
				$txt2 = "lasSaveCMP".$ii;				
				$last_id = $_POST["$txt2"];
					
					
					$sql = " INSERT INTO `compfiliere`(`CODE_FIL`,`CODE_COMP`,`taux`) VALUES ('$idf',$last_id,0) ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$indError = 0;
					} else {
						$indError = 1 ; 
					}
					$SQL="SELECT CODE_MAT
							FROM matiere 
							where CODE_MODU in ( SELECT m.CODE_MODU 
												FROM module m 
												WHERE m.CODE_FIL = '$idf' ) ";
					$query=mysqli_query($ma_connexion,$SQL);
					while($row=mysqli_fetch_assoc($query))
					{
						$currentIDmat = $row["CODE_MAT"] ; 
						
						$sqlaa = " INSERT INTO `compmatiere`(`CODE_MAT`, `CODE_COMP`, `taux`, `type`) VALUES  ($currentIDmat,$last_id,0,0) ; "; 
					
						if (mysqli_query($ma_connexion, $sqlaa)) {
							$indError = 0 ;
						} else {
							// echo "Error updating record: 45 " . mysqli_error($ma_connexion);
							$indError = 1 ; 
						}
					}
		}
	}
	if ( $indError == 0 )
		echo "<meta http-equiv='refresh' content='0' />";
	else
	{
		echo "<script>
						swal(
							'Attention!',
							'Un erreur s\'est produit lors de l\'enregistrement des informations ..!  vouz avez essayer d\'entrer un domaine  deja existant  ',
							'warning'
						  )
						
					</script>" ;
					
			echo "<meta http-equiv='refresh' content='3' />";		
					
	}

}

if(isset($_POST['submit4']))
{
	
	$Objectif=$_POST['objectiformation'];
	$Condition = $_POST['conditionacceprerequis']; 
	$Acces = $_POST['acceepasserelle'];

	 $sql = " UPDATE `filiere` 
		SET `OBJECTIFS_FORMATION`= '".mysqli_real_escape_string($ma_connexion,$Objectif)."' ,
		`CONDITION_D_ACCEES`= '".mysqli_real_escape_string($ma_connexion,$Condition)."',
		`ACCES_PAR_PASSERELLE`= '".mysqli_real_escape_string($ma_connexion,$Acces)."'
		WHERE `CODE_FIL` = '$idf' 	";
		
		if (mysqli_query($ma_connexion, $sql)) {
			
			} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		 
	 echo "<meta http-equiv='refresh' content='0' />";	
}


if(isset($_POST['submit5']))
{
	
	for ($ii = 0 ; $ii < $ideffectif ; $ii++) 												
	{
		$txt = "savepromoinput".$ii ;
		$txt2 = "promoinput".$ii ; 
		$idchange = $_POST["$txt"] ; 
		$valuechange = $_POST["$txt2"] ;
		
		
		$sql = " UPDATE `effectifs` SET `EFFECTIF`= $valuechange WHERE `CODE_EFFECTIF`= $idchange and `CODE_FIL` = '$idf'   "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		
		if(isset($_POST["deleteeffectif".$ii]))
		{
				
						
				$valuechange = $_POST["deleteeffectif".$ii] ;  
				
				
					
					$sql = " DELETE FROM  effectifs where CODE_EFFECTIF =  $valuechange; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
							
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}

		}
		
		
	}
	$promoaddsave = $ideffectif  ; 
	for ($ii = 1 ; $ii < 10 ; $ii++) 												
	{
		if(isset($_POST["promoinputNEW".$ii]))
		{
				$promoaddsave++ ; 			
				$txt = "promoinputNEW".$ii ;		
				$valuechange = $_POST["$txt"] ; 
				$last_id = null ; 
				$anneepromo = $promoaddsave ; 
					
					$sql = " INSERT INTO `effectifs`(`CODE_FIL`, `EFFECTIF`, `promotion`, `ID_ANNE`) VALUES ('$idf',$valuechange,$promoaddsave,'$anneepromo') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						$last_id = mysqli_insert_id($ma_connexion);
				
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}		
		}
	}										
	 echo "<meta http-equiv='refresh' content='0' />";	
}


if(isset($_POST['submit6']))
{
	
for ($ii = 0 ; $ii < $indmodule ; $ii++) 										
	{
		$txt = "savemylifmodule".$ii ;

		$txt2add1 = "semestreinput".$ii ; 
		$txt2add2 = "moduleinput".$ii ; 
		$txt2add3 = "volumeinput".$ii ; 
		
		if (isset($_POST["$txt"]) && isset($_POST["$txt2add1"]) && isset($_POST["$txt2add2"]) && isset($_POST["$txt2add3"])  && isset($_POST["cordonateurInput".$ii]) ) 
		{
		$idchange = $_POST["$txt"] ; 
		
		$semestrechange = $_POST["$txt2add1"] ;
		$modulechange = $_POST["$txt2add2"] ;
		$volumechange = $_POST["$txt2add3"] ;

		$codeCordChange = $_POST["cordonateurInput".$ii] ;
		
		$sql = " UPDATE `module` SET `CODE_COR_MODU` = $codeCordChange ,`ID_SEMSTRE`= '$semestrechange', NOM_MODU = '".mysqli_real_escape_string($ma_connexion,$modulechange)."' , VOLUME_HORAIRE_MODU = $volumechange  WHERE `CODE_MODU`= '$idchange'  "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		
		}
		
		if(isset($_POST["deletemodule".$ii]))
		{	
				$valuechange = $_POST["deletemodule".$ii] ;  

					$sql = " DELETE FROM `module` WHERE CODE_MODU =  '$valuechange'  "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						
					} else {
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}		
		}
	}
	

	$idjusque = $_POST["valeurindiceModule"];
for ($ii = 1 ; $ii < $idjusque ; $ii++) 												
	{
		echo $ii ;
		
		if(isset($_POST["newsestreinput".$ii]))
		{
			$id_coordMODULEchange = null ; 
			
			$id_coordMODULEchange = $_POST["idExisistCordonateur".$ii] ;

				$bbbbb = $idf."%" ; 
				$query001 = "SELECT COUNT(*) as nbasavoir
								FROM module
								WHERE CODE_MODU LIKE '$bbbbb'";	
								
				$result = mysqli_query($ma_connexion, $query001);
				
				$idmodnew = null ; 						
				if (mysqli_num_rows($result) > 0) {
					
					while($row = mysqli_fetch_assoc($result)) {
						$idmodnew = $row["nbasavoir"] ; 
						$idmodnew++; 
					}
				} else {
					echo "0 results";
				} 	
				
				$residadd = $idf."MD".$idmodnew ; 
					
				$newsem = $_POST["newsestreinput".$ii] ; 
				$newmod = $_POST["newmoduleinput".$ii] ; 
				$newvol = $_POST["newvolumeinput".$ii] ; 
					
					$sql = " INSERT INTO `module`(`CODE_MODU`, `CODE_COR_MODU`, `CODE_FIL`, `ID_SEMSTRE`, `NOM_MODU`, `VOLUME_HORAIRE_MODU`, `VOLUME_COURS_MODU`, `VOLUME_TD_MODU`, `VOLUME_TP_MODU`, `VOLUME_AP_MODU`, `Evaluation_connaissances`, `PENDERATION`) 
								VALUES ('$residadd',$id_coordMODULEchange,'$idf','$newsem','".mysqli_real_escape_string($ma_connexion,$newmod)."','$newvol','0','0','0','0','0','0') ; "; 
				
					if (mysqli_query($ma_connexion, $sql)) {
						echo "bb <br>" ;
					} else {
						
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
		}
	}
	echo "<meta http-equiv='refresh' content='0' />";	
}



if(isset($_POST['submit7']))
{
for ($ii = 0 ; $ii < $idDiplomes ; $ii++) 										
	{
		$txt = "saveDiplomeinputprereq".$ii ;
		$txt2 = "DiplomeInputprerequis".$ii ; 


		
		if (isset($_POST["$txt"])  && isset($_POST["$txt2"]) ) 
		{
		$idchange = $_POST["$txt"] ; 
		$idchange2 = $_POST["$txt2"] ; 
		

		
		
		$sql = " UPDATE `filiere_diplomes` SET `CODE_DIPLOME` = $idchange   WHERE `CODE_FIL`= '$idf'  "; 
				
		if (mysqli_query($ma_connexion, $sql)) {
			
		} else {
			echo "Error updating record: " . mysqli_error($ma_connexion);
		}
		
		}
	}
	

	$idjusque = $_POST["indjusquaDipl"];
for ($ii = 100 ; $ii < $idjusque ; $ii++) 												
	{
		
		if(isset($_POST["DiplomeInputprerequisADD".$ii]))
		{
			
			
			$diplome = $_POST["DiplomeInputprerequisADD".$ii] ;
			
			
				
				$sql = "INSERT INTO `filiere_diplomes`(`CODE_DIPLOME`, `CODE_FIL`) VALUES ($diplome,'$idf')";
				
					if (mysqli_query($ma_connexion, $sql)) {
				
					} else {
						
						echo "Error updating record: " . mysqli_error($ma_connexion);
					}
		}
	}
	
	echo "<meta http-equiv='refresh' content='0' />";	
}

?>

<?php
if(isset($_POST['submatiere']))
{
  for($k=0;$k<=$nb;$k++)
  {
    
    if(isset($_POST["n".$k]) || isset($_POST["v".$k]))
    {
    $id=$_POST[$k];
    $nom=$_POST["n".$k];
    $v_h=$_POST["v".$k];
    $code_ens=$_POST["e".$k];

    $sql="UPDATE matiere SET `NOM_MAT` ='".mysqli_real_escape_string($ma_connexion,$nom)."' , `VOLUME_HORAIRE_MAT` =$v_h WHERE CODE_MAT =$id ";
    $result = mysqli_query($ma_connexion, $sql); 
    }

    $sql_te="select 1 from intervient where CODE_MAT= $id ";
    if (mysqli_query($ma_connexion,$sql_te))
      $result6 = mysqli_query($ma_connexion,$sql_te);
        if(mysqli_num_rows($result6) > 0)
        {
    $sql1="UPDATE intervient SET CODE_ENS='$code_ens' where CODE_MAT=$id ";
    $result1 = mysqli_query($ma_connexion,$sql1);
    }
    else 
    {
    $sql2="INSERT INTO `intervient`(`CODE_ENS`,`CODE_MAT`) VALUES ($code_ens,$id)";
    $result2 = mysqli_query($ma_connexion,$sql2);   
    }

    
  }

  $nb1=$_POST['output'];
  for($j=0;$j<$nb1;$j++)
  {
    if(isset($_POST["ne".$j]))
    {

      $id_ens = null ; 
      $id_mat = null ; 
       if(isset($_POST["idExisistCordonateur".$j]))
        {
        $id_ens=$_POST["idExisistCordonateur".$j];
        }
        else
        {
            $code_DEPT_ADD_ENS = $_POST["NEW_matiere_Corodonateur_Dept_rec".$j] ;
            $pseudo_ADD_ENS = $_POST["newEnsNom".$j] ;
            $passsword_ADD_ENS = $_POST["newEnsPrenom".$j] ;
            $specialite_ADD_ENS = $_POST["NEW_matiere_Corodonateur_specialite_rec".$j] ;
            $grade_ADD_ENS = $_POST["NEW_matiere_Corodonateur_grade_rec".$j] ;

            $sql = " INSERT INTO `enseignant`( `CODE_DEPT`, `PSEUDO`, `PASSWORD`, `NOM_ENS`, `PRENOM_ENS`, `SPECIALTE_ENS`, `GRADE_ENS`)
                VALUES ($code_DEPT_ADD_ENS,'$pseudo_ADD_ENS','$passsword_ADD_ENS','$pseudo_ADD_ENS','$passsword_ADD_ENS','$specialite_ADD_ENS','$grade_ADD_ENS');";
        
          if (mysqli_query($ma_connexion, $sql)) {
            $id_ens = mysqli_insert_id($ma_connexion);
        
          } else {
            echo "Error updating record: " . mysqli_error($ma_connexion);
          }

        }

    

    $nom1=$_POST["ne".$j];
    $v_h1=$_POST["ve".$j];
    if(($nom1!=null)  && ($v_h1!=null))
    {
    $sql1="INSERT INTO `matiere`(`CODE_MODU`, `NOM_MAT`, `VOLUME_HORAIRE_MAT`) VALUES ('$idf','".mysqli_real_escape_string($ma_connexion,$nom1)."',$v_h1)";
    if (mysqli_query($ma_connexion, $sql1)) {
            $id_mat = mysqli_insert_id($ma_connexion);
        
          } else {
            echo "Error updating record: " . mysqli_error($ma_connexion);
          }


    $sql2="INSERT INTO `intervient`(`CODE_ENS`,`CODE_MAT`) VALUES ($id_ens,$id_mat)";
    $result2 = mysqli_query($ma_connexion, $sql2);        
    }
    }

  }

  if(isset($_POST['output1']))
  {
    $outp=$_POST['output1'];
    $outtes = explode(" ", $outp);
    foreach ($outtes as  $value) 
    {
      $sql="DELETE FROM `matiere` WHERE CODE_MAT='$value' ";
      $result = mysqli_query($ma_connexion, $sql); 
    }
  }
echo "<meta http-equiv='refresh' content='0'/>";

}

if(isset($_POST['submamodu']))
{
  for($k=0;$k<=$nb1;$k++)
  {
    if(isset($_POST["o".$k]))
    {
    $id_obj=$_POST[$k];
    $nom_obj=$_POST["o".$k];
    $sql="UPDATE objectifs SET  `OBJECTIFS_MODU` ='".mysqli_real_escape_string($ma_connexion,$nom_obj)."' WHERE `CODE_OBJECTIF_MODU` =$id_obj ";
    $result = mysqli_query($ma_connexion, $sql);
    }
  }

  $nb2=$_POST['output1_obj'];
  for($j=0;$j<$nb2;$j++)
  {
    if(isset($_POST["ob".$j]))
    { 

    $test=null;
    $nom1=$_POST["ob".$j];
    $id_obj = null;


    if(isset($_POST["idExisistObjectifs".$j]))
    {
    $id_obj=$_POST["idExisistObjectifs".$j];
    }

    else
    {
    if(($nom1!=null))
    {
    $sql="INSERT INTO `objectifs`(`OBJECTIFS_MODU`) VALUES ('".mysqli_real_escape_string($ma_connexion,$nom1)."')";
    $result = mysqli_query($ma_connexion, $sql); 
    $sql1="select CODE_OBJECTIF_MODU from objectifs where OBJECTIFS_MODU='".mysqli_real_escape_string($ma_connexion,$nom1)."' ";
    $result = mysqli_query($ma_connexion, $sql1); 
    while ($ligne1 = mysqli_fetch_array($result))
    {
    $test=$ligne1['CODE_OBJECTIF_MODU'];
    }
    $sql2="INSERT INTO `objectifs_modules` (`CODE_MODU` , `CODE_OBJECTIF_MODU`) VALUES ('$idf',$test)";
    $result1 = mysqli_query($ma_connexion, $sql2); 
    }
    }

    $sql2="INSERT INTO `objectifs_modules` (`CODE_MODU` , `CODE_OBJECTIF_MODU`) VALUES ('$idf',$id_obj)";
    $result1 = mysqli_query($ma_connexion, $sql2);  

    }

    }


  if(isset($_POST['output2_obj']))
  {
    $outp=$_POST['output2_obj'];
    $outtes = explode(" ", $outp);
    foreach ($outtes as  $value) 
    {
      $sql="DELETE FROM `objectifs_modules` WHERE CODE_OBJECTIF_MODU=$value ";
      $result = mysqli_query($ma_connexion, $sql); 
    }
  }

echo "<meta http-equiv='refresh' content='0' />";

}

if(isset($_POST['submapre']))
{
  for($k=0;$k<=$nb2;$k++)
  {
  if(isset($_POST["p".$k]))
  { 
    $id_pre=$_POST[$k];
    $nom_pre=$_POST["p".$k];
    $sql="UPDATE prerequis SET  `prerequis` ='".mysqli_real_escape_string($ma_connexion,$nom_pre)."' WHERE `code_pre` =$id_pre ";
    $result = mysqli_query($ma_connexion, $sql);
  }
  }

  $nb3=$_POST['output1_pre'];
  for($j=0;$j<$nb3;$j++)
  {
    if(isset($_POST["pre".$j]))
    { 

    $test=null;
    $id_pre = null;
    $nom1=$_POST["pre".$j];


    if(isset($_POST["idExisistPrerequis".$j]))
    {
        $id_pre=$_POST["idExisistPrerequis".$j];
    }

    else
    {
    if(($nom1!=null))
    {
    $sql="INSERT INTO `prerequis`(`prerequis`,`CODE_DOMAINE`) VALUES ('".mysqli_real_escape_string($ma_connexion,$nom1)."',1)";
    $result = mysqli_query($ma_connexion, $sql); 
    $sql1="select code_pre from prerequis where prerequis='".mysqli_real_escape_string($ma_connexion,$nom1)."' ";
    $result = mysqli_query($ma_connexion, $sql1); 
    while ($ligne1 = mysqli_fetch_array($result))
    {
    $test=$ligne1['code_pre'];
    }
    $sql2="INSERT INTO `module_prerequis` (`CODE_MODU` , `code_pre`) VALUES ('$idf',$test)";
    $result1 = mysqli_query($ma_connexion, $sql2); 
    }
    }

    $sql2="INSERT INTO `module_prerequis` (`CODE_MODU` , `code_pre`) VALUES ('$idf',$id_pre)";
    $result1 = mysqli_query($ma_connexion, $sql2); 

    } 

  }


  if(isset($_POST['output2_pre']))
  {
    $outp=$_POST['output2_pre'];
    $outtes = explode(" ", $outp);
    foreach ($outtes as  $value) 
    {
      $sql="DELETE FROM `module_prerequis` WHERE code_pre=$value ";
      $result = mysqli_query($ma_connexion, $sql); 
    }
  }


echo "<meta http-equiv='refresh' content='0' />";
}

if(isset($_POST['submdida']))
{
  for($k=0;$k<=$nb4;$k++)
  {
    if(isset($_POST["d".$k]))
    {
    $id_dida=$_POST[$k];
    $nom_dida=$_POST["d".$k];
    $sql="UPDATE didactiques SET  `DIDACTIQUE_MODU` ='".mysqli_real_escape_string($ma_connexion,$nom_dida)."' WHERE `CODE_DIDACTIQUE_MODU` =$id_dida ";
    $result = mysqli_query($ma_connexion, $sql);
    }
  }


  $nb7=$_POST['output1_dida'];
  for($j=0;$j<$nb7;$j++)
  {
    if(isset($_POST["dida".$j]))
    { 

    $test=null;
    $id_dida = null;
    $nom1=$_POST["dida".$j];


    if(isset($_POST["idExisistDidactiques".$j]))
    {
        $id_dida=$_POST["idExisistDidactiques".$j];
    }

    else
    {
    if(($nom1!=null))
    {
    $sql="INSERT INTO `didactiques`(`DIDACTIQUE_MODU`) VALUES ('".mysqli_real_escape_string($ma_connexion,$nom1)."')";
    $result = mysqli_query($ma_connexion, $sql); 
    $sql1="select CODE_DIDACTIQUE_MODU from didactiques where DIDACTIQUE_MODU='".mysqli_real_escape_string($ma_connexion,$nom1)."' ";
    $result = mysqli_query($ma_connexion, $sql1); 
    while ($ligne1 = mysqli_fetch_array($result))
    {
    $test=$ligne1['CODE_DIDACTIQUE_MODU'];
    }
    $sql2="INSERT INTO `module_didactique` (`CODE_MODU` , `CODE_DIDACTIQUE_MODU`) VALUES ('$idf',$test)";
    $result1 = mysqli_query($ma_connexion, $sql2); 
    }
    }

    $sql2="INSERT INTO `module_didactique` (`CODE_MODU` , `CODE_DIDACTIQUE_MODU`) VALUES ('$idf',$id_dida)";
    $result1 = mysqli_query($ma_connexion, $sql2); 

    } 

  }




  if(isset($_POST['output2_dida']))
  {
    $outp=$_POST['output2_dida'];
    $outtes = explode(" ", $outp);
    foreach ($outtes as  $value) 
    {
      $sql="DELETE FROM `module_didactique` WHERE CODE_DIDACTIQUE_MODU=$value ";
      $result = mysqli_query($ma_connexion, $sql); 
    }
  }


echo "<meta http-equiv='refresh' content='0' />";
}


?>


<script>
  $(document).ready(function(event){  
        
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();
      }); 
       });

  $(document).ready(function(event){  
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_obj'+button_id+'').remove();
      }); 
       });

  $(document).ready(function(event){
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_pre'+button_id+'').remove();
      }); 
       });

  $(document).ready(function(event){ 
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_dida'+button_id+'').remove();
      }); 
       });

</script>

<script type="text/javascript">
  
function affiche(objButton)
{
  var testin = objButton.value;
  $(document).on('click','.btn_remove',function()
  {     
  $('#row'+testin).remove();
  });
  var out=document.getElementById('output1').value;
  document.getElementById('output1').value = out+" "+testin;

}
</script>
<script type="text/javascript">
  


function affiche_obj(objButton)
{
  var testin = objButton.value;
  $(document).on('click','.btn_remove',function()
  {     
  $('#row_obj'+testin).remove();
  });
  var out=document.getElementById('output2_obj').value;
  document.getElementById('output2_obj').value = out+" "+testin;

}
</script>
<script type="text/javascript">


function affiche_pre(objButton)
{
  var testin = objButton.value;
  $(document).on('click','.btn_remove',function()
  {     
  $('#row_pre'+testin).remove();
  });
  var out=document.getElementById('output2_pre').value;
  document.getElementById('output2_pre').value = out+" "+testin;

}


</script>
<script type="text/javascript">
function affiche_dida(objButton)
{
  var testin = objButton.value;
  $(document).on('click','.btn_remove',function()
  {     
  $('#row_di'+testin).remove();
  });
  var out=document.getElementById('output2_dida').value;
  document.getElementById('output2_dida').value = out+" "+testin;

}


</script>

<script>
    $(document).ready(function(){
      $("#ajouter_obj").click(function(){
        $("#ajouterobjectif_test").modal("show");
      });
    });
    $(document).ready(function(){
      $("#ajouter_pre").click(function(){
        $("#ajouterprerequis_test").modal("show");
      });
    });
    $(document).ready(function(){
      $("#ajouter_dida").click(function(){
        $("#ajouterdidactiques_test").modal("show");
      });
    });
    $(document).ready(function(){
      $("#ajouter_mat").click(function(){
        $("#ajoutermatiere_test").modal("show");
      });
    });

</script>

<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/sweetalert2.min.js"></script>

<script>
$("#NEW_matiere_Corodonateur_etablissement").change(function()
  {
    var id=$(this).val();
    var dataString = 'id='+ id;
    $.ajax
    ({
      type: "POST",
      url: "../LES-GET/getDepartement.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        $("#NEW_matiere_Corodonateur_Dept").html(html);
      }
    });
  });
</script>

</body>
</html>
