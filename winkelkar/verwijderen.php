<?php 
    require( '../config.php' );

    if( isset($_GET['ProductID']) )
    {
        $winkelkar = $_SESSION['WINKELKAR'];
        
        foreach($winkelkar as $i=>$artikel)
        {
            if( $artikel['artikelcode']==$_GET['ProductID'] ) 
            {
                $winkelkar[$i]['Aantal']--;
                
                if( $winkelkar[$i]['Aantal']==0 )
                {
                    unset($winkelkar[$i]);
                }
                
                // we hebben een match, dus de foreach mag nu al stoppen
                break;
            }
        }
        
        $_SESSION['WINKELKAR'] = $winkelkar;
    }

    header( 'location:'.'winkelkar.php' );
?>