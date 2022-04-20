<?php
$id= $_GET['id'];
$longueur = $_GET['len'];

$id2 = $_GET['idPartie'];
$idp = intval($id2); 

$tab = $_GET["str"];
$tab = json_decode("$tab", true);

//Recupération de l'information si il y en ou pas un Missa et actualiser le json ensuite

$missa = $tab["key0"];
$rchem = $tab["key1"];


$tabTour = array();
for($i=2;$i<6;$i++){
    $str = ("key".$i);
    $e = $tab[$str];
    array_push($tabTour,$e);
}


$tabRes = array();
for($i=6;$i<($longueur+6);$i++){
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

$carteArchem = -1;
$partie = $p[$idp];
    if (isset($partie->elementPartie->mains)){
        $m=$partie->elementPartie->mains;
        unset($m[($id-1)][$indiceCarte]);
        $mid = array_values($m[($id-1)]);
        $m[($id-1)] = $mid; 
            
    }

    $s1 = $partie->elementPartie->scoreEquipe1;
    $s2 = $partie->elementPartie->scoreEquipe2;
    if($id == 1 || $id == 3){
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
        if($score==0 || $score==1 ){
            array_push($cf,$valeurCarte);
        } 
       
    }
    $dernierEncaissant = $partie->elementPartie->dernierEncaissant[0]; 
    if($score==0){
        $carteArchem = $valeurCarte;
    }
    else{
        $dernierEncaissant = $id;
    }
    
    $carteArchemYn = [$carteArchem,$rchem];
    $aRt = $partie->elementPartie->RondaTringla;
    $f = $partie->elementPartie->joueurs;
    $tapisShuffle = $partie->elementPartie->tapis;
    $idd = $partie->idPartie;
    $djerya = $partie->elementPartie->djerya;




$par = ["joueurs"=>$f,"mains"=>$m,"RondaTringla"=>$aRt,"CarteTapis"=>$cf,"scoreEquipe1"=>$s1,"scoreEquipe2"=>$s2,"tapis"=>$tapisShuffle,"tour"=>$tabTour,"missa"=>$missa,"djerya"=>$djerya,"carteArchem"=>$carteArchemYn,"dernierEncaissant"=>[$dernierEncaissant,0]];
$newA = ["idPartie"=>$idd,"elementPartie"=>$par];


$p[$idp] = $newA;
//$parties= array();
//array_push($parties,$newA);

file_put_contents('../parties.json',json_encode($p));




?>