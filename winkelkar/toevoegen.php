
<?php 
    require( '../config.php' );
$checkout = false;
$nietingelogd = false;
if($_POST['GekozenMaat'] =="Maat kiezen")
{
     $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_BODY'] = 'Je moet een maat selecteren'; 
   header( 'location:'.SITE_URL.'/merch/merchpagina.php?ProductID='.$_GET['ProductID'] );
    die();
}
if( isset($_POST['Sub']) )
{
    if($_SESSION['LOGIN_OK']==true) {
    $checkout = true;
    }
    else {$nietingelogd = true;}
}

    if( isset($_GET['ProductID']) )
    {
        $winkelkar = $_SESSION['WINKELKAR'];

        $reedsGeselecteerd = false;
       $artikelcode= $_GET['ProductID'].$_POST['GekozenMaat'];

        
        foreach($winkelkar as $i=>$artikel)
        {
            if( $artikel['artikelcode']== $artikelcode) 
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
             $artikel['Maat'] = $_POST['GekozenMaat'];
            $artikel['artikelcode'] =  $artikel['ProductID']. $artikel['Maat'];
           
            $winkelkar[] = $artikel;
        }

        $_SESSION['WINKELKAR'] = $winkelkar;
        

        
    }
if ($checkout == true) {
     header( 'location:'.'checkout.php' );
    die();
}
if ($nietingelogd ==true){
    header( 'location:'.SITE_URL.'/inlog/aanmelden.php' );
      $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_BODY'] = 'Je moet eerst inloggen voor je iets kan kopen!'; 
}
else {
    header( 'location:'.'winkelkar.php' );
    }
?>