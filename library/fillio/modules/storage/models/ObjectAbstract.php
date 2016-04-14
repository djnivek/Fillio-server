<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/storage/models/Table.php';

/**
 * Description of Fillio_Storage_Object_Abstract
 *
 * @author kevinmachado
 */
abstract class Fillio_Storage_Object_Abstract {

    /**
     * @var Fillio_Storage_Table
     */
    private $table;

    /**
     * @var string Identifiant de l'objet (clé primaire)
     */
    protected $_id;

    function __construct($id = null)
    {
        $class = get_called_class();
        $this->table = Fillio_Storage_Table::getInstance($class);
        if (!is_null($id)) {
            $this->_id = $id;
            $this->load();
        }
    }

    /**
     * Chargement de l'objet et insertion de ses champs
     * dans la variable $fields
     */
    protected function load() {
        // obtention de l'objet dans la la table associée à partir de la clé primaire
        $obj = $this->table->getObject($this->_id);
        // mise en place des données dans l'objet
        foreach ($this->table->getStructure()->getFieldKeys() as $field) {
            $this->addProp($field, $obj[$field]);
        }
    }

    /**
     * Récupère l'ensemble des données de la table sous forme d'objet
     * La classe sera celle utilisée pour l'appel
     * @return array Tableau d'objet
     */
    public static function getAllObject() {
        $class = get_called_class();
        $allInArray = self::getAll();
        $objs = array();
        foreach ($allInArray as $oneInArray) {
            $obj = new $class();
            foreach ($oneInArray as $key => $val) {
                $obj->addProp($key, $val);
                //  optimisation /!\    -> unset($oneInArray[$key]) ?
            }
            $objs[] = $obj;
        }
        return $objs;
    }

    /**
     * Récupère l'ensemble des données sous forme de tableau
     * @return array Tableau de données (non-objet)
     */
    public static function getAll() {
        // récupération de la classe appellante
        $class = get_called_class();
        // récupération de la table attenante à l'objet
        $table = Fillio_Storage_Table::getInstance($class);
        return $table->getAll();
    }

    /**
     * Récupère l'ensemble des données sous forme de tableau
     * Une condition peut être passé dans le but de filtrer les résultats
     * @param $condition Filtre SQL
     * @return array Tableau de données (non-objet)
     */
    public static function findAll($condition) {
        $options = array("condition" => $condition);
        // récupération de la classe appellante
        $class = get_called_class();
        // récupération de la table attenante à l'objet
        $table = Fillio_Storage_Table::getInstance($class);
        return $table->getAll($options);
    }

    protected function _save() {
        // obtention des propriétés de l'objet
        $props = null;
        if (method_exists($this, "getProps"))
            $props = $this->getProps();
        // est-ce un update ou un insert ?
        if (!is_null($this->_id)) {
            $this->table->update($props);
        } else {
            $this->table->insert($props);
        }
    }

    /**
     * Ajoute un élément à l'objet (un attribut clé/valeur)
     * On utilise cette méthode pour ajouter une variable propre à l'objet
     * présent dans le BDD
     * @param $key string clé de l'attribut
     * @param $value string valeur de l'attribue
     */
    abstract protected function addProp($key, $value);

}
