<?php
require('../../config.php');
require_once '../../databank.php';

//connectie
// Bestelbon nummer, Klanten nummer, Klanten naam, besteldatum en manueel klikbare link naar bestelling details maken
$sql = "SELECT tblbestelbons.id, tblklant_KlantID, tblklant.Naam, tblbestelbons.besteldatum, tblbestelstatus.status FROM tblbestelbons
        INNER JOIN tblklant ON tblbestelbons.tblklant_KlantID = tblklant.KlantID
        INNER JOIN tblbestelstatus ON tblbestelstatus.id = tblbestelbons.status";
$overzichtbestelbons = $dbh->query($sql);
?>

<html>
<head>
  <title>Overzicht Bestellingen</title>
  <link rel="icon" href="../img/Icon/DVP.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="img/favicon.ico" rel="shortcut icon"/>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../../css/owl.carousel.min.css"/>
  <link rel="stylesheet" href="../../css/flaticon.css"/>
  <link rel="stylesheet" href="../../css/slicknav.min.css"/>
  <link rel="stylesheet" href="../../css/style.css"/>

  <script src="../../js/jquery-3.2.1.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/jquery.slicknav.min.js"></script>
  <script src="../../js/owl.carousel.min.js"></script>
  <script src="../../js/jquery-ui.min.js"></script>
  <script src="../../js/main.js"></script>

</head>
<body style="background-color:white;">
        <?php $page=''; require( SITE_DIR.'/Includes/navbar.php' ); ?>

<!---->
<!--        --><?php //} } ?>

<main class="container categorielijst">
  <div class="row mt-3">
    <div class="col-12">
      <table id="overzichtTabel" class="table table-striped table-bordered" style="width:100%;">
        <thead>
        <tr>
          <th>Bestelbon nummer</th>
          <th>Klanten nummer</th>
          <th>Naam klant</th>
          <th>Tijdstip bestelling</th>
          <th>Status</th>
          <th></th>
        </tr>
        </thead>
        <?php

        foreach ($overzichtbestelbons as $bestelbon) {
          ?>
          <tr>
              <td><?php echo $bestelbon['id']; ?></td>
              <td><?php echo $bestelbon['tblklant_KlantID']; ?></td>
              <td><?php echo $bestelbon['Naam']; ?></td>
              <td><?php echo $bestelbon['besteldatum']; ?></td>
              <td><?php echo $bestelbon['status']; ?></td>
              <td><button class="btn btn-danger"><a href=detail.php?bestelbon_id=<?php echo $bestelbon['id'] ?>>Details</a></button></td>
          </tr>
          <?php
        }
        ?>

        <!--                        --><?php //
        //                                                          }
        //                        ?>
      </table>
    </div>

  </div>
</main>
</body>
</html>
