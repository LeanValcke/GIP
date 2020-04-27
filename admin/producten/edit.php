<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
// Initialiseren variabelen voor form zonder data
$productid = NULL;
$data = [
    'id' => NULL,
    'prijs' => NULL,
    'gamenaam' => NULL,
    'merchnaam' => NULL,
    'foto' => NULL,
    'beschrijving' => NULL,
    'gameid' => 0,
];
$gameafdelingen = array();
$recordsaved = FALSE; // Wordt TRUE als bij reload een record werd gesaved (voor notificatie in html)

// Data ophalen voor drop-down
$sql = "SELECT tblgameafdeling.GameID AS gameid, tblgameafdeling.Gamenaam AS gamenaam FROM tblgameafdeling";
$record = $dbh->query($sql);
$gameafdelingen = $record->fetchAll();

var_dump($_POST);

// Ingevoerde data valideren
function validateInputData(array $input)
{
    $check = FALSE;

    $data['id'] = test_input($_POST['productid']);
    $data['prijs'] = test_input($_POST['prijs']);
    $data['gamenaam'] = test_input($_POST['gamenaam']);
    $data['merchnaam'] = test_input($_POST['merchnaam']);
    $data['gameid'] = test_input($_POST['gameid']);
    $data['beschrijving'] = test_input($_POST['beschrijving']);

    if ($check) {
        return true;
    } else {
        return false;
    }

}

// Safety input check van elke input bij validatie
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// CRUD checks
if (isset($_POST['succes']) || isset($_POST['annuleren'])) {
    $location = SITE_URL . '/admin/producten/index.php';
    header('location:' . $location);
} elseif (isset($_POST['edit']) && isset($_POST['productid'])) // Gegevens ophalen om de formulier te pré-fillen op basis van productid
{
    $productid = intval($_POST ['productid']);

    $sql = "SELECT tblproduct.ProductID AS id, tblproduct.ProductPrijs AS prijs, tblproduct.Gamenaam AS gamenaam, tblproduct.Merchnaam AS merchnaam, tblproduct.foto, tblproduct.Beschrijving as beschrijving, tblproduct.GameID AS gameid
            FROM tblproduct
            WHERE ProductID = {$productid}";
    $record = $dbh->query($sql);

    // Record ophalen uit database
    $data = $record->fetch();

    if ($data) {
        var_dump($data);
    } else {
        echo "Error 404 - Geen product gevonden met deze naam";
        die();
    }
} elseif (isset($_POST['saveform']) && isset($_POST['productid'])) { // Bewaren na editen bestaand product (heeft een productid)
    var_dump("Updaten formulier");

    $productid = [$_POST['productid']];

    $recordsaved = TRUE; // indien saven is gelukt...
    var_dump($recordsaved);

    if (validateInputData($data)) {
        echo "Validation check ok!";
        var_dump($data);
//        $sql = "UPDATE tblproduct
//           SET status = {$_POST['BestelstatusChange']}
//           WHERE id = {$productid}";

        $recordsaved = TRUE; // indien saven is gelukt...
//        die();

    } else {

    };


} elseif (isset($_POST['saveform']) && !isset($_POST['productid'])) { // Saven nieuw product (heeft initieel geen productid)
    var_dump("Bewaren formulier - nieuwe record");

    if (validateInputData($data)) {
        var_dump($data);
        echo "Validation check ok!";
//        $sql = "UPDATE tblproduct
//           SET status = {$_POST['BestelstatusChange']}
//           WHERE id = {$productid}";


        $recordsaved = FALSE; // save is gelukt...
//        die();
    } else {

    }
//  $sql = $sql = "INSERT INTO tblproduct (tblklant_KlantID, status) VALUES ({$klant_id},{$status})";


} else {
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
//require(SITE_DIR . '/Includes/navbar.php');
?>

<!---->
<!--        --><?php //} }
?>

<main class="container klantenlijst">
  <div class="row mt-3">
    <div class="col-12">
      <form method="post" action="edit.php">

          <?php if (isset($data['id'])) { ?>
            <div class="form-group">
              <label for="productid">Product ID</label>
              <input type="text" disabled class="form-control" id="productid" name="productid"
                     aria-describedby="productid"
                     value="<?php echo $data['id']; ?>">
            </div>
          <?php } ?>

        <div class="form-group">
          <label for="gamenaam">Gamenaam</label>
          <input type="text" class="form-control" id="gamenaam" name="gamenaam" placeholder="Gamenaam"
                 value="<?php echo $data['gamenaam']; ?>">
        </div>

        <div class="form-group">
          <label for="prijs">Prijs (€uro)</label>
          <input type="text" class="form-control" id="prijs" name="prijs" placeholder="Prijs"
                 value="<?php echo $data['prijs']; ?>">
        </div>

        <div class="form-group">
          <label for="merchnaam">Merchandising naam</label>
          <input type="text" class="form-control" id="merchnaam" name="merchnaam" placeholder="Merchandising naam"
                 value="<?php echo $data['merchnaam']; ?>">
        </div>

        <div class="form-group">
          <label for="gameid">Game Afdeling</label>
          <select class="custom-select" id="gameid" name="gameid" aria-label="Game id">
            <option <?php $data["gameid"] == 0 ? "selected" : "" ?> value="0">Selecteer game afdeling</option>
              <?php foreach ($gameafdelingen as $gameafdeling) {
                  $selected = $gameafdeling['gameid'] == $data['gameid'] ? "selected" : "";
                  echo "<option {$selected} value='{$gameafdeling['gameid']}'> {$gameafdeling['gamenaam']}</option>";
              } ?>
          </select>
        </div>

        <!--        <div class="form-group">-->
        <!--          <label for="foto">Merchandising naam</label>-->
        <!--          <input type="" class="form-control" id="merchnaam" placeholder="Merchandising naam" value="-->
          <?php //echo $data['merchnaam'];
          ?><!--">-->
        <!--        </div>-->

        <div class="form-group">
          <label for="beschrijving">Beschrijving</label>
          <textarea class="form-control" id="beschrijving" name="beschrijving"
                    rows="3"><?php echo $data['beschrijving']; ?></textarea>
        </div>

        <button class="btn btn-info" name="saveform" value="true">Bewaren</button>

          <?php if ($recordsaved) { ?>
            <button class="btn btn-info" name="succes" value="true">Terug naar overzicht</button>
          <?php } else { ?>
            <button class="btn btn-info" name="annuleren" value="true">Annuleren</button>
          <?php } ?>
      </form>
    </div>
    <div class="col-12">
      <?php if($recordsaved) { ?>
        <div class="alert alert-success" role="alert">
          Gegevens zijn succesvol bewaard!
        </div>
      <?php } ?>
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
<script>
    // Form fields die "disabled" staan, worden niet gepost. Dit is een workaround.
    $('form').submit(function (e) {
        $(':disabled').each(function (e) {
            $(this).removeAttr('disabled');
        })
    });
</script>