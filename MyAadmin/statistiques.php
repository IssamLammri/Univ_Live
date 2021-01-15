<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php 
include '../connexion.php';	
	$idf =  $_GET['idf'];   
	$sql= "select * from filiere WHERE CODE_FIL ='$idf'";
	$query=mysqli_query($ma_connexion,$sql) ;
      while($row = mysqli_fetch_assoc($query))
      {
		$NOM_FIL = $row['NOM_FIL'] ; 	
      }
	 

	 
	 $mod_Split_AVANC = array();
	$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf'";
	$query=mysqli_query($ma_connexion,$sql) ;
      while($row = mysqli_fetch_assoc($query))
      {
		$mod_Split_AVANC[]= $row['NOM_MODU'] .'::'. $row['avancement'].'::'. $row['VOLUME_HORAIRE_MODU']; 	
      }

    $reqq=($bd->query('select count(Mo.CODE_MODU) as nbModu from module Mo , filiere Fil where Fil.CODE_FIL=Mo.CODE_FIL AND Fil.CODE_FIL="'.$idf.'" '));
    $ress = $reqq->fetch();
    $Nb_Module=$ress['nbModu'];
    $Nb_Module=$Nb_Module;

    $reqq1=($bd->query('SELECT count(`CODE_MAT`) as nbMat FROM `matiere` ma,module mo,filiere f WHERE f.CODE_FIL=mo.CODE_FIL and mo.CODE_MODU = ma.CODE_MODU and f.CODE_FIL = "'.$idf.'" '));
    $ress1 = $reqq1->fetch();
    $Nb_Matiere=$ress1['nbMat'];
    $Nb_Matiere=$Nb_Matiere;

    $reqq2=($bd->query('SELECT count(`CODE_ENS`) as nbEns FROM intervient inter, matiere ma , module mo,filiere f WHERE f.CODE_FIL=mo.CODE_FIL and mo.CODE_MODU = ma.CODE_MODU and inter.CODE_MAT = ma.CODE_MAT and f.CODE_FIL = "'.$idf.'" '));
    $ress2 = $reqq2->fetch();
    $nbEns=$ress2['nbEns'];


    $reqq3=($bd->query('SELECT count(DISTINCT(mo.CODE_COR_MODU)) as CordFil FROM module mo,filiere f,coordonateur_module cm WHERE mo.CODE_COR_MODU=cm.CODE_COR_MODU and mo.CODE_FIL = f.CODE_FIL AND f.CODE_FIL ="'.$idf.'" '));
    $ress3 = $reqq3->fetch();
    $nbCoodFili=$ress3['CordFil'];


    $reqq4=($bd->query('SELECT count(*) as Comp FROM `compfiliere` WHERE `CODE_FIL` = "'.$idf.'"  '));
    $ress4 = $reqq4->fetch();
    $CompFil=$ress4['Comp'];

	  
	 // print_r($mod_Split_AVANC) ;  
	 
	$Tableprogress = array();
	$Tableprogressad = array();
	$indiceProgress = 0 ; 
	$indiceProgressad = 0 ; 
	

