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
      var idp =($_GET('idp')); 
        $.ajax({
        method: "GET",
        url: "game.php",
        data:{"id":($_GET('id')),"idPartie":idp}
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
      var idp =($_GET('idp')); 
        $.ajax({
        method: "GET",
        url: "name.php",
        data:{"idPartie":idp}
      }).done(function(e) {
        {   
          console.log(e[indiceOne]);
          console.log(e[indiceTwo]);
          let $spanWinner = $("<span> Winners  <br><br> <br>   "+e[indiceOne] +"   &    "+ e[indiceTwo]+ "<br></span>");
          $spanWinner.attr('id','spanWinner');
          $('body').append($spanWinner);   
            
        }
      
      }).fail(function(e) {
        console.log("fail ya zeh");       
      
      });
    }

    endPartie();


</script>

<body>
    <span id="fpTitre">Partie Terminée</span>

    <div id="imageTourne">
      <img id="im0" class="imgtourne" src="../images/2.gif" />
      <img id="im1" class="imgtourne" src="../images/8.gif" />  
      <img id="im2" class="imgtourne" src="../images/26.gif" />
      <img id="im3" class="imgtourne" src="../images/11.gif" />
  </div>
    
    <button  id="replayButton" onclick ='window.location.href = "authentification_page.php"' >RePlay</button>
    <style>


        body{
            background-image: url("../images/back_fp.jpg");
            background-size: 100%;
        }
       
        #spanWinner{
          position : relative ;
          left : 37%;
          top : 20%;
          font-size :35px;
          text-align : center;
          width : 400px;
          height : 300px;
          

          color : white;
          background : gray;
          font-size : 40px;
          text-align: center;
          position: absolute;
          padding : 10px;
          border: 2px solid white;
          border-radius: 10px;
          outline: none;
          

        }



        #tableScore {
            position : relative;
            left : 80%;
            top : 25%;
            border: 3px solid;
            table-layout: fixed;
            width: 300px;
            height : 100px;
            font-size : 25px;
            text-align : center;
            background-color : gray;
        
        }

        tr, td{
            border : black 2px solid;
            color : white;
            padding : 5px;
            
        }

        #im0{
          position: absolute;
          left : 10%;
          top : 75%;
  
}
  #im1{
    position: absolute;
    left : 30%;
    top : 75%;
    
  }
  #im2{
    position: absolute;
    left : 50%;
    top : 75%;
    
  }
  #im3{
    position: absolute;
    left : 80%;
    top : 75%;
    
  }

  .imgtourne{
  border-radius: 2px;
  margin-left: 0px;
  -webkit-animation:spin 4s linear infinite;
  -moz-animation:spin 4s linear infinite;
  animation:spin 4s linear infinite;
  padding: 20px;
  }
  @-moz-keyframes spin { 100% { -moz-transform: rotateY(360deg); } }
  @-webkit-keyframes spin { 100% { -webkit-transform: rotateY(360deg); } }
  @keyframes spin { 100% { -webkit-transform: rotateY(360deg); transform:rotateY(360deg); } }


  #replayButton{
  text-align: center;
  position: absolute;
  left: 35%;
  top: 65%;
  width: 30%;
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 50px;
  border: 2px solid white;
  background: gray;
  outline: none;
  color : white;
  transition: border-color 0.5s;
}
#replayButton:hover{
  background : blue;
  color : yellow;
  font-weight : bold;
  font-size : 25px;
  
}
#fpTitre:hover, #spanWinner:hover{
  background : blue;
  color : yellow;
  font-weight : bold;
  font-size : 45px;
}
#tableScore:hover{
  background : blue;
  color : yellow;
  font-color : yellow;
  font-weight : bold;
  
}




#fpTitre{
          color : white;
          background : gray;
          font-size : 40px;
          text-align: center;
          position: absolute;
          padding : 10px;
          border: 2px solid white;
          border-radius: 20px;
          outline: none;
          position : absolute;
          left : 40%;
          top : 5%;

        }


    </style>
    

</body>
</html>