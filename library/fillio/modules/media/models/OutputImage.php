<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 03/03/2015
 * Time: 19:26
 */

class Fillio_Media_OutputImage extends Fillio_Media_OutputFile {

    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $path;
    /**
     * @var
     */
    public $size;

    /**
     * @param $file array Fichier dans la variable $_FILES
     * Ex :
     *   [name] => test.png
     *   [type] => application/octet-stream
     *   [tmp_name] => /Applications/MAMP/tmp/php/phptg16jL
     *   [error] => 0
     *   [size] => 106158
     */
    function __construct($file)
    {
        $this->name = $file['name'];
        $this->path = $file['tmp_name'];
        $this->size = $file['size'];
    }

    public function moveToFolderPath($path) {
        $uploadfile = $path . $this->name;
        return move_uploaded_file($this->path, $uploadfile);
    }
}