<?php

/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 06/02/15
 * Time: 14:53
 */
abstract class Fillio_Notification_NotificationPush_Abstract {

    /**
     * @var string Message Ã  envoyer
     */
    var $_message;

    /**
     * @var string Identifiant du tÃ©lÃ©phone de l'utilisateur
     */
    var $_identifier;

    /**
     * @var string Plateforme de reception des notifications
     */
    var $_platform;

    /**
     * Retourne le chemin du certificat .pem en fonction de l'environnement
     * @param $env string Environnement ('PRODUCTION', 'DEVELOPPEMENT')
     * @return string Chemin du certificat
     */
    abstract protected function getCertificatePath($env);

    function __construct($env) {
        // On test si le certificat est conforme ou non
        $certifPath = $this->getCertificatePath($env);
        if (file_exists($certifPath)) {
            $path_parts = pathinfo($certifPath);
            if ($path_parts['extension'] != "pem") {
                throw new Fillio_ServerLogic_Exception("L'extension du certificat de notificatio n'est pas correcte : '" . $path_parts['extension'] . "'");
            }
        } else {
            throw new Fillio_ServerLogic_Exception("Le certificat de notification n'existe pas");
        }
    }

    /**
     * Envoi de la notification
     */
    public function sendNotification() {
        if ($this->isValidPush()) {
            
        }
    }

    /**
     * Test la validité de la notification
     * Afin de ne pas envoyer une notification o? il manquerait la plupart des choses
     * @return type
     */
    private function isValidPush() {
        return strlen($this->isValidMessage() && $this->isValidIdentifier());
    }

    /**
     * Test la validité du message
     * @return boolean
     */
    private function isValidMessage() {
        if (strlen($this->_message)) {
            // liste de test
            return true;
        }
        return false;
    }

    /**
     * Test la validité de l'identifier
     * @return boolean
     */
    private function isValidIdentifier() {
        if (strlen($this->_identifier)) {
            // liste de test
            return true;
        }
        return false;
    }

}
