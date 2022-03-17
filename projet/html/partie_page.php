<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Berkennou Brahim - Boukari Idir">
    <link rel="stylesheet" type="text/css" href="../style/authentification_style.css" media="screen" />
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
          console.log(e[0][0]);          
        }
      }).fail(function(e) {
        console.log("fail");       
              
      
      });
    }


    

    

    </script>
</head>
<body>
    Partie commencée ; 
    <button id="distribuer" onclick="game()"> Distribuer </button>
    
</body>
</html>