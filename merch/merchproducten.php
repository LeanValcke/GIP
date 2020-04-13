<?php require('../config.php'); 
$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto FROM tblproduct";	
$merchproducten =$dbh->query($sql);?>

<html>
<head>
      <title>Merchproducten</title>
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
<body style="background-color:white;">
    
    <div style="margin-top:95px;">
        <?php $page=''; require('../Includes/navbar.php');  ?>
    <main class="container">
                <div class="col-12">
            <div class="card">
        <div class="card-header">
        <?php
    foreach($merchproducten as $Merch) 
        if( $Merch['GameID'] == $_GET['GameID'] )   
        {
    {?>
        <div class="col-sm-6 col-md-4" style="float:left; " >
        <div class="card mb-4 shadow-sm" style="margin-bottom:0px;" >
            
        <img class="my-webshop-img bd-placeholder-img card-img-top" width="400" height="400"
        src="<?php echo(SITE_URL); ?>/img/<?php echo $Merch['foto']   ?>">
        <div class="card-body">
        <p class="card-text" style="height:65px;">
            
        <strong>
            <a style="color:black;" href="<?php echo(SITE_URL); ?>/merch/merchpagina.php?ProductID=<?php echo $Merch['ProductID']?>"> 
            <?php echo $Merch['Merchnaam']  ?> </a></strong>
            
        </p>               
        <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
        <div class="btn-group">
            
        <a class="btn btn-warning btn-sm" role="button" style="background-color:red; border:none;" href="<?php echo SITE_URL; ?>/Winkelkar/toevoegen.php?ProductID=<?php echo $Merch["ProductID"] ?>" >
        <i><img id="shoppinglogo" src="/img/Navbar/winkelkarretje.png"  height="20px" width="20px"></i>
        </a>
            
        </div>                    
        </div>
        <h3><span class="badge badge-dark">&euro; <?php echo $Merch['ProductPrijs'] ?></span></h3>
        </div>
        </div>
        </div>
        </div>
                    
<?php
       
   } }   // EINDE ITERATIE
?>
     
                     </div> <!--/ row -->
                </div> <!--/ card-body -->
            </div>  <!--/ card -->
        
    </main> <!--/ container -->
    </div>
           
        
      

 </body>
<script src="../js/main.js"></script>
</html>