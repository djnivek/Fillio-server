<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 03/03/2015
 * Time: 23:19
 */

class Fillio_ServerLogic_ModelLoader_Library extends Fillio_ServerLogic_Loader_Abstract {

    /**
     * Permet de charger le répertoire entier qui contient l'entité
     * que l'on désire utiliser
     * @param $modelName string Nom de l'entitée à charger
     * @return bool Le model a bien été chargé
     */
    public static function loadModel($modelName) {
        $modelItems = explode("_", strtolower($modelName));
        if (is_array($modelItems) && count($modelItems) >= 3) {
            // Exemple : Fillio_Api_Action
            $library = $modelItems[0];
            $module = $modelItems[1];
        } else if (is_array($modelItems) && count($modelItems) == 2) {
            // Exemple : Fillio_Action
            $library = $modelItems[0];
            $module = null;
        } else {
            $library = null;
            $module = null;
        }

        return Fillio_ServerLogic_ModelLoader_Library::loadModelForLibraryModule($library, $module);
    }

    /**
     * Permet de charger le répertoire d'entités, pour un module donné
     * Si aucun module n'est passé, on charge le répertoire par défaut (default)
     *
     * @param $library string Nom de la librairie dont on va charger les entités
     * @param $module string Nom du module dont on va charger les entités
     * @return bool Le model a bien été chargé
     */
    private static function loadModelForLibraryModule($library = null, $module = null) {
        $directoryPath = Fillio_ServerLogic_ModelLoader_Library::getPathModelDirectory($library, $module);
        return Fillio_ServerLogic_ModelLoader::loadDirectoryPath($directoryPath);
    }

    /**
     * Permet d'obtenir les chemins de répertoire d'entités pour un module dans une librairie
     * Si le module n'est pas renseigné, ce sera le chemin durépertoire d'entités
     * du module par défaut qui sera fourni
     *
     * @param string|null $library Nom de la librairie
     * @param string|null $module Nom du module (s'il y en a un)
     * @return string Chemin du répertoire
     */
    private static function getPathModelDirectory($library = null, $module = null) {
        $modelDirPath = null;
        if (is_null($library)) {
            $modelDirPath = "$library/";
            if (!is_null($module)) {
                $modelDirPath .= "modules/";
            }
            $modelDirPath .= "models";
        }
        return $modelDirPath;
    }

}