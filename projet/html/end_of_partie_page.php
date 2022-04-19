<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/partie_style_f.css" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="author" content="Berkennou Brahim - Boukari Idir">
    <title>End Of Partie</title>
</head>
<script>

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




    function endPartie(){
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{"id":($_GET('id'))}
      }).done(function(e) {
        {   

            let $tscore = $("<table>");
            $tscore.attr('id','tableScore');
            $tscore.append($("<tr><td>Score Equipe 1</td><td>"+e[4][0]+"</td></tr>"));
            $tscore.append($("<tr><td>Score Equipe 2</td><td>"+e[4][1]+"</td></tr>"));
            
            $('body').append($tscore);
            if(e[4][0]>e[4][1]){
                displayNames(0,2);
                
            }
            else{
              displayNames(1,3);
                
            }
            console.log("partie terminé pop up affiché");

            
            
        }
      
      }).fail(function(e) {
        console.log("fail ya zeh");       
      
      });
    }






    function displayNames(indiceOne,indiceTwo){
        $.ajax({
        method: "GET",
        url: "name.php",
        data:{}
      }).done(function(e) {
        {   
          $('body').append("<span>The Winners are"+e[indiceOne] + e[indiceTwo]+ "</span>");
            

            
            
        }
      
      }).fail(function(e) {
        console.log("fail ya zeh");       
      
      });
    }

    endPartie();


</script>

<body>
    <span>Partie Terminé</span>
    
    <button id="replayButton" onclick ='window.location.href = "authentification_page.php"' >RePlay</button>
    <style>
        body{
            background-image: url("../images/eop_symbole.png");
            background-size: cover;
        }
        #tableScore {
            position : absolute;
            left : 80%;
            top : 30%;
            border: 3px solid;
            table-layout: fixed;
            width: 200px;
            height : 50px;
            text-align : center;
            background-color : gray;
        
        }

        tr, td{
            border : black 2px solid;
            color : white;
        }

    </style>
    

</body>
</html>