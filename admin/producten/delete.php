<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
$recorddeleted = FALSE;
$errormsg = FALSE;

if(isset($_POST['delete']) && isset($_POST['productid']))
{
    $sql = "DELETE FROM tblproduct WHERE ProductID = {$_POST['productid']}";

    try {
        if ($dbh->query($sql)) {
            echo "Record updated successfully";
            $recorddeleted = TRUE; // indien saven is gelukt...

        } else {
            $errormsg = TRUE;
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
else
{
    echo "Error 405 - Method not allowed";
}
?>

<html>
<head>
    <title>Producten</title>
    <link rel="icon" href="../img/Icon/DVP.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="img/favicon.ico" rel="shortcut icon"/>

    <!-- Google font -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="../../css/flaticon.css"/>
    <link rel="stylesheet" href="../../css/slicknav.min.css"/>
    <link rel="stylesheet" href="../../css/style.css"/>

    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.slicknav.min.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/main.js"></script>

</head>
<body style="background-color:white;">
<?php $page = '';
require(SITE_DIR . '/Includes/navbar.php');
?>

<!---->
<!--        --><?php //} }
?>

<main class="container klantenlijst" style="margin-top: 150px;">
    <div class="row mt-3">
        <div class="col-12">
            <?php if ($recorddeleted) { ?>
                <div class="alert alert-success" role="alert">
                    Product is verwijderd!
                </div>
            <?php } ?>
            <?php if ($errormsg) { ?>
                <div class="alert alert-danger" role="alert">
                    Product verwijderen is mislukt!
                </div>
            <?php } ?>
                <a href="index.php" class="btn btn-info">Terug naar overzicht</a>
        </div>

        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '<pre>';
        }

        ?>
    </div>
</main>
</body>
</html>