?> 
<!DOCTYPE html>
<html lang="zxx">
<head>
<title> statistiques </title>
<meta charset="UTF-8">
<!-- custom-theme -->

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/component.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/export.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/flipclock.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/circles.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style_grid.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>
<body>
<!-- banner -->
<div class="wthree_agile_admin_info">
		  <!-- /w3_agileits_top_nav-->
		  <!-- /nav-->
		  <div class="w3_agileits_top_nav">
			<ul id="gn-menu" class="gn-menu-main">
			  		 <!-- /nav_agile_w3l -->
				
				<!-- //nav_agile_w3l -->
				<li class="second logo"><h1><a href="suivie.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Retour </a></h1></li>
				
				     
				</li>
				
				


			</ul>
			<!-- //nav -->
			
		</div>
		<div class="clearfix"></div>
		<!-- //w3_agileits_top_nav-->
		<!-- /inner_content-->
				<div class="inner_content">
				    <!-- /inner_content_w3_agile_info-->
					<div class="inner_content_w3_agile_info">
					<!-- /agile_top_w3_grids-->
					   <div class="agile_top_w3_grids">
					        <ul class="ca-menu">
							<center>
								<h1 class="w3_inner_tittle" > <?php  echo $NOM_FIL  ;?> </h1> </center>
									<div class="clearfix"></div>
							</ul>
					   </div>
					 <!-- //agile_top_w3_grids-->
						<!-- /agile_top_w3_post_sections-->
							<div class="agile_top_w3_post_sections">
							       <div class="col-md-12 agile_top_w3_post agile_info_shadow">
										   <div class="img_wthee_post">
										         <h3 class="w3_inner_tittle">Reporting</h3>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count"><?php  echo $nbEns  ;?></h4><span class="year">Enseignants</span></div>
													<div class="year-info"><p class="text-no"><?php  echo $Nb_Module  ;?> </p><span class="year">Modules</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count"><?php  echo $nbCoodFili  ;?>  </h4><span class="year">Coordonateur modules </span></div>
													<div class="year-info"><p class="text-no"><?php  echo $Nb_Matiere  ;?></p><span class="year">Matieres</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">2 </h4><span class="year">Collaborateurs</span></div>
													<div class="year-info"><p class="text-no"><?php  echo $CompFil  ;?></p><span class="year">competances</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count"><?php  echo $nbEns+$nbCoodFili+2  ;?></h4><span class="year">Total intervenants</span></div>
													<div class="year-info"><p class="text-no">12/20</p><span class="year">validation</span></div>
													<div class="clearfix"></div>
												</div>
											  
											</div>
									   </div>
								       <div class="clearfix"></div>
							     </div>
								   
						<!-- //agile_top_w3_post_sections-->
					
							<!-- /w3ls_agile_circle_progress-->
							<div class="w3ls_agile_cylinder chart agile_info_shadow">
							<h3 class="w3_inner_tittle two"> Volume des modules </h3>
							
									 <div id="chartdiv"></div>
										
								
							</div>
							
							
						<!-- /w3ls_agile_circle_progress-->
						<!-- /chart_agile-->
						 
						 
						  <!-- /w3ls_agile_circle_progress-->
						<div class="w3ls_agile_circle_progress agile_info_shadow">
							
								<div class="cir_agile_info ">
								<h3 class="w3_inner_tittle">Progression des modules </h3>
								 <ul class="nav nav-pills">
										<li class="active"><a href="#sem1a" data-toggle="tab" aria-expanded="true">semestre 1</a>
										</li>
										<li class=""><a href="#sem2a" data-toggle="tab" aria-expanded="false">semestre 2 </a>
										</li>
										<li class=""><a href="#sem3a" data-toggle="tab" aria-expanded="false">semestre 3</a>
										</li>
										<li class=""><a href="#sem4a" data-toggle="tab" aria-expanded="false">semestre 4</a>
										</li>
									</ul>

									<div class="tab-content">
										<div class="tab-pane fade active in" id="sem1a"  >
											<div class="skill-grids">
												<?php
												
												$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' AND ID_SEMSTRE = 'S1'";
												$query=mysqli_query($ma_connexion,$sql) ;
												  while($row = mysqli_fetch_assoc($query))
												  {	
													$Tableprogress[]= $row['avancement'] ; 	
													echo '
													<div class="skills-grid text-center">
														<div class="circle" id="circles-'.$indiceProgress.'"></div>
														<p>'.$row['NOM_MODU'].'</p>
													</div>
													';
													$indiceProgress++ ; 
													
												 } 										
												?>	
											
												 <div class="clearfix"></div>
												
											</div>
										</div>
										<div class="tab-pane fade in" id="sem2a" >
											<div class="skill-grids">
												<?php
												
												$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' AND ID_SEMSTRE = 'S2'";
												$query=mysqli_query($ma_connexion,$sql) ;
												  while($row = mysqli_fetch_assoc($query))
												  {	
													$Tableprogress[]= $row['avancement'] ; 	
													echo '
													<div class="skills-grid text-center">
														<div class="circle" id="circles-'.$indiceProgress.'"></div>
														<p>'.$row['NOM_MODU'].'</p>
													</div>
													';
													$indiceProgress++ ; 
													
												 } 										
												?>	
											
												 <div class="clearfix"></div>
												
											</div>
										</div>
										<div class="tab-pane fade" id="sem3a"  >
											<div class="skill-grids">
												<?php
												
												$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' AND ID_SEMSTRE = 'S3'";
												$query=mysqli_query($ma_connexion,$sql) ;
												  while($row = mysqli_fetch_assoc($query))
												  {	
													$Tableprogress[]= $row['avancement'] ; 	
													echo '
													<div class="skills-grid text-center">
														<div class="circle" id="circles-'.$indiceProgress.'"></div>
														<p>'.$row['NOM_MODU'].'</p>
													</div>
													';
													$indiceProgress++ ; 
													
												 } 										
												?>	
											
												 <div class="clearfix"></div>
												
											</div>
										</div>
										<div class="tab-pane fade" id="sem4a"  >
											<div class="skill-grids">
												<?php
												
												$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' AND ID_SEMSTRE = 'S4'";
												$query=mysqli_query($ma_connexion,$sql) ;
												  while($row = mysqli_fetch_assoc($query))
												  {	
													$Tableprogress[]= $row['avancement'] ; 	
													echo '
													<div class="skills-grid text-center">
														<div class="circle" id="circles-'.$indiceProgress.'"></div>
														<p>'.$row['NOM_MODU'].'</p>
													</div>
													';
													$indiceProgress++ ; 
													
												 } 										
												?>	
											
												
												
											</div>
										</div>
									</div>
								
									
								</div>
						</div>
						
							<div class="w3ls_agile_cylinder chart agile_info_shadow">
							<h3 class="w3_inner_tittle two"> Volume des matieres  </h3>
							
									 
									<ul class="nav nav-pills">
										<?php
											$indicejustForactive = 0 ; 
											$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' order by ID_SEMSTRE , CODE_MODU";
											$query=mysqli_query($ma_connexion,$sql) ;
											  while($row = mysqli_fetch_assoc($query))
											  {	
												if ($indicejustForactive == 0 ) 
												{
												echo '
												<li class="active"><a href="#mod'.$row['CODE_MODU'].'" data-toggle="tab" aria-expanded="true">'.$row['NOM_MODU'].'</a>
												</li>
												';
												$indicejustForactive = 1 ; 
												}
												else 
												echo '
												<li class=""><a href="#mod'.$row['CODE_MODU'].'" data-toggle="tab" aria-expanded="true">'.$row['NOM_MODU'].'</a>
												</li>
												';	

												
											 } 										
										?>	

									</ul>

									<div class="tab-content">
									
										<?php
											$indicejustForactive2 = 0 ;  											
											$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' order by ID_SEMSTRE , CODE_MODU";
											$query=mysqli_query($ma_connexion,$sql) ;
											  while($row = mysqli_fetch_assoc($query))
											  {	
												$codmodd = $row['CODE_MODU'] ;	
												if ($indicejustForactive2 == 0 )
												{
												echo ' 
												<div class="tab-pane fade active in" id="mod'.$row['CODE_MODU'].'"  >  <br/><br/> <div class="clearfix"></div>
												<div class="bar_group">
												';
												$indicejustForactive2 = 1 ; 
												}
												else
													echo ' 
												<div class="tab-pane fade in" id="mod'.$row['CODE_MODU'].'"  >  <br/><br/><div class="clearfix"></div>
												<div class="bar_group">
												';	
												$sql2= "SELECT * FROM `matiere` WHERE CODE_MODU = '$codmodd' ";
												$query2=mysqli_query($ma_connexion,$sql2) ;
												  while($row = mysqli_fetch_assoc($query2))
												  {	
												
													
													$nommat= $row['NOM_MAT'] ; 	
													$progrss= $row['avancement'] ; 	
													echo "<div class='bar_group__bar thin' label='$nommat' show_values='true' tooltip='true' value='$progrss'></div>";
	
												} 
												
												echo '
												</div>
												</div>  <div class="clearfix"></div>
												';
											} 										
											?>	

									</div>
								
							</div>
							</div>
							
							
							
							<div class="w3ls_agile_circle_progress agile_info_shadow">
							
								<div class="cir_agile_info ">
								<h3 class="w3_inner_tittle">Progression des matiere </h3>
									<ul class="nav nav-pills">
										<?php
											$indicejustForactive = 0 ; 
											$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' order by ID_SEMSTRE , CODE_MODU";
											$query=mysqli_query($ma_connexion,$sql) ;
											  while($row = mysqli_fetch_assoc($query))
											  {	
												if ($indicejustForactive == 0 ) 
												{
												echo '
												<li class="active"><a href="#modad'.$row['CODE_MODU'].'" data-toggle="tab" aria-expanded="true">'.$row['NOM_MODU'].'</a>
												</li>
												';
												$indicejustForactive = 1 ; 
												}
												else 
												echo '
												<li class=""><a href="#modad'.$row['CODE_MODU'].'" data-toggle="tab" aria-expanded="true">'.$row['NOM_MODU'].'</a>
												</li>
												';	

												
											 } 										
										?>	

									</ul>
									<div class="tab-content">
									
										<?php
											$indicejustForactive2 = 0 ;  											
											$sql= "SELECT * FROM `module` WHERE CODE_FIL ='$idf' order by ID_SEMSTRE , CODE_MODU";
											$query=mysqli_query($ma_connexion,$sql) ;
											while($row = mysqli_fetch_assoc($query))
											{	
												$codmodd = $row['CODE_MODU'] ;	
												if ($indicejustForactive2 == 0 )
												{
												echo ' 
												<div class="tab-pane fade active in" id="modad'.$row['CODE_MODU'].'"  > 
												
												';
												$indicejustForactive2 = 1 ; 
												}
												else
												{
													echo ' 
												<div class="tab-pane fade in" id="modad'.$row['CODE_MODU'].'"  >  
												
												';	
												}
												
												echo '<div class="skill-grids"> ' ; 
												
												$sql2= "SELECT * FROM `matiere` WHERE CODE_MODU = '$codmodd' ";
												$query2=mysqli_query($ma_connexion,$sql2) ;
												  while($row = mysqli_fetch_assoc($query2))
												  {	
													$Tableprogressad[]= $row['avancement'] ; 	
													echo '
													<div class="skills-grid text-center">
														<div class="circle" id="circlesad-'.$indiceProgressad.'"></div>
														<p>'.$row['NOM_MAT'].'</p>
													</div>
													';
													$indiceProgressad++ ; 
													
												} 										
												
											
												 echo '<div class="clearfix"></div>
												
												 </div>  </div> '; 
												
												
	
											} 
																				
											?>	

									
															
											
											
												
												
								</div>
							</div>
								
						</div>
						<!-- /w3ls_agile_circle_progress-->

				    </div>
					<!-- //inner_content_w3_agile_info-->
				</div>
		<!-- //inner_content-->
	</div>
