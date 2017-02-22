<?php

class Publication {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Publication');
        return self::$database->liste("Publication");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Publication WHERE courrielUtil='$courriel'");
        return self::$database->rangee("Publication");
    }
}