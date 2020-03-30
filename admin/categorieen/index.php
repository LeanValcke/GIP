<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
//connectie
$sql = "SELECT GameID, Gamenaam FROM tblgameafdeling";
$categoriebeheer = $dbh->query($sql);
?>


<html>
<head>
  <title>Categorieën</title>
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
          <th>GameID</th>
          <th>Naam</th>
          <th>&nbsp;</th>
        </tr>
        </thead>
        <?php

        foreach ($categoriebeheer as $categorieen) {
          ?>
          <tr>
            <td><?php echo $categorieen['GameID']; ?></td>
            <td><?php echo $categorieen['Gamenaam']; ?></td>
          </tr>
          <?php
        }
        ?>

        <!--                        --><?php //
        //                                                          }
        //                        ?>
      </table>
    </div>

    <?php
    function pre_r($array)
    {
      echo '<pre>';
      print_r($array);
      echo '<pre>';
    }

    ?>
  </div>
</main>
</body>
</html>