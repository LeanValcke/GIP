<?php 
/*  Voordat de insert, update of delete mag gebeuren, moeten een aantal controles uitgevoerd worden:

    CREATE:
        categorienaam moet ingevuld zijn
        categorienaam mag nog niet bestaan (moet uniek blijven)
        
    UPDATE:
        categorienaam moet ingevuld zijn
        categorienaam mag nog niet bestaan (moet uniek blijven)
        
    DELETE:
        er mogen geen producten behoren tot deze categorie

function Validatie( $dbh, $action, $categorie ) 
{
    $fout = '';
    
    if( $categorie['CAT_NAAM']=='' ) 
    {
    /*  Categorienaam moet altijd ingevuld zijn 
        
        $fout = 'Er werd geen naam ingevuld.';
    }
    
    elseif( $action=='CREATE' or $action=='UPDATE' )
    {
    /*  Categorienaam moet uniek blijven 
        
        $sql = "SELECT naam FROM categorie WHERE naam=:naam AND id<>:id";
        try
        {
            $statement = $dbh->prepare($sql);
            $statement->bindValue(':id',$categorie['CAT_ID']);
            $statement->bindValue(':naam',$categorie['CAT_NAAM']);
            $statement->execute();
            
            if( $statement->rowCount()>0 )
            {
                $fout = 'Er bestaat al een categorie met de naam <strong>'.$categorie['CAT_NAAM'].'</strong>.';
            }
        }
        catch( PDOException $e )
        {
            $fout = 'Fout bij controle naam: <code>'.$e->getMessage().'</code>';
        }
    } // einde controle CREATE & UPDATE
    
    elseif( $action=='DELETE' )
    {
      Zolang we 1 product vinden dat tot deze categorie behoort, mag de delete van de categorie niet uitgevoerd worden 
        
        $sql = "SELECT id FROM product WHERE catId=:id LIMIT 1";
        try
        {
            $statement = $dbh->prepare($sql);
            $statement->bindValue(':id',$categorie['CAT_ID']);
            $statement->execute();
            if( $statement->rowCount()>0 )
            {
                $fout = 'Er behoren nog producten tot deze categorie.';
            }
        }
        catch( PDOException $e )
        {
            $fout = 'Fout bij controle producten: <code>'.$e->getMessage().'</code>';
        }
    } // einde controle DELETE
    
    return $fout;
} */
?>