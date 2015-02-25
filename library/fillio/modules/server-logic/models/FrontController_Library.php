<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 24/02/2015
 * Time: 21:46
 *
 * FrontController destiné au librairie
 * C'est celui-ci qui est appelé si l'on souhaite ouvrir un controlleur interne
 * au librarie
 *
 */

class Fillio_ServerLogic_FrontController_Library extends Fillio_ServerLogic_FrontController {

    /**
     * @var string Nom de la librairie où se trouvera le Controlleur
     */
    private $_libraryName;

    /**
     * Execute le controlleur
     *
     * /!\ On surcharge la méthode afin de retirer le chargement des fichiers
     * /!\ Cette action est inutile car la librairie sera déjà être chargée
     *
     * @return mixed Retourne la vue
     */
    public function execute() {
        //$this->loadFiles();
        $this->dispatch();

        if ($this->controller->isRenderViewEnabled())
            return $this->controller->getView();
        else
            return json_encode($this->controller->getResponse());
    }

    /**
     * /!\ On surcharge la méthode afin de changer le nom du controlleur
     */
    protected function getControllerName() {
        $controllerName = null;
        if (!is_null($this->_libraryName)) {
            $controllerName .= ucfirst($this->_libraryName) . "_";
        }

        if (!is_null($this->_module) && $this->_module != "default") {
            $controllerName .= ucfirst($this->_module) . "_";
        }
        $controllerName .= ucfirst($this->_controller) . "Controller";

        return $controllerName;
    }

    /**
     * @param $name string nom de la librairie
     */
    public function setLibrary($name) {
        $this->_libraryName = $name;
    }
}