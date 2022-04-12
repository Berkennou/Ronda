<?php


$p= $_GET['pseudo'];
$l= $_GET['level'];


$f = json_decode(file_get_contents('../joueurs.json'),true) ;

$arrayPlayer = array(
    "id_joueur"=>count($f),
    "pseudo"=>$p,
    "level"=>$l
);
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
    $arrayRondaTringla = array();

    for($i=0;$i<12;$i++){
        if((($i+1) % 3)==0){
             array_push($main,$tapisShuffle[0]);
             unset($tapisShuffle[0]);
             $tapisShuffle = array_values($tapisShuffle);


             if($main[0] % 10 == $main[1] % 10){
                if($main[0] % 10 == $main[2] % 10){
                    array_push($arrayRondaTringla,2);
                }
                else{
                    array_push($arrayRondaTringla,1);
                }
            }
          else{
            if($main[0] % 10 == $main[2] % 10){
              array_push($arrayRondaTringla,1);
            }
            else{
              if($main[1] % 10 == $main[2] % 10){
                array_push($arrayRondaTringla,1);
              }
              else{
                array_push($arrayRondaTringla,0);
              }
            }
          }

             array_push($mainsArray,$main);
             $main=array();        
        }
        else{
            array_push($main,$tapisShuffle[0]);
            unset($tapisShuffle[0]);
            $tapisShuffle = array_values($tapisShuffle);
        }
    }





    $carteTapis=array();
    $i=0;
    array_push($carteTapis,$tapisShuffle[$i]);
    unset($tapisShuffle[$i]);
    $tapisShuffle = array_values($tapisShuffle);
    while(count($carteTapis)!=4){
        $nb = $tapisShuffle[$i];
        $noexist = true;
        for($k = 0;$k < count($tapisShuffle);++$k)
        {
            if($carteTapis[$k] % 10 == $nb % 10){
                $noexist = false;
                break;
            }
        }
        
        if($noexist)
        {
            array_push($carteTapis,$nb);  
            unset($tapisShuffle[$i]);  
            $tapisShuffle = array_values($tapisShuffle);
        }else{
            $i++;
        }

        
    }




    $parties = json_decode(file_get_contents('../parties.json'),true);
    $parties = array();
    $id = count($parties);
    $par = ["joueurs"=>$f,"mains"=>$mainsArray,"RondaTringla"=>$arrayRondaTringla,"CarteTapis"=>$carteTapis,"scoreEquipe1"=>0,"scoreEquipe2"=>0,"tapis"=>$tapisShuffle];
    $newA = ["idPartie"=>$id,"elementPartie"=>$par];
    
    array_push($parties,$newA);
    $newjsonstring2 = json_encode($parties);
    file_put_contents('../parties.json',$newjsonstring2);
   


    
    
}
file_put_contents('../joueurs.json',$newjsonstring);



?>
