<?php
require('../config.php');


if ($_SESSION['LOGIN_OK'] == true) {
    header('location:' . SITE_URL . '/winkelkar/checkout.php');
} else if ($_SESSION['LOGIN_OK'] == false) {
    header('location:' . SITE_URL . '/inlog/aanmelden.php');
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_BODY'] = 'Je moet eerst inloggen voor je iets kan kopen!';
}
?>