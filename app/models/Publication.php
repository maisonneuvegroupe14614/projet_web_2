<?php

class Publication {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication ORDER BY id DESC');
        return self::$database->liste("Publication");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielUtil='$courriel' ORDER BY id DESC");
        return self::$database->liste("Publication");
    }

    public static function enregistrer ($idCategorie,$titre,$texte,$url,$courrielUtil) {
        self::initialiserDB();
        $destinataire="amis";
        self::$database->query(" INSERT INTO Publication (idCategorie, titre, texte, url, destinataire, courrielUtil)
          values (:idCategorie, :titre, :texte, :url, :destinataire, :courrielUtil)");
        self::$database->bind(':idCategorie', $idCategorie);
        self::$database->bind(':titre', $titre);
        self::$database->bind(':texte', $texte);
        self::$database->bind(':url', $url);
        self::$database->bind(':destinataire', $destinataire);
        self::$database->bind(':courrielUtil', $courrielUtil);
        self::$database->execute();
    }

    public static function dernier () {
        self:self::initialiserDB();
        return self::$database->dernierId();
    }

    public static function allQuiz () {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3");
        return self::$database->liste("Publication");
    }

    public static function findQuiz ($id) {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3 AND id='$id'");
        return self::$database->liste("Publication");
    }
}