<?php
    
    header('Content-Type: application/json'); 
    $f = json_decode(file_get_contents('../joueurs.json'),true) ;
    $e = count($f);
    
    $id = -1;

    $res = "[".$e.','.$id."]";

    print($res);
?>