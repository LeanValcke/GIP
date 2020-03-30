<?php 
require('../config.php');

$registratie="";
$Naam = $_POST['Voornaam'] . ' ' . $_POST['Achternaam'];
$Telefoonnummer = $_POST['Telefoonnummer'];
$Adres = $_POST['Adres'];
$Gemeente = $_POST['Gemeente'];
$Postcode = $_POST['Postcode'];
$Gebruikersnaam = $_POST['Gebruikersnaam'];
$Email = $_POST['Email'];

if($_POST['Wachtwoord'] == $_POST['Bwachtwoord'])
{
    $Wachtwoord = $_POST['Wachtwoord'];
}
else
{
    $registratie = false;

    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Registreren mislukt!';
    $_SESSION['ALERT_BODY'] = 'Wachtwoorden zijn niet gelijk!';
    header('location:'.'registratieform.php'); 
    die();
}

if(!is_numeric($_POST['Postcode']))
{
    $registratie = false;

    $_SESSION['ALERT_CODE'] = 'ERROR';
    $_SESSION['ALERT_HEAD'] = 'Registreren mislukt!';
    $_SESSION['ALERT_BODY'] = 'Postcode is geen nummer!';
    header('location:'.'registratieform.php'); 
    die();
}

if(isset($_POST['registratieknop'])) 
{     
    //connectie
    $dbh = new PDO (DB_CONNECTION, DB_USERNAME, DB_PASSWORD);

    if(mysqli_connect_error()) 
    {
        die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else
    {
        var_dump($Wachtwoord);

        $Wachtwoord =  password_hash($Wachtwoord, PASSWORD_DEFAULT);

        var_dump($Wachtwoord);

        $sql =" INSERT INTO tblklant (Naam, Telefoonnummer, Adres, Gemeente, Postcode, Admin, Gebruikersnaam, Email, Wachtwoord)
            VALUES ('$Naam','$Telefoonnummer','$Adres','$Gemeente','$Postcode','0','$Gebruikersnaam','$Email','$Wachtwoord')";

        if($dbh->query($sql))
        {
            echo "New record is inserted!!!!";
        }
        else
        {
            echo "Error: ".$sql."<br>".$dbh->errorInfo()[2];
        }

        //header('location:'.'aanmelden.php');
    }
}


?>