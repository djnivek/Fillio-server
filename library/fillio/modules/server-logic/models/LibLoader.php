<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'fillio/modules/server-logic/models/Loader_Abstract.php';

/**
 * Description of Loader
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_LibLoader extends Fillio_ServerLogic_Loader_Abstract {

    /**
     * Permet de charger un répertoire entier, l'activation de $loadChild entraine le
     * chargement des dossiers enfants. Par défaut, l'option est active.
     * 
     * @param string $path Chemin du répertoire à charger
     * @param boolean $loadChild Chargement des dossiers enfants (Activée par défaut)
     * @return bool retourne false si échoué
     */
    public static function loadDirectory($path = "", $loadChild = true) {
        if (!is_null($path))
            self::loadDirectoryPath($path, $loadChild);
        else
            return false;
    }

    public static function loadFile($path, $filename) {
        if (!is_null($path) && !is_null($filename)) {
            $unslashed = strripos($path, "/") !== (strlen($path) - 1);
            $filePath = $path . ($unslashed ? "/" : "") . $filename;
            if (self::loadFilePath($filePath) === false)
                return false;
        } else {
            return false;
        }
    }

}
