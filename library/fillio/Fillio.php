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
     * Démarre l'application et renvoi l'instance
     *  --------------
     * L'autoload est inséré dans cette méthode
     *
     * Les libraries de base sont chargées ici
     *  --------------
     * @return Fillio_ServerLogic_Application
     */
    public static function start() {

        // Intercepte les fatals erreurs de chargement
        // Charge la classe appropriée
        // Si impossible alors on lève une exception
        spl_autoload_register(function ($class) {
            require_once 'fillio/modules/server-logic/models/ModelLoader.php';
            Fillio_ServerLogic_ModelLoader::loadModel($class);
            if (!class_exists($class))
                throw new Exception("Impossible de charger la classe $class");
        });

        require 'fillio/modules/server-logic/models/Library.php';
        Fillio_ServerLogic_Library::loadLibrary("fillio", "server-logic");
        Fillio_ServerLogic_Library::loadLibrary("fillio", "route", "route");
        Fillio_ServerLogic_Library::loadLibrary("fillio", "storage");
        Fillio_ServerLogic_Library::loadLibrary("fillio", "api");
        return Fillio_ServerLogic_Application::getInstance();
    }
    
}
