<?php require('../config.php'); 
$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving FROM tblproduct";	
$merchproducten =$dbh->query($sql);?>
<html>
   <head>
         <title>Merchproduct</title>
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
      <?php $page=''; require('../Includes/navbar.php'); ?>
    <div class="midden">
        <?php foreach($merchproducten as $merchproduct) 
     {
    if($merchproduct['ProductID'] ==$_GET['ProductID'])  
    {?>
            <div class="product-grid">
       

    <img src="<?php echo(SITE_URL); ?>/img/<?php echo $merchproduct['foto']; ?>">
        
        <div class="Merch-TextBox ">
            
             <div class="Merch-Textbox-titel" >
            <h2><?php echo $merchproduct['Merchnaam']; ?></h2>
             <h3> €<?php echo $merchproduct['ProductPrijs']; ?></h3>
                 <hr>
                 </div>
            <div class="Merch-Textbox-midden" >
            <h5> <?php echo $merchproduct['Beschrijving']; ?>
            </h5>
         
            
                <h3>Selecteer uw maat</h3>
                  <button style="margin-left:25%;">S</button><button>M</button><button>L</button>
                <hr>
                </div>
           
             <?php $checkoutid = $merchproduct['Beschrijving'];
                
                ?>
                
                <div class="Merch-Textbox-einde" >
           
              <a class="btn btn-warning btn-sm" role="button" style="background-color:red; border:none;" href="<?php echo SITE_URL; ?>/Winkelkar/toevoegen.php?ProductID=<?php echo $merchproduct["ProductID"] ?>" >Winkelmandje</a>
                    <?php if($_SESSION['LOGIN_OK']==true){ ?>
                  <a class="btn btn-warning btn-sm" role="button" style="background-color:black; border:none;" href="<?php echo SITE_URL; ?>/Winkelkar/checkouttoevoegen.php?ProductID=<?php echo $merchproduct["ProductID"] ?>" >Checkout</a>
                      <?php } else { ?> <a class="btn btn-warning btn-sm" role="button" style="background-color:black; border:none;" href="<?php echo SITE_URL; ?>/inlog/aanmelden.php" >Checkout</a>
                      <?php
                            $_SESSION['ALERT_CODE'] = 'ERROR';
        $_SESSION['ALERT_BODY'] = 'Je moet eerst inloggen voor je iets kan kopen!';
                                   }?>
                     </div> 
                    
    
                   
            </div>
          
 
        </div>
        <?php }
} ?>
        
    </div>
           
        
      

 </body>
<script src="../js/main.js"></script>
</html>