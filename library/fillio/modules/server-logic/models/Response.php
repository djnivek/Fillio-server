<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_Response extends ArrayObject {
    /* public function __construct($array) {
      parent::__construct($array);

      $fillioDatas = array(
      "stuff" => "ok",
      "stuf2" => "ok1",
      "stuf4" => "ok2",
      "stuf5" => "ok3"
      );
      $this->fillio_data = base64_encode(print_r($fillioDatas, true));

      } */

    public function __set($name, $value) {
        $this->offsetSet($name, $value);
    }

    public function toString() {
        $fillioDatas = array(
            "stuff" => "ok",
            "stuf2" => "ok1",
            "stuf4" => "ok2",
            "stuf5" => "ok3"
        );
        $this->fillio_data = base64_encode(json_encode($fillioDatas));
        return $this;
    }

}
