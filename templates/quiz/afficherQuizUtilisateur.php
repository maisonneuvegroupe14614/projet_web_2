<article>
    <a href="<?php echo path ?>client/afficherAjouterQuiz" class="btn btn-info btn-sm">
        <span class="glyphicon glyphicon-pencil"></span> Creation Quiz
    </a> <br><br>
    <table>
        <tr>
            <th>Nom Quiz</th>
            <th>Nb Questions</th>
            <th>Date Creation</th>
        </tr>
    <?php foreach ($data["quiz"] as $quiz) :
        echo "<tr><td><a href='afficherQuizById/$quiz->id'>".$quiz->titre."</a></td>";
        echo "<td>3</td>";
        echo "<td>".$quiz->dateCreation."</td></tr>";
    endforeach; ?>
        </table>
</article>
</section>