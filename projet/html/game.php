<?php
header('Content-Type: application/json'); 
 
$p = json_decode(file_get_contents('../parties.json')) ;
$txt = "[";
foreach ($p as $partie) {
 if (isset($partie->elementPartie->mains)){
        $m=$partie->elementPartie->mains;
        for($i=0;$i<4;$i++){
            $txt = $txt."[";
            for($j=0;$j<3;$j++){
                if($j!=2){
                    $txt = $txt.$m[$i][$j].',';
                }
                else{
                    $txt = $txt.$m[$i][$j];
                }
            }
            if($i!=3){
                $txt = $txt."]".',';
            }
            else{
                $txt = $txt."]";
            }
        }
    
 }
}
$txt = $txt."]";
print ($txt); 


?>