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

    private function load() {
        $obj = $this->table->getObject($this->_id);
        $this->name = $obj["name"];
        print_r($this);die;
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

    public static function getAll() {
        $class = get_called_class();
        $obj = new $class();
        $obj->table = new Fillio_Storage_Table($class);
        return $obj->table->getAll();
    }

    private function save() {
        
    }

}
