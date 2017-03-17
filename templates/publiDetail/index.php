<?php

//print_r($data);

echo "<br><br><br><br><br><br><h1>Publication</h1>";
foreach($data["publiDetail"] as $publiDetail) {
        echo $publiDetail->titre."<br>";
        echo $publiDetail->texte."<br>";
        echo $publiDetail->url."<br>";
        echo $publiDetail->dateCreation."<br>";
        echo $publiDetail->courrielUtil."<br><br>";
}

?>
</section>
<script type="text/javascript" src="<?php echo path; ?>templates/js/notifications.js"></script>
