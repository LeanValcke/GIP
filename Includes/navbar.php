<header class="header-section">
    <nav class="header-nav">
        <a href="<?php echo SITE_URL; ?>/index.php" class="dvp-logo">DVP</a>
        <ul class="main-menu">
            <li ><a href="<?php echo SITE_URL; ?>/index.php" class="<?php if ($page=='index'){echo 'active';} ?>">Home</a></li>
            <li><a href="<?php echo SITE_URL; ?>/merch/products.php" class="<?php if ($page=='products'){echo 'active';}?>">Games</a></li>
            <li><a href="<?php echo SITE_URL; ?>/faq/contact.php" class="<?php if ($page=='contact'){echo 'active';}?>">Contact</a>
            </li>
            <li id="margin-li">
                <div class="li-foto">
                    <a class="<?php if ($page=='winkelkar'){echo 'zwart-navbar';}?>"href="<?php echo SITE_URL; ?>/Winkelkar/winkelkar.php"> <img src="<?php echo SITE_URL; ?>/img/Navbar/winkelkarretje.png">Winkelmand</a>
                </div>
            </li>

            <li><a class="<?php if ($page=='inlog'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/inlog/aanmelden.php"><?php 
                if($_SESSION['LOGIN_OK'] == true)
                {

                    echo $_SESSION['USERNAME'] ;}
                else
                { 
                ?> Inloggen<?php 
                } ?></a> </li>
        </ul>
        <?php if( $_SESSION['LOGIN_OK'] ) { ?>
        <?php } ?>

    </nav>
</header>

<!--
<?php if( $_SESSION['IS_ADMIN'] ) { ?>
<nav>
    <ul class="beheer">

        <li class="nav-item dropdown">
            <button class="nav-link dropdown-toggle" href="#" id="DropDownAdmin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Beheer</button>
        </li>

        <div class="dropdown-menu" aria-labelledby="DropDownAdmin">
            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/bestellingen/index.php">
                Bestellingen
            </a>
            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/gebruikers/index.php">
                Gebruikers
            </a>
            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/producten/index.php">
                Producten
            </a>
            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/categorieen/index.php">
                Categorieën
            </a>
        </div>
    </ul>
</nav>
<?php } ?>   
-->
