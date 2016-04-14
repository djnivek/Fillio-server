<?php

/**
 * Définition des constantes de l'application
 */

// Identifiant de l'application
$applicationIdentifier = "com.machado.dev.simplyfood";

//
//  Identifiant de l'application
//
Fillio_ServerLogic_Application::getInstance()->setApplicationIdentifier($applicationIdentifier);

//
//  Nom de l'application
//
Fillio_ServerLogic_Application::getInstance()->setName("SimplyFood");

//
//  Version de l'application
//
Fillio_ServerLogic_Application::getInstance()->setVersion("0.1.0");

//
//  Type Version de l'application
//
Fillio_ServerLogic_Application::getInstance()->setVersionState("alpha");

//
//  Initialisation d'une route
//
//Fillio_ServerLogic_Application::getInstance()->addRoute("/class/:classname/:id/",   "/->fillio->api/dataobject/get/");
//Fillio_ServerLogic_Application::getInstance()->addRoute("/class/:classname/",       "/->fillio->api/dataobject/get/");
Fillio_ServerLogic_Application::getInstance()->addRoute("/booktable/:tableid/", "/default/api/booktable/(tableid)");

//
//  Initilisation de la database de l'application
//
Fillio_Storage_Database::getInstance("main")->setCredential("localhost", "8889", "simplyfood", "root", "root");

//
//  Initilisation de la database pour Core Fillio
//
//Fillio_Storage_Database::getInstance("fillio")->setCredential("127.0.0.1", null, "fillio", "root", "root");
