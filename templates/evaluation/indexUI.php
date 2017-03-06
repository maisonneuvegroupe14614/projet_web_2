<html>
<head>
    <meta charset = utf-8>
	
	<script>
	jQuery(document).ready(function($){
	
		// Création d'un slider dans l'élément id note
		$("#note").slider({
			range:  true,
			min:    0,          // valeur min
			max:    1000,       // valeur max
			values: [100, 600],	// position des 2 curseurs à l'initialisation
			orientation: "horizontal",
			// Action à effectuer lorsqu'on déplace l'un des curseur
			slide: function(event, ui){
				$('#prix_min').html(ui.values[0]);
				$('#prix_max').html(ui.values[1]);
			}
		});
     
		// Initialisation des valeurs numériques au chargement de la page
		$('#prix_min').html($("#note").slider("values", 0));
		$('#prix_max').html($("#note").slider("values", 1));
    
	});
	</script>
</head>

<?php

//print_r($data);

echo "<h1>Évaluations</h1>";
foreach($data["evaluation"] as $evaluation) {
        echo $evaluation->texte."<br>";
        echo $evaluation->note."<br><br>";
}

?>

<form action="../client/ajouterEvaluation" method="post">
	<textarea name="evaluations">
	</textarea>
	<!--<div><b>Fourchette de prix :</b></div><br/>
    <div id="bornes_prix">De <span id="prix_min"></span> &agrave; <span id="prix_max"></span> $</div>
    <div id="note"></div>-->
    <input type="number" name="note" id="note">
	<input type="submit">
</form>
<a href="../logout">Logout</a>
<a href="../confirmationDesinscription">Désinscrire</a>
</html>