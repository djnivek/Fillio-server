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

    protected function _requiredLibrary() {
        $this->setLibrary("fillio", "media");
    }

    public function init() {

    }

    public function uploadimageAction() {
        $image = Fillio_Media_OutputImage::getImage("kevinmachado");
        $this->response->status = $image->moveToFolderPath("/Applications/MAMP/tmp/php/uploads/");
    }

    public function indexAction() {
        $this->setRenderView(true);
        $this->view->title = "Ma page";
        $this->view->message = "Bonjour comment ça va ?";
        //$this->view->test = $this->render("menu", array("menu" => "Commande", "pathMenu" => "/path/menu/index"));
    }

    public function bisousAction() {
        $this->setRenderView(true);
        $this->view->helloWorld = "Hi Fillio ! ;)";
        $this->view->response = "Bonjour le monde !";
    }

    public function apiAction() {
        $kevin = new Model_User(2);
        $kevin->name = "AHHAHAHAHHA";
        $kevin->mail = "jessy.machado@gmail.com";
        $kevin->actif = false;
        //$kevin->dateCreation = date('Y-m-d H:i:s', strtotime("-8 days"));
        $kevin->save();
        $this->response->users = Model_User::getAllActif();
    }

    public function testmoiAction(){
        $this->response->status = array("done"=>1);
    }

}
