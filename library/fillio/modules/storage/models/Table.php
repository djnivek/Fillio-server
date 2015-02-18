<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Table de la base de données
 *
 * @author kevinmachado
 */
class Fillio_Storage_Table {

    /**
     * @var Nom de la table
     */
    private $_name;

    /**
     * @var Nom du champs clé primaire
     */
    private $_primaryKeyField;

    /**
     * @var Nom de la classe
     */
    private $_classname;

    /**
     * @param $classname string Nom de la classe appelante
     * @param $tablename string Nom de la table
     */
    function __construct($classname, $tablename)
    {
        $this->_classname = $classname;
        $this->_name = $tablename;
    }

    /**
     * @param $name Définir le nom de la table
     */
    /*function setName($name) {
        $this->_name = $name;
    }*/

    /**
     * @param $primaryKeyField Définir le nom du champs de la clé primaire
     */
    /*function setPrimaryKeyField($primaryKeyField) {
        $this->$_primaryKeyField = $primaryKeyField;
    }*/

    /**
     * @param string $id Identifiant primaire de l'objet
     * @return mixed Objet de la table
     */
    public function getObject($id = null) {
        $request = $this->selectRequest()." WHERE ".$this->_primaryKeyField. " = $id";
        return $this->executeQuery($request);
    }

    /**
     * @param $classname string Nom de la classe appelante
     * @return array Retourne un tableau d'objet
     */
    /*public static function getAll($classname) {
        $instance = new Fillio_Storage_Table($classname);
        return $instance->getObjects();
    }*/

    /**
     * @return array Retourne un tableau
     */
    public function getAll() {
        $request = $this->selectRequest()." WHERE 1";
        return $this->executeQuery($request);
    }

    /**
     * @return string Introduction d'une requête pour la table
     */
    private function selectRequest() {
        return "SELECT * FROM ".$this->_name." ";
    }

    /**
     * @param $query string Paramètre de la requête à executer
     * @return mixed|null Résultat retourné par la requête
     * @throws Fillio_ServerLogic_Exception
     */
    private function executeQuery($query) {
        $statement = Fillio_Storage_Database::getInstance("main")->getDb()->query($query, PDO::FETCH_ASSOC);
        if ($statement === false) {
            throw new Fillio_ServerLogic_Exception("Erreur pendant la requête '$query''");
        } else {
            return $statement->fetchAll();
        }


    }

}