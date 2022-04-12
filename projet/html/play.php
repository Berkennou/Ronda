<?php
$id= $_GET['id'];
$longueur = $_GET['len'];

$tab = $_GET["str"];
$tab = json_decode("$tab", true);
$tabRes = array();
for($i=0;$i<$longueur;$i++){
    $str = ("key".$i);
    $e = $tab[$str];
    array_push($tabRes,$e);
}

for($i=0;$i<$longueur;$i++){
    echo"voila ".$tabRes[$i]."<br/>";
}




$indiceCarte =$tabRes[0];
unset($tabRes[0]);
$tabRes = array_values($tabRes);

$valeurCarte =$tabRes[0];
unset($tabRes[0]);
$tabRes = array_values($tabRes);

$score = $tabRes[0];
unset($tabRes[0]);
$tabRes = array_values($tabRes);

$p = json_decode(file_get_contents('../parties.json'));
$m= array();
$c = array(); 


foreach ($p as $partie) {
    if (isset($partie->elementPartie->mains)){
        $m=$partie->elementPartie->mains;
        unset($m[($id-1)][$indiceCarte]);
        $mid = array_values($m[($id-1)]);
        $m[($id-1)] = $mid; 
            
    }

    $s1 = $partie->elementPartie->scoreEquipe1;
    $s2 = $partie->elementPartie->scoreEquipe2;
    if($id == 1 || $id == 4){
        $s1 += $score;
    
    }
    else{
        $s2 += $score;
               
    }

  if (isset($partie->elementPartie->CarteTapis)){
        $c = array();
        $c = $partie->elementPartie->CarteTapis;
        $cf = array(); 
        for($k=0;$k<count($c);$k++){
            if(!(in_array($c[$k],$tabRes))){
                array_push($cf,$c[$k]);
            }
        }
        if($score==0){
            array_push($cf,$valeurCarte);
        } 
       
    }

    $aRt = $partie->elementPartie->RondaTringla;
    $f = $partie->elementPartie->joueurs;
    $tapisShuffle = $partie->elementPartie->tapis;
    $idd = $partie->idPartie;
}



$par = ["joueurs"=>$f,"mains"=>$m,"RondaTringla"=>$aRt,"CarteTapis"=>$cf,"scoreEquipe1"=>$s1,"scoreEquipe2"=>$s2,"tapis"=>$tapisShuffle];
$newA = ["idPartie"=>$idd,"elementPartie"=>$par];



$parties= array();
array_push($parties,$newA);

file_put_contents('../parties.json',json_encode($parties));




?>