<section>
    <p id="util"><?php

        echo $data["nom_utilisateur"]->nom."  ".$data["nom_utilisateur"]->prenom."  <b> ".$data["nom_utilisateur"]->description."</b>";


        ?></p>
    <nav id="menu-gauche"><br><br><br>

        <ul>
            <li><img src="<?php echo path?>templates/images/amis_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/mes_amis">Mes amis</a></li>
            <li><img src="<?php echo path?>templates/images/prof.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/tutorats">Tutorats</a></li>
            <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/astuces">Astuces</a></li>
            <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/afficherAjouterQuiz>">Quiz</a></li>
            <li><img src="<?php echo path?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;<a href="<?php echo path?>client/espace/<?php echo $_SESSION['courriel']?>">Accueil</a></li>
        </ul>


    </nav>
    <article class="center">
<?php
/*espace d un utilisateur*/

if(isset($data["liste_mes_amis"])){

/*if($data["btn_ajouter"]==true){
echo 'tu peut ajouter';
$disabled = '';
}else{
echo 'NON NON pas ajouter';
$disabled = 'disabled';
}*/
$array=[];
foreach ($data["liste_mes_amis"] as $utilisateur) {
$array[]=$utilisateur->courriel;
}
$key = in_array($data["courriel_xx"], $array); // $key = 2;
//echo $data["courriel_xx"].'<br>';
//print_r($array);
if($key){
$ajouter = '';

}else{
switch ($data["btn_ajouter"]) {
case 1:
$ajouter = '<form action="'.path.'client/demande_ami" method="post">
    <button name="demande_ami" type="submit"  value="'.$data["courriel_xx"].' "  >ajouter comme ami</button>
</form>';
break;
case 2:
$ajouter = '<h2 style="color:blue;">demande deja enjoyé</h2>';
break;
case 3:
$ajouter = '<form action="'.path.'client/accepte_ami" method="post">
    <button name="accepte_ami" type="submit"  value="'.$data["courriel_xx"].' "  >accepte comme ami</button>
    <button name="refuse_ami" type="submit"  value="'.$data["courriel_xx"].' "  >refusé la demande </button>
</form>';
break;
}




/*if($data["btn_ajouter"]){
$ajouter = '<form action="'.path.'client/demande_ami" method="post">
    <button name="demande_ami" type="submit"  value="'.$data["courriel_xx"].' "  >ajouter comme ami</button>
</form>';

}else{
$ajouter = '<h2 style="color:blue;">demande deja enjoyé';
    }*/



    }

    }
    if(isset($data["publication_ami"])||isset($data["utilisateur_ami"])){
    echo '<h1>espace  '.$data["courriel_xx"].'</h1>';
    echo $ajouter;
    if(isset($data["publication_ami"])){

        ?>

        <!--   <form action="../ajouterPublication/<?php /*echo $data2; */?>" method="post">
        <input type="text" id="titrePub"><br>
<textarea name="publications">
</textarea><br>
        <input type="text" name="url">
        <input type="submit">
    </form>-->
        <button class="btn btn-primary creer_pub" id="opener">Nouvelle Publication</button>

        <div id="dialog" title="Nouvelle Publication">


            <form action="../ajouterPublicationAmi/<?php echo $data2; ?>" method="post">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Message</a></li>
                    <li><a data-toggle="tab" href="#menu1">Tutorat</a></li>
                    <li><a data-toggle="tab" href="#menu2">Astuce</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <form action="../ajouterPublicationAmi/<?php echo $data2; ?>" method="post">
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
                        <form action="../ajouterPublicationAmi/<?php echo $data2; ?>" method="post">
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
                        <form action="../ajouterPublicationAmi/<?php echo $data2; ?>" method="post">
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
    foreach($data["publication_ami"] as $publication) {
    ?>
        <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>


            <p><?php echo $publication->texte?></p>
            <p> <?php //echo $publication->url ?> </p>

            <img src="<?php echo path?>templates/images/suivre.png"   width="20" height="20">&nbsp;</img><a class="droite" href="../afficherPubliDetail/<?php echo $publication->id ?>">Suivre</a>
            <img src="<?php echo path?>templates/images/partager.png" width="20" height="20">&nbsp;</img><a class="droite" href="#">Partager</a>
            <img src="<?php echo path?>templates/images/evaluer.png"  width="20" height="20">&nbsp;</img><a href="../afficherEvaluation/<?php  echo $publication->id; ?>">Évaluer</a>
        </div>
    </article></section>
    <?php
    }
    }
    if(isset($data["utilisateur_ami"])){
    echo "<h1>Amis</h1>";
    foreach ($data["utilisateur_ami"] as $utilisateur) {
    if($utilisateur->courriel == $_SESSION['courriel']){
    echo "<a href='".path."client/espace/$utilisateur->courriel'>".$utilisateur->courriel."</a><br>";

    }else{
    echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
    }

    }

    }


    }


    ?>
<script>
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
