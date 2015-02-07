<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author kevinmachado
 */
class Fillio_Storage_Database {

    private $_host;
    private $_port;
    private $_username;
    private $_password;
    private $_databaseName;

    /**
     * @var array Tableau d'instance de database
     */
    private static $_instance;

    private function __construct() {
        
    }

    public function setCredential($host, $port, $dbName, $username, $password) {
        $this->_host = $host;
        $this->_port = $port;
        $this->_username = $username;
        $this->_password = $password;
        $this->_databaseName = $dbName;
        $this->connection();
    }

    /**
     * @param type $identifier
     * @return Fillio_Storage_Database Instance de la database
     */
    public static function getInstance($identifier) {
        if (is_null(self::$_instance[$identifier])) {
            self::$_instance[$identifier] = new Fillio_Storage_Database();
        }
        return self::$_instance[$identifier];
    }

    /**
     * Permet de se connecter à la database
     * @throws Exception PDO
     */
    private function connection() {
        $dsn = "mysql:host=$this->_host" . (strlen($this->_port) ? ":$this->_port" : "") . ";dbname=$this->_databaseName";
        self::$db = new PDO($dsn, $this->_username, $this->_password);
    }

}