<!-- banner -->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2017 PFE. All Rights Reserved | D_A</a> </p>
</div>	
<!--copy rights end here-->
<!-- js -->

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- /amcharts -->
				<script src="js/amcharts.js"></script>
		       <script src="js/serial.js"></script>
				<script src="js/export.js"></script>	
				<script src="js/light.js"></script>
				<!-- Chart code -->
	 <script>
	 
	 chartData = [];	
		
	 var a = <?php echo json_encode($mod_Split_AVANC); ?>;
	 var res ; 
	 var ii = 0 ; 
	 a.forEach(function(element) {
	  
		  res = element.split("::"); 
		  chartData[ii] = {
				"country" :  res[0] , 
				"visits" : res[2] ,
				"color" : "#F8FF01"
			}
		 
			ii++ ; 
		});
	
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "startDuration": 2,
    "dataProvider": chartData,
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "depth3D": 40,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
    },
    "export": {
    	"enabled": true
     }

}, 0);




</script>


<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv1", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": [{
        "year": 2017,
        "europe": 2.5,
        "namerica": 2.5,
        "asia": 2.1,
        "lamerica": 0.3,
        "meast": 0.2,
        "africa": 0.1
    }, {
        "year": 2016,
        "europe": 2.6,
        "namerica": 2.7,
        "asia": 2.2,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }, {
        "year": 2015,
        "europe": 2.8,
        "namerica": 2.9,
        "asia": 2.4,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }],
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.5,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Europe",
        "type": "column",
		"color": "#000000",
        "valueField": "europe"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "North America",
        "type": "column",
		"color": "#000000",
        "valueField": "namerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Asia-Pacific",
        "type": "column",
		"color": "#000000",
        "valueField": "asia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Latin America",
        "type": "column",
		"color": "#000000",
        "valueField": "lamerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Middle-East",
        "type": "column",
		"color": "#000000",
        "valueField": "meast"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Africa",
        "type": "column",
		"color": "#000000",
        "valueField": "africa"
    }],
    "rotate": true,
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }
});
</script>

	<!-- //amcharts -->
		<script src="js/chart1.js"></script>
				<script src="js/Chart.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
			<!-- script-for-menu -->

