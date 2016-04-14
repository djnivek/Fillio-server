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
class ApiController extends Fillio_ServerLogic_Action {

    protected function _requiredLibrary() {
    }

    public function init() {

    }

    public function booktableAction() {
      $tableID = $this->getUrlParam("tableid");
      if (is_null($tableID)) {
        $this->response->message = "Please put a table id";
        $this->response->success = false;
        return;
      }
      $table = new Model_Table($tableID);
      if ($table->busy == true) {
        $this->response->message = "The table is already busy, please select an other one";
        $this->response->success = false;
      } else {
        $table->busy = true;
        $this->response->success = true;
      }
      $table->save();
    }

    public function itemsAction() {
      $this->response->items = Model_Item::getAll();
    }

    public function callwaiterAction() {
      
    }

}
