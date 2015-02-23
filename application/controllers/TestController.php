<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 19/02/2015
 * Time: 19:40
 */

class TestController extends Fillio_ServerLogic_Action {

    protected function _requiredLibrary()
    {

    }

    public function apiAction() {
        $this->setRenderView(true);
        $this->view->mavar = $this->getUrlParam("keyword");
    }
}