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
     * @var array Tableau de paramètres d'URL
     * default/index/user/12
     * On récupère ici le 12
     */
    private $_urlParams;

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
        $this->_urlParams = array();
        $this->rewriteUrlWithRoute();
    }

    /**
     * Permet de lancer la réécriture de l'url à l'aide des routes
     */
    private function rewriteUrlWithRoute() {
        if (!is_null($this->_url)) {
            $this->_url = Fillio_ServerLogic_Route::rewriteUrl($this->_url);
            $this->handleUrlParams();
        }
    }

    /**
     * Permet de récupérer les paramètres dans l'URL en suivant les intructions des routes
     */
    private function handleUrlParams() {
        $this->setUrlParams(Fillio_ServerLogic_Route::$varsFromUrl);
    }

    public static function getUrl() {
        $instance = self::getInstance();
        return $instance->_url;
    }

    /**
     * Récupère les paramètres de la requête
     * 
     * Les paramètres sont ceux de $_REQUEST ainsi que ceux ajouter via
     * setParam() & setParams()
     * 
     * @param string $key Clé de l'attribut souhaité
     * @return mixed|null Retourne la valeur ou null si la valeur n'existe pas
     */
    public static function getParam($key) {
        $instance = self::getInstance();
        $value = null;
        if (filter_input(INPUT_REQUEST, $key) !== null) {
            $value = filter_input(INPUT_REQUEST, $key);
        } else if (array_key_exists($key, $instance->_params)) {
            $value = $instance->_params[$key];
        }
        return $value;
    }

    public static function setParam($key, $value) {
        $instance = self::getInstance();
        if (!array_key_exists($key, $instance->_params))
            $instance->_params[$key] = $value;
    }

    public static function setParams($params) {
        $instance = self::getInstance();
        foreach ($params as $key => $value) {
            if (!array_key_exists($key, $instance->_params))
                $instance->_params[$key] = $value;
        }
    }

    /**
     * Récupère les paramètres de l'Url
     *
     * @param string $key Clé de l'attribut souhaité
     * @return mixed|null Retourne la valeur ou null si la valeur n'existe pas
     */
    public static function getUrlParam($key) {
        $instance = self::getInstance();
        $value = null;
        if (filter_input(INPUT_REQUEST, $key) !== null) {
            $value = filter_input(INPUT_REQUEST, $key);
        } else if (array_key_exists($key, $instance->_urlParams)) {
            $value = $instance->_urlParams[$key];
        }
        return $value;
    }

    protected function setUrlParams($params) {
        foreach ($params as $key => $value) {
            if (!array_key_exists($key, $this->_urlParams))
                $this->_urlParams[$key] = $value;
        }
    }

    /**
     * @return Fillio_ServerLogic_Dispatcher Module/Controller/Action demandé
     */
    public function getDispatcher() {
        $uri_params = array_filter(explode("/", ltrim($this->_url, "/")));
        return new Fillio_ServerLogic_Dispatcher($uri_params);
    }

}
