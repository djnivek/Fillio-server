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

        /** @var Fillio_Storage_Object $class */
        $class = "Model_".ucfirst($classname);

        if (isset($id) && strlen($id) >= 1) {
            /** @var Fillio_Storage_Object $obj */
            $obj = new $class($id);
            $this->response->objects = $obj->toArray();
        } else {
            $this->response->objects = $class::getAll();
        }




        $this->response->message = "Hello world /$classname/$id/";

    }

    public function setAction() {

    }
}
