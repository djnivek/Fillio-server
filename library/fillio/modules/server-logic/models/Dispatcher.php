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

    public $module;
    public $controller;
    public $action;

    /**
     * Recoit les l'url de redirection explosée par "/"
     * @param array $uri_params
     */
    public function __construct($uri_params) {
        if (is_array($uri_params) && count($uri_params)) {
            if (count($uri_params) >= 3) {
                $this->module = strtolower($uri_params[0]);
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

}
