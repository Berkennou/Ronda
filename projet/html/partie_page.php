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
        function game(){
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{}
      }).done(function(e) {
        { 
          for(let i=0;i<4;i++){
            let $ladiv = $("<div>"); 
            $ladiv.attr('id','div'+i);
            if(i==2){
                  let $ladivt = $("<div>");
                  $ladivt.attr('id','divTapis'); 
                  for(let k=0;k<4;k++){
                    let $image = $("<img>");
                    $image.attr('src', '../images/'+e[4][k]+'.gif');
                    $image.attr('width','50px');
                    $image.attr('width','100px');
                    $ladivt.append($image);
                     
                    
                  }
                  $('body').append($ladivt);
                  $('body').append("<br>");
                  $('body').append("<br>");

                }
            for(let j=0;j<3;j++){
                
                let $image = $("<img>");
                $image.attr('src', '../images/'+e[i][j]+'.gif');
                $image.attr('width','50px');
                $image.attr('width','100px');
                $ladiv.append($image);
                $('body').append($ladiv);         
              }
            $('body').append("<br>");
            }
      }

      }).fail(function(e) {
        console.log("fail");       
              
      
      });
    }


    

    

    </script>
</head>
<body>
    Partie commencée ;
    <script> 
      game();
    </script>
    
</body>
</html>