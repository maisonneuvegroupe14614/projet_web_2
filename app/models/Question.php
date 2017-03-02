<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017-02-27
 * Time: 1:26 PM
 */

class Question {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function enregistrer ($idQuiz,$noQuestion,$question,$reponse) {
        self::initialiserDB();
        $typeReponse="checkbox";
        self::$database->query(" INSERT INTO Question (idQuiz,noQuestion,question,typeReponse,reponse)
          values (:idQuiz, :noQuestion, :question, :typeReponse, :reponse)");
        self::$database->bind(':idQuiz', $idQuiz);
        self::$database->bind(':noQuestion', $noQuestion);
        self::$database->bind(':question', $question);
        self::$database->bind(':typeReponse', $typeReponse);
        self::$database->bind(':reponse', $reponse);
        self::$database->execute();
    }
}