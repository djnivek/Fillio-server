<?php

/*
 * R�cup�ration des informations pass�es
 */

//  r�cup�ration du fichier de transmission
//  identifiant de l'application demand�e (com.example.app)
$applicationID = $_POST['application_identifier'];
//  action demand�e
//$action = $_POST['action']; --- dans l'url
//  controller de l'action
//$controller = $_POST['controller']; --- dans l'url
//  donn�es pour l'action
$datas64 = $_POST['datas64'];

//  identifiants n�cessaire au bon fonctionnement
$ids = $_POST['ids'];
/**/ $clientID = $ids['client_id'];
/**/ $uniqueVendorID = $ids['unique_vendor_id'];
/**/ $operatingSystem = $ids['os'];
/**/ $operatingSystemVersion = $ids['os_version'];

//  r�cup�ration du controller et action demand�e
RouteController::getInstance()->handleRouting($applicationID, $SERVER['REQUEST_URI']);


