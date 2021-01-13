<?php
	include '../connexion.php';

    if (isset($_POST['idsemestre']))
    {

        $idsemestre=$_POST['idsemestre'];
        $idfil=$_POST['idfil'];
		
        $sql= " SELECT NOM_MODU , VOLUME_HORAIRE_MODU FROM module where ID_SEMSTRE = '$idsemestre' and CODE_FIL ='$idfil' ";
                    
                    
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo 'Aucunes matiere pour ce module ';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                // echo $row['NOM_MODU'] ."". $row['VOLUME_HORAIRE_MODU'] ." H\\n" ;
                echo $row['NOM_MODU']."   <b>".$row['VOLUME_HORAIRE_MODU']."H </b> <br/>" ;

            }
        }
    }
	
	if (isset($_POST['idmodule']))
    {

        $idmodule=mysqli_real_escape_string($ma_connexion,$_POST['idmodule']) ;
        $idfil=$_POST['idfil'];
		
        $sql= " SELECT m.NOM_MAT , m.VOLUME_HORAIRE_MAT
					FROM matiere m , module mo 
					WHERE m.CODE_MODU = mo.CODE_MODU
					and mo.NOM_MODU = '$idmodule'
					and mo.CODE_FIL =  '$idfil' ";
                    
                    
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo 'Aucunes matiere pour ce module ';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                // echo $row['NOM_MODU'] ."". $row['VOLUME_HORAIRE_MODU'] ." H\\n" ;
                echo $row['NOM_MAT']."   <b>".$row['VOLUME_HORAIRE_MAT']. "H </b><br/>" ;

            }
        }
    }
	if (isset($_POST['idtypecour']))
    {

        $idtypecour=$_POST['idtypecour'];
        $idfil=$_POST['idfil'];
		$idsemestre=$_POST['idsemestre'];
		
        $sql= " SELECT m.NOM_MAT , m.VOLUME_HORAIRE_MAT
					FROM matiere m , module mo 
					WHERE m.CODE_MODU = mo.CODE_MODU
					and m.type_cour = $idtypecour
					and mo.CODE_FIL =  '$idfil' 
					AND ID_SEMSTRE = '$idsemestre'";
                    
                    
        $query=mysqli_query($ma_connexion,$sql) ;
        if(mysqli_num_rows($query) == 0)
        {
            echo 'Aucunes matiere pour ce module ';
        }else{
            while($row = mysqli_fetch_assoc($query))
            {
                // echo $row['NOM_MODU'] ."". $row['VOLUME_HORAIRE_MODU'] ." H\\n" ;
                echo $row['NOM_MAT']."   <b>".$row['VOLUME_HORAIRE_MAT']. "H </b><br/>" ;

            }
        }
    }


?>