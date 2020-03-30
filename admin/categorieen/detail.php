<?php 
require( '../../config.php' );

/* 
Deze pagina geeft detailinformatie van 1 specifieke categorie en is enkel bedoeld voor de beheerders!

Ze wordt opgeroepen dmv een GET-request:

    1/ vanuit admin/categorieen/index.php
    2/ vanuit admin/categorieen/crud.php
*/

$fout = '';

if( !$_SESSION['IS_ADMIN'] ) 
{ 
/*  Deze pagina mag enkel getoond worden aan beheerders */
    
    $fout = 'U heeft geen toegang tot deze module!';
}

elseif( !isset($_GET['ACTION']) ) 
{
/*  Deze pagina kan niet getoond worden als ACTION niet ingevuld werd */
    
    $fout = 'Er werd geen actie opgegeven.';
}

elseif( $_GET['ACTION']!='UPDATE' and $_GET['ACTION']!='DELETE' and $_GET['ACTION']!='CREATE')
{
/*  Enkel UPDATE of DELETE of CREATE is geldige actie */

    $fout = 'Er werd een verkeerde actie opgegeven: '.$_GET['ACTION'];
}

elseif( isset($_SESSION['CATEGORIE']) )
{
/*  Dit kan enkel als we hier beland zijn vanuit het crud.php script                                      */
/*  Dit betekent dat de gebruiker al gegevens ingegeven had, maar dat die niet correct waren              */
/*  Dus, deze gegevens moeten opnieuw getoond worden in dit scherm en we halen ze uit de sessie-variabele */

    $categorie = $_SESSION['CATEGORIE'];
    unset($_SESSION['CATEGORIE']);
}

elseif( $_GET['ACTION']=='CREATE' ) 
{
/*  Er moet een blanco categorie getoond worden                                      */
/*  Eventueel kunnen hier standeraard waarden ingevuld worden voor het nieuwe record */

    $categorie = array(
        'CAT_ID' => 0,
        'CAT_NAAM' => '',
        'CAT_PROMO' => '0'
    );
}

elseif( !isset($_GET['CAT_ID']) ) 
{
/*  Wanneer ACTION = UPDATE of DELETE, dan moet het ID vd categorie die we willen aanpassen of schrappen gekend zijn */
    
    $fout = 'Er werd geen categorie-id opgegeven.';
}

else
{
/*  De gebruiker had nog geen gegevens ingevuld of gewijzigd, dus we moeten  */
/*  de gegevens van de geselecteerde categorie ophalen uit de databank       */
        
    $sql = "SELECT id AS CAT_ID, naam AS CAT_NAAM, promo AS CAT_PROMO FROM categorie WHERE categorie.id=:catId";
    try 
    {
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':catId',$_GET['CAT_ID']);
        $statement->execute();     
        $categorie = $statement->fetch();

        if( !$categorie ) 
        {
            $fout = 'Categorie met CAT_ID = <strong>'.$_GET['CAT_ID'].'</strong> bestaat niet.';
        }
    }
    catch (PDOException $e) 
    {
        $fout = 'Fout bij uitvoeren query met CAT_ID = '.$_GET['CAT_ID'].'<br><code>'.$sql.'</code><hr><code><strong>'.$e->getMessage().'</code></strong>';
    }

} // einde controles en ophalen gegevens


if( $fout!='' )
{
/*  Als we een fout vastgesteld hebben, kunnen we het overzicht niet tonen       */
/*  We keren dan terug naar de homepage waar een foutmelding getoond moet worden */    

    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Beheer categorieën';
    $_SESSION['ALERT_BODY'] = $fout;
    header('location:'.SITE_URL);
    exit();
}
elseif( $_GET['ACTION']=='CREATE' )
{
    $title = 'Nieuwe categorie toevoegen';
    $color = 'warning';
    $button = 'Toevoegen';
    $readonly = '';    
}
elseif( $_GET['ACTION']=='UPDATE' )
{
    $title = 'Categorie wijzigen (ID '.$categorie['CAT_ID'].')';
    $color = 'success';
    $button = 'Bewaren';
    $readonly = '';
}
elseif( $_GET['ACTION']=='DELETE' )
{
    $title = 'Categorie schrappen (ID '.$categorie['CAT_ID'].')';
    $color = 'danger';
    $button = 'Schrappen';
    $readonly = 'readonly'; /* in geval van een delete mogen geen gegevens gewijzigd worden -> dus alles: readonly */
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Beheer categoriën</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- LOCAL [ Bootstrap + Fontawesome + Datatables ] LOCAL -->

    <script src="<?php echo SITE_URL ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo SITE_URL ?>/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/fontawesome.all.min.css" type="text/css"/>

    <!--[ MY WEBSHOP ] -->

    <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/webshop.css" type="text/css"/>
</head>
<body>

<?php require( SITE_DIR.'/includes/navbar.php' ); ?>

<?php require( SITE_DIR.'/includes/alert.php' ); ?>

<form action="crud.php" method="post">
    
    <?php /* 
    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    !! Bij een update en een delete moet het CAT_ID doorgegeven worden aan het crud.php script !! 
    !! Dit kunnen we doen via een hidden input veld                                            !!
    !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    */ ?>
    <input hidden type="number" name="CATEGORIE[CAT_ID]" value="<?php echo $categorie['CAT_ID'] ?>">
    
    <main class="container">
        
        <!-- Title & Button -->
        <div class="row shadow p-3 bg-white rounded">
            <div class="col-6"><h4><?php echo $title ?></h4></div>
            <div class="col-6 text-right">
                <?php if($_GET['ACTION']=='DELETE') { ?>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#bevestigDelete">Schrappen</button>
                <?php } else { ?>
                    <button type="submit" name="ACTION" class="btn btn-md btn-<?php echo $color ?>" value="<?php echo $_GET['ACTION'] ?>"><?php echo $button ?></button>
                <?php } ?>
                <a href="index.php" class="btn btn-md btn-secondary">Annuleren</a>
            </div>
        </div>
        
        <!-- Record-Row -->
        <div class="row mt-3">
            <div class="form-group col-12 col-lg-6">
                <label for="inputNaam">Naam</label>
                <input id="inputNaam" class="form-control" <?php echo $readonly ?>
                       type="text" name="CATEGORIE[CAT_NAAM]" value="<?php echo $categorie['CAT_NAAM'] ?>"/>

            </div>
            <div class="form-group col-12 col-lg-3">
                <label for="inputPromo">Promo</label>
                <input id="inputPromo" class="form-control" <?php echo $readonly ?>
                       type="text" name="CATEGORIE[CAT_PROMO]" value="<?php echo $categorie['CAT_PROMO'] ?>"/>

            </div>
        </div> <!--/ Record-Row -->
        
    </main> <!--/ Container -->
    
    <!-- 
    zie https://getbootstrap.com/docs/4.0/components/modal/ 
    -->
    <div class="modal fade" id="bevestigDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categorie schrappen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Weet u heel zeker dat <strong><?php echo $categorie['CAT_NAAM'] ?></strong> geschrapt mag worden?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="ACTION" value="DELETE">Schrappen</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                </div>
            </div>
        </div>
    </div>
    
</form>

<?php require( SITE_DIR.'/includes/footer.php' ); ?>

</body>
</html>