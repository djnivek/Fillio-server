<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bootstrap
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Library {

    /**
     * @var array Tableau de librairies
     */
    private static $_instance;

    /**
     * @var string Nom de la librarie appel�e
     */
    private $_name;

    /**
     * @var string Nom du module
     */
    private $_module;

    /**
     * @var string Nom du controller
     */
    private $_controller;

    private function __construct() {
        $this->_name = null;
        $this->_module = null;
        $this->_controller = null;
    }

    /**
     * @return Fillio_ServerLogic_Library
     */
    private static function _getInstance() {
        if (is_null(self::$_instance))
            self::$_instance = new Fillio_ServerLogic_Library();
        return self::$_instance;
    }

    public static function loadLibrary($name = null, $module = null, $controller = null) {

        /*spl_autoload_register(function ($class) {
            echo "--->  spl_autoload_register $class";
            require_once 'fillio/modules/server-logic/models/ModelLoader_Library.php';
            Fillio_ServerLogic_ModelLoader_Library::loadModel($class);
            if (!class_exists($class))
                throw new Exception("Impossible de charger la classe $class");
        });*/

        self::_getInstance()->_name = $name;
        self::_getInstance()->_module = $module;
        self::_getInstance()->_controller = $controller;
        self::_getInstance()->loadFiles();
    }

    private function loadFiles() {
        require_once 'fillio/modules/server-logic/models/LibLoader.php';
        if (!is_null($this->_name) && !is_null($this->_module) && !is_null($this->_controller)) {
            // charger le controller pour le module de la librarie donnée
            Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath() . "/models", true);
            Fillio_ServerLogic_LibLoader::loadFile($this->getPath() . "/controllers", $this->getFilename());
        } else if (!is_null($this->_name) && !is_null($this->_module)) {
            // charger le module de la librarie donnée
            //  chargement prioritaire pour les models
            Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath() . "/models", true);
            //  chargement des controllers
            Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath() . "/controllers", true);
        } else if (!is_null($this->_name)) {
            // charger toute la librairie donnée (tout les modules)
            /**
             * Cette action est impossible car le chargement ne se ferait pas dans l'ordre (model puis controller) du coup un problème
             * surviendrait puisque l'utilisateur le compilateur aurait des entitées non chargées.
             *
             * Il faut donc réaliser un auto-loader pour librairie ou bien un chargement par prioritée
             */
            throw new Fillio_ServerLogic_Exception("Il est pour l'instant impossible d'effectuer cette action, voir commentaire");
            //Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath(), true);
        } else {
            return false;
        }
    }

    private function getPath() {
        $libraryPath = APPLICATION_PATH . "../library";

        if (!is_null($this->_name)) {
            $libraryPath .= "/" . strtolower($this->_name);
        }

        if (!is_null($this->_module)) {
            $libraryPath .= "/modules/" . strtolower($this->_module);
        }

        return $libraryPath;
    }

    private function getFilename() {
        if (!is_null($this->_controller)) {
            return ucfirst(strtolower($this->_controller)) . "Controller.php";
        } else
            return null;
    }

    function setName($name) {
        $this->_name = $name;
    }

    function setModule($module) {
        $this->_module = $module;
    }

    function setController($controller) {
        $this->_controller = $controller;
    }
}
