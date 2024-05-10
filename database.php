<?php 
class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            $config = require 'config.php';
            self::$instance = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']);
        }
        return self::$instance;
    }
}
?>