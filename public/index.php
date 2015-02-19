<?php

//print_r($_SERVER);
//print_r($_POST);

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

define("APPLICATION_PATH", "/Users/kevinmachado/Documents/Developpement/Projets/YCDI_Beta/application/");   //  Macbook Pro
//define("APPLICATION_PATH", "/Users/kevinmachado/PhpstormProjects/fillio-sandbox/application/");           //  iMac

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/')
)));

require_once 'fillio/Fillio.php';
Fillio::start()->run($env);

/*
$params = array(
    "username" => "kevin",
    "password" => "hYu&bF2f73"
);
$opt = array(
    "action" => "connection",
    "params" => $params
);
$isLogged = Library::getLibrary("fillio")->getModule("auth", $opt);
*/