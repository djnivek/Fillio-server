<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author kevinmachado
 */
class IndexController extends Fillio_ServerLogic_Action {

    public function _requiredLibrary() {
        //$this->setLibrary("notification");
    }

    public function init() {
        
    }

    public function indexAction() {
        $this->setRenderView(true);
        $this->view->Title = "Ma page";
        $this->view->message = "Bonjour";
        //$this->view->test = $this->render("menu", array("menu" => "Commande", "pathMenu" => "/path/menu/index"));
    }

    public function bisousAction() {
        $this->setRenderView(true);
        $this->view->helloWorld = "Hi Fillio ! ;)";
        $this->view->response = "Bonjour le monde !";
    }

    public function apiAction() {
        $this->response->user = array("nom" => "machado", "prenom" => "kevin");
    }

}
