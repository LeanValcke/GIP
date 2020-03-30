<?php 
require( '../../config.php' );

if( !$_SESSION['IS_ADMIN'] ) { 
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Bestellingen';
    $_SESSION['ALERT_BODY'] = 'U bent geen administrator!';
}
else
{
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Bestellingen';
    $_SESSION['ALERT_BODY'] = 'Deze module moet nog geprogrammeerd worden.';
}
    
header('location:'.SITE_URL);
?>