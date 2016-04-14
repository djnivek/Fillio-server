<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author kevinmachado
 */
class Model_Table extends Fillio_Storage_Object {

    public static $_tablename = "desk";

    public static function getAllBooked() {
        return self::findAll("busy = 1");
    }

    public static function getAllFree() {
        return self::findAll("busy = 0");
    }
}
