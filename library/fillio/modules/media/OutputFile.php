<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 03/03/2015
 * Time: 19:24
 */

class Fillio_Media_OutputFile {

    /**
     * @param string|null $dispositionName Nom du "content-disposition"
     * @return Fillio_Media_OutputImage
     */
    public static function getImage($dispositionName = null) {
        $file = $_FILES[$dispositionName];
        $image = new Fillio_Media_OutputImage($file);
        return $image;
    }

}