<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 17/02/2015
 * Time: 19:09
 */

class ObjectController extends Fillio_Api_Action {

    public function getAction() {
        $objectAsked = array("class" => "user", "id" => "2");
        $class = $objectAsked['class'];
        $id = $objectAsked['id'];
        $classname = "Model_".$class;
        $object = new $classname($id);
        $this->response->$class = $object->toString();
    }

    public function setAction() {

    }

}