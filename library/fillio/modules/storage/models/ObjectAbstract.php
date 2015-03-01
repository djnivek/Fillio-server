<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/storage/models/Table.php';

/**
 * Description of Fillio_Storage_Object_Abstract
 *
 * @author kevinmachado
 */
abstract class Fillio_Storage_Object_Abstract {

    /**
     * @var Fillio_Storage_Table
     */
    private $table;

    /**
     * @var string Identifiant de l'objet (clé primaire)
     */
    protected $_id;

    function __construct($id = null)
    {
        $class = get_called_class();
        $this->table = Fillio_Storage_Table::getInstance($class);
        if (!is_null($id)) {
            $this->_id = $id;
            $this->load();
        }
    }

    /**
     * Chargement de l'objet et insertion de ses champs
     * dans la variable $fields
     */
    protected function load() {
        $obj = $this->table->getObject($this->_id);

        foreach ($this->table->getStructure()->getFieldKeys() as $field) {
            $this->addField($field, $obj[$field]);
        }
    }

    public static function getAllObject() {
        $class = get_called_class();
        $allInArray = self::getAll();
        $objs = array();
        foreach ($allInArray as $oneInArray) {
            $obj = new $class();
            foreach ($oneInArray as $key => $val) {
                $obj->addField($key, $val);
            }
            $objs[] = $obj;
        }
        return $objs;
    }

    private static function getAndPerformToGetAll() {
        $class = get_called_class();
        $obj = new $class();
        $obj->table = Fillio_Storage_Table::getInstance($class);
        return $obj;
    }

    public static function getAll() {
        return self::getAndPerformToGetAll()->table->getAll();
    }

    public static function findAll($condition) {
        $options = array("condition" => $condition);
        return self::getAndPerformToGetAll()->table->getAll($options);
    }

    private function save() {
        
    }

    /**
     * Ajoute un élément à l'objet (un attribut clé/valeur)
     * On utilise cette méthode pour ajouter une variable propre à l'objet
     * présent dans le BDD
     * @param $key string clé de l'attribut
     * @param $value string valeur de l'attribue
     */
    abstract protected function addField($key, $value);

}
