<?php

class Evaluation {
    static $database;

    public static function initialiserDB () {
        self::$database = new Database();
    }

    public static function all () {
        self::initialiserDB();
        self::$database->query('SELECT * from Evaluation');
        return self::$database->liste("Evaluation");
    }

    public static function find ($courriel) {
        self::initialiserDB();
        self::$database->query("SELECT * from Evaluation WHERE courriel='$courriel'");
        return self::$database->rangee("Evaluation");
    }
}