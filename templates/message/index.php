    <form id="form_reception" action="../ajouterMessage/<?php echo $data2; ?>" method="post">
        <select id="courrielAmi" name="courrielAmi">
            <option disabled selected value>Mes amis</option>
            <?php
            foreach ($data["amis"] as $ami) {
                echo "<option data-courrielAmi='".$ami->courriel."' value='".$ami->courriel."'>".$ami->courriel."</option>";
            }
            ?>
        </select><br><br>

        <div class="messages"></div>

        Sujet       <br><input    type="text" name="sujet"  ><br>
        Message     <br><textarea id="messages" name="messages"></textarea><br>
        Pièce jointe<br><input    type="text" name="url">

        <button id="bouton_reception" type="submit"><span>Envoyer</span></button><br><br>
    </form>

    <script>
        $( function() {
            $("#courrielAmi").on ("change", function() {
                courrielAmi = this.value;
                $.post({
                    url : '../findMessage',
                    data: { courrielAmi:courrielAmi },
                    success : function(resultat, statut) {
                        var res=JSON.parse(resultat);
                        var str="<br>";
                        for (var i=0; i<res.message.length; i++) {
                            str += "<p>" + res.message[i].courrielUtil + "<br>" + res.message[i].dateCreation + "<br>" +
                                res.message[i].sujet        + "<br>" + res.message[i].texte        + "<br>" +
                                res.message[i].url          + "</p><br>";
                        }
                        $( ".messages" ).html(str);
                        console.log(resultat+statut);
                    },
                    error : function(resultat, statut, erreur) {
                        console.log(resultat+statut+erreur);
                    }
                });
            });
        });
    </script>
</section>