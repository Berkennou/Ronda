<?php
    $idg= $_GET['id_game'];
    $idp= $_GET['id_player'];
    $text = $_GET['message'];
    if(strlen($text) != 0){
        $p = json_decode(file_get_contents('../parties.json')) ;
        $partie = $p[$idg];
        $name = $partie->elementPartie->joueurs[$idp-1]->pseudo;

        $chats = json_decode(file_get_contents('../chat.json'),true);
        $chat = $chats[$idg];

        $message = array();
        array_push($message,$name);
        array_push($message,$text);
        $m = $chat['messages'];
        array_push($m,$message);
        $chat['messages'] = $m;
        $chats[$idg] = $chat;
        file_put_contents('../chat.json',json_encode($chats));
    }
    print('chat');
?>