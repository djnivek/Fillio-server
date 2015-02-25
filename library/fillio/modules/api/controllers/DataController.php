<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fillio_Engine_DataController
 *
 * @author kevinmachado
 */
class Fillio_Api_DataController extends Fillio_ServerLogic_Action {

    protected function _requiredLibrary(){}

    public function getAction() {
        $id = $this->getUrlParam("id");
        $classname = $this->getUrlParam("classname");

        /*$class = "Model_".ucfirst($classname);
        $obj = new $class($id);
        $this->response->object = $obj->toString();*/

        $this->response->message = "Hello world /$classname/$id/";

    }

    public function setAction() {

    }
}
