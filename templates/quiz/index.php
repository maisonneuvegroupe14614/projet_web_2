<input type="text" id="nomQuiz">Nom Quiz
<button id="ajouter_quiz">Ajouter Question</button>&nbsp;&nbsp;
<div id="results"></div>
<button id="submit">Submit</button>
<script>
    var count=0;
    var htmlString;
    $('#ajouter_quiz').click(function(){
        count++;

        htmlString = "Question"+count+"<input data-question="+count+" class=questions type=text>"
            + "<button id=button"+count+" class=btnChoix value="+count+">" + "Ajouter choix de reponse</button>" +
            "<div id=div"+count+"></div><br><br>";

        if($('.btnChoix').next().length==0) {
            $('#results').html(htmlString);
        } else {
            $('#results').append(htmlString);
        }
    });

    $(document).on('click','.btnChoix',function(){
        var vide=  $(event.target).next().is(':empty');
        var noQuestion = $(event.target).prev().data("question");
        if(vide) {
            htmlString = "<div>Choix"+1+"<input class=choixReponse data-question="+noQuestion+" type=text>" +
                "<input class=checkboxReponses data-question="+noQuestion+" data-choix=1 type=checkbox></div>";
            $('#div'+$(event.target).val()).append(htmlString);
        } else {
            var numeroChoix = $(event.target).next().children().last().children().last().data("choix");
            htmlString = "<div>Choix"+parseInt(numeroChoix+1)+"<input class=choixReponse " +
                "data-question="+noQuestion+" type=text><input class=checkboxReponses data-choix="+
                parseInt(numeroChoix+1)+" data-question="
            +noQuestion+" type=checkbox " + "</div>";
            $('#div'+$(event.target).val()).append(htmlString);
        }
    });

    $("#submit").click(function() {
        var questions = $(".questions");
        var choixReponses = $(".choixReponse");
//        var checkboxReponse = $(".checkboxReponses:checked").prev();

       /* console.log(questions);
        console.log(choixReponses);
        console.log(checkboxReponse);*/

        var questionnaire=[];
        var choix=[];


        var addToQuiz = function(question,valeur,reponse) {
            questionnaire.push({question: question, valeur:valeur, reponse:reponse});
        };
        var add = function(noQuestion,choixValeur, reponse) {
           choix.push({noQuestion: noQuestion, choix:choixValeur, reponse:reponse});
        };

        /*var addQuiz2 = function(noQuestion,reponse) {
            reponsesQuiz.push({noQuestion: noQuestion, reponse:reponse});
        };*/

        $(questions).each(function( index ) {
            if($(this).next().is(":checked")) {
                addToQuiz($(this).data("question"),$(this).val(),1);
            } else {
                addToQuiz($(this).data("question"),$(this).val(),0);
            }
            console.log( index + ": " + $( this ).text() );
        });

        $(choixReponses).each(function( index ) {
            if($(this).next().is(":checked")) {
                console.log("checked");
                add($(this).data("question"),$(this).val(),1);
            } else {
                console.log("not");
                add($(this).data("question"),$(this).val(),0);
            }
            console.log( index + ": " + $( this ).text() );
        });

        console.log(JSON.stringify(questionnaire));
        console.log(JSON.stringify(choix));
        var nomQuiz = $("#nomQuiz").val();

        $.ajax({
            url : 'addQuiz',
            type : 'POST',
            data: { nomQuiz:nomQuiz, questionnaire:questionnaire, choix:choix },
            success : function(resultat, statut){
                console.log(resultat);
                console.log(statut);
            },
            error : function(resultat, statut, erreur){
                console.log(resultat+statut+erreur);
            }
        });
    });
</script>
