<?php
header('Content-Type: application/json'); 
$id2 = $_GET['idPartie'];
$idp = intval($id2); 
$p = json_decode(file_get_contents('../parties.json'));

$partie = $p[$idp];
    $b=true;
    if (isset($partie->elementPartie->mains)){
        $mainsTest = array();
        $mainsTest = $partie->elementPartie->mains;
        
        for($i=0;$i<4;$i++){
            if(!(empty($mainsTest[$i]))){
                $b=false;

            }

        }

    }



    if($b==true){
        if (isset($partie->elementPartie->tapis)){
            $tapisShuffle = array();
            $tapisShuffle = $partie->elementPartie->tapis; 
            
            if(count($tapisShuffle)>0){

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


                $partie->elementPartie->tapis = $tapisShuffle;
                $partie->elementPartie->RondaTringla = $arrayRondaTringla;
                $partie->elementPartie->mains = $mainsArray;

                $djerya = $partie->elementPartie->djerya;
                $partie->elementPartie->djerya = $djerya-1;
                $partie->elementPartie->dernierEncaissant = [-1,0];
                
                $r = 99;
                print "[".$r.",".$r."]";
                



            }
            else{

                $dernierEncaissant =$partie->elementPartie->dernierEncaissant[0];
                if($partie->elementPartie->dernierEncaissant[1]==0){
                    if($dernierEncaissant == 1 || $dernierEncaissant == 3){
                        $partie->elementPartie->scoreEquipe1 += count($partie->elementPartie->CarteTapis);
                        $partie->elementPartie->dernierEncaissant[1] = 1;
                    
                    }
                    else{
                        $partie->elementPartie->scoreEquipe2 += count($partie->elementPartie->CarteTapis);
                        $partie->elementPartie->dernierEncaissant[1] = 1;
                            
                    }
            }

                print "[".$dernierEncaissant.",".count($partie->elementPartie->CarteTapis)."]";
            }

                    
        }
    }
    else{
        $r = 99;
        print "[".$r.",".$r."]";
        
    }






file_put_contents('../parties.json',json_encode($p));
?>