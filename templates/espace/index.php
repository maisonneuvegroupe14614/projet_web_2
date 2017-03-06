<?php


?>


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

        <div id="notificationResult"></div>

        <div>
            <h4> demandes reçus  </h4>

            <?php
            foreach ($data['demandes_recu'] as $demande) {
                echo '<form action="'.path.'client/accepte_ami" method="post">'.$demande->courrielUtil.'
                        <button name="accepte_ami" type="submit"  value="'.$demande->courrielUtil.' "  >Accepté</button>
                        <button name="refuse_ami" type="submit"  value="'.$demande->courrielUtil.' "  >Refusé</button>
                        </form>';
            }
            ?>




        </div>

    </nav>
    <form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
<textarea name="publications">
</textarea>
        <input type="text" name="url">
        <input type="submit">
    </form>


    <?php

    if(isset($data["publication"])){
        /*mon mur*/
        foreach($data["publication"] as $publication) {?>
            <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                <p><?php echo $publication->texte?></p>
                <p> <?php //echo $publication->url ?> </p>

                <img src="<?php echo path?>templates/images/suivre.png"   width="20" height="20">&nbsp;</img><a class="droite" href="../afficherPubliDetail/<?php echo $publication->id ?>">Suivre</a>
                <img src="<?php echo path?>templates/images/partager.png" width="20" height="20">&nbsp;</img><a class="droite" href="#">Partager</a>
                <img src="<?php echo path?>templates/images/evaluer.png"  width="20" height="20">&nbsp;</img><a href="../afficherEvaluation/<?php  echo $publication->id; ?>">Évaluer</a>
            </div>
        <?php }
    }



    if(isset($data["utilisateur"])){
        echo '<h1>espace mes amis</h1>';
        foreach ($data["utilisateur"] as $utilisateur) {

            echo "<a href=".path."client/ami/$utilisateur->courriel>".$utilisateur->nom."  ".$utilisateur->prenom."</a>".'<button class="retirer_ami" value="'.$utilisateur->courriel.'">retirer de la list</button> '."<br>";
        }


        echo '<div id="id_div" hidden>
                        <h1>supression </h1>
                        </div>';
    }
 ?>



</section>

<script>
    function timedRefresh(timeoutPeriod) {
        setTimeout(update,timeoutPeriod);
    }

    /**
     * Notifications Ajax
     *
     * Mis a jour des donnees dynamique avec ajax avec interval
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
            var messageAll = data.messageAll.length;


            var str="";
            for(var i=0;i<data.messageAll.length;i++) {
                if(data.messageAll[i].notificationVue==null) {
                    str += '<mark><a class="dropdown-item messageAll" data-notification="'+data.messageAll[i].id+'" href="#">'+data.messageAll[i].texte+" par : "+data.messageAll[i].courrielUtil+'</a></mark><br><br>';

                } else {
                    console.log("hello");
                    console.log(data.messageAll[i]);
                    str += '<a class="dropdown-item messageAll" data-notification="'+data.messageAll[i].id+'" href="#">'+data.messageAll[i].texte+" par : "+data.messageAll[i].courrielUtil+'</a><br><br>';
                }
            }


            btnMessage = '<div class="btn-group"><button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Messages <span class="badge">'+messageNb+'</span></button><div class="dropdown-menu">'+str+'</div></div><br>';

            //Bouton bootstrap nombre de notifications

            btnTutorat = '<button class="btn btn-primary" type="button"> Tutorats <span class="badge">'+tutoratNb+'' +
                '</span></button><br>';
            btnAstuce = '<button class="btn btn-primary" type="button"> Astuces <span class="badge">'+astuceNb+'' +
                '</span></button><br>';
            btnQuiz = '<button class="btn btn-primary" type="button"> Quiz <span class="badge">'+quizNb+'' +
                '</span></button><br>';

            $("#notificationResult").html(btnMessage+btnTutorat+btnAstuce+btnQuiz);


            $(".messageAll").on("click" , function () {
                var clicked = $(this).data("notification");
                $.ajax({
                    url : '../updateNotification',
                    type : 'POST',
                    data: { id: clicked },
                    success : function(resultat, statut){
                        console.log(resultat+statut);
                    },
                    error : function(resultat, statut, erreur){
                        console.log(resultat+statut+erreur);
                    }
                });
            });


            //Mis a jour des donnees a 5 secondes
            timedRefresh(5000);
        });
    }

    update();


    x = document.querySelectorAll(".retirer_ami");
    for(i=0;i<x.length;i++){
        x[i].addEventListener("click", function(){
            //console.log(event.target.value);

            document.getElementById("demo").innerHTML = "tu es sur de supprimer cette relation "+event.target.value;
        });
    };
</script>
<div id="demo"></div>



