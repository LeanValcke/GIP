
<?php 
require( '../config.php' );
 if($_SESSION['LOGIN_OK']==true) {
    

    if( isset($_GET['ProductID']) )
    {
        $winkelkar = $_SESSION['WINKELKAR'];

        $reedsGeselecteerd = false;
        
        foreach($winkelkar as $i=>$artikel)
        {
            if( $artikel['ProductID']==$_GET['ProductID'] ) 
            {
                $reedsGeselecteerd = true;
                $winkelkar[$i]['Aantal']++;
                // zie: https://stackoverflow.com/questions/15024616/php-foreach-change-original-array-values
            }
        }
        
        
        
        if( !$reedsGeselecteerd ) 
        {
            $artikel = array();
            $artikel['Aantal'] = 1;
            $artikel['ProductID'] = $_GET['ProductID'];
            $winkelkar[] = $artikel;
        }

        $_SESSION['WINKELKAR'] = $winkelkar;   
    }
    header( 'location:'.'checkout.php' );
 }
else { header( 'location:'.SITE_URL.'/inlog/aanmelden.php' );
      $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_BODY'] = 'Je moet eerst inloggen voor je iets kan kopen!'; }
?>