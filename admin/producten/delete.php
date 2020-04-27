<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php

if(isset($_POST['delete']) && isset($_POST['productid']))
{
    // Record verwijderen uit database
    var_dump($_POST);
    die();




}
else
{
    echo "Deleten is niet gelukt!";
}
?>



