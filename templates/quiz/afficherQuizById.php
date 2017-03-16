 <article id="note"></article>
    <form id="repondreFormulaire">
<?php

//echo "<pre>".print_r($data,true)."</pre>";
  foreach ($data["quiz"] as $quiz) {
     echo "<h3>".$quiz->titre."</h3>";
  }

  foreach ($data["question"] as $question) {
      echo "<article class='questions choix'><b>Question ".$question->noQuestion." ".$question->question."</b></article><br>";
      foreach ($data["choix"] as $choix) {
          if($choix->idQuestion==$question->id) {
              if($choix->reponse==1) {
                  echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'><mark>".$choix->choix."</mark><input class='checkbox' type='checkbox'></article></article>";
              } else {
                  echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'>".$choix->choix."<input class='checkbox' type='checkbox'></article>";
              }

          }
      }
  }
  ?>
    <input type="hidden" data-param="<?php echo $data2; ?>" id="param">
        <article class="choix"><button id="submit" class="btn btn-primary" type="submit">Envoyer</button></article>
    </form>

</section>
</section>
<script>
    $("#repondreFormulaire").on("submit", function (e) {
        console.log("prevent");
        e.preventDefault();
    });
    $("#submit"). click ( function () {
        var param= $("#param").data("param");
        bonneReponses=0;
        $('.checkbox').each( function(index) {
            var idQuiz;
            var checked = $(this).is(":checked");
            var reponse = $(this).parent().data("reponse");
            if(checked && reponse==1) {
                bonneReponses++;
                console.log("bonne reponse");
                console.log(index);
            }
        });

        var score = (bonneReponses/$(".questions").length)*100;
        console.log(score);

        $.ajax({
            url : '../scoreQuiz',
            type : 'POST',
            data: { score:score, idQuiz:param },
            success : function(resultat, statut){
                $("#repondreFormulaire").remove();
                if(score>60) {
                    var str = "<div id='quizSuccess' class='alert alert-success'><strong>Reussite!</strong><br> " +
                        "Votre note est de " + score + " %</div>";
                    $("#note").html(str);
                } else {
                    var str = "<div id='quizEchec' class='alert alert-danger'><strong>Echec!</strong><br> " +
                        "Votre note est de " + score + " %</div>";
                    $("#note").html(str);
                }


            },
            error : function(resultat, statut, erreur){
                console.log(resultat+statut+erreur);
            }
        });
    });




</script>