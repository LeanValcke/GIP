<?php 
require('../config.php');


if(isset($_POST['wijzigknop1'])) 
{
    //connectie
    $dbh = new PDO (DB_CONNECTION, DB_USERNAME, DB_PASSWORD);


    $sql ="UPDATE tblklant SET Naam=:Naam, Telefoonnummer=:Telefoonnummer, Adres=:Adres,
              Gemeente=:Gemeente, Postcode=:Postcode, Gebruikersnaam=:Gebruikersnaam, Email=:Email, Wachtwoord=:Wachtwoord WHERE IDKlant=:IDKlant";

    $statement = $dbh->prepare($sql);
    $statement->bindvalue(":Naam",$_POST['Naam']);
    $statement->bindvalue(":Telefoonnummer",$_POST['Telefoonnummer']);
    $statement->bindvalue(":Adres",$_POST['Adres']);
    $statement->bindvalue(":Gemeente",$_POST['Gemeente']);
    $statement->bindvalue(":Postcode",$_POST['Postcode']);
    $statement->bindvalue(":Gebruikersnaam",$_POST['Gebruikersnaam']);
    $statement->bindvalue(":Email",$_POST['Email']);
    $statement->bindvalue(":Wachtwoord",password_hash( strtoupper($_POST['Gebruikersnaam']).$_POST['Wachtwoord'],PASSWORD_DEFAULT ));
    $statement->bindvalue(":IDKlant",$_SESSION['IDKlant']);
    $statement->execute();
}    

$_SESSION['LOGIN_USERNAME'] = $_POST['Gebruikersnaam'];  
$_SESSION['Naam'] = $_POST['Naam'];
$_SESSION['Adres'] = $_POST['Adres'];
$_SESSION['Telefoonnummer'] = $_POST['Telefoonnummer'];
$_SESSION['Email'] = $_POST['Email'];
$_SESSION['Gemeente'] = $_POST['Gemeente'];
$_SESSION['Postcode'] = $_POST['Postcode'];


header('location:'.'aanmelden.php');  

?>