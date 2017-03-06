<?php

class PubliDetail {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function find ($id) {
        self::initialiserDB();
        self::$database->query("SELECT * FROM Publication WHERE id='$id'");

        return self::$database->liste("publiDetail");
    }
}