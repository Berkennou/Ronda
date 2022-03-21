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
            $txt = $txt."]".',';  
    }
  }
  if (isset($partie->elementPartie->CarteTapis)){
    $ct = $partie->elementPartie->CarteTapis; 
    $txt = $txt."[";
    for($j=0;$j<4;$j++){
        if($j!=3){
            $txt = $txt.$ct[$j].',';
        }
        else{
            $txt = $txt.$ct[$j];
        }
    }
    $txt = $txt."]";

}
}
$txt = $txt."]";
print ($txt); 


?>