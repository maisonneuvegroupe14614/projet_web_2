<?php

/**
 * Class NotificationPub
 */
class NotificationPub {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Requete pour trouver toutes les notifications d'une publication
     *
     * @param $courriel
     * @param $type
     * @return mixed
     */
    public static function all ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT NotificationPub.id,Publication.courrielUtil,Publication.texte,Publication.titre,NotificationPub.notificationVue,NotificationPub.idPublication,Publication.id as idPub from NotificationPub JOIN Publication ON NotificationPub.idPublication=Publication.id JOIN Categorie ON Publication.idCategorie=Categorie.id WHERE idUtilisateur='$courriel' AND Publication.idCategorie='$type' 
            ORDER BY NotificationPub.id DESC LIMIT 10");
        return self::$database->liste("NotificationPub");
    }

    /**
     * Requete pour mettre a jour les notifications d'une pub
     *
     * @param $id
     */
    public static function update($id) {
        self::initialiserDB();
        self::$database->query("UPDATE NotificationPub SET notificationVue=:notificationVue WHERE id='$id' ");
        self::$database->bind(':notificationVue', 1);
        self::$database->execute();
    }

    /**
     * Trouver toutes les publications qui n'ont pas ete vues
     *
     * @param $courriel
     * @param $type
     * @return mixed
     */
    public static function allNotSeen ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND type='$type' AND 
            notificationVue IS NULL ORDER BY id DESC LIMIT 10");
        return self::$database->liste("NotificationPub");
    }

    /**
     * Requete pour trouver les publications qui ont ete vues
     *
     * @param $courriel
     * @param $type
     * @return mixed
     */
    public static function allSeen ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND type='$type' AND 
            notificationVue=1 ORDER BY id DESC");
        return self::$database->liste("NotificationPub");
    }

    /**
     * Trouver une notification
     *
     * @param $courriel
     * @return mixed
     */
    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from NotificationPub WHERE idUtilisateur='$courriel' AND notificationVue IS NULL ORDER BY id DESC");
        return self::$database->liste("NotificationPub");
    }

    /**
     * Enregistrer une nouvelle notification dans la BD
     *
     * @param $type
     * @param $idUtilisateur
     * @param $idPublication
     */
    public static function enregistrer ($type,$idUtilisateur,$idPublication) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO NotificationPub (type, idUtilisateur, idPublication)
          values (:type, :idUtilisateur, :idPublication)");
        self::$database->bind(':type', $type);
        self::$database->bind(':idUtilisateur', $idUtilisateur);
        self::$database->bind(':idPublication', $idPublication);
        self::$database->execute();
    }

    /**
     * Trouver la derniere notification inserer dans la BD
     *
     * @return mixed
     */
    public static function last () {
        self::initialiserDB();
        return self::$database->dernierId();
    }
}