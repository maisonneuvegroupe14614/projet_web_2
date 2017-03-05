<?php

class NotificationPub {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT NotificationPub.id,Publication.courrielUtil,Publication.texte,Publication.titre,NotificationPub.notificationVue from NotificationPub JOIN Publication on NotificationPub.idPublication=Publication.id WHERE idUtilisateur='$courriel' AND type='$type' 
            ORDER BY NotificationPub.id DESC LIMIT 10");
        return self::$database->liste("NotificationPub");
    }

    public static function update($id) {
        self::initialiserDB();
        self::$database->query("UPDATE NotificationPub SET notificationVue=:notificationVue WHERE id='$id' ");
        self::$database->bind(':notificationVue', 1);
        self::$database->execute();
    }

    public static function allNotSeen ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND type='$type' AND 
            notificationVue IS NULL ORDER BY id DESC");
        return self::$database->liste("NotificationPub");
    }

    public static function allSeen ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND type='$type' AND 
            notificationVue=1 ORDER BY id DESC");
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