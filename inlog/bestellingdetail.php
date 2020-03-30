<?php
require('../config.php');

var_dump($_SESSION);
var_dump($_POST);
die();

$fout = '';
if (isset($_POST['bekijkknop'])) {
  if (!$_SESSION['LOGIN_OK']) {
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'U heeft geen toegang tot deze module!';
    $location = SITE_URL;
  } elseif (!isset($_POST['BETAALWIJZE'])) {
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'Er werd geen betaalwijze opgegeven.';
    $location = SITE_URL . '/winkelkar';
  } elseif ($_POST['BETAALWIJZE'] != "Kredietkaart" and $_POST['BETAALWIJZE'] != "Bancontact" and $_POST['BETAALWIJZE'] != 'PayPal') {
    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Winkelkar';
    $_SESSION['ALERT_BODY'] = 'De opgegeven betaalwijze ' . $_POST['BETAALWIJZE'] . ' wordt niet ondersteund.';
    $location = SITE_URL . '/winkelkar';
  } else {
    /*  $winkelkar is een 2-dimensionale array: er is een rij per product dat in de winkelkar zit */
    /*  Voor ieder product in de winkelkar wordt PROD_ID, AANTAL en PRIJS bijgehouden             */
    $winkelkar = $_SESSION['WINKELKAR'];

    //  ---------------------------------------------------------------------------------------------------------------------------
    //  OPGAVE
    //  ---------------------------------------------------------------------------------------------------------------------------
    //
    //  Het uit te voeren SQL-statement om een nieuwe bestelling toe te voegen is:
    //

    // Eerste stap: de klant is ingelogd, klant ID opvragen (session)
    // Tweede stap: bestelling is gemaakt, bestelgegevens bewaren in tabel tblbestellingproduct
    // Eens de bestelgegevens bewaard, moet het bestel-id  (bon-id) worden gekoppeld aan tblbestelling



    $sql = "INSERT INTO tblbestelling ( BonID, IDKlant, Datum ) VALUES ( :BonID, :IDKlant, :Datum )";

    try {
      $statement = $dbh->prepare($sql);
      $statement->bindValue(':BonID', $_POST['BonID']);
      $statement->bindValue(':KlantID', $_SESSION['LOGIN_ID']);
      $statement->bindValue(':Datum', date('Y-m-d'));
      $statement->execute();
      $id = $dbh->lastInsertId();
    } catch (PDOException $e) {
      $fout = '<code>' . $e->getMessage() . '</code>';
    }
    //
    //  Het id van de bestelling die toegevoegd werd = $dbh->lastInsertId().
    //
    //  Het uit te voeren SQL-statement om de details van de bestelling toe te voegen is:
    //
    $sql = "INSERT INTO bestellingproduct ( ProductID, Aantal)  
     VALUES ( :ProductID, :Aantal )";
    //
    //  waarbij VOOR IEDER PRODUCT in de winkelkar de volgende waarden moeten ingevuld worden:
    //
    foreach ($winkelkar as $winkelkarProduct)

      try {
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':ProductID', $winkelkarProduct['PROD_ID']);
        $statement->bindValue(':Aantal', $winkelkarProduct['AANTAL']);
        $statement->execute();
      } catch (PDOException $e) {
        $fout = '<code>' . $e->getMessage() . '</code>';
      }

    //
    //  GetProductPrijs is een functie die adhv een productId de prijs van dat product opzoekt in de databank en teruggeeft.
    //  Aan deze functie moet je niets wijzigen; je vind ze onderaan in het script.
    //
    //  ---------------------------------------------------------------------------------------------------------------------------

    if ($fout == '') {
      $_SESSION['ALERT_HEAD'] = 'Nieuwe bestelling geregistreerd';
      $_SESSION['ALERT_CODE'] = 'SUCCESS';
      $_SESSION['ALERT_BODY'] =
        '<p>Je hebt ' . count($_SESSION['WINKELKAR']) . ' producten besteld en betaald met ' . $_POST['BETAALWIJZE'] . '.<br>' .
        'Hieronder vind je het overzicht van jouw bestellingen.</p>';

      $_SESSION['WINKELKAR'] = array();

      $location = SITE_URL . '/bestellingen';
    } else {
      /*  Er is iets fout gelopen bij het toevoegen van de bestelling */
      /*  Daarom keren we terug naar de winkelkar pagina              */
      $_SESSION['ALERT_HEAD'] = 'Nieuwe bestelling registeren';
      $_SESSION['ALERT_CODE'] = 'ERROR';
      $_SESSION['ALERT_BODY'] = 'De bestelling kon niet geregistreerd worden!<hr><strong>' . $fout . '</strong>';
      $location = SITE_URL . '/winkelkar';
    }
  }

  header('location:' . $location);

}
else
{
   echo 'U heeft nog geen bestellingen gedaan.';
}

/*  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  */
/*  This is quick&dirty and NOT the way to do it... But it works :-)  */
/*  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  */
function GetProductPrijs($dbh, $id)
{
  try {
    $statement = $dbh->prepare('SELECT prijs AS PRIJS FROM product WHERE id=' . $id);
    $statement->execute();
    $prijs = $statement->fetch();
  } catch (PDOException $e) {
    $prijs = 0;
  }
  return (!$prijs ? 0 : $prijs[0]);
}

?>