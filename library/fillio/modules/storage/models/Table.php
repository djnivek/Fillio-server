<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Table
 *
 * @author kevinmachado
 */
class Fillio_Storage_Table {

    protected $_name;
    protected $_primaryKey;

    function setName($name) {
        $this->_name = $name;
    }

    function setPrimaryKey($primaryKey) {
        $this->_primaryKey = $primaryKey;
    }

    protected function getData() {
        
    }

}