<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 03/03/2015
 * Time: 21:22
 */

class UploadController extends Fillio_ServerLogic_Action{

    protected function _requiredLibrary() {
        $this->setLibrary("fillio", "media");
    }

    public function imageAction() {
        $image = Fillio_Media_OutputImage::getImage("name");
        $this->response->status = $image->moveToFolderPath("/Applications/MAMP/tmp/php/uploads");
    }
}