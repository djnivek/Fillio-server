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

define("APPLICATION_PATH", '/Users/kevinmachado/Documents/Developpement/Projets/R&D/SimpleFood/Fillio-server/application/'); //  Macbook Pro Nouveal

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/')
)));

require_once 'fillio/Fillio.php';
Fillio::start()->run($env);
