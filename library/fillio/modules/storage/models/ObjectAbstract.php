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
     * @var string Nom de l'entité dans la base de données
     */
    protected $_name;

    /**
     * @var string Identifiant du champs primaire pour l'entitée
     */
    protected $_primaryKeyField;

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
        $this->table = new Fillio_Storage_Table();
        if (!is_null($id)) {
            $this->_id = $id;
            $this->load();
        }
    }

    private function load() {
        $this->table->getObject();
    }

    private function save() {
        
    }

}
