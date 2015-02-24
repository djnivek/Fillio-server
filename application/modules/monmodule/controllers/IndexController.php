<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 24/02/2015
 * Time: 19:28
 */

class Module_Monmodule_IndexController extends Fillio_ServerLogic_Action {

    protected function _requiredLibrary() {}

    public function init() {

    }

    public function indexAction() {
        $this->setRenderView(true);
        $this->view->title = "Module";
        $this->view->message = "Hello world !";
    }

}