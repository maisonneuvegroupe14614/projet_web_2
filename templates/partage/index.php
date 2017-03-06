<?php

//print_r($data);

echo "<br><br><br><br><br><br><h1>Partages</h1>";
foreach($data["partage"] as $partage) {
        echo $partage->destinataire."<br>";
        echo $partage->idPublication."<br><br>";
}

?>

<form action="../ajouterPartage/<?php echo $data2; ?>" method="post">
	<textarea name="partages">
	</textarea>
        <input type="text" name="destinataire">
        <input type="text" name="idPublication">
	<input type="submit">
</form>
<a href="../logout">Logout</a>
<a href="../confirmationDesinscription">Désinscrire</a>