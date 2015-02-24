<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dispatcher
 * 
 * @author kevinmachado
 */
class Fillio_ServerLogic_Dispatcher {

    /**
     * @var string Nom de la librairie en cas d'appel via un FrontControlleur de librairie
     */
    public $library;
    public $module;
    public $controller;
    public $action;

    /**
     * @var bool|null Utilisation d'un front controlleur de librairie ?
     * Null la méthode (flag_FCLib) n'a pas été appellée, true or false si la méthode a été appellée
     */
    public $flag_FCLib;

    /**
     * Recoit les l'url de redirection explosée par "/"
     * @param array $uri_params
     */
    public function __construct($uri_params) {
        $this->flag_FCLib = null;
        if (is_array($uri_params) && count($uri_params)) {
            if (count($uri_params) >= 3) {
                $this->flag_FCLib = $this->checkForFCLib($uri_params[0]);
                if ($this->flag_FCLib) {
                    $exploded = explode("->", ltrim($uri_params[0], "->"));
                    $this->library = strtolower($exploded[0]);
                    $this->module = strtolower($exploded[1]);
                } else {
                    $this->module = strtolower($uri_params[0]);
                }
                $this->controller = strtolower($uri_params[1]);
                $this->action = strtolower($uri_params[2]);
            } else if (count($uri_params) == 2) {
                $this->module = null;
                $this->controller = strtolower($uri_params[0]);
                $this->action = strtolower($uri_params[1]);
            } else if (count($uri_params) == 1) {
                $this->module = null;
                $this->controller = strtolower($uri_params[0]);
                $this->action = 'index';
            } else {
                $this->module = null;
                $this->controller = strtolower($uri_params[0]);
                $this->action = 'index';
            }
        } else {
            $this->module = null;
            $this->controller = 'index';
            $this->action = 'index';
        }
        $this->module = ($this->module == "default" ? null : $this->module);
    }

    /**
     * Permet de savoir si nous utilisons un controlleur interne (de librairie)
     *
     * Ex:  ->fillio->api
     *
     * @param $module string
     * @return bool Utilisons-nous un controlleur de librairie ?
     */
    private function checkForFCLib($module)
    {
        // si le module commence par "->" on a donc à faire à un module de librairie
        return stripos($module, "->") === 0;
    }

}
