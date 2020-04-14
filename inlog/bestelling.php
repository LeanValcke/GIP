<?php require('../config.php');

$ingelogdeKlantId = $_SESSION['KlantID'];

$sql = "SELECT tblbestelbons.id, tblbestelbons.tblklant_KlantID, tblbestelbons.besteldatum, tblbestelstatus.status FROM tblbestelbons
INNER JOIN tblbestelstatus ON tblbestelstatus.id = tblbestelbons.status
WHERE tblbestelbons.tblklant_KlantID = $ingelogdeKlantId";	
$result = $dbh->query($sql);

var_dump($result->fetchAll());
die();
?>

<html>
    <head>
        <title>DVP</title>
        <link rel = "icon" href ="img/Icon/DVP.png"  > 
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

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.slicknav.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/main.js"></script>

    </head>
    <body>
        <div class="midden">
            <?php $page='index'; require ('../Includes/navbar.php');?>

            <form action="aanmelden.php" method="POST">
                <br>
                <div class="row shadow p-3 bg-white rounded" style="width:80%; margin-left:10%;">
                    <div class="col-8"><h4>Mijn bestellingen</h4></div>
                    <div class="col-4 text-right">
                        <button name="keerterugbutton" style="background-color: red; border-color: red " 
                                type="submit" class="btn btn-md btn-success">Keer terug
                        </button>
                    </div>
                </div>
                <br>
                <div class="login-tabel">

                    <table>
                        <tr>
                            <th>Naam</th> 
                            <td>      
                                <input id="Naam" class="form-control col-md-6 kolomklein" type="text" name="Naam"
                                       value="<?php echo $_SESSION['Naam']; ?>">
                            </td> 
                        </tr>
                        <tr>
                            <th>BonID</th>
                            <td>      
                                <input id="BonID" class="form-control col-md-6 kolomklein" type="int"       name="BonID" value="<?php echo $_SESSION['BonID']; ?>">
                            </td> 
                        </tr>
                        <tr>
                            <th>KlantID</th>
                            <td>  
                                <input id="KlantID" class="form-control col-md-6 kolomklein" type="text" name="KlantID" value="<?php echo $_SESSION['KlantID']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Datum</th>
                            <td>  
                                <input id="Datum" class="form-control col-md-6 kolomklein" type="text" name="Datum"
                                       value="<?php echo $_SESSION['Datum']; ?>">
                            </td>
                        </tr>

                    </table>
                </div> 
            </form>

        </div>