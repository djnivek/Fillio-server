<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/storage/models/ObjectAbstract.php';

/**
 * Description of Fillio_Storage_Object
 *
 * @author kevinmachado
 */
class Fillio_Storage_Object extends Fillio_Storage_Object_Abstract {

    private $fields;

    public function addField($key, $value) {
        $this->fields[$key] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->fields))
            return $this->fields[$name];
        else
            return null;
    }

    public function getFields()
    {
        return $this->fields;
    }


}
