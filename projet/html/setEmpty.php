<?php
    header('Content-Type: application/json');
    $f = json_decode(file_get_contents('../joueurs.json'),true);
    $f=array();
    file_put_contents('../joueurs.json',json_encode($f));
    print "ok";
