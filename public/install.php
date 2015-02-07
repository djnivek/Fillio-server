<?php
/**
 * User: kevinmachado
 * Date: 06/02/15
 * Time: 12:13
 */

/**
 *
 * INFORMATIONS - UTILISATEUR
 *
 * Initilisation des informations de l'utilisateur
 *
 */
$MY_IP = "127.0.0.1";

/**
 *
 * INFORMATIONS - BASE DE DONNÃ‰ES
 *
 * Initilisation des informations base de données
 *
 */
$DB_HOST = "127.0.0.1";
$DB_PORT = "80";
$DB_USER = "root";
$DB_PASS = "root";

define("APPLICATION_PATH", "/Users/kevinmachado/Documents/Developpement/Projets/YCDI_Beta/application/");

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/')
)));

require_once 'fillio/modules/server-logic/models/Launcher.php';
Fillio_ServerLogic_Launcher::start($MY_IP);