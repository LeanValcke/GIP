<?php
require('../config.php');

if ($_POST['gekozenbetaalmiddel'] == "visible") {
    if ($_POST['CVC'] == "") {
        header('location:' . 'checkout.php');
        die();
    }

}
if (isset($_POST['betalen'])) {
    $_SESSION['ALERT_CODE'] = 'SUCCES';
    $_SESSION['ALERT_BODY'] = 'Bestelling voltooid!';
    $_SESSION['WINKELKAR'] = array();
    header('location:' . SITE_URL . '/inlog/aanmelden.php');
}

?>