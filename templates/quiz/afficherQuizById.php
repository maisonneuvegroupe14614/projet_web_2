<?php

echo "<pre>".print_r($data,true)."</pre>";


  foreach ($data["quiz"] as $quiz) {
     echo $quiz->titre."<br><br>";
  }

  foreach ($data["question"] as $question) {
      echo "Question ".$question->noQuestion." ".$question->question."<br>";
      foreach ($data["choix"] as $choix) {
          if($choix->idQuestion==$question->id) {
              echo "<div class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'></div>".$choix->choix."<input class='checkbox' type='checkbox'>";
          }
      }
  }
  ?>
<input id="submit" type="submit">
<script>
    $("#submit"). click ( function () {
        bonneReponses=0;
        $('.checkbox').each( function(index) {
            var checked = $(this).is(":checked");
            var reponse = $(this).prev().data("reponse");
            if(checked && reponse==1) {
                bonneReponses++;
                console.log("bonne reponse");
                console.log(index);
            }
            i=index;
        });
        var score = bonneReponses/i;
        console.log(score);
    });


/*$.ajax({
    url : 'comparerQuiz',
    type : 'POST',
    data: { nomQuiz:nomQuiz, questionnaire:questionnaire, choix:choix },
    success : function(resultat, statut){
        console.log(resultat);
        console.log(statut);
        var str = "<div class='alert alert-success'><strong>Success!</strong> " +
            "Le quiz a ete ajoute avec success</div>";
        $("#results").html("");
        $("#nomQuiz").val("");
        $("#success").html(str);
    },
    error : function(resultat, statut, erreur){
        console.log(resultat+statut+erreur);
    }
});*/

</script>