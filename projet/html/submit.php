<?php


$p= $_GET['pseudo'];
$l= $_GET['level'];

$arrayPlayer = array(
    "pseudo"=>$p,
    "level"=>$l
);
$f = json_decode(file_get_contents('../joueurs.json'),true) ;
array_push($f,$arrayPlayer);
$newjsonstring = json_encode($f);




if(count($f)  == 4)
{
    $tapis = array();
    for($i = 0 ; $i< 40 ; $i++){
        array_push($tapis,$i);
    }
    $tapisShuffle=array();
    $j = count($tapis);
    while($j!=0){
        $nbRand = rand(0,($j-1));
        $var = $tapis[$nbRand];
        array_push($tapisShuffle,$var);
        unset($tapis[$nbRand]);
        $tapis = array_values($tapis);
        $j--;
    }
    $main = array();
    $mainsArray = array();

    array_push($main,$tapisShuffle[0]);
    unset($tapisShuffle[$i]);
    $tapisShuffle = array_values($tapisShuffle);
    for($i=1;$i<13;$i++){
        if($i % 3==0){
             array_push($mainsArray,$main);
             $main=array();
             array_push($main,$tapisShuffle[$i]);
             unset($tapisShuffle[$i]);
             $tapisShuffle = array_values($tapisShuffle);

             
        }
        else{
            array_push($main,$tapisShuffle[$i]);
            unset($tapisShuffle[$i]);
            $tapisShuffle = array_values($tapisShuffle);
        }
    }
    $carteTapis=array();
    for($i=0;$i<4;$i++){
        array_push($carteTapis,$tapisShuffle[$i]);
        unset($tapisShuffle[$i]);
        $tapisShuffle = array_values($tapisShuffle);

    }
    /*$i=0;
    array_push($carteTapis,$tapisShuffle[$i]);
    unset($tapisShuffle[$i]);
    $tapisShuffle = array_values($tapisShuffle);
    while(count($carteTapis)!=3){
        $nb = $tapisShuffle[$i];
        $b = true;
        for($j=0;$j<count($carteTapis);$j++){
            if($carteTapis[$j]%4)
        }


    }*/


    

    $parties = json_decode(file_get_contents('../parties.json'),true);
    $id = count($parties);
    $par = ["joueurs"=>$f,"mains"=>$mainsArray,"CarteTapis"=>$carteTapis,"tapis"=>$tapisShuffle];
    $newA = ["idPartie"=>$id,"elementPartie"=>$par];
    array_push($parties,$newA);
    $newjsonstring2 = json_encode($parties);
    file_put_contents('../parties.json',$newjsonstring2);


    
    
}
file_put_contents('../joueurs.json',$newjsonstring);

?>
