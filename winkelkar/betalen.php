<?php
require('../config.php');
require_once ('../databank.php');

$bestelbon_id = NULL;

if (isset($_SESSION['WINKELKAR']) && isset($_SESSION['KlantID']) && isset($_POST['betalen']))
{
    $klant_id = $_SESSION['KlantID'];
    $status = 1; // Status: Nieuwe bestelling
    $sql = "INSERT INTO tblbestelbons (tblklant_KlantID, status) VALUES ({$klant_id},{$status})";

    try {
        if ($dbh->query($sql) === TRUE) {

        }
    } catch (PDOException $e) {
        echo 'Registratie bestelbon mislukt: ' . $e->getMessage();
    }

    $bestelbon_id = $dbh->lastInsertId();
    $sql = "INSERT INTO tblbestelbons_tblproduct (tblbestelbons_id, tblproduct_ProductID, aantal, eenheidsprijs) VALUES ";

    // -- Let's do some magic :)
    $iterator = new ArrayIterator( $_SESSION['WINKELKAR']);
    while($iterator->valid())
    {
        $currentItem = $iterator->current();
        $sql .='(' . $bestelbon_id . ',' . $currentItem['ProductID'] . ',' . $currentItem['Aantal'] . ',' . 0 . ')'; // Ik hou nu even geen rekening met de prijs, daarom op 0 gezet.
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