<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
//connectie
$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving FROM tblproduct";
$productlijst = $dbh->query($sql);
?>


<html>
<head>
  <title>Producten</title>
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
<body style="background-color:white;"> <div class="midden">
<?php $page='producten'; require( SITE_DIR.'/Includes/navbar.php' ); ?>
<?php if( $_SESSION['IS_ADMIN'] ) { ?>
                        <nav class="header-nav" style="background:black; color:white;" >
                    <a>BEHEER:</a>
                    <ul class="main-menu">
                        <li>
                            <a class="<?php if ($page=='Bestellingen'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/bestellingen/index.php">Bestellingen</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='gebruikers'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/gebruikers/index.php">Gebruikers</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='producten'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/producten/index.php">Producten</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='categorieën'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/categorieen/index.php">Categorieën</a>
                        </li>        
                    </ul>
                </nav>
                <?php } ?> 
<!---->
<!--        --><?php //} } ?>
    
<main class="container klantenlijst">
  <div class="row mt-3">
    <div class="col-12">
      <table id="overzichtTabel" class="table table-striped table-bordered" style="width:100%;">
        <thead>
        <tr>
          <th>ProductID</th>
          <th>ProductPrijs</th>
          <th>ProductAantal</th>
          <th>Gamenaam</th>
          <th>Merchnaam</th>
          <th>GameID</th>
          <th>Foto</th>
          <th>Beschrijving</th>
        </tr>
        </thead>
        <?php

        foreach ($productlijst as $product) {
          ?>
          <tr>
            <td><?php echo $product['ProductID']; ?></td>
            <td>€ <?php echo $product['ProductPrijs']; ?></td>
            <td><?php echo $product['ProductAantal']; ?> stuks</td>
            <td><?php echo $product['Gamenaam']; ?></td>
            <td><?php echo $product['Merchnaam']; ?></td>
            <td><?php echo $product['GameID']; ?></td>
            <td><img src="../../img/<?php echo $product['foto']; ?>" alt="<?php echo $product['foto']; ?>" height="62" width="62"></td>
            <td><?php echo $product['Beschrijving']; ?></td>
          </tr>
          <?php
        }
        ?>

      </table>

<!--      <div class="card" style="width: 18rem;">-->
<!--        <img src="..." class="card-img-top" alt="...">-->
<!--        <div class="card-body">-->
<!--          <h5 class="card-title">Card title</h5>-->
<!--          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--          <a href="#" class="btn btn-primary">Go somewhere</a>-->
<!--        </div>-->
<!--      </div>-->



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