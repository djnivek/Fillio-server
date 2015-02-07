<?php

/*
 * Récupération des informations passées
 */

//  récupération du fichier de transmission
//  identifiant de l'application demandée (com.example.app)
$applicationID = $_POST['application_identifier'];
//  action demandée
//$action = $_POST['action']; --- dans l'url
//  controller de l'action
//$controller = $_POST['controller']; --- dans l'url
//  données pour l'action
$datas64 = $_POST['datas64'];

//  identifiants nécessaire au bon fonctionnement
$ids = $_POST['ids'];
/**/ $clientID = $ids['client_id'];
/**/ $uniqueVendorID = $ids['unique_vendor_id'];
/**/ $operatingSystem = $ids['os'];
/**/ $operatingSystemVersion = $ids['os_version'];

//  récupération du controller et action demandée
RouteController::getInstance()->handleRouting($applicationID, $SERVER['REQUEST_URI']);


