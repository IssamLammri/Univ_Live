<meta charset="UTF-8">
<?php
include '../connexion.php';



if(isset($_POST["nomMat"]))  
{


  $nomMatyy = $_POST['nomMatyy'];


              $query = "select M.NOM_MAT AS NOM_MAT,M.VOLUME_HORAIRE_MAT,M.VOLUME_COURS_MAT,M.VOLUME_TD_MAT,M.VOLUME_TP_MAT, MO.NOM_MODU AS NOM_MODU , F.NOM_FIL AS NOM_FIL , M.CODE_MAT AS CODE_MAT , D.NOM_DEPT as NOM_DEPT,Et.NOM_ETA as NOM_ETA
              from matiere M , module MO , filiere F,Departement D,etablissement Et
              where M.CODE_MODU=MO.CODE_MODU
              AND MO.CODE_FIL=F.CODE_FIL
              AND F.CODE_DEPT=D.CODE_DEPT
              AND D.CODE_ETA=Et.CODE_ETA
              AND M.CODE_MAT = $nomMatyy " ;
              $result = mysqli_query($ma_connexion,$query); 
              if(mysqli_num_rows($result) > 0)  
                {  
                $i = 0;
              while($row = mysqli_fetch_array($result))  
                {
       echo 
      ' <center>
        <label><input class="form-control" type="text" style="width: 624px;height: 34px;padding-left: 200px;" value="Matiere :'.ucfirst(strtolower($row['NOM_MAT'])).'" readonly></label><br> <br> 

        <button id="moo'.$i.'" type="button" value="'.ucfirst(strtolower($row['CODE_MAT'])).'" name="tl2" class="btn btn-default" onClick="afficher2(this)"><i class="fa fa-plus-square"></i>Plus de details :</button> 

         <button id="'.$i.'" type="submit" value="'.ucfirst(strtolower($row['NOM_MAT'])).'" name ="tl1" class="btn btn-default" ><i class=" fa fa-cloud-download"></i>Télécharger</button>

         <button id="mod'.$i.'" type="button" value="'.ucfirst(strtolower($row['CODE_MAT'])).'" name="tl2" class="btn btn-default" onClick="afficher1(this)"><i class="fa fa-plus-square"></i>Autoriser</button>

         <button id="'.$i.'" type="submit" value="'.ucfirst(strtolower($row['CODE_MAT'])).'" name ="tl3" class="btn btn-default"><i class="fa fa-plus-square"></i>Sauvegarder Matiere</button></center>';
                  $i++;
                }
              }

        echo '
			  <script>

        function afficher1(objButton) 
          { 
    var testin = objButton.value;
    document.sform1.output.value=testin 
    $("#myModal1").modal();
          } 

    function afficher2(objButton) 
    { 
         var testin = objButton.value; 
          var dataString = "testin="+ testin;
          $.ajax
          ({
            type: "POST",
            url: "../enseignant/telepdf.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#testtt").html(html);
             
            }
          });
           $("#myModal2").modal();
      } 

		</script>
			  ';
			  

}

?>


			  
			  