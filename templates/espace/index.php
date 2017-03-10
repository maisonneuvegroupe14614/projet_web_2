<?php


?>


<section>
    <p id="util"><?php

        echo $data["nom_utilisateur"]->nom."  ".$data["nom_utilisateur"]->prenom."  <b> ".$data["nom_utilisateur"]->description."</b>";


        ?></p>
    <nav id="menu-gauche"><br><br><br>

        <ul>
            <li><span class="glyphicon glyphicon-home"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/espace/<?php echo $_SESSION['courriel']?>">Accueil        </a></li>
            <li><span class="glyphicon glyphicon-user"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/mes_amis"                                 >Mes amis       </a></li>
            <li><span class="glyphicon glyphicon-envelope"   aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="#"                                                                >Messages espace</a></li>
            <li><span class="glyphicon glyphicon-blackboard" aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/tutorats"                                 >Tutorats       </a></li>
            <li><span class="glyphicon glyphicon-thumbs-up"  aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/astuces"                                  >Astuces        </a></li>
            <li><span class="glyphicon glyphicon-pencil"     aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/afficherAjouterQuiz"                      >Quiz           </a></li>
        </ul>

        <div id="notificationResult"><div id="notificationMessage"></div><div id="notificationTutorat"></div><div id="notificationAstuce"></div><div id="notificationQuiz"></div></div>

        <div id="demandes_recu">
            <div id="dropdownAmis" class="btn-group"><button class="btn btn-danger dropdown-toggle btn-block" type="button"
                                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Demandes <span class="badge"><?php echo sizeof($data["demandes_recu"]) ?></span>
                </button><div class="dropdown-menu">
            <?php
            foreach ($data['demandes_recu'] as $demande) { ?>


                    <form action="<?php echo path.'client/accepte_ami'; ?>" method="post"><p><?php echo $demande->courrielUtil ?>
                        <button name="accepte_ami" type="submit" value="<?php echo $demande->courrielUtil ?>" >Accepté</button>
                        <button name="refuse_ami"  type="submit" value="<?php echo $demande->courrielUtil ?> " >Refusé</button>
                        </p>
                    </form>


            <?php } ?>
        </div></div>
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
    <button class="btn btn-primary creer_pub" id="openerPublication">Nouvelle Publication</button>

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
                        <input type="submit" class="btn btn-primary" value="Envoyer"></input>
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
                            <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="1">
                        <input type="submit" class="btn btn-primary" value="Envoyer">
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
                            <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="2">
                        <input type="submit" class="btn btn-primary" value="Envoyer"></input>
                    </form>
                </div>
            </div>
        </form>
    </div>






    <?php

    if(isset($data["publication"])) {
        /*mon mur*/
        ?>
        <div id="publications">
            <?php
            foreach($data["publication"] as $publication) { ?>
                <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                    <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

                    <img src="<?php echo path; ?>templates/images/lire.png"    width="20" height="20">&nbsp;</img><span class="droite afficher" style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Lire   </span>
                    <img src="<?php echo path; ?>templates/images/evaluer.png" width="20" height="20">&nbsp;</img><span class="droite evaluer"  style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Évaluer</span>

                    <div class="affichage" title="<?php echo $publication->titre ?>" data-id="<?php echo $publication->id ?>">
                        <form action="../afficherPubliDetail/<?php echo $data2; ?>" method="post">
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active"><br>
                                    <div class="form-group">
                                        <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation ?></p>
                                        <p><?php echo $publication->texte ?></p>
                                        <p><?php echo $publication->url   ?></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="evaluation" title="Évaluer une Publication" data-id="<?php echo $publication->id ?>">
                        <form action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active"><br>
                                    <div class="form-group">
                                        <textarea name="evaluations"></textarea>
                                        <input type="number" name="note" id="note" min="0" max="5" value="0">
                                    </div>
                                    <!--<select name="destinataire">
											<option value="1">Amis  </option>
											<option value="2">Public</option>
											<?php
                                    foreach ($data["amis"] as $ami) {
                                        echo "<option value='".$ami->courriel."'>".$ami->courriel."</option>";
                                    }
                                    ?>
										</select>-->
                                    <input type="hidden" name="idPublication" value="<?php echo $publication->id ?>">
                                    <input type="submit" class="btn btn-primary"></input>
                                </div>
                            </div>
                            <div class="notes"></div>
                        </form>
                    </div>

                </div>
            <?php } ?>
        </div>
    <?php }

echo "</article>";

    if(isset($data["utilisateur"])){
        echo '<h1>espace mes amis</h1>';
        foreach ($data["utilisateur"] as $utilisateur) {

            echo "<div><a href=".path."client/ami/$utilisateur->courriel>".$utilisateur->nom."  ".$utilisateur->prenom."</a>".'<button class="retirer_ami" value="'.$utilisateur->courriel.'">retirer de la list</button></div>'."<br>";
        }


        echo '<div id="id_div" hidden>
                        <h1>supression </h1>
                        </div>';
    }
 ?>

</section>


