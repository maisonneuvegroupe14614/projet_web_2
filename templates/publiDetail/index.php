<?php

//print_r($data);

echo "<br><br><br><br><br><br><h1>Publication</h1>";
foreach($data["publiDetail"] as $publiDetail) {
        echo $publiDetail->titre."<br>";
        echo $publiDetail->texte."<br>";
        echo $publiDetail->url."<br>";
        echo $publiDetail->destinataire."<br>";
        echo $publiDetail->dateCreation."<br>";
        echo $publiDetail->courrielUtil."<br><br>";
}

?>

<a href="../logout">Logout</a>
<a href="../confirmationDesinscription">Désinscrire</a>