<?php
require( '../../config.php' );
require_once '../../databank.php';

$fout = '';
$status_success = false;
if( !$_SESSION['IS_ADMIN'] )
{
    /*  Deze pagina mag enkel getoond worden aan beheerders */

    $fout = 'U heeft geen toegang tot deze module!';
}

if(isset($_POST['BestelstatusChange']) || isset($_POST['bestelbon_id']))
{
    $sql = "UPDATE tblbestelbons SET status = {$_POST['BestelstatusChange']} WHERE id = {$_POST['bestelbon_id']}";

    try {
//        $dbh->query($sql);
        if ($dbh->query($sql) === TRUE) {
            echo "Record updated successfully";
            $status_success = true;
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

$bestelbon_id = $_GET['bestelbon_id'];

//connectie
// Bestelbon ophalen uit database, samen met bestelbon details
$sql = "SELECT tblbestelbons.id AS bestelbon_id, tblbestelbons.tblklant_KlantID AS KlantID, tblbestelbons.besteldatum, tblbestelstatus.status AS bestelstatus_naam, tblbestelstatus.id AS bestelstatus_id FROM tblbestelbons
        INNER JOIN tblbestelstatus ON tblbestelstatus.id = tblbestelbons.status
        WHERE tblbestelbons.id = {$bestelbon_id}";
$bestelbon = $dbh->query($sql);

$sql = "SELECT tblproduct_ProductID, Gamenaam, aantal, eenheidsprijs, aantal*eenheidsprijs AS subtotaal FROM tblbestelbons_tblproduct
        INNER JOIN tblproduct ON tblproduct.ProductID = tblbestelbons_tblproduct.tblproduct_ProductID
        WHERE tblbestelbons_id = {$bestelbon_id}";
$bestelbonContent = $dbh->query($sql);

$sql = "SELECT tblbestelstatus.id, tblbestelstatus.status FROM tblbestelstatus";
$bestelstatussen = $dbh->query($sql);

$bestelgegevens = $bestelbon->fetchAll()[0];

$sql = "SELECT * FROM tblklant WHERE KlantID = {$bestelgegevens['KlantID']}";
$levergegevens = $dbh->query($sql);

$levergegevens = $levergegevens->fetchAll()[0];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Beheer bestelling</title>
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
<body>
<?php $page=''; require( SITE_DIR.'/Includes/navbar.php' ); ?>

<main class="container categorielijst">
    <div class="row">
        <div class="col-6">
        <h4>Bon gegevens:</h4><br>
        <p>Bestelbon ID: <?php echo $bestelgegevens['bestelbon_id']; ?><br>
            Besteldatum:  <?php echo $bestelgegevens['besteldatum']; ?><br>
            Bestelstatus:

            <form method="POST" action="detail.php?bestelbon_id=<?php echo $bestelgegevens['bestelbon_id']; ?>">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04" name="BestelstatusChange" aria-label="Example select with button addon">
                        <?php
                            foreach($bestelstatussen as $bestelstatus){
                                $selected = $bestelstatus['id'] == $bestelgegevens['bestelstatus_id'] ? "selected" : "";
                                echo "<option {$selected} value={$bestelstatus['id']}>{$bestelstatus['status']}</option>";
                            }
                        ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Bewaar nieuwe bestelstatus</button>
                    </div>
                </div>
                <input type="hidden" id="bestelbon_id" name="bestelbon_id" value="<?php echo $bestelgegevens['bestelbon_id']; ?>">
            </form>

        </div>
        <div class="col-6">
            <h4>Klanten gegevens:</h4>
            <p>Klant ID: <?php echo $levergegevens['KlantID']; ?><br>
            Klant Naam:  <?php echo $levergegevens['Naam']; ?><br>
            Tel. Nummer: <?php echo $levergegevens['Telefoonnummer']; ?><br>
            Leveringsadres:</p>
            <b><?php echo $levergegevens['Adres']; ?><br><?php echo $levergegevens['Postcode']; ?> <?php echo $levergegevens['Gemeente']; ?><br><br></b>
        </div>
    </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <table id="overzichtTabel" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th>Artikel nummer</th>
                    <th>Naam product</th>
                    <th>Aantal besteld</th>
                    <th>Eenheidsprijs</th>
                    <th>Subtotaal</th>
                </tr>
                </thead>
                <?php

                $totaal = 0;
                foreach ($bestelbonContent as $besteldetail) {
                    ?>
                    <tr>
                        <td><?php echo $besteldetail['tblproduct_ProductID']; ?></td>
                        <td><?php echo $besteldetail['Gamenaam']; ?></td>
                        <td><?php echo $besteldetail['aantal']; ?></td>
                        <td><?php echo $besteldetail['eenheidsprijs']; ?> EUR</td>
                        <td><?php echo $besteldetail['subtotaal']; ?> EUR</td>
                    </tr>
                    <?php
                    $totaal+= $besteldetail['subtotaal'];
                }
                ?>
            </table>
        </div>
        <div class="row">
            <div class="col-12">
                <h5>Totaalbedrag: <?php echo $totaal; ?> EUR</h5><br>
            </div>
            <div>
                <a class="btn btn-info" href="<?php echo SITE_URL; ?>/admin/bestellingen/index.php">Terug</a>
            </div>
        </div>
    </div>
</main>

</body>
</html>