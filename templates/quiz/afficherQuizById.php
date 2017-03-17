 <article>
     <article id="note"></article>
     <div class="row">
         <div class="col-lg-6 col-md-6">

                 <?php
    if($data["statut"]->idStatut==1) {
        echo '<form id="repondreFormulaire">';

        foreach ($data["quiz"] as $quiz) {
            echo "<h3>".$quiz->titre."</h3>";
        }

        foreach ($data["question"] as $question) {
            echo "<article class='questions choix'><b>Question ".$question->noQuestion." ".$question->question."</b></article><br>";
            foreach ($data["choix"] as $choix) {
                if($choix->idQuestion==$question->id) {
                    if($choix->reponse==1) {
                        echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'><mark>".$choix->choix."</mark><input disabled class='checkbox' type='checkbox'></article>";
                    } else {
                        echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'>".$choix->choix."<input disabled class='checkbox' type='checkbox'></article>";
                    }

                }
            }
        }

        ?> <input type="hidden" data-param="<?php echo $data2; ?>" id="param">
        <?php
    } elseif ($data["statut"]->idStatut==2) {
        echo '<form id="repondreFormulaire">';

        foreach ($data["quiz"] as $quiz) {
            echo "<h3>".$quiz->titre."</h3>";
        }

                 foreach ($data["question"] as $question) {
                     echo "<article class='questions choix'><b>Question ".$question->noQuestion." ".$question->question."</b></article><br>";
                     foreach ($data["choix"] as $choix) {
                         if($choix->idQuestion==$question->id) {
                             if($choix->reponse==1) {
                                 echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'>".$choix->choix."<input class='checkbox' type='checkbox'></article>";
                             } else {
                                 echo "<article class='choix' data-reponse='$choix->reponse' data-id='$choix->id' data-quiz='$choix->idQuiz' 
                data-question='$choix->idQuestion'>".$choix->choix."<input class='checkbox' type='checkbox'></article>";
                             }

                         }
                     }
                 }

        ?> <input type="hidden" data-param="<?php echo $data2; ?>" id="param">
                 <article class="choix"><button id="submit" class="btn btn-primary" type="submit">Envoyer</button></article>
                 <?php

    }

                 //echo "<pre>".print_r($data,true)."</pre>";

                 ?>

             </form>
         </div>
     </div>

 </article>
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
                        "Votre note est de " + score + " %</div><a href='../afficherQuizUtilisateur'>Retour Section Quiz</a>";
                    $("#note").html(str);
                } else {
                    var str = "<div id='quizEchec' class='alert alert-danger'><strong>Echec!</strong><br> " +
                        "Votre note est de " + score + " %</div><a href='../afficherQuizUtilisateur'>Retour Section Quiz</a>";
                    $("#note").html(str);
                }


            },
            error : function(resultat, statut, erreur){
                console.log(resultat+statut+erreur);
            }
        });
    });




</script>