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
							       <div class="col-md-6 agile_top_w3_post agile_info_shadow">
										   <div class="img_wthee_post">
										         <h3 class="w3_inner_tittle">Reporting</h3>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">30 </h4><span class="year">Enseignants</span></div>
													<div class="year-info"><p class="text-no">16 </p><span class="year">Modules</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">15 </h4><span class="year">Coordonateur modules </span></div>
													<div class="year-info"><p class="text-no">40 </p><span class="year">Matieres</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">16 </h4><span class="year">Collaborateurs</span></div>
													<div class="year-info"><p class="text-no">30 </p><span class="year">competances</span></div>
													<div class="clearfix"></div>
												</div>
												<div class="stats-wrap">
													<div class="count_info"><h4 class="count">59</h4><span class="year">Total intervenants</span></div>
													<div class="year-info"><p class="text-no">10 </p><span class="year">validation</span></div>
													<div class="clearfix"></div>
												</div>
											  
											</div>
									   </div>
									    <div class="col-md-6 agile_top_w3_post_info agile_info_shadow">
										    <div class="img_wthee_post1">
											<h3 class="w3_inner_tittle"> Flip Clock</h3>
										       	<div class="main-example">
													<div class="clock"></div>
													<div class="message"></div>

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
						 <!--/prograc-blocks_agileits-->
							<div class="prograc-blocks_agileits">
								
								
								 <div class="col-md-6 bars_agileits agile_info_shadow">
								  <h3 class="w3_inner_tittle two">Progression par semestre </h3>
								
								  
										
								</div>
								<div class="col-md-6 fallowers_agile agile_info_shadow">
									<h3 class="w3_inner_tittle two">Recent Followers</h3>
												<div class="work-progres">
													<div class="table-responsive">
														<table class="table table-hover">
														  <thead>
															<tr>
															  <th>#</th>
															  <th>Project</th>
															  <th>Manager</th>                                   
																								
															  <th>Status</th>
															  <th>Progress</th>
														  </tr>
													  </thead>
													  <tbody>
														<tr>
														  <td>1</td>
														  <td>Face book</td>
														  <td>Malorum</td>                                 
																					 
														  <td><span class="label label-danger">in progress</span></td>
														  <td><span class="badge badge-info">50%</span></td>
													  </tr>
													  <tr>
														  <td>2</td>
														  <td>Twitter</td>
														  <td>Evan</td>                               
																						  
														  <td><span class="label label-success">completed</span></td>
														  <td><span class="badge badge-success">100%</span></td>
													  </tr>
													  <tr>
														  <td>3</td>
														  <td>Google</td>
														  <td>John</td>                                
														  
														  <td><span class="label label-warning">in progress</span></td>
														  <td><span class="badge badge-warning">75%</span></td>
													  </tr>
													  <tr>
														  <td>4</td>
														  <td>LinkedIn</td>
														  <td>Danial</td>                                 
																					 
														  <td><span class="label label-info">in progress</span></td>
														  <td><span class="badge badge-info">65%</span></td>
													  </tr>
													  <tr>
														  <td>5</td>
														  <td>Tumblr</td>
														  <td>David</td>                                
																						 
														  <td><span class="label label-warning">in progress</span></td>
														  <td><span class="badge badge-danger">95%</span></td>
													  </tr>
													  <tr>
														  <td>6</td>
														  <td>Tesla</td>
														  <td>Mickey</td>                                  
																					 
														  <td><span class="label label-info">in progress</span></td>
														  <td><span class="badge badge-success">95%</span></td>
													  </tr>
												  </tbody>
											  </table>
											</div>
										</div>											
								</div>
									 <div class="clearfix"></div>
							</div>

							  <!--//prograc-blocks_agileits-->
						<!-- /bottom_agileits_grids-->
						<div class="bottom_agileits_grids">
						<div class="col-md-4 profile-main">
						    <div class="profile_bg_agile">
								<div class="profile-pic wthree">
									<h2>Bason Durel</h2>
									<img src="images/profile.jpg" alt="Image">
									<p>Web Designer</p>
								</div>
								<div class="profile-ser">
										<div class="follow-grids-agileits-w3layouts">
											<div class="profile-ser-grids">
												<h3>Followers</h3>
												<h4>2486</h4>
											</div>
											<div class="profile-ser-grids agileinfo">
												<h3>Following</h3>
												<h4>1582</h4>
											</div>
											<div class="profile-ser-grids no-border">
												<h3>Tweets</h3>
												<h4>1468</h4>
											</div>
											<div class="clearfix"> </div>
										</div>
										<div class="w3l_social_icons w3l_social_icons1">
											<ul>
												<li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
												<li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
												<li><a href="#" class="google_plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											</ul>
										</div>

						        </div>
								</div>
					        </div>
							<div class="col-md-8 chart_agile agile_info_shadow">
							 <h3 class="w3_inner_tittle two">Stacked Bar Chart</h3>
							    <div id="chartdiv1"></div>	
							</div>
											
						
							 <div class="clearfix"></div>
						</div>
						<!-- //bottom_agileits_grids-->
												<!-- /weather_w3_agile_info-->
						<div class="weather_w3_agile_info agile_info_shadow">
						  <div class="weather_w3_inner_info">
						      
							     <div class="over_lay_agile">
								  <h3 class="w3_inner_tittle">Weather Report</h3>
						       	  <ul>
									<li>
										<figure class="icons">
											<canvas id="partly-cloudy-day" width="60" height="60"></canvas>
										</figure>
										<h3>25 °C</h3>
										<div class="clearfix"></div>
									</li>
									<li>
										<figure class="icons">
											<canvas id="clear-day" width="60" height="60"></canvas>
										</figure>
										<div class="weather-text">
											<h4>WED</h4>
											<h5>27 °C</h5>
										</div>
										<div class="clearfix"></div>
									</li>
									<li>
										<figure class="icons">
											<canvas id="snow" width="60" height="60"></canvas>
										</figure>
										<div class="weather-text">
											<h4>THU</h4>
											<h5>13 °C</h5>
										</div>
										<div class="clearfix"></div>
									</li>
									<li>
										<figure class="icons">
											<canvas id="partly-cloudy-night" width="60" height="60"></canvas>
										</figure>
										<div class="weather-text">
											<h4>FRI</h4>
											<h5>18 °C</h5>
										</div>
										<div class="clearfix"></div>
									</li>
									<li>
										<figure class="icons">
											<canvas id="cloudy" width="60" height="60"></canvas>
										</figure>
										<div class="weather-text">
											<h4>SAT</h4>
											<h5>15 °C</h5>
										</div>
										<div class="clearfix"></div>
									</li>
									<li>
										<figure class="icons">
											<canvas id="fog" width="60" height="60"></canvas>
										</figure>
										<div class="weather-text">
											<h4>SUN</h4>
											<h5>11 °C</h5>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
								</div>
							</div>	
						</div>
						<!-- //weather_w3_agile_info-->
						<!-- /social_media-->
						 
						<!-- //social_media-->
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
        "axisAlpha":0,
        "gridAlpha":0

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