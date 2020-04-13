
<?php 
    require( '../config.php' );

    if( isset($_GET['ProductID']) )
    {
        $winkelkar = $_SESSION['WINKELKAR'];

        $reedsGeselecteerd = false;
        
        foreach($winkelkar as $i=>$artikel)
        {
            if( $artikel['ProductID']==$_GET['ProductID'] ) 
            {
                $reedsGeselecteerd = true;
                $winkelkar[$i]['AANTAL']++;
                // zie: https://stackoverflow.com/questions/15024616/php-foreach-change-original-array-values
            }
        }
        
        
        
        if( !$reedsGeselecteerd ) 
        {
            $artikel = array();
            $artikel['AANTAL'] = 1;
            $artikel['ProductID'] = $_GET['ProductID'];
            $winkelkar[] = $artikel;
        }

        $_SESSION['WINKELKAR'] = $winkelkar;
        

        
    }
    header( 'location:'.'winkelkar.php' );
?>