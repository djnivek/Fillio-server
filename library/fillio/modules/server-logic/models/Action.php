<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Action
 *
 * @author kevinmachado
 */
abstract class Fillio_ServerLogic_Action {

    /**
     * @var Fillio_ServerLogic_View
     */
    protected $view;

    /**
     * @var Fillio_ServerLogic_Request
     */
    private $_request;

    /**
     * @var Fillio_ServerLogic_Response 
     */
    protected $response;
    
    /**
     * @var bool Rendu en mode vue choisi ?
     */
    private $_isSetRenderViewMode;

    /**
     * 
     * On garde les donn�es du module et controller
     * Afin de pouvoir les utilis�s dans les prochaines sous-vues
     * 
     */
    private $_module;
    private $_controller;

    abstract protected function _requiredLibrary();

    protected function init() {
        /* This method should be overrided  */
    }

    public function __construct() {
        $this->view = new Fillio_ServerLogic_View();
        $this->_request = Fillio_ServerLogic_Request::getInstance();
        $this->response = new Fillio_ServerLogic_Response();
        $this->_isSetRenderViewMode = false;
        $this->_requiredLibrary();
        $this->init();
    }

    /**
     * Permet d'obtenir les paramètres de la requête (POST & GET)
     * 
     * @see Fillio_ServerLogic_Request->getParam()
     * 
     * @param string $key Clé
     * @return mixed|null Retourne la valeur ou null la clé n'existe pas
     */
    protected function getParam($key) {
        return $this->getRequest()->getParam($key);
    }

    /**
     * Permet d'obtenir les paramètres de l'URL
     *
     * @see Fillio_ServerLogic_Request->getUrlParam()
     *
     * @param string $key Clé
     * @return mixed|null Retourne la valeur ou null la clé n'existe pas
     */
    protected function getUrlParam($key) {
        return $this->getRequest()->getUrlParam($key);
    }

    /**
     * @return Fillio_ServerLogic_Request
     */
    private function getRequest() {
        return $this->_request;
    }

    public function setLibrary($name = null, $module = null, $controller = null) {
        Fillio_ServerLogic_Library::loadLibrary($name, $module, $controller);
    }

    /**
     * @return mixed
     */
    public function getView() {
        return $this->view->getView();
    }
    
    public function setRenderView($enable = false) {
        $this->_isSetRenderViewMode = $enable;
    }
    
    /**
     * @return bool
     */
    public function isRenderViewEnabled() {
        return $this->_isSetRenderViewMode;
    }
    
    /**
     * @return array
     */
    public function getResponse() {
        return $this->response->toString();
    }

    /*private function setLibraryRequired($arrayLibs) {
        foreach ($arrayLibs as $libName) {
            Fillio_ServerLogic_Library::load($libName);
        }
    }*/

    public function _setModule($module) {
        $this->_module = $module;
        $this->view->setModule($module);
    }

    public function _setController($controller) {
        $this->_controller = $controller;
        $this->view->setController($controller);
    }

    public function _setAction($action) {
        $this->view->setAction($action);
    }

    protected function render($viewName, $dataArray) {
        $view = new Fillio_ServerLogic_View();
        foreach ($dataArray as $key => $value) {
            $view->$key = $value;
        }
        $view->setModule($this->_module);
        $view->setController($this->_controller);
        $view->setAction($viewName);
        return $view->getView();
    }

}
