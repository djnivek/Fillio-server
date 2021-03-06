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

    /**
     * @var array Variables propre à l'objet
     * Accès : Se fait grace au magic methods
     * Ajout/Modification : Se fait grace à la méthode addField()
     */
    private $innerProps;

    /**
     * Ajoute un élément à l'objet (un attribut clé/valeur)
     * On utilise cette méthode pour ajouter une variable propre à l'objet
     * présent dans le BDD
     * @param $key string clé de l'attribut
     * @param $value string valeur de l'attribue
     */
    protected function addProp($key, $value) {
        $this->innerProps[$key] = $value;
    }

    public function __set($key, $value) {
        $this->innerProps[$key] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->innerProps))
            return $this->innerProps[$name];
        else
            return null;
    }

    public function getProps()
    {
        return $this->innerProps;
    }

    public function toArray() {
        return $this->innerProps;
    }

    public function save() {
        $this->_save();
    }


}
