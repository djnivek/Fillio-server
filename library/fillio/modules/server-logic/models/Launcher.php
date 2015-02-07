<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 06/02/15
 * Time: 12:14
 */

class Fillio_ServerLogic_Launcher {

    /**
     * @var string IP de l'utilisateur
     */
    var $remoteIP;

    /**
     * @var Instance du launcher
     */
    static $launcher;

    /**
     * Ajouter l'adresse IP de l'utilisateur pouvant effectuer l'installation
     * @param $remoteIP
     * @throws Fillio_ServerLogic_Exception
     */
    function __construct($remoteIP)
    {
        $this->remoteIP = $remoteIP;
        if ($this->allowedIp()) {
            $this->startInstallation();
        } else {
            throw new Fillio_ServerLogic_Exception("Vous n'êtes pas autorisé à accéder à cette page");
        }
    }

    public static function start($ip) {
        if (is_null(self::$launcher))
            self::$launcher = new Fillio_ServerLogic_Launcher($ip);
        return self::$launcher;
    }

    /**
     * @return bool L'IP du client est-elle autorisée ?
     */
    private function allowedIp()
    {
        return ($_SERVER["REMOTE_IP"] == $this->remoteIP);
    }

    private function startInstallation()
    {
        $this->initDatabaseWithFillioData();
    }

    /**
     * On configure la base de données avec les éléments dont Fillio à besoin
     */
    private function initDatabaseWithFillioData() {

    }

}