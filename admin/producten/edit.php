<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
//connectie
//$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving FROM tblproduct";
//$productlijst = $dbh->query($sql);
$productid = NULL;
$data = [
    'id' => NULL,
    'prijs' => NULL,
    'gamenaam' => NULL,
    'merchnaam' => NULL,
    'foto' => NULL,
    'beschrijving' => NULL
];
$recordsaved = FALSE;

var_dump($_POST);

if(isset($_POST['succes']) || isset($_POST['annuleren'])){
    $location = SITE_URL.'/admin/producten/index.php';
    header( 'location:' . $location );
}
elseif(isset($_POST['edit']) && isset($_POST['productid'])) // Gegevens ophalen om de formulier te pré-fillen op basis van productid
{
    $productid = intval($_POST ['productid']);

    $sql = "SELECT tblproduct.ProductID AS id, tblproduct.ProductPrijs AS prijs, tblproduct.Gamenaam AS gamenaam, tblproduct.Merchnaam AS merchnaam, tblproduct.foto, tblproduct.Beschrijving AS beschrijving
            FROM tblproduct
            WHERE ProductID = {$productid}";
    $record = $dbh->query($sql);

    // Record ophalen uit database
    $data = $record->fetch();

    if($data){
//        var_dump($data);
    } else {
        echo "Error 404 - Geen product gevonden met deze naam";
        die();
    }
}
elseif(isset($_POST['saveform']) && isset($_POST['productid'])) { // Bewaren na editen bestaand product (heeft een productid)

    var_dump("Updaten formulier");

    $productid = [$_POST['productid']];

    // Get POST data
    var_dump($_POST);
    die();

    $sql ="UPDATE tblproduct 
           SET status = {$_POST['BestelstatusChange']} 
           WHERE id = {$productid}";

    var_dump($_POST);
    var_dump($_GET);
    die();

//    $recordsaved = true; // indien saven is gelukt...
}
elseif(isset($_POST['saveform']) && $productid == NULL){ // Saven nieuw product (heeft initieel geen productid)

    var_dump("Bewaren formulier - nieuwe record");

//  $sql = $sql = "INSERT INTO tblproduct (tblklant_KlantID, status) VALUES ({$klant_id},{$status})";

//    $recordsaved = true; // indien saven is gelukt...
}
else
{
  // Nieuw record invoeren

}


?>


<html>
<head>
  <title>Producten</title>
  <link rel="icon" href="../img/Icon/DVP.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="img/favicon.ico" rel="shortcut icon"/>

  <!-- Google font -->
  <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
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
<?php $page = '';
//require(SITE_DIR . '/Includes/navbar.php'); ?>

<!---->
<!--        --><?php //} } ?>

<main class="container klantenlijst">
  <div class="row mt-3">
    <div class="col-12">
      <form method="post" action="edit.php">

        <?php if(isset($data['id'])) { ?>
          <div class="form-group">
            <label for="id">Product ID</label>
            <input type="text" disabled class="form-control" id="id" name="id" aria-describedby="id" value="<?php echo $data['id'];?>">
          </div>
        <?php } ?>

        <div class="form-group">
          <label for="gamenaam">Gamenaam</label>
          <input type="text" class="form-control" id="gamenaam" name="gamenaam" placeholder="Gamenaam" value="<?php echo $data['gamenaam'];?>">
        </div>

        <div class="form-group">
          <label for="prijs">Prijs (€uro)</label>
          <input type="text" class="form-control" id="prijs" name="prijs" placeholder="Prijs" value="<?php echo $data['prijs'];?>">
        </div>

        <div class="form-group">
          <label for="merchnaam">Merchandising naam</label>
          <input type="text" class="form-control" id="merchnaam" name="merchnaam" placeholder="Merchandising naam" value="<?php echo $data['merchnaam'];?>">
        </div>

<!--        <div class="form-group">-->
<!--          <label for="foto">Merchandising naam</label>-->
<!--          <input type="" class="form-control" id="merchnaam" placeholder="Merchandising naam" value="--><?php //echo $data['merchnaam'];?><!--">-->
<!--        </div>-->

        <div class="form-group">
          <label for="beschrijving">Beschrijving</label>
          <textarea class="form-control" id="beschrijving" name="beschrijving" rows="3"><?php echo $data['beschrijving'];?></textarea>
        </div>

        <button class="btn btn-info" name="saveform" value="true">Bewaren</button>

        <?php if($recordsaved){ ?>
          <button class="btn btn-info" name="succes" value="true">Terug naar overzicht</button>
        <?php } else { ?>
          <button class="btn btn-info" name="annuleren" value="true">Annuleren</button>
        <?php } ?>

      </form>

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