<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017-02-20
 * Time: 2:07 PM
 */

class Utilisateur {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Utilisateur');
        return self::$database->liste("Utilisateur");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Utilisateur WHERE courriel='$courriel'");
        return self::$database->rangee("Utilisateur");
    }

    public static function enregistrer ($courriel,$motPasse,$nom,$prenom,$statut,$ville,$province,$pays) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO Utilisateur (courriel, motPasse, nom, prenom, idStatut, ville, province, pays)
          values (:courriel, :motPasse, :nom, :prenom, :statut, :ville, :province, :pays)");
        $password_hashed = password_hash($motPasse, PASSWORD_BCRYPT);
        self::$database->bind(':courriel', $courriel);
        self::$database->bind(':motPasse', $password_hashed);
        self::$database->bind(':nom', $nom);
        self::$database->bind(':prenom', $prenom);
        self::$database->bind(':statut', $statut);
        self::$database->bind(':ville', $ville);
        self::$database->bind(':province', $province);
        self::$database->bind(':pays', $pays);
        self::$database->execute();
    }

    public static function listeAmis () {
        self::initialiserDB();
        self::$database->query("SELECT CONCAT(Uami.prenom,\" \",Uami.nom), 
            CONCAT(Util.prenom,\" \",Util.nom)) AS nomAmi FROM  Ami JOIN  Utilisateur Util ON Util.courriel=Ami.courrielUtil 
            JOIN Utilisateur Uami ON Uami.courriel=Ami.courrielAmi WHERE  courrielUtil=\"guy@hotmail.com\" OR courrielAmi=\"guy@hotmail.com\";");
    }


}