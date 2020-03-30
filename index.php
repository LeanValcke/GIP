<?php
require('config.php');
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
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/owl.carousel.min.css"/>
        <link rel="stylesheet" href="css/flaticon.css"/>
        <link rel="stylesheet" href="css/slicknav.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.slicknav.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/main.js"></script>

    </head>
    <body>

        <?php $page='index'; require ('Includes/navbar.php'); ?>

        <!-- Header Section end -->

        <!-- Hero Section end -->

        <section class="hero-section">
            <!--<div class="container">

</div>-->
            <div class="hero-slider owl-carousel">
                <div class="hs-item set-bg" data-setbg="img/Carosel/broek.jpg"></div>
                <div class="hs-item set-bg" data-setbg="img/Carosel/boekentas.jpg"></div>	
                <div class="hs-item set-bg" data-setbg="img/Carosel/fortnitetrui.jpg"></div>
            </div>
            <section class="promotie-tekst"> 
                <strong><h4>Goed nieuws! 
                    <br> Fortnite is in promotie!</h4></strong>
                <ul>
                    <img src="img/Icon/icon.png"><li>Fortnite broek</li>

                    <div class="lettergroote">
                        Deze broek is in korting met 25%.
                        <br>Nu €20 in plaats van €25!
                    </div>

                    <img src="img/Icon/icon.png"><li>Fortnite t-shirt</li>
                    <div class="lettergroote">
                        Deze t-shirt is in korting met 10%.
                        <br>Nu €30 in plaats van €33!
                    </div>

                    <img src="img/Icon/icon.png"><li>Fortnite boekentas</li>
                    <div class="lettergroote">
                        Deze boekentas is in korting met 25%.
                        <br> Nu €12 in plaats van €16!
                    </div>
                </ul> 
                <p>
                </p>
            </section>
        </section>

        <!-- Hero Section end -->


        <!-- Why Section end -->

        <div class="onder-index"  >
            <div class="text-center mb-5 pb-4">
                <h2>Waarom ons kiezen?</h2>
            </div>

            <div class="onder-index-grid">

                <div class="keuze-box" >
                    <div class="icon-box-item" style="margin-bottom:15%;" >
                        <div class="ib-text">
                            <div class="ib-icon"  >
                                <i class="flaticon-012-24-hours"></i>
                            </div>

                            <h5>Levering</h5>
                            <div class="onder-index-midden-text">
                                Als u voor 19u heeft besteld,
                                heeft u uw pakketje de volgende dag al in huis!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="keuze-box">
                    <div class="icon-box-item">

                        <div class="ib-text" >
                            <div class="ib-icon">
                                <i class="flaticon-036-customer-service"></i>
                            </div>
                            <h5>Klantenservice</h5>
                            <div class="onder-index-midden-text">
                                Heeft u een probleem of een vraag?
                                <br>Wij zijn hier om u te helpen!
                                <br>24/24 en 7/7 beschikbaar
                                <br> <a href="faq/contact.php">Contacteer ons </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require('Includes/footer.php');?>

    </body>
    <script src="js/main.js"></script>
</html>