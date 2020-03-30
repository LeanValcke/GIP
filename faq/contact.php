<?php require('../config.php'); ?>
<html>
    <head>
        
        <title>Contact</title>
        <link rel = "icon" href ="../img/Icon/DVP.png"> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="img/favicon.ico" rel="shortcut icon"/>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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

<?php $page='contact'; require ('../Includes/navbar.php'); 


?>
    <body style="  background-color: white;" >
        

    <div class="midden-contact" >  
  
            <br>
            <div class="vraagtitel">
            <h2>Hulp nodig?</h2>
            <h3>Dat komt goed uit, ik kan helpen! <br>Hier zijn de meest gestelde vragen of stuur een e-mail naar DVP.</h3>
           
            </div>
         
        
           <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag1" 
            aria-expanded="false" aria-controls="collapseExample">
                
            Kan ik mijn accountnaam wijzigen? 
            <span  id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>  
            </button>
          
          
            <div class="collapse antwoord" id="vraag1">
             Ja, dit is mogelijk. Druk op u huidige naam, vervolgens op "wijzigen".
            </div>
       
        
            <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag2" 
            aria-expanded="false" aria-controls="collapseExample">
            Kan ik me afmelden voor de nieuwsbrief?
            <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
            </button>
          
          
             <div class="collapse antwoord" id="vraag2">
             Natuurlijk. Klik onderaan de mail op: 'Meld je af' of reageer op de mail dat je geen mails meer wilt ontvangen. Dan zorgen wij ervoor dat je van de mailinglist wordt verwijderd. 
            </div>
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag3" 
        aria-expanded="false" aria-controls="collapseExample">
        Wat kan ik doen als ik mijn pakketje nog niet heb ontvangen?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>
        
        <div class="collapse antwoord" id="vraag3"> 
         Indien je uw pakketje niet binnen de 2 werkdagen hebt ontvangen, kan u een e-mail sturen met uw ordernummer. Dan controleren wij waar uw pakketje zicht bevind.  
        </div>
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag4" 
        aria-expanded="false" aria-controls="collapseExample">
        Welke betaalmogelijkheden heb ik op jullie website?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>
          
          
        <div class="collapse antwoord" id="vraag4">
        Bancontact, Kredietkaart en PayPal. 
        </div>
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag5" 
        aria-expanded="false" aria-controls="collapseExample">
        Hoe lang heb ik garantie op een product?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>
     
        <div class="collapse antwoord" id="vraag5">
        Maximum een jaar.
        </div>
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag6" 
        aria-expanded="false" aria-controls="collapseExample">
        Wat als ik een verkeerd product heb ontvangen?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>

        <div class="collapse antwoord" id="vraag6"> 
        Dat is natuurlijk niet de bedoeling. Stuur ons een e-mail en we zorgen ervoor dat je zo snel mogelijk de juiste bestelling in huis hebt. 
        </div>  
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag7" 
        aria-expanded="false" aria-controls="collapseExample">
        Wat gebeurt er als ik niet thuis ben?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>
 
        <div class="collapse antwoord" id="vraag7">
        De bezorger brengt je pakje naar een afhaalpunt bij jou in de buurt. 
        </div>
        
        <button id="vraagbutton"  type="button" data-toggle="collapse" data-target="#vraag8" 
        aria-expanded="false" aria-controls="collapseExample">
        Wat moet ik doen als mijn verzekerde product schade heeft?
        <span id="grijs" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> 
        </button>
        
        <div class="collapse antwoord" id="vraag8">
        Stuur ons een e-mail en meld je defecte product. 
        </div>
        
        <div class="vraageinde">
        <h3>Indien u vraag niet beantwoord is, kunt u een e-mail sturen naar <a  href="mailto:dvp@hotmail.com" >DVP</a></h3>
        </div>
      
</div>
    
    
</body>
      
</html>
 <?php require('../Includes/footer.php'); ?>
   