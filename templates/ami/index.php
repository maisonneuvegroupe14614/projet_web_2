<?php


//print_r($data);
echo "<h1>Publications</h1>";
foreach($data["publication"] as $publication) {
    echo $publication->texte."<br>";
    echo $publication->url."<br><br>";
}

echo "<br><br>";
echo "<h1>Amis</h1>";
foreach ($data["utilisateur"] as $utilisateur) {
    echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
}



?>

<form action="../ajouterPublicationAmi/<?php echo $data2; ?>" method="post">
<textarea name="publications">
</textarea>
    <input type="text" name="url">
    <input type="submit">
</form>
<a href="../logout">Logout</a>