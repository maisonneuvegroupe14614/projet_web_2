<?php

class NotificationPub {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from NotificationPub ORDER BY id DESC');
        return self::$database->liste("NotificationPub");
    }

    public static function allType ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND type='$type' AND 
            notificationVue IS NULL ORDER BY id DESC");
        return self::$database->liste("NotificationPub");
    }


    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND notificationVue IS NULL ORDER BY id DESC");
        return self::$database->liste("NotificationPub");
    }

    public static function enregistrer ($type,$idUtilisateur,$idPublication) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO NotificationPub (type, idUtilisateur, idPublication)
          values (:type, :idUtilisateur, :idPublication)");
        self::$database->bind(':type', $type);
        self::$database->bind(':idUtilisateur', $idUtilisateur);
        self::$database->bind(':idPublication', $idPublication);
        self::$database->execute();
    }

    public static function last () {
        self::initialiserDB();
        return self::$database->dernierId();
    }
}