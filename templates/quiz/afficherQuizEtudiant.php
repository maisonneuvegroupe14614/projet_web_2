<article>
    <table>
        <tr>
            <th>Nom Quiz</th>
            <th>Essai</th>
            <th>Moyenne des notes</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data["quiz"] as $quiz) :
            echo "<tr><td><a href='afficherQuizById/$quiz->id'>".$quiz->titre."</a></td>";
            echo "<td>".$quiz->count."</td>";
            echo "<td>".$quiz->note."</td>";
            echo "<td><a href='afficherQuizById/$quiz->id'><a href='afficherQuizById/$quiz->id'>
                <span class='glyphicon glyphicon-repeat' aria-hidden='true'></span></a></td></tr>";
        endforeach; ?>
    </table>
</article>
</section>