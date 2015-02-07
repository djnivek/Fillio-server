<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fillio_ServerLogic__View
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_View {

    /**
     * @var array
     */
    private $datas;

    /**
     * @var string nom du module o? se trouve la vue
     */
    private $_module;

    /**
     * @var string nom du controller o? se trouve la vue
     */
    private $_controller;

    /**
     * @var string nom de l'action o? se trouve la vue
     */
    private $_action;

    public function getView() {
        $view_path = APPLICATION_PATH;
        if (!is_null($this->_module) && strlen($this->_module)) {
            $view_path.="modules/$this->_module/";
        }
        $view_path.="views/$this->_controller/$this->_action.phtml";
        ob_start();
        require_once($view_path);
        $this->content = ob_get_clean();

        if ($this->layout) {
            require_once(APPLICATION_PATH."/layouts/$this->layout.phtml");
        } else
            return utf8_encode($this->content);
    }

    public function __set($name, $value) {
        $this->datas[$name] = $value;
    }

    public function __get($name) {
        return $this->datas[$name];
    }
    
    function setModule($_module) {
        $this->_module = $_module;
    }

    function setController($_controller) {
        $this->_controller = $_controller;
    }

    function setAction($_action) {
        $this->_action = $_action;
    }
}
