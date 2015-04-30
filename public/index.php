<?php

/**
 * CONDITIONS
 */
if ($_SERVER['SERVER_NAME'] == 'localhost')
    $env = 'DEVELOPMENT';
else
    $env = 'PRODUCTION';

/**
 * APPLICATION LAUNCH
 */
$applicationIdentifier = $_POST['application_identifier'];

//define("APPLICATION_PATH", "/Users/kevinmachado/Documents/Developpement/Projets/YCDI_Beta/application/");   //  Macbook Pro
define("APPLICATION_PATH", '/Users/kevinmachado/Documents/Mes documents/Developpement/13_Perso/01_PHP/Fillio-server/application/'); //  iMac

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/')
)));

require_once 'fillio/Fillio.php';
Fillio::start()->run($env);