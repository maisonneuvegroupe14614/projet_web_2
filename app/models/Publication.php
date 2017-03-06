<?php

class Publication {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication ORDER BY id DESC');
        return self::$database->liste("Publication");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielUtil='$courriel' ORDER BY id DESC");
        return self::$database->liste("Publication");
    }

    public static function enregistrer ($idCategorie,$titre,$texte,$url,$courrielUtil) {
        self::initialiserDB();
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

    public static function allQuiz () {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3");
        return self::$database->liste("Publication");
    }

    public static function findQuiz ($id) {
        self::initialiserDB();
        self::$database->query("SELECT id,titre from Publication WHERE idCategorie=3 AND id='$id'");
        return self::$database->liste("Publication");
    }

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



    public static function find_etudiant_tutorats ($courriel) {
        self::initialiserDB();
        /*SELECT * from publication JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel JOIN ami ON publication.courrielUtil = ami.courrielUtil WHERE ami.courrielAmi='gilles@hotmail.com' AND publication.destinataire = 'amis'*/
        self::$database->query("SELECT * from publication  
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel
                JOIN ami ON publication.courrielUtil = ami.courrielUtil
                WHERE ami.courrielAmi='$courriel' 
                AND publication.idCategorie = 1 or 
                ( publication.destinataire='public' AND publication.idCategorie = 1)group by publication.id "
        );
        return self::$database->liste("Publication");
    }

    public static function find_etudiant_astuces ($courriel) {
        self::initialiserDB();
        /*SELECT * from publication JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel JOIN ami ON publication.courrielUtil = ami.courrielUtil WHERE ami.courrielAmi='gilles@hotmail.com' AND publication.destinataire = 'amis'*/
        self::$database->query("SELECT * from publication  
                JOIN utilisateur ON publication.courrielUtil = utilisateur.courriel
                JOIN ami ON publication.courrielUtil = ami.courrielUtil
                WHERE (ami.courrielAmi='$courriel' AND publication.idCategorie = 2) or 
                ( publication.destinataire='public' AND publication.idCategorie = 2) group by publication.id");
        return self::$database->liste("Publication");
    }

    public static function list_tutorat () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication where idCategorie = 1');
        return self::$database->liste("Publication");
    }
}