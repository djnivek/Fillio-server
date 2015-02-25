<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 11/02/2015
 * Time: 19:53
 */

class Fillio_ServerLogic_Loader_Abstract {

    public static function loadDirectoryPath($myPath = "", $child = false) {
        if (!is_dir($myPath)) {
            return false;
        }
        if ($handle = opendir($myPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (is_file($myPath . "/" . $entry)) {
                        Fillio_ServerLogic_Loader_Abstract::loadFilePath($myPath . "/" . $entry);
                    }
                    if ($child && is_dir($myPath . "/" . $entry)) {
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