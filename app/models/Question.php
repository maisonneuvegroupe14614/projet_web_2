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

    public static function Enregistrer ($noQuestion,$question,$typeReponse,$idQuiz) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO Question (noQuestion,question,typeReponse,idQuiz)
          values (:noQuestion, :question, :typeReponse, :idQuiz)");
        self::$database->bind(':noQuestion', $noQuestion);
        self::$database->bind(':question', $question);
        self::$database->bind(':typeReponse', $typeReponse);
        self::$database->bind(':idQuiz', $idQuiz);
        self::$database->execute();
    }

    public static function EnregistrerChoix ($noChoix,$choix,$reponse,$idQuiz,$idQuestion) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO ChoixReponse (noChoix,choix,reponse,idQuiz,idQuestion)
          values (:noChoix, :choix, :reponse, :idQuiz, :idQuestion)");
        self::$database->bind(':noChoix', $noChoix);
        self::$database->bind(':choix', $choix);
        self::$database->bind(':reponse', $reponse);
        self::$database->bind(':idQuiz', $idQuiz);
        self::$database->bind(':idQuestion', $idQuestion);
        self::$database->execute();
    }

    public static function find ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * from Question WHERE idQuiz='$id'");
        return self::$database->liste("Question");
    }

    public static function allChoix ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * from ChoixReponse WHERE idQuiz='$id'");
        return self::$database->liste("Question");
    }

    public static function dernier () {
        self::initialiserDB();
        return self::$database->dernierId();
    }
}