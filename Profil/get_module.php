<?php
$connect = mysqli_connect("localhost", "root", "", "pfe");  
mysqli_set_charset($connect,"utf8");

    if (isset($_POST['id']))
    {
        $id=$_POST['id'];
        $query = "select * from module WHERE CODE_FIL ='$id' ";

              $result = mysqli_query($connect, $query); 
	if(mysqli_num_rows($result) == 0)
    {
        echo '<option>Aucun resultat</ption>';
	}
              elseif(mysqli_num_rows($result) > 0)  
                {  
               while($row = mysqli_fetch_array($result))  
                  { 
                ?>
                <option value="<?php echo $row['CODE_MODU']; ?>" selected > <?php echo $row['NOM_MODU']; ?></option>
                <?php
                }
              }
    }else{

        echo '<option>Error</ption>';
    }

	
?>