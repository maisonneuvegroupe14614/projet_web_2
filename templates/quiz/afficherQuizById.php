<section>
<p id="util"><?php

    echo $data["nom_utilisateur"]->nom."  ".$data["nom_utilisateur"]->prenom."  <b> ".$data["nom_utilisateur"]->description."</b>";


    ?></p>
<nav id="menu-gauche"><br><br><br>

    <ul>
        <li><img src="<?php echo path?>templates/images/amis_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/mes_amis">Mes amis</a></li>
        <li><img src="<?php echo path?>templates/images/prof.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/tutorats">Tutorats</a></li>
        <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/astuces">Astuces</a></li>
        <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/afficherAjouterQuiz">Quiz</a></li>
        <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/espace/<?php echo $_SESSION['courriel']?>">Accueil</a></li>
    </ul>


</nav>
<section>
<?php

//echo "<pre>".print_r($data,true)."</pre>";


  foreach ($data["quiz"] as $quiz) {
     echo $quiz->titre."<br><br>";
  }

  foreach ($data["question"] as $question) {
      echo "Question <div class=questions>".$question->noQuestion." ".$question->question."</div><br>";
      foreach ($data["choix"] as $choix) {
          if($choix->idQuestion==$question->id) {
              echo "<div class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'></div>".$choix->choix."<input class='checkbox' type='checkbox'>";
          }
      }
  }
  ?>
    <input id="submit" type="submit">

</section>
</section>
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
        });

        var score = (bonneReponses/$(".questions").length)*100;
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