<?php

/**
 * D�finition des constantes de l'application
 */

// Identifiant de l'application
$applicationIdentifier = "com.zertycolor.youcandoit";

//
//  Identifiant de l'application
//
Fillio_ServerLogic_Application::getInstance()->setApplicationIdentifier($applicationIdentifier);

//
//  Nom de l'application
//
Fillio_ServerLogic_Application::getInstance()->setName("YouCanDoIt");

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
Fillio_ServerLogic_Application::getInstance()->addRoute("/class/:classname/:id/", "/default/(classname)/get/(id)");
Fillio_ServerLogic_Application::getInstance()->addRoute("/fillio/:keyword/", "/test/(keyword)");

//
//  Initilisation de la database de l'application
//
//Fillio_Storage_Database::getInstance("main")->setCredential("localhost", "8889", "test-fillio", "root", "root");

//
//  Initilisation de la database pour Core Fillio
//
//Fillio_Storage_Database::getInstance("fillio")->setCredential("127.0.0.1", null, "fillio", "root", "root");
