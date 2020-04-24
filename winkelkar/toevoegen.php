<?php
require('../config.php');
$checkout = false;
$nietingelogd = false;
// -- Irrelevant: geen maat data gevonden, dus uitgeschakeld
//if ($_POST['GekozenMaat'] == "Maat kiezen") {
//    $_SESSION['ALERT_CODE'] = 'ERROR';
//    $_SESSION['ALERT_BODY'] = 'Je moet een maat selecteren';
//    header('location:' . SITE_URL . '/merch/merchpagina.php?ProductID=' . $_GET['ProductID']);
//    die();
//}
if (isset($_POST['Sub'])) {
    if ($_SESSION['LOGIN_OK'] == true) {
        $checkout = true;
    } else {
        $nietingelogd = true;
    }
}

// Een nieuw product werd geklikt om toe te voegen in de winkelwagen
if (isset($_GET['ProductID'])) {
    // Bestaande sessie-inhoud (eerdere toevoegingen winkelwagen) in variabele zetten
    $winkelkar = $_SESSION['WINKELKAR'];

    // Checken of het geselecteerde product in de bestaande winkelwagen reeds eens werd toegevoegd
    $reedsGeselecteerd = false;
    $artikelcode = $_GET['ProductID'];

    foreach ($winkelkar as $i => $artikel) {
        if ($artikel['artikelcode'] == $artikelcode) {
            $reedsGeselecteerd = true;
            $winkelkar[$i]['Aantal']++;
            // zie: https://stackoverflow.com/questions/15024616/php-foreach-change-original-array-values
        }
    }

    // Geselecteerde product bestaat nog niet in de winkelwagen, PUSH naar array
    if (!$reedsGeselecteerd) {
        $artikel = array();
        $artikel['Aantal'] = 1;
        $artikel['ProductID'] = $_GET['ProductID'];
        $artikel['Maat'] = $_POST['GekozenMaat'];
        $artikel['artikelcode'] = $artikel['ProductID'] . $artikel['Maat'];  //-- Dit lijkt me toch maar iets bizar...

        $winkelkar[] = $artikel;
    }

    // Bewaar sessie-gegevens
    $_SESSION['WINKELKAR'] = $winkelkar;

}
//
//var_dump($_SESSION);
//die();

if ($checkout == true) {
    header('location:' . 'checkout.php');
    die();
}
if ($nietingelogd == true) {
    header('location:' . SITE_URL . '/inlog/aanmelden.php');
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_BODY'] = 'Je moet eerst inloggen voor je iets kan kopen!';
} else {
    header('location:' . 'winkelkar.php');
}
?>