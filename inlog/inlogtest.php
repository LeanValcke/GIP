<?php
require('../config.php');

var_dump($_POST);

if (isset($_POST['uitlogknop'])) {
    session_destroy();
//    var_dump($_SESSION);
    $location = SITE_URL . '/index.php';
    header('location:' . '../index.php');
}

if (isset($_POST['verzendknop']) && isset($_POST['ACTION'])) {
    if (isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord'])) {
        $gevonden = false;
        $login = $_POST['gebruikersnaam'];
        $gebruikersnaam = "";

        $sql = "SELECT KlantID, Gebruikersnaam, wachtwoord, Naam, Adres, Gemeente, Postcode, Admin, Telefoonnummer, Email FROM tblklant
                WHERE Gebruikersnaam = '{$login}'";

        $inloggen = $dbh->query($sql);
        $userdata = $inloggen->fetchAll();

        if (empty($userdata)) {
            echo "Gebruikersnaam niet gevonden";

            // redirecten naar het registratie-venster
            $location = SITE_URL . '/inlog/registratieform.php';

        } else {
            // Gebruikersnaam wél gevonden - wachtwoordcontrole
            if (password_verify($_POST['wachtwoord'], $userdata[0]['wachtwoord'])) {
                // Wachtwoord correct - gebruikersdata in sessie bewaren
                var_dump("Gebruikersdata in sessie bewaren");
                var_dump($userdata);

                $_SESSION['LOGIN_OK'] = true;
                $_SESSION['USERNAME'] = $userdata[0]['Gebruikersnaam'];
                $_SESSION['Naam'] = $userdata[0]['Naam'];
                $_SESSION['Adres'] = $userdata[0]['Adres'];
                $_SESSION['Telefoonnummer'] = $userdata[0]['Telefoonnummer'];
                $_SESSION['Email'] = $userdata[0]['Email'];
                $_SESSION['Gemeente'] = $userdata[0]['Gemeente'];
                $_SESSION['Postcode'] = $userdata[0]['Postcode'];
                $_SESSION['IS_ADMIN'] = $userdata[0]['Admin'];
                $_SESSION['Wachtwoord'] = '';
                $_SESSION['KlantID'] = $userdata[0]['KlantID'];
                $gevonden = true;

                // redirecten naar de shop
                $location = SITE_URL . '/index.php';

            } else {
                echo 'Paswoord niet correct';

                //  terug redirecten naar de login-plek
                $location = SITE_URL . '/inlog/aanmelden.php';
            }
        }
    }

// -- Fout, gevaarlijk en omslachtige manier v inloggen. Zie query bovenaan hoe je het proper kan oplossen, laat de database zijn werk doen!

//    foreach ($inloggen as $inlog) {
//        //var_dump($inlog);
//
//        // controle uitvoeren
//
//        if (password_verify($_POST['wachtwoord'], $inlog['wachtwoord'])) //if(password_verify(strtoupper($_POST['gebruikersnaam']).$_POST['wachtwoord'], $inlog['wachtwoord'])==true )
//        {
//            //var_dump(password_verify($_POST['wachtwoord'],$inlog['wachtwoord']));
//            //var_dump('SUCCESS !!!');
//
//            $_SESSION['LOGIN_OK'] = true;
//            $_SESSION['USERNAME'] = $inlog['Gebruikersnaam'];
//            $_SESSION['Naam'] = $inlog['Naam'];
//            $_SESSION['Adres'] = $inlog['Adres'];
//            $_SESSION['Telefoonnummer'] = $inlog['Telefoonnummer'];
//            $_SESSION['Email'] = $inlog['Email'];
//            $_SESSION['Gemeente'] = $inlog['Gemeente'];
//            $_SESSION['Postcode'] = $inlog['Postcode'];
//            $_SESSION['IS_ADMIN'] = $inlog['Admin'];
//            $_SESSION['Wachtwoord'] = '';
//            $_SESSION['KlantID'] = $inlog['KlantID'];
//            $gevonden = true;
//
//            //var_dump('Session data na gevonden record:');
//            //var_dump($_SESSION);
//
//        } else {
//            //var_dump('FAILED !!!');
//        }
//    }
//
//    //var_dump($gevonden);
//
//    $fout = '';
//
//    //var_dump('ELSEIFS GAAN CHECKEN');
//    //var_dump($_SESSION);
//

// -- Ik weet niet wat hier allemaal gebeurt, denk denk op eerste gezicht dat dit allemaal zinloos is...

//    if (!isset($_POST['ACTION']) or ($_POST['ACTION'] != 'AANMELDEN' and $_POST['ACTION'] != 'REGISTREREN')) {
//        /*  Er moet een actie doorgegeven worden */
//        $_SESSION['ALERT_CODE'] = 'ERROR';
//        $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//        $_SESSION['ALERT_BODY'] = 'Er werd een verkeerde actie opgegeven.';
//
//        $location = SITE_URL . '/inlog/aanmelden.php';
//    } elseif ($_POST['ACTION'] == 'REGISTREREN') {
//        $_SESSION['ALERT_CODE'] = '';
//        $_SESSION['ALERT_HEAD'] = 'Registreren';
//        $_SESSION['ALERT_BODY'] = '';
//        $location = SITE_URL . '/inlog/registratieform.php';
//    } elseif ($_SESSION['LOGIN_OK']) {
//        var_dump('SESSION LOGIN OK gechecked');
//        /*  Afdwingen dat je alleen kan aanmelden als je nog niet aangegemeld bent */
//        $_SESSION['ALERT_CODE'] = '';
//        $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//        $_SESSION['ALERT_BODY'] = '';
//
//        $location = SITE_URL . '/index.php';
//    } elseif (!isset($_POST['USERNAME']) or !isset($_POST['PASWOORD'])
//        or $_POST['USERNAME'] == '' or $_POST['PASWOORD'] == '') {
//        /*  Dit script kan enkel uitgevoerd worden als ACTION=CREATE */
//        $_SESSION['ALERT_CODE'] = 'ERROR';
//        $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//        $_SESSION['ALERT_BODY'] = 'Er werd geen gebruikersnaam of paswoord opgegeven.';
//
//        $location = SITE_URL . '/inlog/aanmelden.php';
//    } else {
//        $sql = "
//        SELECT
//            IDKlant AS USER_ID, gebruikersnaam as USERNAME, wachtwoord AS PASWOORD,
//            Naam AS VOORNAAM, Admin AS ADMIN
//        FROM gebruiker WHERE UPPER(gebruikersnaam)=UPPER(:gebruikersnaam)";
//        try {
//            $statement = $dbh->prepare($sql);
//            $statement->bindValue(':gebruikersnaam', $_POST['USERNAME']);
//            $statement->execute();
//            $gebruiker = $statement->fetch();
//
//            if (!$gebruiker) {
//                if (DEBUG_MODE >= DEBUG_INFO) {
//                    error_log(__FILE__ . ' !!!! WARNING');
//                    error_log(__FILE__ . ' !!!! Iemand probeert aan te melden met een ongeldig userid: ' . $_POST['USERNAME']);
//                }
//                $fout = 'De opgegeven gebruikersnaam bestaat niet.';
//            }
//        } catch (PDOException $e) {
//            $fout = 'Fout bij controle username: <code>' . $e->getMessage() . '</code>';
//        }
//
//        if ($fout != '') {
//            $_SESSION['ALERT_CODE'] = 'ERROR';
//            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//            $_SESSION['ALERT_BODY'] = $fout;
//
//            $location = SITE_URL . '/inlog/aanmelden.php';
//        } elseif (!password_verify($_POST['USERNAME'] . $_POST['PASWOORD'], $gebruiker['PASWOORD'])) {
//            $_SESSION['ALERT_CODE'] = 'ERROR';
//            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//            $_SESSION['ALERT_BODY'] = 'U heeft een foutief paswoord ingegeven. Probeer opnieuw.';
//
//            $location = SITE_URL . '/inlog/aanmelden.php';
//        } else {
//            $_SESSION['LOGIN_OK'] = true;
//            $_SESSION['USER_ID'] = $gebruiker['USER_ID'];
//            $_SESSION['USERNAME'] = $gebruiker['USERNAME'];
//            $_SESSION['VOORNAAM'] = $gebruiker['VOORNAAM'];
//            $_SESSION['IS_ADMIN'] = ($gebruiker['ADMIN']);
//
//            $_SESSION['ALERT_CODE'] = 'SUCCESS';
//            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
//            $_SESSION['ALERT_BODY'] = 'U bent succesvol aangemeld!';
//
//            $location = SITE_URL . '/index.php';
//            //header('location:'.'../index.php');
//        }
//    }
} else if (isset($_POST['uitlogknop'])) {
    session_destroy();
    $location = SITE_URL . '/index.php';
    //header('location:'.'../index.php');
} else {
    /* toon foutboodschap */
    $location = SITE_URL . '/index.php';
    //header('location:'.'../index.php');
}

header("Location: " . $location); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;
//header('location:'.'../index.php');

?>