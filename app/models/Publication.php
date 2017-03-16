<?php

/**
 * Class Publication
 */
class Publication {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Trouver toutes les publications
     *
     * @return mixed
     */
    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication ORDER BY id DESC');
        return self::$database->liste("Publication");
    }

    /**
     * Trouver une publication
     *
     * @param $courriel
     * @return mixed
     */
    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielAmi='$courriel' ORDER BY id DESC");
        return self::$database->liste("Publication");
    }

    /**
     * Trouver un type de publication
     *
     * @param $courriel
     * @param $type
     * @return mixed
     */
    public static function findType ($courriel,$type) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielAmi='$courriel' AND idCategorie='$type' ORDER BY id DESC");
        return self::$database->liste("Publication");
    }

    /**
     * Enregistrer une publication dans la BD
     *
     * @param $idCategorie
     * @param $titre
     * @param $texte
     * @param null $url
     * @param $courrielUtil
     * @param null $courrielAmi
     */
    public static function enregistrer ($idCategorie,$titre,$texte,$url=null,$courrielUtil, $courrielAmi=null) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO Publication (idCategorie, titre, texte, url, courrielUtil, courrielAmi)
          values (:idCategorie, :titre, :texte, :url, :courrielUtil, :courrielAmi)");
        self::$database->bind(':idCategorie', $idCategorie);
        self::$database->bind(':titre', $titre);
        self::$database->bind(':texte', $texte);
        self::$database->bind(':url', $url);
        self::$database->bind(':courrielUtil', $courrielUtil);
        self::$database->bind(':courrielAmi', $courrielAmi);
        self::$database->execute();
    }

    /**
     * Trouver la derniere pub inserer dans la BD
     *
     * @return mixed
     */
    public static function dernier () {
        self:self::initialiserDB();
        return self::$database->dernierId();
    }

    /**
     * Trouver tous les quiz
     *
     * @return mixed
     */
    public static function allQuiz () {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3");
        return self::$database->liste("Publication");
    }

    /**
     * Trouver un quiz par Id
     *
     * @param $id
     * @return mixed
     */
    public static function findQuiz ($id) {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3 AND id='$id'");
        return self::$database->liste("Publication");
    }

    /**
     * Trouver les quiz creer par un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function findQuizByUser ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT id,titre,dateCreation from Publication  WHERE idCategorie=3 AND courrielUtil='$courriel'");
        return self::$database->liste("Publication");
    }

    /**
     * Trouver les publications d'un ami
     *
     * @param $courriel
     * @return mixed
     */
    public static function find_all_publication_amis ($courriel) {
        self::initialiserDB();
        /*SELECT * from publication JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel JOIN ami ON publication.courrielUtil = ami.courrielUtil WHERE ami.courrielAmi='gilles@hotmail.com' AND publication.destinataire = 'amis'*/
        self::$database->query("SELECT distinct * from publication 
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel 
                JOIN ami ON publication.courrielUtil = ami.courrielUtil 
                WHERE (ami.courrielAmi='$courriel' 
                and publication.destinataire='amis') or
                ( publication.destinataire='public') 
                group by publication.id" );
        return self::$database->liste("Publication");
    }

    /**
     * Trouver les tutorats d'un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function find_etudiant_tutorats ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from publication  
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel
                JOIN ami ON publication.courrielUtil = ami.courrielUtil
                WHERE ami.courrielAmi='$courriel' 
                AND publication.idCategorie = 1 or 
                ( publication.idCategorie = 1)group by publication.id DESC "
        );
        return self::$database->liste("Publication");
    }

    /**
     * Trouver les messages d'un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function find_etudiant_messages ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from publication  
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel
                JOIN ami ON publication.courrielUtil = ami.courrielUtil
                WHERE ami.courrielAmi='$courriel' 
                AND publication.idCategorie = 4 or 
                ( publication.idCategorie = 4)group by publication.id DESC "
        );
        return self::$database->liste("Publication");
    }

    /**
     * Trouver les astuces d'un utilisateur
     *
     * @param $courriel
     * @return mixed
     */
    public static function find_etudiant_astuces ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from publication  
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel
                JOIN ami ON publication.courrielUtil = ami.courrielUtil
                WHERE ami.courrielAmi='$courriel' 
                AND publication.idCategorie = 2 or 
                ( publication.idCategorie = 2)group by publication.id DESC "
        );
        return self::$database->liste("Publication");
    }

    /**
     * Liste de tutorats
     *
     * @return mixed
     */
    public static function list_tutorat () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication where idCategorie = 1');
        return self::$database->liste("Publication");
    }

    /**
     * Lorsqu'un utilisateur complete un quiz
     *
     * @param $courrielUtil
     * @param $idQuiz
     * @param $note
     */
    public static function quizFait ($courrielUtil,$idQuiz,$note) {
        self::initialiserDB();
        self::$database->query(" INSERT INTO QuizFait (courrielUtil, idQuiz, note)
          values (:courrielUtil, :idQuiz, :note)");
        self::$database->bind(':courrielUtil', $courrielUtil);
        self::$database->bind(':idQuiz', $idQuiz);
        self::$database->bind(':note', $note);
        self::$database->execute();
    }

    /**
     * Effacer une publication
     *
     * @param $id
     */
    public static function effacer ($id) {
        self::initialiserDB();
        self::$database->query(" DELETE FROM Publication WHERE id='$id'");
        self::$database->execute();
    }
}