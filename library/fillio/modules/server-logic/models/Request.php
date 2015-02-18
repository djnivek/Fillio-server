<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Request {

    /**
     * @var array Tableau des paramètres demandés
     */
    private $_params;

    /**
     * @var string Url redirect
     */
    private $_url;

    /**
     * @var array Tableau de paramètres additionnels
     * /index/user/12
     * On récupère ici le 12
     */
    private $additionnalParams;

    /**
     * @var bool Vrai si l'utilisateur utilise une fonction du FrontApiController
     */
    private $flag_api;
    
    private static $_request;

    /**
     * @return Fillio_ServerLogic_Request Instance d'objet - Singleton
     */
    public static function getInstance() {
        if (is_null(self::$_request))
            self::$_request = new Fillio_ServerLogic_Request();
        return self::$_request;
    }

    private function __construct() {
        $this->_url = (strlen($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : null);
        $this->_params = array();
        $this->rewriteUrlWithRoute();
    }
    
    private function rewriteUrlWithRoute() {
        if (!is_null($this->_url))
            $this->_url = Fillio_ServerLogic_Route::rewriteUrl($this->_url);
    }

    function getUrl() {
        $instance = self::getInstance();
        return $instance->_url;
    }

    /**
     * R�cup?re les param?tres de la requ?te
     * 
     * Les param?tres sont ceux de $_REQUEST ainsi que ceux ajouter via
     * setParam() & setParams()
     * 
     * @param string $key Cl� de l'attribut souhait�
     * @return mixed|null Retourne la valeur ou null si la valeur n'existe pas
     */
    function getParam($key) {
        $instance = self::getInstance();
        $value = null;
        if (filter_input(INPUT_REQUEST, $key) !== null) {
            $value = filter_input(INPUT_REQUEST, $key);
        } else if (key_exists($key, $instance->_params)) {
            $value = $instance->_params[$key];
        }
        return $value;
    }

    function setParam($key, $value) {
        $instance = self::getInstance();
        if (!key_exists($key, $this->_params))
            $instance->_params[$key] = $value;
    }

    function setParams($params) {
        $instance = self::getInstance();
        foreach ($params as $key => $value) {
            if (!key_exists($key, $this->_params))
                $instance->_params[$key] = $value;
        }
    }

    private function setAdditionnalParams() {
        // comment savoir o? commence les additionnals params (dans le cas d'un module et dans le cas d'un non module ?)
        // utiliser les routes ?
        //$this->additionnalParams
        //explode("/", $this->_url)
    }

    public function getAdditionnalParams() {
        
    }

    /**
     * @return Fillio_ServerLogic_Dispatcher Module/Controller/Action demand�
     */
    public function getDispatcher() {
        $uri_params = array_filter(explode("/", ltrim($this->_url, "/")));
        return new Fillio_ServerLogic_Dispatcher($uri_params);
    }

}