<script>
    var countMess = 0;
    var countTuto = 0;
    var countAstuce = 0;
    var countQuiz = 0;
    var on;
    var onTutorat;
    var onAstuce;

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
            countTuto++;
            countAstuce++;
            countQuiz++;

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
            var countNotificationMessage = 0;
            var countNotificationTutorat = 0;
            var countNotificationAstuce = 0;
            var countNotificationQuiz = 0;


            for(var j=0;j<messageNb;j++) {
                if(data.message[j].notificationVue==null) {
                    countNotificationMessage++;
                    console.log(countNotificationMessage);
                }
            }

            for(var k=0;k<tutoratNb;k++) {
                if(data.tutorat[k].notificationVue==null) {
                    countNotificationTutorat++;
                }
            }

                for(var l=0;l<astuceNb;l++) {
                    if(data.astuce[l].notificationVue==null) {
                        countNotificationAstuce++;
                    }
                }


            var strMessage="";
            var strTutorat="";
            var strAstuce="";
            var strQuiz="";

            for(var i=0;i<data.message.length;i++) {
                if(data.message[i].notificationVue==null) {
                    strMessage += '<mark><a class="dropdown-item messageAll" data-notification="'+data.message[i].id+'" href="../afficherPubliDetail/'+data.message[i].idPublication+'">'+data.message[i].texte+" par : "+data.message[i].courrielUtil+'</a></mark><br><br>';

                } else {
                    console.log("hello");
                    console.log(data.message[i]);
                    strMessage += '<a class="dropdown-item messageAll" data-notification="'+data.message[i].id+'" href="../afficherPubliDetail/'+data.message[i].idPublication+'">'+data.message[i].texte+" par : "+data.message[i].courrielUtil+'</a><br><br>';
                }
            }

                for(var i=0;i<data.tutorat.length;i++) {
                    if(data.tutorat[i].notificationVue==null) {
                        strTutorat += '<mark><a class="dropdown-item tutoratAll" data-notification="'+data.tutorat[i].id+'" href="../afficherPubliDetail/'+data.tutorat[i].idPublication+'">'+data.tutorat[i].texte+" par : "+data.tutorat[i].courrielUtil+'</a></mark><br><br>';

                    } else {
                        console.log("hello");
                        console.log(data.message[i]);
                        strTutorat += '<a class="dropdown-item tutoratAll" data-notification="'+data.tutorat[i].id+'" href="../afficherPubliDetail/'+data.tutorat[i].idPublication+'">'+data.tutorat[i].texte+" par : "+data.tutorat[i].courrielUtil+'</a><br><br>';
                    }
                }

                for(var i=0;i<data.astuce.length;i++) {
                    if(data.astuce[i].notificationVue==null) {
                        strAstuce += '<mark><a class="dropdown-item astuceAll" data-notification="'+data.astuce[i].id+'" href="../afficherPubliDetail/'+data.astuce[i].idPublication+'">'+data.astuce[i].texte+" par : "+data.astuce[i].courrielUtil+'</a></mark><br><br>';

                    } else {
                        console.log("hello");
                        console.log(data.astuce[i]);
                        strTutorat += '<a class="dropdown-item astuceAll" data-notification="'+data.astuce[i].id+'" href="../afficherPubliDetail/'+data.astuce[i].idPublication+'">'+data.astuce[i].texte+" par : "+data.astuce[i].courrielUtil+'</a><br><br>';
                    }
                }
