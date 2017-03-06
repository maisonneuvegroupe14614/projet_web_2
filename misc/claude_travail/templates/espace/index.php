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
<script>
function myFunction()
{
	console.log("test");
}
</script>

<section>
    <p id="util"><?php echo $data["utilCourant"]->prenom." ".$data["utilCourant"]->nom.", ".$data["utilCourant"]->description; ?></p>
    <nav id="menu-gauche"><br><br><br>
		<ul>
			<li><a href="#"><img src="<?php echo path; ?>templates/images/amis_rouge.png" width="30" height="30">&nbsp;</img></a><a class="categorie" href="#">Mes amis</a></li>
			<li><a href="#"><img src="<?php echo path; ?>templates/images/post-it2.png" width="30" height="30">&nbsp;</img></a><a class="categorie" href="#">Créer une publication</a></li>
			<li><a href="#"><img src="<?php echo path; ?>templates/images/prof.png" width="30" height="30">&nbsp;</img></a><a class="categorie" href="#">Tutorats</a></li>
			<li><a href="#"><img src="<?php echo path; ?>templates/images/ampoule_rouge.png" width="30" height="30">&nbsp;</img></a><a class="categorie" href="#">Astuces</a></li>
		</ul>
	</nav>
	
    <!--<div><form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
			<textarea name="publications">
			</textarea>
            <input type="text" name="url">
            <input type="submit">
        </form>
        <a href="../logout">Logout</a>
        <a href="../confirmationDeinscription">Desinscrire</a>
    </div>-->
    <div id="publications">
            <?php foreach($data["publication"] as $publication) {?>
            <div class='publication'><img id="punaise" src="<?php echo path; ?>templates/images/punaise.png" width="30" height="30" class="centre"><br>
				<p><?php echo $publication->auteur.", ".$publication->dateCreation." - ".$publication->titre ?></p>
                <!--<p><?php echo $publication->texte ?></p>
                <p><?php echo $publication->url ?></p>-->

            <img src="<?php echo path; ?>templates/images/suivre.png"   width="20" height="20">&nbsp;</img><a class="droite" href="../afficherMessage/<?php    echo $data2                      ?>">Suivre  </a>
			<img src="<?php echo path; ?>templates/images/partager.png" width="20" height="20">&nbsp;</img><a class="droite" href="../afficherPartage/<?php    echo $data2                      ?>">Partager</a>
            <img src="<?php echo path; ?>templates/images/evaluer.png"  width="20" height="20">&nbsp;</img><a                href="../afficherEvaluation/<?php echo $publication->idPublication ?>">Évaluer </a>
            </div>
            <?php } ?>



    </div>
    <!--<section>
    <?php
    foreach ($data["utilisateur"] as $utilisateur) {
        echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
    }
    ?></section>-->
</section>