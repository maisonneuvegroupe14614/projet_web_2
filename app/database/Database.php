<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 9:11 PM
 */

class Database {
    private $db;
    private $instruction;
    public function __construct() {
        try {
            $this->db= new PDO('mysql:host=' . dbHost . ';dbname=' . dbName, username, password,
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8")

            );
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'Num : ' . $e->getCode();
            $erreur = true;
        }
    }

    public function query($requete) {
        $this->instruction = $this->db->prepare($requete);
    }

    /**
     * @brief  Fonction pour lier les paramètres de la requête aux valeurs
     *
     * @param string $param est le marqueur qui sera utiisé dans la requête SQL.
     * @param string $value est la valeur que l'on veut attribuer au paramètre (marqueur)
     * @param string $type est le type du paramètre, exemple string.
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->instruction->bindValue($param, $value, $type);
    }

    /**
     * @brief Méthode qui  exécute la requête préparée.
     *
     */
    public function execute() {
        return $this->instruction->execute();
    }

    /**
     * @brief  La méthode uneLigne retourne une enregistrement.
     * @return array une ligne de resultat de la requête
     */
    public function rangee($nomObjet) {
        $this->execute();
        $this->instruction->setFetchMode(PDO::FETCH_CLASS, $nomObjet);
        return $this->instruction->fetch();
    }

    /**
     * @brief  La méthode uneLigne retourne une enregistrement.
     * @return array une ligne de resultat de la requête
     */
    public function liste($nomObjet) {
        $this->execute();
        return $this->instruction->fetchAll(PDO::FETCH_CLASS,$nomObjet);
    }

    /**
     * @brief nbLignes retourne le nombre de lignes affectées par delete, update ou insert.
     * @return integer  nombre de lignes affectées
     */
    public function nbLignes() {
        return $this->instruction->rowCount();
    }

    /**
     * @brief nbLignes retourne l'ID du dernier enregistrement inséré.
     * @return integer id du dernier enregistrement
     */
    public function dernierId() {
        return $this->db->lastInsertId();
    }

}