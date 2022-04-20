<?php
header('Content-Type: application/json');
$id2 = $_GET['idPartie'];
$idp = intval($id2); 
$p = json_decode(file_get_contents('../parties.json')) ;
$txt = "[";
$partie = $p[$idp];
    if (isset($partie->elementPartie->joueurs)){
        $joueurs =$partie->elementPartie->joueurs; 
        for($i=0;$i<4;$i++){
            foreach($joueurs[$i] as $key => $value){
                
                if($key == "pseudo"){
                    $nnn = '"'.$value.'"';
                    if($i!=3){
                        
                        $txt = $txt.$nnn.',';
                    }
                    else{
                        $txt = $txt.$nnn;
                    }
                
              }
            }
            
            
        }


}


$txt = $txt."]";
print $txt;


?>