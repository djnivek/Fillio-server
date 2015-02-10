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

    private $_module;
    private $_controller;
    private $_action;

    /**
     * @var Fillio_ServerLogic_Action Controller
     */
    private $controller;

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

    private function dispatch() {
        $controllerName = null;
        if (!is_null($this->_module)) {
            $controllerName .= "Module_" . ucfirst($this->_module) . "_";
        }
        $controllerName .= ucfirst($this->_controller) . "Controller";

        if (class_exists($controllerName)) {

            /*
             * Attribution du controller
             */
            $this->controller = new $controllerName();
            // Set module pour le tracking
            $this->controller->setModule($this->_module);
            // Set controller pour le tracking
            $this->controller->setController($this->_controller);
            // Set action pour le tracking
            $this->controller->setAction($this->_action);

            /*
             * Appel de l'action
             */
            $method = $this->_action . 'Action';
            if (method_exists($this->controller, $method)) {
                $this->controller->$method();
            } else {
                throw new Fillio_ServerLogic_Exception("L'action demand�e n'existe pas !");
            }
        } else {
            throw new Fillio_ServerLogic_Exception("Le controlleur demand� n'existe pas !");
        }
    }

    private function loadFiles() {
        $controllerPath = APPLICATION_PATH;
        
        // * /!\ * Si le module est ? d�fault, on ne va pas dans l'arborescence puisque le d�fault est ? la racine
        if (!is_null($this->_module) && $this->_module != "default") {
            $controllerPath .= "modules/$this->_module/";
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
