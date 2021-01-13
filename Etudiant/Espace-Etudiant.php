<?php
include '../connexion.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion des filières | Espace Etudiant</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">  
  <link rel="stylesheet" type="text/css" href="../css/ionicons.min.css">  
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <style type="text/css">

table.dataTable {
  width: 100%;
  margin: 0 auto;
  clear: both;
  border-collapse: separate;
  border-spacing: 0;

}
table.dataTable thead th,
table.dataTable tfoot th {
  font-weight: bold;
}
table.dataTable thead th,
table.dataTable thead td {
  padding: 10px 18px;
  border-bottom: 1px solid #111;
}
table.dataTable thead th:active,
table.dataTable thead td:active {
  outline: none;
}
table.dataTable tfoot th,
table.dataTable tfoot td {
  padding: 10px 18px 6px 18px;
  border-top: 1px solid #111;
}
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc {
  cursor: pointer;
  *cursor: hand;
}
table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
  background-repeat: no-repeat;
  background-position: center right;
}
table.dataTable thead .sorting {
  background-image: url("../images/sort_both.png");
}
table.dataTable thead .sorting_asc {
  background-image: url("../images/sort_asc.png");
}
table.dataTable thead .sorting_desc {
  background-image: url("../images/sort_desc.png");
}
table.dataTable thead .sorting_asc_disabled {
  background-image: url("../images/sort_asc_disabled.png");
}
table.dataTable thead .sorting_desc_disabled {
  background-image: url("../images/sort_desc_disabled.png");
}
table.dataTable tbody tr {
  background-color: #ffffff;
}
table.dataTable tbody tr.selected {
  background-color: #B0BED9;
}
table.dataTable tbody th,
table.dataTable tbody td {
  padding: 8px 10px;
}
table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
  border-top: 1px solid #ddd;
}
table.dataTable.row-border tbody tr:first-child th,
table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th,
table.dataTable.display tbody tr:first-child td {
  border-top: none;
}
table.dataTable.cell-border tbody th, table.dataTable.cell-border tbody td {
  border-top: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
table.dataTable.cell-border tbody tr th:first-child,
table.dataTable.cell-border tbody tr td:first-child {
  border-left: 1px solid #ddd;
}
table.dataTable.cell-border tbody tr:first-child th,
table.dataTable.cell-border tbody tr:first-child td {
  border-top: none;
}
table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
  background-color: #f9f9f9;
}
table.dataTable.stripe tbody tr.odd.selected, table.dataTable.display tbody tr.odd.selected {
  background-color: #acbad4;
}
table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
  background-color: #f6f6f6;
}
table.dataTable.hover tbody tr:hover.selected, table.dataTable.display tbody tr:hover.selected {
  background-color: #aab7d1;
}
table.dataTable.order-column tbody tr > .sorting_1,
table.dataTable.order-column tbody tr > .sorting_2,
table.dataTable.order-column tbody tr > .sorting_3, table.dataTable.display tbody tr > .sorting_1,
table.dataTable.display tbody tr > .sorting_2,
table.dataTable.display tbody tr > .sorting_3 {
  background-color: #fafafa;
}
table.dataTable.order-column tbody tr.selected > .sorting_1,
table.dataTable.order-column tbody tr.selected > .sorting_2,
table.dataTable.order-column tbody tr.selected > .sorting_3, table.dataTable.display tbody tr.selected > .sorting_1,
table.dataTable.display tbody tr.selected > .sorting_2,
table.dataTable.display tbody tr.selected > .sorting_3 {
  background-color: #acbad5;
}
table.dataTable.display tbody tr.odd > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 {
  background-color: #f1f1f1;
}
table.dataTable.display tbody tr.odd > .sorting_2, table.dataTable.order-column.stripe tbody tr.odd > .sorting_2 {
  background-color: #f3f3f3;
}
table.dataTable.display tbody tr.odd > .sorting_3, table.dataTable.order-column.stripe tbody tr.odd > .sorting_3 {
  background-color: whitesmoke;
}
table.dataTable.display tbody tr.odd.selected > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_1 {
  background-color: #a6b4cd;
}
table.dataTable.display tbody tr.odd.selected > .sorting_2, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_2 {
  background-color: #a8b5cf;
}
table.dataTable.display tbody tr.odd.selected > .sorting_3, table.dataTable.order-column.stripe tbody tr.odd.selected > .sorting_3 {
  background-color: #a9b7d1;
}
table.dataTable.display tbody tr.even > .sorting_1, table.dataTable.order-column.stripe tbody tr.even > .sorting_1 {
  background-color: #fafafa;
}
table.dataTable.display tbody tr.even > .sorting_2, table.dataTable.order-column.stripe tbody tr.even > .sorting_2 {
  background-color: #fcfcfc;
}
table.dataTable.display tbody tr.even > .sorting_3, table.dataTable.order-column.stripe tbody tr.even > .sorting_3 {
  background-color: #fefefe;
}
table.dataTable.display tbody tr.even.selected > .sorting_1, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_1 {
  background-color: #acbad5;
}
table.dataTable.display tbody tr.even.selected > .sorting_2, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_2 {
  background-color: #aebcd6;
}
table.dataTable.display tbody tr.even.selected > .sorting_3, table.dataTable.order-column.stripe tbody tr.even.selected > .sorting_3 {
  background-color: #afbdd8;
}
table.dataTable.display tbody tr:hover > .sorting_1, table.dataTable.order-column.hover tbody tr:hover > .sorting_1 {
  background-color: #eaeaea;
}
table.dataTable.display tbody tr:hover > .sorting_2, table.dataTable.order-column.hover tbody tr:hover > .sorting_2 {
  background-color: #ececec;
}
table.dataTable.display tbody tr:hover > .sorting_3, table.dataTable.order-column.hover tbody tr:hover > .sorting_3 {
  background-color: #efefef;
}
table.dataTable.display tbody tr:hover.selected > .sorting_1, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_1 {
  background-color: #a2aec7;
}
table.dataTable.display tbody tr:hover.selected > .sorting_2, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_2 {
  background-color: #a3b0c9;
}
table.dataTable.display tbody tr:hover.selected > .sorting_3, table.dataTable.order-column.hover tbody tr:hover.selected > .sorting_3 {
  background-color: #a5b2cb;
}
table.dataTable.no-footer {
  border-bottom: 1px solid #111;
}
table.dataTable.nowrap th, table.dataTable.nowrap td {
  white-space: nowrap;
}
table.dataTable.compact thead th,
table.dataTable.compact thead td {
  padding: 4px 17px 4px 4px;
}
table.dataTable.compact tfoot th,
table.dataTable.compact tfoot td {
  padding: 4px;
}
table.dataTable.compact tbody th,
table.dataTable.compact tbody td {
  padding: 4px;
}
table.dataTable th.dt-left,
table.dataTable td.dt-left {
  text-align: left;
}
table.dataTable th.dt-center,
table.dataTable td.dt-center,
table.dataTable td.dataTables_empty {
  text-align: center;
}
table.dataTable th.dt-right,
table.dataTable td.dt-right {
  text-align: right;
}
table.dataTable th.dt-justify,
table.dataTable td.dt-justify {
  text-align: justify;
}
table.dataTable th.dt-nowrap,
table.dataTable td.dt-nowrap {
  white-space: nowrap;
}
table.dataTable thead th.dt-head-left,
table.dataTable thead td.dt-head-left,
table.dataTable tfoot th.dt-head-left,
table.dataTable tfoot td.dt-head-left {
  text-align: left;
}
table.dataTable thead th.dt-head-center,
table.dataTable thead td.dt-head-center,
table.dataTable tfoot th.dt-head-center,
table.dataTable tfoot td.dt-head-center {
  text-align: center;
}
table.dataTable thead th.dt-head-right,
table.dataTable thead td.dt-head-right,
table.dataTable tfoot th.dt-head-right,
table.dataTable tfoot td.dt-head-right {
  text-align: right;
}
table.dataTable thead th.dt-head-justify,
table.dataTable thead td.dt-head-justify,
table.dataTable tfoot th.dt-head-justify,
table.dataTable tfoot td.dt-head-justify {
  text-align: justify;
}
table.dataTable thead th.dt-head-nowrap,
table.dataTable thead td.dt-head-nowrap,
table.dataTable tfoot th.dt-head-nowrap,
table.dataTable tfoot td.dt-head-nowrap {
  white-space: nowrap;
}
table.dataTable tbody th.dt-body-left,
table.dataTable tbody td.dt-body-left {
  text-align: left;
}
table.dataTable tbody th.dt-body-center,
table.dataTable tbody td.dt-body-center {
  text-align: center;
}
table.dataTable tbody th.dt-body-right,
table.dataTable tbody td.dt-body-right {
  text-align: right;
}
table.dataTable tbody th.dt-body-justify,
table.dataTable tbody td.dt-body-justify {
  text-align: justify;
}
table.dataTable tbody th.dt-body-nowrap,
table.dataTable tbody td.dt-body-nowrap {
  white-space: nowrap;
}

