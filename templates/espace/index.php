<?php
//
//
////print_r($data);
//echo "<section><div><div class='pubs'><h1>Publications</h1>";
//foreach($data["publication"] as $publication) {
//        echo $publication->texte."<br>";
//        echo $publication->url."<br><br>";
//}
//
//echo "</div><br><br>";
//echo "<div class='amis'><h1>Amis</h1>";
//foreach ($data["utilisateur"] as $utilisateur) {
//    echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
//}
//
//
?>


<section>
    <p id="util">Michael Osman, Tuteur</p>
    <nav id="menu-gauche"><br><br><br>
        <ul>
            <li><img src="<?php echo path; ?>templates/images/amis_rouge.png" width="30" height="30">&nbsp;</img><a href="#">Mes amis</a></li>
            <li><img src="<?php echo path; ?>templates/images/post-it2.png" width="30" height="30">&nbsp;</img><a href="#">Créer une publication</a></li>
            <li><img src="<?php echo path; ?>templates/images/prof.png" width="30" height="30">&nbsp;</img><a href="#">Tutorats</a></li>
            <li><img src="<?php echo path; ?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;</img><a href="#">Astuces</a></li>
        </ul>
    </nav>
    <div><form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
<textarea name="publications">
</textarea>
            <input type="text" name="url">
            <input type="submit">
        </form>
        <a href="../logout">Logout</a>
        <a href="../confirmationDeinscription">Desinscrire</a>
    </div>
    <div id="notificationResult"></div>
    <div id="publications">
            <?php foreach($data["publication"] as $publication) {
            echo "<div class='publication'><img src=\"http://localhost:8888/projet_web_2/templates/images/punaise.png\"  width=\"30\" height=\"30\" class=\"centre\"><br>
<p>".$publication->texte."</p>";
//            echo $publication->url."</p>";

               echo '<img src="http://localhost:8888/projet_web_2/templates/images/suivre.png"   width="20" height="20">&nbsp;</img><a class="droite" href="#">Suivre</a>';
                echo '<img src="http://localhost:8888/projet_web_2/templates/images/partager.png" width="20" height="20">&nbsp;</img><a class="droite" href="#">Partager</a>';
                echo '<img src="http://localhost:8888/projet_web_2/templates/images/evaluer.png"  width="20" height="20">&nbsp;</img><a                href="#">Évaluer</a>';
            echo '</div>';
            } ?>



    </div>
    <section>
    <?php
    foreach ($data["utilisateur"] as $utilisateur) {
        echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
    }
    ?>



    </section>
    <!--<form action="verifierIdentification" method="post">
        <br><br>User : <input type="text" name="user"> <br>
        Password: <input type="password" name="password"> <br><br>
        <input type="submit">
    </form>-->

    <script>

        function timedRefresh(timeoutPeriod) {
            setTimeout(update,timeoutPeriod);
        }

        /**
         * Notifications Ajax
         *
         * Mis a jour des donnees dynamique avec ajax a chaque minute
         */
        function update() {
            $.get("../getNotificationPub", function (data) {
                var btnMessage;
                var btnTutorat;
                var btnAstuce;
                var btnQuiz;
                console.log(data);
                data = JSON.parse(data);
                console.log(data);
                console.log(data.length);
                var tutoratNb = data.tutorat.length;
                var messageNb = data.message.length;
                var astuceNb = data.astuce.length;
                var quizNb = data.quiz.length;

                console.log(tutoratNb);
                console.log(messageNb);
                console.log(astuceNb);
                console.log(quizNb);

                //Bouton bootstrap nombre de notifications
                btnMessage = '<button class="btn btn-primary" type="button"> Messages <span class="badge">'+messageNb+'' +
                    '</span></button><br>';
                btnTutorat = '<button class="btn btn-primary" type="button"> Tutorats <span class="badge">'+tutoratNb+'' +
                    '</span></button><br>';
                btnAstuce = '<button class="btn btn-primary" type="button"> Astuces <span class="badge">'+astuceNb+'' +
                    '</span></button><br>';
                btnQuiz = '<button class="btn btn-primary" type="button"> Quiz <span class="badge">'+quizNb+'' +
                    '</span></button><br>';

                $("#notificationResult").html(btnMessage+btnTutorat+btnAstuce+btnQuiz);
                //Mis a jour des donnees a chaque minute
                timedRefresh(60000);
            });
        }

        update();

    </script>

</section>
