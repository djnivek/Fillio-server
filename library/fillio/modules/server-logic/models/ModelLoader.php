<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 11/02/2015
 * Time: 19:53
 */

require_once 'fillio/modules/server-logic/models/Loader_Abstract.php';

class Fillio_ServerLogic_ModelLoader extends Fillio_ServerLogic_Loader_Abstract {

    /**
     * Permet de charger le répertoire entier qui contient l'entité
     * que l'on désire utiliser
     * @param $modelName string Nom de l'entitée à charger
     * @return bool Le model a bien été chargé
     */
    public static function loadModel($modelName) {
        $modelItems = explode("_", strtolower($modelName));
        if (is_array($modelItems) && count($modelItems) >= 3) {
            // Exemple : Monmodule_Model_User
            //  On test si le deuxième argument est bien "model"
            if ($modelItems[1] == "model") {
                $module = $modelItems[0];
            } else {
                $module = null;
            }
        } else if (is_array($modelItems) && count($modelItems) == 2) {
            // Exemple : Model_User
            if ($modelItems[0] == "model") {
                $module = null;
            } else {
                $module = null;
            }
        } else if (is_array($modelItems) && count($modelItems) == 1) {
            // Exemple : User /!\ On ne charge pas, synthaxe interdite !
            $module = null;
        } else {
            // Exemple : null ou pas un tableau, donc on ne charge pas!
            $module = null;
        }

        return Fillio_ServerLogic_ModelLoader::loadModelForModule($module);
    }

    /**
     * Permet de charger le répertoire d'entités, pour un module donné
     * Si aucun module n'est passé, on charge le répertoire par défaut (default)
     *
     * @param $module string Nom du module dont on va charger les entités
     * @return bool Le model a bien été chargé
     */
    public static function loadModelForModule($module = null) {
        $directoryPath = Fillio_ServerLogic_ModelLoader::getPathModelDirectory($module);
        return Fillio_ServerLogic_ModelLoader::loadDirectoryPath($directoryPath);
    }

    /**
     * Permet d'obtenir les chemins de répertoire d'entités pour un module
     * Si le module n'est pas renseigné, ce sera le chemin durépertoire d'entités
     * du module par défaut qui sera fourni
     *
     * @param string|null $module Nom du module (s'il y en a un)
     * @return string Chemin du répertoire
     */
    private static function getPathModelDirectory($module = null) {
        $modelDirPath = APPLICATION_PATH;
        if (!is_null($module)) {
            $modelDirPath .= "modules/";
        }
        $modelDirPath .= "models";
        return $modelDirPath;
    }

}