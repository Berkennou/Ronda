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
    //Declaration de variables globales
    var interval = null;
    var missa = 0;
    var rchem = 0;
    var djerya = null;
    var idPlayer = ($_GET('id'));
    var rondaCompte = false;
    var tringlaCompte = false;
    var rondaDisp = false;
    var tringlaDisp = false;

    //Fonction pour récupérer les information passées dans l'URL en appelant la page courante
    function $_GET(param) {
      var vars = {};
      window.location.href.replace(location.hash, '').replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function(m, key, value) { // callback
          vars[key] = value !== undefined ? value : '';
        }
      );

      if (param) {
        return vars[param] ? vars[param] : null;
      }
      return vars;
    }

    //Fonction qui affiche les cartes du joueur courant
    function displayCartesPlayer(cartePlayer, $ladiv) {
      for (let j = 0; j < (cartePlayer.length); j++) {

        let $image = $("<img>");
        $image.attr('id', cartePlayer[j]);
        $image.attr('src', '../images/' + cartePlayer[j] + '.gif');
        $image.attr('width', '50px');
        $image.attr('width', '100px');
        $ladiv.append($image);
        $('body').append($ladiv);
      }
    }

    //Fonction qui affiche le symbole Ronda
    function displayRondaSymbole($ladiv) {
      let $image = $("<img>");
      $image.attr('src', '../images/ronda_symbole.png');
      $image.attr('width', '40px');
      $image.attr('width', '40px');
      $ladiv.append($image);
      $('body').append($ladiv);
    }

    //Fonction qui affiche le symbole Tringla  
    function displayTringlaSymbole($ladiv) {
      let $image = $("<img>");
      $image.attr('src', '../images/tringla_symbole.png');
      $image.attr('width', '40px');
      $image.attr('width', '40px');
      $ladiv.append($image);
      $('body').append($ladiv);
    }
    //Fonction qui affiche les cartes de dos des autres joueurs 
    function displayCartesBackOtherPlayers($ladiv, nbCartes) {
      for (let j = 0; j < nbCartes; j++) {
        let $image = $("<img>");
        $image.attr('src', '../images/back.jpg');
        $image.attr('width', '50px');
        $image.attr('width', '100px');
        $ladiv.append($image);
        $('body').append($ladiv);
      }
    }
    //Fonction qui affiche les cartes de dos du paquets tout en haut à gauche
    function displayPaquetCartes() {
      let $ladivP = $("<div>");
      $ladivP.attr('id', 'divPaquet');
      for (let k = 0; k < 4; k++) {
        let $image = $("<img>");
        $image.attr('id', 'imagePaquet' + k);
        $image.attr('src', '../images/back.jpg');
        $image.attr('width', '50px');
        $image.attr('width', '100px');
        $ladivP.append($image);
      }

      $('body').append($ladivP);
    }

    //Fonction qui affiche le score 
    function displayScore(scoreTable) {
      let $tscore = $("<table>");
      $tscore.append($("<tr><td>Score Equipe 1</td><td>" + scoreTable[0] + "</td></tr>"));
      $tscore.append($("<tr><td>Score Equipe 2</td><td>" + scoreTable[1] + "</td></tr>"));
      $tscore.attr('id', 'tableScore');
      $('body').append($tscore);
    }

    //Fonction qui affiche combien de distribtion(djerya) restantes 
    function displayDjeryaSpan(djerya) {
      let $djeryaSpan = $("<span>Djerya " + djerya + "</span>");
      $djeryaSpan.attr('id', 'djeryaSpan');
      $('body').append($djeryaSpan);
    }

    //Fonction qui change le style des élements du joueur à qui le tour de jouer
    function changeBorderDivActualPlayer(tourTable) {
      for (var i = 0; i < 4; i++) {
        if (tourTable[i] == 1) {
          $("#div" + i).css("border-width", '5px');
          $("#div" + i).css("border-style", 'solid');
          $("#div" + i).css("border-color", 'gray');
          $("#div" + i).css("border-radius", '6px');
          $("#name" + i).css("color", 'yellow');
          $("#name" + i).css("background", 'blue');
          $("#name" + i).css("font-size", '27px');


        } else {
          $("#div" + i).css("border-width", "0px");
          $("#name" + i).css("color", 'white');
          $("#name" + i).css("background", 'transparent');
          $("#name" + i).css("font-size", '22px');
        }
      }
    }

    //Fonction qui affiche les cartes du tapis
    function displayTapisCartes(tapisCartes) {
      let $ladivt = $("<div>");
      $ladivt.attr('id', 'divTapis');
      for (let k = 0; k < (tapisCartes.length); k++) {
        let $image = $("<img>");
        $image.attr('id', tapisCartes[k]);
        $image.attr('src', '../images/' + tapisCartes[k] + '.gif');
        $image.attr('width', '50px');
        $image.attr('width', '100px');
        $ladivt.append($image);

      }
      $('body').append("<br>");

      $('body').append($ladivt);
      $('body').append("<br>");
      $('body').append("<br>");
    }

    //Fonction qui met à jour le tour et fais passer le tour au joueur suivant dans le sens des aiguille de l'horloge
    function changeTour(trTable, idd) {
      var tourTable = trTable;
      if (idd != 4) {

        tourTable[idd] = 1;

      } else {

        tourTable[0] = 1;

      }
      tourTable[idd - 1] = 0;
      return tourTable;
    }

    //Fonction qui affiche le span Ronda +1 en cas de présence de Ronda dans les mains de tout joueurs
    function displayRondaSpan(rondaTringlaTable) {
      if (rondaDisp == false) {
        for (var i = 0; i < 4; i++) {
          if (rondaTringlaTable[i] == 1) {
            let $rondaSpan = $("<span>Ronda +1</span>");
            $rondaSpan.attr('id', 'rondaSpan' + i);
            $('body').append($rondaSpan);
          }
        }
        rondaDisp = true;
        console.log("c est fais ronda afficher s il y en a");
      }
    }

    //Fonction qui affiche le span Tringla +3 en cas de présence de Ronda dans les mains de tout joueurs
    function displayTringlaSpan(rondaTringlaTable) {
      if ((tringlaDisp == false)) {
        for (var i = 0; i < 4; i++) {
          if (rondaTringlaTable[i] == 2) {
            let $tringlaSpan = $("<span>Tringla +3</span>");
            $tringlaSpan.attr('id', 'tringlaSpan' + i);
            $('body').append($tringlaSpan);
          }
        }
        tringlaDisp = true;
        console.log("c est fais tringla afficher s il y en a ");
      }
    }

    //Fonction qui supprime le span de ronda/tringla du DOM affiché auparavant
    function removeRondaTringlaSpan() {
      for (var i = 0; i < 4; i++) {
        $rondaExiste = document.getElementById('rondaSpan' + i);
        if ($rondaExiste != null) {
          $('#rondaSpan' + i).remove();
        }
        $tringlaExiste = document.getElementById('tringlaSpan' + i);
        if ($tringlaExiste != null) {
          $('#tringlaSpan' + i).remove();

        }
      }
    }


    /*Récupére les informations nécessaire de la partie du json parties.json 
     Affiche tous les élements de la partie au comencement du jeu
     En utilisant les fonction définis ci-dessus 
     Lance la répitition d'appels chaque interval de temps définis à la fonction game_continue 
     pour actualiser le jeu et permettre au joueur courant de jouer si c'est son tour
     
    */
    function game() {
      var idd = ($_GET('id'));
      var idp = ($_GET('idp'));
      $.ajax({
        method: "GET",
        url: "game.php",
        data: {
          "id": idd,
          "idPartie": idp
        }
      }).done(function(e) {
        {
          console.log(e);
          for (let i = 0; i < 4; i++) {
            let $ladiv = $("<div>");
            $ladiv.attr('id', 'div' + i);
            if (i == 2) {
              displayTapisCartes(e[1]);

            }
            if (i == (idd - 1)) {
              displayCartesPlayer(e[0], $ladiv);

              if (e[2][i] == 1) {
                displayRondaSymbole($ladiv);
              } else {
                if (e[2][i] == 2) {
                  displayTringlaSymbole($ladiv);
                }
              }
            } else {

              displayCartesBackOtherPlayers($ladiv, e[3][i]);

              if (e[2][i] == 1) {
                displayRondaSymbole($ladiv);
              } else {
                if (e[2][i] == 2) {

                  displayTringlaSymbole($ladiv);
                }

                $('body').append("<br>");
              }
            }

          }

          /*Appel au fonctions de : 
           * Affichage du score
           * affichage du nombre de distribution(djerya) restantes
           * affichages des noms des joueurs
           * afficahge du paquet de cartes dans le coin haut à gauche
           * placer les bordure grise autour de la div du joueur à qui est le tour
           */
          displayScore(e[4]);
          djerya = e[7][0];
          displayDjeryaSpan(djerya);
          displayPaquetCartes();
          changeBorderDivActualPlayer(e[5]);
          displayNames();


          /*Animation et appel en cas de clique sur une image lorsque c'est au joueur courant de jouer à  : 
               la fonction qui met à jour le tour dans la table de tour des joueurs
               la fonction qui met à jour le tour  la fonction calculant le score 
               la focntion qui actualisera  le json parties.json selon les résultat obtenues
          */
          if (e[5][idd - 1] == 1) {

            $("#" + e[0][0]).click(function() {
              $( "#"+e[0][0] ).css("pointer-events","none");
              $("#" + e[0][0]).animate({


                width: ["toggle", "swing"],
                height: ["toggle", "swing"],
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][0], 0, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);

              });
            });



            $("#" + e[0][1]).click(function() {
              $( "#"+e[0][1] ).css("pointer-events","none");
              $("#" + e[0][1]).animate({

                width: ["toggle", "swing"],
                height: ["toggle", "swing"],
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][1], 1, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);

              });
            });


            $("#" + e[0][2]).click(function() {
              $( "#"+e[0][2] ).css("pointer-events","none");
              $("#" + e[0][2]).animate({
                width: ["toggle", "swing"],
                height: ["toggle", "swing"],
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][2], 2, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);

              });
            });


          }
          //Appels répetetif à la fonction game_continue à chaque 500ms
          interval = setInterval(game_continue, 500);




        }

      }).fail(function(e) {
        console.log(e);


      });
    }


    //Fonction qui renvoie True si deux tableu sont égaux et False si non
    function arrayEquals(a, b) {
      return Array.isArray(a) &&
        Array.isArray(b) &&
        a.length == b.length &&
        a.length != 0 &&
        b.length != 0 &&
        a.every((val, index) => val == b[index]);
    }

    /*Fonction qui calcule le score aprés que le joueur à cliquer sur la carte qui veut jouer
      Renvoie un tableau contenant l'indice et la valeur de la carte jouée
      le score récolté du coup joué et les cartes à prendre du tapis(carte encaissées selon les régles du jeu).
    */
    function game_loop(valeurCarte, indiceCarte, cartesDuTapis, carteArchem, rondaTringlaTable) {
      var scoreCoup = 0;
      cartesDuTapis = cartesDuTapis.sort((a, b) => (a % 10) - (b % 10));
      var carteAprendre = [];
      for (var i = 0; i < cartesDuTapis.length; i++) {
        if ((valeurCarte % 10) == (cartesDuTapis[i] % 10)) {
          scoreCoup = 2;
          carteAprendre.push(cartesDuTapis[i]);
          for (let j = i; j < cartesDuTapis.length; j++) {
            if (j + 1 != cartesDuTapis.length) {
              if (((cartesDuTapis[j] % 10) + 1) == (cartesDuTapis[j + 1] % 10)) {
                scoreCoup++;
                carteAprendre.push(cartesDuTapis[j + 1]);
              } else {
                break;
              }
            }
          }
          break;

        }
      }

      if (arrayEquals(carteAprendre, cartesDuTapis)) {
        scoreCoup++;
        missa = 1;

      }
      if (carteArchem != -1 && (carteArchem % 10) == (valeurCarte % 10)) {
        scoreCoup++;
        rchem = 1;
      }

      if (rondaCompte == false && rondaTringlaTable[idPlayer - 1] == 1) {
        scoreCoup++;
        rondaCompte = true;
        console.log("ronda compter dans le score");
      }
      if (tringlaCompte == false && rondaTringlaTable[idPlayer - 1] == 2) {
        scoreCoup += 5;
        tringlaCompte = true;

      }

      var tabRes = [];
      tabRes.push(indiceCarte);
      tabRes.push(valeurCarte);
      tabRes.push(scoreCoup);
      for (var i = 0; i < carteAprendre.length; i++) {
        tabRes.push(carteAprendre[i]);
      }
      console.log(tabRes);
      return tabRes;

    }





    /*
     Fonction qui fait passer les résultat obtenues à partir de la carte jouée
     au fichier play.php qui se chargera de modifier et mettre à jour les elements
     de la partie concerné du fichier parties.json et aisni tout les autres joueurs auront la dernière
     mise à jour de tous les elements du jeu(score,tapis,cartes restantes pour chaque joueur,tour des joueur,..)

    */

    function play(tabRes, tourTable, missa) {
      var stuff = {};

      stuff['key0'] = missa;
      stuff['key1'] = rchem;

      for (var i = 2; i < tourTable.length + 2; i++) {
        stuff['key' + i] = tourTable[i - 2];
      }

      var j = 0;
      for (var i = 6; i < ((tabRes.length) + 6); i++) {
        stuff['key' + i] = tabRes[j];
        j++;
      }
      var idd = ($_GET('id'));
      var idp = ($_GET('idp'));
      $.ajax({
        method: "GET",
        url: "play.php",
        data: {
          "str": JSON.stringify(stuff),
          "id": idd,
          "idPartie": idp,
          "len": tabRes.length
        }
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





    /*
    Fonction qui assure la continuté du jeu et la misee à jour de la page du jeu.
    Supprime les elements de la page(jeu) et reinsére les elements mis à jour 
    en appelant les même fonction que la focntion game.
    Traite l'affichage des regles de jeu (Rchem, Missa, Ronda) en appelant les fonction déinis ci-dessus
    */
    function game_continue() {
      var idd = ($_GET('id'));
      var idp = ($_GET('idp'));
      $.ajax({
        method: "GET",
        url: "game.php",
        data: {
          "id": idd,
          "idPartie": idp
        }
      }).done(function(e) {
        {

          //Supprime les elements de la partie de la pages pour les actualiser et puis les reafficher
          $('#divTapis').remove();
          $('#div0').remove();
          $('#div1').remove();
          $('#div2').remove();
          $('#div3').remove();
          $('#tableScore').remove();

          //Verifier si toutes les mains des joueurs sont vides pour redistribuer
          let b = false;
          for (let i = 0; i < e[3].length; i++) {
            if (e[3][i] != 0) {
              b = true;
            }
          }

          if (b == false) {
            clearTimeout(interval);
            redistribuer();
          }


          /*Vérifier s'il reste toujours des distribution pour afficher le paquet de cartes en haut à gache 
          de la page, si non supprimer le paquet de cartes en haut à gauche de la page
          */
          if (djerya != e[7][0]) {
            $('#djeryaSpan').remove();
            djerya = e[7][0];
            displayDjeryaSpan(djerya);
          }

          if (djerya == 0) {
            $("#divPaquet").remove();
          }



          for (let i = 0; i < 4; i++) {
            let $ladiv = $("<div>");
            $ladiv.attr('id', 'div' + i);

            if (i == 2) {
              displayTapisCartes(e[1]);

            }
            if (i == (idd - 1)) {
              displayCartesPlayer(e[0], $ladiv);

              if (e[2][i] == 1) {
                displayRondaSymbole($ladiv);

              } else {
                if (e[2][i] == 2) {
                  displayTringlaSymbole($ladiv);

                }
              }
            } else {
              displayCartesBackOtherPlayers($ladiv, e[3][i]);

              if (e[2][i] == 1) {
                displayRondaSymbole($ladiv);

              } else {
                if (e[2][i] == 2) {
                  displayTringlaSymbole($ladiv);

                }
                $('body').append("<br>");
              }
            }

          }



          //Affichage du score & Ronda & Tringla
          displayScore(e[4]);
          displayRondaSpan(e[2])
          displayTringlaSpan(e[2]);


          //Suppression des span indiquant qui a eu un Rchem ou une Missa aprés les avoir affiché.
          $missaExiste = document.getElementById('missaSpan');
          if ($missaExiste != null) {
            $('#missaSpan').remove();
          }
          $rchemExiste = document.getElementById('rchemSpan');
          if ($rchemExiste != null) {
            $('#rchemSpan').remove();
          }

          //Ajout du span désignant qu'u joueur a prit une missa
          if (e[6][0] == 1) {
            let $missaSpan = $("<span>Missa +1</span>");
            $missaSpan.attr('id', 'missaSpan');
            $('body').append($missaSpan);
            missa = 0;

          }
          //Ajout du span désignant qu'u joueur a prit un Rchem
          if (e[8][1] == 1) {
            let $rchemSpan = $("<span>Rchem +1</span>");
            $rchemSpan.attr('id', 'rchemSpan');
            $('body').append($rchemSpan);
            rchem = 0;

          }


          //Changemenkt des bordur des dives et les faires passer pour le joueur à qui est le tour de jouer
          changeBorderDivActualPlayer(e[5]);
          get_message();
          /*   Animation et appel en cas de clique sur une image lorsque c'est au joueur courant de jouer à  : 
               la fonction qui met à jour le tour dans la table de tour des joueurs
               la fonction qui met à jour le tour  la fonction calculant le score 
               la focntion qui actualisera  le json parties.json selon les résultat obtenues
          */

          if (e[5][idd - 1] == 1) {

            $("#" + e[0][0]).click(function() {
              $( "#"+e[0][0] ).css("pointer-events","none");
              let pos = $("#" + e[0][0])[0].getBoundingClientRect();
              let posTapis = $("#divTapis")[0].getBoundingClientRect();

              $("#" + e[0][0]).appendTo("body").css({
                "left": pos.left,
                "top": pos.top,
                "position": "absolute"
              });
              $("#" + e[0][0]).animate({

                transform: "scale(2)",
                left: posTapis.left,
                top: posTapis.top,
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][0], 0, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);
                removeRondaTringlaSpan();


              });
            });



            $("#" + e[0][1]).click(function() {
              $( "#"+e[0][1] ).css("pointer-events","none");
              let pos = $("#" + e[0][1])[0].getBoundingClientRect();
              let posTapis = $("#divTapis")[0].getBoundingClientRect();
              $("#" + e[0][1]).appendTo("body").css({
                "left": pos.left,
                "top": pos.top,
                "position": "absolute"
              });
              $("#" + e[0][1]).animate({


                transform: "scale(2)",
                left: posTapis.left,
                top: posTapis.top,
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][1], 1, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);
                removeRondaTringlaSpan();


              });
            });




            $("#" + e[0][2]).click(function() {
              $( "#"+e[0][2] ).css("pointer-events","none");
              let pos = $("#" + e[0][2])[0].getBoundingClientRect();
              let posTapis = $("#divTapis")[0].getBoundingClientRect();
              $("#" + e[0][2]).appendTo("body").css({
                "left": pos.left,
                "top": pos.top,
                "position": "absolute"
              });

              $("#" + e[0][2]).animate({


                transform: "scale(2)",
                left: posTapis.left,
                top: posTapis.top,
                opacity: "toggle"
              }, 1000, "linear", function() {
                var tourTable = changeTour(e[5], idd);
                var tabRes = game_loop(e[0][2], 2, e[1], e[8][0], e[2]);
                play(tabRes, tourTable, missa);
                removeRondaTringlaSpan();


              });
            });

          }

        }


      }).fail(function(e) {
        console.log("fail");


      });
    }


    /*
    Fonction qui fait appel au fichier redistribuer.php 
    qui s'en charge de la redistributon des cartes dans le cas ou toutes les mains sont vide 
    gére le cas ou toutes les mains sont vides et il y a plus de carte dans le paquet de cartes(fin de partie)
    */
    function redistribuer() {
      var idp = ($_GET('idp'));
      $.ajax({
        method: "GET",
        url: "redistribuer.php",
        data: {
          "idPartie": idp
        }
      }).done(function(e) {
        {
          if (e[0] == 99) {
            interval = setInterval(game_continue, 500);
          } else if (e[0] >= 1 && e[0] <= 4) {
            let $tapisSpan = $("<span>Tapis + " + e[1] + "</span>");
            $tapisSpan.attr('id', 'tapisSpan');
            $('body').append($tapisSpan);

            window.open("end_of_partie_page.php?id=" + $_GET('id') + "&idp=" + idp, "Game Over", "height=1000px, width=1200px;, menubar='yes', toolbar='yes', location='yes', status='yes', scrollbars='yes'");
            console.log("partie terminé");

          } else {

            rondaCompte = false;
            tringlaCompte = false;
            rondaDisp = false;
            tringlaDisp = false;

            interval = setInterval(game_continue, 500);
          }
          console.log("c'est fait" + e);
        }


      }).fail(function(e) {
        console.log("fail");

      });
    }


    //Fonction qui récupére les noms des 4 joueurs et affiche les vainqueurs dans la pages de fin de partie 
    function displayNames() {
      var idp = ($_GET('idp'));
      $.ajax({
        method: "GET",
        url: "name.php",
        data: {
          "idPartie": idp
        }
      }).done(function(e) {
        {

          for (var i = 0; i < 4; i++) {
            let $nameSpan = $("<span>" + e[i] + "</span>");
            $nameSpan.attr('id', "name" + i);
            $('body').append($nameSpan);

          }
          console.log("c'est fait " + e);
        }


      }).fail(function(e) {
        console.log("fail");

      });
    }


    function send_message(){
      var idd =($_GET('id'));
      var idp =($_GET('idp')); 
      var message = $("#send").val();
        $.ajax({
        method: "GET",
        url: "chat.php",
        data:{"id_game":idp,"id_player":idd,"message":message}
      }).done(function(e) {
        {
          $('#send').val("");
        }
      }).fail(function(e) {
        console.log("Fail to send message");       
      
      });
    }

    function get_message(){
      var idp =($_GET('idp')); 
        $.ajax({
        method: "GET",
        url: "messages.php",
        data:{"id_game":idp}
      }).done(function(e) {
        {
          
          $('#messages').empty();
          let paragraphe = "";
          for(var i=0;i<e.length;i++){
            
            paragraphe = paragraphe+e[i][0]+" : "+e[i][1]+"<br>";
          }
          let $par = $("<p>"+paragraphe+"</p>");
          $('#messages').append($par);
        }
      }).fail(function(e) {
        console.log("Fail to get messages");       
      });
    }

  //Appel à la foction game qui fera appel à son tour à la fonction gam
    game();
  </script>
</head>

<body>

</body>
      <div id = "chatDiv">
        <div id = "messages">
        </div>
        <input type="text"  id="send"/>
        <button id="sendbtn"  onclick="send_message()"> Send </button>
      </div>
</html>