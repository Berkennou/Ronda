<?php
header('Content-Type: application/json'); 
$p = json_decode(file_get_contents('../parties.json')) ;
$txt = "[";
foreach ($p as $partie) {
    if (isset($partie->elementPartie->joueurs)){
        $joueurs =$partie->elementPartie->joueurs; 
        for($i=0;$i<4;$i++){
            foreach($joueurs[$i] as $key => $value){
                if($key = "pseudo"){
                if($i!=3){
                
                    $txt = $txt.$value.',';
                }
                else{
                    $txt = $txt.$value;
                }
                
              }
            }
            
            
        }


}
}

$txt = $txt."]";
print $txt;


?>