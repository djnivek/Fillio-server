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

    /**
     * @var string Host de la database (e.g 127.0.0.1)
     */
    private $_host;
    /**
     * @var integer Port de la database (e.g 8889)
     */
    private $_port;
    /**
     * @var string Nom de l'utilisateur de la database
     */
    private $_username;
    /**
     * @var string Mot de passe de l'utilisateur de la database
     */
    private $_password;
    /**
     * @var string Nom de la database
     */
    private $_databaseName;

    /**
     * @var PDO Instance de la DB
     */
    private $_db;

    /**
     * @var array Tableau d'instance de database
     */
    private static $_instance;

    /**
     *
     */
    private function __construct() {
        
    }

    /**
     * @param $host
     * @param $port
     * @param $dbName
     * @param $username
     * @param $password
     */
    public function setCredential($host, $port, $dbName, $username, $password) {
        $this->_host = $host;
        $this->_port = $port;
        $this->_username = $username;
        $this->_password = $password;
        $this->_databaseName = $dbName;
        $this->connection();
    }

    /**
     * @param string $identifier
     * @return Fillio_Storage_Database Instance de la database
     */
    public static function getInstance($identifier) {
        if (is_null(self::$_instance[$identifier])) {
            self::$_instance[$identifier] = new Fillio_Storage_Database();
        }
        return self::$_instance[$identifier];
    }

    public function getDb() {
        return $this->_db;
    }

    /**
     * Permet de se connecter à la database
     * @throws Exception PDO
     */
    private function connection() {
        $dsn = "mysql:host=$this->_host" . (strlen($this->_port) ? ";$this->_port" : "") . ";dbname=$this->_databaseName";
        $this->_db = new PDO($dsn, $this->_username, $this->_password);
    }

}
