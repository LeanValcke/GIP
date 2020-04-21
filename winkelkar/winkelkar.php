<?php require('../config.php');

$maat = $_SESSION['Maat'];
$_SESSION['Maat'] = "";
$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto FROM tblproduct";

$merchproducten = $dbh->query($sql);

?>

<html>
<head>
    <title>Winkelkar</title>
    <link rel="icon" href="../img/Icon/DVP.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="img/favicon.ico" rel="shortcut icon"/>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
          rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="../css/flaticon.css"/>
    <link rel="stylesheet" href="../css/slicknav.min.css"/>
    <link rel="stylesheet" href="../css/fontawesome.all.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.slicknav.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/main.js"></script>

    <?php
    $producten = array();
    $totaal = 0;

    $sql = " SELECT ProductID, Merchnaam,ProductPrijs, foto FROM tblproduct WHERE ProductID=:prodId";
    $statement = $dbh->prepare($sql);

    $winkelkar = $_SESSION['WINKELKAR'];

    foreach ($winkelkar as $artikel) {
        $Aantal = $artikel['Aantal'];
        $Maat = $artikel['Maat'];
        if ($Aantal > 0) {

            $statement->bindValue(':prodId', $artikel['ProductID']);
            $statement->execute();
            $product = $statement->fetch();
            $product['PROD_Maat'] = $Maat;
            $product['PROD_Aantal'] = $Aantal;
            $product['PROD_TOTAAL'] = $Aantal * $product['ProductPrijs'];

            $producten[] = $product;

            $totaal += $product['PROD_TOTAAL'];
        }
    }
    ?>
</head>

<body>
<?php
$page = 'winkelkar';
require('../Includes/navbar.php');
?>

<div class="midden">

    <div class="winkelkar">
        <table>
            <?php
            if ($totaal >= 1) { ?>
                <tr>
                    <th id="foto-td"></th>
                    <th id="naam-td">Naam</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Totaal</th>
                </tr>
            <?php } ?>
            <?php


            foreach ($producten as $product) {
                ?>
                <tr>
                    <td id="foto-td"><img src="  <?php echo(SITE_URL); ?>/img/<?php echo $product['foto'] ?>"></td>
                    <td id="naam-td"> <?php echo $product['PROD_Maat'] . ' ' . $product['Merchnaam'] ?> </td>
                    <td>
                        &euro; <?php echo $product['ProductPrijs']; ?>
                    </td>
                    <?php $code = $product["ProductID"] . $product["PROD_Maat"]; ?>
                    <td><?php echo $product['PROD_Aantal'] ?></td>
                    <td>&euro; <?php echo $product['PROD_TOTAAL'] ?></td>
                    <td id="kleiner-td">
                        <a style="padding:0px 7px 0px 7px" class="winkelkar-zwartbutton" role="button"
                           href="<?php echo SITE_URL ?>/winkelkar/verwijderen.php?ProductID=<?php echo $code ?>">-</a>
                    </td>

                    <td id="kleiner-td">
                        <a style="padding:0px 5px 0px 5px" class="winkelkar-rodebutton" role="button"
                           href="<?php echo SITE_URL ?>/winkelkar/toevoegen.php?ProductID=<?php echo $code ?>">+</a>
                    </td>
                </tr>
            <?php }

            ?>
        </table>
    </div>
    <?php
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

    $sql = "SELECT ProductID, Merchnaam, foto FROM tblproduct order by ProductID desc limit 2";
    $promos = $dbh->query($sql);

    if ($totaal >= 1) {
        ?>
        <div class="totaalwinkelkar">
            <div class="totaalwinkelkar-grid">

                <h2>Totaal te betalen</h2>
                <table>

                    <tr>
                        <th>Subtotaal</th>
                        <td>&euro;<?php echo $totaal ?></td>
                    </tr>

                    <tr>
                        <th>Korting</th>
                        <td class="<?php echo $kortingnaam ?> ">&euro;<?php echo $kortingbedrag; ?></td>
                    </tr>
                    <tr>
                        <th>Totaal</th>
                        <td>&euro;<?php echo $totaalbedrag ?></td>
                    </tr>
                </table>

                <form action="checkoutIngelogd.php" method="post">
                    <button name="doorgaanbetalen"
                            style=" height:70px; font-size:20px;  background-color: red; border-color: red "
                            type="submit" class="btn btn-md btn-success"><strong>
                            Doorgaan naar betalen</strong>
                    </button>
                </form>

                <form action="checkoutIngelogd.php" method="GET">
                    <button name="doorgaanbetalen"
                            style=" height:70px; font-size:20px;  background-color: red; border-color: red "
                            type="submit" class="btn btn-md btn-success"><strong>
                            Verder winkelen</strong>
                    </button>
                </form>

                <h2>Populaire producten</h2>
                <div class="promotabel">


                    <a href="<?php echo(SITE_URL); ?>/merch/merchpagina.php?ProductID=1">
                        <img src="../img/merch/CODMokZwart.png">
                    </a>

                    <a href="<?php echo(SITE_URL); ?>/merch/merchpagina.php?ProductID=1">
                        <img src="../img/merch/OverwatchGame.jpg">
                    </a>


                </div>
            </div>
        </div>
    <?php }
    if ($totaal <= 0) { ?>
        <main class="container">
            <div class="row" style="width:100%;">
                <div class="col-3"></div>
                <div class="alert alert-success col-6" role="alert" style="background-color:red;  color:white;">
                    <h5 class="alert-heading">Winkelmand is leeg!</h5>
                    <hr>
                    U heeft nog niets toegevoegd in uw winkelmand.
                </div>
            </div>
        </main>
    <?php } ?>
</div>

<script src="../js/main.js"></script>

