<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php
//connectie
//var_dump($_GET['id']);
//die();

$sql = "DELETE FROM tblproduct WHERE ProductID=" . $_GET['id'];
$productlijst = $dbh->query($sql);

if($productlijst)
    header("refresh:1; url=index.php");
else
    echo "Niet verwijderd!";
?>

