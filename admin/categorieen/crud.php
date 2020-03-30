<?php 
require( '../../config.php' );

/* 
Dit PHP-script kan enkel opgeroepen worden via een POST-request vanuit de pagina admin/categorieen/detail.php

Aan de hand van $_POST['ACTION'] kan bepaald worden wat er moet gebeuren:

    1/ = CREATE -> er moet een nieuwe categorie toegevoegd worden -> INSERT INTO ...
    2/ = UPDATE -> de opgegeven categorie moet gewijzig worden -> UPDATE ...
    3/ = DELETE -> de opgegeven categorie mag geschrapt worden -> DELETE FROM ...

Voordat de insert, update of delete mag gebeuren, moeten een aantal controles uitgevoerd worden.
De controles worden uitgevoerd in de functie Validatie die je vindt in het bestand validatie.php
Deze functie geeft een lege string terug als alle controles OK zijn
Anders geeft de functie een string terug die de foutboodschap (reden) bevat
*/

require( 'validatie.php' );
 
$fout = '';

if( !$_SESSION['IS_ADMIN'] ) 
{ 
/*  Afdwingen dat alleen beheerders deze pagina kunnen zien */

    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer categorieën';
    $_SESSION['ALERT_BODY'] = 'U heeft geen toegang tot deze module!';
    $location = SITE_URL;
}

elseif( !isset($_POST['CATEGORIE']) )
{
/*  Dit script kan niet uitgevoerd worden als er geen categoriegegevens gekend zijn */
    
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer categorieën';
    $_SESSION['ALERT_BODY'] = 'Er werden geen categoriegegevens ingevuld.';
    $location = SITE_URL.'/admin/categorieen';
}

} // einde ACTION=CREATE

else
{
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer categorieën';
    $_SESSION['ALERT_BODY'] =  'Er werd een verkeerde actie opgegeven: '.$_GET['ACTION'];
    $location = SITE_URL.'/admin/categorieen';    
}


header('location:'.$location);
?>