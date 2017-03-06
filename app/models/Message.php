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

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT id, sujet, texte, url, dateCreation, courrielUtil, courrielAmi,
          IF(courrielUtil='$courriel',courrielUtil,courrielAmi)  AS cUtil,
          IF(courrielUtil='$courriel',courrielAmi ,courrielUtil) AS cAmi
          FROM  Message
          WHERE courrielUtil='$courriel' OR courrielAmi='$courriel'
          ORDER BY cAmi, dateCreation DESC");
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