table.dataTable,
table.dataTable th,
table.dataTable td {
  -webkit-box-sizing: content-box;
  box-sizing: content-box;
}

/*
 * Control feature layout
 */
.dataTables_wrapper {
  position: relative;
  clear: both;
  *zoom: 1;
  zoom: 1;
}
.dataTables_wrapper .dataTables_length {
  float: left;
}
.dataTables_wrapper .dataTables_filter {
  float: right;
  text-align: right;
}
.dataTables_wrapper .dataTables_filter input {
  margin-left: 0.5em;
}
.dataTables_wrapper .dataTables_info {
  clear: both;
  float: left;
  padding-top: 0.755em;
}
.dataTables_wrapper .dataTables_paginate {
  float: right;
  text-align: right;
  padding-top: 0.25em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
  box-sizing: border-box;
  display: inline-block;
  min-width: 1.5em;
  padding: 0.5em 1em;
  margin-left: 2px;
  text-align: center;
  text-decoration: none !important;
  cursor: pointer;
  *cursor: hand;
  color: #333 !important;
  border: 1px solid transparent;
  border-radius: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  color: #333 !important;
  border: 1px solid #979797;
  background-color: white;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%);
  /* Chrome10+,Safari5.1+ */
  background: -moz-linear-gradient(top, white 0%, #dcdcdc 100%);
  /* FF3.6+ */
  background: -ms-linear-gradient(top, white 0%, #dcdcdc 100%);
  /* IE10+ */
  background: -o-linear-gradient(top, white 0%, #dcdcdc 100%);
  /* Opera 11.10+ */
  background: linear-gradient(to bottom, white 0%, #dcdcdc 100%);
  /* W3C */
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
  cursor: default;
  color: #666 !important;
  border: 1px solid transparent;
  background: transparent;
  box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  color: white !important;
  border: 1px solid #111;
  background-color: #585858;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
  /* Chrome10+,Safari5.1+ */
  background: -moz-linear-gradient(top, #585858 0%, #111 100%);
  /* FF3.6+ */
  background: -ms-linear-gradient(top, #585858 0%, #111 100%);
  /* IE10+ */
  background: -o-linear-gradient(top, #585858 0%, #111 100%);
  /* Opera 11.10+ */
  background: linear-gradient(to bottom, #585858 0%, #111 100%);
  /* W3C */
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  outline: none;
  background-color: #2b2b2b;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* Chrome10+,Safari5.1+ */
  background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* FF3.6+ */
  background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* IE10+ */
  background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* Opera 11.10+ */
  background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
  /* W3C */
  box-shadow: inset 0 0 3px #111;
}
.dataTables_wrapper .dataTables_paginate .ellipsis {
  padding: 0 1em;
}
.dataTables_wrapper .dataTables_processing {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100%;
  height: 40px;
  margin-left: -50%;
  margin-top: -25px;
  padding-top: 20px;
  text-align: center;
  font-size: 1.2em;
  background-color: white;
  background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(25%, rgba(255, 255, 255, 0.9)), color-stop(75%, rgba(255, 255, 255, 0.9)), color-stop(100%, rgba(255, 255, 255, 0)));
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
  background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
  background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
  background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
  background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
}
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
  color: #333;
}
.dataTables_wrapper .dataTables_scroll {
  clear: both;
}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody {
  *margin-top: -1px;
  -webkit-overflow-scrolling: touch;
}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td {
  vertical-align: middle;
}
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th > div.dataTables_sizing,
.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td > div.dataTables_sizing {
  height: 0;
  overflow: hidden;
  margin: 0 !important;
  padding: 0 !important;
}
.dataTables_wrapper.no-footer .dataTables_scrollBody {
  border-bottom: 1px solid #111;
}
.dataTables_wrapper.no-footer div.dataTables_scrollHead table,
.dataTables_wrapper.no-footer div.dataTables_scrollBody table {
  border-bottom: none;
}
.dataTables_wrapper:after {
  visibility: hidden;
  display: block;
  content: "";
  clear: both;
  height: 0;
}

@media screen and (max-width: 767px) {
  .dataTables_wrapper .dataTables_info,
  .dataTables_wrapper .dataTables_paginate {
    float: none;
    text-align: center;
  }
  .dataTables_wrapper .dataTables_paginate {
    margin-top: 0.5em;
  }
}
@media screen and (max-width: 640px) {
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter {
    float: none;
    text-align: center;
  }
  .dataTables_wrapper .dataTables_filter {
    margin-top: 0.5em;
  }
}

  </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../index.php" class="navbar-brand"><b>Gestion des </b>Filières</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" >Espace Etudiant</a></li>
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Decriptif filière
          <small>détails :</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">



        <div class="row">


        <div class="col-md-12 test">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Recherche :</h3>
            </div>

            <form method="POST" action="Espace-Etudiant.php">
        <hr>
        <div class="col-xs-10">
        <input type="text" name="text1" id="text1" class="form-control btn-rechrche-hide" autocomplete="off" placeholder="ENTRER LA VILLE , TYPE BAC OU DIPLOME "/>
        <div id="NomList"></div>
        </div>

        <div class="col-xs-1"> 
          <a class="btn btn-primary btn-hide-toggle" >  
            <i class="fa fa-chevron-circle-down fa-stack-3x"></i>
          </a> 
        </div>
        
        <br><br>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <button type="submit" name="rechercher1" class="btn btn-default btn-lg btn-block btn-rechrche-hide"> <i class="fa fa-search" ></i> Recherche simple</button>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="rech_ava">
        <div class="col-xs-4">
          <label>Ville</label>
          <select class="form-control" name="ville" id="ville">
            <option  selected="selected">--select une ville--</option>
              <?php
              $sql="select * from ville;";
              $query=mysqli_query($ma_connexion,$sql) ;
              while($row=mysqli_fetch_assoc($query))
              {
               ?>
                <option value="<?php echo $row['CODE_VILLE'];?>"><?php echo $row['NOM_VILLE']; ?></option>
              <?php
              }
              ?>
          </select>  
        </div>
        <div class="col-xs-4">
          <label>Université</label>
          <select class="form-control" name="universite" id="universite">
            <option selected="selected">--Select une université--</option>
          </select>                        
        </div> 
        <div class="col-xs-4">
          <label>Etablissement</label>
          <select class="form-control" name="etablissment"  id="etablissement">
            <option selected="selected">--Select un etablissment--</option>
          </select>                        
        </div>
        <div class="col-md-4">
              <label>Discipline</label>
              <select class="form-control" name="discipline">
                <option selected="selected">--Select une discipline--</option>
                <?php
                $SQL="select DISTINCT(decipline_FIL),CODE_FIL,CODE_decipline_FIL from decipline_filiere;";
                $query=mysqli_query($ma_connexion,$SQL);
                while($row=mysqli_fetch_assoc($query))
                {
                  ?>
                  <option value="<?php echo $row['CODE_FIL'];?>"><?php echo $row['decipline_FIL']; ?></option>
                  <?php
                }
                ?>
              </select>                        
        </div>
        <div class="col-md-4">
              <label>Type de formation</label>
              <select class="form-control" name="type-formation">
                <option selected="selected">--Select type de formation--</option>
                <?php
                $SQL="select DISTINCT(NATURE_DIPLOME) from filiere;";
                $query=mysqli_query($ma_connexion,$SQL);
                while($row=mysqli_fetch_assoc($query))
                {
                  ?>
                  <option value="<?php echo $row['NATURE_DIPLOME'];?>"><?php echo $row['NATURE_DIPLOME']; ?></option>
                  <?php
                }
                ?>
              </select>                        
        </div>
        <div class="col-md-4">
              <label>Débouche</label>
              <select class="form-control" name="debouche">
                <option selected="selected">--Select debouche--</option>
                <?php
                $sql="select DISTINCT(DEBOUCHE_FOR),CODE_DEBOUCHE_FOR from debouche_formation;";
                $query=mysqli_query($ma_connexion,$sql);
                while($row=mysqli_fetch_assoc($query))
                {
                  ?>
                  <option value="<?php echo $row['CODE_DEBOUCHE_FOR'];?>"><?php echo $row['DEBOUCHE_FOR']; ?></option>
                  <?php
                }
                ?>
              </select>                        
        </div>
        <div style="display: inline"><br></div> 
        <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-default btn-lg btn-block"><i class="fa fa-search" name="recherche"></i> Recherche avancée </button>
            </div>
        <div class="col-md-3"></div>
        </div>
          <br/>
        </div>
         <br>
        </div>
        </form>





        <div class="box-header with-border">
              <h3 class="box-title">Resultats de la recherche :</h3>
            </div>

            <div class="box-body table-responsive no-padding">
        <table id="findresult" class="table table-hover">
        <thead>
          <tr>
            <th>Filière</th>
            <th>Université</th>
            <th>Etablissment</th>
          </tr>
        </thead>
        <tbody>
        
            <?php

            if(isset($_POST['universite']))
            {
              $sql="select F.NOM_FIL, U.NOM_UNIVERSITE,E.NOM_ETA
                  From etablissement E,universite U,filiere F,departement D
                  where U.CODE_UNIVERSITE=E.CODE_UNIVERSITE
                  and E.CODE_ETA=D.CODE_ETA
                  and D.CODE_DEPT=F.CODE_DEPT
                  and U.CODE_UNIVERSITE='".$_POST['universite']."';";
              $query1=mysqli_query($ma_connexion,$sql);
              if (!mysqli_query($ma_connexion,$sql))
              {
                die('ERROR; ' . mysqli_error($ma_connexion));
              }
              while($res=mysqli_fetch_assoc($query1))
              {
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$res['NOM_FIL'].'&amp">'.$res['NOM_FIL'].'</a></td>'; 
                echo '<td>'.$res['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$res['NOM_ETA'].'</td>';
                echo '</tr>';
              }
            }else{

            }
            if(isset($_POST['etablissement']) && !$_POST['etablissement']!=0)
            {
                $sql="select F.NOM_FIL, U.NOM_UNIVERSITE,E.NOM_ETA
                  From etablissement E,universite U,filiere F,departement D
                  where U.CODE_UNIVERSITE=E.CODE_UNIVERSITE
                  and E.CODE_ETA=D.CODE_ETA
                  and D.CODE_DEPT=F.CODE_DEPT
                  and E.CODE_ETA='".$_POST['CODE_ETA']."';";
              $query1=mysqli_query($ma_connexion,$sql);
              if (!mysqli_query($ma_connexion,$sql))
              {
                die('ERROR; ' . mysqli_error($ma_connexion));
              }
              while($res=mysqli_fetch_assoc($query1))
              {
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$res['NOM_FIL'].'&amp">'.$res['NOM_FIL'].'</a></td>'; 
                echo '<td>'.$res['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$res['NOM_ETA'].'</td>';
                echo '</tr>';
              }
            }else{

            }
            if(isset($_POST['discipline']))
            {
              $sql="select F.NOM_FIL, U.NOM_UNIVERSITE,E.NOM_ETA
                   From etablissement E,universite U,filiere F,departement D
                   where U.CODE_UNIVERSITE=E.CODE_UNIVERSITE
                   and E.CODE_ETA=D.CODE_ETA
                   and D.CODE_DEPT=F.CODE_DEPT
                   and F.CODE_FIL='".$_POST['discipline']."';";
              $query1=mysqli_query($ma_connexion,$sql);
              if (!mysqli_query($ma_connexion,$sql))
              {
                die('ERROR; ' . mysqli_error($ma_connexion));
              }
              while($res=mysqli_fetch_assoc($query1))
              {
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$res['NOM_FIL'].'&amp">'.$res['NOM_FIL'].'</a></td>';                 
                echo '<td>'.$res['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$res['NOM_ETA'].'</td>';
                echo '</tr>';
              }
            }else{

            }

             if(isset($_POST['type-formation']))
            {
               $sql="select F.NOM_FIL, U.NOM_UNIVERSITE,E.NOM_ETA
                  From etablissement E,universite U,filiere F,departement D
                  where U.CODE_UNIVERSITE=E.CODE_UNIVERSITE
                  and E.CODE_ETA=D.CODE_ETA
                  and D.CODE_DEPT=F.CODE_DEPT
                  and F.NATURE_DIPLOME='".$_POST['type-formation']."';";
              $query1=mysqli_query($ma_connexion,$sql);
              if (!mysqli_query($ma_connexion,$sql))
              {
                die('ERROR; ' . mysqli_error($ma_connexion));
              }
              while($res=mysqli_fetch_assoc($query1))
              {
                echo '<tr>';
                
                echo '<td><a href="descriptifauto.php?nomfilierer='.$res['NOM_FIL'].'&amp">'.$res['NOM_FIL'].'</a></td>'; 
                echo '<td>'.$res['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$res['NOM_ETA'].'</td>';
                echo '</tr>';
              }
            }else{

            }
        ?>

        <?php

if ( isset($_POST['rechercher1']))
{
            $rch1 = $_POST['text1'];

              $query = "select F.CODE_FIL as CODE_FIL,F.NOM_FIL AS test,U.NOM_UNIVERSITE AS test1,E.NOM_ETA AS test2
              from filiere F,diplomes B,filiere_diplomes FTB ,universite U,etablissement E,departement D
              where F.CODE_FIL=FTB.CODE_FIL 
              AND B.CODE_DIPLOME=FTB.CODE_DIPLOME 
              AND F.CODE_DEPT=D.CODE_DEPT 
              AND D.CODE_ETA=E.CODE_ETA 
              AND E.CODE_UNIVERSITE=U.CODE_UNIVERSITE 
              AND B.NOM_DIPLOME = '$rch1' " ;

              $result = mysqli_query($ma_connexion, $query); 
              if(mysqli_num_rows($result) > 0)  
                {  
               while($row = mysqli_fetch_array($result))  
                  { 
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$row['test'].'&amp">'.$row['test'].'</a></td>';       
                echo '<td>'.$row['test1'].'</td>';
                echo '<td>'.$row['test2'].'</td>';
                echo '</tr>';
                }
              }
}


if ( isset($_POST['rechercher1']))
{
            $rch1 = $_POST['text1'];

              $query = "SELECT F.CODE_FIL as CODE_FIL,F.NOM_FIL AS NOM_FIL,U.NOM_UNIVERSITE AS NOM_UNIVERSITE,E.NOM_ETA AS NOM_ETA  
              from filiere F,universite U,etablissement E,departement D
              WHERE F.CODE_DEPT=D.CODE_DEPT 
              AND D.CODE_ETA=E.CODE_ETA 
              AND E.CODE_UNIVERSITE=U.CODE_UNIVERSITE 
              AND NATURE_DIPLOME='$rch1' " ;

              $result = mysqli_query($ma_connexion, $query); 
              if(mysqli_num_rows($result) > 0)  
                {  
               while($row = mysqli_fetch_array($result))  
                  { 
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$row['NOM_FIL'].'&amp">'.$row['NOM_FIL'].'</a></td>'; 
                echo '<td>'.$row['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$row['NOM_ETA'].'</td>';
                echo '</tr>';
                }
              }
}

if ( isset($_POST['rechercher1']))
{
            $rch1 = $_POST['text1'];

              $query = "SELECT F.CODE_FIL as CODE_FIL,F.NOM_FIL AS NOM_FIL,U.NOM_UNIVERSITE AS NOM_UNIVERSITE,E.NOM_ETA AS NOM_ETA  
              from filiere F,departement D,etablissement E,universite U,ville V 
              where F.CODE_DEPT=D.CODE_DEPT 
              AND D.CODE_ETA=E.CODE_ETA 
              AND E.CODE_UNIVERSITE=U.CODE_UNIVERSITE 
              AND U.CODE_VILLE=V.CODE_VILLE 
              AND V.NOM_VILLE='$rch1' ";

              $result = mysqli_query($ma_connexion, $query); 
              if(mysqli_num_rows($result) > 0)  
                {
               while($row = mysqli_fetch_array($result))  
                  { 
                echo '<tr>';
                echo '<td><a href="descriptifauto.php?nomfilierer='.$row['NOM_FIL'].'&amp">'.$row['NOM_FIL'].'</a></td>'; 
                echo '<td>'.$row['NOM_UNIVERSITE'].'</td>';
                echo '<td>'.$row['NOM_ETA'].'</td>';
                echo '</tr>';
                }
                }
}
              
?>


        </tbody>
      </table>
    </div>




</div>
</div>

    </div>



        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 3.0.0
      </div>
      <strong>Copyright &copy; 2017-2018<a href="http://www.facebook.com/mohammeddib3">DAL</a>.</strong>All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/jquery-ui.js"></script>
<script type="text/javascript">
      $(document).ready(function()
      {
        $(".btn-rechrche-hide").collapse('show');
        $(".rech_ava").hide();
        
        $(".btn-hide-toggle").click(function(){
          $(".collapse").collapse('toggle');
          $(".btn-rechrche-hide").collapse('toggle');
          $("#tag").val("");
          $(".rech_ava").show();
        });
        $('#findresult').DataTable({
        "language":{
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Recherche&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
              "sFirst":      "Premier",
              "sPrevious":   "Pr&eacute;c&eacute;dent",
              "sNext":       "Suivant",
              "sLast":       "Dernier"
            },
            "oAria": {
              "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
              "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
          }
        });
        $("#ville").change(function()
        {
          var id=$(this).val();
          
          var dataString = 'id='+ id;
          $.ajax
          ({
            type: "POST",
            url: "get_universite.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#universite").html(html);
              
            }
          });
        });
        $("#universite").change(function()
        {
          var id=$(this).val();
          var dataString = 'id='+ id;
          $.ajax
          ({
            type: "POST",
            url: "get_etablissement.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#etablissement").html(html);
            }
          });
        });

      });
    </script>
    <script>
 $(document).ready(function(){  
      $('#text1').keyup(function(){  
           var query = $(this).val();  
           if(query != "")  
           {  
                $.ajax({  
                     url:"search.php",
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#NomList').fadeIn();  
                          $('#NomList').html(data);  
                     }  
                });  
           }  
           else{
            $('#NomList').fadeIn("");  
            $('#NomList').html(""); 
           }
      });  
      $(document).on('click', 'li', function(){  
           $('#text1').val($(this).text());  
           $('#NomList').fadeOut();  
      });  
 });
 </script> 
</body>
</html>
