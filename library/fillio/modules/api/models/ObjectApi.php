<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObjectApi
 *
 * @author kevinmachado
 */
class Fillio_Api_Object_Api {

    /**
     * @var array() Propri�t� en lecture seule
     */
    private $readonly;

    /**
     * @var array() Propri�t� dont il est interdit d'envoyer les informations
     */
    private $ungettable;

    /**
     * Obtenir les objets (un ou plusieurs)
     * Si aucun identifiant n'est pass�, on envoi l'ensemble des objets
     * 
     * M�thode appel� lorsque l'on fait un GET par l'API
     * 
     * @param string $id Identifiant de l'objet (falcultatif)
     * @return mixed Objet(s) de la classe appelante
     */
    public function __fillio_api_get($id) {
        // on recup?re les donn�es
        // /!\ les champs ungettable ne doivent pas ?tre pr�sent
        // 
        // $toExclude = $this->ungettable;
        // 
        // $this->get($id, $toExclude);

        return;
    }

    public function __fillio_api_set($id) {
        //
    }

    /**
     * Ajouter une propri�t� parmis les �l�ments dont il sera interdit de renvoyer dans l'API
     * @param type $property
     */
    public function setUngettableProperty($property = null) {
        if (!is_null($property) && !strlen($property)) {
            $this->ungettable[] = $property;
        }
    }

}
