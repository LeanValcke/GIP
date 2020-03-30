<?php require('../config.php');

?>

<html>
    <head>
        <title>Registreren</title>
        <link rel = "icon" href ="../img/Icon/DVP.png"> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="img/favicon.ico" rel="shortcut icon"/>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/font-awesome.min.css"/>
        <link rel="stylesheet" href="../css/owl.carousel.min.css"/>
        <link rel="stylesheet" href="../css/flaticon.css"/>
        <link rel="stylesheet" href="../css/slicknav.min.css"/>
        <link rel="stylesheet" href="../css/style.css"/>

        <script s  rc="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.slicknav.min.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/main.js"></script>

    </head>
    <body style="background-color:white">
        <div class="midden">

            <?php $page='inlog'; require('../Includes/navbar.php');  ?>
            <br>


            <main class="container">
                <form action="registratie.php" method="post">
                    <input type="hidden" name="ACTION" value="REGISTREREN">
                    <div class="row shadow p-3 bg-white rounded">
                        <div class="col-8"><h4>Registreren</h4></div>
                        <div class="col-4 text-right">
                            <button name="registratieknop" style="background-color: red; border-color: red " 
                                    type="submit" class="btn btn-md btn-success">Verzenden
                            </button>


                        </div>
                    </div>
                    <main class="container">
                        <?php require( SITE_DIR.'/Includes/error.php' ); ?>
                    </main>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-md-6">
                            <label for="inputVoornaam">Voornaam</label>
                            <input id="Voornaam" class="form-control" type="text" name="Voornaam" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputAchternaam">Achternaam</label>
                            <input id="Achternaam" class="form-control" type="text" name="Achternaam" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputAdres">Adres</label>
                            <input id="Adres" class="form-control" type="text" name="Adres" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputPostcode">Postcode</label>
                            <input id="Postcode" class="form-control" type="text" name="Postcode" required>               
                        </div> 
                        <div class="form-group col-12 col-md-6">
                            <label for="inputGemeente">Gemeente</label>
                            <input id="Gemeente" class="form-control" type="text" name="Gemeente" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputTelefoonnummer">Telefoonnummer</label>
                            <input id="Telefoonnummer" class="form-control" type="text" name="Telefoonnummer" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputGebruikersnaam">Gebruikersnaam</label>
                            <input id="Gebruikersnaam" class="form-control" type="text" name="Gebruikersnaam" required>
                        </div>  
                        <div class="form-group col-12 col-md-6">
                            <label for="inputEmail">E-mail</label>
                            <input id="Email" class="form-control" type="text" name="Email" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputPaswoord">Wachtwoord</label>
                            <input id="Password" class="form-control" type="password" name="Wachtwoord" required>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputBWachtwoord">Bevestig wachtwoord</label>
                            <input id="Bwachtwoord" class="form-control" type="password" name="Bwachtwoord" required>
                        </div>
                    </div>

                </form>

            </main> <!--/ container -->
        </div>
    </body>
    <script src="../js/main.js"></script>
</html>
