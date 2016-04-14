<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/storage/models/TableStructure.php';

/**
 * Table de la base de données
 *
 * @author kevinmachado
 */
class Fillio_Storage_Table {

    /**
     * @var string Nom de la table
     */
    private $_name;

    /**
     * @var string Nom du champs clé primaire
     */
    private $_primaryKeyField;

    /**
     * @var string Nom de la classe
     * Exemple : Model_User
     */
    private $_classname;

    /**
     * @var Fillio_Storage_Table instance de la table
     */
    private static $_instance;

    /**
     * @var Fillio_Storage_Table_Structure Structure de la table composé des noms des
     * champs de la table
     *
     * Ex : [id_user, username, password]
     */
    private $_struct;

    public static function getInstance($classname) {
        if (is_null(self::$_instance))
            self::$_instance = new Fillio_Storage_Table($classname);
        return self::$_instance;
    }

    /**
     * @param $classname string Nom de la classe appelante
     * @throws Fillio_ServerLogic_Exception
     */
    private function __construct($classname)
    {
        ////////////////////////////////////////////
        //                                        //
        //  Définition des éléments de la table   //
        //                                        //
        ////////////////////////////////////////////

        // définition du nom de la classe (Ex : Model_User)
        $this->_classname = $classname;

        // définition du nom de la table
        if (!is_null($classname::$_tablename))
            $this->_name = $classname::$_tablename;
        else
            throw new Fillio_ServerLogic_Exception("Le nom de la table n'est pas renseignée");

        // définition de la clé primaire (Ex : id_user)
        /*if (!is_null($classname::$_primaryKeyField))
            $this->_primaryKeyField = $classname::$_primaryKeyField;
        else
            throw new Fillio_ServerLogic_Exception("La clé primaire n'est pas renseignée");*/

        ////////////////////////////////////////////
        //                                        //
        //  Définition des propriétés internes    //
        //                                        //
        ////////////////////////////////////////////
        $this->_setInnerPropsStruct();

    }

    /**
     * @return Fillio_Storage_Table_Structure Structure de la table
     */
    public function getStructure()
    {
        return $this->_struct;
    }


    /**
     * Chargement des structures de la table
     */
    private function _setInnerPropsStruct()
    {
        $sql = "show columns from $this->_name";
        $columns = $this->executeQuery($sql);
        $this->_struct = new Fillio_Storage_Table_Structure($columns);
        $this->_primaryKeyField = $this->_struct->getPrimaryKey()->name;
    }

    /**
     * @param string $id Identifiant primaire de l'objet
     * @return mixed Objet de la table
     * @throws Fillio_ServerLogic_Exception
     */
    public function getObject($id = null) {
        if (is_null($id)) {
            throw new Fillio_ServerLogic_Exception("Vous devez fournir un identifiant pour récupérer un objet");
        } else {
            $request = $this->selectRequest()." WHERE ".$this->_primaryKeyField. " = $id";
            $res = $this->executeQuery($request);
            return (is_null($res) ? null : $res[0]);
        }

    }

    /**
     * Obtention de l'ensemble des objets de la table
     * On peut passer des options ( 'condition', 'limit')
     * @param array|null $options Tableau d'options
     * @return array Retourne un tableau
     * @throws Fillio_ServerLogic_Exception
     */
    public function getAll($options = null) {
        $request = $this->selectRequest()." WHERE 1";

        if (!is_null($options) && isset($options["condition"])) {
            $request .= " AND ".$options["condition"];
        }

        // [...] ajouter des conditions si vous le souhaitez

        // cette condition doit être toujours à la fin (---> limit X)
        if (!is_null($options) && isset($options["limit"])) {
            // on supprime le mot 'limit' si jamais on l'a mis dans la condition
            $request .= "limit ".(str_replace("limit", "", $options["limit"]));
        }

        return $this->executeQuery($request);
    }

    /**
     * @return string Introduction d'une requête pour la table
     */
    private function selectRequest() {
        return "SELECT * FROM ".$this->_name." ";
    }

    /**
     * Retourne la requête sql permettant un insert via BindParams (prepare)
     * Ex : 'INSERT INTO REGISTRY (name, value) VALUES (:name, :value)'
     *
     * La requête est construite à partir d'une liste de propriétés
     * @param null|array $props Liste de propriétés (simplement les clées)
     * @return string Requête sql
     */
    private function insertPreparedRequest($props = null) {
        if (is_null($props))
            return null;
        $sql = "INSERT INTO $this->_name (";
        foreach ($props as $prop) {
            $sql .= "$prop,";
        }
        //  INSERT INTO REGISTRY (name,name2,
        // on supprime la virgule à la fin s'il y en a une
        $sql = rtrim($sql, ",");
        $sql .= ") VALUES (";
        //      INSERT INTO REGISTRY (name,name2) VALUES (
        foreach ($props as $prop) {
            $sql .= ":$prop,";
        }
        //  INSERT INTO REGISTRY (name,name2) VALUES (:name,:name2,
        // on supprime la virgule à la fin s'il y en a une
        $sql = rtrim($sql, ",");
        $sql .= ")";
        return $sql;
    }

    /**
     * Retourne la requête sql permettant un update via BindParams (prepare)
     * Ex : 'INSERT INTO REGISTRY (name, value) VALUES (:name, :value)'
     *
     * La requête est construite à partir d'une liste de propriétés
     * @param null|array $props Liste de propriétés (simplement les clées)
     * @return string Requête sql
     */
    private function updatePreparedRequest($props = null) {
        if (is_null($props))
            return null;
        $sql = "UPDATE $this->_name SET ";
        foreach ($props as $prop) {
            $sql .= "$prop = :$prop,";
        }
        //  UPDATE user SET name=:name,name2=:name2,
        // on supprime la virgule à la fin s'il y en a une
        $sql = rtrim($sql, ",");
        //  UPDATE user SET name=:name,name2=:name2
        $sql .= " WHERE ".$this->_primaryKeyField." = :".$this->_primaryKeyField;
        //  UPDATE user SET (name=:name,name2=:name2) WHERE primarykey = 234
        return $sql;
    }

    /**
     * @param $query string Paramètre de la requête à executer
     * @return mixed|null Résultat retourné par la requête
     * @throws Fillio_ServerLogic_Exception
     */
    private function executeQuery($query) {
      if (is_null(Fillio_Storage_Database::getInstance("main"))) {
        throw new Fillio_ServerLogic_Exception("Storage Database is null, please correct this problem and try again");
      }
      $statement = Fillio_Storage_Database::getInstance("main")->getDb()->query($query, PDO::FETCH_ASSOC);
      if ($statement === false) {
        throw new Fillio_ServerLogic_Exception("Erreur pendant la requête '$query''");
      } else {
        return $statement->fetchAll();
      }
    }

    /**
     * Sauvegarde des données dans la table
     * @param $props array|null Tableau (clé/valeur) de propriétés à insérer
     */
    public function insert($props = null)
    {
        if (is_null($props))
            return;
        $sql = $this->insertPreparedRequest(array_keys($props));
        $stmt = Fillio_Storage_Database::getInstance("main")->getDb()->prepare($sql);
        $stmt->execute($props);
    }

    /**
     * Mise à jour des données dans la table
     * @param $props array tableau (clé/valeur) de propriétés à mettre à jour
     */
    public function update($props)
    {
          if (is_null($props))
              return;
          $sql = $this->updatePreparedRequest(array_keys($props));
          $stmt = Fillio_Storage_Database::getInstance("main")->getDb()->prepare($sql);
          $stmt->execute($props);
    }

}
