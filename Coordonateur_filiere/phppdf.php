<?php 


include '../connexion.php';


if(isset($_POST['exporter']))
{
	include ("FPDF/fpdf.php");
   $pdf=new FPDF();
   $pdf->SetMargins(20,20,20);
   $pdf->SetTextColor(100,0,0);
   $pdf->Addpage();
   $pdf->SetAutoPageBreak(true,55);
   $pdf->SetLineWidth(1);
   $pdf->SetLineWidth(10);
   $pdf->SetFont("Times","B","20");
   $pdf->Text(80,10,"descriptif filiere");
   $pdf->SetFont("Arial","B","10");

if(isset($_POST['ALL']))
{	

		$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.CODE_FIL='F1'";	
	
  $result = mysqli_query($ma_connexion,$query); 
  
  
while ($ligne1 = mysqli_fetch_array($result))
  	{
  	$r10=$ligne1['NOM_MODU'];

	$query1 = 'select Ma.NOM_MAT as NOM_MAT,VOLUME_HORAIRE_MAT as vh
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.NOM_MODU="'.$r10.'" ';

					$result1 = mysqli_query($ma_connexion,$query1);

	$r10 = utf8_decode($r10);
    $r10="module".": ".$r10;
	$pdf->MultiCell(0,8,$r10);

 while ($ligne = mysqli_fetch_array($result1))
  	{
    $r1=$ligne['NOM_MAT'];
    $vh=$ligne['vh'];
	$r1 = utf8_decode($r1);
	$pdf->SetX(30);
	$pdf->MultiCell(0,8,"$r1 : $vh h");
	}
	}
	$pdf->Output();
}





if(isset($_POST['S1']))
{
	$pdf->SetX(30);
	$pdf->MultiCell(0,8,"Semestre 1 :");

	if(isset($_POST['Modules']))
	{
		if(isset($_POST['Matieres']))
		{
			if(isset($_POST['titre']))
			{
				if(isset($_POST['volume']))
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S1' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT,VOLUME_HORAIRE_MAT as vh
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);



				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
				    $vh=$ligne['vh'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1 : $vh h");
					$i++;
					}
					}
					if(!isset($_POST['S2'])  && !isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
					
					
				}
				else
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S1' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					$i++;
					}
					}
					if(!isset($_POST['S2'])  && !isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
				}
				
			}	
			else 
			{
				/*echo "S1,Modules,nb_matieres validées";*/

				$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S1' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select count(Ma.NOM_MAT) as nb_NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['nb_NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="le nombre des matieres ".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					}
					}
					if(!isset($_POST['S2'])  && !isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
			}
			

		}
		else
		{
			/*echo "S1,Modules validées";*/
			$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S1' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['NOM_MODU'];
					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					}

					if(!isset($_POST['S2'])  && !isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
		}
		
	}
	else
	{
		/*echo "S1,nb_modules,nb_matieres validées ";*/
		$query = "select count(distinct Mo.NOM_MODU) As nb_NOM_MODU,count(Ma.NOM_MAT) as nb_NOM_MAT
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S1' 
					AND Mo.CODE_FIL='F1' ";


				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['nb_NOM_MODU'];
				  	$r9=$ligne1['nb_NOM_MAT'];
					$r10 = utf8_decode($r10);
				    $r10="le nombre des modules".": ".$r10;
				    $r9="le nombre des matieres".": ".$r9;
					$pdf->MultiCell(0,8,$r10);
					$pdf->MultiCell(0,8,$r9);
					}

					if(!isset($_POST['S2'])  && !isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
	}
	



}

if(isset($_POST['S2']))
{
	$pdf->SetX(30);
	$pdf->MultiCell(0,8,"Semestre 2 :");

	if(isset($_POST['Modules']))
	{
		if(isset($_POST['Matieres']))
		{
			if(isset($_POST['titre']))
			{
				if(isset($_POST['volume']))
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S2' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT,VOLUME_HORAIRE_MAT as vh
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);



				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
				    $vh=$ligne['vh'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1 : $vh h");
					$i++;
					}
					}
					if(!isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
				}
				else
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S2' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					$i++;
					}
					}
					if(!isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
				}
				
			}	
			else 
			{
				/*echo "S1,Modules,nb_matieres validées";*/

				$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S2' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select count(Ma.NOM_MAT) as nb_NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['nb_NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="le nombre des matieres ".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					}
					}
					if(!isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
			}
			

		}
		else
		{
			/*echo "S1,Modules validées";*/
			$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S2' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['NOM_MODU'];
					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					}

					if(!isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
		}
		
	}
	else
	{
		/*echo "S1,nb_modules,nb_matieres validées ";*/
		$query = "select count(distinct Mo.NOM_MODU) As nb_NOM_MODU,count(Ma.NOM_MAT) as nb_NOM_MAT
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S2' 
					AND Mo.CODE_FIL='F1' ";


				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['nb_NOM_MODU'];
				  	$r9=$ligne1['nb_NOM_MAT'];
					$r10 = utf8_decode($r10);
				    $r10="le nombre des modules".": ".$r10;
				    $r9="le nombre des matieres".": ".$r9;
					$pdf->MultiCell(0,8,$r10);
					$pdf->MultiCell(0,8,$r9);
					}

					if(!isset($_POST['S3']) &&  !isset($_POST['S4']))
					{
						$pdf->Output();
					}
	}
	



}


