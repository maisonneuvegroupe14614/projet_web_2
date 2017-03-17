<section>
    <p id="util"><?php
if(isset($data["nom_utilisateur"])) {
    echo $data["nom_utilisateur"]->nom."  ".$data["nom_utilisateur"]->prenom."  <b> ".$data["nom_utilisateur"]->description."</b>";

}

        ?></p>
    <nav id="menu-gauche">

        <ul>
            <li><span class="glyphicon glyphicon-home"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/espace/<?php echo $_SESSION['courriel']?>">Accueil        </a></li>
            <li><span class="glyphicon glyphicon-user"       aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/mes_amis">Mes amis</a></li>
            <li><span class="glyphicon glyphicon-envelope"   aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/messages">Messages Espace</a></li>
            <li><span class="glyphicon glyphicon-blackboard" aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/tutorats">Tutorats</a></li>
            <li><span class="glyphicon glyphicon-thumbs-up"  aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/astuces">Astuces</a></li>
            <li><span class="glyphicon glyphicon-pencil"     aria-hidden="true" style="color:#7C3840;">&nbsp</span><a href="<?php echo path?>client/afficherQuizUtilisateur">Quiz</a></li>
        </ul>

            <div id="notificationResult"><div id="notificationMessage"></div><div id="notificationTutorat"></div><div id="notificationAstuce"></div><div id="notificationQuiz"></div></div>

        <div id="demandes_recu">
            <div id="dropdownAmis" class="btn-group"><button class="btn btn-sm btn-danger dropdown-toggle btn-block" type="button"
                                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Demandes <span class="badge"><?php if(isset($data["demandes_recu"])) { echo sizeof($data["demandes_recu"]); } ?></span>
                </button><div class="dropdown-menu">
                    <?php
                    if(isset($data['demandes_recu'])) {
                        foreach ($data['demandes_recu'] as $demande) { ?>


                            <form action="<?php echo path.'client/accepte_ami'; ?>" method="post"><p><?php echo $demande->courrielUtil ?>
                                <div class="btn-group">
                                    <button name="accepte_ami" class="btn btn-danger btn-sm" type="submit" value="<?php echo $demande->courrielUtil ?>" >Accepté</button>
                                    <button name="refuse_ami" class="btn btn-danger btn-sm" type="submit" value="<?php echo $demande->courrielUtil ?> " >Refusé</button>
                                </div>
                            </form>


                        <?php }
                    echo "</div></div>";
                    }?>

        </div>
        <div id="dialogListeConnecte" title="Liste Amis"></div>
        <div id="chat_group" title="Zone de clavardage"><h3 id="mon_ami"></h3><div id='text_chat'></div>
            <textarea id="message_chat" name="chat" style="width:100%;"></textarea><input id="destinataire" name="destinataire" type="hidden" value=""></input><button onclick="envoyer_chat();" type="submit">Envoyer</button>
        </div>
        <button id="openerListeConnecte"  href="#" class="btn btn-success btn-sm chat_btn">Utilisateurs Chat Online</button>
    </nav>

    <script type="text/javascript" src="<?php echo path; ?>templates/js/notifications.js"></script>
    <script type="text/javascript" src="<?php echo path; ?>templates/js/chat.js"></script>