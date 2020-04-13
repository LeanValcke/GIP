<?php 
require( '../config.php' );

$fout = '';

if( !$_SESSION['LOGIN_OK'] ) 
{ 
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'U heeft geen toegang tot deze module!';
    $location = SITE_URL;
}
elseif( !isset($_POST['BETAALWIJZE']) ) 
{
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'Er werd geen betaalwijze opgegeven.';
    $location = SITE_URL.'/winkelkar';
}
elseif( $_POST['BETAALWIJZE']!="Visa" and $_POST['BETAALWIJZE']!="Mastercard" and $_POST['BETAALWIJZE']!='PayPal'  )
{
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'De opgegeven betaalwijze '.$_POST['BETAALWIJZE'].' wordt niet ondersteund.';
    $location = SITE_URL.'/winkelkar';
}
else
{
    /*  $winkelkar is een 2-dimensionale array: er is een rij per product dat in de winkelkar zit */
    /*  Voor ieder product in de winkelkar wordt PROD_ID, Aantal en PRIJS bijgehouden             */    
    $winkelkar = $_SESSION['WINKELKAR'];

    $fout = '** DIT MOET NOG GEPROGRAMMEERD WORDEN **';

    if( $fout=='' )
    {
        $_SESSION['ALERT_HEAD'] = 'Nieuwe bestelling geregistreerd';
        $_SESSION['ALERT_CODE'] = 'SUCCESS';
        $_SESSION['ALERT_BODY'] = 
            '<p>Je hebt '.count($_SESSION['WINKELKAR']).' producten besteld en betaald met '.$_POST['BETAALWIJZE'].'.<br>'.
            'Hieronder vind je het overzicht van jouw bestellingen.</p>';

        $_SESSION['WINKELKAR'] = array();

        $location = SITE_URL.'/inlog/bestellingen';
    }
    else
    {
        /*  Er is iets fout gelopen bij het toevoegen van de bestelling */
        /*  Daarom keren we terug naar de winkelkar pagina              */
        $_SESSION['ALERT_HEAD'] = 'Nieuwe bestelling registeren';
        $_SESSION['ALERT_CODE'] = 'ERROR';
        $_SESSION['ALERT_BODY'] = 'De bestelling kon niet geregistreerd worden!<hr><strong>'.$fout.'</strong>';
        $location = SITE_URL.'/winkelkar';
    }
}

header( 'location:'.$location );
?>