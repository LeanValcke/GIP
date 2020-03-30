
<?php require('../config.php');
   $sql = "SELECT GameID, Gamenaam, Beschrijving, foto FROM tblgameafdeling";
                    $AlleGames =$dbh->query($sql);
?>

   
<html>
    <head>
          <title>Games</title>
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

        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.slicknav.min.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/main.js"></script>
       
    </head>
    <body>
        <?php
        $page='products'; 
        require ('../Includes/navbar.php'); 
         ?>

    <div class="lijn">
        <div class="lijn-titel"> <h2>GAMES</h2> </div>
        <?php
            foreach($AlleGames as $products)    
        {?>
      
   <div class="box"> <a href="merchproducten.php?GameID=<?php echo $products["GameID"] ?>">  
    <img  src="<?php echo SITE_URL ?>/img/<?php echo $products['foto'] ?> ">
          <div class="box-beschrijving">
            <h3><?php echo $products['Gamenaam']?></h3>
              <p><?php echo $products['Beschrijving']?></p>
         </div> 
       </a>
   </div> 
            
  <?php   }  ?>
    </div>

<?php require('../Includes/footer.php'); ?>

