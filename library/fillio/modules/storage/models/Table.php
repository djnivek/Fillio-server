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
     * @param $classname
     */
    function __construct($classname)
    {
        $this->_classname = $classname;
    }

    /**
     * @param $name Définir le nom de la table
     */
    function setName($name) {
        $this->_name = $name;
    }

    /**
     * @param $primaryKeyField Définir le nom du champs de la clé primaire
     */
    function setPrimaryKeyField($primaryKeyField) {
        $this->$_primaryKeyField = $primaryKeyField;
    }

    /**
     * @param string $id Identifiant primaire de l'objet
     * @return mixed Objet de la table
     */
    public function getObject($id = null) {
        $request = $this->selectRequest()." WHERE ".$this->_primaryKeyField. " = $id";
        $object = Fillio_Storage_Database::getInstance("main")->getDb()->exec($request);
        return $object;
    }

    /**
     * @return string Introduction d'une requête pour la table
     */
    private function selectRequest() {
        return "SELECT * FROM ".$this->_name." ";
    }

}