console.log(data.message);

    btnMessage = '<div id="dropdownMessage" class="btn-group"><button class="btn btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Messages <span class="badge">'+countNotificationMessage+'</span></button><div id="myDropDown" class="dropdown-menu">'+strMessage+'</div></div><br>';
                console.log(messageNb+" messages");

    btnTutorat = '<div id="dropdownTutorat" class="btn-group"><button class="btn btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tutorats <span class="badge">'+countNotificationTutorat+'</span></button><div id="myDropDown" class="dropdown-menu">'+strTutorat+'</div></div><br>';
                console.log(messageNb+" messages");

    btnAstuce = '<div id="dropdownAstuce" class="btn-group"><button class="btn btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Astuces <span class="badge">'+countNotificationAstuce+'</span></button><div id="myDropDown" class="dropdown-menu">'+strAstuce+'</div></div><br>';
                console.log(messageNb+" messages");

    btnQuiz = '<button class="btn btn-primary" type="button"> Quiz <span class="badge">'+quizNb+'' +
        '</span></button><br>';
    console.log(countMess);


    if(countMess==1) {
        $("#notificationMessage").html(btnMessage);
    }

                if(on==false) {
                    console.log("last");
                    console.log(btnMessage);
                    $("#notificationMessage").html(btnMessage);
                }

                $('#dropdownMessage').on('show.bs.dropdown', function () {
                    console.log("true");
                    if(countMess>1) {
                        on=true;
                    }


                }).on('hide.bs.dropdown', function () {
                    console.log("hidden");
                    if(countMess>1) {
                        on=false;
                    }



                });

                if(countTuto==1) {
                    $("#notificationTutorat").html(btnTutorat);
                }

                if(onTutorat==false) {
                    console.log("last");
                    console.log(btnTutorat);
                    $("#notificationTutorat").html(btnTutorat);
                }

                $('#dropdownTutorat').on('show.bs.dropdown', function () {
                    console.log("true");
                    if(countTuto>1) {
                        onTutorat=true;
                    }


                }).on('hide.bs.dropdown', function () {
                    console.log("hidden");
                    if(countTuto>1) {
                        onTutorat=false;
                    }



                });





                if(countAstuce==1) {
                    $("#notificationAstuce").html(btnAstuce);
                }

                if(onAstuce==false) {
                    console.log("last");
                    console.log(btnAstuce);
                    $("#notificationAstuce").html(btnAstuce);
                }

                $('#dropdownAstuce').on('show.bs.dropdown', function () {
                    console.log("true");
                    if(countAstuce>1) {
                        onAstuce=true;
                    }


                }).on('hide.bs.dropdown', function () {
                    console.log("hidden");
                    if(countAstuce>1) {
                        onAstuce=false;
                    }



                });


                console.log(on);
                console.log(onTutorat);


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

                $(".tutoratAll").on("click" , function () {
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

                $(".astuceAll").on("click" , function () {
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




    /*x = document.querySelectorAll(".retirer_ami");
    for(i=0;i<x.length;i++){
        x[i].addEventListener("click", function(){
            //console.log(event.target.value);
            $("#dialog-confirm").dialog.open({

            });

        });
    }*/
    $( function() {
        var target;
        $( "#dialog" ).dialog({
            width: 500,
            modal: true,
            autoOpen: false,
            classes: { "ui-dialog": "highlight","ui-dialog-titlebar" : "highlight2" },
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

        $( "#openerPublication" ).on( "click", function() {
            $( "#dialog" ).dialog( "open" );
        });
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            autoOpen: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        url : 'retirer_ami',
                        type : 'POST',
                        data: { target:target.value },
                        success : function(resultat, statut){
                            target.parentNode.remove();
                            $("#dialog-confirm").dialog("close");
                        },
                        error : function(resultat, statut, erreur){
                            console.log(resultat+statut+erreur);
                        }
                    });

                },
                "Non": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $( ".evaluation" ).dialog( {
            width: 500,
            autoOpen: false,
            modal: true,
            position: { my: "center", at: "center" },
            show: {
                effect: "clip",
                duration: 1000
            },
            hide: {
                effect: "drop",
                duration: 1000
            }
        } );

        $( ".evaluer" ).each(function() {
            $(this).on("click", function() {
                var id = $(this).data('id');
                $.post({
                    url : '../findEvaluation',
                    data: { id:id },
                    success : function(resultat, statut) {
                        console.log(resultat);
                        var res=JSON.parse(resultat);
                        var str="<br>";
                        for (var i=0; i<res.evaluation.length; i++) {
                            str += "<p>" + res.evaluation[i].courrielUtil + ", " + res.evaluation[i].dateCreation + "<br>" +
                                res.evaluation[i].texte        + " "  + res.evaluation[i].note         + "<br></p>";
                        }
                        $( ".notes" ).html(str);
                        $( ".evaluation[data-id = '" + id + "']").dialog( "open" );
                        console.log(resultat+statut);
                    },
                    error : function(resultat, statut, erreur) {
                        console.log(resultat+statut+erreur);
                    }
                });
            });
        });

        $( ".affichage" ).dialog( {
            width: 500,
            autoOpen: false,
            modal: true,
            position: { my: "center", at: "center" },
            show: {
                effect: "clip",
                duration: 1000
            },
            hide: {
                effect: "drop",
                duration: 1000
            }
        } );

        $( ".afficher" ).each(function() {
            $(this).on("click", function() {
                $( ".affichage[data-id=" + $(this).data('id') + "]").dialog( "open" );
            } );
        } );



        });


        var x = document.querySelectorAll(".retirer_ami");
        for(var i=0;i<x.length;i++){
            x[i].addEventListener("click", function(e){
                //console.log(event.target.value);
                target = e.target;
                /*var text = "tu es sûre de supprimer ta relation avec "+event.target.value;
                 text +="<form><button class='btn btn-danger' value='"+event.target.value+"' name='retire_ami_conf' formmethod='post' formaction='retirer_ami'   >oui</button><button class='btn btn-success' formmethod='post' onclick=cacher()>non</button></form>";
                 document.getElementById("confirmation_supression").innerHTML = text;
                 document.getElementById("confirmation_supression").style.visibility = 'visible';*/
                $("#dialog-confirm").dialog("open");

            });
        }







</script>




<div id="confirmation_supression"  style="visibility: hidden;position: absolute;
    left: 50%;
    top: 50%;z-index: 9999;width: auto;height: auto;background-color: yellowgreen;padding: 10px 10px 10px 10px;">
    <div id="dialog-confirm" title="Effacer un ami">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Etes-vous sur de vouloir supprimer cet amis?</p>
    </div>
</div>

