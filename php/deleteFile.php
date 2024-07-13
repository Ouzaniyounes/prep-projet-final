<?php 

ini_set('display_errors', 1);
$status = unlink("../res/img/277736639_2872316936246981_6722882252571223528_n (1).jpg");

if($status){  
    echo "File deleted successfully";    
    } else{  
        echo "Sorry!";    
    }  



?>