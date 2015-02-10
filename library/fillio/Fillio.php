<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fillio
 *
 * @author kevinmachado
 */
class Fillio {
    
    /**
     * @return Fillio_ServerLogic_Application
     */
    public static function start() {
        require 'fillio/modules/server-logic/models/Library.php';
        Fillio_ServerLogic_Library::loadLibrary("fillio", "server-logic");
        Fillio_ServerLogic_Library::loadLibrary("fillio", "route", "route");
        Fillio_ServerLogic_Library::loadLibrary("fillio", "storage");
        return Fillio_ServerLogic_Application::getInstance();
    }
    
}
