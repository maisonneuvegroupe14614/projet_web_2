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
    echo "<h1>Publications</h1>";
        echo '<form action="'.path.'client/ajouterPublicationAmi/'.$data2.'" method="post">
                    <textarea name="publications">
                    </textarea>
    <input type="text" name="url">
    <input type="submit">
</form>';
    foreach($data["publication_ami"] as $publication) {
    ?>
        <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>


            <p><?php echo $publication->texte?></p>
            <p> <?php //echo $publication->url ?> </p>

            <img src="<?php echo path?>templates/images/suivre.png"   width="20" height="20">&nbsp;</img><a class="droite" href="../afficherPubliDetail/<?php echo $publication->id ?>">Suivre</a>
            <img src="<?php echo path?>templates/images/partager.png" width="20" height="20">&nbsp;</img><a class="droite" href="#">Partager</a>
            <img src="<?php echo path?>templates/images/evaluer.png"  width="20" height="20">&nbsp;</img><a href="../afficherEvaluation/<?php  echo $publication->id; ?>">Évaluer</a>
        </div>

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
</section>
