<?php
require('../config.php');

//var_dump($_POST);
//var_dump($_SESSION);
//die();

?>
<html>
<head>
  <title>Checkout</title>
  <link rel="icon" href="../img/Icon/DVP.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="img/favicon.ico" rel="shortcut icon"/>


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css"/>
  <link rel="stylesheet" href="../css/owl.carousel.min.css"/>
  <link rel="stylesheet" href="../css/flaticon.css"/>
  <link rel="stylesheet" href="../css/slicknav.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>

  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.slicknav.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery-ui.min.js"></script>
  <script src="../js/main.js"></script>


</head>
<?php
$producten = array();
$totaal = 0;


$sql = "
        SELECT 
            ProductID, Merchnaam,ProductPrijs, foto
        FROM tblproduct
        WHERE ProductID=:prodId
       ";
$statement = $dbh->prepare($sql);

$winkelkar = $_SESSION['WINKELKAR'];


foreach ($winkelkar as $artikel) {
  $aantal = $artikel['AANTAL'];
  if ($aantal > 0) {

    $statement->bindValue(':prodId', $artikel['ProductID']);
    $statement->execute();
    $product = $statement->fetch();


    $product['PROD_AANTAL'] = $aantal;
    $product['PROD_TOTAAL'] = $aantal * $product['ProductPrijs'];
    $producten[] = $product;


    $totaal += $product['PROD_TOTAAL'];
  }
}
if ($totaal >= 100 && $totaal < 500) {
  $kortingnaam = 'vet';
  $korting = 0.05;
  $kortingbedrag = $totaal * $korting;
  $totaalbedrag = $totaal - $kortingbedrag;
}


if ($totaal >= 500) {
  $kortingnaam = 'vet';
  $korting = 0.10;
  $kortingbedrag = $totaal * $korting;
  $totaalbedrag = $totaal - $kortingbedrag;
}

if ($totaal < 100) {
  $kortingnaam = '';
  $korting = 0;
  $kortingbedrag = 0;
  $totaalbedrag = $totaal;
}

?>

<?php $page = 'inlog';
require('../Includes/navbar.php'); ?>


<body class="bg-light">

<div class="container">
  <div class="py-5 text-center">


    <p class="lead"></p>
  </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <a class="text-muted">Winkelmand</a>

      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed checkout-li" style="padding:0 0 0 0;">

          <table>
            <?php foreach ($producten

            as $product)
            {
            ?>
            <tr>
              <td>
                <?php echo $product['PROD_AANTAL'] . 'X' ?><?php echo $product['Merchnaam']; ?>
              </td>


              <th> &euro;<?php echo $product['PROD_TOTAAL'] ?>  </th>
              <?php } ?>

          </table>
        </li>


        <li class="list-group-item d-flex justify-content-between bg-light checkout-li"
            style="padding: 0px 0px 0px 0px;">
          <table>
            <td style="color:green;">Korting</td>

            <th>&euro;<?php echo $kortingbedrag ?></th>
          </table>
        </li>
        <li class="list-group-item d-flex justify-content-between checkout-li" style="padding: 0px 0px 0px 0px;">
          <table>
            <tr>
              <td>Totaal</td>
              <th>&euro;<?php echo $totaalbedrag ?></th>
            </tr>

          </table>


      </ul>


    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Factuur gegevens</h4>
      <form action="/inlog/bestellingdetail.php" method="post" class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-12 mb-8">
            <label for="Voornaam">Naam</label>
            <input type="text" class="form-control" id="Voornaam" name="voornaam"
                   value="<?php echo $_SESSION['Naam']; ?>" required>

          </div>

        </div>

        <div class="mb-3">
          <label for="Adres">Adres</label>
          <input type="text" class="form-control" id="Adres" name="adres" value="<?php echo $_SESSION['Adres']; ?>"
                 required>

        </div>

        <div class="mb-3">
          <label for="Adres2">Adres 2 <span class="text-muted">(Optioneel)</span></label>
          <input type="text" class="form-control" name="adres2" id="Adres2" placeholder="Appartment">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="Land">Land</label>
            <select class="custom-select d-block w-100" id="Land" name="land" required>
              <option selected value="1">België</option>
              <option value="2">Nederland</option>
            </select>

          </div>
          <div class="col-md-4 mb-3">
            <label for="Gemeente">Gemeente</label>
            <input type="text" class="form-control" id="Gemeente" name="gemeente"
                   value="<?php echo $_SESSION['Gemeente']; ?>" required>

          </div>
          <div class="col-md-3 mb-3">
            <label for="Postcode">Postcode</label>
            <input type="text" class="form-control" id="Postcode" name="postcode"
                   value="<?php echo $_SESSION['Postcode']; ?>" required>

          </div>
        </div>

        <h4 class="mb-3">Kies een betaalmethode</h4>
        <div class="row">
          <div class="col-md-5 mb-3">

            <select class="custom-select d-block w-100" name="betaalmethode" id="Betaalmethode" required>

              <option value="1">Kredietkaart</option>
              <option value="2" selected>Bancontact</option>
              <option value="3">PayPal</option>
            </select>
          </div>


        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Naam op de kaart</label>
            <input type="text" class="form-control" id="cc-name" name="naamkaart" placeholder="" value="Nicolas" required>


          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Kaartnummer</label>
            <input type="text" class="form-control" id="cc-number" name="kaartnummer" placeholder="" value="123456798" required>

          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-6">
            <label for="Vervaldatum">Vervaldatum</label>
            <input type="date" class="form-control datumveldkredietkaart" id="Vervaldatum" name="vervaldatum" placeholder="" value="" required>

          </div>
          <div class="col-md-6 mb-6">
            <label for="CVC">CVC</label>
            <input type="text" class="form-control" id="cvc" name="cvc" placeholder="" value="1235" required>

          </div>
        </div>
        <hr class="mb-4">


        <button style="background-color: red; border-color: red " class="btn btn-primary btn-lg btn-block"
                type="submit">Betalen
        </button>
      </form>
    </div>
  </div>


</div>
<script src="../js/main.js"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"
        integrity="sha256-ifihHN6L/pNU1ZQikrAb7CnyMBvisKG3SUAab0F3kVU=" crossorigin="anonymous"></script>
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict';

    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');

      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

</body>

</html>