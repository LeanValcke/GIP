<?php 
require( '../config.php' );

if( !$_SESSION['IS_ADMIN'] ) { 
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer';
    $_SESSION['ALERT_BODY'] = 'U bent geen administrator!';
}
else
{
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer';
    $_SESSION['ALERT_BODY'] = 'U heeft geen module geselecteerd.';
}
    
header('location:'.SITE_URL);
?>