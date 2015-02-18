<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_Abstract
 *
 * @author kevinmachado
 */
abstract class Fillio_ServerLogic_Application_Abstract {

    /**
     * @var Application Instance d'application
     */
    private static $_instance;

    /**
     * @var string Identifiant de l'application (com.domain.myapp)
     */
    private $_applicationIdentifier;

    /**
     * @var string Nom de l'application (My App)
     */
    private $_name;

    /**
     * @var string Numéro de version de l'application
     */
    private $_version;

    /**
     * @var string Etat de l'application (Alpha, Beta, Stable)
     */
    private $_versionState;

    /**
     * @var string Environnement (Développement, Production)
     */
    private $_environment;

    /**
     * @var Fillio_ServerLogic_FrontController Controller frontal
     */
    private $_frontController;

    protected function __construct() {
        $this->_frontController = new Fillio_ServerLogic_FrontController();
    }

    /**
     * @return Fillio_ServerLogic_Application Instance d'application
     * @throws Exception
     */
    public static function getInstance() {
        if (is_null(self::$_instance))
            self::$_instance = new Fillio_ServerLogic_Application();
        return self::$_instance;
    }

    public function getFrontController() {
        if (!isset($this->_frontController))
            throw new Fillio_ServerLogic_Exception("Le controlleur n'est pas connu", 4000);
        return $this->_frontController;
    }

    function setApplicationIdentifier($_applicationIdentifier) {
        $this->_applicationIdentifier = $_applicationIdentifier;
    }

    function getApplicationIdentifier() {
        return $this->_applicationIdentifier;
    }

    function getName() {
        return $this->_name;
    }

    function getVersion() {
        return $this->_version;
    }

    function getVersionState() {
        return $this->_versionState;
    }

    function setVersionState($_versionState) {
        $this->_versionState = $_versionState;
    }

    function setName($_name) {
        $this->_name = $_name;
    }

    function setVersion($_version) {
        $this->_version = $_version;
    }

    /**
     * @return string Environment
     */
    public function getEnvironment()
    {
        return $this->_environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->_environment = $environment;
    }

    /**
     * Configure l'application et la lance
     */
    public function run($environment) {

        // attribution de l'environnement
        $this->setEnvironment($environment);

        // lancement du script d'initialisation
        require_once APPLICATION_PATH . "configs/setup.php";

        // obtention du chemin désiré
        $dispatcher = Fillio_ServerLogic_Request::getInstance()->getDispatcher();

        // attribution de l'action à appeler
        $this->_frontController->setModule($dispatcher->module);
        $this->_frontController->setController($dispatcher->controller);
        $this->_frontController->setAction($dispatcher->action);

        // execution de l'action
        echo $this->_frontController->execute();
    }

}
