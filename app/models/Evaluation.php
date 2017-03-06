<?php

class Evaluation {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Evaluation');
        return self::$database->liste("Evaluation");
    }

    public static function find ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * from Evaluation WHERE idPublication='$id' ORDER BY dateCreation DESC");
        return self::$database->liste("Evaluation");
    }

    public static function enregistrer ($texte,$note,$idPublication,$courrielUtil) {
        self::initialiserDB();
        self::$database->query("INSERT INTO Evaluation (texte, note, idPublication, courrielUtil)
          values (:texte, :note, :idPublication, :courrielUtil)");
        self::$database->bind(':texte', $texte);
        self::$database->bind(':note' , $note);
        self::$database->bind(':idPublication', $idPublication);
        self::$database->bind(':courrielUtil' , $courrielUtil);
        self::$database->execute();
    }
}