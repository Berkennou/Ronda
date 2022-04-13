<?php
header('Content-Type: application/json'); 
$p = json_decode(file_get_contents('../parties.json'));
foreach ($p as $partie) {
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
                print 1;
                



            }
            else{
                print 0;
            }

                    
        }
    }
    else{
        print 2;
    }




}

file_put_contents('../parties.json',json_encode($p));


?>