<!-- /circle-->
	 <script type="text/javascript" src="js/circles.js"></script>
					         <script>
							 
								var indicejusqua = <?php echo $indiceProgress ; ?>;
								var valeurparindice = <?php echo json_encode($Tableprogress); ?>;
								
								var colors = [
										['#ffffff', '#fc3158'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
										, ['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
										, ['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
									];
									
									
								for (var i = 0; i < indicejusqua; i++) {
									var child = document.getElementById('circles-' + i);
										
									Circles.create({
										id:         child.id,
										percentage: valeurparindice[i] ,
										radius:     80,
										width:      10,
										number:   	valeurparindice[i] / 1 ,
										text:       '%',
										colors:     colors[i - 1]
									});
								}
						
						</script>
						
						<script>
							 
								var indicejusqua = <?php echo $indiceProgressad ; ?>;
								var valeurparindice = <?php echo json_encode($Tableprogressad); ?>;
								
								var colors = [
										['#ffffff', '#fc3158'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
										, ['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
										, ['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
									];
									
									
								for (var i = 0; i < indicejusqua; i++) {
									var child = document.getElementById('circlesad-' + i);
										
									Circles.create({
										id:         child.id,
										percentage: valeurparindice[i] ,
										radius:     80,
										width:      10,
										number:   	valeurparindice[i] / 1 ,
										text:       '%',
										colors:     colors[i - 1]
									});
								}
						
						</script>
	<!-- //circle -->
	<!--skycons-icons-->
<script src="js/skycons.js"></script>
<script>
									 var icons = new Skycons({"color": "#fcb216"}),
										  list  = [
											"partly-cloudy-day"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
								<script>
									 var icons = new Skycons({"color": "#fff"}),
										  list  = [
											"clear-night","partly-cloudy-night", "cloudy", "clear-day", "sleet", "snow", "wind","fog"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
<!--//skycons-icons-->
<!-- //js -->
<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
		</script>
		<script src="js/flipclock.js"></script>
	
	<script type="text/javascript">
		var clock;
		
		$(document).ready(function() {
			
			clock = $('.clock').FlipClock({
		        clockFace: 'HourlyCounter'
		    });
		});
	</script>
<script src="js/bars.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>


</body>
</html>