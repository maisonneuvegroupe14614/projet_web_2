<?php

//print_r($data);

echo "<br><br><br><br><br><br><h1>Boîte de réception</h1>";
foreach($data["message"] as $message) {
        echo $message->courrielUtil."<br>";
        echo $message->dateCreation."<br>";
        echo $message->sujet."<br>";
        echo $message->url."<br>";
        echo $message->texte."<br><br>";
}

?>

<form action="../ajouterMessage/<?php echo $data2; ?>" method="post">
        <input type="text" name="courrielAmi">
        <input type="text" name="sujet">
        <input type="text" name="url">
	<textarea name="messages">
	</textarea>
	<input type="submit">
</form>
<a href="../logout">Logout</a>
<a href="../confirmationDesinscription">Désinscrire</a>