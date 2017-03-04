<section>
<div id="success"></div>
<div class="row">
    <form id="form1">
    <div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
        <div class="form-group">
            <input type="text"  class="form-control" id="nomQuiz" data-parsley-required="true" placeholder="Entrez le nom du quiz">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" id="ajouter_quiz">Ajouter Question</button>
        </div>
        <div id="results"></div>
        <button class="btn btn-warning btn-block" id="submit">Creer le quiz</button>
    </div>
    </form>
</div>
</section>
<script>
    var count=0;
    var htmlString;
    $('#ajouter_quiz').click(function(e){
        e.preventDefault();
        count++;
        htmlString = "<div class='form-group has-success'><input class='questions form-control' placeholder='Question"+count+"' " +
            "data-question="+count+" class=questions type=text data-parsley-required='true'></div><div class='form-group'><button id=button"+count+""
            + " class='btnChoix btn btn-info btn-block' value="+count+">" + "Ajouter choix de reponse</button></div>" +
            "<div id=div"+count+"></div>";

        if($('.btnChoix').parent().next("div").length==0) {
            $('#results').html(htmlString);
        } else {
            $('#results').append(htmlString);
        }
    });

    $(document).on('click','.btnChoix',function(e){
        e.preventDefault();
        var vide=  $(event.target).parent().next("div").is(':empty');
        var noQuestion = $(event.target).parent().prev("div").children().first().data("question");
        if(vide) {

            htmlString = "<div class='form-group'><div class='input-group'><input placeholder='Choix"+1+"'  " +
                "data-choix=1 class='choixReponse form-control' data-question="+noQuestion+" type=text>" +
                "<span class='input-group-addon'><input class='checkboxReponses form-check-input' data-question=" +
                "'"+noQuestion+"' data-choix='1' type='checkbox'></span></div></div>";

            $('#div'+$(event.target).val()).append(htmlString);

        } else {
            var numeroChoix = $(event.target).parent().next().children().last().children().last().children().first()
                .data("choix");

            htmlString = "<div class='form-group'><div class='input-group'><input placeholder='Choix"+parseInt
                (numeroChoix+1)+"' class='choixReponse form-control' data-question='"+noQuestion+"' " +
                "data-choix='"+parseInt(numeroChoix+1)+"' type='text'><span class='input-group-addon'><input " +
                "class='checkboxReponses form-check-input' data-choix='"+ parseInt(numeroChoix+1)+"' data-question" +
                "='"+noQuestion+"' type='checkbox'></span></div></div>";

            $('#div'+$(event.target).val()).append(htmlString);
        }
    });
    $(document).ready(function() {
        $("#form1").on('submit', function(e){
            e.preventDefault();
            var form = $(this);

            form.parsley().validate();

            if (form.parsley().isValid()){
                var questions = $(".questions");
                var choixReponses = $(".choixReponse");

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
                        var str = "<div class='alert alert-success'><strong>Success!</strong> " +
                            "Le quiz a ete ajoute avec success</div>";
                        $("#results").html("");
                        $("#nomQuiz").val("");
                        $("#success").html(str);
                    },
                    error : function(resultat, statut, erreur){
                        console.log(resultat+statut+erreur);
                    }
                });
            }
        });
    });

        /*$('#form1').parsley(). on('form:success', function(e) {
e.preventDefault();
        var questions = $(".questions");
        var choixReponses = $(".choixReponse");
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
                    var str = "<div class='alert alert-success'><strong>Success!</strong> " +
                        "Le quiz a ete ajoute avec success</div>";
                    $("#results").html("");
                    $("#nomQuiz").val("");
                    $("#success").html(str);
                },
                error : function(resultat, statut, erreur){
                    console.log(resultat+statut+erreur);
                }
            });

            return false;

    });*/


    // ENd Register



            // In here, `this` is the parlsey instance of #some-input



                    /*$.ajax({
                        url : 'ajouterQuiz',
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
        $("#submit").click(function() {


        });

        /*$('#form1').parsley().on('form:success', function() {
            $.ajax({
                url : 'ajouterQuiz',
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
            });
        }).on('form:submit', function() {
            console.log("no submit");
            return false; // Don't submit form for this demo
        });*/




</script>
