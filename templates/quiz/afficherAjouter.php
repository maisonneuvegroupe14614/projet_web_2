<article>
<div id="success"></div>
<div class="row">
    <form id="form1">
    <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
        <div class="alert alert-danger" id="erreurs"></div>
        <div class="form-group">
            <input type="text"  class="form-control" id="nomQuiz" data-parsley-required-message='Vous devez rensigner le champ Nom du quiz' data-parsley-errors-container='#erreurs' data-parsley-required="true" placeholder="Entrez le nom du quiz">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" id="ajouter_quiz">Ajouter Question</button>
        </div>
        <div id="results"></div>
        <button class="btn btn-warning btn-block" id="submit">Creer le quiz</button>
    </div>
    </form>
</div>
</article>
</section>
    <script>
    var count=0;
    var htmlString;
    $('#ajouter_quiz').click(function(e){
        e.preventDefault();
        count++;
        htmlString = "<div class='form-group has-success'><input class='questions form-control' placeholder='Question"+count+"' " +
            "data-question="+count+" class=questions type=text data-parsley-required-message='Vous devez renseigner la Question "+count+"' data-parsley-errors-container='#erreurs' data-parsley-required='true'></div><div class='form-group'><button id=button"+count+""
            + " class='btnChoix btn btn-info btn-block' value="+count+">" + "Ajouter choix de reponse</button></div>" +
            "<div id=div"+count+"><div class='form-group'><div class='input-group'><input placeholder='Choix"+1+"'  " +
            "data-choix=1 class='choixReponse form-control' data-parsley-required-message='Vous devez renseigner le Choix 1 de la Question "+count+"' data-parsley-errors-container='#erreurs' data-parsley-required='true' data-question="+count+" type=text>" +
            "<span class='input-group-addon'><input class='checkboxReponses form-check-input' data-question=" +
            "'"+count+"' data-choix='1' name='reponseQ"+count+"[]' data-parsley-multiple='reponseQ"+count+"' data-parsley-required-message='Vous devez cocher au moins une reponse a la Question"+count+"' data-parsley-errors-container='#erreurs' data-parsley-required='true' type='radio'></span></div></div></div>";

        if($('.btnChoix').parent().next("div").length==0) {
            $('#results').html(htmlString);
        } else {
            $('#results').append(htmlString);
        }
    });

    $(document).on('click','.btnChoix',function(e){
        e.preventDefault();
        var vide=  $(event.target).parent().next("div").is(':empty');
        console.log(vide);
        var noQuestion = $(event.target).parent().prev("div").children().first().data("question");
        if(!vide) {
            var numeroChoix = $(event.target).parent().next().children().last().children().last().children().first()
                .data("choix");
            console.log(noQuestion+"test test");

            htmlString = "<div class='form-group'><div class='input-group'><input placeholder='Choix"+parseInt
                (numeroChoix+1)+"' class='choixReponse form-control' data-parsley-required-message='Vous devez renseigner le Choix "+ parseInt(numeroChoix+1)+" de la Question "+noQuestion+"' data-parsley-errors-container='#erreurs' data-parsley-required='true' data-question='"+noQuestion+"' " +
                "data-choix='"+parseInt(numeroChoix+1)+"' type='text'><span class='input-group-addon'><input " +
                "class='checkboxReponses form-check-input' data-choix='"+ parseInt(numeroChoix+1)+"' data-question" +
                "='"+noQuestion+"' name='reponseQ"+noQuestion+"[]' data-parsley-required='true' data-parsley-multiple='reponseQ"+noQuestion+"' data-parsley-required-message='Vous devez cocher au moins une reponse a la Question"+noQuestion+"' type='radio'></span></div></div>";

            $('#div'+$(event.target).val()).append(htmlString);
        }
    });

    $(document).ready(function() {
        if($("#erreurs").html().length==0) {
            $("#erreurs").hide();
        } else {
            $("#erreurs").show();
        }
        $("#form1").on('submit', function(e){
            $("#erreurs").show();
            e.preventDefault();
            var form = $(this);

            form.parsley().validate();

            var questions = $(".questions");
            var choixReponses = $(".choixReponse");
            console.log(choixReponses);
            if (form.parsley().isValid() && questions.length>0){
                var questionnaire=[];
                var choix=[];

                var addToQuiz = function(question,valeur) {
                    questionnaire.push({question: question, valeur:valeur});
                };

                var add = function(noQuestion,choixValeur, reponse, noChoix) {
                    choix.push({noQuestion: noQuestion, choix:choixValeur, reponse:reponse, noChoix:noChoix});
                };

                $(questions).each(function( index ) {
                    addToQuiz($(this).data("question"),$(this).val());
                    console.log( index + ": " + $( this ).text() );
                });

                $(choixReponses).each(function( index ) {
                    if($(this).next("span").children().first().is(":checked")) {
                        console.log("checked");
                        console.log($(this).next().children().first());
                        add($(this).data("question"),$(this).val(),1,$(this).data("choix"));
                    } else {
                        console.log("not");
                        console.log($(this).next("span").children().first());
                        add($(this).data("question"),$(this).val(),0,$(this).data("choix"));
                    }
                    if(index==0) {
                        e.preventDefault();
                    }
                    console.log( index + ": " + $( this ).text() );
                });

                console.log(JSON.stringify(questionnaire));
                console.log(JSON.stringify(choix));

                var nomQuiz = $("#nomQuiz").val();
                $.ajax({
                    url : 'ajouterQuiz',
                    type : 'POST',
                    data: { nomQuiz:nomQuiz, questionnaire:questionnaire, choix:choix },
                    success : function(resultat, statut){
                        console.log(resultat);
                        console.log(statut);
                        var str = "<div id='quizSuccess' class='alert alert-success'><strong>Success!</strong> " +
                            "Le quiz a ete ajoute avec success</div>";
                        $("#results").html("");
                        $("#nomQuiz").val("");
                        $("#success").fadeIn(1600).html(str).fadeOut(1600);
                        count=0;

                    },
                    error : function(resultat, statut, erreur){
                        console.log(resultat+statut+erreur);
                    }
                });
            }
        });

    });

    $('#success').change();
</script>
