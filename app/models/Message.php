<?php

class Message {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query("SELECT * from Message");
        return self::$database->liste("Message");
    }

    public static function find ($courrielAmi,$courrielUtil) {
        self::initialiserDB();
        self::$database->query("SELECT id, sujet, texte, url, dateCreation, courrielUtil, courrielAmi,
          IF(courrielUtil='$courrielUtil',courrielUtil,courrielAmi)  AS cUtil,
          IF(courrielUtil='$courrielUtil',courrielAmi ,courrielUtil) AS cAmi
          FROM   Message
          WHERE (courrielUtil='$courrielUtil' AND courrielAmi='$courrielAmi')
          OR    (courrielUtil='$courrielAmi'  AND courrielAmi='$courrielUtil')
          ORDER  BY cAmi, dateCreation DESC");
        return self::$database->liste("Message");
    }

    public static function enregistrer ($sujet,$texte,$url,$courrielUtil,$courrielAmi) {
        self::initialiserDB();
        self::$database->query("INSERT INTO Message (sujet, texte, url, courrielUtil, courrielAmi)
          values (:sujet, :texte, :url, :courrielUtil, :courrielAmi)");
        self::$database->bind(':sujet', $sujet);
        self::$database->bind(':texte', $texte);
        self::$database->bind(':url'  , $url);
        self::$database->bind(':courrielUtil', $courrielUtil);
        self::$database->bind(':courrielAmi' , $courrielAmi);
        self::$database->execute();
    }
}