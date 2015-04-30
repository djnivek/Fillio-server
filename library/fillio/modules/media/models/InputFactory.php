<?php
/**
 * User: kevinmachado
 * Date: 30/04/15
 * Time: 11:28
 */

class Fillio_Media_InputFactory {

    /**
     * @param string|null $dispositionName Nom du "content-disposition"
     * @return Fillio_Media_OutputFile|null
     */
    public static function getFile($dispositionName = null) {
        if ($dispositionName == null) {
            return null;
        }
        $file = $_FILES[$dispositionName];
        $output = new Fillio_Media_OutputFile($file);
        return $output;
    }

}