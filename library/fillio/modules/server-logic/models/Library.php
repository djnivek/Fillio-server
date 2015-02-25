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
            Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath(), true);
        } else if (!is_null($this->_name)) {
            // charger toute la librairie donnée
            Fillio_ServerLogic_LibLoader::loadDirectory($this->getPath(), true);
        } else {
            return false;
        }
    }

    private function getPath() {
        //
        //$libraryName = "Library_";
        //$libraryName .= ucfirst(strtolower($this->_name)) . "_";
        //$libraryName .= ucfirst(strtolower($this->_module)) . "_";
        //$libraryName .= ucfirst(strtolower($this->_controller));
        //
        // chargement des fichiers

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

    /**
     * @param string $libName
     * @return mixed Instance du module
     */
    /* public static function getLibrary($libName) {
      $libNameLower = strtolower($libName);

      // cr�ation de l'instance de librarie
      if (is_null(self::$instance[$libNameLower]))
      $library = self::$instance[$libNameLower] = new Library($libNameLower);

      // attribution du nom
      $library->name = $libName;

      //$module

      return $library->module;
      } */



    function setName($name) {
        $this->_name = $name;
    }

    function setModule($module) {
        $this->_module = $module;
    }

    function setController($controller) {
        $this->_controller = $controller;
    }

    /**
     * Retourne le controller portant le m?me nom celui de la librairie
     * @return mixed retourne le controller de la librarie
     */
    /* public function theController() {
      $controller = $this->name . "Controller";
      require_once $_SERVER['DOCUMENT_ROOT'] . "/library/fillio/modules/$this->name/controller/$controller";
      if (!$this->theController)
      $this->theController = new $controller();
      return $this->theController;
      } */

    /* private function call($action) {
      $actionLower = strtolower($action);
      $actionName = $actionLower . "Action";
      return $this->theController->$actionName();
      } */

    /**
     * Execute le script principal de la librairie
     * Le fichier index.php ? la racine de la librarie
     */
    /* public function execute() {
      require $_SERVER['DOCUMENT_ROOT'] . "/library/fillio/modules/$this->name/index.php";
      } */
}
