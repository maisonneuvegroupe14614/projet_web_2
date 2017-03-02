<?php

class Publication {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication');
        return self::$database->liste("Publication");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielUtil='$courriel'");
        return self::$database->liste("Publication");
    }

    public static function enregistrer ($texte,$url,$courrielUtil) {
        self::initialiserDB();
        $idCategorie=1;
        $titre= "test";
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
}