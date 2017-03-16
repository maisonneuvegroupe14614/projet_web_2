<?php

/**
 * Class Partage
 */
class Partage {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Trouver tous les partages
     *
     * @return mixed
     */
    public static function all () {
        self::initialiserDB();
        self::$database->query("SELECT * from Partage");
        return self::$database->liste("Partage");
    }

    /**
     * Trouver un partage
     *
     * @param $courriel
     * @return mixed
     */
    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Partage WHERE courrielUtil='$courriel' ORDER BY dateCreation DESC");
        return self::$database->liste("Partage");
    }
    
    //SELECT id, destinataire, dateCreation, idPublication, P.courrielUtil, P.courrielAmi
    //FROM   Partage P
    //LEFT   JOIN Ami ON (Ami.courrielUtil="guy@hotmail.com" AND Ami.courrielAmi =P.courrielUtil)
    //                OR (Ami.courrielAmi ="guy@hotmail.com" AND Ami.courrielUtil=P.courrielUtil)
    //WHERE destinataire="public"
    //OR   (destinataire="moi"  AND    P.courrielUtil="guy@hotmail.com")
    //OR   (destinataire="amis" AND (Ami.courrielUtil="guy@hotmail.com"
    //                           OR  Ami.courrielAmi ="guy@hotmail.com"
    //                           OR    P.courrielUtil="guy@hotmail.com"))
    //OR  ((destinataire="ami"   OR      destinataire="autre")
    //                          AND    P.courrielAmi ="guy@hotmail.com")
    //ORDER BY dateCreation DESC

    /**
     * Enregistrer un partage
     *
     * @param $destinataire
     * @param $idPublication
     * @param $courrielUtil
     * @param $courrielAmi
     */
    public static function enregistrer ($destinataire,$idPublication,$courrielUtil,$courrielAmi) {
        self::initialiserDB();
        self::$database->query("INSERT INTO Partage (destinataire, idPublication, courrielUtil, courrielAmi)
          values (:destinataire, :idPublication, :courrielUtil, :courrielAmi)");
        self::$database->bind(':destinataire' , $destinataire);
        self::$database->bind(':idPublication', $idPublication);
        self::$database->bind(':courrielUtil' , $courrielUtil);
        self::$database->bind(':courrielAmi'  , $courrielAmi);
        self::$database->execute();
    }
}