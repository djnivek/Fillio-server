<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/storage/models/ObjectAbstract.php';

/**
 * Description of Fillio_Storage_Object
 *
 * @author kevinmachado
 */
class Fillio_Storage_Object extends Fillio_Storage_Object_Abstract {

    protected $_name = "test";
    protected $_primaryKeyField = "id_test";

}
