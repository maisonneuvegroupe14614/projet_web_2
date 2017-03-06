<?php

//print_r($data);

echo "<br><br><br><br><br><br><h1>Évaluations</h1>";
foreach($data["evaluation"] as $evaluation) {
        echo $evaluation->texte."<br>";
        echo $evaluation->note."<br><br>";
}

?>

<form action="../ajouterEvaluation/<?php echo $data2; ?>" method="post">
	<textarea name="evaluations">
	</textarea>
        <input type="number" name="note" id="note" min="0" max="5" value="0">
	<input type="submit">
</form>
<a href="../logout">Logout</a>
<a href="../confirmationDesinscription">Désinscrire</a>