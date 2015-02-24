<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Registry
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Registry extends ArrayObject {

    private static $_registry = null;

    /**
     * @return Fillio_ServerLogic_Registry
     */
    public static function getInstance() {
        if (self::$_registry === null) {
            self::$_registry = new Fillio_ServerLogic_Registry();
        }

        return self::$_registry;
    }

    public static function set($name, $value) {
        $instance = self::getInstance();
        $instance->offsetSet($name, $value);
    }

    public static function get($name) {
        $instance = self::getInstance();
        if (!$instance->offsetExists($name)) {
            throw new Fillio_ServerLogic_Exception("No entry is registered for key '$name'");
        }
        return $instance->offsetGet($name);
    }

}
