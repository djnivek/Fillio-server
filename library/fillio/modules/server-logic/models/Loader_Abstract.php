<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 11/02/2015
 * Time: 19:53
 */

class Fillio_ServerLogic_Loader_Abstract {

    /**
     * @var Fillio_ServerLogic_Loader_Abstract
     */
    protected static $instance = null;

    public static function loadDirectoryPath($myPath = "", $child = false) {
        //echo "<br><br>*************<br><br><br> loadDirectoryPath ($myPath): <br>";
        if (!is_dir($myPath)) {
            return false;
        }

        // il faudrait definir un ordre dans le chargement des fichiers (models puis controllers...)
        // sinon il faudrait peut être mettre de nouveau une methode autoload pleinement dédié aux libraries sur
        // le même principe que pour les modèles de bases
        if ($handle = opendir($myPath)) {
            while (false !== ($entry = readdir($handle))) {
                //echo "<br>--> $entry $child<br>";
                if ($entry != "." && $entry != "..") {
                    if (is_file($myPath . "/" . $entry)) {
                        Fillio_ServerLogic_Loader_Abstract::loadFilePath($myPath . "/" . $entry);
                    }
                    if ($child && is_dir($myPath . "/" . $entry)) {
                        //echo "Fillio_ServerLogic_Loader_Abstract::loadDirectoryPath : $myPath . / . $entry<br>";
                        Fillio_ServerLogic_Loader_Abstract::loadDirectoryPath($myPath . "/" . $entry, $child);
                    }
                }
            }
            closedir($handle);
        }
    }

    public static function loadFilePath($filePath) {
        if (file_exists($filePath))
            require_once $filePath;
        else
            return false;
    }

}