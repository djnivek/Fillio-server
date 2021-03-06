<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_FrontController {

    protected $_module;
    protected $_controller;
    protected $_action;

    /**
     * @var Fillio_ServerLogic_Action Controller
     */
    protected $controller;

    public function __construct() {

    }

    /**
     * Execute le controlleur
     * @return mixed Retourne la vue
     */
    public function execute() {
        $this->loadFiles();
        $this->dispatch();
        if ($this->controller->isRenderViewEnabled())
            return $this->controller->getView();
        else
            return json_encode($this->controller->getResponse());
    }

    protected function getControllerName() {
        $controllerName = null;
        if (!is_null($this->_module) && $this->_module != "default") {
            $controllerName .= "Module_" . ucfirst($this->_module) . "_";
        }
        $controllerName .= ucfirst($this->_controller) . "Controller";
        return $controllerName;
    }

    protected function dispatch()
    {
        $controllerName = $this->getControllerName();

        if (class_exists($controllerName)) {

            /*
             * Attribution du controller
             */
            $this->controller = new $controllerName();
            // Set module pour le tracking
            $this->controller->_setModule($this->_module);
            // Set controller pour le tracking
            $this->controller->_setController($this->_controller);
            // Set action pour le tracking
            $this->controller->_setAction($this->_action);

            /*
             * Appel de l'action
             */
            $method = $this->_action . 'Action';
            if (method_exists($this->controller, $method)) {
                $this->controller->$method();
            } else {
                throw new Fillio_ServerLogic_Exception("L'action demandée ($this->_module/$controllerName/$method) n'existe pas !");
            }
        } else {
            throw new Fillio_ServerLogic_Exception("Le controlleur demandé ($this->_module/$controllerName) n'existe pas !");
        }
    }

    protected function loadFiles() {
        $controllerPath = APPLICATION_PATH;

        Fillio_ServerLogic_Loader_Abstract::loadDirectoryPath($controllerPath."models");

        // * /!\ * Si le module est à default, on ne va pas dans l'arborescence puisque le default est à la racine
        if (!is_null($this->_module) && $this->_module != "default") {
            $controllerPath .= "modules/$this->_module/";
            Fillio_ServerLogic_Loader_Abstract::loadDirectoryPath($controllerPath."models");
        }

        $controllerPath .= "controllers/" . ucfirst($this->_controller) . "Controller.php";

        if (!file_exists($controllerPath)) {
            $this->_module = null;
            $this->_controller = 'error';
            $this->_action = 'index';
            $this->loadFiles();
        } else
            require_once($controllerPath);
    }

    public function setModule($module) {
        $this->_module = $module;
    }

    public function setController($controller) {
        $this->_controller = $controller;
    }

    public function setAction($action) {
        $this->_action = $action;
    }

}
