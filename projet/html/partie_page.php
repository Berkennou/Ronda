<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Berkennou Brahim - Boukari Idir">
    <link rel="stylesheet" type="text/css" href="../style/partie_style_f.css" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Ronda</title>
    <script> 
    var interval=null;
    var missa = 0;
    var rchem = 0;
    var djerya = null;


        function $_GET(param) {
          var vars = {};
          window.location.href.replace( location.hash, '' ).replace( 
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
              vars[key] = value !== undefined ? value : '';
            }
          );

          if ( param ) {
            return vars[param] ? vars[param] : null;	
          }
          return vars;
        }

        

        function game(){
        var idd=($_GET('id'));
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{"id":idd}
      }).done(function(e) {
        { 
          console.log(e);
          for(let i=0;i<4;i++){
            let $ladiv = $("<div>"); 
            $ladiv.attr('id','div'+i);
            if(i==2){
                  let $ladivt = $("<div>");
                  $ladivt.attr('id','divTapis'); 
                  for(let k=0;k<(e[1].length);k++){
                    let $image = $("<img>");
                    $image.attr('id',e[1][k]);
                    $image.attr('src', '../images/'+e[1][k]+'.gif');
                    $image.attr('width','50px');
                    $image.attr('width','100px');
                    $ladivt.append($image);
                     
                    
                  }
                  $('body').append("<br>");

                  $('body').append($ladivt);
                  $('body').append("<br>");
                  $('body').append("<br>");
                  
            }
             if(i==(idd-1)){
              for(let j=0;j<(e[0].length);j++){
                
                let $image = $("<img>");
                $image.attr('id',e[0][j]);
                $image.attr('src', '../images/'+e[0][j]+'.gif');
                $image.attr('width','50px');
                $image.attr('width','100px');
                $ladiv.append($image);
                $('body').append($ladiv);         
          }

          if(e[2][i]==1){
                 let $image = $("<img>");
                  $image.attr('src', '../images/ronda_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  $('body').append($ladiv);
          }
          else{
            if(e[2][i]==2){
              let $image = $("<img>");
                  $image.attr('src', '../images/tringla_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  $('body').append($ladiv);
            }
            }
          }



            else{
              for(let j=0;j<3;j++){
                  
                  let $image = $("<img>");
                  $image.attr('src', '../images/back.jpg');
                  $image.attr('width','50px');
                  $image.attr('width','100px');
                  $ladiv.append($image);
                  $('body').append($ladiv);         
                }
                  
                if(e[2][i]==1){
                 let $image = $("<img>");
                  $image.attr('src', '../images/ronda_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  $('body').append($ladiv);
          }
            else{
              if(e[2][i]==2){
                let $image = $("<img>");
                    $image.attr('src', '../images/tringla_symbole.png');
                    $image.attr('width','40px');
                    $image.attr('width','40px');
                    $ladiv.append($image);
                    $('body').append($ladiv);
              }


                $('body').append("<br>");
              }
          }
          
        }
          

              let $tscore = $("<table>");
              $tscore.append($("<tr><td>Score Equipe 1</td><td>"+e[4][0]+"</td></tr>"));
              $tscore.append($("<tr><td>Score Equipe 2</td><td>"+e[4][1]+"</td></tr>"));
              $tscore.attr('id','tableScore');
              $('body').append($tscore);

              djerya = e[7][0];
              let $djeryaSpan = $("<span>Djerya "+djerya+"</span>");
              $djeryaSpan.attr('id','djeryaSpan');
              $('body').append($djeryaSpan);

              let $ladivP = $("<div>");
              $ladivP.attr('id','divPaquet'); 
              for(let k=0;k<4;k++){
                  let $image = $("<img>");
                  $image.attr('id','imagePaquet'+k);
                  $image.attr('src', '../images/back.jpg');
                  $image.attr('width','50px');
                  $image.attr('width','100px');
                  $ladivP.append($image);
              }

              $('body').append($ladivP);



              for(var i=0;i<4;i++){
                if(e[5][i]==1){
                  $("#div"+i).css("border-width",'5px');
                  $("#div"+i).css("border-style",'solid');
                  $("#div"+i).css("border-color",'gray');
                  $("#div"+i).css("border-radius",'6px');
                
                }
                else{
                  $("#div"+i).css("border-width" ,"0px");
                }
        }


             
              if(e[5][idd-1]==1){
                
                $( "#"+e[0][0] ).click(function() {
                    $( "#"+e[0][0] ).animate({

                      
                      width: [ "toggle", "swing" ],
                      height: [ "toggle", "swing" ],
                      opacity: "toggle"
                    }, 1000, "linear", function() {
                      var tourTable = e[5];
                      if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;

                      var tabRes = game_loop(e[0][0],0,e[1],e[8][0]);
                      play(tabRes,tourTable,missa);
                      
                      
                      
                    });
                  });



            $( "#"+e[0][1] ).click(function() {
                $( "#"+e[0][1] ).animate({

                  
                  width: [ "toggle", "swing" ],
                  height: [ "toggle", "swing" ],
                  opacity: "toggle"
                }, 1000, "linear", function() {
                  var tourTable = e[5];
                  if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;
                  var tabRes = game_loop(e[0][1],1,e[1],e[8][0]);
                  play(tabRes,tourTable,missa);
                  
                  
                  
                });
              });




              $( "#"+e[0][2] ).click(function() {
                $( "#"+e[0][2] ).animate({

                  
                  width: [ "toggle", "swing" ],
                  height: [ "toggle", "swing" ],
                  opacity: "toggle"
                }, 1000, "linear", function() {
                  var tourTable = e[5];
                  if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;
                  var tabRes = game_loop(e[0][2],2,e[1],e[8][0]);
                  play(tabRes,tourTable,missa);
                  
                  
                  
                });
              });
              
              
          }
          interval= setInterval(game_continue, 500);

            
          
          
      }

      }).fail(function(e) {
        console.log(e);       
              
      
      });
    }



    function arrayEquals(a, b) {
    return Array.isArray(a) &&
        Array.isArray(b) &&
        a.length == b.length &&
        a.length !=0 &&
        b.length !=0 &&
        a.every((val, index) => val == b[index]);
}


    function game_loop(valeurCarte,indiceCarte,cartesDuTapis,carteArchem){
      var scoreCoup = 0 ; 
      cartesDuTapis = cartesDuTapis.sort((a, b) => (a%10) - (b%10));
      var carteAprendre = [];
      for(var i = 0 ; i<cartesDuTapis.length;i++){
        if((valeurCarte%10) ==(cartesDuTapis[i]%10) ){
          scoreCoup =2;
          carteAprendre.push(cartesDuTapis[i]);
          for(let j =i ;j<cartesDuTapis.length;j++){
            if(j+1 != cartesDuTapis.length ){
              if(((cartesDuTapis[j]%10)+1) ==(cartesDuTapis[j+1] %10)){
                scoreCoup++;
                carteAprendre.push(cartesDuTapis[j+1]);
              }
              else{
                break;
              }
            }
          }
          break;
            
        }
      }

      if(arrayEquals(carteAprendre,cartesDuTapis)){
        scoreCoup++;
        missa = 1;
        
      }
      if(carteArchem!=-1 && (carteArchem%10) == (valeurCarte%10)){
        scoreCoup++;
        rchem = 1;
      }

      var tabRes = [];
      tabRes.push(indiceCarte);
      tabRes.push(valeurCarte);
      tabRes.push(scoreCoup);
      for(var i =0 ;i<carteAprendre.length;i++ ){
        tabRes.push(carteAprendre[i]);
      }
      console.log(tabRes);
      return tabRes;
        
    }







    function play(tabRes,tourTable,missa){
        var stuff = {};

        stuff['key0']  = missa;
        stuff['key1']  = rchem;

        for(var i=2;i<tourTable.length+2;i++){
          stuff['key'+i] = tourTable[i-2];
        }

        var j =0;
        for(var i=6;i<((tabRes.length)+6);i++){
          stuff['key'+i] = tabRes[j];
          j++;
        }
        var idd=($_GET('id'));
        $.ajax({
        method: "GET",
        url: "play.php",
        data:{"str":JSON.stringify(stuff),"id":idd,"len":tabRes.length}
      }).done(function(e) {
        {

            console.log(stuff);
            console.log("json modifié");
            
            
        }

        
      }).fail(function(e) {
        console.log("fail");
        console.log(e);       
      
      });
    }






    function game_continue(){
      var idd =($_GET('id'));
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{"id":idd}
      }).done(function(e) {
        {
          
          $('#divTapis').empty();
          $('#div0').empty();
          $('#div1').empty();
          $('#div2').empty();
          $('#div3').empty();
          $('#tableScore').empty();
          
          //Verifier si toutes les mains des joueurs sont vides pour redistribuer
          let b = false;
          for(let i=0;i<e[3].length;i++){
            if(e[3][i] !=0){
              b= true;
            }
          }

          if(b==false){
            clearTimeout(interval);
            redistribuer();
          }


          if(djerya!=e[7][0]){
            $('#djeryaSpan').remove();
            djerya = e[7][0];
            let $djeryaSpan = $("<span>Djerya "+djerya+"</span>");
            $djeryaSpan.attr('id','djeryaSpan');
            $('body').append($djeryaSpan);
          }

          if(djerya==0){
            $("#divPaquet").remove();
          }
          


          for(let i=0;i<4;i++){
            let $ladiv = $('#div'+i);
            
            if(i==2){
                  let $ladivt = $('#divTapis');
                  for(let k=0;k<(e[1].length);k++){
                    let $image = $("<img>");
                    $image.attr('id',e[1][k]);
                    $image.attr('src', '../images/'+e[1][k]+'.gif');
                    $image.attr('width','50px');
                    $image.attr('width','100px');
                    $ladivt.append($image);
                     
                    
                  }
                  $('body').append("<br>");
                  $('body').append("<br>");
                  $('body').append("<br>");
                  
            }
             if(i==(idd-1)){
              for(let j=0;j<(e[0].length);j++){        
                let $image = $("<img>");
                $image.attr('id',e[0][j]);
                $image.attr('src', '../images/'+e[0][j]+'.gif');
                $image.attr('width','50px');
                $image.attr('width','100px');
                $ladiv.append($image);
                        
          }

          if(e[2][i]==1){
                 let $image = $("<img>");
                  $image.attr('src', '../images/ronda_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  
          }
          else{
            if(e[2][i]==2){
              let $image = $("<img>");
                  $image.attr('src', '../images/tringla_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  
            }
            }
          }



            else{
              for(let j=0;j<e[3][i];j++){
                  
                  let $image = $("<img>");
                  $image.attr('src', '../images/back.jpg');
                  $image.attr('width','50px');
                  $image.attr('width','100px');
                  $ladiv.append($image);
                           
                }
                  
                if(e[2][i]==1){
                 let $image = $("<img>");
                  $image.attr('src', '../images/ronda_symbole.png');
                  $image.attr('width','40px');
                  $image.attr('width','40px');
                  $ladiv.append($image);
                  
          }
            else{
              if(e[2][i]==2){
                let $image = $("<img>");
                    $image.attr('src', '../images/tringla_symbole.png');
                    $image.attr('width','40px');
                    $image.attr('width','40px');
                    $ladiv.append($image);
                    
              }


                $('body').append("<br>");
              }
          }
          
        }




        let $tscore = $("#tableScore");
        $tscore.append($("<tr><td>Score Equipe 1</td><td>"+e[4][0]+"</td></tr>"));
        $tscore.append($("<tr><td>Score Equipe 2</td><td>"+e[4][1]+"</td></tr>"));

        $missaExiste =  document.getElementById('missaSpan');
        if($missaExiste!=null){
          $('#missaSpan').remove();
        }
        $rchemExiste =  document.getElementById('rchemSpan');
        if($rchemExiste!=null){
          $('#rchemSpan').remove();
        }

        if(e[6][0]==1){
          let $missaSpan = $("<span>Missa +1</span>");
          $missaSpan.attr('id','missaSpan');
          $('body').append($missaSpan);
          missa = 0;
          
        }

        if(e[8][1]==1){
          let $rchemSpan = $("<span>Rchem +1</span>");
          $rchemSpan.attr('id','rchemSpan');
          $('body').append($rchemSpan);
          rchem = 0;
          
        }



        for(var i=0;i<4;i++){
          if(e[5][i]==1){
            $("#div"+i).css("border-width",'5px');
            $("#div"+i).css("border-style",'solid');
            $("#div"+i).css("border-color",'gray');
            $("#div"+i).css("border-radius",'6px');
          
          }
          else{
            $("#div"+i).css("border-width" ,"0px");
          }
        }

        
        if(e[5][idd-1]==1){
          
          $( "#"+e[0][0] ).click(function() {
                  let pos=$( "#"+e[0][0] )[0].getBoundingClientRect();
                  let posTapis=$( "#divTapis" )[0].getBoundingClientRect();
                  
                  $( "#"+e[0][0] ).appendTo("body").css({"left":pos.left,"top":pos.top,"position":"absolute"});
                  $( "#"+e[0][0] ).animate({

                    transform:"scale(2)",
                    left:posTapis.left,
                    top: posTapis.top ,
                    opacity: "toggle"
                  }, 1000, "linear", function() {
                    var tourTable = e[5];
                    if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;
                    var tabRes = game_loop(e[0][0],0,e[1],e[8][0]);
                    play(tabRes,tourTable,missa);
                    
                    
                  });
                });



          $( "#"+e[0][1] ).click(function() {
            let pos=$( "#"+e[0][1] )[0].getBoundingClientRect();
            let posTapis=$( "#divTapis" )[0].getBoundingClientRect();
            $( "#"+e[0][1] ).appendTo("body").css({"left":pos.left,"top":pos.top,"position":"absolute"});
              $( "#"+e[0][1] ).animate({

                
                transform:"scale(2)",
                left:posTapis.left,
                top: posTapis.top,
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = e[5];
                if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;
                var tabRes = game_loop(e[0][1],1,e[1],e[8][0]);
                play(tabRes,tourTable,missa);
                
                
              });
            });




            $( "#"+e[0][2] ).click(function() {
              let pos=$( "#"+e[0][2] )[0].getBoundingClientRect();
              let posTapis=$( "#divTapis" )[0].getBoundingClientRect();
              $( "#"+e[0][2] ).appendTo("body").css({"left":pos.left,"top":pos.top,"position":"absolute"});

              $( "#"+e[0][2] ).animate({

                
                transform:"scale(2)",
                left:posTapis.left,
                top: posTapis.top,
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = e[5];
                if(idd!=4){
                        
                        tourTable[idd] = 1;

                      }
                      else{
                        
                        tourTable[0] = 1;

                      }
                      tourTable[idd-1] = 0;
                var tabRes = game_loop(e[0][2],2,e[1],e[8][0]);
                play(tabRes,tourTable,missa);
                
                
              });
            });

          }
            
            
        
            
        }

        
      }).fail(function(e) {
        console.log("fail");
               
      
      });
    } 




    function redistribuer(){
        $.ajax({
        method: "GET",
        url: "redistribuer.php",
        data:{}
      }).done(function(e) {
        {
            if(e[0]==99){
              interval= setInterval(game_continue, 1000);
            }
            else if(e[0]>=1 && e[0]<=4){
              let $tapisSpan = $("<span>Tapis + "+e[1]+"</span>");
              $tapisSpan.attr('id','tapisSpan');
              $('body').append($tapisSpan);

              window.open("end_of_partie_page.php?id="+$_GET('id'),"Game Over", "height=400px, width=500px, menubar='yes', toolbar='yes', location='yes', status='yes', scrollbars='yes'");
              console.log("partie terminé");

            }
            else{
              interval= setInterval(game_continue, 1000);
            }
            console.log("c'est fait"+e);
        }

        
      }).fail(function(e) {
        console.log("Fail putain");       
      
      });
    }












    
    game();
    

    

    </script>
</head>
<body>

</body>
</html>