if(isset($_POST['S3']))
{
	$pdf->SetX(30);
	$pdf->MultiCell(0,8,"Semestre 3 :");

	if(isset($_POST['Modules']))
	{
		if(isset($_POST['Matieres']))
		{
			if(isset($_POST['titre']))
			{
				if(isset($_POST['volume']))
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S3' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT,VOLUME_HORAIRE_MAT as vh
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);



				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
				    $vh=$ligne['vh'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1 : $vh h");
					$i++;
					}
					}
					if(!isset($_POST['S4']))
					{
						$pdf->Output();
					}
				}
				else
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S3' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					$i++;
					}
					}
					if(!isset($_POST['S4']))
					{
						$pdf->Output();
					}
				}
				
			}	
			else 
			{
				/*echo "S1,Modules,nb_matieres validées";*/

				$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S3' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select count(Ma.NOM_MAT) as nb_NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['nb_NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="le nombre des matieres ".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					}
					}
					if(!isset($_POST['S4']))
					{
						$pdf->Output();
					}
			}
			

		}
		else
		{
			/*echo "S1,Modules validées";*/
			$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S3' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['NOM_MODU'];
					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					}

					if(!isset($_POST['S4']))
					{
						$pdf->Output();
					}
		}
		
	}
	else
	{
		/*echo "S1,nb_modules,nb_matieres validées ";*/
		$query = "select count(distinct Mo.NOM_MODU) As nb_NOM_MODU,count(Ma.NOM_MAT) as nb_NOM_MAT
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S3' 
					AND Mo.CODE_FIL='F1' ";


				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['nb_NOM_MODU'];
				  	$r9=$ligne1['nb_NOM_MAT'];
					$r10 = utf8_decode($r10);
				    $r10="le nombre des modules".": ".$r10;
				    $r9="le nombre des matieres".": ".$r9;
					$pdf->MultiCell(0,8,$r10);
					$pdf->MultiCell(0,8,$r9);
					}

					if(!isset($_POST['S4']))
					{
						$pdf->Output();
					}
	}
	



}


if(isset($_POST['S4']))
{
	$pdf->SetX(30);
	$pdf->MultiCell(0,8,"Semestre 4 :");

	if(isset($_POST['Modules']))
	{
		if(isset($_POST['Matieres']))
		{
			if(isset($_POST['titre']))
			{
				if(isset($_POST['volume']))
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S4' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT,VOLUME_HORAIRE_MAT as vh
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);



				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
				    $vh=$ligne['vh'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1 : $vh h");
					$i++;
					}
					}
					$pdf->Output();
					
				}
				else
				{
					$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S4' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 

				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		$i=1;
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select Ma.NOM_MAT as NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="matiere $i".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					$i++;
					}
					}
					$pdf->Output();
					
				}
				
			}	
			else 
			{
				/*echo "S1,Modules,nb_matieres validées";*/

				$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S4' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  		
				  	$r10=$ligne1['NOM_MODU'];

					$query1 = 'select count(Ma.NOM_MAT) as nb_NOM_MAT
									from matiere Ma,module Mo
									where Mo.CODE_MODU=Ma.CODE_MODU
									AND Mo.CODE_FIL="F1"
									AND Mo.NOM_MODU="'.$r10.'" ';

									$result1 = mysqli_query($ma_connexion,$query1);

					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					
				 while ($ligne = mysqli_fetch_array($result1))
				  	{
				    $r1=$ligne['nb_NOM_MAT'];
					$r1 = utf8_decode($r1);
					$r1="le nombre des matieres ".": ".$r1;
					$pdf->SetX(30);
					$pdf->MultiCell(0,8,"$r1");
					}
					}
					$pdf->Output();
			}
			

		}
		else
		{
			/*echo "S1,Modules validées";*/
			$query = "select distinct Mo.NOM_MODU As NOM_MODU
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S4' 
					AND Mo.CODE_FIL='F1' ";

				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['NOM_MODU'];
					$r10 = utf8_decode($r10);
				    $r10="module $i".": ".$r10;
					$pdf->MultiCell(0,8,$r10);
					$i++;
					}
					$pdf->Output();
		}
		
	}
	else
	{
		/*echo "S1,nb_modules,nb_matieres validées ";*/
		$query = "select count(distinct Mo.NOM_MODU) As nb_NOM_MODU,count(Ma.NOM_MAT) as nb_NOM_MAT
					from matiere Ma,module Mo
					where Mo.CODE_MODU=Ma.CODE_MODU
					AND Mo.ID_SEMSTRE='S4' 
					AND Mo.CODE_FIL='F1' ";


				  $result = mysqli_query($ma_connexion,$query); 
				$i=1;
				while ($ligne1 = mysqli_fetch_array($result))
				  	{
				  	$r10=$ligne1['nb_NOM_MODU'];
				  	$r9=$ligne1['nb_NOM_MAT'];
					$r10 = utf8_decode($r10);
				    $r10="le nombre des modules".": ".$r10;
				    $r9="le nombre des matieres".": ".$r9;
					$pdf->MultiCell(0,8,$r10);
					$pdf->MultiCell(0,8,$r9);
					}
					$pdf->Output();
					
	}
	



}

}



?>