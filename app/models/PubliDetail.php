<?php

/**
 * Class PubliDetail
 */
class PubliDetail {
    static $database;

    /**
     * Initialiser la BD
     */
    public static function initialiserDB () {
        self::$database = new Database();
    }

    /**
     * Trouver les details d'une pub
     *
     * @param $id
     * @return mixed
     */
    public static function find ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * FROM Publication WHERE id='$id'");

        return self::$database->liste("publiDetail");
    }
}