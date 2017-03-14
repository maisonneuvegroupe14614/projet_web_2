<section>
    <p id="util"><?php

        echo $data["nom_utilisateur"]->nom."  ".$data["nom_utilisateur"]->prenom."  <b> ".$data["nom_utilisateur"]->description."</b>";


        ?></p>
    <nav id="menu-gauche">

        <ul>
            <li><span class="glyphicon glyphicon-home"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/espace/<?php echo $_SESSION['courriel']?>">Accueil        </a></li>
            <li><span class="glyphicon glyphicon-user"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/mes_amis">Mes amis</a></li>
            <li><span class="glyphicon glyphicon-envelope"   aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/messages">Messages Espace</a></li>
            <li><span class="glyphicon glyphicon-blackboard" aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/tutorats">Tutorats</a></li>
            <li><span class="glyphicon glyphicon-thumbs-up"  aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/astuces">Astuces</a></li>
            <li><span class="glyphicon glyphicon-pencil"     aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/afficherAjouterQuiz">Quiz</a></li>
        </ul>

            <div id="notificationResult"><div id="notificationMessage"></div><div id="notificationTutorat"></div><div id="notificationAstuce"></div><div id="notificationQuiz"></div></div>

        <div id="demandes_recu">
            <div id="dropdownAmis" class="btn-group"><button class="btn btn-sm btn-danger dropdown-toggle btn-block" type="button"
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
   <script type="text/javascript" src="<?php echo path; ?>templates/js/notifications.js"></script>