<?php
    header('Content-Type: application/json');
    $idg= $_GET['id_game'];
    $chats = json_decode(file_get_contents('../chat.json'),true);
    $chat = $chats[$idg];
    $res = '[';
    foreach($chat['messages'] as $m){
        $res = $res.'['.'"'.$m[0].'"'.",".'"'.$m[1].'"],';
    }
    $res = substr_replace($res ,"",-1);
    $res = $res.']';
    
    
    echo $res;
?>