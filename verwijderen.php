<?php 
    require( '../config.php' );

    if( isset($_GET['ProductID']) )
    {
        $winkelkar = $_SESSION['WINKELKAR'];
        
        foreach($winkelkar as $i=>$artikel)
        {
            if( $artikel['ProductID']==$_GET['ProductID'] ) 
            {
                $winkelkar[$i]['AANTAL']--;
                
                if( $winkelkar[$i]['AANTAL']==0 )
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