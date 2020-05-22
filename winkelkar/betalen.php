<?php
require('../config.php');
require_once ('../databank.php');

$bestelbon_id = NULL;

var_dump($_POST);
//die();

if (isset($_SESSION['WINKELKAR']) && isset($_SESSION['KlantID']) && isset($_POST['betalen']))
{
    $klant_id = $_SESSION['KlantID'];
    $status = 1; // Status: Nieuwe bestelling
    $korting_totaal = $_SESSION['KORTING'];
    $sql = "INSERT INTO tblbestelbons (tblklant_KlantID, status, korting_totaal) VALUES ({$klant_id},{$status},{$korting_totaal})";

    try {
        if ($dbh->query($sql) === TRUE) {

        }
    } catch (PDOException $e) {
        echo 'Registratie bestelbon mislukt: ' . $e->getMessage();
    }

    $bestelbon_id = $dbh->lastInsertId();

    // Leveringsadres gegevens bewaren in tabel tblleveringsadressen
    $sql = "INSERT INTO tblleveringsadressen (tblbestelbons_id, naam, adres1, adres2, land, gemeente, postcode, betaalmethode, naamkaart, kaartnr, vervaldatum, cvc) VALUES (:id,:naam,:adres1,:adres2,:gekozenland,:gemeente,:postcode,:betaalmethode,:naamkaart,:kaartnr,:vervaldatum,:cvc)";

    $result = $dbh->prepare($sql);
    $result->bindParam(':id', $bestelbon_id);
    $result->bindParam(':naam', $_POST['naam']);
    $result->bindParam(':adres1', $_POST['adres']);
    $result->bindParam(':adres2', $_POST['adres2']);
    $result->bindParam(':gekozenland', $_POST['gekozenland']);
    $result->bindParam(':gemeente', $_POST['gemeente']);
    $result->bindParam(':postcode', $_POST['postcode']);
    $result->bindParam(':betaalmethode', $_POST['gekozenbetaalmiddel']);
    $result->bindParam(':naamkaart', $_POST['naamkaart']);
    $result->bindParam(':kaartnr', $_POST['kaartnr']);
    $result->bindParam(':vervaldatum', $_POST['vervaldatum']);
    $result->bindParam(':cvc', $_POST['CVC']);

    try {
        if ($result->execute() === TRUE) {
//            printf("Aantal rijen toegevoegd: %d\n", $result->rowCount());
        }
    } catch (PDOException $e) {
        echo 'Registratie leveringsadres is mislukt: ' . $e->getMessage();
    }

    $sql = "INSERT INTO tblbestelbons_tblproduct (tblbestelbons_id, tblproduct_ProductID, aantal, eenheidsprijs) VALUES ";

    try
    {
        $db_prices = new PDO( DB_CONNECTION, DB_USERNAME, DB_PASSWORD );
        $db_prices->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        echo '<p>Kan geen connectie maken met databank.</p><code>'.$e->getMessage().'</code>';
        die();
    }

    // -- Let's do some magic :)
    $iterator = new ArrayIterator( $_SESSION['WINKELKAR']);
    while($iterator->valid())
    {
        $currentItem = $iterator->current();

        $sql_prices = "SELECT ProductID, ProductPrijs FROM tblproduct WHERE ProductID= {$currentItem['ProductID']}";
        $product = $db_prices->query($sql_prices)->fetch();
        $eenheidsprijs = $product['ProductPrijs'];

        $sql .='(' . $bestelbon_id . ',' . $currentItem['ProductID'] . ',' . $currentItem['Aantal'] . ',' . $eenheidsprijs . ')'; // Prijs = subtotaal per item
        $iterator->next();
        $sql .= $iterator->key() ? ',' : ';';
    }

    try {
        if ($dbh->query($sql) === TRUE) {
//            header('location:' . SITE_URL . '/inlog/aanmelden.php');
        }
    } catch (PDOException $e) {
        echo 'Registeren van bestelling details mislukt: ' . $e->getMessage();
    }

    $_SESSION['ALERT_CODE'] = 'SUCCES';
    $_SESSION['ALERT_BODY'] = 'Bestelling voltooid!';
    $_SESSION['WINKELKAR'] = array();
    header( 'location:'.SITE_URL.'/inlog/aanmelden.php' );
}
?>