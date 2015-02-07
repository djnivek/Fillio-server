<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author kevinmachado
 */
class Fillio_ServerLogic_LibLoader extends Fillio_ServerLogic_LibLoader_Abstract {

    /**
     * @var Fillio_ServerLogic_LibLoader 
     */
    private static $_instance;

    /**
     * Permet de charger un r�pertoire entier, l'activation de $loadChild entraine le
     * chargement des dossiers enfants. Par d�faut, l'option est active.
     * 
     * @param string $path Chemin du r�pertoire ? charger
     * @param boolean $loadChild Chargement des dossiers enfants (Activ�e par d�faut)
     */
    public static function loadDirectory($path = "", $loadChild = true) {
        if (!is_null($path))
            self::_getInstance()->loadDirectoryPath($path, $loadChild);
        else
            return false;
    }

    public static function loadFile($path, $filename) {
        if (!is_null($path) && !is_null($filename)) {
            $unslashed = strripos($path, "/") !== (strlen($path) - 1);
            $filePath = $path . ($unslashed ? "/" : "") . $filename;
            if (self::_getInstance()->loadFilePath($filePath) === false)
                return false;
        } else {
            return false;
        }
    }

    /**
     * @return Fillio_ServerLogic_LibLoader
     */
    private static function _getInstance() {
        if (is_null(self::$_instance))
            self::$_instance = new self();
        return self::$_instance;
    }

}

class Fillio_ServerLogic_LibLoader_Abstract {

    protected function loadDirectoryPath($myPath = "", $child = false) {
        if (!is_dir($myPath)) {
            return false;
        }
        if ($handle = opendir($myPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (is_file($myPath . "/" . $entry)) {
                        $this->loadFilePath($myPath . "/" . $entry);
                    }
                    if ($child && is_dir($myPath . "/" . $entry)) {
                        $this->loadDirectoryPath($myPath . "/" . $entry, $child);
                    }
                }
            }
            closedir($handle);
        }
    }

    protected function loadFilePath($filePath) {
        if (file_exists($filePath)) {
            echo $filePath;
            require_once $filePath;
        } else {
            return false;
        }
    }

}
