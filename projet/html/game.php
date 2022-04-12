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
            $indiceFin = count($m[($id-1)]);
            for($j=0;$j<$indiceFin;$j++){
                if($j!=($indiceFin-1)){
                    
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
    $indiceFinCt = count($ct);
    for($j=0;$j<$indiceFinCt;$j++){
        if($j!=($indiceFinCt-1)){
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
        $txt = $txt."]".',';  

}


if (isset($partie->elementPartie->mains)){
    $m=$partie->elementPartie->mains;
        $txt = $txt."[";
        
        for($j=0;$j<4;$j++){
            if($j!=3){
                
                $txt = $txt.count($m[$j]).',';
            }
            else{
                $txt = $txt.count($m[$j]);
            }
        }
        $txt = $txt."]".',';  

}

if (isset($partie->elementPartie->scoreEquipe1) && isset($partie->elementPartie->scoreEquipe2)){
    $s1=$partie->elementPartie->scoreEquipe1;
    $s2=$partie->elementPartie->scoreEquipe2;
    $txt = $txt."[";
    $txt = $txt.$s1.',';
    $txt = $txt.$s2;

        
    $txt = $txt."]";  

}

}
$txt = $txt."]";
print ($txt); 


?>