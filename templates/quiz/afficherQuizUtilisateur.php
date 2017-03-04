<section>
    <?php foreach ($data["quiz"] as $quiz) :
        echo "<a href='afficherQuizById/$quiz->id'>".$quiz->titre."<br>";
    endforeach; ?>
</section>