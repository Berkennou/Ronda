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
var intervalId=null;
var  hm = null;
function update(){
        
        $.ajax({
        method: "GET",
        url: "update.php",
        data:{}
      }).done(function(e) {
        {   
          if(hm==null){
            hm=e[0];
          }
          if(e[0]==4){
            let $playButton = $("<button>Play</button>");
            $playButton.attr('id', 'playbutton');
            $playButton.attr('onclick', 'window.location.href = "partie_page.php?id="+hm;');
            $("#divSign").append($playButton); 

            $('body').remove($(".loader"));
            $(".loader").css("display","none");


            let $divP = $("<div>");
            $divP.attr('class',"pressPlay");
            $divP.append("<span class='lettre'>G</span>");
            $divP.append("<span class='lettre'>O</span>");
            $divP.append("<span class='lettre'>  </span>");
            $divP.append("<span class='lettre'>P</span>");
            $divP.append("<span class='lettre'>L</span>");
            $divP.append("<span class='lettre'>A</span>");
            $divP.append("<span class='lettre'>Y</span>");
            $('body').append($divP);



            clearTimeout(intervalId);
          }
          console.log(e[0]+"et "+"hm = "+hm);
                   
        }
      }).fail(function(e) {
        console.log("fail");       
      
      });
    }

    function submit(){
        var str = $("#pseudo").val();
        var str2 = $("#level").val();
        $.ajax({
        method: "GET",
        url: "submit.php",
        data:{"pseudo":str, "level":str2}
      }).done(function(e) {
        {
            $('#signbutton').prop('disabled', true);
            let $divl = $("<div>");
            $divl.attr('class',"loader");
            $divl.append("<span class='lettre'>W</span>");
            $divl.append("<span class='lettre'>A</span>");
            $divl.append("<span class='lettre'>I</span>");
            $divl.append("<span class='lettre'>T</span>");
            $divl.append("<span class='lettre'>I</span>");
            $divl.append("<span class='lettre'>N</span>");
            $divl.append("<span class='lettre'>G</span>");
            $('body').append($divl);




            console.log("ok");
            intervalId = setInterval(update, 1000);
        }

        
      }).fail(function(e) {
        console.log(e);       
      
      });
    }

    
    

        

    </script>
</head>
<body>
    <header>
        <h2>Ronda</h2>
    </header>
    <h2 class='titre'>Sign in</h2>
    <div id="divSign">
            Pseudo :<input type="text"  id="pseudo" />
            <br/>
            <br/>
            <label for="level">Level : </label>
            <select id="level">
                <option value="beginner">Beginner</option>
                <option value="Pre-intermediate">Pre-intermediate</option>
                <option value="intermidiate">Intermidiate</option>
                <option value="advanced">Advanced</option>
                <option value="mastery">Mastery</option>
            </select> 
            <br/><br/>     
            <button id="signbutton" onclick="submit()"> Sign </button>
            <br/>

    </div>



    <footer>
        <p>&copy;CopyRight</p>
    </footer>

   
    
</body>

</html>