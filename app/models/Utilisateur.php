<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017-02-20
 * Time: 2:07 PM
 */

/**
 * Class Utilisateur
 */
class Utilisateur {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Trouver tous les utilisateurs
     *
     * @return mixed
     */
    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Utilisateur');
        return self::$database->liste("Utilisateur");
    }

    /**
     * Trouver un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Utilisateur WHERE courriel='$courriel'");
        return self::$database->rangee("Utilisateur");
    }

    /**
     * Enregistrer un utulisateur
     *
     * @param $courriel
     * @param $motPasse
     * @param $nom
     * @param $prenom
     * @param $statut
     * @param $ville
     * @param $province
     * @param $pays
     * @return mixed
     */
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
        return $result = self::$database->execute();
    }

    /**
     * Liste d'ami d'un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function listeAmis ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT courriel, motPasse, nom, prenom, idStatut, ville, province, pays, dateCreation 
          FROM Ami JOIN  Utilisateur ON courriel=courrielAmi WHERE courrielUtil='$courriel'");
        return self::$database->liste("Utilisateur");
    }

    /**
     * Desinscription d'un utilisateur
     *
     * @param $user_mail
     */
    public static function desinscription ($user_mail) {
        self::initialiserDB();
        self::$database->query("DELETE FROM Utilisateur WHERE Utilisateur.courriel = '$user_mail'");
        self::$database->execute();
    }

    /**
     * Trouver le statut d'un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function find_user_status ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Utilisateur JOIN statut ON Utilisateur.idStatut = statut.id WHERE courriel='$courriel'");
        return self::$database->rangee("Utilisateur");
    }

    /**
     * Demande d'ami
     *
     * @param $user_mail
     * @param $user_ami
     */
    public static function demande_ami ($user_mail,$user_ami) {
        self::initialiserDB();
        self::$database->query("INSERT INTO demandeami (courrielUtil, courrielAmi, statut, dateCreation)
                                VALUES 
                                ( :user_mail, :user_ami, 'a', CURRENT_TIMESTAMP);");
        self::$database->bind(':user_mail', $user_mail);
        self::$database->bind(':user_ami', $user_ami);
        self::$database->execute();
    }

    /**
     * Effacer un ami d'un utilisateur
     *
     * @param $user1
     * @param $user2
     */
    public static function retire_ami ($user1,$user2) {
        self::initialiserDB();
        self::$database->query("DELETE FROM ami                                
                                WHERE  (courrielUtil = :user1 AND courrielAmi = :user2) OR (courrielUtil = :user2 AND courrielAmi = :user1)");
        self::$database->bind(':user1', $user1);
        self::$database->bind(':user2', $user2);
        self::$database->execute();
    }

    /**
     * Demandes d'ami d'un utilisateur
     *
     * @return mixed
     */
    public static function all_demande () {
        self::initialiserDB();
        self::$database->query("SELECT courrielUtil, courrielAmi from demandeami WHERE statut = 'a'");
        return self::$database->liste("Utilisateur");
    }

    /**
     * Demandes recu pour un utilisateur
     *
     * @param $user_ami
     * @return mixed
     */
    public static function demande_recu ($user_ami) {
        self::initialiserDB();
        self::$database->query("SELECT courrielUtil, courrielAmi from demandeami WHERE statut = 'a' AND courrielAmi = '$user_ami'");
        return self::$database->liste("Utilisateur");
    }

    /**
     * Lorsqu'une demande d'ami est acceptee
     *
     * @param $user1
     * @param $user2
     */
    public static function accepte_demande ($user1,$user2) {
        self::initialiserDB();
        self::$database->query("UPDATE demandeami
                                SET statut = 'c'
                                WHERE (courrielUtil = :user1 AND courrielAmi = :user2) OR (courrielUtil = :user2 AND courrielAmi = :user1)");
        self::$database->bind(':user1', $user1);
        self::$database->bind(':user2', $user2);
        self::$database->execute();
    }

    /**
     * Ajout d'un ami
     *
     * @param $user1
     * @param $user2
     */
    public static function ajouter_ami ($user1,$user2) {
        self::initialiserDB();
        self::$database->query("INSERT INTO ami (courrielUtil, courrielAmi)                               
                                VALUES  (:user1 , :user2),
                                        (:user2 ,:user1)");
        self::$database->bind(':user1', $user1);
        self::$database->bind(':user2', $user2);
        self::$database->execute();
    }

    /**
     * Refus d'une demande d'ami
     *
     * @param $user1
     * @param $user2
     */
    public static function refuse_demande ($user1,$user2) {
        self::initialiserDB();
        self::$database->query("DELETE FROM demandeami                                
                                WHERE (statut = 'a' AND (courrielUtil = :user1 AND courrielAmi = :user2) OR (courrielUtil = :user2 AND courrielAmi = :user1))");
        self::$database->bind(':user1', $user1);
        self::$database->bind(':user2', $user2);
        self::$database->execute();
    }

    /**
     * Retirer une demande d'ami
     *
     * @param $user1
     * @param $user2
     */
    public static function retirer_demande ($user1,$user2) {
        self::initialiserDB();
        self::$database->query("DELETE FROM demandeami                                
                                WHERE (statut = 'c' AND (courrielUtil = :user1 AND courrielAmi = :user2) OR (courrielUtil = :user2 AND courrielAmi = :user1))");
        self::$database->bind(':user1', $user1);
        self::$database->bind(':user2', $user2);
        self::$database->execute();
    }


}