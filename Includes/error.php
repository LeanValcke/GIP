<?php 
    if( isset($_SESSION['ALERT_CODE']) and $_SESSION['ALERT_CODE']!='' ) 
    { 
    $alertCode = 'alert-'.( $_SESSION['ALERT_CODE']=='SUCCESS' ? 'success' : 'danger' );
?>    
    <div class="alert error <?php echo $alertCode ?> col-6" role="alert error">
       
    
    <?php echo $_SESSION['ALERT_BODY'] ?>
    </div>

<?php
        
    $_SESSION['ALERT_CODE'] = '';
   
    $_SESSION['ALERT_BODY'] = '';
    } 
?>