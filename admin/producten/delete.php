<?php require('../../config.php'); ?>
<?php require_once '../../databank.php'; ?>
<?php


if(isset($_POST['delete']))
{
    
     //connectie
        $dbh = new PDO (DB_CONNECTION, DB_USERNAME, DB_PASSWORD);
    
    $chkarr = $_POST['checkbox'];
    foreach($chkarr as $ProductID)
    {
        $sql = "DELETE FROM tblproduct WHERE ProductID=".$ProductID;
    }
        header("refresh:1; url=index.php");
}
else
{
    echo "niet gelukt";
}
?>



