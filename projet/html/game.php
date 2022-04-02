<?php
header('Content-Type: application/json'); 

$id1= $_GET['id'];
$id = intval($id1); 

$p = json_decode(file_get_contents('../parties.json')) ;
$txt = "[";
foreach ($p as $partie) {
 if (isset($partie->elementPartie->mains)){
        $m=$partie->elementPartie->mains;
            $txt = $txt."[";
            for($j=0;$j<count($m[($id-1)]);$j++){
                if($j!=2){
                    
                    $txt = $txt.$m[($id-1)][$j].',';
                }
                else{
                    $txt = $txt.$m[($id-1)][$j];
                }
            }
            $txt = $txt."]".',';  
    
  }

 



  if (isset($partie->elementPartie->CarteTapis)){
    $ct = array();
    $ct = $partie->elementPartie->CarteTapis; 
    $txt = $txt."[";
    for($j=0;$j<count($ct);$j++){
        if($j!=3){
            $txt = $txt.$ct[$j].',';
        }
        else{
            $txt = $txt.$ct[$j];
        }
    }
    $txt = $txt."]".',';

}

if (isset($partie->elementPartie->RondaTringla)){
    $m=$partie->elementPartie->RondaTringla;
        $txt = $txt."[";
        for($j=0;$j<4;$j++){
            if($j!=3){
                $txt = $txt.$m[$j].',';
            }
            else{
                $txt = $txt.$m[$j];
            }
        }
        $txt = $txt."]";  

}



}
$txt = $txt."]";
print ($txt); 


?>