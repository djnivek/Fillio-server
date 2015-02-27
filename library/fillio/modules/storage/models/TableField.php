<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 27/02/2015
 * Time: 18:21
 */

class Fillio_Storage_Table_Field {

    /**
     * @var string nom du champs
     */
    public $name = "";

    /**
     * @var bool le champs peut être null ?
     */
    public $canBeNull = false;

    /**
     * @var bool est une clef primaire ?
     */
    public $isPrimaryKey = false;

    /**
     * @var bool est une clef étrangère ?
     */
    public $isForeignKey = false;

    /**
     * @var string Type du champs
     */
    public $type;

    /**
     * @var mixed Valeur par défaut du champs
     */
    public $defaultValue;

    function __construct($field)
    {
        $this->name = $field['Field'];
        $this->canBeNull = ($field['Null'] == "NO");
        $this->isPrimaryKey = ($field['Key'] == "PRI");
        //$this->isForeignKey = ($field['Key'] == "PRI");
        $this->type = $field['Type'];
        $this->defaultValue = $field['Default'];
    }

}