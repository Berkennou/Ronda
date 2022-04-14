<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Berkennou Brahim - Boukari Idir">
    <title>End Of Partie</title>
</head>
<script>
    function endPartie(){
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{}
      }).done(function(e) {
        {   

            let $tscore = $("<table>");
            $tscore.attr('id','tableScore');
            $tscore.append($("<tr><td>Score Equipe 1</td><td>"+e[4][0]+"</td></tr>"));
            $tscore.append($("<tr><td>Score Equipe 2</td><td>"+e[4][1]+"</td></tr>"));
            
            $('body').append($tscore);
            if(e[4][0]>e[4][1]){
                $('body').append("<span>The Winner is : EQUIPE 1 </span>");
            }
            else{
                $('body').append("<span>The Winner is : EQUIPE 2 </span>");
            }
            console.log("partie terminé pop up affiché");

            
            
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