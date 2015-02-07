<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/server-logic/models/Application_Abstract.php';

/**
 * Description of AppDelegate
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Application extends Fillio_ServerLogic_Application_Abstract {

    /**
     * @var array Constante de l'application accessible partout
     */
    private $_constant;

    public function getConstant($key) {
        if (!isset($this->_constant) || !is_array($this->_constant))
            $this->_constant = array();
        return $this->_constant[$key];
    }

    public function addConstant($key, $value) {
        $this->_constant[$key] = $value;
    }
    
    public static function addRoute($from, $to) {
        Fillio_ServerLogic_Route::addRoute($from, $to);
    }

}
