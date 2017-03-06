

<?php
$menu['mes_amis'] = new Menu('amis_rouge.png', 30, 30, "client/mes_amis", "Mes amis"); 
$menu['creer_publication'] = new Menu('post-it2.png', 30, 30, '#', 'Créer publication');
$menu['turorats'] = new Menu('prof.png', 30, 30, 'client/tutorats', 'Tutorats');
$menu['astuces'] = new Menu('ampoule_rouge.png', 30, 30, 'client/astuces', 'Astuces');
$menu['accueil'] = new Menu('ampoule_rouge.png', 30, 30, 'client/espace/'.$_SESSION["courriel"], 'Accueil');

?>
