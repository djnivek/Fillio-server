<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 27/02/2015
 * Time: 18:14
 */

class Fillio_Storage_Table_Structure {

    /**
     * @var array Tableau d'objet Fillio_Storage_Table_Field
     */
    public $fields;

    /**
     * Constructeur de la structure de la table
     *
     * @param $columns array Liste des columns
     * Tableau obtenu via "show columns from TABLE_NAME"
     * Ex :
     *  [Field] => id_user
     *  [Type] => int(11)
     *  [Null] => NO
     *  [Key] => PRI
     *  [Default] =>
     *  [Extra] => auto_increment
     */
    function __construct($columns)
    {
        foreach ($columns as $field) {
            $fieldName = $field['Field'];
            $fields[$fieldName] = new Fillio_Storage_Table_Field($field);
        }
    }

    /**
     * Obtention de la clef primaire ou null si pas de clef primaire
     * @return Fillio_Storage_Table_Field|null
     */
    public function getPrimaryKey() {
        /** @var Fillio_Storage_Table_Field $field */
        foreach ($this->fields as $field) {
            if ($field->isPrimaryKey)
                return $field;
        }
        return null;
    }

}