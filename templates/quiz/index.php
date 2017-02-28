<button id="ajouter_quiz">Ajouter Question</button><br><br>
<div id="results"></div>
<script>
    var count=0;
    var htmlString="";
    $('#ajouter_quiz').click( function (){
        console.log(count);
        count++;
        htmlString = "Question"+count+"<input type=text value=valeur"+count+"><button id=button"+count+" class=reponses " +
            "value="+count+">" + "Ajouter choix de reponse</button><div id=div"+count+"></div><br><br>";

        if($('.reponses').next().length==0) {
            $('#results').html(htmlString);
        } else {
            $('#results').append(htmlString);

        }

    });

    var counter = 0;
    var htmlString ="";
    $(document).on('click','.reponses',function(){
        var test=  $(event.target).next().is(':empty');
        if(test) {
            counter=0;
            htmlString="";
        }

        counter++;
        htmlString += "Choix"+counter+"<input type=text><input type=radio name="+$(event.target).prev().val()+"><br><br>";
        console.log(htmlString);
        $('#div'+$(event.target).val()).html('').html(htmlString);
        console.log('#div'+$(event.target).val());
    });
</script>
