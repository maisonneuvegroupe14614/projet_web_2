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

        <div id="demandes_recu">
            <p> demandes reçus  </p>

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


<article class="center">
 <!--   <form action="../ajouterPublication/<?php /*echo $data2; */?>" method="post">
        <input type="text" id="titrePub"><br>
<textarea name="publications">
</textarea><br>
        <input type="text" name="url">
        <input type="submit">
    </form>-->
    <button class="btn btn-primary creer_pub" id="opener">Nouvelle Publication</button>

    <div id="dialog" title="Nouvelle Publication">


        <form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Message</a></li>
                <li><a data-toggle="tab" href="#menu1">Tutorat</a></li>
                <li><a data-toggle="tab" href="#menu2">Astuce</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
<!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="4">
                        <input type="submit" class="btn btn-primary"></input>
                    </form>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="1">
                        <input type="submit" class="btn btn-primary"></input>
                    </form>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="2">
                        <input type="submit" class="btn btn-primary"></input>
                    </form>
                </div>
            </div>
        </form>
    </div>






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

echo "</article>";

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
    var countMess=0;
    var on;
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
                countMess++;
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
            var countNotification = 0;
            for(var j=0;j<messageNb;j++) {
                if(data.message[j].notificationVue==null) {
                    countNotification++;
                }
            }
            var astuceNb = data.astuce.length;
            var quizNb = data.quiz.length;
            var messageAll = data.messageAll.length;


            var str="";
            for(var i=0;i<data.messageAll.length;i++) {
                if(data.messageAll[i].notificationVue==null) {
                    str += '<mark><a class="dropdown-item messageAll" data-notification="'+data.messageAll[i].id+'" href="../afficherPubliDetail/'+data.messageAll[i].idPublication+'">'+data.messageAll[i].texte+" par : "+data.messageAll[i].courrielUtil+'</a></mark><br><br>';

                } else {
                    console.log("hello");
                    console.log(data.messageAll[i]);
                    str += '<a class="dropdown-item messageAll" data-notification="'+data.messageAll[i].id+'" href="../afficherPubliDetail/'+data.messageAll[i].idPublication+'">'+data.messageAll[i].texte+" par : "+data.messageAll[i].courrielUtil+'</a><br><br>';
                }
            }
console.log(data.message);

    btnMessage = '<div id="dropdownMessage" class="btn-group"><button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Messages <span class="badge">'+countNotification+'</span></button><div id="myDropDown" class="dropdown-menu">'+str+'</div></div><br>';
                console.log(messageNb+" messages");
    //Bouton bootstrap nombre de notifications

    btnTutorat = '<button class="btn btn-primary" type="button"> Tutorats <span class="badge">'+tutoratNb+'' +
        '</span></button><br>';
    btnAstuce = '<button class="btn btn-primary" type="button"> Astuces <span class="badge">'+astuceNb+'' +
        '</span></button><br>';
    btnQuiz = '<button class="btn btn-primary" type="button"> Quiz <span class="badge">'+quizNb+'' +
        '</span></button><br>';
    console.log(countMess);


    if(countMess==1) {
        $("#notificationResult").html(btnMessage+btnTutorat+btnAstuce+btnQuiz);
    }

                if(on==false) {
                    console.log("last");
                    console.log(btnMessage);
                    $("#notificationResult").html(btnMessage+btnTutorat+btnAstuce+btnQuiz);
                }

                $('#dropdownMessage').on('show.bs.dropdown', function () {
                    console.log("true");
                    if(countMess>1) {
                        on=true;
                    }


                });

                $('#dropdownMessage').on('hide.bs.dropdown', function () {
                    console.log("hidden");
                    if(countMess>1) {
                        on=false;
                    }



                });
                console.log(on);


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
    }
    $( function() {
        $( "#dialog" ).dialog({
            width: 500,
            autoOpen: false,
            position: { my: "center", at: "top" },
            show: {
                effect: "clip",
                duration: 1000
            },
            hide: {
                effect: "drop",
                duration: 1000
            }
        });

        $( "#opener" ).on( "click", function() {
            $( "#dialog" ).dialog( "open" );
        });
    } );
</script>
<div id="demo"></div>



