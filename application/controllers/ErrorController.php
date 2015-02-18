<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorController
 *
 * @author kevinmachado
 */
class ErrorController extends Fillio_ServerLogic_Action {

    protected function _requiredLibrary() {

    }
    
    public function init() {
        
    }

    public function indexAction() {
        $this->setRenderView(true);
        $this->view->errorMessage = "Erreur de l'application";
    }

}

