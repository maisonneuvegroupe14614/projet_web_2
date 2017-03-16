<?php

/**
 * Class Question
 */
class Question {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Enregistrer une question
     *
     * @param $noQuestion
     * @param $question
     * @param $typeReponse
     * @param $idQuiz
     */
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

    /**
     * Enregistrer les choix d'une question
     *
     * @param $noChoix
     * @param $choix
     * @param $reponse
     * @param $idQuiz
     * @param $idQuestion
     */
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

    /**
     * Trouver une question
     *
     * @param $id
     * @return mixed
     */
    public static function find ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * from Question WHERE idQuiz='$id'");
        return self::$database->liste("Question");
    }

    /**
     * Trouver les choix d'une question
     *
     * @param $id
     * @return mixed
     */
    public static function allChoix ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * from ChoixReponse WHERE idQuiz='$id'");
        return self::$database->liste("Question");
    }

    /**
     * Trouver la derniere question inserer dans la BD
     *
     * @return mixed
     */
    public static function dernier () {
        self::initialiserDB();
        return self::$database->dernierId();
    }
}