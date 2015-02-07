<?php
/**
 * Created by PhpStorm.
 * User: kevinmachado
 * Date: 06/02/15
 * Time: 15:13
 */

class Fillio_Notification_NotificationPush extends Fillio_Notification_NotificationPush_Abstract {

    /**
     * Retourne le chemin du certificat .pem en fonction de l'environnement
     * @param $env string Environnement ('PRODUCTION', 'DEVELOPPEMENT')
     * @return string Chemin du certificat
     */
    protected function getCertificatePath($env) {

    }

}